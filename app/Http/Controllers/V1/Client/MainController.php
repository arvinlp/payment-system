<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-08-19 13:55:19 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by:   Arvin.Loripour 
 * @Last Modified time: 2024-08-19 13:55:19 
 */

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\V1\BaseController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MainController extends Controller{

    public function index(){
        return redirect()->route('admin.dashboard')->with('message', __('خوش آمدید'));
    }

}