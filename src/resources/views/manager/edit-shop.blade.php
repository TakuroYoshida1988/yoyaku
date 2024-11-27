@extends('layouts.app2')

@section('content')
<link rel="stylesheet" href="{{ asset('css/edit-shop.css') }}">

<div class="edit-shop-container">
    <h1>店舗編集</h1>

    {{-- メッセージの表示 --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- リストボックスで管理店舗の選択 --}}
    <form id="select-shop-form" method="GET" action="{{ route('manager.editShop') }}">
        <label for="shop_id">編集する店舗を選択してください:</label>
        <select name="shop_id" id="shop_id" onchange="document.getElementById('select-shop-form').submit()">
            <option value="">-- 店舗を選択 --</option>
            @foreach ($shops as $shop)
                <option value="{{ $shop->id }}" {{ request('shop_id') == $shop->id ? 'selected' : '' }}>
                    {{ $shop->name }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- 編集フォーム --}}
    @if ($selectedShop)
        <form method="POST" action="{{ route('manager.updateShop', $selectedShop->id) }}">
            @csrf
            @method('PUT')

            <label for="name">店舗名:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $selectedShop->name) }}" required>

            <label for="region_id">リージョン:</label>
            <select name="region_id" id="region_id" required>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" {{ $selectedShop->region_id == $region->id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>

            <label for="genre_id">ジャンル:</label>
            <select name="genre_id" id="genre_id" required>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $selectedShop->genre_id == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>

            <label for="description">説明:</label>
            <textarea id="description" name="description" required>{{ old('description', $selectedShop->description) }}</textarea>

            <button type="submit">店舗情報を更新</button>
        </form>
    @endif
</div>
@endsection