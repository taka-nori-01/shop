<?php
if(!empty($_SESSION['product'])){
  echo "
  <table>
  <th>商品番号</th>
  <th>商品名</th>
  <th>価格</th>
  <th>個数</th>
  <th>小計</th>";
  $total=0;
  foreach($_SESSION['product'] as $id=>$product){
    echo "
    <tr>
      <td>$id</td>
      <td><a href='detail.php?id=$id'>$product[name]</a></td>
      <td>$product[price]</td>
      <td>$product[count]</td>";
      $subtotal=$product['price']*$product['count'];
      $total+=$subtotal;
      echo "
      <td>$subtotal</td>
      <td><a href='cart-delete.php?id=$id'>削除</a></td>
    </tr>";
  }
  echo "
  <tr>
  <td>合計</td>
  <td></td>
  <td></td>
  <td></td>
  <td>$total</td>
  <td></td>
  </tr>
  </table>";
}else{
  echo "カートに商品がありません。";
}

