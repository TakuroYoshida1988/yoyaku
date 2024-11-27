<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メール認証</title>
</head>
<body>
    <h1>{{ $user->name }} 様</h1>
    <p>以下のリンクをクリックしてメール認証を完了してください。</p>
    <a href="{{ $verificationUrl }}">メール認証リンク</a>
</body>
</html>