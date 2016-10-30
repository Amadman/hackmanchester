<?php
  session_start();
  
  if($_SESSION["overdraft"] == 1){
    $_SESSION["overdraft"] = 0;
  }else{
    $_SESSION["overdraft"] = 1;
  }
  
  header("Location: dashboard.php");
?>
