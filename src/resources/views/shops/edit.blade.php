@extends('layouts.app')

@section('content')

@php
use Carbon\Carbon;
@endphp

<link rel="stylesheet" href="{{ asset('css/shop-detail.css') }}">

<div class="shop-detail-container">
    <div class="shop-info">
        <h2>{{ $reservation->shop->name }}</h2>
        <img src="{{ asset('storage/' . $reservation->shop->image) }}" alt="{{ $reservation->shop->name }}" class="shop-image">
        <p>#{{ $reservation->shop->region->name }} #{{ $reservation->shop->genre->name }}</p>
        <p>{{ $reservation->shop->description }}</p>
    </div>

    <div class="reservation-box">
        <h3>予約変更</h3>

        <!-- 予約変更フォーム -->
        <form method="POST" action="{{ route('reservations.update', $reservation->id) }}">
            @csrf
            @method('PUT')

            <input type="hidden" name="shop_id" value="{{ $reservation->shop->id }}">

            <div class="form-group">
                <label for="date">日付</label>
                <input type="date" id="date" name="reservation_date" class="form-control" value="{{ Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}">
                @error('reservation_date')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="time">時間</label>
                <select id="time" name="reservation_time" class="form-control">
                    <option value="17:00" {{ Carbon::parse($reservation->reservation_date)->format('H:i') == '17:00' ? 'selected' : '' }}>17:00</option>
                    <option value="18:00" {{ Carbon::parse($reservation->reservation_date)->format('H:i') == '18:00' ? 'selected' : '' }}>18:00</option>
                    <option value="19:00" {{ Carbon::parse($reservation->reservation_date)->format('H:i') == '19:00' ? 'selected' : '' }}>19:00</option>
                    <option value="20:00" {{ Carbon::parse($reservation->reservation_date)->format('H:i') == '20:00' ? 'selected' : '' }}>20:00</option>
                    <option value="21:00" {{ Carbon::parse($reservation->reservation_date)->format('H:i') == '21:00' ? 'selected' : '' }}>21:00</option>
                    <option value="22:00" {{ Carbon::parse($reservation->reservation_date)->format('H:i') == '22:00' ? 'selected' : '' }}>22:00</option>
                </select>
                @error('reservation_time')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="number">人数</label>
                <select id="number" name="number_of_people" class="form-control">
                    <option value="1" {{ $reservation->number_of_people == 1 ? 'selected' : '' }}>1人</option>
                    <option value="2" {{ $reservation->number_of_people == 2 ? 'selected' : '' }}>2人</option>
                    <option value="3" {{ $reservation->number_of_people == 3 ? 'selected' : '' }}>3人</option>
                    <option value="4" {{ $reservation->number_of_people == 4 ? 'selected' : '' }}>4人</option>
                </select>
                @error('number_of_people')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="course">コース</label>
                <select id="course" name="course_name" class="form-control">
                    <option value="なし" {{ $reservation->course_name == 'なし' ? 'selected' : '' }}>設定なし</option>
                    <option value="5000円" {{ $reservation->course_name == '5000円' ? 'selected' : '' }}>5000円コース</option>
                    <option value="7000円" {{ $reservation->course_name == '7000円' ? 'selected' : '' }}>7000円コース</option>
                    <option value="10000円" {{ $reservation->course_name == '10000円' ? 'selected' : '' }}>10000円コース</option>
                </select>
                @error('course_name')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-reserve">予約を変更</button>
        </form>
    </div>
</div>
@endsection