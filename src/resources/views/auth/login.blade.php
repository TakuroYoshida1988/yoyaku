@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>

            {{-- エラーメッセージがある場合は表示 --}}
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" novalidate>
               @csrf
                <div class="input-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                    </label>
                    <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                    </label>
                    <input type="password" id="password" name="password" placeholder="Password">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn-login">ログイン</button>
            </form>
        </div>
    </div>
@endsection