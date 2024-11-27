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
        <button class="menu-close-btn">×</button>
        <ul class="menu-list">
            <li><a href="{{ url('/') }}">Home</a></li>
            <!-- ログアウトはフォームを使用してPOSTリクエストを送信 -->
            <li>
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </form>
            </li>
            <li><a href="{{ url('/mypage') }}">Mypage</a></li>
        </ul>
    </div>
</body>
</html>