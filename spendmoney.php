<?php
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'spent_db';
  $conn = new mysqli($servername, $username, $password,$dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  
  $val = rand(100, 9000);
  
  $sql = 'INSERT INTO `transactions` (`Merchant`, `Username`, `amount`, `createdDate`) VALUES ("MC", "amad", "'.$val.'", NOW())';
  
  $conn->query($sql);
  
  header("Location: dashboard.php");
?>
