<?php
session_start();
if(!empty($_POST['id'])) {
  $id = $_POST['id'];
  $list = array("id" => $id);
  header("Content-type: application/json; charset=UTF-8");
  echo json_encode($list);
  $_SESSION['list'] = $list;
  exit;


}

if(!empty($_POST['delete'])) {
  $id = $_POST['delete'];
  $list = array("delete" => $id);
  header("Content-type: application/json; charset=UTF-8");
  echo json_encode($list);
  $_SESSION['list'] = $list;
  exit;


}

?>