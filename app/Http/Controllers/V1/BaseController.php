<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-08-19 13:53:53 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by:   Arvin.Loripour 
 * @Last Modified time: 2024-08-19 13:53:53 
 */

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller{

    protected function getView($view = null, $data = [], $mergeData = []){
        $newView = getPrefixLevel().'.'.$view;
        return view($newView, $data, $mergeData);
    }
    protected function getWebView($view = null, $data = [], $mergeData = []){
        $newView = 'web.'.$view;
        return view($newView, $data, $mergeData);
    }

    protected function checkAccessLevel($minNeed = 10){
        $data = Auth::user();
        if($data->access_level > $minNeed){
            abort(403);
        }
    }
}