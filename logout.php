<?php
session_start();
session_destroy();

// Redirect to another page
header('Location: HomePage/HomePage.php'); // replace with your page
exit;
?>