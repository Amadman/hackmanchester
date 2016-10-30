<!DOCTYPE html>
<html>
  <head>
  	<title>
  		

  	</title>
  </head>
  <body>
  <?php 


  $loggedInUser = 'wasami';
  


  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'spent_db';
  $conn = new mysqli($servername, $username, $password,$dbname);

  // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    echo "Connected successfully";
    echo "<br>";




    // get challenges completed here

  /*  

   
    $result = $conn->query($sql);
  
*/

    

    $sql = "SELECT id, creditorDebit, amount, createdDate,Merchant FROM transactions WHERE Username='wasami' and id>=0";//set this to prev id
    $result = $conn->query($sql);

    $totalSpentOn["empty"]= null;

    if ($result->num_rows > 0)
    {
      // output data of each row
      while($row = $result->fetch_assoc())
      {
        if (array_key_exists ( $row["Merchant"],$totalSpentOn))
        {
          $totalSpentOn[$row["Merchant"]] = $totalSpentOn[$row["Merchant"]]  +   $row["amount"];
        }
        else{
          $totalSpentOn[$row["Merchant"]] =  $row["amount"];       
           }
        echo "total spend on merchant ".$row["Merchant"]. " is " . $totalSpentOn[$row["Merchant"]] . "<br>";
      }
    }

    $sql= "SELECT name, value ,description, merchant, amountNeeded FROM challanges where challanges.Start_Time >= '2016-10-22'";
    $points = 0;
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
      // output data of each row
      while($row = $result->fetch_assoc())
      {
        Echo "for  " . $row["merchant"] .  "you need" . $row["amountNeeded"] . " Points <br> ";
        if( $totalSpentOn[$row["merchant"]] > $row["amountNeeded"])
        {
          Echo "you completed " . $row['name'] .  "and gained" . $row['value'] . "Points <br> ";
          $points += $row['value'];
        }
      }
    }

    
    echo "total points earned ". $points ."<br>";


  
    $sql = "UPDATE `users` SET `Points`=Points + $points,`Total_Points`=Total_Points + $points WHERE Username='$loggedInUser'";
    $conn->query($sql);

    $conn->close();

   ?>


  </body>
</html>