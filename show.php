<!-- git push heroku master -->
<?php 
session_start();
require('dbconnect.php');
date_default_timezone_set('Asia/Tokyo');

if(!empty($_SESSION['list']['id'])) {
  $update = "UPDATE merukari_member SET created = :created WHERE id = :id";
  $update_stmt = $db->prepare($update);
  $update_params = array(':id' => $_SESSION['list']['id'], ':created' => date('Y-m-d H:i:s'));
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
  <link rel="stylesheet" href="../css/show.css">
  <title>Document</title>
</head>
<body>
    <p><a href="insert.php" class="show">入力画面</a></p>
    <div class="search">
      <input type="text" id="search" placeholder="検索ワード"> 
      <input type="button" value="絞り込む" id="button"> 
      <input type="button" value="すべて表示" id="button2">
      <input type="button" value="時間で絞り込む" id="time-search">
    </div>
    <div class="time-search">

    </div>

    <table border="1" id="result">
        <thead>
            <tr>
                <th scope="col">名前</th>
                <th scope="col">取引物</th>
                <th scope="col">取引日</th>
                <th scope="col">更新</th>
                <th scope="col">削除</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach($stmt as $row): ?>
            <tr>
                <td data-label="内容" class="txt"><?php htmlspecialchars(print($row['name']), ENT_QUOTES); ?></td>
                <td data-label="内容" class="txt"><?php htmlspecialchars(print($row['message']), ENT_QUOTES); ?></td>
                <td data-label="価格" class="price"><?php htmlspecialchars(print($row['created']), ENT_QUOTES); ?></td>
                <td data-label="内容" class="txt"><button type="button" class="selectBtn"><input type="hidden" name="name" value="<?php htmlspecialchars(print($row['id']), ENT_QUOTES); ?>">送信</td>
                <td data-label="内容" class="txt"><button type="button" class="deleteBtn" onclick="return"><input type="hidden" name="name" value="<?php htmlspecialchars(print($row['id']), ENT_QUOTES); ?>">削除</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>   
    <p id="return"></p>

</body>
</html>