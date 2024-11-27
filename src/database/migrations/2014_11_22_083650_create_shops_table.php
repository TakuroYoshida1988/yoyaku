<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 店舗名
            $table->foreignId('region_id')->constrained()->onDelete('cascade'); // 外部キー：regionsテーブル
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');  // 外部キー：genresテーブル
            $table->text('description'); // 店舗説明
            $table->string('image')->nullable(); // 画像のパス
            $table->foreignId('manager_id')->nullable()->constrained('users')->onDelete('set null'); // 店舗代表者
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shops');
    }
}