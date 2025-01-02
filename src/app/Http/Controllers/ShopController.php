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
    $query = Shop::with(['reviews']); // reviewsリレーションを事前ロード

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

            // ソート処理
    if ($request->filled('sort')) {
        if ($request->sort === 'high_rating') {
            // 評価が高い順
            $query->withAvg('reviews', 'rating')
                ->orderByRaw('IFNULL(reviews_avg_rating, 0) DESC') // 平均評価がNULLの場合を0としてソート
                ->orderBy('id'); // 同じ評価の場合はIDで安定ソート
        } elseif ($request->sort === 'low_rating') {
            // 評価が低い順
            $query->withAvg('reviews', 'rating')
                ->orderByRaw('IFNULL(reviews_avg_rating, 100) ASC') // NULLは非常に大きな値として扱う
                ->orderBy('id'); // 同じ評価の場合はIDで安定ソート
        } elseif ($request->sort === 'random') {
            // ランダム
            $query->inRandomOrder();
        }
    }

    // フィルタリングした結果を取得
    $shops = $query->get()->map(function ($shop) {
        // 平均点と口コミ数を計算
        $shop->average_rating = $shop->reviews->avg('rating') ?: 0; // 口コミがない場合は0
        $shop->reviews_count = $shop->reviews->count(); // 口コミ数を計算
        return $shop;
    });

    // リージョンとジャンルのリストをビューに渡す
    $regions = Region::all();
    $genres = Genre::all();

    return view('shops.index', compact('shops', 'regions', 'genres'));
   }

   public function show($id)
   {
    // 指定された店舗の詳細を取得
    $shop = Shop::with('reviews')->findOrFail($id);

    // 店舗に紐づく口コミを取得（ユーザー情報も一緒に取得）
    $reviews = $shop->reviews()->with('user')->latest()->get();

    // 平均★数を計算
    $averageRating = $shop->reviews->avg('rating') ?: 0; // 口コミがない場合は0

    // 店舗詳細ビューにデータを渡す
    return view('shops.shop-detail', [
        'shop' => $shop,
        'reviews' => $reviews,
        'averageRating' => $averageRating, // 平均★数をビューに渡す
    ]);
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