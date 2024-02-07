<?php
include('../Classes/Connect.php');
$Con=new Connect;
$db=$Con->getConnection();

$productId = $_GET['productId'];
$sql1= " DELETE FROM `productcomment` WHERE ProductId = ".$productId;
$res1=$db->query($sql1);
$sql2= " DELETE FROM productrating WHERE ProductId = ".$productId;
$res2=$db->query($sql2);
$sql3 = " DELETE FROM product WHERE ProductId = ".$productId;
$res3=$db->query($sql3);

header('Location:../SellerPage/SellerPage.php'); 
?>