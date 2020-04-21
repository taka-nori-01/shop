<?php 
require 'header.php'; 
require 'menu.php'; 

if(isset($_SESSION['customer'])){
  require '../connect.php';
	$sql=$pdo->prepare('insert into favorite values(?,?)');
  $sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
  echo "お気に入り商品を追加しました。<hr>";
  require 'favorite.php';
}else{
  echo "お気に入りに商品を追加するには、ログインしてください。";
}


require 'footer.php'; 
