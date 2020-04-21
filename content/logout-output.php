<?php
require 'header.php';

if(isset($_SESSION['customer'])){
  unset($_SESSION['customer']);
  $message= "ログアウトしました。";
}else{
  $message= "すでにログアウトしています。";
}
require 'menu.php';
// 上の文字を変数にすることでここまでをメッセージボディにする
// ->メニューの表示をセッションが切れたあとにする
 echo $message;
require 'footer.php';
