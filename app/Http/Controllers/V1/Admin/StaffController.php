<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-08-19 13:55:07 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by:   Arvin.Loripour 
 * @Last Modified time: 2024-08-19 13:55:07 
 */

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\BaseController as Controller;
use App\Models\User as Staff;
use App\SearchFilters\SearchFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index(Request $request){
        self::checkAccessLevel(0);
        $data = SearchFilter::apply($request, Staff::where('type','staff'),'all');
        return $this->getView('staff.list',['data'=> $data]);
    }
    public function getAllList(Request $request){
        self::checkAccessLevel(0);
        $data = SearchFilter::apply($request, Staff::where('type','staff'),'all');
        return $this->getView('staff.list',['data'=> $data]);
    }
    
    public function create(){
        self::checkAccessLevel(0);
        $staffs = Staff::get();
        return $this->getView('staff.form',['staffs'=>$staffs]);
    }
    
    public function edit($id){
        self::checkAccessLevel(0);
        $data = Staff::findOrFail($id);
        return $this->getView('staff.form',['data'=> $data, 'id'=>$id]);
    }
    
    public function store(Request $request){
        self::checkAccessLevel(0);
        try{
            $data = new Staff;
            $data->nickname = genNickname($request->input('fname'),$request->input('lname'),$request->input('mobile'));
            $data->fname = $request->input('fname');
            $data->lname = $request->input('lname');
            $data->mobile = $request->input('mobile');
            $data->password = Hash::make($request->input('password'));
            $data->access_level = $request->input('access_level');
            $data->type = 'staff';

            if($request->has('status'))$data->status = $request->input('status');
            else $data->status = 0;

            $data->save();
            return redirect()->route('admin.staffs.new')->with('success', __(':name با موفقیت افزوده شد.',['name'=>'کارمند']));
        }catch(\Exception $e){
            return redirect()->route('admin.staffs.new')->with('error', __('خطایی در افزودن :name رخ داد مجدد سعی نمایید.',['name'=>'کارمند']));
        }
    }
    
    public function update(Request $request ,$id = 0){
        self::checkAccessLevel(0);
        try{
            $data = Staff::findOrfail($id);
            $data->nickname = genNickname($request->input('fname'),$request->input('lname'),$request->input('mobile'));
            $data->fname = $request->input('fname');
            $data->lname = $request->input('lname');
            $data->mobile = $request->input('mobile');
            $data->password = Hash::make($request->input('password'));

            if($request->has('status'))$data->status = $request->input('status');
            
            $data->save();
            return redirect()->route('admin.staffs.edit',['id'=>$id])->with('success',__(':name با موفقیت ویرایش شد.',['name'=>'کارمند']));
        }catch(\Exception $e){
            return redirect()->route('admin.staffs.edit')->with('error',__('خطایی در ویرایش :name رخ داد مجدد سعی نمایید.',['name'=>'کارمند']));
        }
    }

    public function destroy($id = 0){
        self::checkAccessLevel(0);
        try{
            $data = Staff::findOrfail($id);
            $data->delete();
            return redirect()->route('admin.staffs')->with('success',__(':name با موفقیت حذف شد.',['name'=>'کارمند']));
        }catch(\Exception $e){
            return redirect()->route('admin.staffs')->with('error',__('خطایی در حذف :name رخ داد مجدد سعی نمایید.',['name'=>'کارمند']));
        }
    }
}
