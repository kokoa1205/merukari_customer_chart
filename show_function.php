<?php

function get_all_user_count()
{
    require('dbconnect.php');
    $sql = "SELECT count(*) FROM merukari_member";

    if (isset($_POST['search'])) {
        $sql = "SELECT count(*) FROM merukari_member where name = '".$_POST['name']. "'";
    }
    $stmts = $db->prepare($sql);
    $res = $stmts->execute();
    if ($res) {
        $all_users = $stmts->fetch();
    }
    return $all_users['count(*)'];
}
