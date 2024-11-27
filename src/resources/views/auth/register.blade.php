@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

    <div class="register-container">
        <div class="register-box">
            <h2>Registration</h2>
            <form method="POST" action="{{ route('register') }}" novalidate>
                @csrf
                <div class="input-group">
                    <label for="name">
                        <i class="fas fa-user"></i>
                    </label>
                    <input type="text" id="name" name="name" placeholder="Username" value="{{ old('name') }}">
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
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
                <div class="input-group">
                    <label for="password_confirmation">
                        <i class="fas fa-lock"></i>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn-register">登録</button>
            </form>
        </div>
    </div>
@endsection