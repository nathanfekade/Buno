<?php

include('../Classes/verification.php');
// include('../Classes/Connect.php');
// $Con=new Connect;
// $db=$Con->getConnection();




// target directory
$targetDir="verificationUploads/";

// check if the file was uploaded
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['SellerDocuments'])&& $_FILES['SellerDocuments']['error']==0 && isset($_FILES['SellerDocumentImage'])&& $_FILES['SellerDocumentImage']['error']==0){
  $fileName=basename($_FILES["SellerDocuments"]["name"]);
  $imageName=basename($_FILES["SellerDocumentImage"]["name"]);
  $targetPath=$targetDir.$fileName;
  $targetImagePath=$targetDir.$imageName;

  // moving files to the targetPath
  if(move_uploaded_file($_FILES["SellerDocuments"]["tmp_name"],$targetPath)&& move_uploaded_file($_FILES["SellerDocumentImage"]["tmp_name"],$targetImagePath)){

    $verificationInstance = new verification($targetPath,$targetImagePath);

    $verificationInstance->insertDocuments( $targetPath,$targetImagePath);

    //Moved successfully write details to db
    // $sql="INSERT INTO SellerVerification(SellerDocuments,SellerDocumentImage) VALUES ('$targetPath','$targetImagePath')";
    
    // if($db->query($sql)==true){
    //   echo "File uploaded and saved to DB";
    // }
    // else{
    //   echo "Error:  $sql Error Details:  $Con->error";
    // }
  
 
}
else{
  echo "Error Moving the file";
}

}
// else{
//   echo "file not uploaded";
// }
// $Con->close;





?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seller Verification</title>
</head>
<body>
  <div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">

        <div>
        License for commerce:
        <input type="file" placeholder="Document" name="SellerDocuments"  />
        </div>

        <div>
        Picture of your Image on the license:
        <input type="file" placeholder="Image" name="SellerDocumentImage"  />
        </div>
    
        <center>
        <button id="verifyBtn" class="verify-btn" type="submit" name="verify" >
          Sign Up
        </button>
      </center>
      
        


      </form>

      </div>

</body>
</html>