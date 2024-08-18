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

Route::get('/', 'MainController@index');
Route::get('/dashboard', 'MainController@dashboard')->name('dashboard');
Route::get('/profile', 'MainController@profile')->name('profile');
Route::post('/profile', 'MainController@profileUpdate');

//
Route::get('/user/{id}', 'MainController@userLevel')->name('user.change');
Route::post('/user/{id}', 'MainController@userLevelUpdate');

Route::group(['prefix' => 'staffs'], function () {
    Route::get('/',         'StaffController@index')->name('staffs');
    Route::get('/new',      'StaffController@create')->name('staffs.new');
    Route::post('/new',     'StaffController@store');
    Route::get('/{id}',     'StaffController@edit')->name('staffs.edit');
    Route::post('/{id}',    'StaffController@update');
    Route::delete('/{id}',  'StaffController@destroy')->name('staffs.delete');
});

Route::group(['prefix' => 'clients'], function () {
    Route::get('/',         'ClientController@index')->name('clients');
    Route::get('/new',      'ClientController@create')->name('clients.new');
    Route::post('/new',     'ClientController@store');
    Route::get('/{id}',     'ClientController@edit')->name('clients.edit');
    Route::post('/{id}',    'ClientController@update');
    Route::delete('/{id}',  'ClientController@destroy')->name('clients.delete');
});

Route::group(['prefix'=>'merchants'],function (){
    Route::get('/', 'MerchantController@getAll')->name('merchants');
    Route::post('/new', 'MerchantController@store')->name('merchants.new');
    Route::get('/{id}', 'MerchantController@get')->name('merchants.edit');
    Route::post('/{id}', 'MerchantController@update');
    Route::delete('/{id}', 'MerchantController@destroy')->name('merchants.delete');
});

Route::group(['prefix'=>'gatewayes'],function (){
    Route::get('/', 'GatewayController@getAll')->name('gatewayes');
    Route::post('/new', 'GatewayController@store')->name('gatewayes.new');
    Route::get('/{id}', 'GatewayController@get')->name('gatewayes.edit');
    Route::post('/{id}', 'GatewayController@update');
    Route::delete('/{id}', 'GatewayController@destroy')->name('gatewayes.delete');
});

Route::group(['prefix'=>'notifications'],function (){
    Route::get('/', 'NotificationController@getAll')->name('notifications');
    Route::post('/new', 'NotificationController@create')->name('notifications.new');
    Route::post('/{id}', 'NotificationController@store');
    Route::get('/{id}', 'NotificationController@get')->name('notifications.edit');
    Route::post('/{id}', 'NotificationController@update');
    Route::delete('/{id}', 'NotificationController@destroy')->name('notifications.delete');
});