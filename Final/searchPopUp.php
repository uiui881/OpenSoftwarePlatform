<?php
include "addVideo.php";
include "header.php";

if ($_GET["search_add"]) {
  echo $_GET["search_add"];
  $add_date = date("Y-m-d");
  $title = $_GET["title"];
  $youtube_id = $_GET["search_add"];
  addVideo($user_id, $add_date, $youtube_id, $title, $conn);
}

?>
