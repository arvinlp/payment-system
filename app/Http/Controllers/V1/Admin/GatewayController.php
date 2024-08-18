<?php
/*
 * @Author: arvinlp 
 * @Date: 2022-04-17 16:48:37 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-03-09 21:54:06
 */
namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\BaseController as Controller;
use Illuminate\Http\Request;
use App\SearchFilters\SearchFilter;

use App\Models\Gateway;

class GatewayController extends Controller{
    
    public function __construct(){
    }

    public function getAll(Request $request){
        self::checkAccessLevel(0);
        $data = SearchFilter::apply($request, new Gateway, 'all');
        return $this->getView('currencies',['data'=> $data]);
    }
    
    public function get(Request $request, $id){
        self::checkAccessLevel(0);
        $editData = Gateway::findOrFail($id);
        $data = SearchFilter::apply($request, new Gateway, 'all');
        return $this->getView('currencies',['data'=> $data, 'editData'=> $editData, 'id' => $id]);
    }

    public function store(Request $request){
        self::checkAccessLevel(0);
        try{
            $data = new Gateway;
            if($request->has('code'))$data->code = $request->input('code');
            if($request->has('name'))$data->name = $request->input('name');
            if($request->has('location'))$data->location = $request->input('location');
            if($request->has('exchange'))$data->exchange = $request->input('exchange');
            if($request->has('status'))$data->status = $request->input('status');
            
            $data->save();
            return redirect()->route('admin.currencies')->with('success', __(':name با موفقیت افزوده شد.',['name'=>'کوپن']));
        }catch(\Exception $e){
            return redirect()->route('admin.currencies')->with('error', __('خطایی در افزودن :name رخ داد مجدد سعی نمایید..',['name'=>'کوپن']));
        }
    }
    
    public function update(Request $request ,$id = 0){
        self::checkAccessLevel(0);
        try{
            $data = Gateway::findOrfail($id);
            if($request->has('code'))$data->code = $request->input('code');
            if($request->has('name'))$data->name = $request->input('name');
            if($request->has('location'))$data->location = $request->input('location');
            if($request->has('exchange'))$data->exchange = $request->input('exchange');
            if($request->has('status'))$data->status = $request->input('status');
            $data->save();
            return redirect()->route('admin.currencies')->with('success', __(':name با موفقیت ویرایش شد.',['name'=>'کوپن']));
        }catch(\Exception $e){
            return redirect()->route('admin.currencies')->with('error', __('خطایی در ویرایش :name رخ داد مجدد سعی نمایید.',['name'=>'کوپن']));
        }
    }

    public function destroy($id = 0){
        self::checkAccessLevel(0);
        try{
            $data = Gateway::findOrfail($id);
            $data->delete();
            return redirect()->route('admin.currencies')->with('success', __(':name با موفقیت حذف شد.',['name'=>'کوپن']));
        }catch(\Exception $e){
            return redirect()->route('admin.currencies')->with('error', __('خطایی در حذف :name رخ داد مجدد سعی نمایید.',['name'=>'کوپن']));
        }
    }
}