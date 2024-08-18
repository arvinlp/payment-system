<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\BaseController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserCode;
use App\Http\Controllers\V1\SMSController;
use App\Models\Merchant;
use App\Models\Notification;
use App\Models\UserPayment;
use Illuminate\Support\Facades\DB;

class MainController extends Controller{

    public function index(){
        return redirect()->route('admin.dashboard')->with('message', __('خوش آمدید'));
    }

    public function dashboard(Request $request){
        $countSttafs = User::where('type','staff')->count();
        $countClients = User::where('type','client')->count();
        $countMerchants = Merchant::where('status','1')->count();
        
        $sells2024 = DB::table('payments')
            ->select(
                DB::raw('count(id) as `data`'), 
                DB::raw('count(merchant_id) as `user_count`'), 
                DB::raw('sum(amount) as total_amount'),
                // DB::raw("date_format(updated_at, 'MM-dd-yyyy') as date"),
                DB::raw('YEAR(updated_at) year, MONTH(updated_at) month')
            )
            ->where('updated_at','like','%2024%')
            ->groupby('year','month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        return $this->getView('dashboard',[
            'countSttafs'=>$countSttafs ?? 0,
            'countMerchants'=>$countMerchants ?? 0, 
            'countClients'=>$countClients ?? 0, 
            'sells2024'=>$sells2024
        ]);
    }

    public function profile(){
        $data = Auth::user();
        return $this->getView('profile',['data'=>$data]);
    }

    public function profileUpdate(Request $request){
        try{
            $old = Auth::user();
            $id = $old->id;
            $data = User::findOrfail($id);
            if($request->has('nickname'))$data->nickname = $request->input('nickname');
            else $data->nickname = $request->input('fname').' '.$request->input('lname');
            $data->fname = $request->input('fname');
            $data->lname = $request->input('lname');
            if($request->has('mobile'))$data->mobile = $request->input('mobile');
            if($request->has('password'))$data->password = Hash::make($request->input('password'));
            
            $data->save();
            return redirect()->route('admin.profile',['id'=>$id])->with('success',__(':name با موفقیت ویرایش شد.',['name'=>'پروفایل']));
        }catch(\Exception $e){
            return redirect()->route('admin.profile')->with('error',__('خطایی در ویرایش :name رخ داد مجدد سعی نمایید.',['name'=>'پروفایل']));
        }
    }

    /**
     * 
     */
    public function userLevel($id){
        self::checkAccessLevel(0);
        $data = User::findOrfail($id);
        return $this->getView('level',['data'=>$data]);
    }

    public function userLevelUpdate(Request $request, $id){
        try{
            self::checkAccessLevel(0);
            $data = User::findOrfail($id);

            if($request->has('access_level'))$data->access_level = $request->input('access_level');
            if($request->has('type'))$data->type = $request->input('type');
            
            $data->save();
            return redirect()->route('admin.user.change',['id'=>$id])->with('success',__(':name با موفقیت ویرایش شد.',['name'=>'سطح کاربری']));
        }catch(\Exception $e){
            return redirect()->route('admin.user.change')->with('error',__('خطایی در ویرایش :name رخ داد مجدد سعی نمایید.',['name'=>'سطح کاربری']));
        }
    }
}