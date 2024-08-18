<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 09:40:37 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-07-16 15:27:30
 */

namespace App\Http\Controllers\V1\Gateway;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class Novinopay{

    private $merchantCode;

    public function __construct(){
        $this->merchantCode = (Config::get('gateway.novinopay.sandbox') ? 'sandbox' : Config::get('gateway.novinopay.merchant'));
    }

    public function createPayment($data)
    {
        if ($data->currency != 'rial') $amount = (float) $data->amount * 10;
        else $amount = (float) $data->amount;

        $gateData = [
            "merchant_id" => $this->merchantCode,
            "amount" => $amount, //// rial
            "callback_url" => route('payment.novinopay')
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.novinopay.com/payment/ipg/v2/request");
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type" => "application/json"]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($gateData, JSON_UNESCAPED_UNICODE));
        curl_setopt($curl, CURLOPT_TIMEOUT, 50);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_exec = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($curl_exec);
        if (isset($result->status) && $result->status == 100) {
            $data->authority = $result->data->authority;
            $data->transaction_id = $result->data->trans_id;
            $data->save();
            header("Location: {$result->data->payment_url}");
        } else {
            $error = "Error Code: {$result->status} | {$result->message} | {$this->merchantCode}";
            $data->status_gateway = $result->status;
            $data->status = -1001;
            if ($data->response_bk)
                $data->response_bk .= " | {$error}";
            else
                $data->response_bk = $error;
            $data->save();

            if (isset($data->callback_url)){
                $callbackData = $data->callback_url."?amount={$amount}&transaction={$data->transaction}&order_code={$data->order_code}&status=-1001";
                return Redirect::to($callbackData);
            }else{
                print_r($result);
                return view('payment-faild', ['data' => $result]);
            }
        }
    }

    public function verifyPayment(Request $request)
    {
        if ($request->has('PaymentStatus') && $request->input('PaymentStatus') == "OK") {

            $Authority = ($request->has('Authority') && !empty($request->input('Authority'))) ? $request->input('Authority') : "";

            if ($paymentData = Payment::where('authority', $Authority)->where('gateway', 'NovinoPay')->first()) {

                if ($paymentData->currency != 'rial') $amount = (float) $paymentData->amount * 10;
                else $amount = (float) $paymentData->amount;
                
                $data = [
                    "merchant_id" => $this->merchantCode,
                    "amount" => (int) $amount,
                    "authority" => $Authority
                ];

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, "https://api.novinopay.com/payment/ipg/v2/verification");
                curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type" => "application/json"]);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
                curl_setopt($curl, CURLOPT_TIMEOUT, 50);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $curl_exec = curl_exec($curl);
                curl_close($curl);

                $result = json_decode($curl_exec);

                if (isset($result->status) && $result->status == 100) {
                    $paymentData->response_bk .= " | Invoice Successfully Paid | Price: {$result->data->amount} Rial | RefID: {$result->data->ref_id}";
                    $paymentData->ref_id = $result->data->ref_id;
                    $paymentData->status_gateway = $result->status;
                    $paymentData->status = 200;
                    $paymentData->save();
                    if (isset($paymentData->callback_url)){
                        $callbackData = $paymentData->callback_url."?amount={$amount}&transaction={$paymentData->transaction}&order_code={$paymentData->order_code}&status=200&ref_id={$result->data->ref_id}";
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
                        $callbackData = $paymentData->callback_url."?amount={$amount}&transaction={$paymentData->transaction}&order_code={$paymentData->order_code}&status=-1101";
                        return Redirect::to($callbackData);
                    }else{
                        return view('payment-faild', ['data' => $result]);
                    }
                }
            } else {
                $paymentData->status = -1102;
                $paymentData->save();
                if (isset($paymentData->callback_url)){
                    $callbackData = $paymentData->callback_url."?amount={$paymentData->amount}&transaction={$paymentData->transaction}&order_code={$paymentData->order_code}&status=-1102";
                    return Redirect::to($callbackData);
                }else{
                    return view('payment-faild', ['data' => ['paymentData NotFound']]);
                }
            }
        } else {
            $Authority = ($request->has('Authority') && !empty($request->input('Authority'))) ? $request->input('Authority') : "";
            if ($paymentData = Payment::where('authority', $Authority)->where('gateway', 'NovinoPay')->first()) {
                    $paymentData->status_gateway = 0;
                    $paymentData->status = -1101;
                    $error = "Error Code: NOK";
                    if ($paymentData->response_bk)
                        $paymentData->response_bk .= " | {$error}";
                    else
                        $paymentData->response_bk = $error;
                    $paymentData->save();
                    if (isset($paymentData->callback_url)){
                        $callbackData = $paymentData->callback_url."?amount={$paymentData->amount}&transaction={$paymentData->transaction}&order_code={$paymentData->order_code}&status=-1101";
                        return Redirect::to($callbackData);
                    }else{
                        return view('payment-faild', ['payment faild']);
                    }
            }else{
            return view('payment-faild', ['data' => ['payment faild']]);
            }
        }
    }
}
