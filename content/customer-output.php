<?php 
require 'header.php';
require '../connect.php';
require 'menu.php';


if(isset($_SESSION['customer']['id'])){
  $id = $_SESSION['customer']['id'];
  $sql = $pdo->prepare('select * from customer where id!=? and login=?');
  $sql ->execute([$id,$_POST['login']]);
}else{
  $sql = $pdo->prepare('select * from customer where login=?');
  $sql ->execute([$_POST['login']]);
}

if(empty($sql->fetchAll())){ //重複したログイン名がないか調べる。

  $pswd = password_hash($_POST['password'], PASSWORD_DEFAULT); //ハッシュ化

  if(isset($_SESSION['customer']['name'],$_SESSION['customer']['address'],$_SESSION['customer']['login'],$_SESSION['customer']['email'])){

    $sql = $pdo->prepare('update customer set name=?, address=?,'.'login=?,password=?,email=? where id=?');
    // DBを上書きする処理
    $sql->execute([
      $_POST['name'],$_POST['address'],$_POST['login'],$pswd,$_POST['email'],$id
    ]);

    //ログインセッションを保存する処理
		$_SESSION['customer']=[
      'id'=>$id,
      'name'=>$_POST['name'], 
      'address'=>$_POST['address'], 
      'login'=>$_POST['login'],
      'email'=>$_POST['email']
    ];

    // ,'password'=>$pswd  パスワードは保存しない
    $message = "お客様情報を更新しました。";
  }else{ //セッションの情報がなかったら(ログインしていなければ)DBに新規追加する
    $sql= $pdo->prepare('insert into customer values(null,?,?,?,?,?)');
    $sql->execute([
      $_POST['name'],
      $_POST['address'],
      $_POST['login'],
      $pswd,
      $_SESSION['customer']['email'],
    ]);
    $message = "お客様情報を登録しました。";

    //セッションに代入してログイン済みにする
		$_SESSION['customer']['name']=$_POST['name'];
		$_SESSION['customer']['address']=$_POST['address'];
		$_SESSION['customer']['login']=$_POST['login'];
		$_SESSION['customer']['password']=$_POST['password'];
  }
}else{
  unset($_SESSION);
  $message = "ログイン名がすでに使用されていますので、変更してください。";
}
echo $message;
require 'footer.php';
