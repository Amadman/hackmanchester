<!DOCTYPE html>

<html>
  <head>

  </head>

  <body>
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
    echo "Connected successfully";
    echo "<br>";
    $sql = "SELECT id, Name, Value, Start_Time,End_Time, Description FROM challanges where End_Time > CURDATE()";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
      // output data of each row
      while($row = $result->fetch_assoc())
      {
        echo "id: " . $row["id"]. " - Name: " . $row["Name"]. "- Points Awarded" . $row["Value"]. $row["Start_Time"].$row["End_Time"]. $row["Description"]."<br>";
      }
    }

    else 
    {
      echo "0 results";
    }

    $conn->close();


    ?>
  </body>
</html>
