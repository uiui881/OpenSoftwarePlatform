<?php
	session_start();
	include "config.php";
?>
<?php

	$email =$_POST['email'];
	$password = $_POST['password'];
	

	$query ="SELECT * FROM users WHERE email= '$email'";
	$result = $conn->query($query);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	if( $row['password'] == $password ){
		$_SESSION['name'] = $row['name'];
		//echo $_SESSION['name'];
			?><script>alert("login success");
		     location.replace('./main.php')</script>	     
	<?php
		}

		else{
	?>
	<script>
		alert("invalid password!! try again please :) ");
		location.replace('./login.php')</script>
	<?php
		}
	?>
