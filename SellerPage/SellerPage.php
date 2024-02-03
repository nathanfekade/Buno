<?php

include('../Classes/Connect.php');
include('../Classes/Product.php');

$ProductName = $ProductCategory=$ProductImageFileName = $ProductBasePrice=$ProductDescription =null;

 // target directory
 $targetDir="../productImageUploads/";  

    if ($_SERVER["REQUEST_METHOD"] == "POST"&& isset($_FILES['ProductImageFileName']) )
    
     {
  
      // && isset($_POST["ProductName"])&&isset($_POST  ["ProductCategory"])&&isset($_POST["ProductImageFileName"])&&isset($_POST["ProductBasePrice"])&&isset($_POST["ProductDescription"])
    
      $fileName=basename($_FILES["ProductImageFileName"]["name"]);
     
      $targetPath=$targetDir.$fileName;

      $ProductName = test_input($_POST["ProductName"]);
      $ProductCategory = test_input($_POST["ProductCategory"]);
      $ProductImageFileName =$targetPath;
      $ProductBasePrice = test_input($_POST["ProductBasePrice"]);
      $ProductDescription = test_input($_POST["ProductDescription"]);
    
      if(move_uploaded_file($_FILES["ProductImageFileName"]["tmp_name"],$targetPath)){

  $productInstance = new Product();
   $productInstance->addProduct($ProductName,
   $ProductCategory,$ProductImageFileName, $ProductBasePrice,
   $ProductDescription);
      }
      else{
        echo "Error Moving the file";
      }
      
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
  <title>Document</title>
</head>
<body>

      <div class="wrapper">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">


      
      
            <div class="input-box">
              <input type="text" name="ProductName" id="ProductName" required placeholder="ProductName"> 
            </div>

            <div class="input-box">
              <input type="text" name="ProductCategory" id="ProductCategory" required placeholder="ProductCategory"> 
            </div>

            
            <div class="input-box">
              <input type="file" name="ProductImageFileName" id="ProductImageFileName" required placeholder="ProductImage"> 
            </div>
           
            <div class="input-box">
              <input type="text" name="ProductBasePrice" id="ProductBasePrice" required placeholder="ProductBasePrice"> 
            </div>

            <div class="input-box">
              <input type="text" name="ProductDescription" id="ProductDescription" required placeholder="ProductDescription"> 
            </div>

            <input type="submit" value="Insert" name="Insert"class="Insert-btn"> <br>

            </form>

            </div>
</body>
</html>