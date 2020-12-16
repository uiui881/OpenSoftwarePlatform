<?php
include "header.php";
?>

<html>
<head>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<style>
#add_weight_button{
  width:50px;
  height:50px;
  border-radius:50%;
  background-color:#ff4d00 ;
  border:none;
}
  /* 그래프 */
  .graph {
  	width: 400px;
  }

  canvas {
  	background-color:white;
  	border: 2px solid #be9b7b;
  	display: block;
  }

</style>
</head>

<div style="padding-left: 150px;"><h1 style="margin-bottom: 0px;">My Weight Log</h1></div>

<body>

<table style="width:1000px;margin-left:auto; margin-right:auto; font-size:30;">
  <tr><td style="text-align:left;">
  <?php
    $sql2 = "SELECT goal FROM users WHERE user_id=$user_id;";
    $result2 = mysqli_query($conn, $sql2);
    $goal = mysqli_fetch_array($result2);
    echo 'Weight Goal : '.$goal['goal'].'kg';
?>
<?php
echo '<button onclick="javascript:openChangePage()" type="button" id="change_weight_button" style="color:white;margin-left:30px;width:130px;height:50px;background-color:#ff4d00;border:none;font-size :15pt;" >Change Goal</button>';


$path0 = "./change_weight_form.php";

echo "<script>
function openChangePage()
{
window.open('$path0', 'startpop', 'top=0, left=0, width=500, height=350, scrollbars=no, resizable=no ,status=no ,toolbar=no, left=500, top=200');
} </script>";
?>
</td>

<td style="text-align:right;">
<?php


//  $user_id=$_GET['idx'];

  $sql = "SELECT * FROM weight_record WHERE user_id=$user_id;";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  echo 'Add Weight ';
  echo '<button onclick="javascript:openAddPage()" type="button" id="add_weight_button" style="color:white;  font-size :25pt;" >+</button>';

  //$path1 = 'location.href="./add_weight_form.php?idx='.$row['user_id'].'"';
  $path1 = "./add_weight_form.php";

  echo "<script>
  function openAddPage()
  {
  window.open('$path1', 'startpop', 'top=0, left=0, width=500, height=350, scrollbars=no, resizable=no ,status=no ,toolbar=no, left=500, top=200');
  } </script>";
  ?>
</td>
</tr>
</table>





  <!-- weight graph-->

<div class="graph" style="width:1000px; margin-left:auto; margin-right:auto;"><canvas id="weight_chart"></canvas></div>

<?php
$arr1 = [];
$arr2 = [];


 $result = mysqli_query($conn, "SELECT * FROM weight_record WHERE user_id=$user_id;");
 $i=0;
 while($row = mysqli_fetch_assoc($result)){
   $arr1[$i]= $row['add_date'];
   $arr2[$i]= $row['weight'];
   $i++;
 }

$arrForJS1 = json_encode($arr1);  //date
$arrForJS2 = json_encode($arr2);  //weight

echo '<script> var ctx = document.getElementById("weight_chart").getContext("2d");
var chart = new Chart(ctx, {
	type: "line",
	data: {
		labels: '.$arrForJS1.' ,
		datasets: [{
			label: "Weight",
			backgroundColor: "transparent",
			borderColor: "#ff4d00",
			data: '.$arrForJS2.'  }]
	},
	options: {} });
	</script>';
?>


</body>




</html>
