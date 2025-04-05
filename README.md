# bivium(ビビアム)
## 概要
### 企業向け採用コストシミュレーションアプリ
- フルタイム・パート雇用それぞれに対応
- ツール代、備品代、交通費等を考慮し初期費用・​ランニングコスト等を簡単にシミュレーション​

## 画面の説明
### シミュレーション機能
- フルタイムとパートが選択可能
- 入力画面に値を入力すると採用にかかるコストが表示される
- 表示は文字だけでなくグラフもあり、視覚的に分かりやすくなっている
- 2通りの値を入力し、それぞれのシミュレーション結果を表示することも可能
- ツール(AWSやGoogle Cloudなど)にかかる費用は下の「ツール登録機能」で登録する
### ツール登録機能
- シミュレーション画面で扱うツールと値段を登録する
- 値段の編集や削除も可能だが、名前の編集は出来ないのでその部分は再度登録する必要がある
### 入力値の保存機能
- 入力値を保存して一覧で見ることが出来る
- 保存したデータには任意で名前を付けることができ、名前で検索することも可能

## 使用技術
- HTML&CSS
- JavaScript
- PHP
- Laravel
- MySQL

## チーム開発について
- デザイン担当、フロントエンド担当、バックエンド担当に分かれて開発した
	- 分からない部分があった際には、担当の部分以外でもフォローした
- 主にSlackでやり取りし、通話はGatherを使用した
	- Slackでのやり取りはほぼ毎日、Gatherは基本的に週1～週2
