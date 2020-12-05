<?php session_start();
include "config.php";
$user_id=2; //확인용으로 임의로 1이라고 둠
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
<form action="add_video.php?idx=<?php echo $user_id; ?>" method="post" style="padding-top: 100px;">
<table style="margin-left:auto; margin-right:auto;">
    <tr><th colspan="2"><h1>Add Video</h1></th></tr>
	<tr><td style="font-size:20px; padding:5px;"> URL : </td><td style="padding:5px;"><input type ="text" style="height:20pt; width: 500px;" name="url" required> </td></tr>
	<tr><td colspan="2" style="padding-top: 20px; text-align:center; font-size:20px; ">
    <input type="submit" style="height:25pt; width: 120px; font-weight: bold; background-color: #ff0000 ; color:#ffffff; border-radius: 10px;" value="Save"></td></tr>
</table>
</form>

</body>



</html;>
