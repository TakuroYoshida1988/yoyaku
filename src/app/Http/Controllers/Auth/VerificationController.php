<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class VerificationController extends Controller
{
    use VerifiesEmails;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * メール認証処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request, $id, $hash)
    {

        //dd('Verification method called', $id, $hash);

        // ユーザーを取得
        $user = User::findOrFail($id);

        // ハッシュが正しいか確認
        if (! hash_equals((string) $hash, sha1($user->email))) {
            return Redirect::route('login')->with('error', 'リンクが無効です。');
        }

        // すでに認証済みか確認
        if ($user->hasVerifiedEmail()) {
            return Redirect::route('login')->with('message', 'すでにメール認証が完了しています。');
        }

        // メールを認証済みにする
        $user->markEmailAsVerified();

        // 認証完了後のリダイレクト
        return Redirect::route('login')->with('message', 'メール認証が完了しました。ログインしてください。');
    }
}