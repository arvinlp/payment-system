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

Route::get('/', 'LoginController@loginWithPassShow')->middleware('guest')->name('login');
Route::get('/', 'LoginController@loginWithPassShow')->middleware('guest')->name('login.pass');
Route::post('/', 'LoginController@loginWithPass')->middleware('guest')->name('login.pass.check');

Route::get('/with-code', 'LoginController@loginWithCodeShow')->middleware('guest')->name('login.code');
Route::post('/with-code', 'LoginController@loginWithCode')->middleware('guest')->name('login.code.send');

Route::get('/verify', 'LoginController@verifyShow')->middleware('guest')->name('login.code.verify');
Route::post('/verify', 'LoginController@verify')->middleware('guest')->name('login.code.verify');

Route::get('/verify/resend', 'LoginController@loginWithCode')->middleware('guest')->name('login.code.resend');
Route::post('/verify/resend', 'LoginController@loginWithCode')->middleware('guest');

Route::get('/logout', 'LoginController@logout')->name('logout');
Route::post('/logout', 'LoginController@logout')->name('logout');

Route::get('/forgot-password', 'ForgotPasswordController@index')->middleware('guest')->name('forgot.password');
Route::post('/forgot-password', 'ForgotPasswordController@sendNewPassword')->middleware('guest')->name('forgot.password.check');

Route::get('/active', 'ActiveController@index')->middleware('guest')->name('active');
Route::post('/active', 'ActiveController@activeFunc')->middleware('guest')->name('active.check');
