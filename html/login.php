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

	$username = $password = $error = "";

	if(isset($_POST["submit"])){
		if (empty($_POST["username"]) || empty($_POST["password"])){
      $error = "Both fields are required.";
    }
    else {
    	$username = $_POST["username"];
			$password = $_POST["password"];

			$sql = "SELECT First_Name, Surname, Date_Of_Birth, Email_Adress FROM Users WHERE Username='$username' and Password='$password'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			if (mysqli_num_rows($result) == 1){
				$_SESSION['username'] = $username;
				$_SESSION['email'] =$row['Email_Adress'];
				$_SESSION['firstName'] =$row['First_Name'];
				$_SESSION['surname'] =$row['Surname'];
				$_SESSION['dateOfBirth'] =$row['Date_Of_Birth'];

				header("location: success.php");
			}
			else {
				$error = "Incorrect username or password.";
			}
			if (!empty($error)) {
				echo $error;
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
	Username: <br>
	<input type="text" name="username"><br>

	Password: <br>
	<input type="password" name="password"><br>

	<input type="submit" name="submit" value="SIGN IN">
	</form>
</body>
</html>