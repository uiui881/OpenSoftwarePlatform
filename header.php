<?php
session_start();
include "config.php";
?>

<html>

<head>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&display=swap');
  body {
    font-family: 'Do Hyeon', sans-serif;
    margin: 0px;
  }

  img {
    width:
  }

  ul {
    height: 55px;
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
  }

  li {
    float: right;
  }

  li a {
    height: 20px;
    display: block;
    color: gray;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 20px;
  }

  li a:hover {
    color: #ff0000;
  }

  i {
    position: relative;
    top: 5px;
  }
  </style>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
  <ul>
    <li><a href="#"><i class="material-icons">account_circle</i> LogOut</a></li>
    <li><a href="#"><i class="material-icons">speed</i> WeightLog</a></li>
    <li><a href="#"><i class="material-icons">calendar_today</i> Calender</a></li>
    <li><a href="#"><i class="material-icons">videocam</i> Videos</a></li>
    <li><a href="#"><i class="material-icons">home</i> Home</a></li>
  </ul>

  <div style="width: 100%; height: 125px; background-color: #ff0000; text-align: center;" >
    <img src="img\logo3.png" style="height: 100%;">
  </div>

</body>

</html>