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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as PaymentProcess;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class MainController extends BaseController{

    public function index(Request $request){
        $currency = Currency::where('status',2)->first();
        $gateways = Gateway::where('status',1)->get();
        return self::getWebView('home',['currency'=>$currency->name, 'gateways'=>$gateways]);
    }

    public function show(Request $request){
        if(($amount = $request->input('amount')) && ($gatewayID = $request->input('gatewaye'))){
            $name = $request->input('name') ?? null;
            $mobile = $request->input('mobile') ?? null;
            $gatewayID = $request->input('gatewaye') ?? 1;
            $currency = Currency::where('status',2)->first();
            $gateway = Gateway::where('status',1)->where('id', $gatewayID)->first();
            return self::getWebView('pay',[
                'currency'=>$currency->name,
                'gateway'=>$gateway,
                'amount'=>$amount,
                'mobile'=>$mobile,
                'name'=>$name
            ]);
        }else{
            return redirect()->route('home');
        }
    }

    private $merchant_id;
    private $amount;
    private $gateway;
    public function send(Request $request){
        if(($this->amount = $request->input('amount')) && ($gatewayID = $request->input('gateway'))){
            if(!$this->merchant_id = $request->input('merchant_id')){
                $this->merchant_id = 1;
            }
            $name = $request->input('name') ?? null;
            $mobile = $request->input('mobile') ?? null;
            $this->gateway = Gateway::where('status',1)->where('id', $gatewayID)->first();

            //
            $paymentProcess = new PaymentProcess;
            $paymentProcess::amount($this->amount)
                ->via($this->gateway->driver)
                ->config([
                    'username'=>$this->gateway->username ?? null,
                    'password'=>$this->gateway->password ?? null,
                    'merchantId'=>$this->gateway->merchant_id ?? null,
                    'pin'=>$this->gateway->merchant_id ?? null,
                    'callbackUrl'=>route('web.pay.verify'),
                    'currency'=>'T',
                ])->purchase(
                null, 
                function($driver, $transactionId) {
                // We can store $transactionId in database.
                $payment = new Payment;
                $payment->merchant_id = $this->merchant_id;
                $payment->amount = $this->amount;
                $payment->transaction_id = $transactionId;
                $payment->transaction = uniqueRandomString('payments','transaction');
                $payment->driver = $this->gateway->driver;
                $payment->save();
                
            })->pay()
            ->render();
            // ->toJson();
            
        }else{
            // return redirect()->route('home');
        }
    }

    public function verify(Request $request){
        try {
            if($transaction_id = $request->input('transaction_id')){
                $receipt = Payment::amount(1000)->transactionId($transaction_id)->verify();
            
                echo $receipt->getReferenceId();
            }else{
                echo 'WTF';
            }
        } catch (InvalidPaymentException $exception) {
            echo $exception->getMessage();
        }
    }
}