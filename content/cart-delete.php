<?php 
require 'header.php'; 
require 'menu.php'; 

unset($_SESSION['product'][$_GET['id']]);
echo "カートから商品を削除しました。";
echo "<hr>";

require 'cart.php';
require 'footer.php'; 