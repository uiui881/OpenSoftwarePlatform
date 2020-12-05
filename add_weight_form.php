<?php session_start();
include "config.php";

$user_id = $_GET['idx'];
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
<form action="add_weight.php?idx=<?php echo $user_id; ?>" method="post" style="padding-top:100px;">
<table style="margin-left:auto; margin-right:auto;">
    <tr><th colspan="2"><h1>Add Weight</h1></th></tr>
	<tr><td style="font-size:20px; padding:5px;">Weight : </td><td style="padding:5px;"><input type ="text" style="height:20pt; width: 280px;" name="new_weight" required> kg</td></tr>
    <tr><td style="font-size:20px; padding:5px;">Date : </td><td style="padding:5px;"><input type ="date" id="date_weight" name="new_date" min="2010-01-01" max="2021-01-01" style="height:20pt; width: 300px;" required></td></tr>
	<tr><td colspan="2" style="padding-top: 20px; text-align:center; font-size:20px; ">
    <input type="submit" style="height:25pt; width: 120px;font-size:20px; font-weight: bold; background-color: #ff4d00  ; color:#ffffff; border-radius: 10px;" value="Save"></td></tr>
</table>
</form>
<script>
//날짜 선택시 오늘까지만 선택할 수 있도록 하는 코드(max = today)
var today = new Date();
var date = today.getDate();
var month = today.getMonth()+1;
var year = today.getFullYear();
 if(date<10){
        date='0'+date
    }
    if(month<10){
        month='0'+month
    }

today = year+'-'+month+'-'+date;
document.getElementById("date_weight").setAttribute("max", today);
</script>




</body>



</html;>
