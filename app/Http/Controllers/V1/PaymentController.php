<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 08:42:41 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-07-16 08:51:43
 */
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller{

    public function index(Request $request){
        if(self::verifyDataStep1($request)){
            
        }else{
            return view('payment-system');
        }
    }
    public function verifyDataStep1($request){
        if(
            $request->has('merchant') && 
            $request->has('amount') && 
            $request->has('gateway') && 
            $request->has('currency') && 
            $request->has('callback_url'))
        {
            return true;
        }else{
            return false;
        }
    }
}