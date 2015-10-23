<?php

function make_index($file_name)
{
  $fp = fopen(__DIR__."/".$file_name, "w");
  fwrite($fp, "#index\n");

  $tree_result = explode("\n", shell_exec("tree -N ."));

  //リンク作成用ディレクトリ構造保存配列
  $dir_array = array();

  for($i = 0; $i < count($tree_result); $i++){
    if(!array_key_exists($i, $tree_result))
    {
      continue; 
      echo("array key doesn't exist");
    }

    //ディレクトリ階層数
    $dir_class = substr_count($tree_result[$i], "│")
                +substr_count($tree_result[$i], "├")
                +substr_count($tree_result[$i], "└");

    //列挙時の符号
    $sign = "";
    switch($dir_class%2){
      case 0:
        $sign = "+ ";
        break;
      case 1:
        $sign = "- ";
        break;
    }

    //列挙時のスペース
    $space = "";
    for($j=0; $j<$dir_class-1; $j++){
      $space .= "  ";
    }

    //ディレクトリかmdファイルだったらindexに追加
    if(substr_count($tree_result[$i], ".")==0){
      if($dir_class > 0){
          $preg_array = preg_split('/ /', $tree_result[$i]);
          fwrite($fp, $space.$sign.$preg_array[count($preg_array)-1]."\n");

          $dir_array = array_slice($dir_array, 0, $dir_class-1);
          array_push($dir_array, $preg_array[count($preg_array)-1]);
      }
    }elseif(preg_match('/\.md$/', $tree_result[$i])){
      if($dir_class > 1){
          $link_address = "";
          for($j=0; $j<$dir_class-1; $j++){
            $link_address .= $dir_array[$j]."/";
          }

          $preg_array = preg_split('/ /', $tree_result[$i]);
          fwrite($fp, $space.$sign."[".$preg_array[count($preg_array)-1]."](".$link_address.$preg_array[count($preg_array)-1].")\n");
      }
    }
  }

  fclose($fp);
}

?>