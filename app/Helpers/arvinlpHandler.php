<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 10:16:37 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-07-16 10:37:49
 */

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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