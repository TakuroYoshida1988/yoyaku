<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Shop;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;

class MyPageController extends Controller
{
    public function index()
    {
        // ログインしているユーザーを取得
        $user = Auth::user();

        // 現在の時刻
        $now = Carbon::now();

        // ユーザーの予約リストを取得 (未来の予約)
        $reservations = Reservation::where('user_id', $user->id)
            ->where('reservation_date', '>', $now)  // 未来の予約のみ
            ->get();

        // ユーザーの来店済み店舗リストを取得 (過去の予約)
        $visitedReservations = Reservation::where('user_id', $user->id)
            ->where('reservation_date', '<=', $now)  // 過去の予約のみ
            ->get();

        // 各予約に対してQRコードを生成
        foreach ($reservations as $reservation) {
            // 予約日付をCarbonインスタンスに変換
            $reservationDate = Carbon::parse($reservation->reservation_date);

            // 店名、日付、時間、人数の情報をQRコードにする
            $qrData = "Shop: " . $reservation->shop->name . "\n" .
                      "Date: " . $reservationDate->format('Y-m-d') . "\n" .
                      "Time: " . $reservationDate->format('H:i') . "\n" .
                      "Number: " . $reservation->number_of_people . "人";

            // QRコードをUTF-8で生成
            $reservation->qrCode = QrCode::encoding('UTF-8')->size(150)->generate($qrData);
        }

        // ユーザーのお気に入りリストを取得
        $favorites = $user->favorites()->with(['shop.reviews'])->get();

        // お気に入り店舗に評価データを設定
        foreach ($favorites as $favorite) {
            $shop = $favorite->shop;
            if ($shop) {
                $shop->average_rating = $shop->reviews->avg('rating') ?: 0; // 平均評価
                $shop->reviews_count = $shop->reviews->count(); // 口コミ件数
            }
        }

        // マイページビューに未来の予約と来店済み店舗リストを渡す
        return view('mypage', compact('reservations', 'visitedReservations', 'favorites'));
    }

    public function visitedShops()
    {
        // ログインしているユーザーを取得
        $user = Auth::user();

        // 現在の時刻
        $now = Carbon::now();

        // ユーザーの来店済み店舗リストを取得 (過去の予約)
        $visitedShops = Reservation::where('user_id', $user->id)
            ->where('reservation_date', '<=', $now)  // 過去の予約のみ
            ->get();

        // 来店店舗一覧ページに渡す
        return view('visited-shops', compact('visitedShops'));
    }
}
