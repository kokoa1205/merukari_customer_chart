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
  <title>Document</title>
</head>
<body>
    <h1><a href="insert.php">入力画面</a></h1>
    <input type="text" id="search"> <input type="button" value="絞り込む" id="button"> <input type="button" value="すべて表示" id="button2">

    <!-- <table border="1" id="result"> 
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
        <td><button type="button" class="selectBtn"><input type="hidden" name="name" value="<?php echo $row['id']; ?>">送信</td>
        <td><button type="button" class="deleteBtn" onclick="return"><input type="hidden" name="name" value="<?php echo $row['id']; ?>">削除</td>
      </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    <p id="return"></p> -->

    <table>
        <thead>
            <tr>
                <td></td>
                <th scope="col">内容</th>
                <th scope="col">価格(月額)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>ベーシックプラン</th>
                <td data-label="内容" class="txt">はじめての方向け。ベーシックなお試しプラン</td>
                <td data-label="価格" class="price">¥3,000</td>
            </tr>
            <tr>
                <th>カスタムプラン</th>
                <td data-label="内容" class="txt">必要なものだけ揃えられるカスタムプラン</td>
                <td data-label="価格"class="price">¥4,000</td>
            </tr>
            <tr>
                <th>プレミアムプラン</th>
                <td data-label="内容" class="txt">全ておまかせのプレミアムプラン</td>
                <td data-label="価格"class="price">¥10,000</td>
            </tr>
          <tr>
                <th>ベーシックプラン</th>
                <td data-label="内容" class="txt">はじめての方向け。ベーシックなお試しプラン</td>
                <td data-label="価格" class="price">¥3,000</td>
            </tr>
            <tr>
                <th>カスタムプラン</th>
                <td data-label="内容" class="txt">必要なものだけ揃えられるカスタムプラン</td>
                <td data-label="価格"class="price">¥4,000</td>
            </tr>
            <tr>
                <th>プレミアムプラン</th>
                <td data-label="内容" class="txt">全ておまかせのプレミアムプラン</td>
                <td data-label="価格"class="price">¥10,000</td>
            </tr>
          <tr>
                <th>ベーシックプラン</th>
                <td data-label="内容" class="txt">はじめての方向け。ベーシックなお試しプラン</td>
                <td data-label="価格" class="price">¥3,000</td>
            </tr>
            <tr>
                <th>カスタムプラン</th>
                <td data-label="内容" class="txt">必要なものだけ揃えられるカスタムプラン</td>
                <td data-label="価格"class="price">¥4,000</td>
            </tr>
            <tr>
                <th>プレミアムプラン</th>
                <td data-label="内容" class="txt">全ておまかせのプレミアムプラン</td>
                <td data-label="価格"class="price">¥10,000</td>
            </tr>
        </tbody>
    </table>   


</body>
</html>