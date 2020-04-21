<?php 
require 'header.php'; 
require 'menu.php';
require '../connect.php';

$sql=$pdo->prepare('select * from product where id=?');
$sql->execute([$_REQUEST['id']]);

//お気に入りの取得(ログイン済みなら
if(isset($_SESSION['customer']['id'])){
  $strsql = 'select * from favorite where product_id=? and customer_id=?';
  $fav=$pdo->prepare( $strsql );
  $fav->execute([$_REQUEST['id'],$_SESSION['customer']['id']]);
  // 絞り込んだ行が1行以上無い場合の取り出しかた
  $record = $fav->fetch(PDO::FETCH_ASSOC);
}else{
  	// ログインしてなければfalseを代入
  $record = false;  //ハートは常に黒
}

foreach($sql as $row){
  echo "
  <p><img src='image/$row[id].jpg'></p>
  <form action='cart-insert.php' method='post'>
    <p>商品番号:$row[id]</p>
    <p>商品名:$row[name]</p>
    <p>価格:$row[price]</p>
    <p>個数:
    <select name='count'>";
    for($i=1; $i<=10; $i++){
      echo "<option value='$i'>$i</option>";
    }
    echo "
    </select>
    </p>
    <input type='hidden' name='id' value='$row[id]'>
    <input type='hidden' name='name' value='$row[name]'>
    <input type='hidden' name='price' value='$row[price]'>";

    // echo  '<p><a href="favorite-insert.php?id=', $row['id'],'">お気に入りに追加</a></p>';
  }

   // falseじゃなければクラス名が代入､falseなら空文字
$is_added =  $record ? 'is-added' : '';
$href = $record ? 'delete' : 'insert'; //ハートがピンクのときお気に入り削除、黒のときお気に入り削除
$cap = $record ? 'から削除する' : 'に追加する'; 
  ?>

  <div class="c-product-list__fav-item">
    <input type='submit' value='カートに追加'>
      <a href='favorite-<?=$href?>.php?id=<?=$row['id']?>' title="お気に入り<?=$cap?>" onmouseover="return true;">
      <svg role="img" aria-hidden="true" > <use xlink:href="#heart" >
					<svg id="heart" viewBox="0 0 1792 1792" >
			<!-- 画像内のソースにスタイルを書く		 -->
					<style type="text/css">
							.is-added{fill:#ff7373;}
					</style>
					<path class="<?=$is_added?>" d="M896 1664q-26 0-44-18l-624-602q-10-8-27.5-26T145 952.5 77 855 23.5 734 0 596q0-220 127-344t351-124q62 0 126.5 21.5t120 58T820 276t76 68q36-36 76-68t95.5-68.5 120-58T1314 128q224 0 351 124t127 344q0 221-229 450l-623 600q-18 18-44 18z"></path>
				</svg>	</use>
			</svg>
    </a>
  </div>
</form>

<?php require 'footer.php'; ?>
