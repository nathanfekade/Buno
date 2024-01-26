<?php
// i think i don't need the include statement if its in the same folder
//include 'Connect.php';
$Con=new Connect;
$db=$Con->getConnection();


class Seller{

  public $SellerId;
  public $SellerFirstName;
  public $SellerLastName;
  public $SellerUserName;
  public $SellerEmail;
  public $SellerPhoneNo;
  public $SellerPassword;


   function __construct($SellerFirstName,
  $SellerLastName,$SellerUserName, $SellerEmail,
  $SellerPhoneNo, $SellerPassword)
  {
    
    $this->$SellerFirstName=$SellerFirstName;
    $this->$SellerLastName=$SellerLastName;
    $this->$SellerUserName=$SellerUserName;
    $this->$SellerEmail=$SellerEmail;
    $this->$SellerPhoneNo=$SellerPhoneNo;
    $this->$SellerPassword=$SellerPassword;
  
  }

   function __destruct(){
    echo "<script>console.log('object was destroyed')</script>";
  }

  public function userNameAvailable(){

    global $SellerUserName;
    global $db;
    $sql="select * from Seller";
    $sql2="select * from Buyer";

    $res=$db->query($sql);

    if($res->num_rows>0)
    {
      while($row=$res->fetch_assoc())
      {
      // print_r($row);
     // echo $row['SellerUserName'];
      if($SellerUserName==$row['SellerUserName']){

       // echo " username match";
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
      if($SellerUserName==$row['BuyerUserName']){

      // echo " username match";
        return false;
      }
        
      }
      
    }
return true;

}

public function emailAvailable(){

  global $SellerEmail;
  global $db;
  $sql="select * from Seller";
  $sql2="select * from Buyer";
  
  $res=$db->query($sql);

  if($res->num_rows>0)
  {
    while($row=$res->fetch_assoc())
    {
    // print_r($row);
   // echo $row['SellerEmail'];
    if($SellerEmail==$row['SellerEmail']){

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
// echo $row['SellerUserName'];
  if($SellerEmail==$row['BuyerEmail']){

  // echo " username match";
    return false;
  }
    
  }
  
}

return true;
}


  public function addSeller(){
    global $db;
    global $SellerFirstName;
    global $SellerLastName;
    global $SellerUserName;
    global $SellerEmail;
    global $SellerPhoneNo;
    global $SellerPassword;

  

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

  

    $sql = "INSERT INTO Seller (SellerFirstName,SellerLastName,SellerUserName,SellerEmail,SellerPhoneNo,SellerPassword) VALUES ('$SellerFirstName','$SellerLastName','$SellerUserName','$SellerEmail','$SellerPhoneNo','$SellerPassword')";
    $res =  $db->query($sql);
   // echo $sql;
    if ($res) {
      echo "<script> alert('Data inserted successfully.')</script>";
      header('Location: ../VerificationPage/VerificationPage.php');
      exit;
    } else {
      echo "<script> alert('Failed to insert data. Error: " . $db->error . "')</script>";
    }

  }



}
?>
