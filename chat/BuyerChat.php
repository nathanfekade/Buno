<?php
   
session_start();
include('../Classes/Connect.php');

$Con=new Connect;
$db=$Con->getConnection();

$buyerUserGlobal=$_SESSION['BuyerUserName'] ;

$sellerUserGlobal=$_SESSION["SellerProductUserName"];

function listTexts($sellerUser){

  global $buyerUserGlobal;
  global $db;
echo "sel $sellerUser";
echo "<br>";
echo "buy $buyerUserGlobal";
echo "<br>";

  $sql2 = "SELECT sellerConvo,buyerConvo FROM chat where BuyerUserName='$buyerUserGlobal' and SellerUserName='$sellerUser' ORDER by chatTime";
  $res2=$db->query($sql2);  
  if($res2->num_rows>0)
  {

    while($row=$res2->fetch_assoc())
    {
      echo "<br>";
      if($row['sellerConvo']!=null){
        // echo "<div class='sellerChat'>seller:  $row['sellerConvo']</div>";
        echo "<div class='sellerChat'>seller: ".$row['sellerConvo']."</div>";


        // echo "seller:  ".$row['sellerConvo'];
        echo "<br>";
      }
      if($row['buyerConvo']!=null){
        // echo "<div class='buyerChat'>buyer:  $row['buyerConvo']</div>";
        echo "<div class='buyerChat'>buyer: ".$row['buyerConvo']."</div>";

        // echo "buyer: ". $row['buyerConvo'];
      echo "<br>";
      }
    }
  }
}
function defaultText(){

  global $buyerUserGlobal;
  global $sellerUserGlobal;
  //echo "sel $sellerUserGlobal";
  //echo "<br>";
  //echo "buy $buyerUserGlobal";
 // echo "<br>";
  global $db;
  $sql2 = "SELECT sellerConvo,buyerConvo FROM chat where BuyerUserName='$buyerUserGlobal' and SellerUserName='$sellerUserGlobal' ORDER by chatTime";
  $res2=$db->query($sql2);  
  if($res2->num_rows>0)
  {

    while($row=$res2->fetch_assoc())
    {
      echo "<br>";
      if($row['sellerConvo']!=null){
        // echo "<div class='sellerChat'>seller:  $row['sellerConvo']</div>";
        echo "<div class='sellerChat'>seller: ".$row['sellerConvo']."</div>";


        // echo "seller:  ".$row['sellerConvo'];
        echo "<br>";
      }
      if($row['buyerConvo']!=null){
        // echo "<div class='buyerChat'>buyer:  $row['buyerConvo']</div>";
        echo "<div class='buyerChat'>buyer: ".$row['buyerConvo']."</div>";

        // echo "buyer: ". $row['buyerConvo'];
      echo "<br>";
      }
    }
  }
}

function send($chatValue,$sellerUser){
  global $db;
  
  global $buyerUserGlobal;
  
  $textInsertTime = getdate();
  // echo "buyer username= $buyerUsername || ";
  $sql = "INSERT INTO chat ( SellerUserName, BuyerUserName, buyerConvo, sellerConvo,chatTime) VALUES ('$sellerUser','$buyerUserGlobal' , '$chatValue', NULL,'$textInsertTime[0]')";

  
$res =  $db->query($sql);

// listTexts($sellerUser,$buyerUser);
}
function sendDefault($chatValue){
  global $db;
  global $sellerUserGlobal;
  global $buyerUserGlobal;
  
  $textInsertTime = getdate();
  // echo "buyer username= $buyerUsername || ";
  $sql = "INSERT INTO chat ( SellerUserName, BuyerUserName, buyerConvo, sellerConvo,chatTime) VALUES ('$sellerUserGlobal','$buyerUserGlobal' , '$chatValue', NULL,'$textInsertTime[0]')";

  
$res =  $db->query($sql);

// listTexts($sellerUser,$buyerUser);
}
// echo $SellerUserName2;

