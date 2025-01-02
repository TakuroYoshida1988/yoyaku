@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/review-edit.css') }}">

<div class="container">
    <h1>口コミを編集</h1>
    <form method="POST" action="{{ route('reviews.update', $review) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="rating">評価</label>
            <select name="rating" id="rating" class="form-control">
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                        {{ $i }} ★
                    </option>
                @endfor
            </select>
            @error('rating')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment" class="form-control">{{ old('comment', $review->comment) }}</textarea>
            @error('comment')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">画像 (任意)</label>
            <input type="file" name="image" id="image" class="form-control">
            @if ($review->image)
                <p>現在の画像:</p>
                <img src="{{ asset('storage/' . $review->image) }}" alt="Review Image" style="max-width: 200px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
    </form>
</div>
@endsection