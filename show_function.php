<?php 
function get_all_user_count() {
  require('dbconnect.php');

  $sql = "SELECT count(*) FROM merukari_member";
  $all_users = $db->query($sql);
  echo $all_users;
  return $all_users;
}