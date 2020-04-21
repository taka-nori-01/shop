<?php require 'header.php'; ?>
<table>
<tr><th>商品番号</th><th>商品名</th><th>商品価格</th></tr>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
  'staff', 'password');
  
foreach ($pdo->query('select * from product') as $row) {
  echo '<tr>';
	echo '<td>', $row['id'], '</td>';
	echo '<td>', $row['name'], '</td>';
	echo '<td>', $row['price'], '</td>';
	echo '<td>';
	echo '<a class="delete" href="delete-output.php?id=', $row['id'], '">削除</a>';
	echo '</td>';
	echo '</tr>';
	echo "\n";

}
?>
</table>
<?php require 'footer.php'; ?>


<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
</script>

<script>
$(function(){
$("a.delete").click(function(){
  var result = confirm('本当に削除しますか？');
 if(result) {//はいを選んだときの処理
   location.href = $this.attr('href');
 }else{//いいえを選んだときの処理
   return false;
 }
});
});
</script>