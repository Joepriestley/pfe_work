
<?php
session_start();
// session_destroy();
// if(isset($_GET['logout'])) {
//     session_destroy(); // This will destroy the session
//     header("Location: login.php"); // Redirect to login page after logout
//     exit;
// }
$_SESSION['nom']='';
header('location: login.php');
?>
