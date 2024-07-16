<?php

use Illuminate\Support\Facades\Route;

Route::match(['get','post'],'/', 'App\Http\Controllers\V1\PaymentController@index');

Route::prefix('payment')->name('payment')->group(function () {
    Route::get('novinopay', 'App\Http\Controllers\V1\Gateway\Novinopay@verifyPayment')->name('.novinopay');
});