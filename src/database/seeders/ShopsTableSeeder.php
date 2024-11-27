<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('shops')->insert([
            [
                'name' => '仙人',
                'region_id' => 1,
                'genre_id' => 1,
                'description' => '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別なお食事、ビジネス接待まで気軽に使用することができます。',
                'image' => 'shops/sushi.jpg',
            ],
            [
                'name' => '牛助',
                'region_id' => 2,
                'genre_id' => 2,
                'description' => '焼肉業界で20年間経験を積み、肉を熟知したマスターによる究極の焼肉店。長年の実績と討合会をもとに、なかなか味わえない最高の肉を堪能していただけます。また、ゆったりとくつろげる空間はお子様連れでも安心してご利用いただけます。',
                'image' => 'shops/yakiniku.jpg',
            ],
            [
                'name' => '戦慄',
                'region_id' => 3,
                'genre_id' => 5,
                'description' => '気軽に立ち寄れる懐かしの大衆居酒屋です。キンキンに冷えたビールを、なんと199円で。鳥からあげ込みや目玉商品で100000本突破の名物料理です。仕事帰りに是非お試しください。',
                'image' => 'shops/izakaya.jpg',
            ],
            [
                'name' => 'ルーク',
                'region_id' => 1,
                'genre_id' => 3,
                'description' => '都会の喧騒を忘れさせる、古民家を改装した落ち着いたイタリアン。イタリアンシェフの本格料理と厳選されたワインを楽しめるお店です。',
                'image' => 'shops/italian.jpg',
            ],
            [
                'name' => 'らーめん極み',
                'region_id' => 2,
                'genre_id' => 4,
                'description' => '一杯一杯を心を込めて職人が作っております。味付けは少し濃いめで、食べてすぐに癖になる一品です。',
                'image' => 'shops/ramen.jpg',
            ],
            [
                'name' => '香',
                'region_id' => 1,
                'genre_id' => 2,
                'description' => '大小さまざまなお部屋をご用意しております。デートや接待、記念日や誕生日など特別な日にご利用いただけます。',
                'image' => 'shops/yakiniku.jpg',
            ],
            [
                'name' => 'JJ',
                'region_id' => 2,
                'genre_id' => 3,
                'description' => 'イタリア製ピザ窯で焼き上げた極薄のクリスピーピザ。厳選されたワインと一緒にお楽しみいただけます。',
                'image' => 'shops/italian.jpg',
            ],
            [
                'name' => 'らーめん極み',
                'region_id' => 2,
                'genre_id' => 4,
                'description' => '一杯一杯心を込めて職人が作っております。濃厚なスープが絶品です。',
                'image' => 'shops/ramen.jpg',
            ],
            [
                'name' => '鳥雨',
                'region_id' => 2,
                'genre_id' => 5,
                'description' => '備長炭で焼き上げた焼き鳥は絶品です。居心地の良い空間でゆっくりとお楽しみください。',
                'image' => 'shops/izakaya.jpg',
            ],
            [
                'name' => '築地色合',
                'region_id' => 1,
                'genre_id' => 1,
                'description' => '職人技が光るお寿司を提供しています。素材の味を生かした握りが人気のお店です。',
                'image' => 'shops/sushi.jpg',
            ],
            [
                'name' => '晴海',
                'region_id' => 2,
                'genre_id' => 2,
                'description' => '毎年チャンピオン牛を買い付けており、最高級の和牛を提供しています。',
                'image' => 'shops/yakiniku.jpg',
            ],
            [
                'name' => '三子',
                'region_id' => 3,
                'genre_id' => 2,
                'description' => '最高級の美味しいお肉を贅沢に楽しめる焼肉店です。',
                'image' => 'shops/yakiniku.jpg',
            ],
            [
                'name' => '八戒',
                'region_id' => 1,
                'genre_id' => 5,
                'description' => '当店自慢の鍋や焼き鳥など、お好きなだけ堪能できるプランが人気です。',
                'image' => 'shops/izakaya.jpg',
            ],
            [
                'name' => '福助',
                'region_id' => 2,
                'genre_id' => 1,
                'description' => 'ミシュラン掲載店で、最高級の寿司をお楽しみいただけます。',
                'image' => 'shops/sushi.jpg',
            ],
            [
                'name' => 'ラー北',
                'region_id' => 1,
                'genre_id' => 4,
                'description' => 'あっさりとしたスープが特徴のラーメン屋です。学生やサラリーマンに人気です。',
                'image' => 'shops/ramen.jpg',
            ],
            [
                'name' => '翔',
                'region_id' => 2,
                'genre_id' => 5,
                'description' => '地元の食材を使った料理が人気の居酒屋。落ち着いた雰囲気が特徴です。',
                'image' => 'shops/izakaya.jpg',
            ],
            [
                'name' => '経緯',
                'region_id' => 1,
                'genre_id' => 1,
                'description' => '江戸前寿司を楽しめる老舗寿司店。こだわりのネタと技術が自慢です。',
                'image' => 'shops/sushi.jpg',
            ],
            [
                'name' => '漆',
                'region_id' => 1,
                'genre_id' => 2,
                'description' => '特選黒毛和牛を贅沢に使用した焼肉を提供する高級店です。',
                'image' => 'shops/yakiniku.jpg',
            ],
            [
                'name' => 'THE TOOL',
                'region_id' => 3,
                'genre_id' => 3,
                'description' => '非日常を感じさせるお洒落な空間で、厳選されたワインと共に楽しむ本格イタリアン。',
                'image' => 'shops/italian.jpg',
            ],
            [
                'name' => '木船',
                'region_id' => 2,
                'genre_id' => 1,
                'description' => '厳選された新鮮なネタと職人技で作る寿司が自慢のお店です。',
                'image' => 'shops/sushi.jpg',
            ],
        ]);
    }
}