<?php

function get_all_user_count()
{
  require('dbconnect.php');

  $stmts = $db->prepare("SELECT count(*) FROM merukari_member");
  $res = $stmts->execute();
  if ($res) {
      $all_users = $stmts->fetch();
  }
  return $all_users['count(*)'];
}
