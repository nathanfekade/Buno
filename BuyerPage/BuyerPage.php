<?php
include('../Classes/Connect.php');
include('../Classes/Product.php');
$Con=new Connect;
$db=$Con->getConnection();
$BuyerUserName= $_SESSION["BuyerUserName"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUNO</title>
    <link rel="stylesheet" href="BuyerPage.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <header></header>
    <div class="wrapper">
    <?php
        $product = new Product();
        $sql = "SELECT ProductId FROM `product`";
        $res = $db->query($sql);

        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $product->set_product($row["ProductId"]);
                ?>
                <a href="../ProductDetail/ProductDetail.php?ProductId=<?php echo $product->ProductId;?>"><div class='product'>
                    <img src="<?php echo $product->ProductImageFileName;?>" alt="" width="100px"/>
                    <div class="footer">
                        <div class="priceAndRating">
                            <span class="productPrice"><?php echo $product->ProductBasePrice;?>birr</span>
                            <span class="productRating">⭐<?php echo $product->calc_product_rating($product->ProductId);?></span>
                        </div>
                        <span class="productName"><?php echo $product->ProductName;?></span>
                    </div>
                </div></a>

                <?php
                }
            }?>
    </div>
    <footer></footer>
</body>
</html>
<script src="BuyerPage.js"></script>

