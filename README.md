# re-fashionably_late（お問い合わせフォーム）

![スクリーンショット 2025-03-04 213601](https://github.com/user-attachments/assets/f5942757-e493-4837-bb4f-1ce379d6888a)

【 ページ一覧 】

/               フォーム入力ページ

/confirm        フォーム確認ページ

/thanks	        サンクスページ

/admin          管理画面

/register	    ユーザー登録ページ

/login          ログインページ



【　環境構築　】

Dockerビルド

1.  git clone git@github.com:kohsai/re-fashionably_late.git

2.  DockerDesktopアプリを立ち上げる

3.  docker-compose up -d --build


【　Laravel環境構築　】

1.  docker-compose exec php bash

2.  composer install

3.  .env ファイルを編集し、以下の内容を確認または修正してください。

.envに以下の環境変数を追加


DB_CONNECTION=mysql

DB_HOST=mysql

DB_PORT=3306

DB_DATABASE=laravel_db

DB_USERNAME=laravel_user

DB_PASSWORD=laravel_pass


【　アプリケーションキーの作成　】

php artisan key:generate

【　マイグレーションの実行　】

php artisan migrate


【　初期データの登録（シードの実行）　】

php artisan migrate --seed


【　使用技術（実行環境）】

・PHP: 7.4.9

・Laravel Framework: 8.83.29

・MySQL: 8.0.26


【　ER図　】

![スクリーンショット 2025-03-07 120319](https://github.com/user-attachments/assets/d2bef741-a5d6-4e7d-b41e-d07e35f1f6b1)


【　URL　】

・開発環境:http://localhost/

・phpMyAdmin:http://localhost:8080
