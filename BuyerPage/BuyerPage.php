<?php
include('../Classes/Connect.php');
include('../Classes/Product.php');
$Con = new Connect;
$db = $Con->getConnection();
// $BuyerUserName = $_SESSION["BuyerUserName"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BUNO</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="BuyerPage.css?v=<?php echo time(); ?>">


</head>

<body>

  <nav class="navbar">
    <div class="brand-title">
      BUNO
    </div>
    <a href="#" class="toggle-button">
      <span class="material-symbols-outlined">
        menu
      </span>
    </a>
    <div class="navbar-links">
      <ul>
        <li>
          <a href="#"><span class="material-symbols-outlined" id="search-icon">
              search
            </span><input type="text" placeholder="Search" id="search" /></a>




        </li>
        <li class="select">
          <select>
            <option value="" selected>All</option>
            <option value="construction">Construction</option>
            <option value="agriculture">Agriculture</option>
            <option value="machinery">Machinery</option>
            <option value="bar & Steel">Bar & Steel</option>
            <option value="other">Other</option>

          </select>
        </li>
        <li><a href="#"><span id="logouts" class="material-symbols-outlined">
              logout
            </span></a></li>
      </ul>
    </div>
  </nav>
  <div class="wrapper">
    <?php
    $product = new Product();
    $sql = "SELECT ProductId FROM `product`";
    $res = $db->query($sql);

    if ($res->num_rows > 0) {
      while ($row = $res->fetch_assoc()) {
        $product->set_product($row["ProductId"]);
    ?>
        <div class='product'>
          <p class="product-categorys"><?php echo $product->ProductCategory; ?></p>
          <a href="../ProductDetail/ProductDetail.php?ProductId=<?php echo $product->ProductId; ?>">
            <div class="change-pic">
              <img src="<?php echo $product->ProductImageFileName; ?>" alt="" />
            </div>
            <div class="product-detail">
              <span class="productName"><?php echo $product->ProductName; ?></span>
              <div class="priceAndRating">
                <span class="productRating">⭐<?php echo $product->calc_product_rating($product->ProductId); ?></span>
                <span class="productPrice"><?php echo $product->ProductBasePrice; ?>birr</span>

              </div>

            </div>
          </a>

        </div>

    <?php
      }
    } ?>
  </div>
  <footer></footer>
  <script>
    let search = document.getElementById("search");
    let products = document.querySelectorAll(".product");
    let namedProducts = [];
    let logout = document.getElementById("logout");
    let selects = document.querySelector("select");
    console.log(selects[0].value);
    console.log(selects[1].value);
    console.log(selects[2].value);
    namedProducts = Array.from(products).map((product) => {
      return {
        names: product.textContent,
        element: product,
      };
    });
    selects.addEventListener("input", () => {
      // let isVisible;

      namedProducts.forEach((product) => {
        console.log(product.names);
        if (selects.value === selects[0].value.toLowerCase()) {
          product.element.classList.remove("hide");
        } else if (selects.value === selects[1].value.toLowerCase()) {
          isVisible = product.names.toLowerCase().includes(selects[1].value);
          product.element.classList.toggle("hide", !isVisible);
        } else if (selects.value === selects[2].value.toLowerCase()) {
          isVisible = product.names.toLowerCase().includes(selects[2].value);
          product.element.classList.toggle("hide", !isVisible);
        } else if (selects.value === selects[3].value.toLowerCase()) {
          isVisible = product.names.toLowerCase().includes(selects[3].value);
          product.element.classList.toggle("hide", !isVisible);
        }
        else if (selects.value === selects[4].value.toLowerCase()) {
          isVisible = product.names.toLowerCase().includes(selects[4].value);
          product.element.classList.toggle("hide", !isVisible);
        }
        else if (selects.value === selects[5].value.toLowerCase()) {
          isVisible = product.names.toLowerCase().includes(selects[5].value);
          product.element.classList.toggle("hide", !isVisible);
        }
        
      });
    });

    search.addEventListener("input", (e) => {
      let values = e.target.value.toLowerCase();
      console.log(values);
      namedProducts.forEach((product) => {
        console.log(product.names);
        let isVisible = product.names.toLowerCase().includes(values);
        product.element.classList.toggle("hide", !isVisible);
      });
    });

    let toggleBtn = document.querySelector(".toggle-button");
    let navBarLinks = document.querySelector(".navbar-links");
    let navbar = document.querySelector(".navbar");
    let invisible = true;
    toggleBtn.addEventListener("click", () => {
      if (invisible) {
        navBarLinks.style.display = "block";
        invisible = false;
      } else {
        navBarLinks.style.display = "none";
        invisible = true;
      }
    });

    console.log("Yafet");
  </script>
</body>

</html>