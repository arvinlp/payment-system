<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 09:40:37 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-07-16 13:13:24
 */

namespace App\Http\Controllers\V1\Gateway;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class Parspal{

    private $API_KEY;
    private $url;

    public function __construct(){
        $this->API_KEY = (Config::get('gateway.parspal.sandbox') ? '' : Config::get('gateway.parspal.merchant'));

        $url = (Config::get('gateway.parspal.sandbox') ? 'https://sandbox.api.parspal.com/v1/' : 'https://api.parspal.com/v1/');
    }

    public function createPayment($data)
    {
        if ($data->currency != 'rial') $amount = (float) $data->amount * 10;
        else $amount = (float) $data->amount;

        $gateData = [
            "amount" => $amount, //// rial
            "return_url" => route('payment.parspal')
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url.'request');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($gateData, JSON_UNESCAPED_UNICODE));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "APIKEY: {$this->API_KEY}",
            "Content-Type: application/json",
        ));
        curl_setopt($curl, CURLOPT_TIMEOUT, 50);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $curl_exec = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($curl_exec);
        dd($result);
        if ($result["status"] == "ACCEPTED") {
            $data->transaction_id = $result['id'];
            $data->save();
            
            return Redirect::to($result["link"]);
        } else {
            $error = "Error Code: {$result['message']} | {$this->API_KEY}";
            $data->status_gateway = 0;
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

            $receipt_number = ($request->has('receipt_number') && !empty($request->input('receipt_number'))) ? $request->input('receipt_number') : "";

            if ($paymentData = Payment::where('transaction_id', $receipt_number)->where('gateway', 'Parspal')->first()) {

                if ($paymentData->currency != 'rial') $amount = (float) $paymentData->amount * 10;
                else $amount = (float) $paymentData->amount;

                $data = [
                    "amount" => $amount,
                    "receipt_number" => $receipt_number
                ];

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $this->url.'payment/verify');
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    "APIKEY: {$this->API_KEY}",
                    "Content-Type: application/json",
                ));
                curl_setopt($curl, CURLOPT_TIMEOUT, 50);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $curl_exec = curl_exec($curl);
                curl_close($curl);

                $result = json_decode($curl_exec);

                if (isset($result->status) && $result->status == 'SUCCESSFUL') {
                    $paymentData->response_bk .= " | Invoice Successfully Paid | Price: {$result->amount} Rial | RefID: {$receipt_number}";
                    $paymentData->refid = $receipt_number;
                    $paymentData->status_gateway = $result->status;
                    $paymentData->status = 200;
                    $paymentData->save();
                    if (isset($paymentData->callback_url)){
                        $callbackData = $paymentData->callback_url."?amount={$result->amount}&transaction={$paymentData->transaction}&status=200&ref_id={$receipt_number}";
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
