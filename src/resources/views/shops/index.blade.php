@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<div class="shop-container">
    {{-- 検索フォームの追加 --}}
    <form action="{{ route('shops.index') }}" method="GET" class="search-form">

       {{-- ソート用のセレクトボックス --}}
        <select name="sort" class="form-select">
            <option value="">Sort by</option>
            <option value="random" {{ request('sort') == 'random' ? 'selected' : '' }}>ランダム</option>
            <option value="high_rating" {{ request('sort') == 'high_rating' ? 'selected' : '' }}>評価が高い順</option>
            <option value="low_rating" {{ request('sort') == 'low_rating' ? 'selected' : '' }}>評価が低い順</option>
        </select>

        <select name="region_id" class="form-select">
            <option value="">All regions</option>
            @foreach($regions as $region)
                <option value="{{ $region->id }}" {{ request('region_id') == $region->id ? 'selected' : '' }}>
                    {{ $region->name }}
                </option>
            @endforeach
        </select>

        <select name="genre_id" class="form-select">
            <option value="">All genres</option>
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>

        <input type="text" name="search" placeholder="Search by name" value="{{ request('search') }}">

        <button type="submit" class="btn btn-primary">実行</button>
    </form>

    <div class="shop-list">
        {{-- 検索結果の表示 --}}
        @if($shops->isEmpty())
            <p>No shops found.</p>
        @else
            @foreach($shops as $shop)
                @include('components.shop-card', ['shop' => $shop])
            @endforeach
        @endif
    </div>
</div>
@endsection