<?php 
require 'header.php';
require 'menu.php';

$name=$address=$login=$password=$email="";
if(isset($_SESSION['customer'])){
  $name = $_SESSION['customer']['name'];
  $address = $_SESSION['customer']['address'];
  $login = $_SESSION['customer']['login'];
  $email= $_SESSION['customer']['email'];
}
?>

<form action="customer-output.php" method="post">
  <h3>会員情報変更</h3>
  <table>
  <tr>
    <td>お名前</td>
    <td><input type="text" name="name" value="<?=$name?>"></td>
  </tr>
  <tr>
    <td>ご住所</td>
    <td><input type="text" name="address" value="<?=$address?>"></td>
  </tr>
  <tr>
    <td>ログイン名</td>
    <td><input type="text" name="login" value="<?=$login?>"></td>
  </tr>
  <tr>
    <td>パスワード</td>
    <td><input type="password" name="password"></td>
  </tr>
  <tr>
    <td>Eメール</td>
    <td><input type="email" name="email" value="<?=$email?>"></td>
  </tr>
  </table>
  <input type="submit" value="会員情報更新">
</form>
<?php require 'footer.php'; ?>
