<?php
require_once 'Connect.php';

$Con=new Connect;
$db=$Con->getConnection();

session_start();

class Product{
  Public $ProductName;
  public $ProductCategory;
  Public $ProductImageFileName;
  public $ProductBasePrice;
  Public $ProductDescription;
  public $ProductId;
  public $ProductDate;
  public $SellerUserName;
  

  public function set_product($ProductId){
    global $db;
    $sql= "SELECT * FROM `product` WHERE ProductId = ".$ProductId;
    if($res = $db->query($sql)){
        while($row = $res->fetch_assoc()){
            $this->ProductId = $ProductId;
            $this->ProductName = $row["ProductName"];
            $this->ProductBasePrice = $row["ProductBasePrice"];
            $this->ProductCategory = $row["ProductCategory"];
            $this->ProductDate = $row["ProductDate"];
            $this->ProductImageFileName = "../productImageUploads/".$row["ProductImageFileName"];
            $this->ProductDescription = $row["ProductDescription"];
            $this->SellerUserName = $row["SellerUserName"];
        }
    }
 }

 public function calc_product_rating($ProductId){
  global $db;
  $count=0;
  $sum=0;

  $sql = "SELECT ProductRating FROM `productrating` WHERE ProductId = ".$ProductId;
  if($res = $db->query($sql)){
      while($row = $res->fetch_assoc()){
              $sum+=$row["ProductRating"];
              $count++;
      }
      if($count!=0) return number_format(($sum / $count),1,".","");
      else return 0;
  }
}





  public function addProduct($ProductName,
  $ProductCategory,$ProductImageFileName, $ProductBasePrice,
  $ProductDescription){

    global $db;
  
      echo "$ProductName name constructor <br>";
   echo "$ProductCategory categ constructor <br>";
   echo "$ProductImageFileName image constructor <br>";
   echo "$ProductBasePrice Base constructor <br>"; 
   echo "$ProductDescription descri constructor <br>";
      
  // i think i should insert the image separately or using another mechanism
    $SellerUserName=$_SESSION["SellerUserName"];
 $date= date("Y-m-d H:i:s");
    $sql = "INSERT INTO product (ProductName,ProductCategory,ProductImageFileName,ProductDate,ProductBasePrice,ProductDescription,SellerUserName) VALUES ('$ProductName','$ProductCategory','$ProductImageFileName',NOW(),'$ProductBasePrice','$ProductDescription','$SellerUserName')";
    $res =  $db->query($sql);
   // echo $sql;
    if ($res) {
      echo "<script> alert('product inserted successfully.')</script>";
        

      //  echo " username match";

        // redirect to home page
        header('Location: ../HomePage/HomePage.php');
        exit;
    } else {
      echo "<script> alert('Failed to insert data. Error: " . $db->error . "')</script>";
    }
  }




}

?>