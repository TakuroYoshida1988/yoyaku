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

    <style>
        /* ヘッダー内の h1 の文字色を白に設定 */
        header h1 {
            color: white;
        }
    </style>

</head>
<body>
    <header>
        <h1>Rese</h1>
    </header>

    <div class="container">
        @yield('content')  <!-- 各ページの内容がここに挿入されます -->
    </div>

    <footer>
        <p>&copy; 2024 My Laravel App</p>
    </footer>
</body>
</html>