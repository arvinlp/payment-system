<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 08:42:41 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-10-07 17:47:55
 */

namespace App\Http\Controllers\V1;

use App\Http\Controllers\V1\BaseController;
use App\Http\Controllers\V1\Gateway\Aqayepardakht;
use App\Models\Currency;
use App\Models\Gateway;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends BaseController
{

    public function index(Request $request)
    {
        $currency = Currency::where('status', 2)->first();
        $gateways = Gateway::where('status', 1)->get();
        return self::getWebView('home', ['currency' => $currency->name, 'gateways' => $gateways]);
    }

    public function show(Request $request)
    {
        if (($amount = (int)$request->input('amount')) && ($gatewayID = $request->input('gateway'))) {

            $mobile = (float) $request->input('mobile');
            if (!self::checkMobile($mobile)) {
                return redirect()->route('home')->with('error', __('شماره موبایل قابل قبول نمی‌باشد !'));
            }
            if (!self::checkamount($amount)) {
                return redirect()->route('home')->with('error', __('مبلغ کمتر از ۱۰۰۰ مورد قبول نمی‌باشد !'));
            }
            if (!$userInfo = User::where('mobile', $mobile)->first()) {
                $userInfo = new User;
                $userInfo->mobile = $mobile;
                $userInfo->nickname = $request->input('name') ?? $mobile;
                $userInfo->save();
            }

            $name = $request->input('name') ?? $userInfo->nickname;

            $currency = Currency::where('status', 2)->first();

            if (!$gateway = Gateway::where('status', 1)->where('id', $gatewayID)->first()) {
                if (!$gateway = Gateway::where('status', 1)->where('driver', $gatewayID)->first()) {
                    return redirect()->route('home')->with('error', __('درگاه پرداخت درخواستی غیرفعال می‌باشد !'));
                }
            }

            $backurl = $request->input('callback_url') ?? null;
            $merchant = $request->input('merchant') ?? null;
            $json = $request->input('json') ?? null;

            return self::getWebView('pay', [
                'currency' => $currency->name,
                'gateway' => $gateway,
                'amount' => $amount,
                'mobile' => $mobile,
                'name' => $name,
                'backurl' => $backurl,
                'merchant' => $merchant,
                'json' => $json
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function send(Request $request)
    {
        if (($amount = (int)$request->input('amount')) && ($gatewayID = $request->input('gateway'))) {
            if (!$merchant_id = $request->input('merchant_id')) {
                if ($merchant = Merchant::where('merchant', $request->input('merchant'))->where('status', 1)->first()) {
                    $merchant_id = $merchant->id;
                } else {
                    $merchant_id = 1;
                }
            }

            $name = $request->input('name') ?? null;
            $mobile = (float) $request->input('mobile');
            if (!self::checkMobile($mobile)) {
                return redirect()->route('home')->with('error', __('شماره موبایل قابل قبول نمی‌باشد !'));
            }
            if (!self::checkamount($amount)) {
                return redirect()->route('home')->with('error', __('مبلغ کمتر از ۱۰۰۰ مورد قبول نمی‌باشد !'));
            }

            if (!$gateway = Gateway::where('status', 1)->where('id', $gatewayID)->first()) {
                return redirect()->route('home')->with('error', __('درگاه پرداخت درخواستی غیرفعال می‌باشد !'));
            }

            $system_trans_id = uniqueRandomString('payments', 'transaction');
            $backurl = $request->input('callback_url') ?? route('web.pay.verify', ['sti' => $system_trans_id, 'price' => $amount, 'ipgw' => $gatewayID]);

            try {
                $aqa = new Aqayepardakht;
                if ($data = $aqa->makePayLink($merchant_id, $amount, $system_trans_id, $backurl)) {
                    return redirect($data);
                } else {
                    return self::getWebView('cancel', ['code' => null, 'message' => $data]);
                }
            } catch (\Exception $exception) {
                return self::getWebView('cancel', ['code' => $exception->getCode(), 'message' => $exception->getMessage()]);
            }
        } else {
            return redirect()->route('home');
        }
    }

    public function verify(Request $request)
    {

        if (!$payInfo = Payment::where('transaction', $request->input('sti'))->where('amount', $request->input('price'))->first()) {
            return self::getWebView('cancel', ['code' => null, 'message' => 'خطا در بازگشت از درگاه پرداخت !']);
        }        
        try {
            if($payInfo->status == 1){
                if (str_contains($payInfo->callback_url,env('APP_URL'))) {
                    return self::getWebView('verify', ['refid' => $payInfo->transaction_id]);
                }
                if (!filter_var($payInfo->callback_url, FILTER_VALIDATE_URL)) {
                    return self::getWebView('verify', ['refid' => $payInfo->transaction_id]);
                } else {
                    return redirect()->to($payInfo->callback_url . "&status={$payInfo->status}&refid={$payInfo->transaction_id}");
                }
            }

            $aqa = new Aqayepardakht;
            if ($data = $aqa->verify($request, $payInfo->amount, $payInfo->system_trans_id)) {
                
                $payInfo->transaction_id = $data;
                $payInfo->status = 1;
                $payInfo->status_gateway = $request->input('status') ?? 1;
                $payInfo->save();

                if (str_contains($payInfo->callback_url, env('APP_URL'))) {
                    return self::getWebView('verify', ['refid' => $data]);
                }
                if (!filter_var($payInfo->callback_url, FILTER_VALIDATE_URL)) {
                    return self::getWebView('verify', ['refid' => $data]);
                } else {
                    return redirect()->to($payInfo->callback_url . "&status={$payInfo->status}&refid={$data}");
                }
            } else {
                return self::getWebView('cancel', ['code' => null, 'message' => $data]);
            }

        } catch (\Exception $exception) {
            if (str_contains($payInfo->callback_url,env('APP_URL'))) {
                return self::getWebView('cancel', ['code' => $exception->getCode(), 'message' => $exception->getMessage()]);
            }
            if (!filter_var($payInfo->callback_url, FILTER_VALIDATE_URL)) {
                return self::getWebView('cancel', ['code' => $exception->getCode(), 'message' => $exception->getMessage()]);
            } else {
                return redirect()->to($payInfo->callback_url . "&status={$payInfo->status}");
            }
        }
    }


    private function checkMobile($phoneNumber = null)
    {
        if (preg_match('/^(?:98|\+98|0098|09|9)?[0-9]{9}$/', $phoneNumber)) {
            return true;
        } else {
            return false;
        }
    }
    private function checkamount($amount = null)
    {
        if ($amount >= 1000) {
            return true;
        } else {
            return false;
        }
    }
}
