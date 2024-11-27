<!-- resources/views/manager/create-shop.blade.php -->

@extends('layouts.app2')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manager-create-shop.css') }}">

<div class="create-shop-container">
    <h1>新規店舗作成</h1>
    <form method="POST" action="{{ route('manager.storeShop') }}">
        @csrf
        <div class="form-group">
            <label for="name">店舗名</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="region_id">リージョン</label>
            <select id="region_id" name="region_id" required>
                <option value="">選択してください</option>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
            @error('region_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="genre_id">ジャンル</label>
            <select id="genre_id" name="genre_id" required>
                <option value="">選択してください</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
            @error('genre_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">説明</label>
            <textarea id="description" name="description" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="submit-button">作成</button>
    </form>
</div>
@endsection