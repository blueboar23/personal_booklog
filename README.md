# 個人用読書ログアプリ　 Personal BookLog
## 概要：  
自分自身の読書傾向を把握でき、詳細にアウトプットができる個人用読書ログアプリです。  
PCでの使用を前提としているため、レスポンシブには対応しておりません。  
PHPの言語への理解とSQLへの理解を深めるため、バックエンドの処理はフレームワークを使用せず、フルスクラッチで開発しました。  

## ターゲット
ジャンル毎に多読をする人で、どのジャンルが好きかを把握したく、本のアウトプットより詳細に記録したい人向け  

## 公開URL：
https://personal-booklog.com/ (デプロイ先：ロリポップ）  

多量のタイピングを想定して作成したため、モバイル端末、タブレット端末には対応しておりません。  
今回、ゲストログイン機能を実装していないため、お手数おかけしますが、ログインされる場合は以下のメールアドレス、パスワードをご利用ください。　　
##### ログイン用メールアドレス:  
t1@test.com  
##### ログイン用パスワード:  
pass12345  

## 製作時期
2022年4月中旬〜6月中旬

## 開発した理由  
既存のアプリが自分にとっては使いにくく、自分好みの読書ログが欲しかったため。   
フレームワークを使う前にアプリ制作を通じて、生のPHPとSQLへの理解を深めたかったため。  

## 使用技術  
- HTML
- CSS
- Bootstrap 4
- PHP 7.4.21
- MySQL 5.7.34

## 使用ツール
- MAMP
- Git
- GitHub（Issue,Pull Request, Merge)
- SourceTree
- draw.io

## アプリの主な機能

|No|機能|機能について|
|:---:|:---:|:--:|
|1|新規登録機能||
|2|ログイン機能||
|3|ログアウト機能||
|4|ジャンルの登録機能|ジャンルを登録|
|5|ジャンルの編集機能|ジャンルを編集|
|6|ジャンルの削除|ジャンルを削除|
|7|ジャンルのページネーション機能||
|8|読書ログの登録機能|タイトル、著者名、ジャンル、ランク、メモ、学び、語彙を登録|
|10|読書ログの編集機能|タイトル、著者名、ジャンル、ランク、メモ、学び、語彙を編集|
|11|読書ログの削除機能|読書ログを削除|
|12|読書ログのページネーション機能||
|13|ランク別のジャンルランキングの表示|各ランク別のジャンルトップ3を表示|

　　
## ER図
![ER diagram](https://user-images.githubusercontent.com/89965484/175561246-47b2fc0f-d046-4816-8d33-f7350bd2aa41.png)

## セキュリティ対策
### 以下のセキュリティ対策については、初心者なりに対策しました。
- バスワードのハッシュ化
- セッションの再生成
- バリデーション
- CSRF対策
- クロスサイトスクティプティング対策
- アクセス制御
___

## 苦労した点  
当初は生のSQL文になかなか慣れず、それぞれのテーブルに外部キー制約をつけるのにも時間がかかりました。  
最も苦労したのは読書ログの編集時に、それぞれのHTMLの属性(option,radio)に合わせて、値を保持させる箇所です。  
ページネーションの表現方法にも苦労しました。

## 学び
フレームワークを使用せずに、生のPHPとSQLだけでアプリを作成することにより、フレームワークを使う際にどのようなSQL文が裏で発行されているかを理解できるようになりました。  
まだLaravelの勉強を始めて、間もないですが、ページネーション、CSRF対策、外部キー制約、テンプレートエンジンなどの恩恵を今回、遠回りしてより感じられるようになりました。  
セキュリティ対策への理解がより深まった。  

## 反省点
絶対的な期限を設けずに開発してしまったため、開発が長引いてしまった。  
作成前に詳細な設計をせず、「何をやらないか」が不明確だったため、実装するかどうか迷う機能が多々あった。　　
HTMLのheaderを読み込むファイルに、関数やメソッドを定義したファイルをまとめてしまい、1つのファイルに複数の機能を持たせてしまった。  
ロジック系の処理（ログインチェックやバリデーション等）よりも前にHTMLのheadを読み込んでいたため、本番環境でheader関数が使えず、Javascriptのlocationオブジェクトで代用する形になってしまった。 

## 課題  
PC用に作成したため、レスポンシブに対応していないこと。  
開発前の段階で初めの設計をもっと入念に行い、「何を実装するか」よりも「何を実装しないか」をもっと明確にする。　　



## アプリの写真
###  ユーザー登録画面
![register-form](https://user-images.githubusercontent.com/89965484/175775610-07f28056-681a-43dc-99f1-a583ee1d3311.png)
###  ログイン画面
![login-form](https://user-images.githubusercontent.com/89965484/175775627-c42a052c-f08e-40dc-be7e-922a4c23e47d.png)
### 　ジャンル登録画面
![genre-register-form](https://user-images.githubusercontent.com/89965484/175775840-8b07db30-5e2d-4ad9-8636-0a909c15eed6.png)
### 読書ログ登録画面
![booklog-register-form](https://user-images.githubusercontent.com/89965484/175775847-2e358841-a8f9-4f62-a774-a4f872946f5a.png)  
### トップページ
![toppage](https://user-images.githubusercontent.com/89965484/175775769-8dd52cce-dee0-4eff-90fd-77c33751754e.png)
### 　ジャンル毎のランキング
![genre-ranking](https://user-images.githubusercontent.com/89965484/175775814-b725b843-727f-49e1-a35b-eaec5bf2ccdb.png)
