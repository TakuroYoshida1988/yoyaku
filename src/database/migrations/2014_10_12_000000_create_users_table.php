<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ユーザー名
            $table->string('email')->unique(); // メールアドレス
            $table->string('password'); // パスワード
            $table->boolean('is_admin')->default(false); // 管理者フラグ
            $table->boolean('is_shop_manager')->default(false); // 店舗管理者フラグ
            $table->timestamp('email_verified_at')->nullable(); // メール認証日時
            $table->rememberToken();
            $table->timestamps();

            // 文字コード設定
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
