<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約リマインダー</title>
</head>
<body>
    <p>{{ $reservation->user->name }}さん、</p>
    <p>本日は{{ $reservation->shop->name }}へのご予約日です！</p>
    <p>ご予約内容:</p>
    <ul>
        <li>日時: {{ $reservation->reservation_date }}</li>
        <li>人数: {{ $reservation->number_of_people }}人</li>
    </ul>
    <p>お気をつけてお越しください。</p>
</body>
</html>