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
  // Getting challenges after a certain date

  $sql = "SELECT * FROM `users` WHERE Last_Login < DATE_SUB(NOW(), INTERVAL 5 DAY)";
  $result = $conn->query($sql);
  
  while($row = $chresult->fetch_assoc())
  {
    $points = $row["Points"] - 20;
    $sql = "UPDATE `users` SET `Points` = $points WHERE Username = '{$row["Username"]}'";
    $conn->query($sql);
  }
  
  mysqli_free_result($result);
  mysqli_close($conn);
?>
