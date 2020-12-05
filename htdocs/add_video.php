<?php session_start();
include "config.php";
?>

<?php
$user_id = $_GET['idx'];
$url= $_POST['url'];
$add_date = date("Y-m-d");

$youtube_id= substr($url,-11);

$sql ="select max(video_id) as max from video";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
$new_video_id = $row['max']+1;

//이미 동일한 비디오가 존재하는지 확인
$check_exist= "SELECT *
                from video,user_video
                where (video.video_id=user_video.video_id
                and video.link='$youtube_id'
                and user_video.user_id='$user_id');";

$result_0 = mysqli_query($conn, $check_exist);
$count = mysqli_num_rows($result_0);

if($count > 0){
  ?>
  <script>alert("Video already exists!");</script>
<?php

}else{

   $sql1 = "INSERT into video(video_id, link, add_date) values('$new_video_id', '$youtube_id', '$add_date')";
   $result_1 = mysqli_query($conn, $sql1);

   $sql2 = "INSERT into user_video(user_id, video_id) values($user_id, $new_video_id)";
   $result_2 = mysqli_query($conn, $sql2); ?>
 <script>alert("Video is added!");</script>
<?php
}


?>
