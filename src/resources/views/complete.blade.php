@extends('layouts.app')

@section('content')
    <div class="thank-you-container">
        <div class="thank-you-box">
            <h2>ご予約ありがとうございます</h2>
            <a href="{{ url('/') }}" class="btn">戻る</a>
        </div>
    </div>
@endsection