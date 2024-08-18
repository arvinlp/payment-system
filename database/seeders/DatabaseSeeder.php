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
            'fname' => 'Arvin',
            'lname' => 'Loripour',
            'nickname' => 'Arvinlp',
            'mobile' => '9373678851',
            'email' => 'info@example.com',
            'type' => 'staff',
            'access_level' => 0,
            'status' => 1,
        ]);
        Merchant::create([
            'user_id' => 1,
            'name' => 'Arvinlp',
            'merchant' => rand(10000000000,100000000000),
            'url' => 'arvinlp.ir',
            'status' => 1,
        ]);
    }
}
