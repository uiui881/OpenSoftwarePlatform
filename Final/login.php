<?php
session_start();
include "config.php";
?>

<html>

<head>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&display=swap');

  * {
    font-family: 'Do Hyeon', sans-serif;
  }

  body {
    background-color: red; /* For browsers that do not support gradients  */
    background-image: linear-gradient(to bottom right, #ffc100, #ff0000);
    display: flex;
    align-items: center;
  }

  #signup-btn, #login-btn {
    width: 100%;
    border-radius: 50px;
    color: white;
    padding: 10px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    outline: none;
  }

  #signup-btn {
    background-color: #ff0000;
    border: 2px solid;
  }

  #signup-btn:hover {
    background-color: white;
    color: black;
    border: 2px solid #ff0000;
  }

  #login-btn {
    background-color: #ff7400;
    border: 2px solid;
  }

  #login-btn:hover {
    background-color: white;
    color: black;
    border: 2px solid #ff7400;
  }

  input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    outline-color: #ff4d00;
    font-size: 16px;
  }
  </style>
</head>

<body>

  <table style="width: 60%; height: 70%; margin: auto; text-align: center;">
    <tr>

      <td style="width: 50%; background-color: white;">
        <img src="img\logo1.png" style="width: 90%; background-color: white;">
      </td>

      <td style="width: 50%; background-color: rgba(0, 0, 0, 0.5);">

        <table style="width: 70%; text-align: center; margin: auto; background-color: white; padding: 15px;">
          <tr><td><h1>Log In</h1></td></tr>
          <form action="" method="post">
            <tr>
              <td><input type="text" placeholder="E-mail" name="email" required></td>
            </tr>
            <tr>
              <td><input type="password" placeholder="Password" name="password" required></td>
            </tr>
            <tr>
              <td><input id="login-btn" type="submit" name="login" value="Log In"></td>
            </tr>
          </form>
          <tr><td>or</td></tr>
          <tr><td>
            <button id="signup-btn" onclick="signupForm()" >Sign Up</button>
            <script>
              function signupForm(){
                location.href ="./signup.php";
              }
            </script>
          </td></tr>
        </table>

      </td>
    </tr>
  </table>


<?php
if(isset($_POST['login'])) {
  $email =$_POST['email'];
	$password = $_POST['password'];

	$query ="SELECT * FROM users WHERE email= '$email'";
	$result = $conn->query($query);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	if( $row['password'] == $password ){
		$_SESSION['name'] = $row['name'];
		//echo $_SESSION['name'];
    echo '
    <script>
      alert("Login Success");
      document.location.href="./main.php";
    </script>';
	}
  else{
    echo '
    <script>
  		alert("Invalid password! Please try again :) ");
  		document.location.href="./login.php";
    </script>';
	}
}
?>

</body>

</html>
