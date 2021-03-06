<!-- git push heroku master -->
<?php
session_start();

require('dbconnect.php');
require('page.php');
require('show_function.php');
date_default_timezone_set('Asia/Tokyo');

if (isset($_GET['page'])) {
    $page_id = $_GET['page'];
} else {
    $page_id = 1;
}
$one_page_posts = 10;
$limit_start_count = $page_id * $one_page_posts - $one_page_posts;

// 全ユーザーの件数を取得
$all_users_count = get_all_user_count();


if (!empty($_SESSION['list']['id'])) {
    $update = "UPDATE merukari_member SET created = :created WHERE id = :id";
    $update_stmt = $db->prepare($update);
    $update_params = array(':id' => $_SESSION['list']['id'], ':created' => date('Y-m-d H:i:s'));
    $update_stmt->execute($update_params);
    unset($_SESSION['list']['id']);
}
if (!empty($_SESSION['list']['delete'])) {
    $delete = "DELETE FROM merukari_member WHERE id = :id";
    $delete_stmt = $db->prepare($delete);
    $delete_params = array(':id' => $_SESSION['list']['delete']);
    $delete_stmt->execute($delete_params);
    unset($_SESSION['list']['delete']);
    print($_SESSION['list']['delete']);
}

// ユーザーの取得
$sql = "SELECT * FROM merukari_member ORDER BY created desc limit ".$limit_start_count." , ".$one_page_posts;
if (isset($_POST["sort"]) && $_POST["sort"] == "desc") {
    //降順に並び替えるSQL文に変更
    $sql = str_replace('name', '', $sql);
    $sql = $sql . " created";
}

if (isset($_POST['reset'])) {
  unset($_POST['name']);
}

if (isset($_POST['search'])) {
  $sql = "SELECT * FROM merukari_member where name =  '" .$_POST['name']. "' ORDER BY created desc limit ".$limit_start_count." , ".$one_page_posts;
}
$row_count = [];
$stmt = $db->query($sql);
if (isset($_POST['a'])) {
    $alart = "SELECT * FROM merukari_member WHERE id=:id";
    $alart_stmt = $db->prepare($alart);
    $alart_params = array(':id' => $_SESSION['list']['alart']);

    $alert = "<script type='text/javascript'>alert('".$alert_message."');</script>";
    echo $alert;
}





// 下に書いてもいいけどstmtを被らせないようにする
// $count = 0;
// $name = array();
// foreach ($stmt as $target) {
//     $name[$count]['id'] = $target['id'];
//     $name[$count]['name'] = $target['name'];
//     $name[$count]['message'] = $target['message'];
//     $name[$count]['created'] = substr($target['created'], 0, strcspn($target['created'], ' '));
//     $count++;
// }
// // var_dump($name);
// echo date('y-m-d', strtotime( "2021-10-2 -1 day"));
// echo date('y-m-d', strtotime( $name[0]['created'] . " -1 day"));
// $delete_index = array();
// for ($i = 0;$i<count($name);$i++) {
//     for ($j = $i+1;$j<count($name);$j++) {
//         if ($name[$i]['name'] == $name[$j]['name'] && strtotime($name[$i]['created']) == date('y-m-d', strtotime( $name[$j]['created'] . " -1 day")) && $name[$i]['message'] == $name[$j]['message']) {
//             // try {
//             //     $delete = "DELETE FROM merukari_member WHERE id = :id";
//             //     $delete_stmt = $db->prepare($delete);
//             //     $delete_params = array(':id' => $name[$j]['id']);
//             //     $delete_stmt->execute($delete_params);
//             // } catch (Exception $ex) {
//             // }
      
//             $delete_index[$delete_count] = $j;
//             echo $name[$j]['name'];
//             echo $name[$j]['created'];
//             echo '|';
//             $delete_count++;
//         }
//     }
// }

// echo $stmt[0];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="./main.js"></script>
  <link rel="stylesheet" href="./css/show.css">
  <title>Document</title>
</head>
<body>
    <p><a href="insert.php" class="show">入力画面</a></p>
    <div class="search">
    <form method="post" action="show.php">
      <input type="text" name="name" placeholder="検索ワード"> 
      <input type="submit" value="絞り込む" id="button" name="search"> 
      <input type="submit" value="すべて表示" id="button2" name="reset">
        <input type="radio" name="sort" value="asc" 
        <?php
          if (!isset($_POST["sort"]) || $_POST["sort"] != "desc") {
              echo "checked";
          }
        ?> >名前順
        <input type="radio" name="sort" value="desc" 
      <?php
        if (isset($_POST["sort"]) && $_POST["sort"] == "desc") {
            echo "checked";
        }
      ?> >時間順
      <input type="submit" value="並び替え">
    </form>

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
          <!-- ページネーション -->
          <?php
          //オブジェクトを生成
          $pageing = new Paging();
          //1ページ毎の表示数を設定
          $pageing -> count = $one_page_posts;
          //全体の件数を設定しhtmlを生成
          $pageing -> setHtml($all_users_count);
          //ページングクラスを表示
          echo $pageing -> html;
          ?>
          <?php foreach ($stmt as $row): ?>
            <tr>
                <td data-label="内容" class="txt" onclick="alart"><?php htmlspecialchars(print($row['name']), ENT_QUOTES); ?></td>
                <td data-label="内容" class="txt"><?php htmlspecialchars(print($row['message']), ENT_QUOTES); ?></td>
                <td data-label="価格" class="txt"><?php htmlspecialchars(print($row['created']), ENT_QUOTES); ?></td>
                <td data-label="内容" class="txt"><button type="button" class="selectBtn"><input type="hidden" name="name" value="<?php htmlspecialchars(print($row['id']), ENT_QUOTES); ?>">送信</td>
                <td data-label="内容" class="txt"><button type="button" class="deleteBtn" onclick="return"><input type="hidden" name="name" value="<?php htmlspecialchars(print($row['id']), ENT_QUOTES); ?>">削除</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>  
    <p id="return"></p>

</body>
</html>