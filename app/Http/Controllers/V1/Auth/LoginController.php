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

class LoginController extends Controller{

    private $sms;
    public function __construct(){
        $this->sms = new SMSController;
    }

    public function loginWithCodeShow(Request $request){
        if(Auth::check()){
            return self::checkAuth(Auth::user()->type);
        }
        $mobile = '';
        if($request->has('mobile'))$mobile = $request->input('mobile');
        return view('auth.mobile', ['mobile' => $mobile]);
    }

    public function verifyShow(Request $request){
        if(Auth::check()){
            return self::checkAuth(Auth::user()->type);
        }
        $mobile = '';
        if($request->has('mobile'))$mobile = $request->input('mobile');
        return view('auth.verify', ['mobile' => $mobile]);
    }

    public function loginWithPassShow(Request $request){
        if(Auth::check()){
            return self::checkAuth(Auth::user()->type);
        }
        $mobile = '';
        if($request->has('mobile'))$mobile = $request->input('mobile');
        return view('auth.login', ['mobile' => $mobile]);
    }

    public function loginWithPass(Request $request){
        $mobile = replace_number_fa_en((float)$request->input('mobile'));
        $mobile = (float)$mobile;
        $password = replace_number_fa_en($request->input('password'));

        if(!self::checkMobile($mobile)){
            return redirect()->route('auth.login.pass',['mobile'=>$mobile])->with('error' , __('شماره موبایل قابل قبول نمی‌باشد !'));
        }
        if(!$request->has('password')){
            return redirect()->route('auth.login.pass',['mobile'=>$mobile])->with('error' , __('گذرواژه قابل قبول نمی‌باشد !'));
        }
        
        if($message = self::checkUserStatus($mobile)){
            return $message;
        }else{
            if($userInfo= User::where('mobile',$mobile)->first()){
                return self::checkPassword($userInfo, $password, $mobile, 'pass');
            }else{
                return redirect()->route('auth.login.pass.check',['mobile'=>$mobile])->with('error' , __('کاربری شما یافت نشد !'));
            }
        }
    }

    public function loginWithCode(Request $request){
        $mobile = replace_number_fa_en($request->input('mobile'));
        $mobile = (float)$mobile;
        // dd($mobile);
        if(!self::checkMobile($mobile)){
            return redirect()->route('auth.login.code',['mobile'=>$mobile])->with('error' , __('شماره موبایل قابل قبول نمی‌باشد !'));
        }
        
        if($message = self::checkUserStatus($mobile)){
            return $message;
        }else{
            return self::resendCode($mobile);
        }
    }

    public function verify(Request $request){
        $mobile = replace_number_fa_en((float)$request->input('mobile'));
        $mobile = (float)$mobile;
        
        if(!self::checkMobile($mobile)){
            return redirect()->route('auth.login.code',['mobile'=>$mobile])->with('error' , __('شماره موبایل قابل قبول نمی‌باشد !'));
        }

        if($message = self::checkUserStatus($mobile)){
            return $message;
        }else{
            if($request->input('code')){
                $password = replace_number_fa_en($request->input('code'));
                if($userInfo= User::where('mobile',$mobile)->first()){
                    return self::checkPassword($userInfo, $password, $mobile, 'code');
                }else{
                    return redirect()->route('auth.login.code.verify',['mobile'=>$mobile])->with('error' , __('کاربری شما یافت نشد !'));
                }
            }else{
                return redirect()->route('auth.login.code.verify',['mobile'=>$mobile])->with('error' , __('کد یکبار مصرف قابل قبول نمی‌باشد !'));
            }
        }
    }

