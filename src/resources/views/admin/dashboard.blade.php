<!-- resources/views/admin/dashboard.blade.php -->

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


<link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">

<div class="container">
     <h1>管理画面</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="button-group">
        <button onclick="window.location.href='{{ route('admin.createManager') }}'">店舗代表者作成</button>
        <button onclick="window.location.href='{{ route('admin.sendEmailForm') }}'">メール送信</button>

         <!-- ログアウトボタン -->
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