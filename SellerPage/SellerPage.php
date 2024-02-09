<?php

include('../Classes/Connect.php');
include('../Classes/Product.php');

$Con = new Connect;
$db = $Con->getConnection();
$SellerUserName = $_SESSION["SellerUserName"];

$ProductName = $ProductCategory = $ProductImageFileName = $ProductBasePrice = $ProductDescription = null;

// target directory
$targetDir = "../productImageUploads/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_FILES['ProductImageFileName']) && isset($_POST['Insert'])) {
    $fileName = basename($_FILES["ProductImageFileName"]["name"]);
    $targetPath = $targetDir . $fileName;
    $ProductName = test_input($_POST["ProductName"]);
    $ProductCategory = test_input($_POST["ProductCategory"]);
    $ProductImageFileName = $targetPath;
    $ProductBasePrice = test_input($_POST["ProductBasePrice"]);
    $ProductDescription = test_input($_POST["ProductDescription"]);

    if (move_uploaded_file($_FILES["ProductImageFileName"]["tmp_name"], $targetPath)) {
      $productInstance = new Product();
      $productInstance->addProduct(
        $ProductName,
        $ProductCategory,
        $ProductImageFileName,
        $ProductBasePrice,
        $ProductDescription
      );
    } else {
      echo "Error Moving the file";
    }
  }
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data); //check what it does
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
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
          <a href="../chat/SellerChat.php">
          <button><span class="chat-btn-text">Chat</span> <span id="chat-logo" class="material-symbols-outlined">
              chat
            </span></button>
          </a>
         
          <!-- <span class="material-symbols-outlined"> search </span> -->
          <input type="search" placeholder="Search" id="search" class="search" />
        </div>
        <img src="../assets/pexels-karolina-grabowska-5632397.jpg" alt="" />
      </div>
    </div>
    <div class="addNewProduct">
      <!-- <form action="" method="post">
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
        </form> -->
      <button class="add-product" id="add-product"> <span class="add-product-text">Add</span> <span class="material-symbols-outlined" id="add-logo">
          add
        </span></button>
    </div>

    <div class="popup" id="popup">

      <h3>Add New Product</h3>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
        <div class="popup-navbar">
          <input type="file" name="ProductImageFileName" accept="image/*" id="ProductImageFileName" required>
          <label for="ProductImageFileName">
            <span class="material-symbols-outlined"> image </span>
            Choose
          </label>
          <img src="ProductImageFileName" id="product-img" alt="" />
          <div id="close-modal"><span class="material-symbols-outlined">
              close
            </span></div>

        </div>

        <div class="input-box">
          <input type="text" name="ProductName" id="ProductName" required placeholder="ProductName">
        </div>
        <div class="input-box">
          <select name="ProductCategory" id="ProductCategory">
            <option value="agriculture">Agriculture</option>
            <option value="machinery">Machinery</option>
            <option value="construction">Construction</option>
            <option value="bar & Steel">Bar & Steel</option>
            <option value="other">Other</option>

          </select>
          <!-- <input type="text" name="ProductCategory" id="ProductCategory" required placeholder="ProductCategory"> -->
        </div>
        <div class="input-box">

        </div>
        <div class="input-box">
          <input type="number" name="ProductBasePrice" id="ProductBasePrice" required placeholder="ProductBasePrice">
        </div>
        <div class="input-box">
          <textarea type="text" name="ProductDescription" id="ProductDescription" required placeholder="ProductDescription"></textarea>
        </div>
        <button type="submit" value="Insert" name="Insert" class="Insert-btn"><span class="insert-btn-text">Insert</span><span id="enter-logo" class="material-symbols-outlined">
            subdirectory_arrow_right
          </span> </button>
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
          $sql = "SELECT ProductId FROM `product` WHERE SellerUserName = '" . $SellerUserName . "'";
          $res = $db->query($sql);
          if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
              $product->set_product($row["ProductId"]);
          ?>
              <tr>
                <td><?php echo $product->ProductId; ?></td>
                <td><?php echo $product->ProductName; ?></td>
                <td><?php echo $product->ProductDate; ?></td>
                <td><?php echo $product->ProductCategory; ?></td>
                <td><?php echo $product->ProductBasePrice; ?></td>
                <td><a href='delete.php?productId=<?php echo $product->ProductId; ?>' style='color:red'>delete</a></td>
              </tr>
          <?php
            }
          } ?>
        </tbody>
      </table>
    </div>
    <div class="overlay" id="overlay"></div>
  </div>
