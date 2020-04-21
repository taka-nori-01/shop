<?php
require 'header.php';
require 'menu.php';
require '../connect.php';

$purchase_id=1;
foreach ($pdo->query('select max(id) from purchase') as $row) {
	$purchase_id=$row['max(id)']+1;
}
$sql=$pdo->prepare('insert into purchase(id,customer_id) values(?,?)'); 

if ($sql->execute([$purchase_id, $_SESSION['customer']['id']]) && isset($_SESSION['product'])) {
	foreach ($_SESSION['product'] as $product_id=>$product) {
		$sql=$pdo->prepare('insert into purchase_detail values(?,?,?)');
		$sql->execute([$purchase_id, $product_id, $product['count']]);
	}
	unset($_SESSION['product']);
	echo '購入手続きが完了しました。<br>';
	echo '納品書を発行するには以下のURLをクリックして下さい<br>
	<a target="_blank" href="http://'.$_SERVER['HTTP_HOST'].'/admin/nohin.php?purchase_id='.$purchase_id.'&product_id='.$product_id.'">http://'.$_SERVER['HTTP_HOST'].'/admin/nohin.php?purchase_id='.$purchase_id.'&product_id='.$product_id.'</a>';
} else {
	echo '購入手続き中にエラーが発生しました。再度購入手続きをして下さい。';
}


require 'footer.php';
