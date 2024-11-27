@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">

    <div class="mypage-container">
        <h2>{{ Auth::user()->name }}さん</h2>

        <div class="mypage-content">
            <!-- 左側の予約一覧セクション -->
            <div class="reservation-section">
                <h3>予約状況</h3>
                @if($reservations->isEmpty())
                    <p>予約はありません。</p>
                @else
                    @foreach($reservations as $reservation)
                        <div class="reservation-box">
                           <!-- 右上の削除ボタン -->
                          <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="delete-reservation-form">
                             @csrf
                             @method('DELETE')
                            <button type="submit" class="btn-delete">×</button>
                         </form>

                         <p>予約 {{ $loop->iteration }}</p>
                         <p>Shop: {{ $reservation->shop->name }}</p>
                         <p>Date: {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}</p>
                         <p>Time: {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('H:i') }}</p>
                         <p>Number: {{ $reservation->number_of_people }}人</p>

                        <!-- QRコードを表示 -->
                        <div class="qr-code">
                           {!! $reservation->qrCode !!}
                        </div>

                         <!-- QRコード下の中央に予約変更ボタンを配置 -->
                         <div class="button-center">
                             <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn-edit">予約変更</a>
                         </div>
                    </div>
                    @endforeach
                @endif
            </div>

            <!-- 右側のお気に入り店舗セクション -->
            <div class="favorites-section">
                <h3>お気に入り店舗</h3>
                <div class="shop-list">
                    @foreach($favorites as $favorite)
                        @include('components.shop-card', ['shop' => $favorite->shop])
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 来店店舗一覧へのリンクを追加 -->
        <div class="visited-shops-link">
            <a href="visited-shops" class="btn-visited-shops">来店店舗一覧を見る</a>
        </div>
    </div>

    <script>
        // 確認ダイアログを表示するためのJavaScript
        document.querySelectorAll('.delete-reservation-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('本当にこの予約を削除しますか？')) {
                    this.submit();
                }
            });
        });

        
    </script>


@endsection