<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-10-07 15:52:13 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-10-07 16:48:04
 */

namespace App\Http\Controllers\V1\Gatewaye;

use App\Models\Gateway;
use App\Models\Payment;
use Illuminate\Http\Request;

class Aqayepardakht
{
    private $aqa;

    public function __construct()
    {
        if (!$this->aqa = Gateway::where('driver', 'aqayepardakht')->where('status', '1')->first()) {
            return __('Gateway Disabled');
        }
    }

    public function makePayLink($merchant_id, $amount, $system_trans_id, $callback, $invoice_id = null, $mobile = null)
    {

        $parameters['pin'] = $this->aqa->merchant_id;
        $parameters['amount'] = $amount;
        $parameters['callback'] = $callback;
        $parameters['invoice_id'] = $invoice_id ?? $system_trans_id;
        if (isset($mobile)) $parameters['mobile'] = $mobile;

        $response = self::postToGatewaye('create', $parameters);

        if ($response->status == 'success') {

            $traceCode = $response->transid; // دریافت کد رهگیری

            $payment = new Payment;
            $payment->merchant_id = $merchant_id;
            $payment->amount = $amount;
            $payment->transaction_id = $traceCode;
            $payment->transaction = $system_trans_id; // System Transaction Code
            $payment->driver = 'aqayepardakht';
            $payment->status = 2;
            $payment->currency = 'IRT';
            $payment->callback_url = $callback;
            $payment->save();

            return 'https://panel.aqayepardakht.ir/startpay/' . $traceCode;
        } else {
            return self::getError($response->code);
        }
    }

    public function verify(Request $request, $amount, $system_trans_id)
    {
        $parameters['pin'] = $this->aqa->merchant_id;
        $parameters['amount'] = $amount;
        $parameters['transid'] = $request->input('transid'); // کد رهگیری برای تایید تراکنش

        $response = self::postToGatewaye('verify', $parameters);

        if ($response->code == "1") {
            return $parameters['transid'];
        } else {
            return self::getError($response->code);
        }
    }

    private function postToGatewaye($path, $parameters)
    {
        $url = 'https://panel.aqayepardakht.ir/api/v2/' . $path;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }

    private function getError($code)
    {
        $arg = array(
            '2' => 'تراکنش قبلا وریفای و پرداخت شده است.',
            '1' => 'پرداخت با موفقیت انجام شد.',
            '0' => 'پرداخت نشد، درصورت کسر وجه به حساب باز‌میگردد.',
            '-1' => 'amount نمی تواند خالی باشد',
            '-2' => 'کد پین درگاه نمی تواند خالی باشد',
            '-3' => 'callback نمی تواند خالی باشد',
            '-4' => 'amount باید عددی باشد',
            '-5' => 'amount باید بین 1,000 تا 200,000,000 تومان باشد',
            '-6' => 'کد پین درگاه اشتباه هست',
            '-7' => 'transid نمی تواند خالی باشد',
            '-8' => 'تراکنش مورد نظر وجود ندارد',
            '-9' => 'کد پین درگاه با درگاه تراکنش مطابقت ندارد',
            '-10' => 'مبلغ با مبلغ تراکنش مطابقت ندارد',
            '-11' => 'درگاه درانتظار تایید و یا غیر فعال است',
            '-12' => 'امکان ارسال درخواست برای این پذیرنده وجود ندارد',
            '-13' => 'شماره کارت باید 16 رقم چسبیده بهم باشد',
            '-14' => 'درگاه برروی سایت دیگری درحال استفاده است'
        );
        return $arg[$code];
    }
}
