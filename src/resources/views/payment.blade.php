@extends('layouts.app')

@section('content')
<div class="payment-container">
    <h2>{{ $reservation->shop->name }} の予約支払い</h2>
    <p>コース: {{ $reservation->course_name }}</p>
    <p>価格 (1人あたり): ¥{{ number_format($unitPrice) }}</p> <!-- コースの単価 -->
    <p>人数: {{ $reservation->number_of_people }}人</p>
    <p>総額: ¥{{ number_format($totalPrice) }}</p> <!-- 人数に応じた総額 -->

    <button id="checkout-button">支払いを続ける</button>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');

        document.getElementById('checkout-button').addEventListener('click', function () {
            stripe.redirectToCheckout({
                sessionId: '{{ $sessionId }}'
            }).then(function (result) {
                if (result.error) {
                    alert(result.error.message);
                }
            });
        });
    </script>
</div>
@endsection