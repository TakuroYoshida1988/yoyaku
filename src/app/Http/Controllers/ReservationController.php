<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest; // ReservationRequestをインポート
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request) // ReservationRequestを使用
    {
        // 予約データの作成
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'shop_id' => $request->shop_id,
            'reservation_date' => $request->reservation_date . ' ' . $request->reservation_time,
            'number_of_people' => $request->number_of_people,
            'course_name' => $request->course_name,
        ]);

        // 有料コースの場合、決済ページにリダイレクト
        if (in_array($request->course_name, ['5000円', '7000円', '10000円'])) {
            return redirect()->route('payment', ['reservation' => $reservation->id]);
        }

        // 無料コースの場合、予約完了画面にリダイレクト
        return redirect()->route('complete');
    }

    public function destroy($id)
    {
        $reservation = Reservation::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $reservation->delete();

        return redirect()->route('mypage')->with('success', '予約を削除しました。');
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('shops.edit', compact('reservation'));
    }

    public function update(ReservationRequest $request, $id) // ReservationRequestを使用
    {

        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'reservation_date' => $request->reservation_date . ' ' . $request->reservation_time,
            'number_of_people' => $request->number_of_people,
            'course_name' => $request->course_name,
        ]);

        return redirect()->route('mypage')->with('success', '予約が更新されました。');
    }
}
