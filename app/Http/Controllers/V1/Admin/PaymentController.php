<?php
/*
 * @Author: arvinlp 
 * @Date: 2022-04-17 16:48:37 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-08-17 18:12:20
 */
namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\BaseController as Controller;
use Illuminate\Http\Request;
use App\SearchFilters\SearchFilter;

use App\Models\Payment;

class PaymentController extends Controller{
    
    public function __construct(){
    }

    public function getAll(Request $request){
        self::checkAccessLevel(5);
        $data = SearchFilter::apply($request, Payment::with(['user','merchant']), 'all');
        return $this->getView('payments.list',['data'=> $data]);
    }
    
    public function get(Request $request, $id){
        self::checkAccessLevel(5);
        $editData = Payment::with(['user','merchant'])->findOrFail($id);
        return $this->getView('payments.show',['data'=> $editData]);
    }
}