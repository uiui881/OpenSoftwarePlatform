<?php session_start();
include "config.php";

?>

<?php
$user_id = 1;
$new_weight = $_POST['new_weight'];
$new_date = $_POST['new_date'];

$conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
$conn->autocommit(FALSE);

//이미 해당 날짜에 몸무가 입력되어 있는 경우 몸무게 수정
$check_exist= "SELECT *
                from weight_record
                where date='$new_date';";

$result_0 = mysqli_query($conn, $check_exist);
$count = mysqli_num_rows($result_0);

if($count > 0){	//해당 날짜 몸무게가 이미 저장되어 있는 경우
 $sql= "UPDATE weight_record set weight='$new_weight' where date='$new_date';";
 $result = mysqli_query($conn, $sql);

 if(!is_numeric($new_weight)){	//몸무게로 숫자가 아닌 값이 입력된 경우
	   $conn->rollback();
?>
	 <script>alert('Weight must be a number. Try again!');
		 window.open("about:blank","_self").close();</script>
<?php
	}
	else{
		$conn->commit();
		$conn -> autocommit(TRUE);
	?>
 <script>
	 alert('Weight is modified!');
	 window.open("about:blank","_self").close();

 </script>
<?php
}

}else{	//새로운 날짜에 몸무게 입력

	$sql = "INSERT into weight_record(user_id, date, weight) values('$user_id','$new_date', '$new_weight');";
	$result = mysqli_query($conn, $sql);

	if(!is_numeric($new_weight)){    //몸무게로 숫자가 아닌 값이 입력된 경우
		  $conn->rollback();

?>
	 	<script>alert('Weight must be a number. Try again!');
      window.open("about:blank","_self").close();</script>
<?php
	 }
   else{
		 $conn->commit();
		 $conn -> autocommit(TRUE);
   ?>
	<script>
		alert('Weight is added!');
    window.open("about:blank","_self").close();

  </script>
<?php
}


}
?>




</main>

</body>
</html>
