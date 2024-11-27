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

        <!-- ログイン状態に応じてメニューリンクを切り替え -->
        @if(Auth::check())
            <!-- ログインしている場合 -->
            <a href="{{ url('/menu') }}" class="menu-btn"><i class="fas fa-bars"></i></a>
        @else
            <!-- 非ログイン時の場合 -->
            <a href="{{ url('/menu-guest') }}" class="menu-btn"><i class="fas fa-bars"></i></a>
        @endif
    </header>

    <div class="container">
        @yield('content')  <!-- 各ページの内容がここに挿入されます -->
    </div>

    <footer>
        <p>&copy; 2024 My Laravel App</p>
    </footer>
</body>
</html>