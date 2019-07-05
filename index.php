<?php
   require "tsutils.php";

   $userName = $_SESSION['userName'] = $_GET['userName'];
   $securityToken = $_SESSION['token'] = $_GET['securityToken'];

   $result_array = session_validate($userName, $securityToken);

   if($result_array != "") {

   } else {

   }


?>
