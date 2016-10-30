<?php
  session_start();

  if($_SESSION['username'] == ""){
    header("Location: index.php");
  }
  
  $_SESSION["overdraft"] = 0;
?>

<?php include("checkChallenge.php"); ?>

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

    <title>spent - dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar-fixed-side.css" rel="stylesheet" />
 
    <!-- Custom Google Web Font -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
	
    <!-- Custom CSS-->
    <link href="css/general.css" rel="stylesheet">
    <link href="css/mystyle.css" rel="stylesheet">
	
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
				<a class="navbar-brand" href="dashboard.php">spent</a>
			</div>

			<div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li class="menuItem"><a href="dashboard.php"><?php echo $_SESSION['username'] . "&nbsp;&nbsp;-&nbsp;&nbsp;" . $_SESSION['points'] . " SP"?></a></li>
				</ul>
			</div>
		   
		</div>
	</nav>
	
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-lg-2">
        <nav class="navbar navbar-inverse navbar-fixed-side">
        <!-- normal collapsible navbar markup -->
        <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
				  <ul class="nav navbar-nav">
				    <li class="menuItem"><a href="dashboard.php">DASHBOARD</a></li>
					  <li class="menuItem"><a href="challenges.php">CHALLENGES</a></li>
					  <li class="menuItem"><a href="shop.php">GET SPENDING</a></li>
					  <li class="menuItem"><a href="">ACHIEVEMENTS</a></li>
					  <li class="menuItem"><a href="leaderboard.php">LEADERBOARD</a></li>
					  <li class="menuItem"><a></a></li>
					  <li class="menuItem"><a href="">GO PREMIUM</a></li>
					  <li class="menuItem"><a href="refer.php">REFER A FRIEND</a></li>
					  <li class="menuItem"><a></a></li>
					  <li class="menuItem"><a href="logout.php">LOGOUT</a></li>
				  </ul>
			  </div>
        </nav>
      </div>
      <div class="col-sm-9 col-lg-10">
        <!-- your page content -->
        <!-- Use it -->
        <div id ="useit" class="content-section-d wow fadeInLeftBig">
            <h3 class="section-heading">DASHBOARD
              <?php 
                if($_SESSION["overdraft"] == 1){
                  echo "&nbsp;&nbsp;|&nbsp;&nbsp;<font color='red'>OVERDRAFT (x2 POINTS)!</font>";
                }
              ?>
            </h3>
            <div class="row">
              <div class="col-sm-6 wow fadeInLeftBig text-center"  data-animation-delay="200">
                <div class="points"><?php echo $_SESSION['points'] . " SP"?></div>
              </div>
              
              <div class="col-sm-6 wow fadeInLeftBig leftLineBlue"  data-animation-delay="200">
                RECENT MESSAGES:
                <br>
                -SALE AT NEXT ENDS IN 16 HOURS (x2 POINTS)<br>
                -LOTTERY ENDS IN 10 MINS<br>
                -YOU'RE AN IDIOT<br>
                -3 NEW CHALLENGES ADDED TODAY<br>
              </div> 
            </div>
        </div>
        
        <div id ="useit" class="content-section-e white wow fadeInLeftBig">
          <div class="row">
            <div class="col-sm-6 wow fadeInLeftBig"  data-animation-delay="200">
              SUGGESTED CHALLENGES:
              <br>
              - DO THIS<br>
              - DO THAT<br>
              - NO DO THIS<br>
              - SPEND YOUR MONEY FOOL
            </div>
            <div class="col-sm-6 wow fadeInLeftBig leftLineWhite"  data-animation-delay="200">
              SUGGESTED PURCHASES:
              <br>
              - I AM THE ONE<br>
              - DONT WEIGH A TON<br>
              - DONT NEED A GUN<br>
              - TO GET RESPECT UP ON THE STREET<br>
              - UNDER THE SUN<br>
              - THE BASTARD SUN<br>
              - SOMETHING SOMETHING FAMILY<br>
            </div>   
          </div>
        </div>
      </div>
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
		  $('.navbar-default').stickUp();
		  
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
