@component('mail::message')
# メールアドレスの確認

下記のボタンをクリックして、メールアドレスの確認を行ってください。

@component('mail::button', ['url' => $url])
メールアドレスを確認する
@endcomponent

もしこのアカウントを作成していない場合は、このメールは無視してください。

よろしくお願いします。  
{{ config('app.name') }}
@endcomponent