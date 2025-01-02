@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/csv-import.css') }}">

<div class="container">
    <h1>CSVで新規店舗を追加</h1>

    <!-- CSVアップロードフォーム -->
    <form action="{{ route('admin.importCsv') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="csv_file">CSVファイルを選択</label>
            <input type="file" name="csv_file" id="csv_file" accept=".csv" required>
        </div>
        @error('csv_file')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">インポート</button>
    </form>

    <!-- インポートエラーの表示 -->
    @if (session('csv_errors'))
    <div class="alert alert-danger mt-4">
        <h4>CSVインポート中に以下のエラーが発生しました:</h4>
        <ol>
            @foreach (session('csv_errors') as $row => $error)
                <li>
                    <strong>行 {{ $row }}:</strong> 
                    @if (is_array($error))
                        {{ implode(', ', $error) }}
                    @else
                        {{ $error }}
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
    @endif

    <!-- インポート成功メッセージ -->
    @if (session('imported_shops'))
        <div class="alert alert-success mt-4">
            <h4>インポート成功！以下の店舗情報が登録されました:</h4>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>店舗名</th>
                        <th>地域ID</th>
                        <th>ジャンルID</th>
                        <th>店舗概要</th>
                        <th>画像ファイル</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (session('imported_shops') as $shop)
                        <tr>
                            <td>{{ $shop['name'] }}</td>
                            <td>{{ $shop['region_id'] }}</td>
                            <td>{{ $shop['genre_id'] }}</td>
                            <td>{{ $shop['description'] }}</td>
                            <td>{{ $shop['image'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- CSV形式の説明 -->
    <div class="csv-format mt-4">
        <h4 class="csv-format-title">インポートできるCSVファイルの形式</h4>
        <p class="csv-format-description">以下の順でデータを記述してください:</p>
        <ul class="csv-format-list">
            <li>店舗名（50文字以内）, 地域ID（下記の対応表を参照）, ジャンルID（下記の対応表を参照）, 店舗概要（400文字以内）, 画像URL</li>
        </ul>

        <div class="csv-tables">
            <div class="csv-table">
                <h5>地域IDの対応表</h5>
                <ul>
                    <li>1: 東京都</li>
                    <li>2: 大阪府</li>
                    <li>3: 福岡県</li>
                </ul>
            </div>

            <div class="csv-table">
                <h5>ジャンルIDの対応表</h5>
                <ul>
                    <li>1: 寿司</li>
                    <li>2: 焼肉</li>
                    <li>3: イタリアン</li>
                    <li>4: 居酒屋</li>
                    <li>5: ラーメン</li>
                </ul>
            </div>
        </div>

        <h5>CSVファイルの例</h5>
        <pre class="csv-example">
A店,1,1,新鮮なネタを使用した寿司を提供します。,https://example.com/images/sushi.jpg
        </pre>
        <p class="text-muted note">※ 1行につき1店舗のデータを記載してください。</p>
    </div>
</div>
@endsection
