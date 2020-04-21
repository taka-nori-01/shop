<?php 
require 'header.php'; 
require 'menu.php'; 

$id=$_POST['id'];
if(!isset($_SESSION['product'])){
  $_SESSION['product']=[];
}

$count=0;
if(isset($_SESSION['product'][$id])){
  $count=$_SESSION['product'][$id]['count'];
}
$_SESSION['product'][$id]=[
  'name'=>$_REQUEST['name'],
  'price'=>$_REQUEST['price'],
  'count'=>$count+$_REQUEST['count']
];

echo "<p>カートに商品を追加しました。</p>";
echo "<hr>";

require 'cart.php';
require 'footer.php';
