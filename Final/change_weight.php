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

<?php

$new_weight_goal = $_POST['new_weight_goal'];


$conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
$conn->autocommit(FALSE);




 $sql= "UPDATE users set goal='$new_weight_goal' where user_id=$user_id;";
 $result = mysqli_query($conn, $sql);

 if(!is_numeric($new_weight_goal)){	//몸무게로 숫자가 아닌 값이 입력된 경우
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
	 alert('Weight Goal is modified!');
  opener.parent.window.location.reload();
	 window.open("about:blank","_self").close();
 </script>
<?php
}

?>



</main>

</body>
</html>
