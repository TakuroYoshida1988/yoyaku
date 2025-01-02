<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use App\Mail\CustomMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

    /**
     * CSVインポートフォームを表示
     */
    public function importCsvForm()
    {
        return view('admin.csv-import');
    }

    /**
     * CSVをインポートして店舗を追加
     */
   public function importCsv(Request $request)
{
    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt|max:2048',
    ]);

    $file = $request->file('csv_file');
    $path = $file->getRealPath();

    // BOM除去処理
    $fileContent = file_get_contents($path);
    $fileContent = preg_replace('/^\xEF\xBB\xBF/', '', $fileContent);
    file_put_contents($path, $fileContent);

    $fileHandle = fopen($path, 'r');

    $lineNumber = 0;
    $errors = [];
    $validRows = [];

    while (($row = fgetcsv($fileHandle)) !== false) {
        $lineNumber++;

        // 必要なカラム数が揃っているか確認
        if (count($row) < 5) {
            $errors[] = "行{$lineNumber} エラー: カラム数が不足しています。5カラム必要です。 （読み込まれた値: " . implode(', ', $row) . "）";
            continue;
        }

        $imageUrl = trim($row[4] ?? '');

        // 画像URLの形式を検証
        if (!filter_var($imageUrl, FILTER_VALIDATE_URL)) {
            $errors[] = "行{$lineNumber} エラー: 画像URLが有効なURLではありません。 （読み込まれた値: " . implode(', ', $row) . "）";
            continue;
        }

        try {
            // 画像をダウンロードして保存
            $imageContents = file_get_contents($imageUrl);
            $imageName = basename(parse_url($imageUrl, PHP_URL_PATH));
            $destinationPath = 'shops/' . $imageName;

            \Storage::disk('public')->put($destinationPath, $imageContents);
            $imageFileName = $destinationPath;
        } catch (\Exception $e) {
            $errors[] = "行{$lineNumber} エラー: 画像のダウンロードまたは保存に失敗しました。詳細: {$e->getMessage()} （読み込まれた値: " . implode(', ', $row) . "）";
            continue;
        }

        // 地域IDとジャンルIDを検証
        $regionId = (int)$row[1];
        $genreId = (int)$row[2];

        $validator = Validator::make([
            '店舗名' => $row[0] ?? null,
            '地域ID' => $regionId,
            'ジャンルID' => $genreId,
            '店舗概要' => $row[3] ?? null,
            '画像ファイル名' => $imageFileName,
        ], [
            '店舗名' => 'required|string|max:50',
            '地域ID' => 'required|integer|exists:regions,id',
            'ジャンルID' => 'required|integer|exists:genres,id',
            '店舗概要' => 'required|string|max:400',
            '画像ファイル名' => ['required', 'regex:/^shops\/.*\.(jpeg|jpg|png)$/i'],
        ]);

        if ($validator->fails()) {
            $errors[] = "行{$lineNumber} エラー: " . implode(', ', $validator->errors()->all()) .
                " （読み込まれた値: " . implode(', ', $row) . "）";
        } else {
            $validRows[] = [
                'name' => $row[0],
                'region_id' => $regionId,
                'genre_id' => $genreId,
                'description' => $row[3],
                'image' => $imageFileName,
            ];
        }
    }

    fclose($fileHandle);

    // エラーがある場合は表示
    if (!empty($errors)) {
        return redirect()->back()->with([
            'csv_errors' => $errors,
        ]);
    }

    // 成功したデータをデータベースに保存
    foreach ($validRows as $validRow) {
        Shop::create($validRow);
    }

    // 成功したデータをセッションに保存して表示
    return redirect()->back()->with([
        'imported_shops' => $validRows,
    ]);
}


}