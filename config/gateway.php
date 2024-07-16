<?php
/*
 * @Author: Arvin Loripour - ViraEcosystem 
 * @Date: 2024-07-16 12:59:22 
 * Copyright by Arvin Loripour 
 * WebSite : http://www.arvinlp.ir 
 * @Last Modified by: Arvin.Loripour
 * @Last Modified time: 2024-07-16 14:10:50
 */

return [
    'aqayepardakht' => [
        'merchant' => env('AQAYEPARDAKHT_PIN', 'xxxx-xxxx-xxxx-xxxx'),
        'sandbox' => env('AQAYEPARDAKHT_SANDBOX', true),
    ],
    'novinopay' => [
        'merchant' => env('NOVINOPAY_MERCHANT_ID', 'xxxx-xxxx-xxxx-xxxx'),
        'sandbox' => env('NOVINOPAY_SANDBOX', true),
    ],
    'novinpal' => [
        'merchant' => env('NOVINPAL_API_KEY', 'xxxx-xxxx-xxxx-xxxx'),
        'sandbox' => env('NOVINPAL_SANDBOX', true),
    ],
    'parspal' => [
        'merchant' => env('PARSPAL_API_KEY', 'xxxx-xxxx-xxxx-xxxx'),
        'sandbox' => env('PARSPAL_SANDBOX', true),
    ],
    'zarinpal' => [
        'merchant' => env('ZARINPAL_MERCHANT_ID', 'xxxx-xxxx-xxxx-xxxx'),
        'sandbox' => env('ZARINPAL_SANDBOX', true),
    ],
    'zibal' => [
        'merchant' => env('ZIBAL_MERCHANT', 'zibal'),
        'sandbox' => env('ZIBAL_SANDBOX', true),
    ],
];