// echo 'sel: '.$sellerUser;
//     echo "<br>";
//     echo 'buy: '. $buyerUserGlobal;
//     ;
//     echo "<br>";

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   if (isset($_POST['submitUserName'])) {
//     $sellerUser = $_POST['value'];
//     $buyerUser=$_SESSION['BuyerUserName'] ;
//     echo 'inside post sel: '.$sellerUser;
//     echo "<br>";
//     echo 'inside post buy: '.$buyerUser;
//     // listTexts($sellerUser,$buyerUser);
//     // $sql2 = "SELECT sellerConvo,buyerConvo FROM chat where BuyerUserName='$buyerUser' and SellerUserName='$sellerUser' ORDER by chatTime";
    

//     // $res2=$db->query($sql2);  
//     // if($res2->num_rows>0)
//     // {

//     //   while($row=$res2->fetch_assoc())
//     //   {
//     //     echo "<br>";
//     //     if($row['sellerConvo']!=null){
//     //       echo "seller: ".$row['sellerConvo'];
//     //       echo "<br>";
//     //     }
//     //     if($row['buyerConvo']!=null){
//     //       echo "buyer: ". $row['buyerConvo'];
//     //     echo "<br>";
//     //     }
//     //   }
//     // }
//   }
// }








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
    <div class="chatList">
     
    <?php
    
    
    $sellers=[];
    $sql2 = "SELECT SellerUserName FROM chat where BuyerUserName='$buyerUserGlobal'";
    
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

      $_SESSION['Flag']='False';

      if (isset($_POST['submitUserName'])) {
       
        $_SESSION['sellerUser'] = $_POST['value']; // Store the value in session
        listTexts($_SESSION['sellerUser']);
        $_SESSION['Flag']='True';
        // echo $_SESSION['Flag'];
       
      }
    
    if (isset($_POST["chatValue"])) {


      $chatValue = test_input($_POST["chatValue"]);

    
        // echo $_SESSION['Flag'];
        if($_SESSION['Flag']=='True'){
         send($chatValue, $_SESSION['sellerUser']); // Access the value from session
         listTexts($_SESSION['sellerUser']);
  
        }
        else {
          sendDefault($chatValue); // Access the value from session
          defaultText();

        }
          
      // header("Refresh:5");

    }
  
  } else{
    defaultText();
  }
    
    

    // function listTexts($sellerUser,$buyerUser){

    //   global $db;
    //   $sql2 = "SELECT sellerConvo,buyerConvo FROM chat where BuyerUserName='$buyerUser' and SellerUserName='$sellerUser' ORDER by chatTime";
    //   $res2=$db->query($sql2);  
    //   if($res2->num_rows>0)
    //   {
  
    //     while($row=$res2->fetch_assoc())
    //     {
    //       echo "<br>";
    //       if($row['sellerConvo']!=null){
    //         // echo "<div class='sellerChat'>seller:  $row['sellerConvo']</div>";
    //         echo "<div class='sellerChat'>seller: ".$row['sellerConvo']."</div>";


    //         // echo "seller:  ".$row['sellerConvo'];
    //         echo "<br>";
    //       }
    //       if($row['buyerConvo']!=null){
    //         // echo "<div class='buyerChat'>buyer:  $row['buyerConvo']</div>";
    //         echo "<div class='buyerChat'>buyer: ".$row['buyerConvo']."</div>";

    //         // echo "buyer: ". $row['buyerConvo'];
    //       echo "<br>";
    //       }
    //     }
    //   }
    // }
    // $buyerUsername2=$_SESSION['BuyerUserName'] ;
    
    // $sellers=[];
    // $sql2 = "SELECT sellerConvo,buyerConvo FROM chat where BuyerUserName='$buyerUsername2' and SellerUserName='$SellerUserName2' ORDER by chatTime";
    

    // $res2=$db->query($sql2);  
    // if($res2->num_rows>0)
    // {

    //   while($row=$res2->fetch_assoc())
    //   {
    //     if($row['sellerConvo']!=null){
    //       echo "seller: ".$row['sellerConvo'];
    //       echo "<br>";
    //     }
    //     if($row['buyerConvo']!=null){
    //       echo "buyer: ". $row['buyerConvo'];
    //     echo "<br>";

    //     }
        
    //     // array_push($sellers, $row['buyerConvo']);
    
    //   }
    // }
    
   
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


// chatListElements.addEventListener('click',()=>{
//   for (let i = 0; i < chatListElements.length; i++) {
//     for(let i = 0; i <listOfChats.length; i++) {
//       listOfChats[i].innerHTML = '';
//     }
//   }
// })
//   let elements = document.getElementsByClassName('chatList');
//   console.log(elements);
// let listOfChats = document.getElementsByClassName('chatInstance');
// let myFunction = function() {
  
  
//   for(let i = 0; i < listOfChats.length; i++) {
//     listOfChats[i].innerHTML = '';
//     // console.log(listOfChats[i]);
//   }
 

// };

// for (let i = 0; i < elements.length; i++) {
//   let children = elements[i].children;

//   for (let j = 0; j < children.length; j++) {
//     let childClassName = children[j].className;

//     children[j].addEventListener('click', );
//   }
// }

</script>
</html>


<?php

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   if (isset($_POST['submitUserName'])) {
//     // echo"<script>let chatListElements = document.querySelectorAll('.chatListElement');
//     // let listOfChats = document.querySelector('.chatInstance');
    
    
//     // chatListElements.forEach((c)=>{
      
//     //   c.addEventListener('click',()=>{
//     //     document.getElementById('hiddenValue').value = c.id;
//     //     alert(document.getElementById('hiddenValue').value);
//     //     listOfChats.innerHTML='';
//     //   })
//     // })</script>";
//     $sellerUser = $_POST['value'];
//     echo'value: '.$_POST['value'];
//     $buyerUser=$_SESSION['BuyerUserName'] ;
//     echo 'inside post sel: '.$sellerUser;
//     echo "<br>";
//     echo 'inside post buy: '.$buyerUser;
//     // listTexts($sellerUser,$buyerUser);
//     // $sql2 = "SELECT sellerConvo,buyerConvo FROM chat where BuyerUserName='$buyerUser' and SellerUserName='$sellerUser' ORDER by chatTime";
    

//     // $res2=$db->query($sql2);  
//     // if($res2->num_rows>0)
//     // {

//     //   while($row=$res2->fetch_assoc())
//     //   {
//     //     echo "<br>";
//     //     if($row['sellerConvo']!=null){
//     //       echo "seller: ".$row['sellerConvo'];
//     //       echo "<br>";
//     //     }
//     //     if($row['buyerConvo']!=null){
//     //       echo "buyer: ". $row['buyerConvo'];
//     //     echo "<br>";
//     //     }
//     //   }
//     // }
//   }
// }

?>