# 飲食店予約サービス　Rese（リーズ）
　飲食店を予約するためのアプリです。
飲食店一覧ページにて店舗検索を行えます。
ユーザー登録を行い、ログインすると、飲食店一覧ページから店舗の予約とお気に入りへの追加を行うことができます。
マイページにて、予約情報とお気に入りに追加した店舗の一覧を確認することができます。

![ichiran2](https://github.com/user-attachments/assets/ec67e482-7507-42a4-8439-bd3b7fb7f462)

![mypage](https://github.com/user-attachments/assets/8f7741c9-0b38-4609-a5d0-0472d36cc8ba)

# 機能一覧

・ユーザー登録
・ログイン
・ログアウト
・ユーザー情報取得
・ユーザー飲食店お気に入り一覧取得
・ユーザー飲食店予約情報取得
・飲食店一覧取得
・飲食店詳細取得
・飲食店お気に入り追加
・飲食店お気に入り削除
・飲食店予約情報追加
・飲食店予約情報削除
・エリアで検索する
・ジャンルで検索する
・店名で検索する
・予約変更機能
・店舗評価機能
・バリデーション
・レスポンシブデザイン（iPad Miniの解像度 768×1024に対応）
・管理画面（管理者(admin)と店舗代表者と一般利用者の3つの権限が存在し、店舗代表者は店舗情報の作成と更新と予約情報の確認ができる。管理者は店舗代表者を作成できる。）
・ストレージ（お店の画像をストレージに保存することができる）
・メール送信（管理画面から利用者にお知らせメールを送信することができる）
・リマインダー（予約当日の朝に予約情報のメールがユーザーに送信される）
・QRコード（各予約情報にQRコードが割り付けらる）
・決済機能（店舗予約時にStripeを利用して決済をすることができる）

・管理者（admin）の名前、メールアドレス、パスワードは以下の通りです。

name : Admin、email : admin@example.com、password : adminpassword

・店舗管理者と一般ユーザーのサンプルの名前、メールアドレス、パスワードは以下の通りです。

店舗管理者　name : ShopManager-example、email : ShopManager@example.com、password : ShopManagerpassword

一般ユーザー name : User-example、email : User@example.com、password : Userpassword

# 新規追加機能
・口コミ機能
・店舗一覧ソート機能
・csvインポート機能

# 口コミ機能

・一般ユーザーは店舗詳細ページから店舗に対し口コミを追加することができる。

・口コミは「テキスト・星(1～5)・画像」で構成されている。（テキスト：400文字以内、星(1～5)：選択式、画像：jpeg、pngのみアップロード可能）
    
・一般ユーザーは1店舗に対し2件以上の口コミを追加することはできない。

・一般ユーザーは自身が追加した口コミの内容を編集することができる。

・一般ユーザーは自身が追加した口コミを削除することができる。

・管理ユーザーは全ての口コミを削除することができる。

![review](https://github.com/user-attachments/assets/3f4997f3-43d9-4813-90b5-e5f4ec77082f)

![review2](https://github.com/user-attachments/assets/6b7a2f5b-619a-45a7-9c77-0d160026a954)

# 店舗一覧ソート機能

・一般ユーザーは店舗一覧を並び替えることができる（ランダム、評価が高い順、評価が低い順）

## 環境構築

### Dockerビルド
1. `git clone https://github.com/TakuroYoshida1988/yoyaku.git`
2. `docker-compose up -d --build`

* MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせて `docker-compose.yml` ファイルを編集してください。

### Laravel環境構築
1. `docker-compose exec php bash`
2. `composer install`
3. `.env.example` ファイルから `.env` を作成し、環境変数を変更
4. `php artisan key:generate`
5. `php artisan migrate`
6. `php artisan db:seed`
   

## MailHogの使用方法

MailHogは、開発環境でのメール送信をテストするためのツールです。メールが実際に外部に送信されることなく、MailHogのインターフェースで確認できます。

### MailHogの起動
- `docker-compose.yml` ファイルにMailHogの設定を追加していますので、`docker-compose up -d --build` コマンドでMailHogが自動的に起動します。
- MailHogのWebインターフェースには、ブラウザで `http://localhost:8025/` にアクセスして確認できます。

### MailHogのSMTP設定
- `.env` ファイルに以下の設定を追加します。これにより、Laravelがメール送信時にMailHogを使用するようになります。

MAIL_MAILER=smtp

MAIL_HOST=mailhog

MAIL_PORT=1025

MAIL_USERNAME=null

MAIL_PASSWORD=null

MAIL_ENCRYPTION=null

MAIL_FROM_ADDRESS="noreply@example.com"

MAIL_FROM_NAME="${APP_NAME}"

これにより、開発中に送信されるすべてのメールがMailHogで確認できるようになります。

### STRIPEの設定
- `.env` ファイルに以下の設定を追加します。これにより、STRIPEでの決済機能をテストモードで実行できます。

STRIPE_KEY=pk_test_51QHQpuAhHzFtXlkfNpveoaQjqa7ynfHohNJYc5ny25LkmztayiNHBOijM10WnwiGvomvdO8RUcaJY20cJWZb6Wpx00xau9mgYh
STRIPE_SECRET=sk_test_51QHQpuAhHzFtXlkfaN8pqBK0BW6qxabLac7NNsbyiWn6fjegZj9juzFycdJZ1cpSKD7gIORBpEWvYRRqU0NeaqnZ00Hx6alCI8

## 使用技術
- PHP 8.0
- Laravel 10.0
- MySQL 8.0
- MailHog

## テーブル設計
![table](https://github.com/user-attachments/assets/b43f7c22-027e-4a6d-9fca-b702d05d8f8b)

## ER図
![ER](https://github.com/user-attachments/assets/e435c362-7564-4fe4-87be-e05dd3986ed9)

## URL
- 動作環境：`http://localhost/`
- phpMyAdmin：`http://localhost:8080/`
- MailHog：`http://localhost:8025/`
