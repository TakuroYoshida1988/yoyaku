<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();


        // すでにお気に入りに追加していないか確認
        if (!$user->favorites()->where('shop_id', $request->shop_id)->exists()) {
            Favorite::create([
                'user_id' => $user->id,
                'shop_id' => $request->shop_id,
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'すでにお気に入りに追加されています']);
    }

    public function destroy($shopId)
    {
        $user = Auth::user();

        // お気に入りに追加されているか確認し、削除
        $favorite = $user->favorites()->where('shop_id', $shopId)->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'お気に入りに登録されていません']);
    }
}
