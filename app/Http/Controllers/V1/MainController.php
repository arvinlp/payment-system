<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 08:42:41 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-07-16 15:31:16
 */
namespace App\Http\Controllers\V1;

use App\Http\Controllers\V1\BaseController;
use Illuminate\Http\Request;

class MainController extends BaseController{

    public function index(Request $request){
        return self::getWebView('home');
    }

}