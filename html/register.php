<!DOCTYPE html>
<html>
	<head>
		<style>
			
		</style>
	</head>
	<body>
		<?php
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
		$firstName = $surname = $username = $password = $dob = $email = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			$firstName = $_POST["firstName"];
			$surname = $_POST["surname"];
			$username = $_POST["username"];
			$password = $_POST["password"];
			$dob = $_POST["dateOfBirth"];
			$email = $_POST["email"];
		}
		$addToDB = 1;
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if ($addToDB) {
				/*$hashedPassword = password_hash($password, PASSWORD_DEFAULT);*/
				$addData = "INSERT INTO `Users` (`Username`,`Password`,`Email_Adress`,`Date_Of_Birth`,`First_Name`,`Surname`)
										VALUES ('$username','$password','$email','$dob','$firstName','$surname')";
				if (mysqli_query($conn, $addData)){	
	          echo "Succesfully registered! Please Log In";			
				} 
				else{
			  echo "FAIL";
		    }
			}
		}

		?>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			First Name: <br>
			<input type="text" name="firstName"><br>

			Surname: <br>
			<input type="text" name="surname"><br>

			Date Of Birth: <br>
			<input type="date" name="dateOfBirth"><br>

			Username: <br>
			<input type="text" name="username"><br>

			Password: <br>
			<input type="password" name="password"><br>

			Email Adress: <br>
			<input type="email" name="email"><br><br>

			<input type="submit" value="Register">
		</form>




	</body>
</html>
