<?php
require '../connect.php';

if( empty($_POST['email'])){
  echo 'emailを送信してください。'; 
  exit;
 }

 if(preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $_POST['email'])){
 //トークン発行 
  $token = random(25);

//DBに登録
  $sql=$pdo->prepare( 'insert into customer_tmp (email,token) values(?,?)');
    $sql->execute([ $_POST['email'], $token	]);
    
 //メール送信
 //言語と文字コードを設定
mb_language("Japanese"); 
mb_internal_encoding("UTF-8");

//メールの情報を設定
$mailto = $_POST['email'];
$title = "仮登録完了：shopからメール認証のURL";
$message ='<p>以下のURLより本登録の手続きをして下さい。</p>
<a href="http://'.$_SERVER['HTTP_HOST'].'/shop/content/new-entry.php?token='.$token.'&email='.$_POST['email'].'">http://'.$_SERVER['HTTP_HOST'].'/shop/content/new-entry.php?token='.$token.'&email='.$_POST['email'].'</a>';
$option= "From:".mb_encode_mimeheader("送信者2")."<test2@example.com>";

//メールの送信
if(mb_send_mail($mailto,$title,$message,$option)){
	echo "送信成功<p>",$token;
}else{
  echo "送信失敗";
  echo $message;
}   
}else{
  echo '正しくないメールアドレスです';
}


function random($length = 8){
   return substr(base_convert(md5(uniqid()), 16, 36), 0, $length);
}




