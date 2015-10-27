<?php

  require_once(__DIR__."/util.php");

  make_index("index.md", ".");

  header("Location: http://shinzan.human.waseda.ac.jp/~yoshito/mdwiki/mdwiki.html#!index.md");

?>

