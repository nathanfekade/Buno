<?php

include('../Classes/Connect.php');
include('../Classes/Product.php');

$Con=new Connect;
$db=$Con->getConnection();
$SellerUserName = $_SESSION["SellerUserName"];

$ProductName = $ProductCategory=$ProductImageFileName = $ProductBasePrice=$ProductDescription =null;

// target directory
$targetDir="../productImageUploads/";  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_FILES['ProductImageFileName']) && isset($_POST['Insert'])){
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="SellerPage.css?v=<?php echo time(); ?>">
  <title>BUNO</title>
</head>
<body>
  <div class="wrapper">
  <div class="dashboard-navbar">
      <div class="title">
        <h2>Dashboard</h2>
      </div>
      <div class="profile-pic">
        <div>
          <span class="material-symbols-outlined"> search </span>
          <input
            type="search"
            placeholder="Search"
            id="search"
            class="search"
          />
        </div>
        <img src="../assets/pexels-karolina-grabowska-5632397.jpg" alt="" />
      </div>
    </div>
    <div class="addNewProduct">
        <h3>Add New Product</h3>
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
              <input type="submit" value="Insert" name="Insert"class="Insert-btn">
        </form>
    </div>

    <div class="popup" id="popup">
        <form action="" method="post">
        <div class="popup-title">
          <div></div>
          <center><h2>Edit Product Details</h2></center>
          <span class="material-symbols-outlined" id="close-modal"> close </span>
        </div>
  
        <div class="inputs">
          <input type="text" placeholder="Enter name" />
          <input type="text" placeholder="Enter name" />
          <input type="text" placeholder="Enter name" />
          <input type="text" placeholder="Enter name" />
          <input type="text" placeholder="Enter name" />
          <input type="text" placeholder="Enter name" />
        </div>
        <div class="buttons">
          <button id="update-btn" class="update-btn">Update</button>
          <button id="delete-btn" class="delete-btn">Delete</button>
        </div>
        </form>
      </div>

    <div class="products">
    <table>
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Date</th>
            <th>Category</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $product = new Product();
        $sql = "SELECT ProductId FROM `product` WHERE SellerUserName = '".$SellerUserName."'";
        $res = $db->query($sql);
        if($res->num_rows > 0){
          while($row = $res->fetch_assoc()){
              $product->set_product($row["ProductId"]);
              ?>
              <tr>
                <td><?php echo $product->ProductId;?></td>
                <td><?php echo $product->ProductName;?></td>
                <td><?php echo $product->ProductDate;?></td>
                <td><?php echo $product->ProductCategory;?></td>
                <td><?php echo $product->ProductBasePrice;?></td>
                <td><a href='delete.php?productId=<?php echo $product->ProductId;?>' style='color:red'>delete</a></td>
              </tr>
            <?php
            }
        }?>
        </tbody>
      </table>
    </div>
    <div class="overlay" id="overlay"></div>
  </div>
</body>
</html>
<script src="SellerPage.js"></script>
