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

	$username = $password = $error = "";

	if(isset($_POST["submit"])){
		if (empty($_POST["username"]) || empty($_POST["password"])){
      $error = "Both fields are required.";
    }
    else {
    	$username = $_POST["username"];
			$password = $_POST["password"];
			
			echo $username;
			echo $password;

			$sql = "SELECT * FROM users WHERE Username='$username' and Password='$password'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
			$row_cnt = mysqli_num_rows($result);
			
			if ($row_cnt == 1){
				$_SESSION['username'] = $username;
				$_SESSION['email'] =$row['Email_Adress'];
				$_SESSION['firstName'] =$row['First_Name'];
				$_SESSION['surname'] =$row['Surname'];
				$_SESSION['dateOfBirth'] =$row['Date_Of_Birth'];
				$_SESSION['points'] =$row['Points'];
				$_SESSION['totalPoints'] =$row['Total_Points'];
        
        mysqli_free_result($result);
        mysqli_close($conn);
        
				header("Location: dashboard.php");
				
			}
			else {
				$error = "Incorrect username or password.";
				
			}
			if (!empty($error)) {
				echo $error;
			}
			
			mysqli_free_result($result);
      mysqli_close($conn);
    }
	}

?>


<!-- FlatFy Theme - Andrea Galanti /-->
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="spent">
    <meta name="author" content="">

    <title>spent - home</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- Custom Google Web Font -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
	
    <!-- Custom CSS-->
    <link href="css/general.css" rel="stylesheet">
	
	 <!-- Owl-Carousel -->
    <link href="css/custom.css" rel="stylesheet">
	<link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	
	<!-- Magnific Popup core CSS file -->
	<link rel="stylesheet" href="css/magnific-popup.css"> 
	
	<script src="js/modernizr-2.8.3.min.js"></script>  <!-- Modernizr /-->
	<!--[if IE 9]>
		<script src="js/PIE_IE9.js"></script>
	<![endif]-->
	<!--[if lt IE 9]>
		<script src="js/PIE_IE678.js"></script>
	<![endif]-->

	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
	<![endif]-->

</head>

<body id="home">

	<!-- Preloader -->
	<div id="preloader">
		<div id="status"></div>
	</div>
	
	<!-- NavBar-->
	<nav class="navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#home">spent</a>
			</div>

			<div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					
					<li class="menuItem"><a href="#useit">About</a></li>
					<li class="menuItem"><a href="#screen">Screenshot</a></li>
					<li class="menuItem"><a href="#register">Register</a></li>
				</ul>
			</div>
		   
		</div>
	</nav> 
  
  <!-- Register -->
  <div id="register" class="content-section-c ">
    <div class="container">
      <br>
      <br>
      <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
          <div class="mockup-content">
            <div class="morph-button wow pulse morph-button-inflow morph-button-inflow-1">
              <button type="button "><span>Login</span></button>
              <div class="morph-content">
                <div class="content-style-form content-style-form-4 ">
                  <h2 class="morph-clone">Login</h2>
                  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <p><label>Username</label><input type="text" name="username"/></p>
                    <p><label>Password</label><input type="password" name="password"/></p>
                    <input type="submit" name="submit" value="Login">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>	
      </div>
      <br>
      <br>
    </div>
  </div>


    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
	<script src="js/owl.carousel.js"></script>
	<script src="js/script.js"></script>
	<!-- StikyMenu -->
	<script src="js/stickUp.min.js"></script>
	<script type="text/javascript">
	  jQuery(function($) {
		$(document).ready( function() {
		  $('.navbar-inverse').stickUp();
		  
		});
	  });
	
	</script>
	<!-- Smoothscroll -->
	<script type="text/javascript" src="js/jquery.corner.js"></script> 
	<script src="js/wow.min.js"></script>
	<script>
	 new WOW().init();
	</script>
	<script src="js/classie.js"></script>
	<script src="js/uiMorphingButton_inflow.js"></script>
	<!-- Magnific Popup core JS file -->
	<script src="js/jquery.magnific-popup.js"></script> 
</body>

</html>
