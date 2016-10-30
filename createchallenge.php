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
  
  $name = rand(1, 100);
  $val = rand(2000, 8000);
  
  $name = "challenge" . $name;
  
  $sql = 'INSERT INTO `challenges` (`Name`, `Value`, `Description`, `AmountNeeded`, `Start_Time`, `End_Time`,`Merchant`) VALUES ("'.$name.'", 150, "Spend over '.$val.' on any order from MC\'s", '.$val.', NOW(), "2017-01-01 00:00:00","MC")';
  
  $conn->query($sql);
  
  header("Location: challenges.php");
?>
