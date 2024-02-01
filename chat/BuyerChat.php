<?php
session_start();
include('../Classes/Connect.php');

$Con=new Connect;
$db=$Con->getConnection();

// $uniqueSeller=[];


if (isset($_POST["chatValue"])) {
  // &&isset($_POST["Login"])
//  echo $_POST["UserNameOrEmail"];
  $chatValue = test_input($_POST["chatValue"]);
 
echo "chat= $chatValue";

$textInsertTime = getdate();
$buyerUsername=$_SESSION['BuyerUserName'] ;
echo "buyer username= $buyerUsername || ";
$sql = "INSERT INTO chat ( SellerUserName, BuyerUserName, buyerConvo, sellerConvo,chatTime) VALUES ('y','$buyerUsername' , '$chatValue', NULL,'$textInsertTime[0]')";


$res =  $db->query($sql);
listChats();
  
}
function listChats(){

  global $db;
  echo 'er';
  $buyerUsername2=$_SESSION['BuyerUserName'] ;
  
  $sellers=[];
  $sql2 = "SELECT SellerUserName FROM chat where BuyerUserName='$buyerUsername2'";
  
  $res2=$db->query($sql2);  
  if($res2->num_rows>0)
  {
    $count=1;
    while($row=$res2->fetch_assoc())
    {

      echo $count++;
      echo $row['SellerUserName'] ;
      array_push($sellers, $row['SellerUserName']);
     
      
      echo '\n';
  
    }
  }
  // global $uniqueSeller;
  print_r($sellers);
   $uniqueSeller = array_unique($sellers);
  echo "unique sellers";
  print_r($uniqueSeller);
  // print_r(array_unique($sellers));
  $filteredArray = array_filter($uniqueSeller, 'strlen');
  echo "filtered sellers";
  print_r($filteredArray);
  echo "length= ".count($uniqueSeller);
 
 
  // global $uniqueSeller; 
  // for($i=0; $i < count($uniqueSeller); $i++)
    // if($uniqueSeller[$i]==null)continue;
    // echo '<div>'.$uniqueSeller[$i].'</div>';
  // echo 54;
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
  <link rel="stylesheet" href="BuyerChat.css" />
 
  <title>BuyerChat</title>
</head>
<body>
  <div class="wrapper">
    <div class="chatList">1
    <?php
    
    $buyerUsername2=$_SESSION['BuyerUserName'] ;
    
    $sellers=[];
    $sql2 = "SELECT SellerUserName FROM chat where BuyerUserName='$buyerUsername2'";
    
    $res2=$db->query($sql2);  
    if($res2->num_rows>0)
    {
      $count=1;
      while($row=$res2->fetch_assoc())
      {
  
        array_push($sellers, $row['SellerUserName']);
    
      }
    }
    
     $uniqueSeller = array_unique($sellers);
   
      foreach ($uniqueSeller as $x) {
        echo "<div>$x</div>";
      }
      
      ?>
    </div>
    
    <div class="chatInstance">
    
    <?php
    
    $buyerUsername2=$_SESSION['BuyerUserName'] ;
    
    $sellers=[];
    $sql2 = "SELECT sellerConvo,buyerConvo FROM chat where BuyerUserName='$buyerUsername2' and SellerUserName='y' ORDER by chatTime";
    

    $res2=$db->query($sql2);  
    if($res2->num_rows>0)
    {
//       $dateInfo = getdate();
// print_r($dateInfo);
// $dateInfo2 = getdate();
// print_r($dateInfo2);
// $resu=$dateInfo[0]<$dateInfo2[0];
// echo  $resu;
      while($row=$res2->fetch_assoc())
      {
        if($row['sellerConvo']!=null){
          echo "seller: ".$row['sellerConvo'];
          echo "<br>";
        }
        if($row['buyerConvo']!=null){
          echo "buyer: ". $row['buyerConvo'];
        echo "<br>";

        }
        
        // array_push($sellers, $row['buyerConvo']);
    
      }
    }
    
   
      // foreach ($sellers as $x) {
      //   echo "<div>$x</div>";
      // }
      
      ?>

      <div class="textInput">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
       
        <div class="input-box">
            <input type="text" name="chatValue" id="chatValue" required placeholder="insert text"> 
          </div>
          <input type="submit" value="send" name="send"class="send-btn"> <br>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