</body>

</html>
<!-- <script src="SellerPage.js"></script> -->
<script>
  const tableRows = document.querySelectorAll("tbody tr");
let popup = document.getElementById("popup");
let closeSpan=document.getElementById("close-modal");
let inputs=document.querySelectorAll(".popup .inputs ");
let id,name,date,categroy,quantity,price;
let idInput,nameInput,dateInput,categoryInput,quantityInput,priceInput;
let deleBtn=document.getElementById("delete-btn");
let updateBtn=document.getElementById("update-btn");
let overlay=document.getElementById("overlay");
let search = document.getElementById("search");
let table = document.querySelector('table');
let nameTr = table.querySelectorAll('tbody td[data-title="Name"]');
let addProductBtn=document.getElementById("add-product");

let nameProducts=[];
nameProducts=Array.from(tableRows).map ((names) => {
  return {name:names.textContent, element:names} 
})

search.addEventListener("input", (e) => {
    const value=e.target.value.toLowerCase();
    nameProducts.forEach((names) => {
      console.log(typeof names.name);
      console.log(names.name);
      let isVisible=names.name.toLowerCase().includes(value);
      names.element.classList.toggle("hide",!isVisible);
    })

})

closeSpan.addEventListener("click", () => {
    popup.classList.remove("open-popup");
    overlay.classList.remove("removes");

});
addProductBtn.addEventListener("click", () => {
  popup.classList.add("open-popup");
  console.log(11);
  overlay.classList.add("removes");
})

let priceTr = table.querySelectorAll('tbody td[data-title="Price"]');
let ageDataArray = [];

priceTr.forEach(function(data) {
    ageDataArray.push(data.textContent || data.innerText);
});

let convertedArray=ageDataArray.map(data => parseInt(data,10)) 
// The number 10 symbolizes the base-10 conversion(decimal)
let total=0;
convertedArray.forEach((price) => {
  total+=price;
})
console.log(total);

tableRows.forEach((tableRow) => {
  tableRow.addEventListener("click", () => {
    popup.classList.add("open-popup");
    overlay.classList.add("removes");
     id = tableRow.firstElementChild;
     name = id.nextElementSibling;
     date = name.nextElementSibling;
     categroy = date.nextElementSibling;
     quantity = categroy.nextElementSibling;
     price = tableRow.lastElementChild;
     inputs.forEach((input) => {
        idInput=input.firstElementChild;
        nameInput=idInput.nextElementSibling;
        dateInput=nameInput.nextElementSibling;
        categoryInput=dateInput.nextElementSibling;
        quantityInput=categoryInput.nextElementSibling;
        priceInput=quantityInput.nextElementSibling;
        
        idInput.value=id.textContent;
        nameInput.value=name.textContent;
        dateInput.value=date.textContent;
        categoryInput.value=categroy.textContent;
        quantityInput.value=quantity.textContent;
        priceInput.value=price.textContent;
        updateBtn.addEventListener("click", (e) => {
          e.preventDefault();
            id.textContent=idInput.value;
            name.textContent=nameInput.value;
            date.textContent=dateInput.value;
            categroy.textContent=categoryInput.value;
            quantity.textContent=quantityInput.value;
            price.textContent=priceInput.value;
        })
     })
     deleBtn.addEventListener('click', (e) => {
      e.preventDefault();
        tableRow.innerHTML="";
        
    })
  });
});

let productImg = document.getElementById("product-img");
let inputFile=document.getElementById("ProductImageFileName");

inputFile.onchange= () => {
    productImg.src=URL.createObjectURL(inputFile.files[0]);
}
</script>