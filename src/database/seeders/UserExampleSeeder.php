<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserExampleSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'User-example',
            'email' => 'User@example.com',
            'password' => Hash::make('Userpassword'), // 必要に応じて変更
            'email_verified_at' => Carbon::now(), // メール認証済みにする
        ]);
    }
}