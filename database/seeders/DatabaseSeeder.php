<?php

namespace Database\Seeders;

use App\Models\Gateway;
use App\Models\Merchant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'fname' => 'آروین',
            'lname' => 'لری پور',
            'nickname' => 'آروین لری پور',
            'mobile' => '09000000000',
            'email' => 'info@example.com',
            'type' => 'staff',
            'access_level' => 0,
            'status' => 1,
        ]);
        Merchant::create([
            'user_id' => 1,
            'name' => 'آروین لری پور',
            'merchant' => rand(10000000000,100000000000),
            'url' => 'arvinlp.ir',
            'status' => 1,
        ]);
        Gateway::create([
            'name' => 'YekPay',
            'url' => 'example.com',
            'merchant' => 'xxxx-xxxx-xxxx-xxxx',
            'status' => 1,
        ]);
        Gateway::create([
            'name' => 'NovinPal',
            'url' => 'example.com',
            'merchant' => 'xxxx-xxxx-xxxx-xxxx',
            'status' => 1,
        ]);
        Gateway::create([
            'name' => 'NovinoPay',
            'url' => 'example.com',
            'merchant' => 'xxxx-xxxx-xxxx-xxxx',
            'status' => 1,
        ]);
        Gateway::create([
            'name' => 'NextPay',
            'url' => 'example.com',
            'merchant' => 'xxxx-xxxx-xxxx-xxxx',
            'status' => 1,
        ]);
        Gateway::create([
            'name' => 'Aqaypardakht',
            'url' => 'example.com',
            'merchant' => 'xxxx-xxxx-xxxx-xxxx',
            'status' => 1,
        ]);
        Gateway::create([
            'name' => 'IdPay',
            'url' => 'example.com',
            'merchant' => 'xxxx-xxxx-xxxx-xxxx',
            'status' => 1,
        ]);
        Gateway::create([
            'name' => 'Pay',
            'url' => 'example.com',
            'merchant' => 'xxxx-xxxx-xxxx-xxxx',
            'status' => 1,
        ]);
        Gateway::create([
            'name' => 'ParsPal',
            'url' => 'example.com',
            'merchant' => 'xxxx-xxxx-xxxx-xxxx',
            'status' => 1,
        ]);
        Gateway::create([
            'name' => 'Zarinpal',
            'url' => 'example.com',
            'merchant' => 'xxxx-xxxx-xxxx-xxxx',
            'status' => 1,
        ]);
        Gateway::create([
            'name' => 'Zibal',
            'url' => 'example.com',
            'merchant' => 'zibal',
            'status' => 1,
        ]);
    }
}
