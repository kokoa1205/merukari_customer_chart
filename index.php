<?php

// Get Heroku clearDB connection information
$cleardb_url  = parse_url(getenv("CLEAROB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);

$active_group = 'default';
$query_builder = TRUE;

// connect DB
$conn = mysqli_connect($cleardb_server,$cleardb_username,$cleardb_password,$cleardb_db);



$sql = "INSERT INTO merukari_member (name, message, created) VALUES (:name, :message, now())";
$stmt = $dbh->prepare($sql);
$params = array(':name' => '綾瀬', ':message' => 'aaa');
$stmt->execute($params);
echo '登録完了しました';


echo "Hello world heroku";
?>