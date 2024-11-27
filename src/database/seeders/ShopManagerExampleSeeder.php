<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class ShopManagerExampleSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'ShopManager-example',
            'email' => 'ShopManager@example.com',
            'password' => Hash::make('ShopManagerpassword'), // 必要に応じて変更
            'is_shop_manager' => true, // 店舗代表者フラグをtrueに設定
            'email_verified_at' => Carbon::now(), // メール認証済みにする
        ]);
    }
}