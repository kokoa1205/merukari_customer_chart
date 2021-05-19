<?php 
session_start();
require('dbconnect.php');

if(!empty($_SESSION['list']['id'])) {
  $update = "UPDATE merukari_member SET created = now() WHERE id = :id";
  $update_stmt = $db->prepare($update);
  $update_params = array(':id' => $_SESSION['list']['id']);
  $update_stmt->execute($update_params);
  unset($_SESSION['list']['id']);
}
if(!empty($_SESSION['list']['delete'])) {
  $delete = "DELETE FROM merukari_member WHERE id = :id";
  $delete_stmt = $db->prepare($delete);
  $delete_params = array(':id' => $_SESSION['list']['delete']);
  $delete_stmt->execute($delete_params);
  unset($_SESSION['list']['delete']);
  print($_SESSION['list']['delete']);
}



$row_count = [];
$sql = "SELECT * FROM merukari_member ORDER BY name";
$stmt = $db->query($sql);


// 下に書いてもいいけどstmtを被らせないようにする

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="./main.js"></script>
  <title>Document</title>
</head>
<body>
    <h1><a href="insert.php">入力画面</a></h1>
    <input type="text" id="search"> <input type="button" value="絞り込む" id="button"> <input type="button" value="すべて表示" id="button2">

    <table border="1" id="result"> 
    <thead>
      <tr>
        <th>名前</th>
        <th>取引物</th>
        <th>取引日</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($stmt as $row): ?>
      <tr>
        <td><?php echo $row['name']; ?></td>
         <td><?php echo $row['message']; ?></td>
        <td><?php echo $row['created']; ?></td>
        <!-- <td><?php echo $row['created']; ?></td> -->
        <td><button type="button" class="selectBtn"><input type="hidden" name="name" value="<?php echo $row['id']; ?>">送信</td>
        <td><button type="button" class="deleteBtn" onclick="return"><input type="hidden" name="name" value="<?php echo $row['id']; ?>">削除</td>
      </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    <p id="return"></p>
</body>
</html>