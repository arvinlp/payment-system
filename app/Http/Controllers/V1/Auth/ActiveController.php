<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserCode;
use App\Http\Controllers\V1\SMSController;

class ActiveController extends Controller{

    private $sms;
    public function __construct(){
        $this->sms = new SMSController;
    }

    public function index(Request $request){
        if(Auth::check()){
            if(Auth::user()->type == 'user'){
                return redirect()->route('client.dashboard')->with('welcome','خوش آمدید');
            }else{
                return redirect()->route('staff.dashboard')->with('welcome','خوش آمدید');
            }
        }
        $mobile = '';
        if($request->has('mobile'))$mobile = $request->input('mobile');
        return view('auth.active', ['mobile' => $mobile]);
    }

    public function activeFunc(Request $request){
        
        $mobile = replace_number_fa_en((float)$request->input('mobile'));
        $mobile = (float)$mobile;
        if(!self::checkMobile($mobile)){
            return redirect()->route('auth.active',['mobile'=>$mobile])->with('error' , __('شماره موبایل قابل قبول نمی‌باشد !'));
        }
        
        if($message = self::checkUserStatus($mobile)){
            return $message;
        }else{
            return self::resendCode($mobile);
        }
    }

    private function checkMobile($phoneNumber = null){
        if(preg_match('/^(?:98|\+98|0098|0)?9[0-9]{9}$/', $phoneNumber)) {
            return true;
         }else{
            return false;
         }
    }

    public function resendCode($mobile){
        $userInfo = User::where('mobile',$mobile)->first();
        
        $newPassword = self::passwordGenerate();
        $name = $userInfo->nickname;
        $userInfo->password = Hash::make($newPassword);
        $userInfo->status = 1;
        $userInfo->save();
        if(env('APP_ENV') == 'local'){
            return redirect()->route('auth.login.pass',['mobile'=>$mobile])->with('success' , __('گذرواژه جدید : :code',['code' => $newPassword]));
        }else{
            if($this->sms->sendPassword((float)$mobile, $name, $newPassword)){
                return redirect()->route('auth.login.pass',['mobile'=>$mobile])->with('success' , __('گذرواژه جدید برای شما ارسال و حساب کاربری فعال شد.'));
            }else{
                return redirect()->route('auth.active',['mobile'=>$mobile])->with('error' , __('خطای در ارسال رخ داده است !'));
            }
        }

        return view('auth.verify', ['mobile' => $mobile]);
    }

    private function passwordGenerate(){
        $code = random_int(11110,9999999);
        
        return 'smm'.$code;
    }

    private function checkUserStatus($mobile){
        if($userInfo = User::where('mobile',$mobile)->first()){
            switch($userInfo->status){
                case 0:// InActive
                    return null;
                    break;
                case 1:// Active
                    return redirect()->route('auth.login.pass',['mobile'=>$mobile])->with('info' , __('حساب کاربری شما مسدود نمی‌باشد، وارد شوید !'));
                case 2:// Banned
                    return redirect()->route('auth.login.pass',['mobile'=>$mobile])->with('error' , __('حساب کاربری شما مسدود شده است !'));
                default:
                    return null;
            }
        }else{
            return redirect()->route('auth.login.pass',['mobile'=>$mobile])->with('error' , __('کاربری شما یافت نشد !'));
        }
    }
}
