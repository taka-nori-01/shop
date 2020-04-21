<?php
include('../connect.php');

$sql_sl = "select password from customer where id = ?";
$sql_up = "update customer set password = ? where id = ?";

for ($i=1; $i < 10 ; $i++) { 
  $stmt = $pdo->prepare($sql_sl);
  $stmt->execute([$i]); 
  $pswd = $stmt->fetchAll()[0]['password'];

  //パスワードの暗号化
  $pswd = password_hash($pswd, PASSWORD_DEFAULT);

  $stmt = $pdo->prepare($sql_up);
  $stmt->execute([$pswd,$i]); 
  var_dump($pswd);
}
