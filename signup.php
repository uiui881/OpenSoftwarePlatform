<?php

include "header.php";

?>

<?php
$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$goal = $_POST['goal'];
$sql ="insert into users(email, password, name, goal) values('".
$email."', '".$password."', '".$name."',".$goal." )";
$result = mysqli_query($conn, $sql);


	if($result){
		?><script>
		alert('회원 가입을 축하합니다.');
		location.replace('./main.php');
		</script>
	<?php }
	else if(!$result){
		?><script>
		alert('회원가입 실패, 이미 존재하는 ID 입니다');
		location.replace('./signupForm.php');
		</script><?php
	}else{}
?>


</html>