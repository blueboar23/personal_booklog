# 個人用読書ログアプリ　 Personal BookLog
## 概要：
読書のアウトプット（要約、感想、学び、未知の単語等）を詳細に記録できるアプリです。  
ユーザーが登録したジャンル（小説、ビジネス本、教養、小説等）と既定のランク（3軍、2軍、1軍、殿堂入り）を同時に登録でき、ジャンル別の満足度の傾向を把握できるのがポイントです。  
一定数の読書ログを登録すると、それぞれのランクのトップ3を占めているジャンルを確認できます。    
このランキングを見ることで、自分の好きなジャンル、嫌いなジャンルがより分かるようになります。
  
アウトプットの量を多めに想定しているため、UIはPC用に特化しているため、レスポンシブには対応しておりません。
PHPの言語への理解とSQLへの理解を深めるため、バックエンドの処理はフレームワークを使用せず、フルスクラッチで開発しました。  
## アプリの写真
###  ユーザー登録画面
![register-form](https://user-images.githubusercontent.com/89965484/175775610-07f28056-681a-43dc-99f1-a583ee1d3311.png)
###  ログイン画面
![login-form](https://user-images.githubusercontent.com/89965484/175775627-c42a052c-f08e-40dc-be7e-922a4c23e47d.png)
### トップページ
![toppage](https://user-images.githubusercontent.com/89965484/175775769-8dd52cce-dee0-4eff-90fd-77c33751754e.png)
### 　ジャンル毎のランキング
![genre-ranking](https://user-images.githubusercontent.com/89965484/175775814-b725b843-727f-49e1-a35b-eaec5bf2ccdb.png)
### 　ジャンル登録画面
![genre-register-form](https://user-images.githubusercontent.com/89965484/175775840-8b07db30-5e2d-4ad9-8636-0a909c15eed6.png)
### 読書ログ登録画面
![booklog-register-form](https://user-images.githubusercontent.com/89965484/175775847-2e358841-a8f9-4f62-a774-a4f872946f5a.png)  
## 公開URL：
https://personal-booklog.com  
多量のタイピングを想定して作成したため、モバイル端末、タブレット端末には対応しておりません。  
今回、ゲストログイン機能を実装していないため、お手数おかけしますが、ログインされる場合は以下のメールアドレス、パスワードをご利用ください。  
t1@test.com  
pass12345  


## 開発した目的：
#### 既存のアプリが自分にとっては使いにくく、自分好みの読書ログが欲しかったため。   
iphoneで何種類か購入したが、入力するのが面倒で、入力欄の数が限られていたため、使用を断念した。   
一方、PC版は機能面は問題なく、使いやすかったが、広告が煩わしい点がネックだった。   
そのため、アウトプットに特化した自分好みのPC向けアプリを開発することにした　   

_____
### 目的：
1. アウトプットをより詳細に記録する。
1. ジャンルごとに評価をつけることで、自分のジャンル別の選好度合いを把握し、次回購入時の当たりの確率を上げる。
1. ジャンルを登録できるようにすることで、ジャンルの偏りを把握する。
> this is a **quote**

[プロフィールページ(Github Pages)](https://blueboar23.github.io/resume/)

![Markdown Logo](https://markdown-here.com/img/icon256.png)

`<p>This is a paragraph </p>`

```php
echo "hello world";

function printHello() {
    echo "Hello";
}
```

**技術スタック**
|サーバーサイド|フロントエンド|
|-------|-------|
|PHP 7.4  |HTML
|MySQL 5.7  |CSS
|Apache   |Bootstrap 4.0
|ajax  | Javascript
|   | jQuery
|   |Chart.js

## ER図
![ER diagram](https://user-images.githubusercontent.com/89965484/175561246-47b2fc0f-d046-4816-8d33-f7350bd2aa41.png)

### 使用技術
___
**バックエンド**
* PHP7.4.21

**フロントエンド**
* HTML5
* CSS3
* Bootstrap4
* jQuery

**データベース**
* MySQL 5.7.34

**インフラ**
* Heroku

**バージョン管理**
* Git
* GitHub

**ER図作成ツール**
* draw.io

**ローカル開発環境**
* MAMP
