<?php
  //change these to session variables
  $loggedInUser = $_SESSION["username"];
  $latestIDChecked = $_SESSION["lastID"];

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

  $sql = "SELECT Name, Value, Start_Time,End_Time, Description, Merchant, AmountNeeded FROM challenges where End_Time > DATE_SUB(NOW(), INTERVAL 7 DAY)";
  $points = 0;
  $regularPoints = 0;

  $startTime;
  $endTime;
  $amountNeeded;
  $value;

  $chresult = $conn->query($sql);

  if ($chresult->num_rows > 0)
  {
    // output data of each row
    while($row = $chresult->fetch_assoc())
    {
        $startTime[$row["Merchant"]] = $row["Start_Time"];
        $endTime[$row["Merchant"]] = $row["End_Time"];
        $amountNeeded[$row["Merchant"]] =  $row["AmountNeeded"];       
        $value[$row["Merchant"]] = $row["Value"];
    }
  }
  
  $sql = "SELECT `id`, `creditorDebit`, `amount`, `createdDate`, `Merchant` FROM transactions WHERE Username='$loggedInUser' and id>$latestIDChecked";
  $result = $conn->query($sql);

  $totalSpentOn["empty"]= null;

  if ($result->num_rows > 0)
  {
    // output data of each row
    while($row = $result->fetch_assoc())
    {
      if ( array_key_exists ( $row["Merchant"],$startTime) && check_in_range($startTime[$row["Merchant"]], $endTime[$row["Merchant"]], $row["createdDate"])) {
        if (array_key_exists ( $row["Merchant"],$totalSpentOn))
        {
          $totalSpentOn[$row["Merchant"]] = $totalSpentOn[$row["Merchant"]] + $row["amount"];
        }
        else{
          $totalSpentOn[$row["Merchant"]] =  $row["amount"];
        }
      }
        
      
      if ($row["id"] > $latestIDChecked)
      {
        $latestIDChecked = $row["id"];
      }
      
      $pointsToAdd = $row["amount"];
      
      if($row["creditorDebit"] == "Credit"){
        $pointsToAdd = $pointsToAdd * 2;
      }
      
      $regularPoints = $regularPoints + $row["amount"];
      
    }
  }

  $sql = "SELECT `Name`, `Value`, `Merchant` FROM `challenges` WHERE End_Time > DATE_SUB(NOW(), INTERVAL 7 DAY)";

  $chresult = $conn->query($sql);

  if (($chresult->num_rows) > 0)
  {
    // output data of each row
    while($row = $chresult->fetch_assoc())
    {
      if (array_key_exists($row["Merchant"], $totalSpentOn)){
        if($totalSpentOn[$row["Merchant"]] > $amountNeeded[$row["Merchant"]]){
          $points = $points + $row['Value'];
        }
      }
    }
  }
  
  if($_SESSION["overdraft"] == 1){
    $points = $points * 2;
    $regularPoints = $regularPoints * 2;
  }
  $sql = "UPDATE `users` SET `Points`=Points + $points + $regularPoints,`Total_Points`=Total_Points + $points + $regularPoints, `Last_ID_Checked`=$latestIDChecked WHERE Username='$loggedInUser'";
  $conn->query($sql);

  $conn->close();
  
  $_SESSION["points"] =$_SESSION["points"] + $points + $regularPoints;
  $_SESSION["totalPoints"] = $_SESSION["totalPoints"] + $points;
  $_SESSION["lastID"] = $latestIDChecked;

  function check_in_range($start_date, $end_date, $createdDate)
  {
    // Convert to timestamp
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($createdDate);

    // Check that user date is between start & end
    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
  }
?>
