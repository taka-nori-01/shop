<?php 
require 'header.php';
require '../connect.php'; 

$sql=$pdo->prepare('delete from product where id=?');
if ($sql->execute([$_GET['id']])) {
	echo '削除に成功しました。';
} else {
	echo '削除に失敗しました。';
}

require 'footer.php';
