<?php 
require 'header.php';
require '../connect.php';

$error_message =  '<p><a href="/content/new-customer-input.php">こちらからemailを送信してください。</a></p>';
 if( empty($_GET['email']) || empty($_GET['token'])){
  echo  $error_message;
  exit;
 }else{
// 取得したemailとtokenで仮登録テーブルを絞り込んで、1件あれば認証
	$sql=$pdo->prepare('select * from customer_tmp where email=? and token=?');
	$sql->execute([ $_GET['email'], $_GET['token'] ]);
	$row = $sql->fetchAll();
  date_default_timezone_set('Asia/Tokyo'); //日本時間にする

  if( empty($row) || time()-strtotime($row[0]['created']) > 3600*24) exit(  $error_message );
// 仮登録テーブルに一件もない、もしくは仮登録から24時間以上時間が空いた場合処理を中断

  $_SESSION['customer']['email'] = htmlspecialchars( $_GET['email'],ENT_QUOTES);
 }

?>

<form action="customer-output.php" method="post">
  <h3>新規会員登録</h3>
  <p>メールアドレス:<?=$_GET['email']?></p>
  <table>
  <tr>
    <td>お名前</td>
    <td><input type="text" name="name"></td>
  </tr>
  <tr>
    <td>ご住所</td>
    <td><input type="text" name="address"></td>
  </tr>
  <tr>
    <td>ログイン名</td>
    <td><input type="text" name="login"></td>
  </tr>
  <tr>
    <td>パスワード</td>
    <td><input type="password" name="password"></td>
  </tr>
  </table>
  <input type="submit" value="確定">
</form>

<?php require 'footer.php'; ?>
