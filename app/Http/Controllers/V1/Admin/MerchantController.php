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

use App\Models\Merchant;
use App\Models\User;

class MerchantController extends Controller{
    
    public function __construct(){
    }

    public function getAll(Request $request){
        self::checkAccessLevel(0);
        $data = SearchFilter::apply($request, new Merchant, 'all');
        $users = User::get();
        return $this->getView('merchants',['data'=> $data, 'users'=>$users]);
    }
    
    public function get(Request $request, $id){
        self::checkAccessLevel(0);
        $editData = Merchant::findOrFail($id);
        $data = SearchFilter::apply($request, new Merchant, 'all');
        $users = User::get();
        return $this->getView('merchants',['data'=> $data, 'editData'=> $editData, 'id' => $id, 'users'=>$users]);
    }

    public function store(Request $request){
        self::checkAccessLevel(0);
        try{
            $data = new Merchant;
            if($request->has('name'))$data->name = $request->input('name');
            if($request->has('url'))$data->url = $request->input('url');
            if($request->has('merchant'))$data->merchant = $request->input('merchant');
            else $data->merchant = freeMerchant();
            if($request->has('user_id'))$data->user_id = $request->input('user_id');
            if($request->has('status'))$data->status = $request->input('status');
            
            $data->save();
            return redirect()->route('admin.merchants')->with('success', __(':name با موفقیت افزوده شد.',['name'=>'پایانه']));
        }catch(\Exception $e){
            return redirect()->route('admin.merchants')->with('error', __('خطایی در افزودن :name رخ داد مجدد سعی نمایید..',['name'=>'پایانه']));
        }
    }
    
    public function update(Request $request ,$id = 0){
        self::checkAccessLevel(0);
        try{
            $data = Merchant::findOrfail($id);
            if($request->has('name'))$data->name = $request->input('name');
            if($request->has('url'))$data->url = $request->input('url');
            if($request->has('merchant'))$data->merchant = $request->input('merchant');
            else if($data->merchant == null){$data->merchant = freeMerchant();}
            if($request->has('user_id'))$data->user_id = $request->input('user_id');
            if($request->has('status'))$data->status = $request->input('status');
            $data->save();
            return redirect()->route('admin.merchants')->with('success', __(':name با موفقیت ویرایش شد.',['name'=>'پایانه']));
        }catch(\Exception $e){
            return redirect()->route('admin.merchants')->with('error', __('خطایی در ویرایش :name رخ داد مجدد سعی نمایید.',['name'=>'پایانه']));
        }
    }

    public function destroy($id = 0){
        self::checkAccessLevel(0);
        try{
            $data = Merchant::findOrfail($id);
            $data->delete();
            return redirect()->route('admin.merchants')->with('success', __(':name با موفقیت حذف شد.',['name'=>'پایانه']));
        }catch(\Exception $e){
            return redirect()->route('admin.merchants')->with('error', __('خطایی در حذف :name رخ داد مجدد سعی نمایید.',['name'=>'پایانه']));
        }
    }
}