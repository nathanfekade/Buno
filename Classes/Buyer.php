<?php

$Con=new Connect;
$db=$Con->getConnection();


class Buyer{


  public $BuyerId;
  public $BuyerFirstName;
  public $BuyerLastName;
  public $BuyerUserName;
  public $BuyerEmail;
  public $BuyerPhoneNo;
  public $BuyerPassword;


   function __construct($BuyerFirstName,
  $BuyerLastName,$BuyerUserName, $BuyerEmail,
  $BuyerPhoneNo, $BuyerPassword)
  {
    
    $this->BuyerFirstName=$BuyerFirstName;
    $this->BuyerLastName=$BuyerLastName;
    $this->BuyerUserName=$BuyerUserName;
    $this->BuyerEmail=$BuyerEmail;
    $this->BuyerPhoneNo=$BuyerPhoneNo;
    $this->BuyerPassword=$BuyerPassword;
  // echo "$BuyerFirstName constructor";
  //  echo "$BuyerLastName constructor";
  // echo $BuyerPhoneNo;
 

  }

   function __destruct(){
    echo "<script>console.log('object was destroyed')</script>";
  }


  public function userNameAvailable(){

    $BuyerUserName = $this->BuyerUserName;
    global $db;
    $sql="select * from Buyer";
    $sql2="select * from Seller";

    $res=$db->query($sql);

    if($res->num_rows>0)
    {
      while($row=$res->fetch_assoc())
      {
      // print_r($row);
     echo $row['BuyerUserName'];
      if($BuyerUserName==$row['BuyerUserName']){

       echo " username match";
        return false;
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
        if($BuyerUserName==$row['SellerUserName']){

        // echo " username match";
          return false;
        }
          
        }
        
      }


    return true;

}

public function emailAvailable(){

  $BuyerEmail = $this->BuyerEmail;
  global $db;
  $sql="select * from Buyer";
  $sql2="select * from Seller";

  $res=$db->query($sql);

  if($res->num_rows>0)
  {
    while($row=$res->fetch_assoc())
    {
    // print_r($row);
   // echo $row['BuyerEmail'];
    if($BuyerEmail==$row['BuyerEmail']){

     // echo " email match";
      return false;
    }
      
    }
    
}
  $res=$db->query($sql2);
    if($res->num_rows>0)
    {
      while($row=$res->fetch_assoc())
      {
      // print_r($row);
    // echo $row['BuyerEmail'];
      if($BuyerEmail==$row['SellerEmail']){

      // echo " email match";
        return false;
      }
        
      }
      
    }
return true;
}

  public function addBuyer(){
  
global $db;
$BuyerFirstName = $this->BuyerFirstName;
$BuyerLastName = $this->BuyerLastName;
$BuyerUserName = $this->BuyerUserName;
$BuyerEmail = $this->BuyerEmail;
$BuyerPhoneNo = $this->BuyerPhoneNo;
$BuyerPassword = $this->BuyerPassword;
// global $BuyerFirstName;
// global $BuyerLastName;
// global $BuyerUserName;
// global $BuyerEmail;
// global $BuyerPhoneNo;
// global $BuyerPassword;
   
$check=$this->userNameAvailable();
    if($check==false){
      echo "<script> alert('username is already in use')</script>";
      return ;
    }

    $check2=$this->emailAvailable();
    if($check2==false){
      echo "<script> alert('email is already in use')</script>";
      return ;
    }

  

  
  // $sql = "INSERT INTO Buyer (BuyerFirstName,BuyerLastName,BuyerUserName,BuyerEmail,BuyerPhoneNo,BuyerPassword) VALUES ('$this->BuyerFirstName','$this->BuyerLastName','$this->BuyerUserName','$this->BuyerEmail','$this->BuyerPhoneNo','$this->BuyerPassword')";

    $sql = "INSERT INTO Buyer (BuyerFirstName,BuyerLastName,BuyerUserName,BuyerEmail,BuyerPhoneNo,BuyerPassword) VALUES ('$BuyerFirstName','$BuyerLastName','$BuyerUserName','$BuyerEmail','$BuyerPhoneNo','$BuyerPassword')";
    $res =  $db->query($sql);
   // echo $sql;
    if ($res) {
      echo "<script> alert('Data inserted successfully.')</script>";
         $_SESSION["BuyerUserName"] =$BuyerUserName ;

        echo  $_SESSION["BuyerUserName"]  ;
        header('Location: ../BuyerPage/BuyerPage.php');
        exit;
        // redirect to home page
        // header('Location: ../HomePage/HomePage.php');
        // exit;
    } else {
      echo "<script> alert('Failed to insert data. Error: " . $db->error . "')</script>";
    }

  }



}
?>
