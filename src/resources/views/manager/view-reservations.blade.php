<!-- resources/views/manager/view-reservations.blade.php -->
@extends('layouts.app2')

@section('content')

<link rel="stylesheet" href="{{ asset('css/view-reservations.css') }}">

<div class="reservations-container">
    <h1>予約状況一覧</h1>
    <table class="reservations-table">
        <thead>
            <tr>
                <th>店舗名</th>
                <th>予約者名</th>
                <th>予約日</th>
                <th>予約時間</th>
                <th>人数</th>
                <th>コース名</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->shop->name }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('H:i') }}</td>
                    <td>{{ $reservation->number_of_people }}</td>
                    <td>{{ $reservation->course_name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">予約はありません。</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection