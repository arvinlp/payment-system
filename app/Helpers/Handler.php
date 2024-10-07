<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 10:16:37 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-10-07 17:25:04
 */

use App\Models\Merchant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;

function replace_number_fa_en($number)
{
    $number = str_replace("۰", '0', $number);
    $number = str_replace("۱", '1', $number);
    $number = str_replace("۲", '2', $number);
    $number = str_replace("۳", '3', $number);
    $number = str_replace("۴", '4', $number);
    $number = str_replace("۵", '5', $number);
    $number = str_replace("۶", '6', $number);
    $number = str_replace("۷", '7', $number);
    $number = str_replace("۸", '8', $number);
    $number = str_replace("۹", '9', $number);

    return $number;
}

if( ! function_exists('uniqueRandomString') ){
    function uniqueRandomString($table, $col, $chars = 24){
        $unique = false;
        $tested = [];
        do{
            $random = Str::random($chars);
            if( in_array($random, $tested) ){
                continue;
            }
            $count = DB::table($table)->where($col, '=', $random)->count();
            $tested[] = $random;
            if( $count == 0){
                $unique = true;
            }
        }
        while(!$unique);
        return $random;
    }

}
if( ! function_exists('uniqueRandomInt') ){
    function uniqueRandomInt($table, $col, $start, $end){
        $unique = false;
        $tested = [];
        do{
            $random = rand($start, $end);
            if( in_array($random, $tested) ){
                continue;
            }
            $count = DB::table($table)->where($col, '=', $random)->count();
            $tested[] = $random;
            if( $count == 0){
                $unique = true;
            }
        }
        while(!$unique);
        return $random;
    }
}

function getUserLevel($id = 0)
{
    $args = array(
        0 => 'دسترسی کامل',
        1 => 'دسترسی نامشخص',
        2 => 'دسترسی نامشخص',
        3 => 'دسترسی نامشخص',
        4 => 'دسترسی نامشخص',
        5 => 'دسترسی نامشخص',
        6 => 'دسترسی نامشخص',
        7 => 'دسترسی نامشخص',
        8 => 'دسترسی نامشخص',
        9 => 'دسترسی نامشخص',
        10 => 'دسترسی نامشخص',
        11 => 'دسترسی نامشخص'
    );
    $argsBack = $args[$id];
    return $argsBack;
}

function getUserLevels()
{
    $args = array(
        0 => 'دسترسی کامل',
        1 => 'دسترسی نامشخص',
        2 => 'دسترسی نامشخص',
        3 => 'دسترسی نامشخص',
        4 => 'دسترسی نامشخص',
        5 => 'دسترسی نامشخص',
        6 => 'دسترسی نامشخص',
        7 => 'دسترسی نامشخص',
        8 => 'دسترسی نامشخص',
        9 => 'دسترسی نامشخص',
        10 => 'دسترسی نامشخص',
        11 => 'دسترسی نامشخص'
    );
    return $args;
}

/**
 * 
 */
function getUserTypes()
{
    $args = array(
        'staff' => 'کارمند',
        'client' => 'مشتری',
        'reseller' => 'فروشنده'
    );
    return $args;
}
function getUserType($code = 'client')
{
    $args = getUserTypes();
    return $args[$code];
}

/**
 * 
 */
function statusCode()
{
    return array(
        1 => __('فعال'),
        0 => __('غیرفعال'),
    );
}
function status($code)
{
    $args = statusCode();
    return $args[$code];
}

/**
 * 
 */
function userStatusCode()
{
    return array(
        1 => __('فعال'),
        0 => __('غیرفعال'),
        2 => __('مسدود'),
    );
}
function userStatus($code)
{
    $args = userStatusCode();
    return $args[$code];
}

/**
 * 
 */
function alertCode()
{
    return array(
        'primary' => __('پیش فرض'),
        'secondary' => __('ثانویه'),
        'success' => __('موفق'),
        'danger' => __('خطر'),
        'warning' => __('اخطار'),
        'info' => __('اطلاع'),
        'light' => __('روشن'),
        'dark' => __('تیره'),
    );
}
function alert($code)
{
    $args = alertCode();
    return $args[$code];
}

/**
 * 
 */
function paymentStatusColorCode()
{
    return array(
        1 => 'none',
        2 => 'primary',
        3 => 'secondary',
        4 => 'success',
        5 => 'warning',
        6 => 'warning',
        0 => 'info',
        7 => 'light',
        8 => 'dark',
        9 => 'dark',
        -1 => 'danger',
        -2 => 'danger',
        -3 => 'danger',
    );
}
function paymentStatusColor($code)
{
    $args = paymentStatusColorCode();
    return $args[$code] ?? 'none';
}

/**
 * 
 */
function paymentStatusCode()
{
    return array(
        1 => __('پرداخت شده'),
        0 => __('نامشخص'),
        2 => __('در انتظار پرداخت'),
        3 => __('-'),
        4 => __('-'),
        5 => __('-'),
        6 => __('-'),
        7 => __('-'),
        8 => __('-'),
        9 => __('-'),
        -1 => __('پرداخت نشده'),
        -2 => __('لغو شده'),
        -3 => __('-'),
    );
}
function paymentStatus($code)
{
    $args = paymentStatusCode();
    return $args[$code] ?? 'نامشخص';
}

/**
 * 
 */
function currencyLocationCode()
{
    return array(
        1 => __('راست'),
        2 => __('چپ'),
        3 => __('راست با فاصله'),
        4 => __('چپ با فاصله'),
    );
}
function currencyLocation($code)
{
    $args = currencyLocationCode();
    return $args[$code];
}

