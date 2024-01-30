<?php


include('../Classes/Connect.php');
include('../Classes/Seller.php');
include('../Classes/Buyer.php');


$Con=new Connect;
$db=$Con->getConnection();
?>
  <?php
 // make it one with the above php

 //     error_reporting(E_ALL);
 // ini_set('display_errors', 1);
 
 // define variables and set to empty values
 $SellerFirstName = $SellerLastName = $SellerUserName = $SellerEmail = $SellerPhoneNo = $SellerPassword = $SignUpAs="";

 $SellerFirstNameErr = $SellerLastNameErr = $SellerUserNameErr = $SellerEmailErr =  $SellerPhoneNoErr = $SellerPasswordErr = "";

 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
   $SellerFirstName = test_input($_POST["SellerFirstName"]);
   $SellerLastName = test_input($_POST["SellerLastName"]);
   $SellerUserName = test_input($_POST["SellerUserName"]);
   $SellerEmail = test_input($_POST["SellerEmail"]);
   $SellerPhoneNo = test_input($_POST["SellerPhoneNo"]);
   $SellerPassword = test_input($_POST["SellerPassword"]);
   $SignUpAs = test_input($_POST["SignUpAs"]);
  echo $SignUpAs;
 
   // $sql = "INSERT INTO Seller (SellerFirstName,SellerLastName,SellerUserName,SellerEmail,SellerPhoneNo,SellerPassword) VALUES ('$SellerFirstName','$SellerLastName','$SellerUserName','$SellerEmail','$SellerPhoneNo','$SellerPassword')";
   // $res = $db->query($sql);
   // echo $sql;
   // if ($res) {
   //   echo "<script> alert('Data inserted successfully.')</script>";
   // } else {
   //   echo "<script> alert('Failed to insert data. Error: " . $db->error . "')</script>";
   // }
 }
 
 function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);//check what it does
   $data = htmlspecialchars($data);
   return $data;
 }
 

 
 if($SignUpAs=="Seller")
{
  $sellerInstance = new Seller($SellerFirstName,$SellerLastName,$SellerUserName,$SellerEmail,$SellerPhoneNo,$SellerPassword);
  $sellerInstance->addSeller();
}


if($SignUpAs=="Buyer")
{
   $buyerInstance = new Buyer($SellerFirstName,$SellerLastName,$SellerUserName,$SellerEmail,$SellerPhoneNo,$SellerPassword);

  $buyerInstance->addBuyer($SellerFirstName,$SellerLastName,$SellerUserName,$SellerEmail,$SellerPhoneNo,$SellerPassword);
}

 ?>
 


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="SignUp.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <center><h2>Sign Up</h2></center>
    <div id="error"></div>
    <div class=""></div>
    <div class="sign-up">
      <div class="wrapper">

      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

<!-- 
        <form action="" method="post"> -->
          <!-- how to add id on the form -->
                <div>
            <span class="material-symbols-outlined"> person </span
            ><input type="text" placeholder="First name" name="SellerFirstName"  />
                    
         
          </div>
          <div>
            <span class="material-symbols-outlined"> person </span
            ><input type="text" placeholder="Last name" name="SellerLastName" />
           
          </div>
          <div>
            <span class="material-symbols-outlined"> person </span
            ><input type="text"  placeholder="User name" name="SellerUserName" />
           
          </div>
          <div>
            <span class="material-symbols-outlined"> mail </span
            ><input type="text" placeholder="Email" name="SellerEmail" />
           
          </div>
          <div>
            <span class="material-symbols-outlined"> call </span
            ><input type="number" placeholder="Phone" name="SellerPhoneNo"  />
            
          </div>
          <!-- <div>
            <span class="material-symbols-outlined"> credit_card </span
            ><input type="text" placeholder="Credit Card"required />
            
          </div> -->
          <div>
            <span class="material-symbols-outlined"> lock </span
            ><input type="text" placeholder="Password" name="SellerPassword" />
       
          </div>
<div>
SignUp As:
<input type="radio" name="SignUpAs"
<?php if (isset($SignUpAs) && $SignUpAs=="Buyer") echo "checked";?>
value="Buyer">Buyer
<input type="radio" name="SignUpAs"
<?php if (isset($SignUpAs) && $SignUpAs=="Seller") echo "checked";?>
value="Seller">Seller

       
</div>

        
      </div>
      <center>
        <button id="signUpBtn" class="sign-up-btn" type="submit" name="submit" >
          Sign Up
        </button>
      </center>
      
    </form>
  
  


    </div>
    <script src="SignUp.js"></script>
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


 