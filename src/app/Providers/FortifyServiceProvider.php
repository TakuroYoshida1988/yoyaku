<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ログイン画面のカスタマイズ
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // 新規ユーザー登録画面のカスタマイズ
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // ユーザー登録の処理
        Fortify::createUsersUsing(CreateNewUser::class);

        // ログイン時のカスタム認証処理
        Fortify::authenticateUsing(function (LoginRequest $request) {
            
           $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
           ]);

            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                if (is_null($user->email_verified_at)) {
                    session()->flash('error', 'メール認証が完了していません。メールを確認してください。');
                    return null;
                }

                return $user;
            }

            session()->flash('error', 'ログイン情報が正しくありません。');
            return null;
        });


        // ログイン失敗時のエラーメッセージを表示
        Fortify::loginView(function () {
            return view('auth.login', [
                'error' => session('error') // エラーメッセージを表示
            ]);
        });

        // ログイン時のリクエスト制限
        RateLimiter::for('login', function (Request $request) {  
            return Limit::perMinute(10)->by($request->email . $request->ip());
        });
    }
}