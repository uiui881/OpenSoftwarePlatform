<?php include "header.php"; ?>

<html>

<head>
  <title>YouTraining - My Videos</title>
  <style>
  #thumbnail {
    overflow: hidden;
    margin: 0 auto;
    border-radius: 14px;
    box-shadow: 0 5px 20px rgba(0,0,0,.2);
    background: #fff;
  }

  #thumbnail img {
    transition: 0.3s all ease-in-out;
  }

  #thumbnail:hover img {
    transform: scale(1.05);
  }

  #addVideo-a {
    text-decoration: none;
    color: grey;
  }

  #addVideo-a:hover {
    color: red;
  }

  #addVideo-div {
    overflow: hidden;
    text-align:center;
    width:380px;
    height:215px;
    box-shadow: 0 5px 20px rgba(0,0,0,.2);
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e8eef3;
    cursor: pointer;
  }

  #addVideo-div i {
    transition: 0.3s all ease-in-out;
  }

  #addVideo-div:hover i {
    transform: scale(1.1);
  }

  a {
    color:grey;
  }
  a:hover {
    color:red;
  }

  </style>
</head>

<body>

  <div style="padding-left: 150px;"><h1 style="margin-bottom: 0px;">Your Videos</h1></div>

  <?php
  # user가 구독하고 있는 동영상 찾기
  $sql = "SELECT * FROM user_video, video WHERE user_id = $user_id AND user_video.video_id = video.video_id";
  $result = mysqli_query($conn, $sql);

  echo '<table style="margin: auto; border-spacing: 50px 50px">';
  $i = 0;
  while($row = mysqli_fetch_array($result)) {
    if($i == '0') {
      echo '<tr>';
    }
    $video_id = $row['video_id'];

    $sql2 = "SELECT MAX(date) AS maxDate, count(DATE) AS count FROM record WHERE user_id = $user_id AND video_id = $video_id AND done=true";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);

    $link = $row['link'];
    echo '
    <td style="vertical-align: top; width:385px">
      <div id="thumbnail">
        <a href="ExerciseCheck.php?videoId='.$video_id.'"><img src="http://i3.ytimg.com/vi/'.$link.'/maxresdefault.jpg" width="385" height="215"></a>
      </div>
      <div style="margin-top: 5px;">'.$row['title'].'</div>
      <div>
        <i class="material-icons" style="position: relative;top: 5px;">event_available</i> '.$row2['count'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$row2['maxDate'].'
        <a href="delete.php?videoId='.$video_id.'">
          <i class="delete-icon material-icons" style="position: relative;top: 4px; float:right; cursor:pointer; font-size:30px">delete</i>
        </a>
      </div>
    </td>';

    $i++;

    if($i == '3') {
      echo '</tr>';
      $i = 0;
    }
  }

  if($i != 0) {
    echo '
    <td style="vertical-align: top;">
      <a id="addVideo-a" href="search.php">
        <div id="addVideo-div">
          <div style="margin-top:45px">
            <i class="material-icons" style="font-size:100px;">video_call</i>
            <br>Add Video<br>
          </div>
        </div>
        <div style="height: 30px;"></div>
      </a>
    </td>';
    echo '</tr>';
  }
  else {
    echo '
    <tr>
      <td>
        <a id="addVideo-a" href="search.php">
          <div id="addVideo-div">
            <div style="margin-top:45px">
              <i class="material-icons" style="font-size:100px;">video_call</i>
              <br>Add Video<br>
            </div>
          </div>
          <div style="height: 30px;"></div>
        </a>
      </td>
    </tr>';
  }

  echo '</table>';
  ?>

</body>
</html>
