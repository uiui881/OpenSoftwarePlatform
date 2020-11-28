<?php session_start();
include "config.php";
?>

<?php
$user_id = 1;
$new_weight = $_POST['new_weight'];
$new_date = $_POST['new_date'];


	$sql = "INSERT into weight_record(user_id, date, weight) values('$user_id','$new_date', '$new_weight');";
	$result = mysqli_query($conn, $sql);

	if(!is_numeric($new_weight)){
?>
	 	<script>alert('Weight must be a number. Try again!');
      window.open("about:blank","_self").close();</script>
<?php
	 }
   else{
   ?>
	<script>
		alert('Weight is added!');
    window.open("about:blank","_self").close();

  </script>
<?php
}
?>


</main>

</body>
</html>
