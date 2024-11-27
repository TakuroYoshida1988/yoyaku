<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser; // CreateNewUserを使用
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        //dd('register'); // ここで止まるか確認

        $userCreator = new CreateNewUser();  // CreateNewUserを呼び出す

        //dd('ユーザー登録成功前'); // ここで止まるか確認

        $userCreator->create($request->all()); // バリデーションとユーザー作成を実行

        //dd('ユーザー登録成功後'); // ここで止まるか確認

        return redirect()->route('thanks'); // 成功後にthanksページにリダイレクト
    }
}