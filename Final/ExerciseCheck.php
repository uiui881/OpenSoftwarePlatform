<?php

include "header.php";

$video_id = $_GET['videoId'];
$sql="SELECT add_date FROM user_video WHERE video_id = $video_id;";
$res = mysqli_query($conn,$sql);
$row= mysqli_fetch_array($res);

$startdate=date_create($row['add_date']);
$todaydate=new DateTime(date("Y-m-d"));

$dd=date_diff($startdate,$todaydate);

$sql2="SELECT link FROM video WHERE video_id = $video_id;";
$res2 = mysqli_query($conn,$sql2);
$row2= mysqli_fetch_array($res2);

$sql22="SELECT * FROM record WHERE video_id=$video_id AND date='".date("Y-m-d")."';";
$res22=mysqli_query($conn,$sql22);
$count22 = mysqli_num_rows($res22);

?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Check</title>
  <style>
  #checkbox {
    position: relative;
    top: 5px;
    width:20px;
    height:20px;
  }
  #confirm-btn {
    width: 100px;
    border-radius: 50px;
    color: white;
    padding: 10px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    outline: none;
    background-color: #ff0000;
    color:white;
    border: 2px solid;
  }

  #confirm-btn:hover {
    background-color: white;
    color: black;
    border: 2px solid #ff0000;
  }
  </style>
</head>

<body>
  <div style="padding-left: 150px;"><h1 style="margin-bottom: 15px;">Check Exercise</h1></div>

  <table style="margin:auto; text-align:center; width:1000px; font-size:25px">
    <tr>
      <td>
        <?php echo '<iframe width="1000" height="563" src="https://www.youtube.com/embed/'.$row2['link'].'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';?>
      </td>
    </tr>
    <tr>
      <td style="padding-top: 20px;">
        <?php
        if($count22>0) {
          echo 'You finished this exercise today.';
        }
        else {
          if(($dd->days + 1) % 10 == 1) {
            $dday = ($dd->days + 1).'st';
          }
          else if(($dd->days + 1) % 10 == 2) {
            $dday = ($dd->days + 1).'nd';
          }
          else if(($dd->days + 1) % 10 == 3) {
            $dday = ($dd->days + 1).'rd';
          }
          else {
            $dday = ($dd->days + 1).'th';
          }
          echo '
            <form action="" method="POST">
              '.date("m/d").'&nbsp&nbsp&nbsp'.$dday.' day&nbsp&nbsp&nbsp
              <input id="checkbox" type="checkbox" name="chk1">
              <input type="submit" name="sub" id="confirm-btn" value="Confirm">
            </form>
          ';
        }
        ?>
      </td>
    </tr>
  </table>
      <br>

<?php
  if(isset($_POST['chk1'])) {
   $just=$_POST['chk1'];

   if($just=="on"){
      $sql="insert into record(user_id, video_id, date, done) values ($user_id,$video_id,'".date("Y-m-d")."',TRUE)";
      $res = mysqli_query($conn,$sql);

      echo "체크되었습니다!";
   }
 }

?>
</body>

</html>
