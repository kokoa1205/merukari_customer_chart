<?php
try {
    $db = new PDO('mysql:host=us-cdbr-east-03.cleardb.com;dbname=heroku_2d2cba8e97d9cc4;charset=utf8','b19efb86254b6f','b400c1e5');
  } catch(PDOException $e) {
    print('DB接続エラー:' . $e->getMessage());
  }

  ?>