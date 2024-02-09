<?php

include('../Classes/Connect.php');
include('../Classes/Login.php');


 $UserNameOrEmail = $Password=null;
if (isset($_POST["UserNameOrEmail"])&&isset($_POST["Password"])) {
  // &&isset($_POST["Login"])
//  echo $_POST["UserNameOrEmail"];
  $UserNameOrEmail = test_input($_POST["UserNameOrEmail"]);
  $Password = test_input($_POST["Password"]);
 

  $loginInstance = new Login($UserNameOrEmail,$Password);
  $loginInstance->signIn();
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);//check what it does
  $data = htmlspecialchars($data);
  return $data;
}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login In</title>
    <link rel="stylesheet" href="Login.css">
</head>

<body>
    <header>
        <nav class="header__nav">
            <div class="buno_logo">
                <img src="buno.png" alt="logo">
                <a href="#" class="header__logo">BUNO</a>
            </div>
            <h4>Welcome Back!</h4>
        </nav>
    </header>
    <section class="login-form">
        <h2 class="login-form__title">Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

            <div class="input-box">
                <input type="text" name="UserNameOrEmail" id="username" required placeholder="Username or Email">
            </div>
            <div class="input-box">
                <input type="password" name="Password" id="password" required placeholder="Password">
            </div>
            <input type="submit" value="Login" name="Login" class="login-btn"> <br>
            <div class="or">
                <hr>
                <h6>or</h6>
                <hr>
            </div>
            <a href="../SignUp/SignUp.php" class="signup-btn">Sign Up</a>
        </form>
    </section>
</body>

</html>