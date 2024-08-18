<?php
/*
 * @Author: arvinlp 
 * @Date: 2022-04-17 16:48:37 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-03-09 21:55:12
 */
namespace App\Http\Controllers\V1\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\SearchFilters\SearchFilter;
use App\Http\Controllers\V1\BaseController as Controller;
use App\Http\Controllers\SMSController;
use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller{

    public function index(Request $request){
        $data = SearchFilter::apply($request, new Notification, 'all');
        return $this->getView('notifications',['data'=> $data]);
    }
    
    public function table(Request $request){
        $data = SearchFilter::apply($request, Notification::where('status',1)->orderBy('updated_at','desc'));
        return $this->getView('notifications-board',['data'=> $data]);
    }
    
    public function getAll(Request $request){
        $data = SearchFilter::apply($request, new Notification, 'all');
        return $this->getView('notifications',['data'=> $data]);
    }
    
    public function get(Request $request, $id){
        self::checkAccessLevel(0);
        $editData = Notification::findOrFail($id);
        $data = SearchFilter::apply($request, new Notification, 'all');
        return $this->getView('notifications',['data'=> $data, 'editData'=> $editData, 'id' => $id]);
    }
    
    public function store(Request $request){
        try{
            $data = new Notification;
            $data->user_id = Auth::user()->id;
            $data->title = $request->input('title');
            $data->content = $request->input('editor');
            $data->type = $request->input('type');
            $data->status = $request->input('status');
            $data->save();
            return redirect()->route('admin.notifications.new')->with('success', __(':name با موفقیت افزوده شد.',['name'=>'اعلان']));
        }catch(\Exception $e){
            return redirect()->route('admin.notifications.new')->with('error', __('خطایی در افزودن :name رخ داد مجدد سعی نمایید.',['name'=>'اعلان']));
        }
    }
    
    public function update(Request $request ,$id = 0){
        self::checkAccessLevel(0);
        try{
            $data = Notification::findOrfail($id);
            $data->title = $request->input('title');
            $data->content = $request->input('editor');
            $data->type = $request->input('type');
            $data->status = $request->input('status');
            $data->save();
            return redirect()->route('admin.notifications.edit',['id'=>$id])->with('success', __(':name با موفقیت ویرایش شد.',['name'=>'اعلان']));
        }catch(\Exception $e){
            return redirect()->route('admin.notifications.edit',['id'=>$id])->with('error', __('خطایی در ویرایش :name رخ داد مجدد سعی نمایید.',['name'=>'اعلان']));
        }
    }

    public function destroy($id = 0){
        self::checkAccessLevel(0);
        try{
            $data = Notification::findOrfail($id);
            $data->delete();
            return redirect()->route('admin.notifications',['id'=>$id])->with('success', __(':name با موفقیت حذف شد.',['name'=>'اعلان']));
        }catch(\Exception $e){
            return redirect()->route('admin.notifications',['id'=>$id])->with('error', __('خطایی در حذف :name رخ داد مجدد سعی نمایید.',['name'=>'اعلان']));
        }
    }
}