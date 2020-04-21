<?php 
require 'header.php'; 
require '../connect.php';
?>
<table>
<tr>
  <th>商品番号</th>
  <th>商品名</th>
  <th>商品価格</th>
</tr>
<?php

$sql = $pdo->prepare('select * from product where name LIKE ?');
$sql->execute(["%".$_POST['keyword']."%"]);
foreach($sql as $row){
  echo "<tr>
          <td>$row[id]</td>
          <td>$row[name]</td>
          <td>$row[price]</td>
        </tr>\n";
}
// $stmt = $pdo->query($sql);
?>
</table>
<?php require 'footer.php'; ?>