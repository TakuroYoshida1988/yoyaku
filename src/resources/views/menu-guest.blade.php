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
            <li><a href="{{ url('/register') }}">Registration</a></li>
            <li><a href="{{ url('/login') }}">Login</a></li>
        </ul>
    </div>
</body>
</html>