# DAMP
Docker-based Apache, MySQL and PHP Environment

## 概要
- Docker composeベースのXAMPP代替実装/構成
- 授業で使うXAMPPの挙動が嫌だったのでつくりました

## 使い方
### セットアップ&起動
```
git clone https://github.com/r-ca/damp && cd damp
docker compose up --build
```

### 挙動
- `src/*`がApacheを通して80番ポートで公開されます
- その他
  - `/`: Dashboard 
  - `/phpmyadmin/`: phpMyAdmin
  - `/phpinfo.php`: PHPInfo
  - `/tree.php`: 組み込みファイルツリー

## 注意
- 一切の保証はありません
- XAMPPと異なる挙動が多数あります
- 一部ChatGPT/GithubCopilotChatのコードをベースに作成されています(フロントなど)


WIP