<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminpassword'), // 必要に応じて変更
            'is_admin' => true, // 管理者フラグをtrueに設定
            'email_verified_at' => Carbon::now(), // メール認証済みにする
        ]);
    }
}