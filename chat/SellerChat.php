<?php
   
session_start();
include('../Classes/Connect.php');

$Con=new Connect;
$db=$Con->getConnection();

// $buyerUser=$_SESSION['BuyerUserName'] ;
// $buyerUser=null;

$sellerUserGlobal=$_SESSION["SellerUserName"];

function listTexts($buyerUser){
  global $sellerUserGlobal;
  global $db;
  
  echo "sel $sellerUserGlobal";
  echo "<br>";
  echo "buy $buyerUser";
  echo "<br>";
  $sql2 = "SELECT sellerConvo,buyerConvo FROM chat where BuyerUserName='$buyerUser' and SellerUserName='$sellerUserGlobal' ORDER by chatTime";
  $res2=$db->query($sql2);  
  if($res2->num_rows>0)
  {

    while($row=$res2->fetch_assoc())
    {
      echo "<br>";
      if($row['sellerConvo']!=null){
        echo "<div class='sellerChat'>seller: ".$row['sellerConvo']."</div>";


        // echo "seller:  ".$row['sellerConvo'];
        echo "<br>";
      }
      if($row['buyerConvo']!=null){
        echo "<div class='buyerChat'>buyer: ".$row['buyerConvo']."</div>";

        // echo "buyer: ". $row['buyerConvo'];
      echo "<br>";
      }
    }
  }
}

function send($chatValue,$buyerUser){
  global $db;
  global $sellerUserGlobal;
 

 
  
  $textInsertTime = getdate();
  // echo "buyer username= $buyerUsername || ";
  $sql = "INSERT INTO chat ( SellerUserName, BuyerUserName, buyerConvo, sellerConvo,chatTime) VALUES ('$sellerUserGlobal','$buyerUser' , NULL,'$chatValue','$textInsertTime[0]')";

  
$res =  $db->query($sql);

}
// echo $SellerUserName2;


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
 
  <title>SellerChat</title>
  
</head>
<body>
  
  <div class="wrapper">
    <div class="chatList">
     
    <?php
    
    
  
    $buyers=[];
    $sql2 = "SELECT BuyerUserName FROM chat where SellerUserName='$sellerUserGlobal'";

    $res2=$db->query($sql2);  
    if($res2->num_rows>0)
    {
          $count=1;
          while($row=$res2->fetch_assoc())
          {
      
            array_push($buyers, $row['BuyerUserName']);
        
          }
    }
        
    $uniqueBuyer = array_unique($buyers);
    foreach ($uniqueBuyer as $x) {
      // echo "<div class=$x>$x</div>";
      echo " <div class='chatListElement' id='$x'>
      <form action='' method='post'>
        <input type='hidden' name='value' id='hiddenValue' value='$x'>
        <button id='submit' type='submit' name='submitUserName' class='$x'>$x</button>
      </form>
    </div>";
      // echo "<script>let chatInstance = document.querySelector(".$x");</script>";
    }
   
      ?>
    </div>
    
    <div class="chatInstance">
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['submitUserName'])) {
       
        
        
        $_SESSION['buyerUser'] = $_POST['value']; // Store the value in session
        listTexts($_SESSION['buyerUser']);
       
       
       
      }
    }
    if (isset($_POST["chatValue"])) {


      $chatValue = test_input($_POST["chatValue"]);
    
        // echo "chat= $chatValue";
    
      send($chatValue,$_SESSION['buyerUser']);
      listTexts($_SESSION['buyerUser']);

      // header("Refresh:5");

    }
    ?>
    <div class="textInput">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
     
      <div class="input-box">
          <input type="text" name="chatValue" id="chatValue" required placeholder="insert text"> 
        </div>
        <input type="submit" value="send" name="send"class="send-btn"> <br>
        <input type="hidden" name="classNameInput" id="classNameInput" value="">
      </form>
    </div>
  </div>
</div>

</body>
<script > 



let chatListElements = document.querySelectorAll('.chatListElement');
let listOfChats = document.querySelector('.chatInstance');


chatListElements.forEach((c)=>{

c.addEventListener('click',()=>{
  document.getElementById("hiddenValue").value = c.id;
  alert(document.getElementById("hiddenValue").value);
  listOfChats.innerHTML='';
})
})




</script>
</html>

