<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 08:42:41 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-08-18 22:05:59
 */
namespace App\Http\Controllers\V1;

use App\Http\Controllers\V1\BaseController;
use App\Models\Currency;
use App\Models\Gateway;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Shetabit\Payment\Facade\Payment as PaymentProcess;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;


class MainController extends BaseController{

    public function index(Request $request){
        $currency = Currency::where('status',2)->first();
        $gateways = Gateway::where('status',1)->get();
        return self::getWebView('home',['currency'=>$currency->name, 'gateways'=>$gateways]);
    }

    public function show(Request $request){
        if(($this->amount = (int)$request->input('amount')) && ($gatewayID = $request->input('gatewaye'))){
            $name = $request->input('name') ?? null;

            $mobile = (float) $request->input('mobile');
            if(!self::checkMobile($mobile)){
                return redirect()->route('home')->with('error' , __('شماره موبایل قابل قبول نمی‌باشد !'));
            }
            if(!self::checkamount($this->amount)){
                return redirect()->route('home')->with('error' , __('مبلغ کمتر از ۱۰۰۰ مورد قبول نمی‌باشد !'));
            }
            if(!$userInfo = User::where('mobile',$mobile)->first()){
                $userInfo = new User;
                $userInfo->mobile = $mobile;
                $userInfo->nickname = $request->input('name') ?? $mobile;
                $userInfo->save();
            }

            $currency = Currency::where('status',2)->first();

            if(!$gateway = Gateway::where('status',1)->where('id', $gatewayID)->first()){
                return redirect()->route('home')->with('error' , __('درگاه پرداخت درخواستی غیرفعال می‌باشد !'));
            }

            $backurl = $request->input('callback_url') ?? null;
            $json = $request->input('json') ?? null;

            return self::getWebView('pay',[
                'currency'=>$currency->name,
                'gateway'=>$gateway,
                'amount'=>$this->amount,
                'mobile'=>$mobile,
                'name'=>$name,
                'backurl'=>$backurl,
                'json'=>$json
            ]);
        }else{
            return redirect()->route('home');
        }
    }

    private $merchant_id;
    private $amount;
    private $gateway;
    private $trans_id;
    private $backurl = null;
    private $gatewayID;
    public function send(Request $request){
        if(($this->amount = (int)$request->input('amount')) && ($this->gatewayID = $request->input('gateway'))){
            if(!$this->merchant_id = $request->input('merchant_id')){
                $this->merchant_id = 1;
            }

            $name = $request->input('name') ?? null;
            $mobile = (float) $request->input('mobile');
            if(!self::checkMobile($mobile)){
                return redirect()->route('home')->with('error' , __('شماره موبایل قابل قبول نمی‌باشد !'));
            }
            if(!self::checkamount($this->amount)){
                return redirect()->route('home')->with('error' , __('مبلغ کمتر از ۱۰۰۰ مورد قبول نمی‌باشد !'));
            }

            if(!$this->gateway = Gateway::where('status',1)->where('id', $this->gatewayID)->first()){
                return redirect()->route('home')->with('error' , __('درگاه پرداخت درخواستی غیرفعال می‌باشد !'));
            }

            $this->backurl = $request->input('callback_url') ?? null;
            $json = $request->input('json') ?? null;

            //
            $this->trans_id = uniqueRandomString('payments','transaction');

            //
            $paymentProcess = new PaymentProcess;
            
            //
            if($request->input('json') == null){
                return $paymentProcess::amount($this->amount)
                    ->via($this->gateway->driver)
                    ->config(self::createConfig())->purchase(
                    null, 
                    function($driver, $transactionId) {
                    // We can store $transactionId in database.
                    $payment = new Payment;
                    $payment->merchant_id = $this->merchant_id;
                    $payment->amount = $this->amount;
                    $payment->transaction_id = $transactionId;
                    $payment->transaction = $this->trans_id;
                    $payment->driver = $this->gateway->driver;
                    $payment->status = 2;
                    $payment->currency = 'IRT';
                    $payment->callback_url = $this->backurl;
                    $payment->save();
                    
                })->pay()->render();// render() or toJson()
            }else{
                return $paymentProcess::amount($this->amount)
                    ->via($this->gateway->driver)
                    ->config(self::createConfig())->purchase(
                    null, 
                    function($driver, $transactionId) {
                    // We can store $transactionId in database.
                    $payment = new Payment;
                    $payment->merchant_id = $this->merchant_id;
                    $payment->amount = $this->amount;
                    $payment->transaction_id = $transactionId;
                    $payment->transaction = $this->trans_id;
                    $payment->driver = $this->gateway->driver;
                    $payment->status = 2;
                    $payment->currency = 'IRT';
                    $payment->callback_url = $this->backurl;
                    $payment->save();
                    
                })->pay()->toJson();// render() or toJson()
            }
            
        }else{
            return redirect()->route('home');
        }
    }

    public function verify(Request $request){
        if(!$payInfo = Payment::where('transaction',$request->input('trans_id'))->where('amount',$request->input('price'))->first()){
            return self::getWebView('cancel',['code'=>null, 'message'=>'خطا در بازگشت از درگاه پرداخت !']);
        }
        
        try {
            $this->gateway = Gateway::where('status',1)->where('id', $request->input('ipgw'))->first();
            $receipt = PaymentProcess::amount($request->input('price'))
                ->via($this->gateway->driver)
                ->config(self::createConfig())
                ->transactionId($payInfo->transaction_id)->verify();
        
            $payInfo->refid = $receipt->getReferenceId();
            $payInfo->status = 1;
            $payInfo->status_gateway = $request->input('status') ?? 1;
            $payInfo->save();
            if($payInfo->callback_url == null){
                return self::getWebView('verify',['refid' => $receipt->getReferenceId()]);
            }else{
                return redirect()->to($payInfo->callback_url);
            }
            
        } catch (InvalidPaymentException $exception) {
            $payInfo->status = $exception->getCode();
            $payInfo->status_gateway = $exception->getCode();
            $payInfo->response_bk = $exception->getMessage();
            $payInfo->save();
            return self::getWebView('cancel',['code'=>$exception->getCode(), 'message'=>$exception->getMessage()]);
        }
    }

    private function createConfig(){
        return [
            'username'=>$this->gateway->username ?? null,
            'password'=>$this->gateway->password ?? null,
            'merchantId'=>$this->gateway->merchant_id ?? null,
            'pin'=>$this->gateway->merchant_id ?? null,
            'callbackUrl'=>route('web.pay.verify',['trans_id'=>$this->trans_id, 'price'=>$this->amount, 'ipgw'=>$this->gatewayID]),
            'currency'=>'T',
            'mode' => env('APP_DEBUG',false) == true ? 'sandbox' : 'normal',
        ];
    }
    
    private function checkMobile($phoneNumber = null){
        if(preg_match('/^(?:98|\+98|0098|0)?9[0-9]{9}$/', $phoneNumber)) {
            return true;
         }else{
            return false;
         }
    }
    private function checkamount($amount = null){
        if($amount >= 1000) {
            return true;
         }else{
            return false;
         }
    }
}