<!-- resources/views/admin/create_manager.blade.php -->

@extends('layouts.app2')

@section('content')
<link rel="stylesheet" href="{{ asset('css/create_manager.css') }}">

<div class="container">
    <h1>店舗代表者作成</h1>

    <form action="{{ route('admin.storeManager') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="shop_id">店舗名</label>
            <select id="shop_id" name="shop_id" class="form-control" required>
                <option value="">店舗を選択してください</option>
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">代表者名</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>
@endsection