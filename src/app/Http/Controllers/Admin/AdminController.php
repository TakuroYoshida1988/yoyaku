<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use App\Mail\CustomMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {

        return view('admin.dashboard');

    }

        // メール送信フォームを表示
    public function showSendEmailForm()
    {
        $users = User::all(); // すべてのユーザーを取得
        return view('admin.send-email', compact('users'));
    }

    // メールを送信
    public function sendEmail(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $recipient = User::find($request->recipient_id);
        $subject = $request->subject;
        $content = $request->content;

        // メールを送信
        Mail::to($recipient->email)->send(new CustomMail($subject, $content));

        return redirect()->route('admin.dashboard')->with('success', 'メールを送信しました。');
    }

    public function createManager()
    {
        $shops = Shop::all(); // ショップ情報を取得
        return view('admin.create_manager', compact('shops'));
    }

    public function storeManager(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // ユーザーの作成
        $manager = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now(), // メール確認済みとする
            'is_shop_manager' => true, // 店舗代表者フラグを設定
        ]);

        // ショップの manager_id を更新
        $shop = Shop::find($request->shop_id);
        $shop->manager_id = $manager->id;
        $shop->save();

        return redirect()->route('admin.dashboard')->with('success', '店舗代表者が作成されました。');
    }
}
