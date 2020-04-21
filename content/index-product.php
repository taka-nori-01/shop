<?php
require 'header.php';
require 'menu.php';
require '../connect.php';
?>

<form action="index-product.php" method="post">
商品検索
<input type="text" name="keyword">
<input type="submit" value="検索">
</form>
<hr>
<?php
$tax=1.1; //税込価格の10%の税率 

if(isset($_POST['keyword'])){
  $sql=$pdo->prepare('select * from product where name like ?');
  $sql->execute(['%'.$_POST['keyword'].'%']);
}else{
  $sql=$pdo->query('select * from product'); 
}

echo "<article class=product>";
foreach($sql as $row){
  $id=$row['id'];
  echo "
  <div class='product-info'>
  <a href='detail.php?id=$id'><image src='image/$row[id].jpg'>
  <p>商品番号:$row[id]</p>
  <p>$row[name]</p>
  <p>$row[price]円 (税込 ",$row['price']*$tax,"円)</p>
  </a>
  </div>";
}
echo "</article>";
?>
<footer>
  <a href="transaction-law.php">特定商取引法に基づく表記</a>
  <a href="privacy.php">プライバシーポリシー</a>
</footer>
<?php require 'footer.php'; ?>
