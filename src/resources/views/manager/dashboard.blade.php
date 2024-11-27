<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel App</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSSファイルの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Font Awesomeの読み込み -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header>
        <h1>Rese</h1>
    </header>


<link rel="stylesheet" href="{{ asset('css/manager-dashboard.css') }}">

<div class="manager-dashboard-container">
    <h1>店舗代表者画面</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="button-group">
        <button class="action-button" onclick="window.location.href='/manager/create-shop'">新規店舗作成</button>
        <button class="action-button" onclick="window.location.href='/manager/edit-shop'">店舗編集</button>
        <button class="action-button" onclick="window.location.href='/manager/view-reservations'">予約状況確認</button>
        
        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: inline;">
                @csrf
                <button type="button" class="action-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト
            </button>
        </form>

    </div>
</div>
    
    <footer>
        <p>&copy; 2024 My Laravel App</p>
    </footer>
</body>
</html>