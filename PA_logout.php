<?php
  session_start();
   require "tsutils.php";
  
   $username = $_SESSION['userName'];
   $token = $_SESSION['token'];
   //echo $username."////".$token;die;
   logout($username, $token); 

/*
// Inialize session
session_start();

// Delete certain session
unset($_SESSION['username']);
// Delete all session variables
 session_destroy();

// Jump to login page
header('Location: index.php');

*/


?>
