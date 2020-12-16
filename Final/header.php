<?php
session_start();
include "config.php";
$name = $_SESSION['name'];
$sql1 = "SELECT * FROM users where name = '$name'";
# name을 통해서 user정보를 찾기
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1);
$user_id = $row1['user_id'];
?>

<html>

<head>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&display=swap');

  * {
    font-family: 'Do Hyeon', sans-serif;
  }

  body {
    margin: 0px;
  }

  .header-div img {
    width:
  }

  .header-ul {
    height: 55px;
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
  }

  .header-ul li {
    float: right;
  }

  .header-ul li a {
    height: 20px;
    display: block;
    color: gray;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 20px;
  }

  .header-ul li a:hover {
    color: #ff0000;
  }

  .header-ul i {
    position: relative;
    top: 5px;
  }
  </style>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
  <ul class="header-ul">
    <?php  echo '<li style="float: left;"><h1 style="margin-top: 5px;margin-left: 20px;">You can do it, '.$name.'!</h1></li>'; ?>
    <li><a href="logout.php"><i class="material-icons">account_circle</i> LogOut</a></li>
    <li><a href="weight.php"><i class="material-icons">insights</i> WeightLog</a></li>
    <li><a href="reservation.php"><i class="material-icons">calendar_today</i> Calender</a></li>
    <li><a href="search.php"><i class="material-icons">search</i> Search</a></li>
    <li><a href="main.php"><i class="material-icons">videocam</i> My Videos</a></li>
  </ul>

  <div class="header-div" style="width: 100%; height: 125px; background-color: #ff0000; text-align: center;" >
    <img src="img\logo3.png" style="height: 100%;">
  </div>

</body>

</html>
