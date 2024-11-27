@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/shop-detail.css') }}">

<div class="shop-detail-container">
    <div class="shop-info">
        <a href="{{ url('/') }}" class="back-btn">&lt; 戻る</a>
        <h2>{{ $shop->name }}</h2>
        <img src="{{ asset('storage/' . $shop->image) }}" alt="{{ $shop->name }}" class="shop-image">
        <p>#{{ $shop->region->name }} #{{ $shop->genre->name }}</p>
        <p>{{ $shop->description }}</p>
    </div>

    @auth
    <div class="reservation-box">
        <h3>予約</h3>

        <!-- 予約フォーム -->
        <form id="reservation-form" method="POST" action="{{ route('reservations.store') }}">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">

            <div class="form-group">
                <label for="date">日付</label>
                <input type="date" id="date" name="reservation_date" class="form-control">
                <!-- バリデーションエラーメッセージを表示 -->
                @error('reservation_date')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="time">時間</label>
                <select id="time" name="reservation_time" class="form-control">
                    <option value="">選択してください</option> <!-- 追加 -->
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
                    <option value="">選択してください</option> <!-- 追加 -->
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
@endsection