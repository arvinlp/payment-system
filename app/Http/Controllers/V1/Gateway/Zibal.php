<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 09:40:37 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-07-16 13:20:09
 */

namespace App\Http\Controllers\V1\Gateway;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class Zibal{

    private $merchantCode;

    public function __construct(){
        $this->merchantCode = (Config::get('gateway.zibal.sandbox') ? 'zibal' : Config::get('gateway.zibal.merchant'));
    }

    public function createPayment($data)
    {
        if ($data->currency != 'rial') $amount = (float) $data->amount * 10;
        else $amount = (float) $data->amount;

        $gateData = [
            "merchant" => $this->merchantCode,
            "amount" => $amount, //// rial
            "callbackUrl" => route('payment.zibal')
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://gateway.zibal.ir/v1/request");
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type" => "application/json"]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($gateData, JSON_UNESCAPED_UNICODE));
        curl_setopt($curl, CURLOPT_TIMEOUT, 50);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_exec = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($curl_exec);

        if (isset($result->status) && $result->status == 1) {
            $data->transaction_id = $result->trackId;
            $data->save();
            
            return Redirect::to('https://gateway.zibal.ir/start/'.$result->trackId);
        } else {
            $error = "Error Code: {$result->result} | {$result->message} | {$this->merchantCode}";
            $data->status_gateway = $result->result;
            $data->status = -1001;
            if ($data->response_bk)
                $data->response_bk .= " | {$error}";
            else
                $data->response_bk = $error;
            $data->save();

            if (isset($data->callback_url)){
                $callbackData = $data->callback_url."?amount={$amount}&transaction={$data->transaction}&status=-1001";
                return Redirect::to($callbackData);
            }else{
                return view('payment-faild', ['data' => $result]);
            }
        }
    }

    public function verifyPayment(Request $request)
    {
        if ($request->has('success') && $request->input('success') == "1") {
            $trackId = ($request->has('trackId') && !empty($request->input('trackId'))) ? $request->input('trackId') : "";
            if ($paymentData = Payment::where('transaction_id', $trackId)->where('gateway', 'Zibal')->first()) {

                $data = [
                    "merchant" => $this->merchantCode,
                    "trackId" => $trackId
                ];

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, "https://gateway.zibal.ir/v1/verify");
                curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type" => "application/json"]);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
                curl_setopt($curl, CURLOPT_TIMEOUT, 50);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $curl_exec = curl_exec($curl);
                curl_close($curl);

                $result = json_decode($curl_exec);

                if (isset($result->status) && $result->status == 100) {
                    $paymentData->response_bk .= " | Invoice Successfully Paid | Price: {$result->amount} Rial | RefID: {$result->refNumber}";
                    $paymentData->refid = $result->refNumber;
                    $paymentData->status_gateway = $result->status;
                    $paymentData->status = 200;
                    $paymentData->save();
                    if (isset($paymentData->callback_url)){
                        $callbackData = $paymentData->callback_url."?amount={$result->amount}&transaction={$paymentData->transaction}&status=200&ref_id={$result->refNumber}";
                        return Redirect::to($callbackData);
                    }else{
                        return view('payment', ['data' => $result->data]);
                    }
                } else {
                    $paymentData->status_gateway = $result->status;
                    $paymentData->status = -1101;
                    $error = "Error Code: {$result->status} | {$result->message} | {$this->merchantCode}";
                    if ($paymentData->response_bk)
                        $paymentData->response_bk .= " | {$error}";
                    else
                        $paymentData->response_bk = $error;
                    $paymentData->save();
                    if (isset($paymentData->callback_url)){
                        $callbackData = $paymentData->callback_url."?amount={$paymentData->amount}&transaction={$paymentData->transaction}&status=-1101";
                        return Redirect::to($callbackData);
                    }else{
                        return view('payment-faild', ['data' => $result]);
                    }
                }
            } else {
                $paymentData->status = -1102;
                $paymentData->save();
                if (isset($paymentData->callback_url)){
                    $callbackData = $paymentData->callback_url."?amount={$paymentData->amount}&transaction={$paymentData->transaction}&status=-1102";
                    return Redirect::to($callbackData);
                }else{
                    return view('payment-faild', ['data' => ['paymentData NotFound']]);
                }
            }
        } else {
            return view('payment-faild', ['data' => ['payment faild']]);
        }
    }
}
