<?php
require 'header.php'; 
require '../connect.php';
?>
<form class="kensaku">
  <p><label>purchase_id:<input name="purchase_id"></label></p>
  <p><input type="submit" value="検索"></p>
</form>
<?php
if(empty($_GET['purchase_id'])){
  exit('URLパラメータを入力して下さい。');
}

//購入履歴のSQL文 購入者のid,name,address
$sql = 'SELECT p.id,name,address,`created` 
FROM purchase as p 
LEFT JOIN customer as c 
ON p.customer_id=c.id 
WHERE p.id = ? ';

$stmt=$pdo->prepare( $sql );
$stmt->execute([ $_GET['purchase_id']]);
$row = $stmt->fetchAll();
echo "
<li> {$row[0]['id']}"
,"<li> {$row[0]['name']}"
,"<li> {$row[0]['address']}"
,"<li> {$row[0]['created']}";

//購入商品のSQL文
$sql = 'SELECT d.product_id,name ,price,count
,count * price as shokei
FROM purchase_detail as d
LEFT JOIN product as s
ON s.id = d.product_id
WHERE purchase_id = ? ';

$stmt=$pdo->prepare( $sql );
$stmt->execute([ $_GET['purchase_id']]);

ob_start(); // アウトプットバッファリングの開始
ob_implicit_flush(); // バッファ上限を無効化
echo "
<table class='meisai'>
<tr> <th>商品番号</th><th>商品名</th><th>価格</th><th>数量</th><th>小計</th> </tr>";

$total=0;
foreach ($stmt as $row) {
 echo "<tr> <td>{$row['product_id']}</td> <td>{$row['name']}</td>
  <td>{$row['price']}</td> <td>{$row['count']}</td>  <td>{$row['shokei']}</td> </tr>
  ";
  $total+=$row['shokei']; //合計(税別)
}
const TAX = 0.1; //税率
$tax=$total*TAX; //消費税
?>

<tr> <td colspan="2">消費税</td><td colspan="3"><?= number_format($tax)?></td> </tr>
<tr> <td colspan="2">合計(税別)</td><td colspan="3"><?=number_format($total)?> </tr>
</table>

<?php
$text=ob_get_clean(); //バッファをクリアし変数に代入
$total+=$tax; //合計(税込)

echo "<div class='total'><p>合計(税込) &yen",number_format($total),"</p></div>";
echo $text;

require 'footer.php'; ?>


