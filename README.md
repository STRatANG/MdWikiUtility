# MdWikiUtility

## 概要
- MdWiki用のユーティリティ
- phpで書く
- まだインデックスを作る機能のみ
  + make_index($file_name)
    - $file_nameで指定したファイルに同ディレクトリ以下のディレクトリと.mdファイルのインデックスを書き込む

## 使い方(一例)
- MdWikiを設置したディレクトリにutil.phpを置く
- MdWikiとは別にindex.phpを置く
- index.php内でutil.phpをrequireして好きに処理を行う
- 処理が終わったらheaderでMdWikiに移動
