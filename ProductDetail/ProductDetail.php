<?php
include('../Classes/Connect.php');
include('../Classes/Product.php');
$Con = new Connect;
$db = $Con->getConnection();
$BuyerUserName = $_SESSION["BuyerUserName"];

$product = new Product();
$product->set_product($_GET["ProductId"]);
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
    <link rel="stylesheet" href="ProductDetail.css?v=<?php echo time(); ?>">

</head>

<body>
    <header></header>
    <div class="wrapper">
        <div class="main">
            <div class="productDetails">
                <!-- <span class="category"><?php echo $product->ProductCategory; ?></span> -->
                <h2 class="productName"><?php echo $product->ProductName; ?></h2>
                <h2 class="productPrice"><?php echo $product->ProductBasePrice; ?>Br.</h2>
                <!-- <span class="date"><?php echo $product->ProductDate; ?></span> -->
                <p class="description"><?php echo $product->ProductDescription; ?>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit saepe atque, ratione quibusdam magni sunt ab excepturi, aspernatur explicabo quos illum distinctio laudantium. Rerum recusandae aspernatur beatae unde harum ut!</p>
                <div class="productRating">
                    <div class="ratingInfo">
                        <h1><?php echo $product->calc_product_rating($product->ProductId); ?>⭐</h1>
                        <p id="ratingCountAll"><?php echo $product->count_product_rating_all($product->ProductId); ?> ratings</p>
                    </div>
                    <div class="ratingProgress">
                        <span>5</span>
                        <div class="progress-bar">
                            <div class="done" id="0"><?php echo $product->count_product_rating($product->ProductId, 5); ?></div>
                        </div>
                    </div>
                    <div class="ratingProgress">
                        <span>4</span>
                        <div class="progress-bar">
                            <div class="done" id="1"><?php echo $product->count_product_rating($product->ProductId, 4); ?></div>
                        </div>
                    </div>
                    <div class="ratingProgress">
                        <span>3</span>
                        <div class="progress-bar">
                            <div class="done" id="2"><?php echo $product->count_product_rating($product->ProductId, 3); ?></div>
                        </div>
                    </div>
                    <div class="ratingProgress">
                        <span>2</span>
                        <div class="progress-bar">
                            <div class="done" id="3"><?php echo $product->count_product_rating($product->ProductId, 2); ?></div>
                        </div>
                    </div>
                    <div class="ratingProgress">
                        <span>1</span>
                        <div class="progress-bar">
                            <div class="done" id="4"><?php echo $product->count_product_rating($product->ProductId, 1); ?></div>
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <a href="../chat/BuyerChat.php?SellerUserName=<?php echo $_SESSION["SellerProductUserName"] = $product->SellerUserName; ?>">
                        <button class="btnContact"><span class="btnContact-text">Contact</span> <span class="material-symbols-outlined" id="chat-logo">
                                chat
                            </span></button>
                    </a>
                    <a href="../PaymentPage/PaymentPage.php">
                    <button class="btnPurchase" id="btnPurchase"><span class="btnPurchase-text">Purchase</span> <span class="material-symbols-outlined" id="money-logo">
                            attach_money
                        </span></button> </a>
                    
                </div>

            </div>
            <div class="images">
                <img src="<?php echo $product->ProductImageFileName; ?>" alt="" />
            </div>
        </div>
        <div class="productReview">
            <form action="" method="post">
                <div class="review-submits">
                    <p>Your rating:</p>
                    <div class="stars" id="stars">
                        <span class="star" data-value="1">★</span>
                        <span class="star" data-value="2">★</span>
                        <span class="star" data-value="3">★</span>
                        <span class="star" data-value="4">★</span>
                        <span class="star" data-value="5">★</span>
                        <input type="hidden" name="value" id="hiddenValue" value="yourValue">
                    </div>
                </div>

                <div class="review-submit">
                    <p>Your review:</p>
                    <textarea name="review" id="review" placeholder="Write your review here" class="review"></textarea>
                    <button id="submit" type="submit" class="submit"><span class="submit-text">Submit</span><span class="material-symbols-outlined" id="arrow-logo">
                            arrow_forward
                        </span></button>
                </div>

            </form>
        </div>

        <div class="commentSection">
            <span>Comments:</span>
            <?php
            $sql = "SELECT * FROM productcomment WHERE ProductId = " . $product->ProductId;
            if ($res = $db->query($sql)) {
                while ($row = $res->fetch_assoc()) {
                    $BuyerUserName = $row['BuyerUserName'] ?><div class="productComment">
                        <div class="commentInfo">
                            <div class="reviewedBy">
                                <span class="material-symbols-outlined">account_circle</span>
                                <p><?php echo "$BuyerUserName"; ?></p>
                            </div>
                            <p class="date"><?php echo substr($row["AddedOnDate"], 0, 10); ?></p>
                        </div>
                        <p class="comment"><?php echo $row["ProductComment"]; ?></p>
                    </div>

            <?php
                }
            } ?>
        </div>
    </div>
    <footer></footer>
</body>

</html>
<script src="ProductDetail.js"></script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $review = $_POST['review'];
    $value = $_POST['value'];
    $sql_comment = "INSERT INTO productcomment (BuyerUserName,ProductComment,ProductId) VALUES ('$BuyerUserName','$review','$product->ProductId')";
    $res_comment =  $db->query($sql_comment);
    $sql_rating = "INSERT INTO productrating (BuyerUserName,ProductId,ProductRating) VALUES ('$BuyerUserName','$product->ProductId','$value')";
    $res_rating =  $db->query($sql_rating);
}
?>