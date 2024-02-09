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
    <nav class="buno_logo">
      <img src="buno.png" alt="logo">
      <a href="#" class="header__logo">BUNO</a>
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
                    <div class="user-info">
                        <button class="btn-view-document" name="viewDocument"><a href="../AdminPage/DocumentViewer.php?imageFileName=../VerificationPage/<?php echo $row['SellerDocuments'];?>"><div><span class="material-symbols-outlined">open_in_new</span>view document</div></a></button>
                        <?php
                        $sql = "SELECT * FROM `seller` WHERE SellerUserName = '".$row["SellerUserName"]."'";
                        $result=$db->query($sql);
                        $row = $result->fetch_assoc();
                        ?>
                        <span class="seller-name">Name: <?php echo $row["SellerFirstName"]." ".$row["SellerLastName"];?></span>
                        <span class="seller-email">Email: <?php echo $row["SellerEmail"];?></span>
                        <span class="seller-phone">Phone Number: <?php echo $row["SellerPhoneNo"];?></span>
                        <span class="seller-username">UserName: <?php echo $row["SellerUserName"];?></span>
                        <div class="buttons">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                            <input type="hidden" name="value" value="<?php echo $row['SellerUserName']; ?>">
                            <div class="btn-flex">
                            <button class="btn-approve" name="approve">approve</button>
                            <button class="btn-deny" name="deny">deny</button>
                            </div>
                        </form>
                    </div>
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
<script src="AdminPage.js"></script>