<nav>
  <a href="index-product.php">商品</a>
  <a href="cart-show.php">カート</a>
  <a href="purchase-input.php">購入</a>
<?php
if(isset($_SESSION['customer']['id'])){
  echo '<a href="favorite-show.php">お気に入り</a>';
  echo '<a href="history.php">購入履歴</a>';
  echo '<a href="customer-input.php">会員情報</a>';
  echo '<a href="logout-input.php">ログアウト</a>';
  echo '<span class="customer-name">ようこそ '.$_SESSION['customer']['name'].'様</span>';
}else{
  echo '<a href="login-input.php">ログイン</a>';
  echo '<a href="new-customer-input.php">新規会員登録</a>';
}
?>
</nav>

<hr>
