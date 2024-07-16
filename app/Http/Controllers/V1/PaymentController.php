<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 08:42:41 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-07-16 14:24:53
 */
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\V1\Gateway\Aqayepardakht;
use App\Http\Controllers\V1\Gateway\Novinopay;
use App\Http\Controllers\V1\Gateway\NovinPal;
use App\Http\Controllers\V1\Gateway\Parspal;
use App\Http\Controllers\V1\Gateway\Zarinpal;
use App\Http\Controllers\V1\Gateway\Zibal;
use App\Models\Merchant;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller{

    public function index(Request $request){
        if(self::goToGateWay($request)){
            $merchantData = Merchant::where('merchant',$request->input('merchant'))->first();
            $data = new Payment;
            $data->gateway = $request->input('gateway');
            $data->merchant_id = $merchantData->id;
            $data->currency = $request->input('currency');
            $data->amount = $request->input('amount');
            $data->callback_url = $request->input('callback_url');
            $data->status = 100;
            $transaction = uniqueRandomString('payments','transaction',32);
            $data->transaction = $transaction;
            if($request->has('order_code')){ $data->order_code = $request->input('order_code'); }
            else{ 
                $order_code = uniqueRandomInt('payments','order_code',11111111000,99999999999);
                $data->order_code = $order_code;
            }
            if($request->has('allowed_card')) $data->allowed_card = $request->input('allowed_card');
            if($request->has('payer_mobile')) $data->payer_mobile = $request->input('payer_mobile');
            if($request->has('payer_email')) $data->payer_email = $request->input('payer_email');
            if($request->has('payer_description')) $data->payer_description = $request->input('payer_description');
            $data->save();
            
            switch($request->input('gateway')){
                case 'NovinoPay':
                    $gateway = new Novinopay;
                    $gateway->createPayment($data);
                    break;
                case 'NovinPal':
                    $gateway = new NovinPal;
                    $gateway->createPayment($data);
                    break;
                case 'Zibal':
                    $gateway = new Zibal;
                    $gateway->createPayment($data);
                    break;
                case 'Parspal':
                    $gateway = new Parspal;
                    $gateway->createPayment($data);
                    break;
                case 'Aqayepardakht':
                    $gateway = new Aqayepardakht;
                    $gateway->createPayment($data);
                    break;
                case 'Zarinpal':
                    $gateway = new Zarinpal;
                    $gateway->createPayment($data);
                    break;
                default:
                    $gateway = new Novinopay;
                    $gateway->createPayment($data);
                    break;
            }
        }else{
            $merchants = Merchant::get();
            return view('payment-system',['merchants'=>$merchants]);
        }
    }
    private function goToGateWay($request){
        if(
            $request->has('merchant') && 
            $request->has('amount') && 
            $request->has('gateway') && 
            $request->has('currency') && 
            $request->has('callback_url'))
        {
            if(Merchant::where('merchant',$request->input('merchant'))->where('status',1)->first()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

}