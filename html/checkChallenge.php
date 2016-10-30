<!DOCTYPE html>
<html>
  <head>
  	<title>
  		

  	</title>
  </head>
  <body>
  <?php 

  //change these to session variables
  $loggedInUser = 'wasami';
  $latestIDChecked = 0;


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


    // Getting challenges after a certain date

    $sql = "SELECT Name, Value, Start_Time,End_Time, Description, Merchant, AmountNeeded FROM challanges where End_Time > DATE_SUB(CURDATE(),INTERVAL 7 DAY)";
    $points = 0;

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



    

    $sql = "SELECT id, creditorDebit, amount, createdDate,Merchant FROM transactions WHERE Username='wasami' and id>$latestIDChecked";//set this to prev id
    $result = $conn->query($sql);

    $totalSpentOn["empty"]= null;
    $latestIDChecked = 0;

    if ($result->num_rows > 0)
    {
      // output data of each row
      while($row = $result->fetch_assoc())
      {
        if ( array_key_exists ( $row["Merchant"],$startTime) && check_in_range($startTime[$row["Merchant"]], $endTime[$row["Merchant"]],$row["createdDate"])) {
          if (array_key_exists ( $row["Merchant"],$totalSpentOn))
          {
            $totalSpentOn[$row["Merchant"]] = $totalSpentOn[$row["Merchant"]]  +   $row["amount"];
          }
          else{
            $totalSpentOn[$row["Merchant"]] =  $row["amount"];       
          }


          echo "total spend on merchant ".$row["Merchant"]. " is " . $totalSpentOn[$row["Merchant"]] . "<br>";
        }
          
        
        if ($row["id"] > $latestIDChecked)
        {
          $latestIDChecked = $row["id"];
        }
      }

      echo "latest id checked is now " .$latestIDChecked;
    }



    $sql = "SELECT name, value, Merchant FROM challanges where End_Time > DATE_SUB(CURDATE(),INTERVAL 7 DAY)";//change this to one week ago


    $chresult = $conn->query($sql);


    if ($chresult->num_rows > 0)
    {
      // output data of each row
      while($row = $chresult->fetch_assoc())
      {
         if (array_key_exists ( $row["Merchant"],$totalSpentOn)){
          if( $totalSpentOn[$row["Merchant"]] > $amountNeeded[$row["Merchant"]])
          {
            Echo "you completed " . $row['name'] .  " and gained " . $row['value'] . " Points <br> ";
            $points += $row['value'];
          }
        }


      
      }
    }
    
 
    
    
      
    


    echo "total points earned ". $points ."<br>";


  
    $sql = "UPDATE `users` SET `Points`=Points + $points,`Total_Points`=Total_Points + $points WHERE Username='$loggedInUser'";
    $conn->query($sql);

    $conn->close();




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


  </body>
</html>