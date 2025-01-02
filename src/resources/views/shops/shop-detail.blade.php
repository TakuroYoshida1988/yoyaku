@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/shop-detail.css') }}">

<div class="shop-detail-container">
    <!-- 左側: 店舗情報 -->
    <div class="shop-info">
        <a href="{{ url('/') }}" class="back-btn">&lt; 戻る</a>
        <h2>{{ $shop->name }}</h2>
        <img src="{{ asset('storage/' . $shop->image) }}" alt="{{ $shop->name }}" class="shop-image">
        <p>#{{ $shop->region->name }} #{{ $shop->genre->name }}</p>
        <p>{{ $shop->description }}</p>

        @auth
        @if (!auth()->user()->is_admin) {{-- 管理者ではない場合のみ表示 --}}
            <div class="review-button">
                <a href="{{ route('reviews.create', ['shop' => $shop->id]) }}" class="btn-review">口コミを投稿する</a>
            </div>
        @endif
    @endauth
    </div>

    <!-- 右側: 予約ボックス -->
    @auth
    <div class="reservation-box">
        <h3>予約</h3>
        <form id="reservation-form" method="POST" action="{{ route('reservations.store') }}">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">

            <div class="form-group">
                <label for="date">日付</label>
                <input type="date" id="date" name="reservation_date" class="form-control">
                @error('reservation_date')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="time">時間</label>
                <select id="time" name="reservation_time" class="form-control">
                    <option value="">選択してください</option>
                    <option value="17:00">17:00</option>
                    <option value="18:00">18:00</option>
                    <option value="19:00">19:00</option>
                    <option value="20:00">20:00</option>
                    <option value="21:00">21:00</option>
                    <option value="22:00">22:00</option>
                </select>
                @error('reservation_time')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="number">人数</label>
                <select id="number" name="number_of_people" class="form-control">
                    <option value="">選択してください</option>
                    <option value="1">1人</option>
                    <option value="2">2人</option>
                    <option value="3">3人</option>
                    <option value="4">4人</option>
                </select>
                @error('number_of_people')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="course">コース</label>
                <select id="course" name="course_name" class="form-control">
                    <option value="なし">設定なし</option>
                    <option value="5000円">5000円コース</option>
                    <option value="7000円">7000円コース</option>
                    <option value="10000円">10000円コース</option>
                </select>
                @error('course_name')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="reservation-summary">
                <p>Shop: {{ $shop->name }}</p>
                <p>Date: <span id="summary-date">選択してください</span></p>
                <p>Time: <span id="summary-time">選択してください</span></p>
                <p>Number: <span id="summary-number">選択してください</span></p>
                <p>Course: <span id="summary-course">設定なし</span></p>
            </div>

            <button type="submit" class="btn-reserve">予約する</button>
        </form>
    </div>
    @endauth
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        const timeInput = document.getElementById('time');
        const numberInput = document.getElementById('number');
        const courseInput = document.getElementById('course');
        const summaryDate = document.getElementById('summary-date');
        const summaryTime = document.getElementById('summary-time');
        const summaryNumber = document.getElementById('summary-number');
        const summaryCourse = document.getElementById('summary-course');

        dateInput.addEventListener('change', function() {
            summaryDate.textContent = dateInput.value || '選択してください';
        });

        timeInput.addEventListener('change', function() {
            summaryTime.textContent = timeInput.value || '選択してください';
        });

        numberInput.addEventListener('change', function() {
            summaryNumber.textContent = numberInput.value || '選択してください';
        });

        courseInput.addEventListener('change', function() {
            summaryCourse.textContent = courseInput.value || '設定なし';
        });
    });
</script>

<!-- 下部: 口コミ部分 -->
<div class="reviews-container">
    <h3>投稿された口コミ</h3>
    @forelse ($reviews as $review)
        <div class="review-card">
            <p class="review-user"><strong>{{ $review->user->name }}</strong> さんより</p>
            <div class="review-rating">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $review->rating)
                        <span>&#9733;</span>
                    @else
                        <span>&#9734;</span>
                    @endif
                @endfor
            </div>
            <div class="review-content">
                <p>{{ $review->comment }}</p>
            </div>
            @if ($review->image)
                <div class="review-image">
                    <img src="{{ asset('storage/' . $review->image) }}" alt="Review Image">
                </div>
            @endif

            <!-- 編集・削除ボタンの表示 -->
            @auth
            <div class="review-actions">
                @if (auth()->id() === $review->user_id)
                    <a href="{{ route('reviews.edit', $review) }}" class="btn btn-warning">口コミを編集</a>
                @endif

                @if (auth()->check() && (auth()->user()->is_admin || auth()->id() === $review->user_id))
                    <form method="POST" action="{{ route('reviews.destroy', $review) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">口コミを削除</button>
                    </form>
                @endif
            </div>
            @endauth
        </div>
    @empty
        <p>まだ口コミは投稿されていません。</p>
    @endforelse
</div>
@endsection
