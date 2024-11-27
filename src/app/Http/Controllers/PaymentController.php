<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PaymentController extends Controller
{
    public function showPaymentPage(Reservation $reservation)
{
    // StripeのAPIキーを設定
    Stripe::setApiKey(env('STRIPE_SECRET'));

    // コース名に応じて価格を設定
    $coursePrices = [
        '5000円' => 5000,
        '7000円' => 7000,
        '10000円' => 10000,
    ];

    // コース名に基づいてコースの単価を取得
    $unitPrice = $coursePrices[$reservation->course_name] ?? 0;

    // 人数に応じて総額を計算
    $totalPrice = $unitPrice * $reservation->number_of_people;

    // Stripeのチェックアウトセッションを作成
    $session = StripeSession::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'jpy',
                'product_data' => [
                    'name' => $reservation->course_name,
                ],
                'unit_amount' => $totalPrice,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('payment.success', ['reservation' => $reservation->id]),
        'cancel_url' => route('payment.cancel', ['reservation' => $reservation->id]),
    ]);

    // ビューにStripeセッションIDと計算した価格情報を渡す
    return view('payment', [
        'sessionId' => $session->id,
        'reservation' => $reservation,
        'unitPrice' => $unitPrice, // コースの単価
        'totalPrice' => $totalPrice // 人数に応じた総額
    ]);
}

    // 支払い成功時の処理
    public function success(Reservation $reservation)
    {
        $reservation->update(['is_paid' => true]);

        return redirect()->route('complete')->with('success', '支払いが完了しました。');
    }

    // 支払いキャンセル時の処理
    public function cancel(Reservation $reservation)
    {
        return redirect()->route('shops.show', $reservation->shop_id)->with('error', '支払いがキャンセルされました。');
    }
}