@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">

    <div class="thanks-container">
        <div class="thanks-box">
            <p>会員登録ありがとうございます。認証メールを送信しました。</p>
            <a href="{{ route('login') }}" class="btn-login">ログインする</a>
        </div>
    </div>
@endsection