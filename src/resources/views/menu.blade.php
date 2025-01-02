<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>
<body>
    <div class="menu-container">
        
        <ul class="menu-list">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>
                <!-- ログアウトはフォームを使用してPOSTリクエストを送信 -->
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </form>
            </li>
            <li><a href="{{ url('/mypage') }}">Mypage</a></li>

                        <!-- 管理者の場合のみ管理画面へのリンクを表示 -->
            @if (auth()->check() && auth()->user()->is_admin)
                <li><a href="{{ route('admin.dashboard') }}">Management</a></li>
            @endif


        </ul>
    </div>
</body>
</html>