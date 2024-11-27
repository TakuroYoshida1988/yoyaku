<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Region;
use App\Models\Genre;

class ManagerController extends Controller
{
    /**
     * 店舗代表者ダッシュボードを表示
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {

        return view('manager.dashboard');
    }

        public function viewReservations()
    {
        $user = Auth::user();

        // 代表者が管理する店舗の予約一覧を取得
        $reservations = Reservation::whereHas('shop', function ($query) use ($user) {
            $query->where('manager_id', $user->id);
        })->with(['shop', 'user'])->get();

        return view('manager.view-reservations', compact('reservations'));
    }

    public function editShop(Request $request)
    {
        $shops = Shop::where('manager_id', auth()->id())->get(); // ログインユーザーが管理する店舗
        $regions = Region::all(); // 全てのリージョン
        $genres = Genre::all(); // 全てのジャンル

        $selectedShop = null;
        if ($request->has('shop_id')) {
            $selectedShop = Shop::where('id', $request->shop_id)
                                ->where('manager_id', auth()->id())
                                ->first(); // 選択された店舗を取得
        }

        return view('manager.edit-shop', compact('shops', 'regions', 'genres', 'selectedShop'));
    }

    public function updateShop(Request $request, $id)
    {
        $shop = Shop::where('id', $id)
                    ->where('manager_id', auth()->id())
                    ->firstOrFail();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'required|string',
        ]);

        // ジャンルIDに応じて画像を設定
        $genreImages = [

            1 => 'shops/sushi.jpg',
            2 => 'shops/yakiniku.jpg',
            3 => 'shops/italian.jpg',
            4 => 'shops/ramen.jpg',
            5 => 'shops/izakaya.jpg',

        ];

        $imagePath = $genreImages[$request->genre_id];

        $shop->update([
            'name' => $validatedData['name'],
            'region_id' => $validatedData['region_id'],
            'genre_id' => $validatedData['genre_id'],
            'description' => $validatedData['description'],
            'image' => $imagePath,
        ]);

        return redirect()->route('manager.dashboard')->with('success', '店舗が編集されました。');

    }
}