<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 09:40:37 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-07-16 13:25:59
 */

namespace App\Http\Controllers\V1\Gateway;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class NovinPal{

    private $API_KEY;

    public function __construct(){
        $this->API_KEY = (Config::get('gateway.novinpal.sandbox') ? 'sandbox' : Config::get('gateway.novinpal.merchant'));
    }

    public function createPayment($data)
    {
        if ($data->currency != 'rial') $amount = (float) $data->amount * 10;
        else $amount = (float) $data->amount;
        
        $order_id = $data->code;

        $gateData = [
            "api_key" => $this->API_KEY,
            "amount" => $amount, //// rial
            "order_id" => $order_id,
            "return_url" => route('payment.novinpal')
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.novinpal.ir/invoice/request");
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type" => "application/json"]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($gateData, JSON_UNESCAPED_UNICODE));
        curl_setopt($curl, CURLOPT_TIMEOUT, 50);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_exec = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($curl_exec);

        if (isset($result->status) && $result->status == 1) {
            $data->refid = $result->refId;
            $data->save();
            
            return Redirect::to('https://api.novinpal.ir/invoice/start/'.$result->refId);
        } else {
            $error = "Error Code: {$result->status} | {$result->errorCode} | {$result->errorDescription} | {$this->API_KEY}";
            $data->status_gateway = $result->status;
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

            $refId = ($request->has('refId') && !empty($request->input('refId'))) ? $request->input('refId') : "";

            if ($paymentData = Payment::where('refid', $refId)->where('gateway', 'NovinPal')->first()) {

                $data = [
                    "api_key" => $this->API_KEY,
                    "ref_id" => $refId
                ];

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, "https://api.novinpal.ir/invoice/verify");
                curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type" => "application/json"]);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
                curl_setopt($curl, CURLOPT_TIMEOUT, 50);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $curl_exec = curl_exec($curl);
                curl_close($curl);

                $result = json_decode($curl_exec);

                if (isset($result->status) && $result->status == 100) {
                    $paymentData->response_bk .= " | Invoice Successfully Paid | Price: {$result->amount} Rial | RefID: {$result->ref_id}";
                    $paymentData->transaction_id = $result->refNumber;
                    $paymentData->status_gateway = $result->status;
                    $paymentData->status = 200;
                    $paymentData->save();
                    if (isset($paymentData->callback_url)){
                        $callbackData = $paymentData->callback_url."?amount={$result->amount}&transaction={$paymentData->transaction}&status=200&ref_id={$result->ref_id}";
                        return Redirect::to($callbackData);
                    }else{
                        return view('payment', ['data' => $result->data]);
                    }
                } else {
                    $paymentData->status_gateway = $result->status;
                    $paymentData->status = -1101;
                    $error = "Error Code: {$result->status} | {$result->message} | {$this->API_KEY}";
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
