<?php

namespace App\Http\Controllers;

use App\Models\Shop;  // Shopモデルをインポート
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Shop::query();

        // リージョンでのフィルタリング
        if ($request->filled('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        // ジャンルでのフィルタリング
        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->genre_id);
        }

        // 店名の部分一致検索
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // フィルタリングした結果を取得
        $shops = $query->get();

        // リージョンとジャンルのリストをビューに渡す
        $regions = Region::all();
        $genres = Genre::all();

        return view('shops.index', compact('shops', 'regions', 'genres'));
    }

    public function show($id)
    {
      $shop = Shop::findOrFail($id);  // お店のIDで詳細を取得
      return view('shops.shop-detail', ['shop' => $shop]);
    }

        // 新規店舗作成画面の表示
    public function create()
    {
        $regions = Region::all();
        $genres = Genre::all();

        return view('manager.create-shop', compact('regions', 'genres'));
    }

    // 新規店舗の保存処理
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'required|string',
        ]);

        // ジャンルに基づいて画像パスを設定
        $genreImages = [

            1 => 'shops/sushi.jpg',
            2 => 'shops/yakiniku.jpg',
            3 => 'shops/italian.jpg',
            4 => 'shops/ramen.jpg',
            5 => 'shops/izakaya.jpg',

        ];

        $imagePath = $genreImages[$request->genre_id];

        // 新規店舗の作成
        $shopData = [
            'name' => $request->name,
            'region_id' => $request->region_id,
            'genre_id' => $request->genre_id,
            'description' => $request->description,
            'image' => $imagePath,
            'manager_id' => Auth::id(), // 現在の店舗代表者を設定
        ];

        $shop = Shop::create($shopData);

        return redirect()->route('manager.dashboard')->with('success', '店舗が作成されました。');
    }
    
}