    public function resendCode($mobile){
        
        if($userInfo = User::where('mobile',$mobile)->first()){
            $code = self::getCode($userInfo->id);
            $name = $userInfo->nickname;
            if(env('APP_ENV') == 'local'){
                return redirect()->route('auth.login.code.verify',['mobile'=>$mobile])->with('success' , __('کد یکبار مصرف :code',['code' => $code]));
            }else{
                if($this->sms->verifyCode((float)$mobile, $name, $code)){
                    return redirect()->route('auth.login.code.verify',['mobile'=>$mobile])->with('success' , __('کد یکبار مصرف برای شما ارسال شد'));
                }else{
                    return redirect()->route('auth.login.code',['mobile'=>$mobile])->with('error' , __('خطایی در ارسال کد یکبار مصرف رخ داده است مجدد سعی نمایید.'));
                }
            }
        }else{
            $nUser = new User;
            $nUser->mobile = $mobile;
            $nUser->user_id = 1;
            $nUser->save();
            if($userInfo = User::where('mobile',$mobile)->first()){
                $code = self::getCode($userInfo->id);
                $name = $userInfo->nickname;
                if($this->sms->verifyCode((float)$mobile, $name, $code)){
                    return redirect()->route('auth.login.code.verify',['mobile'=>$mobile])->with('success' , __('کد یکبار مصرف برای شما ارسال شد'));
                }else{
                    return redirect()->route('auth.login.code',['mobile'=>$mobile])->with('error' , __('خطایی در ارسال کد یکبار مصرف رخ داده است مجدد سعی نمایید.'));
                }
            }
        }

        return view('auth.verify', ['mobile' => $mobile]);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('auth.login.code')->with('success' , __('به امید دیدار مجدد'));
    }

    private function checkMobile($phoneNumber = null){
        if(preg_match('/^(?:98|\+98|0098|0)?9[0-9]{9}$/', $phoneNumber)) {
            return true;
         }else{
            return false;
         }
    }

    private function getCode($userID){
        $code = random_int(11110,99999);
        if(!$userCode = UserCode::where('user_id',$userID)->first()){
            $userCode = new UserCode;
            $userCode->user_id  = $userID;
            $userCode->send     = Carbon::now()->add(30,'minute');
            $userCode->code     = $code;
            $userCode->hcode    = Hash::make($code);
        }else{
            if(Carbon::now()->greaterThan($userCode->send)){
                $userCode->code     = $code;
                $userCode->hcode    = Hash::make($code);
                $userCode->send     = Carbon::now()->add(30,'minute');
            }else{
                $code = $userCode->code;
            }
        }
        $userCode->save();

        return $code;
    }
    
    private function checkPassword($userInfo, $password, $mobile, $loginType = 'pass'){
        if($loginType == 'code'){
            if($code = UserCode::where('user_id',$userInfo->id)->first()){
                if(Carbon::now()->lessThanOrEqualTo($code->send)){
                    if(Hash::check($password,$code->hcode)){
                        $code->delete();
                        Auth::login($userInfo);
                        return self::checkAuth($userInfo->type);
                    }else{
                        return redirect()->route('auth.login.code.verify',['mobile'=>$mobile])->with('error' , __('کد یکبار مصرف قابل قبول نمی‌باشد !'));
                    }
                }else{
                    return redirect()->route('auth.login.code.verify',['mobile'=>$mobile])->with('error' , __('کد یکبار مصرف منقضی شده است !'));
                }
            }else{
                return redirect()->route('auth.login.code',['mobile'=>$mobile])->with('error' , __('خطا ۱۴۰۰۳۳ رخ داده است !'));
            }
        }elseif($loginType == 'pass'){
            if(Hash::check($password,$userInfo->password)){
                Auth::login($userInfo);
                return self::checkAuth($userInfo->type);
            }else{
                return redirect()->route('auth.login.pass',['mobile'=>$mobile])->with('error' , __('گذرواژه صحیح نمی‌باشد !'));
            }
        }else{
            return redirect()->route('auth.login.pass',['mobile'=>$mobile])->with('error' , __('خطایی در سامانه رخ داده است !'));
        }
    }

    private function checkAuth($userType = null){
        if($userType == 'client'){
            return redirect()->route('client.dashboard')->with('welcome', __('خوش آمدید'));
        }else{
            return redirect()->route('admin.dashboard')->with('welcome', __('خوش آمدید'));
        }
    }

    private function checkUserStatus($mobile){
        if($userInfo = User::where('mobile',$mobile)->first()){
            switch($userInfo->status){
                case 0:// InActive
                    return redirect()->route('auth.active',['mobile'=>$mobile])->with('error' , __('حساب کاربری شما غیرفعال شده است !'));
                case 1:// Active
                    return null;
                case 2:// Banned
                    return redirect()->route('auth.login.code',['mobile'=>$mobile])->with('error' , __('حساب کاربری شما مسدود شده است !'));
                default:
                    return null;
            }
        }else{
            return null;
        }
    }
}