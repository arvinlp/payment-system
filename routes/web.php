<?php

use Illuminate\Support\Facades\Route;

Route::match(['get','post'],'/', 'App\Http\Controllers\V1\PaymentController@index');

Route::prefix('payment')->name('payment')->group(function () {
    Route::get('aqayepardakht', 'App\Http\Controllers\V1\Gateway\Aqayepardakht@verifyPayment')->name('.aqayepardakht');
    Route::get('novinopay', 'App\Http\Controllers\V1\Gateway\Novinopay@verifyPayment')->name('.novinopay');
    Route::get('novinpal', 'App\Http\Controllers\V1\Gateway\NovinPal@verifyPayment')->name('.novinpal');
    Route::get('parspal', 'App\Http\Controllers\V1\Gateway\Parspal@verifyPayment')->name('.parspal');
    Route::get('zarinpal', 'App\Http\Controllers\V1\Gateway\Zarinpal@verifyPayment')->name('.zarinpal');
    Route::get('zibal', 'App\Http\Controllers\V1\Gateway\Zibal@verifyPayment')->name('.zibal');
});