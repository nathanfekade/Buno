<!DOCTYPE html>
<html>
<body>

<h2>Payment Form</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

  <label for="fname">First Name:</label><br>
  <input type="text" id="fname" name="first_name"><br>
  <label for="lname">Last Name:</label><br>
  <input type="text" id="lname" name="last_name"><br>
  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email"><br>
  <label for="phone">Phone Number:</label><br>
  <input type="text" id="phone" name="phone_number"><br>
  <label for="amount">Amount:</label><br>
  <input type="text" id="amount" name="amount"><br>
  <input type="submit" value="Submit">
</form> 

</body>
</html>
<?php
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $curl = curl_init();
//     $tx_ref = 'chewatatest-' . time() . '-' . $_POST['email'];
//     $data = array(
//         'amount' => $_POST['amount'],
//         'currency' => 'ETB',
//         'email' => $_POST['email'],
//         'first_name' => $_POST['first_name'],
//         'last_name' => $_POST['last_name'],
//         'phone_number' => $_POST['phone_number'],
//         'tx_ref'=> $tx_ref,
//         'callback_url' => 'https://webhook.site/077164d6-29cb-40df-ba29-8a00e59a7e60',
//         'return_url' => 'https://www.google.com/',
//         'customization[title]' => 'Payment for my favourite merchant',
//         'customization[description]' => 'I love online payments.'
//     );
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $curl = curl_init();
  $email = preg_replace("/[^A-Za-z0-9]/", '', $_POST['email']);
    $tx_ref = 'chewatatest-' . time() . '-' . $email;
  $data = array(
      'amount' => $_POST['amount'],
      'currency' => 'ETB',
      'email' => $_POST['email'],
      'first_name' => $_POST['first_name'],
      'last_name' => $_POST['last_name'],
      'phone_number' => $_POST['phone_number'],
      'tx_ref'=> $tx_ref,
      'callback_url' => 'https://webhook.site/077164d6-29cb-40df-ba29-8a00e59a7e60',
      'return_url' => 'https://www.google.com/',
      'customization[title]' => 'Payment for my favourite merchant',
      'customization[description]' => 'I love online payments.'
  );
  


    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.chapa.co/v1/transaction/initialize',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer CHASECK_TEST-I88BWUFiawzXcFuUN2VKWBFBp8JM1VU1',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // header('Location: ' . $data['checkout_url']);
    $responseArray = json_decode($response, true);
    $checkoutUrl = $responseArray['data']['checkout_url'];

    header('Location: ' . $checkoutUrl);
    echo $response;
}
?>
