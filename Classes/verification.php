<?php

// but why did it require me to use Connect.php eventhough it didn't ask the other php files that are in the same order
require_once 'Connect.php';

$Con=new Connect;
$db=$Con->getConnection();

session_start();

class verification{

  public $SellerUserName;
  public $targetPath;
  public $targetImagePath;




  function __construct($targetPath,$targetImagePath){

   
  $this->$targetPath=$targetPath;
  $this->$targetImagePath=$targetImagePath;
  }

  function __destruct(){
    echo "<script>console.log('object was destroyed')</script>";
  }
  
  
function insertDocuments($targetPath,$targetImagePath){

  global $db;
  global $SellerUserName;
  global $targetPath;
  global $targetImagePath;

  $SellerUserName2=$_SESSION['SellerUserName'];

// check how it did find the location eventhough i am in verification.php not VerificationPage.verificationPage.php;
  echo "<script>Console.log('$SellerUserName');</script>" ;
  $sql="INSERT INTO SellerVerification(SellerUserName,SellerDocuments,SellerDocumentImage) VALUES ('$SellerUserName2','$targetPath','$targetImagePath')";
    
  if($db->query($sql)==true){
    echo "File uploaded and saved to DB";
  }
  else{
    echo "Error:  $sql Error Details:  $Con->error";
  }

}
  

}



?>