<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 09:40:37 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-07-16 13:13:30
 */

namespace App\Http\Controllers\V1\Gateway;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class Zarinpal{

    private $merchantCode;

    public function __construct(){
        $this->merchantCode = (Config::get('gateway.zarinpal.sandbox') ? '' : Config::get('gateway.zarinpal.merchant'));
    }

    public function createPayment($data)
    {
        if ($data->currency != 'rial') $amount = (float) $data->amount * 10;
        else $amount = (float) $data->amount;

        $gateData = [
            "merchant_id" => $this->merchantCode,
            "amount" => $amount, //// rial
            "description"=> 'پرداخت مبلغ '.$amount,
            "callback_url" => route('payment.zarinpal')
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://payment.zarinpal.com/pg/v4/payment/request.json");
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type" => "application/json"]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($gateData, JSON_UNESCAPED_UNICODE));
        curl_setopt($curl, CURLOPT_TIMEOUT, 50);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_exec = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($curl_exec);
        
        if (isset($result->data->code) && $result->data->code == 100) {
            $data->authority = $result->data->authority;
            $data->save();
            
            return Redirect::to('https://payment.zarinpal.com/pg/StartPay/'.$result->data->authority);
        } else {
            $error = "Error Code: {$result->errors->code} | {$result->errors->message} | {$this->merchantCode}";
            $data->status_gateway = $result->errors->code;
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
        if ($request->has('Status') && $request->input('Status') == "OK") {

            $Authority = ($request->has('Authority') && !empty($request->input('Authority'))) ? $request->input('Authority') : "";

            if ($paymentData = Payment::where('authority', $Authority)->where('gateway', 'Zarinpal')->first()) {

                if ($paymentData->currency != 'rial') $amount = (float) $paymentData->amount * 10;
                else $amount = (float) $paymentData->amount;

                $data = [
                    "merchant_id" => $this->merchantCode,
                    "amount" => $amount,
                    "authority" => $Authority
                ];

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, "https://payment.zarinpal.com/pg/v4/payment/verify.json");
                curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type" => "application/json"]);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
                curl_setopt($curl, CURLOPT_TIMEOUT, 50);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $curl_exec = curl_exec($curl);
                curl_close($curl);

                $result = json_decode($curl_exec);

                if (isset($result->data->code) && $result->data->code == 100) {
                    $paymentData->response_bk .= " | Invoice Successfully Paid | Price: {$result->data->amount} Rial | RefID: {$result->data->ref_id}";
                    $paymentData->refid = $result->data->ref_id;
                    $paymentData->status_gateway = $result->data->code;
                    $paymentData->status = 200;
                    $paymentData->save();
                    if (isset($paymentData->callback_url)){
                        $callbackData = $paymentData->callback_url."?amount={$result->amount}&transaction={$paymentData->transaction}&status=200&ref_id={$result->data->ref_id}";
                        return Redirect::to($callbackData);
                    }else{
                        return view('payment', ['data' => $result->data]);
                    }
                } else {
                    $paymentData->status_gateway = $result->errors->status;
                    $paymentData->status = -1101;
                    $error = "Error Code: {$result->errors->status} | {$result->errors->message} | {$this->merchantCode}";
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
