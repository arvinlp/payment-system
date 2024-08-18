<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 09:40:37 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-07-16 13:24:41
 */

namespace App\Http\Controllers\V1\Gateway;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class Aqayepardakht{

    private $merchantCode;

    public function __construct(){
        $this->merchantCode = (Config::get('gateway.aqayepardakht.sandbox') ? '' : Config::get('gateway.aqayepardakht.merchant'));
    }

    public function createPayment($data)
    {
        if ($data->currency != 'toman') $amount = (float) $data->amount / 10;
        else $amount = (float) $data->amount;

        $gateData = [
            "pin" => $this->merchantCode,
            "amount" => $amount, //// rial
            "callback" => route('payment.aqayepardakht')
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://panel.aqayepardakht.ir/api/v2/create");
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type" => "application/json"]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($gateData, JSON_UNESCAPED_UNICODE));
        curl_setopt($curl, CURLOPT_TIMEOUT, 50);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_exec = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($curl_exec);
        
        if (isset($result->status) && $result->status == 'success') {
            $data->transaction_id = $result->transid;
            $data->save();
            
            return Redirect::to('https://panel.aqayepardakht.ir/startpay/'.$result->transid);
        } else {
            $error = "Error Code: {$result->status} | {$result->code} | {$this->merchantCode}";
            $data->status_gateway = $result->code;
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
                print_r($result);
                return view('payment-faild', ['data' => $result]);
            }
        }
    }

    public function verifyPayment(Request $request)
    {
        if ($request->has('success') && $request->input('success') == "1") {

            $transid = ($request->has('transid') && !empty($request->input('transid'))) ? $request->input('transid') : "";

            if ($paymentData = Payment::where('transaction_id', $transid)->where('gateway', 'Aqayepardakht')->first()) {

                if ($paymentData->currency != 'toman') $amount = (float) $paymentData->amount / 10;
                else $amount = (float) $paymentData->amount;
                $data = [
                    "pin" => $this->merchantCode,
                    "transid" => $transid,
                    "amount" => $amount
                ];

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, "https://panel.aqayepardakht.ir/api/v2/verify");
                curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type" => "application/json"]);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
                curl_setopt($curl, CURLOPT_TIMEOUT, 50);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $curl_exec = curl_exec($curl);
                curl_close($curl);

                $result = json_decode($curl_exec);

                if (isset($result->status) && $result->status == 'success') {
                    $paymentData->response_bk .= " | Invoice Successfully Paid | Price: {$result->amount} Rial | RefID: {$transid}";
                    $paymentData->refid = $result->transid;
                    $paymentData->status_gateway = $result->code;
                    $paymentData->status = 200;
                    $paymentData->save();
                    if (isset($paymentData->callback_url)){
                        $callbackData = $paymentData->callback_url."?amount={$result->amount}&transaction={$paymentData->transaction}&status=200&ref_id={$result->transid}";
                        return Redirect::to($callbackData);
                    }else{
                        return view('payment', ['data' => $result->data]);
                    }
                } else {
                    $paymentData->status_gateway = $result->code;
                    $paymentData->status = -1101;
                    $error = "Error Code: {$result->status} | {$result->code} | {$this->merchantCode}";
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
