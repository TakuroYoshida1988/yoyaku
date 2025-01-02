<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->unsignedBigInteger('shop_id'); // 店舗ID
            $table->unsignedBigInteger('user_id'); // ユーザーID
            $table->tinyInteger('rating'); // 評価（1〜5）
            $table->text('comment'); // コメント
            $table->string('image')->nullable(); // 画像のパス（任意）
            $table->timestamps(); // created_at と updated_at
        });

        // 外部キー制約を追加
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}