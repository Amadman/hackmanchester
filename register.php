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
	
	$firstName = $surname = $username = $password = $dob = $email = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$firstName = $_POST["firstName"];
		$surname = $_POST["surname"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$email = $_POST["email"];
	}
	$addToDB = 1;
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if ($addToDB) {
			/*$hashedPassword = password_hash($password, PASSWORD_DEFAULT);*/
			$addData = "INSERT INTO `users` (`Username`,`Password`,`Email_Adress`,`First_Name`,`Surname`,`Points`,`Total_Points`)
									VALUES ('$username','$password','$email','$firstName','$surname','100','100')";
			if (mysqli_query($conn, $addData)){	
        echo "Succesfully registered! Click <a href='login.php'>here</a> to login";			
			} 
			else{
		    echo "FAIL";
	    }
		}
	}
?>
