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

$sql = "SELECT name, message FROM merukari_member WHERE name=? AND message=?";
if ($stmt = $conn->prepare($sql)) {
    // 条件値をSQLにバインドする（補足参照）
    $name = "あ";
    $message = "おおおお";
    $stmt->bind_param("is", $name, $message);

    // 実行
    $stmt->execute();

    // 取得結果を変数にバインドする
    $stmt->bind_result($name, $message);
    while ($stmt->fetch()) {
        echo "ID=$name, NAME=$message<br>"; 
    }
    $stmt->close();
}


echo "Hello world heroku";
?>