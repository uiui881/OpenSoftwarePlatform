
<html>

<head>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&display=swap');

  body {
    background-image: url("https://cdn.pixabay.com/photo/2018/01/01/01/56/yoga-3053488_1280.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    display: flex;
    align-items: center;
    font-family: 'Do Hyeon', sans-serif;
  }

  button {
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
  }

  .signup-btn {
    background-color: #ff0000;
    border: 2px solid;
  }

  .signup-btn:hover {
    background-color: white;
    color: black;
    border: 2px solid #ff0000;
  }

  .login-btn {
    background-color: #ff7400;
    border: 2px solid;
  }

  .login-btn:hover {
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
          <tr><td>
            <h1>Log In</h1>
          </td></tr>
          <form>
            <tr><td>
              <input type="text" placeholder="E-mail" name="uname" required>
            </td></tr>
            <tr><td>
              <input type="password" placeholder="Password" name="psw" required>
            </td></tr>
            <tr><td>
              <button class="login-btn ">Log In</button>
            </td></tr>
          </form>
          <tr><td>or</td></tr>
          <tr><td>
            <button class="signup-btn">Sign Up</button>
          </td></tr>
        </table>


      </td>

    </tr>
  </table>

</body>

</html>
