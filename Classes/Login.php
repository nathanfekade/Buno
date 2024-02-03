<?php

$Con=new Connect;
$db=$Con->getConnection();

session_start();

class Login{

  public $UserNameOrEmail;
  public $Password;

  function __construct($UserNameOrEmail,
  $Password)
  {
    
    $this->UserNameOrEmail=$UserNameOrEmail;
    $this->Password=$Password;
    // echo $UserNameOrEmail;
  
  }

  function __destruct(){
    echo "<script>console.log('object was destroyed')</script>";
  }

  public function signIn(){

    global $UserNameOrEmail;
    global $Password;
    $UserNameOrEmail = $this->UserNameOrEmail;
    $Password = $this->Password;
    global $db;
    $sql="select SellerUserName,SellerEmail,SellerPassword from Seller";
    $sql2="select BuyerUserName,BuyerEmail,BuyerPassword from Buyer";

    // echo "$UserNameOrEmail user in function";
    // echo "$Password password in function";

    $res=$db->query($sql);

    if($res->num_rows>0)
    {
      while($row=$res->fetch_assoc())
      {
      // print_r($row);
     // echo $row['SellerUserName'];
    // echo $row['SellerUserName'];
     //echo $row['SellerEmail'];
      if($UserNameOrEmail==$row['SellerUserName']||$UserNameOrEmail==$row['SellerEmail']){

        if($Password==$row['SellerPassword']){
          $_SESSION["SellerUserName"] = $row['SellerUserName'];

          echo " username match";
          //temporarily to chat page
          // header('Location: ../chat/SellerChat.php');
          // exit;
          // redirect to home page
          header('Location: ../SellerPage/SellerPage.php');
          exit;
        }
        else{
          echo "<script> alert('incorrect password') </script>";
        }

          //  echo "f".$UserNameOrEmail."e";

      }
      
      }
      
}

     $res=$db->query($sql2);
    if($res->num_rows>0)
    {
      while($row=$res->fetch_assoc())
      {
      // print_r($row);
    // echo $row['SellerUserName'];
    if($UserNameOrEmail==$row['BuyerUserName']||$UserNameOrEmail==$row['BuyerEmail']){

      if($Password==$row['BuyerPassword']){
        $_SESSION["BuyerUserName"] = $row['BuyerUserName'];

        echo " username match";
//temporarily to chat page
// header('Location: ../chat/BuyerChat.php');
   
// redirect to home page 
        header('Location: ../BuyerPage/BuyerPage.php');
        exit;
      }
      else{
        echo "<script> alert('incorrect password') </script>";
      }

        //  echo "f".$UserNameOrEmail."e";

    }
        
      }
      
    }

    echo "<script> alert('incorrect username or email') </script>";
}

}



?>