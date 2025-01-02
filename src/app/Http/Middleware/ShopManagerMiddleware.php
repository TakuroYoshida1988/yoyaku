<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // ユーザーがログインしていて、かつ is_shop_manager フラグが true の場合のみ通過させる
        if (Auth::check() && Auth::user()->is_shop_manager) {
            return $next($request);
        }

        // アクセスを拒否する（例：ホームページやエラーページにリダイレクト）
        return redirect('/')->with('error', '店舗代表者のみアクセス可能です。');
    }
}