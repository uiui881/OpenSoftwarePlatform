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
  body{
      font-family: 'Do Hyeon', sans-serif;
  }
</style>
</head>

<body>
<form action="change_weight.php?idx=<?php echo $user_id; ?>" method="post" style="padding-top:100px;">
<table style="margin-left:auto; margin-right:auto;">
    <tr><th colspan="2"><h1>Change Weight Goal</h1></th></tr>
	<tr><td style="font-size:20px; padding:5px;">Weight Goal : </td><td style="padding:5px;"><input type ="text" style="height:20pt; width: 280px;" name="new_weight_goal" required> kg</td></tr>
	<tr><td colspan="2" style="padding-top: 20px; text-align:center; font-size:20px; ">
    <input type="submit" style="height:25pt; width: 120px;font-size:20px; font-weight: bold; background-color: #ff4d00  ; color:#ffffff; border-radius: 10px;" value="Save"></td></tr>
</table>
</form>




</body>



</html;>
