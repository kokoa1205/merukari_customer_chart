
  <?php
  session_start();
  require('dbconnect.php');
  date_default_timezone_set('Asia/Tokyo');

  if(isset($_POST['add'])) {
    if (empty($_POST['time'])) {
      $sql = "INSERT INTO merukari_member (name, message,created) VALUES (:name, :message, :created)";
      $stmt = $db->prepare($sql);
      $params = array(':name' => $_POST['name'], ':message' => $_POST['message'], ':created'=>date('Y-m-d H:i:s'));
      $stmt->execute($params);
      echo '登録完了しました';
    } else {
      $sql = "INSERT INTO merukari_member (name, message,created) VALUES (:name, :message, :created)";
      $stmt = $db->prepare($sql);
      $params = array(':name' => $_POST['name'], ':message' => $_POST['message'],':created'=>$_POST['time']);
      $stmt->execute($params);
      echo '登録完了しました';
    }
  }
  
  ?>
  <!DOCTYPE html>
  <html lang="ja">
  
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/insert.css"> -->
    <link rel="stylesheet" href="../css/insert.css">
    <title>Document</title>
  </head>
  
  <body>
  <style>
#submit {
  width: 500px;
  
  padding: 0;
  /* margin: -10px 0px 0px 0px; */
  
  font-family: 'Lato', sans-serif;
  font-size: 0.875em;
  color: #b3aca7;
  
  outline:none;
  cursor: pointer;
  
  border: solid 1px #b3aca7;

  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
}
  </style>
  <form id="form" class="topBefore" method="post">
    <input type="hidden" name="action" value="submit" />
    <input id="name" type="text" placeholder="NAME" name="name">
    <input id="email" type="text" placeholder="comment" name="message">
    <input id="name" type="datetime-local" name="time">
    <input id="submit" type="submit" value="GO!" name="add">
    <p><a href="show.php" class="show">表を見る </a></p>
  </form>
  </body>
  </html>
  