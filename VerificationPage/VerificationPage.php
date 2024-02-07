<?php

include('../Classes/verification.php');
// include('../Classes/Connect.php');
// $Con=new Connect;
// $db=$Con->getConnection();

// session_start();
$sellerFolderName=$_SESSION['SellerUserName'];
$sellerFileName=$sellerFolderName.'/'.$sellerFolderName;



// target directory
$targetDir="verificationUploads/";


// echo 'd'.$sellerImageDir;
// check if the file was uploaded
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['SellerDocuments'])&& $_FILES['SellerDocuments']['error']==0 && isset($_POST['image']) ){


      $fileName=basename($_FILES["SellerDocuments"]["name"]);
      $targetPath=$targetDir.$fileName;
      $data = $_POST['image'];
      $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
      
      
      if($sellerImageDir=mkdir($sellerFolderName)){
        $imageName = $sellerFileName . '.png';
      }
      else {
        $imageName = time() . '.png';
      }

      if (file_put_contents($imageName, $imageData) === false) {
          echo "Failed to write image data to $imageName";
    
      } else {
            // echo "Image data written to $imageName successfully";
            
            // moving files to the targetPath
            if(move_uploaded_file($_FILES["SellerDocuments"]["tmp_name"],$targetPath)){

            $verificationInstance = new verification($targetPath,$imageName);

            $verificationInstance->insertDocuments($targetPath,$imageName);
 
          }
else{
  echo "Error Moving the file";
}

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
          <video id="video" width="640" height="480" autoplay></video>
          <button id="snap">Snap Photo</button>
      </div>


      <div>

          <canvas id="canvas" width="640" height="480"></canvas>
      </div>

  <div>
    
      <form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">

        <div>
        License for commerce:
        <input type="file" placeholder="Document" name="SellerDocuments"  />
        </div>

        <input type="hidden" id="image" name="image">

        <!-- Picture of your Image on the license:
        <input type="file" placeholder="Image" name="SellerDocumentImage"  />
        </div> -->
    
        <center>
        <button id="verifyBtn" class="verify-btn" type="submit" name="verify" >
          Sign Up
        </button>
      </center>
      
        
      </form>
     
     </div>


      


      
<script>
// Grab elements, create settings, etc.
var video = document.getElementById('video');

// Get access to the camera!
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        video.srcObject = stream;
        video.play();
    });
}

// Elements for taking the snapshot
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');

// Trigger photo take
document.getElementById("snap").addEventListener("click", function() {
    context.drawImage(video, 0, 0, 640, 480);
});

// Trigger form submit
document.getElementById("form").addEventListener("submit", function() {
    var imageData = canvas.toDataURL('image/png');
    document.getElementById("image").value = imageData;
});
</script>

</body>
</html>


