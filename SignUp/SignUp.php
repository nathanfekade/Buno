<?php
include('../Classes/Connect.php');
include('../Classes/Seller.php');
include('../Classes/Buyer.php');
$Con = new Connect;
$db = $Con->getConnection();
?>
<?php
// make it one with the above php

//     error_reporting(E_ALL);
// ini_set('display_errors', 1);

// define variables and set to empty values
$SellerFirstName = $SellerLastName = $SellerUserName = $SellerEmail = $SellerPhoneNo = $SellerPassword = $SignUpAs = "";




if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $SellerFirstName = test_input($_POST["SellerFirstName"]);
  $SellerLastName = test_input($_POST["SellerLastName"]);
  $SellerUserName = test_input($_POST["SellerUserName"]);
  $SellerEmail = test_input($_POST["SellerEmail"]);
  $SellerPhoneNo = test_input($_POST["SellerPhoneNo"]);
  $SellerPassword = test_input($_POST["SellerPassword"]);
  $SignUpAs = test_input($_POST["SignUpAs"]);
  echo $SignUpAs;

  if ($SignUpAs == "Seller") {
    $sellerInstance = new Seller($SellerFirstName, $SellerLastName, $SellerUserName, $SellerEmail, $SellerPhoneNo, $SellerPassword);
    $sellerInstance->addSeller();
  }


  if ($SignUpAs == "Buyer") {
    $buyerInstance = new Buyer($SellerFirstName, $SellerLastName, $SellerUserName, $SellerEmail, $SellerPhoneNo, $SellerPassword);

    $buyerInstance->addBuyer();
  }

  // $sql = "INSERT INTO Seller (SellerFirstName,SellerLastName,SellerUserName,SellerEmail,SellerPhoneNo,SellerPassword) VALUES ('$SellerFirstName','$SellerLastName','$SellerUserName','$SellerEmail','$SellerPhoneNo','$SellerPassword')";
  // $res = $db->query($sql);
  // echo $sql;
  // if ($res) {
  //   echo "<script> alert('Data inserted successfully.')</script>";
  // } else {
  //   echo "<script> alert('Failed to insert data. Error: " . $db->error . "')</script>";
  // }
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data); //check what it does
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="SignUp.css" />
</head>
<style>
  * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
  }

  body {
    font-family: "Exo 2", sans-serif;
    opacity: 1;
  }

  .sign-up {
    background-color: white;
    width: 450px;
    margin: 0 auto;
    margin-top: 30px;
    padding: 30px;
    border-radius: 30px;
    height: 600px;
    box-shadow: 0px 2px 7px rgb(133, 133, 133);
  }

  h2 {
    /* margin-bottom: 30px; */
    color: #244396;
    color:black;
    font-size: 35px;
    margin-top: 50px;
    font-weight: 900;
  }

  .wrapper form {
    display: flex;
    flex-direction: column;
    width: 100%;
    align-items: center;
    gap: 25px;
  }

  .password {
    display: flex;
    margin-left: 20px;
  }

  .sign-up div input {
    font-family: "Exo 2", sans-serif;
    outline: none;
    background-color: whitesmoke;
    /* border: none; */
    border: 1px solid white;
    width: 300px;
    height: 40px;
    padding-left: 20px;
    border-radius: 5px;
    color: black;
    font-size: 20px;
    /* border-color: red; */
  }

  .sign-up-btn {
    background-color: black;
    color: white;
    font-weight: 500;
    border: none;
    border-radius: 25px;
    /* padding: 15px; */
    font-size: 15px;
    transition: 0.5s;
    width: 330px;
    height: 40px;
    font-weight: 700;
    margin-top: 30px;
    font-family: "Exo 2", sans-serif;
  }

  .sign-up-btn:hover {
    transform: translateY(-8px);
    cursor: pointer;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.5);
  }

  .wrapper form div {
    display: flex;
    flex-direction: row;
    align-items: center;
  }
.wrapper form div:last-child {
  width: 100%;
  display: flex;
  justify-content: space-between;
}
.wrapper form div:last-child input {
  width: 20px;
  height: 20px;
}
  #eye {
    color: black;
    transform: translateX(-28px);
    cursor: pointer;
  }

  @media (max-width: 470px) {
    .sign-up {
      width: 100%;
    }

    .sign-up-btn {
      width: 90%;
    }
  }
</style>

<body>
  <center>
    <h2>Sign Up</h2>
  </center>
  <div class=""></div>
  <div class="sign-up">
    <div class="wrapper">

      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

        <!-- 
        <form action="" method="post"> -->
        <!-- how to add id on the form -->
        <div>
          <span class="material-symbols-outlined"> person </span><input type="text" required placeholder="First name" name="SellerFirstName" />
        </div>
        <div>
          <span class="material-symbols-outlined"> person </span><input type="text" required placeholder="Last name" name="SellerLastName" />

        </div>
        <div>
          <span class="material-symbols-outlined"> person </span><input type="text" required placeholder="User name" name="SellerUserName" />

        </div>
        <div>
          <span class="material-symbols-outlined"> mail </span><input type="Email" required placeholder="Email" name="SellerEmail" />

        </div>
        <div>
          <span class="material-symbols-outlined"> call </span><input type="number" required placeholder="Phone" name="SellerPhoneNo"  />

        </div>
        <div class="password">
          <span class="material-symbols-outlined"> lock </span><input type="password" required placeholder="Password" name="SellerPassword" id="password-input" />
          <span class="material-symbols-outlined" id="eye">
            visibility
          </span>
        </div>
        <div>

          <!-- how do the radio button work particulary the php code in it. -->

          Sign-As:
          <input type="radio" name="SignUpAs" required <?php if (isset($SignUpAs) && $SignUpAs == "Buyer") echo "checked"; ?> value="Buyer">Buyer
          <input type="radio" name="SignUpAs" <?php if (isset($SignUpAs) && $SignUpAs == "Seller") echo "checked"; ?> value="Seller">Seller


        </div>


    </div>
    <center>
      <button id="signUpBtn" class="sign-up-btn" type="submit" name="submit">
        Sign Up
      </button>
    </center>

    </form>




  </div>
  <script>
    let showPassword = document.getElementById("eye");
    let passwordInput = document.getElementById("password-input");
    let invisible = true;

    showPassword.addEventListener('click', () => {
      if (invisible) {
        passwordInput.setAttribute("type", "password");
        showPassword.textContent = "visibility_off";
        invisible = false;
      } else {
        passwordInput.setAttribute("type", "text");
        showPassword.textContent = "visibility";

        invisible = true;
      }
    })
  </script>
</body>

</html>


<?php
// if (isset($_POST['submit'])) {

//   $SellerFirstName = $_POST['SellerFirstName'];
//   $SellerLastName = $_POST['SellerLastName'];
//   $SellerUserName = $_POST['SellerUserName'];
//   $SellerEmail = $_POST['SellerEmail'];
//   $SellerPhoneNo = $_POST['SellerPhoneNo'];
//   $SellerPassword = $_POST['SellerPassword'];



//   $sql = "INSERT INTO Seller (SellerFirstName,SellerLastName,SellerUserName,SellerEmail,SellerPhoneNo,SellerPassword) VALUES ('$SellerFirstName','$SellerLastName','$SellerUserName','$SellerEmail','$SellerPhoneNo','$SellerPassword')";
//   $res = $db->query($sql);
//   echo $sql;
//   if ($res) {
//     echo "<script> alert('Data inserted successfully.')</script>"; -->
//   } else {
//     echo "<script> alert('Failed to insert data. Error: " . $db->error . "')</script>"; -->
//   }
// }
?>