<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Shop;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Shop $shop)
    {
        $shop->average_rating = $shop->reviews->avg('rating') ?: 0;
        $shop->reviews_count = $shop->reviews->count();

        return view('shops.create', compact('shop'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:400',
            'image' => 'nullable|mimes:jpeg,png|max:2048', // JPEG, PNG形式のみ許可、最大2MB
        ]);

        // 現在ログイン中のユーザーIDと投稿対象店舗IDを取得
        $userId = auth()->id();
        $shopId = $request->shop_id;

        // 既存の口コミ件数をカウント
        $existingReviewsCount = \App\Models\Review::where('user_id', $userId)
        ->where('shop_id', $shopId)
        ->count();

         // 口コミが2件以上の場合はエラーを返す
        if ($existingReviewsCount >= 1) {
          return redirect()->back()->withErrors(['message' => '1店舗に対して投稿できる口コミは1件までです。']);
        }

        // レビューを保存
        $review = new Review();
        $review->shop_id = $request->shop_id;
        $review->user_id = auth()->id();
        $review->rating = $request->rating;
        $review->comment = $request->comment;

        // 画像がアップロードされている場合、保存
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('reviews', 'public'); // storage/app/public/reviewsに保存
            $review->image = $path;
        }

        $review->save();

        return redirect()->route('shops.show', ['shop' => $request->shop_id])
            ->with('success', '口コミを投稿しました！');
    }

    public function index()
    {
        $reviews = Review::where('user_id', auth()->id())->latest()->paginate(10);

        return view('reviews.index', compact('reviews'));
    }

    public function edit(Review $review)
    {
        if (auth()->id() !== $review->user_id && !auth()->user()->is_admin) {
            abort(403, '権限がありません');
        }

        return view('shops.reviews-edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        if (auth()->id() !== $review->user_id && !auth()->user()->is_admin) {
            abort(403, '権限がありません');
        }

        // バリデーション
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:400',
            'image' => 'nullable|mimes:jpeg,png|max:2048', // JPEG, PNG形式のみ許可、最大2MB
        ]);

        $review->rating = $request->rating;
        $review->comment = $request->comment;

        // 画像がアップロードされた場合
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('reviews', 'public'); // storage/app/public/reviewsに保存
            $review->image = $path;
        }

        $review->save();

        return redirect()->route('shops.show', ['shop' => $review->shop_id])->with('success', '口コミを更新しました！');
    }

    public function destroy(Review $review)
    {
        if (auth()->id() !== $review->user_id && !auth()->user()->is_admin) {
            abort(403, '権限がありません');
        }

        $shopId = $review->shop_id;
        $review->delete();

        return redirect()->route('shops.show', ['shop' => $shopId])->with('success', '口コミを削除しました！');
    }
}