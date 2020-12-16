<?php
function addVideo($uid, $date, $yid, $ttl, $connection) {
  $sql = "SELECT MAX(video_id) AS max FROM video";
  $result = mysqli_query($connection, $sql);
  $row = $result->fetch_array(MYSQLI_ASSOC);
  $new_video_id = $row['max']+1;
  //이미 동일한 비디오가 존재하는지 확인
  $check_exist= "SELECT *
                 FROM video,user_video
                 WHERE (video.video_id=user_video.video_id
                 AND video.link='$yid'
                 AND user_video.user_id='$uid');";

  $result_0 = mysqli_query($connection, $check_exist);
  $count = mysqli_num_rows($result_0);

  if($count > 0) {
    echo '
    <script>
      alert("Video already exists!");
      window.location.href="search.php";
    </script>';
  }
  else {
    $sql1 = "INSERT INTO video(video_id, link, title) VALUES($new_video_id, '$yid', '$ttl')";
    $result_1 = mysqli_query($connection, $sql1);

    $sql2 = "INSERT INTO user_video(user_id, video_id, add_date) VALUES($uid, $new_video_id, '$date')";
    $result_2 = mysqli_query($connection, $sql2);
    echo '
    <script>
      alert("Video is added!");
      window.location.href="search.php";
    </script>';
  }
}
 ?>
