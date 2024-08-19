<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-08-19 13:54:43 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by:   Arvin.Loripour 
 * @Last Modified time: 2024-08-19 13:54:43 
 */

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\BaseController as Controller;
use App\Models\Server;
use App\Models\Subscribe;
use App\Models\User as Client;
use App\SearchFilters\SearchFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index(Request $request){
        $data = SearchFilter::apply($request, Client::whereIn('type',['client','reseller']),'all');
        return $this->getView('client.list',['data'=> $data]);
    }
    public function getAllList(Request $request){
        $data = SearchFilter::apply($request, Client::whereIn('type',['client','reseller']),'all');
        return $this->getView('client.list',['data'=> $data]);
    }
    
    public function create(){
        $clients = Client::get();

        return $this->getView('client.form',['clients'=>$clients]);
    }
    
    public function edit($id){
        $data = Client::findOrFail($id);
        return $this->getView('client.form',['data'=> $data, 'id'=>$id]);
    }
    
    public function store(Request $request){
        try{
            $data = new Client;
            $data->fname = $request->input('fname');
            $data->lname = $request->input('lname');
            
            $data->nickname = genNickname($request->input('fname'),$request->input('lname'),$request->input('mobile'));

            $data->mobile = $request->input('mobile');
            $data->password = Hash::make($request->input('password'));
            $data->access_level = 10;
            $data->type = 'client';

            if($request->has('status'))$data->status = $request->input('status');
            else $data->status = 0;

            $data->save();
            return redirect()->route('admin.clients.new')->with('success',__(':name با موفقیت افزوده شد.',['name'=>'مشتری']));
        }catch(\Exception $e){
            return redirect()->route('admin.clients.new')->with('error',__('خطایی در افزودن :name رخ داد مجدد سعی نمایید.',['name'=>'مشتری']));
        }
    }
    
    public function update(Request $request ,$id = 0){
        try{
            $data = Client::findOrfail($id);
            $data->nickname = genNickname($request->input('fname'),$request->input('lname'),$request->input('mobile'));
            $data->fname = $request->input('fname');
            $data->lname = $request->input('lname');
            $data->mobile = $request->input('mobile');
            $data->password = Hash::make($request->input('password'));

            if($request->has('status'))$data->status = $request->input('status');
            
            $data->save();
            return redirect()->route('admin.clients.edit',['id'=>$id])->with('success',__(':name با موفقیت ویرایش شد.',['name'=>'مشتری']));
        }catch(\Exception $e){
            return redirect()->route('admin.clients.edit')->with('error',__('خطایی در ویرایش :name رخ داد مجدد سعی نمایید.',['name'=>'مشتری']));
        }
    }

    public function destroy($id = 0){
        self::checkAccessLevel(3);
        try{
            $data = Client::findOrfail($id);
            $data->delete();
            return redirect()->route('admin.clients')->with('success',__(':name با موفقیت حذف شد.',['name'=>'مشتری']));
        }catch(\Exception $e){
            return redirect()->route('admin.clients')->with('error',__('خطایی در حذف :name رخ داد مجدد سعی نمایید.',['name'=>'مشتری']));
        }
    }
}
