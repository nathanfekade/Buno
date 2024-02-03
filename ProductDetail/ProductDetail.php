<?php
include('../Classes/Connect.php');
include('../Classes/Product.php');
$Con=new Connect;
$db=$Con->getConnection();
$BuyerUserName= $_SESSION["BuyerUserName"];
//  session_start();

$product = new Product();
$product->set_product($_GET["ProductId"]);
?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$review = $_POST['review'];
$value = $_POST['value'];

$sqlComment = "INSERT INTO productcomment (BuyerUserName,ProductComment,ProductId) VALUES ('$BuyerUserName','$review','$product->ProductId')";
$resComment =  $db->query($sqlComment);
$sqlRating = "INSERT INTO productrating (BuyerUserName,ProductId,ProductRating) VALUES ('$BuyerUserName','$product->ProductId','$value')";
$resRating =  $db->query($sqlRating);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUNO</title>
    <link rel="stylesheet" href="ProductDetail.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <header></header>
    <div class="wrapper">
        <div class="main">
            <div class="productDetails">
                <span class="category"><?php echo $product->ProductCategory;?></span>
                <h2 class="productName"><?php echo $product->ProductName;?></h2>
                <h2 class="productPrice"><?php echo $product->ProductBasePrice;?></h2>
                <span class="date"><?php echo $product->ProductDate;?></span>
                <p class="description"><?php echo $product->ProductDescription;?>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit saepe atque, ratione quibusdam magni sunt ab excepturi, aspernatur explicabo quos illum distinctio laudantium. Rerum recusandae aspernatur beatae unde harum ut!</p>
                <a href="../chat/BuyerChat.php?SellerUserName=<?php echo $_SESSION["SellerProductUserName"] =$product->SellerUserName;?>"><button class="btnContact">contact seller</button> </a>       
            </div>
            <div class="images">
                <?php
                $query = $db->query("SELECT productImageFileName FROM productgallery WHERE productId=".$product->ProductId);

                if($query->num_rows > 0){
                    while($row = $query->fetch_assoc()){
                        $imageURL = '../productImageUploads/'.$row["productImageFileName"];
                        echo "<img src='".$imageURL."' alt='' />";
                    }
                }
                ?>
            </div>
        </div>
        <div class="productReview">
        <form action="" method="post">
            <p>your rating:</p>
            <div class="stars" id="stars">
                <span class="star" data-value="1">★</span>
                <span class="star" data-value="2">★</span>
                <span class="star" data-value="3">★</span>
                <span class="star" data-value="4">★</span>
                <span class="star" data-value="5">★</span>
                <input type="hidden" name="value" id="hiddenValue" value="yourValue">
            </div>
            <p>your review:</p>
            <textarea name="review" id="review" placeholder="Write your review here"></textarea>
            <button id="submit" type="submit">Submit</button>
        </form>
        </div>
        
        <div class="commentSection">
            <span>Comments:</span>
            <?php
            $sql= "SELECT * FROM productcomment WHERE ProductId = ".$product->ProductId;
            if($res = $db->query($sql)){
                while($row = $res->fetch_assoc()){
                    $BuyerUserName =$_SESSION["BuyerUserName"] ?><div class="productComment">
                    <div class="commentInfo">
                        <div class="reviewedBy">
                            <span class="material-symbols-outlined">account_circle</span>
                            <p><?php echo "$BuyerUserName";?></p>
                        </div>
                        <p class="date"><?php echo substr($row["AddedOnDate"],0,10);?></p>
                    </div>
                    <p class="comment"><?php echo $row["ProductComment"];?></p>
                </div>

            <?php
            }
        }?>
    </div>
</div>
<footer></footer>

</body>
</html>
<script>
  const stars = document.querySelectorAll(".star");
const reviewText = document.getElementById("review");
const submitBtn = document.getElementById("submit");
const reviewsContainer = document.getElementById("reviews");
let rating;
console.log('23');
 
stars.forEach((star) => {
    star.addEventListener("click", () => {
        const value = parseInt(star.getAttribute("data-value"));
        document.getElementById('hiddenValue').value = value;
        rating = value;
 
        stars.forEach((s) => s.classList.remove("one", "two", "three", "four", "five"));

        stars.forEach((s, index) => {
            if (index < value) {
                s.classList.add(getStarColorClass(value));
            }
        });
 
        stars.forEach((s) => s.classList.remove("selected"));
        star.classList.add("selected");
    });
});
 
submitBtn.addEventListener("click", () => {
    const review = reviewText.value;
    const userRating = rating;

    if (!userRating || !review) {
        alert("Please select a rating and provide a review before submitting.");
        return;
    }
    if (userRating > 0) {
        stars.forEach((s) => s.classList.remove("one", "two",  "three", "four", "five", "selected"));
    }
});
 
function getStarColorClass(value) {
    switch (value) {
        case 1:
            return "one";
        case 2:
            return "two";
        case 3:
            return "three";
        case 4:
            return "four";
        case 5:
            return "five";
        default:
            return "";
    }
}
</script>

