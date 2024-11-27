<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // まずジャンルとリージョンのシーダーを呼び出す
        $this->call(GenreSeeder::class);
        $this->call(RegionSeeder::class);
        // その後に、shopsのシーダーを実行
        $this->call(ShopsTableSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(ShopManagerExampleSeeder::class);
        $this->call(UserExampleSeeder::class);
    }
}
