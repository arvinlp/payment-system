<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 10:16:37 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-07-16 10:37:49
 */

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
    function uniqueRandomString($table, $col, $chars = 16){
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