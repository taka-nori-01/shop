<?php 
require 'header.php';
require '../connect.php';

unset($_SESSION['customer']);

$sql=$pdo->prepare('select * from customer where login=?');
$sql->execute([$_POST['login']]);
$row=$sql->fetchAll();

if (password_verify($_POST['password'],$row[0]['password'])) {
  $_SESSION['customer']['id']=$row[0]['id'];
  $_SESSION['customer']['name']=$row[0]['name'];
  $_SESSION['customer']['address']=$row[0]['address'];
  $_SESSION['customer']['login']=$row[0]['login'];
  $_SESSION['customer']['password']=$row[0]['password'];
  $_SESSION['customer']['email']=$row[0]['email'];
  $message='いらっしゃいませ、'.$_SESSION['customer']['name']. 'さん。';
} else {
  $message= 'ログイン名またはパスワードが違います。';
}

require 'menu.php';
echo $message;

require 'footer.php'; 
