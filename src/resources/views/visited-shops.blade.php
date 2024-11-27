@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/visited-shops.css') }}">

    <div class="visited-shops-container">
        <h2>{{ Auth::user()->name }}さんの来店履歴</h2>

        <table class="visited-shops-table">
            <thead>
                <tr>
                    <th>店舗名</th>
                    <th>日付</th>
                    <th>時間</th>
                    <th>来店人数</th>
                    <th>口コミ</th> <!-- 口コミの列を追加 -->
                </tr>
            </thead>
            <tbody>
                @foreach($visitedShops as $reservation)
                    <tr>
                        <td>{{ $reservation->shop->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('H:i') }}</td>
                        <td>{{ $reservation->number_of_people }}人</td>
                        <td>
                            <!-- 口コミボタン -->
                            <button class="review-btn" onclick="openReviewModal('{{ $reservation->shop->name }}')">口コミする</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- モーダルのHTML -->
    <div id="modal" class="modal-overlay">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">×</span>
            <h3>口コミを投稿</h3>
            <p id="shop-name"></p> <!-- 店名を表示 -->
            <label for="rating">評価 (1-5):</label>
            <select id="rating" name="rating">
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
            </select>

            <label for="review">口コミ:</label>
            <textarea id="review" name="review" rows="4" placeholder="口コミを入力してください"></textarea>

            <button type="button" onclick="submitReview()">投稿する</button>
        </div>
    </div>

    <script>
        // モーダルを開く関数
        function openReviewModal(shopName) {
            document.getElementById("shop-name").innerText = shopName + "への口コミ"; // 店名を表示
            document.getElementById("modal").style.display = "flex";
        }

        // モーダルを閉じる関数
        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }

        // 口コミを投稿する（現在はダミー動作）
        function submitReview() {
            alert("口コミを投稿しました！");
            closeModal();
        }
    </script>
@endsection