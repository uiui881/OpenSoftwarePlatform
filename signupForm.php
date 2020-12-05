<?php
include "header.php";
?>

<html>
<form action="signup.php" method="post">

<div style="padding-top: 100px; text-align: center;">
	<p style="font-size: 40pt; font-weight: bold">SIGN UP</p>

	<h1>E-mail : <input type ="text" name="email" style="width: 300px; height: 30px;" required><br></h1>
	<h1>password : <input type ="password" name="password" style="width: 200px; height: 30px;"required><br></h1>
	<h1>name : <input type ="text" name="name" style="width: 200px; height: 30px;"required><br></h1>

	<h1>goal : <input type ="numeric" name="goal" style="width: 200px; height: 30px;"><br></h1>

	<input type="submit" style="background-color: #854442; color:#ffffff;height: 25pt; width: 100px" value="SIGNUP">
</div>
</form>

</html>
