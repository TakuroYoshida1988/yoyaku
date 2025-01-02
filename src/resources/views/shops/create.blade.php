@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">

<div class="review-container">
    <!-- 左側: 店舗カード -->
    <div class="shop-card-section">
        @include('components.shop-card', ['shop' => $shop])
    </div>

    <!-- 右側: 口コミフォーム -->
    <div class="review-form-section">

           <!-- 全体のエラーメッセージ表示 -->
        @if ($errors->has('message'))
            <div class="alert alert-danger">
                {{ $errors->first('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('reviews.store') }}" enctype="multipart/form-data" id="review-form">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">

            <div class="form-group">
                <label for="rating">体験を評価してください</label>
                <div class="rating">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                            {{ old('rating') == $i ? 'checked' : '' }}>
                        <label for="star{{ $i }}" class="star">&#9733;</label>
                    @endfor
                </div>
                @error('rating')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="comment">口コミを投稿</label>
                <textarea name="comment" id="comment" placeholder="カジュアルな夜のお出かけにおすすめのスポット" maxlength="400">{{ old('comment') }}</textarea>
                <small>最高文字数 400</small>
                @error('comment')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">画像の追加（jpg、jpeg、png）</label>
                <div id="drop-zone">
                    ここにファイルをドラッグ＆ドロップするか、クリックしてファイルを選択してください
                    <input type="file" name="image" id="image" accept="image/*" style="display: none;">
                </div>
                <p id="file-name" class="file-name" style="display: none;"></p>
                <div id="file-error" class="error-message" style="display: none;"></div>
                @error('image')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">口コミを投稿</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('image');
        const fileNameDisplay = document.getElementById('file-name');
        const fileErrorDisplay = document.getElementById('file-error');

        const allowedExtensions = ['jpg', 'jpeg', 'png']; // 許可される拡張子

        dropZone.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', handleFile);

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });

        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFile();
            }
        });

        function handleFile() {
            const file = fileInput.files[0];
            if (file) {
                const fileName = file.name;
                const fileExtension = fileName.split('.').pop().toLowerCase();

                if (!allowedExtensions.includes(fileExtension)) {
                    fileErrorDisplay.textContent = `無効なファイル形式です。対応形式: ${allowedExtensions.join(', ')}`;
                    fileErrorDisplay.style.display = 'block';
                    fileNameDisplay.style.display = 'none';
                    fileInput.value = ''; // フォームをクリア
                } else if (file.size > 2048 * 1024) {
                    fileErrorDisplay.textContent = 'ファイルサイズは2MB以内にしてください。';
                    fileErrorDisplay.style.display = 'block';
                    fileNameDisplay.style.display = 'none';
                    fileInput.value = ''; // フォームをクリア
                } else {
                    fileNameDisplay.textContent = `選択されたファイル: ${fileName}`;
                    fileNameDisplay.style.display = 'block';
                    fileErrorDisplay.style.display = 'none';
                }
            }
        }
    });
</script>
@endsection