/**
 * 
 */
function currencyStatusCode()
{
    return array(
        1 => __('فعال'),
        0 => __('غیرفعال'),
        2 => __('پیش فرض')
    );
}
function currencyStatus($code)
{
    $args = currencyStatusCode();
    return $args[$code];
}

/**
 * 
 */
function paymentDriverCode()
{
    return array(
        'local' => __('درگاه تست'),
        'zarinpal' => __('زرین پال'),
        'zibal' => __('زیبال'),
        'aqayepardakht' => __('آقای پرداخت'),
        'nextpay' => __('نکست پی'),
        'payping' => __('پی پینگ'),
        'payir' => __('پی ای ار'),
        'idpay' => __('ای دی پی'),
        'paypal' => __('PayPal'),
        'yekpay' => __('یک پی'),
        'sepordeh' => __('سپرده'),
        'rayanpay' => __('رایان پی'),
        'novinopay' => __('نوینو پی'),
        'novinpal' => __('نوین پال'),
        'parspal' => __('پارس پال'),
        'sizpay' => __('سیزپی'),
        'vandar' => __('vandar'),
        'gooyapay' => __('گویا پی'),
        'fanavacard' => __('فن آوا'),
        'atipay' => __('آتی پی'),
        'asanpardakht' => __('آسان پرداهت'),
        'behpardakht' => __('به پرداخت'),
        'digipay' => __('دیجی پی'),
        'etebarino' => __('اعتباری نو'),
        'irankish' => __('ایران کیش'),
        'jibit' => __('جیب بیت'),
        'omidpay' => __('امید پی'),
        'parsian' => __('پارسیان'),
        'pasargad' => __('پاسارگاد'),
        'paystar' => __('پی استار'),
        'poolam' => __('یولام'),
        'sadad' => __('سدداد'),
        'saman' => __('سامان'),
        'sep' => __('سپه'),
        'sepehr' => __('سپهر'),
        'walleta' => __('walleta'),
        'azki' => __('ازکی'),
        'payfa' => __('پی فا'),
        'toman' => __('تومن'),
        'bitpay' => __('بیت پی'),
        'minipay' => __('minipay'),
        'snapppay' => __('اسنپ پی'),
    );
}
function paymentDriver($code)
{
    if (!isset($code)) return __('نامشخص');
    $args = paymentDriverCode();
    return $args[Str::lower($code)];
}

/**
 * Panel Prefix
 */
function getPrefixLevel()
{
    if(!Auth::check()) return 'client';
    switch (Auth::user()->type) {
        case 'staff':
            return 'admin';
        case 'reseller':
            return 'reseller';
        default:
            return 'client';
    }
}
function getPrefixُTheme()
{
    if(!Auth::check()) return 'client.';
    switch (Auth::user()->type) {
        case 'staff':
            return 'admin.';
        case 'reseller':
            return 'reseller.';
        default:
            return 'client.';
    }
}


/**
 * 
 */
function uuidGenerator()
{
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

/**
 * 
 */
function dateShow($newDate, $format = '%d / %m / %Y')
{
    if (Config::get('app.locale_direction') != 'rtl')
        return \Carbon\Carbon::createFromFormat($format, $newDate)->toDateTimeString();
    else
        return Jalalian::forge($newDate)->format($format);
}
function dateAndTimeShow($newDate, $format = '%d / %B / %Y - H:m:i')
{
    if (Config::get('app.locale_direction') != 'rtl')
        return \Carbon\Carbon::createFromFormat($format, $newDate)->toDateTimeString();
    else
        return Jalalian::forge($newDate)->format($format);
}

/**
 * 
 */
function genNickname($fname = null, $lname = null, $mobile = 0)
{
    $nickname = '';
    if ($fname != null) $nickname .= $fname;
    if ($fname != null && $lname != null) $nickname .= ' ';
    if ($lname != null) $nickname .= $lname;
    if ($fname != null || $lname != null) return $nickname;
    else return $nickname = __('کاربر ') . $mobile;
}
/**
 * 
 */
function freeMerchant()
{
    do {
        $args = rand(101010101010, 919199999919);
    } while (
        Merchant::where('merchant', $args)
        ->first() && $args != 8080
        && $args != 4085
        && $args != 22
        && $args != 21
        && $args != 80
        && $args != 443
        && $args != 443
    );
    return $args;
}

/**
 * 
 */
function priceWithCurrency($price = '', $getCurrency = null)
{
    $defaultCurrency = 1;
    if ($price <= 0) return 'رایگان';
    if ($price == '') return 'رایگان';
    if (Auth::check()) {
        if ($userDefaultCurrency = Auth::user()->currency_id) {
            $defaultCurrency = $userDefaultCurrency;
        }
    } else {
        if ($currency = \App\Models\Currency::where('status', 2)->first()) {
            $defaultCurrency = $currency->id;
        }
    }
    if ($getCurrency != null) {
        $defaultCurrency = $getCurrency;
    }
    $currency = \App\Models\Currency::find($defaultCurrency);
    if ($currency->code == 'IRR') {
        $price *= $currency->exchange;
        $price = number_format($price, 0);
    } elseif ($currency->code == 'IRT') {
        $price = number_format($price, 0);
    } else {
        $price /= $currency->exchange;
        $price = number_format($price, 2);
    }
    switch ($currency->location) {
        case 1:
            return $price . $currency->name;
        case 2:
            return $currency->name . $price;
        case 3:
            return $price . ' ' . $currency->name;
        case 4:
            return $currency->name . ' ' . $price;
        default:
            return $price . $currency->name;
    }
}