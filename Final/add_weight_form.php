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
  body{
    font-family: 'Do Hyeon', sans-serif;
  }
  input {
    font-family: 'Do Hyeon', sans-serif;
  }
  input[type=text] {
    width: 100%;
    padding: 5px 10px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    outline-color: #ff4d00;
    font-size: 16px;
    width: 192px;
  }
  #save-btn {
    width: 100px;
    border-radius: 50px;
    color: white;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    outline: none;
    background-color: #ff4d00;
    border: 2px solid;
  }

  #save-btn:hover {
    background-color: white;
    color: black;
    border: 2px solid #ff4d00;
  }
  </style>
</head>

<body>

  <form action="add_weight.php?idx=<?php echo $user_id; ?>" method="post" style="padding-top:50px;">
    <table style="margin-left:auto; margin-right:auto; text-align:center; border-spacing: 5px 10px">
      <tr><th colspan="2"><h1 style="margin-bottom: 0px;">Add Weight</h1></th></tr>
      <tr>
        <td style="padding:5px;"><input type ="text" name="new_weight" required> kg</td>
      </tr>
      <tr>
        <td colspan="2">
        <input id="save-btn" type="submit" value="Save"></td>
      </tr>
    </table>
</form>




</body>



</html;>
