<?php 
	session_start();

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "spent_db";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";

	if(isset($_POST["buy1"])){
		$name = "200SP";
		$sql = "SELECT Item_Code, Item_Value FROM Shop WHERE Item_Name='$name'"; 
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		if (mysqli_num_rows($result) == 1){
			if ($_SESSION['points'] < $row['Item_Value']){
				echo "insufficient amount of points";
			}
			else {
				echo "congratz you have wasted your points.Now go get more!";
			}
		}

	}
	if(isset($_POST["buy2"])){
		$name = "50SP";
		$sql = "SELECT Item_Code, Item_Value FROM Shop WHERE Item_Name='$name'"; 
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		if (mysqli_num_rows($result) == 1){
			if ($_SESSION['points'] < $row['Item_Value']){
				echo "insufficient amount of points";
			}
			else {
				echo "congratz you have wasted your points";
			}
		}

	}
 ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<input type="submit" name="buy1" value="200SP"><br>
	<input type="submit" name="buy2" value="50SP">
	</form>
</body>
</html>>