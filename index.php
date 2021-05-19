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

// $sql = "SELECT name, message FROM member WHERE name=? AND message=?";
// if ($stmt = $mysqli->prepare($sql)) {
//     // 条件値をSQLにバインドする（補足参照）
//     $user_id = 123;
//     $name = "hanako";
//     $stmt->bind_param("is", $user_id, $name);

//     // 実行
//     $stmt->execute();

//     // 取得結果を変数にバインドする
//     $stmt->bind_result($user_id, $name);
//     while ($stmt->fetch()) {
//         echo "ID=$user_id, NAME=$name<br>"; 
//     }
//     $stmt->close();
// }


echo "Hello world heroku";
?>