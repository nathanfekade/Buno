<?php
include('../Classes/Connect.php');
include('../Classes/Product.php');
$Con=new Connect;
$db=$Con->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["approve"])){
        $sql= "UPDATE sellerverification SET SellerVerificationStatus=1 WHERE SellerUserName = '".$_POST['value']."'";
        $res=$db->query($sql);
    }
    if(isset($_POST["deny"])){
        $sql= "UPDATE sellerverification SET SellerVerificationFailed=1 WHERE SellerUserName = '".$_POST['value']."'";
        $res=$db->query($sql);
    }
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="AdminPage.css?v=<?php echo time(); ?>">
    <title>BUNO</title>
</head>
<body>
    <header>
        <nav class="header__nav">
            <a class="header__logo" href="">BUNO</a>
            <h4>Welcome Back!</h4>
        </nav>
    </header>
    <div class="wrapper">
        <div class="title">
            <h2>User Requests</h2>
        </div>
        <div class="main">
            <div class="request-list">
                <?php
            $sql = "SELECT * FROM `sellerverification`";
            $res = $db->query($sql);
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    if($row["SellerVerificationStatus"] == false && $row['SellerVerificationFailed'] == false){
                    ?>
                    <div class="user-request">
                    <img src='../VerificationPage/<?php echo $row["SellerDocumentImage"];?>' alt="" width="100px"/>
                    <span class="username"><?php echo $row["SellerUserName"];?></span>
                    <button class="btn-view-document" name="viewDocument"><a href="../AdminPage/DocumentViewer.php?imageFileName=../VerificationPage/<?php echo $row['SellerDocuments'];?>">view document</a></button>
                    <div class="buttons">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                            <input type="hidden" name="value" value="<?php echo $row['SellerUserName']; ?>">
                            <button class="btn-approve" name="approve">approve</button>
                            <button class="btn-deny" name="deny">deny</button>
                        </form>
                    </div>
                </div>
                <?php 
                }}}?>
            </div>
        </div>
    </div>
    <footer></footer>
</body>
</html>