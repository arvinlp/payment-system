<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'MainController@index')->name('home');
Route::any('/show', 'MainController@show')->name('web.pay');
Route::any('/pay', 'MainController@send')->name('web.pay.send');
Route::any('/pay/verify', 'MainController@verify')->name('web.pay.verify');