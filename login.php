
  <?php
  
  session_start();
  require('dbconnect.php');
  
  if(isset($_POST['add'])) {
    $sql = "INSERT INTO merukari_member (name, message,created) VALUES (:name, :message, NOW())";
    $stmt = $db->prepare($sql);
    $params = array(':name' => $_POST['name'], ':message' => $_POST['message']);
    $stmt->execute($params);
    echo '登録完了しました';
  }
  
  ?>
  <!DOCTYPE html>
  <html lang="ja">
  
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <title>Document</title>
  </head>
  
  <body>
    <form action="" method="post">
      <input type="hidden" name="action" value="submit" />
      <input name="name" type="text" placeholder="名前">
      <input name="message" type="text" placeholder="取引物">
      <input type="submit" name="add" value="送信">
      <h1><a href="show2.php">表を見る </a></h1>
    </form>
  </body>
  </html>
  