<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run()
    {
        DB::table('genres')->insert([
            ['name' => '寿司'],
            ['name' => '焼肉'],
            ['name' => 'イタリアン'],
            ['name' => 'ラーメン'],
            ['name' => '居酒屋'],
        ]);
    }
}