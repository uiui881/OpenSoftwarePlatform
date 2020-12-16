<?php include "config.php"; ?>
<?php error_reporting(0); ?>

<html>

<head>
	<title>YouTraining - Sign Up</title>
	<style>
	@import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&display=swap');

	* {
    font-family: 'Do Hyeon', sans-serif;
  }

  body {
    margin: 0px;
		background-color: red; /* For browsers that do not support gradients */
    background-image: linear-gradient(to bottom right, #ffc100, #ff0000);
    display: flex;
    align-items: center;
  }

	#signup-div {
		width: 40%;
		height: 70%;
		margin-left: auto;
		margin-right: auto;
		background-color: rgba(0, 0, 0, 0.5);
	}

	#signup-tbl {
		width: 30%;
		margin: 0;
	  position: absolute;
	  top: 50%;
	  left: 50%;
	  -ms-transform: translate(-50%, -50%);
	  transform: translate(-50%, -50%);
		background-color: white;
	}

	input[type=text], input[type=password], input[type=numeric] {
		width: 100%;
    padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		box-sizing: border-box;
		outline-color: #ff4d00;
		font-size: 16px;
	}

	input[type=submit] {
		width: 60%;
    border-radius: 50px;
    color: white;
    padding: 10px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    outline: none;
		background-color: #ff0000;
    border: 2px solid;
	}

	input[type=submit]:hover {
		background-color: white;
	 	color: black;
	  border: 2px solid #ff0000;
	}
	</style>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>

	<div id="signup-div">
		<table id="signup-tbl">
			<form action="" method="post" style="margin-top: 30px;">
				<tr>
					<td colspan="2" style="text-align: center; padding-top: 20px;"><h2>Sign Up</h2></td>
				</tr>
				<tr>
					<td style="text-align: center;"><i class="material-icons">email</i></td>
					<td style="padding-right: 20px;"><input type ="text" name="email" placeholder="E-mail" required></td>
				</tr>
				<tr>
					<td style="text-align: center;"><i class="material-icons">lock</i></td>
					<td style="padding-right: 20px;"><input type ="password" name="password" placeholder="Password" required></td>
				</tr>
				<tr>
					<td style="text-align: center;"><i class="material-icons">face</i></td>
					<td style="padding-right: 20px;"><input type ="text" name="name" placeholder="Name" required></td>
				</tr>
				<tr>
					<td style="text-align: center;"><i class="material-icons">speed</i></td>
					<td style="padding-right: 20px;"><input type ="numeric" name="goal" placeholder="Target weight"></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: center;padding-bottom: 20px;"><input type="submit" name="signup" value="SIGN UP" style="margin-top: 20px;"></td>
				</tr>
			</form>
		</table>
	</div>

<?php
if(isset($_POST['signup'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	if(!empty($_POST['goal'])) {
		$goal = $_POST['goal'];
		$sql2 = "INSERT INTO users(email, password, name, goal) VALUES('$email', '$password', '$name', $goal)";
	}
	else {
		$sql2 = "INSERT INTO users(email, password, name) VALUES('$email', '$password', '$name')";
	}

	$sql = "SELECT email FROM users WHERE email='$email'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);

	if(is_null($row['email'])) {
		mysqli_query($conn, $sql2);
		echo '
		<script>
			alert("회원 가입을 축하합니다.");
			location.replace("./login.php");
		</script>';
	}
	else {
		echo '
		<script>
			alert("회원가입 실패, 이미 존재하는 ID 입니다");
			location.replace("./login.php");
		</script>';
	}
}
?>

</body>

</html>
