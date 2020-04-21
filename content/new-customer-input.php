<?php 
require 'header.php';
require 'menu.php'; 
?>

<form action="new-customer-output.php" method="post">
  <h3>新規会員登録</h3>
  <table>
  <tr>
    <td>Eメールアドレス</td>
    <td><input type="email" name="email"></td>
  </tr>
  </table>
  <input type="submit" value="送信">
</form>
<?php require 'footer.php'; ?>
