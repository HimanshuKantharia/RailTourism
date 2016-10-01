<?php
require 'phpfiles/classes.php';
	if(!empty($_GET['uid']) && !empty($_GET['code']))
	{
		
		if(isset($_COOKIE[$_GET['uid']])) {
		   
		     $cookiCode = $_COOKIE[$_GET['uid']];
		     if($cookiCode == $_GET['code']){
		     	$conn = new connect();
		     	$query = 'UPDATE users SET isActive = "Y" where userId="' .$_GET['uid'].'"';
		     	$result = $conn->exeQuery($query);
		     	if($result){
		     		echo "Activation successful . Now you Can LogIn.;)";
		     		
		     		setcookie($_GET['uid'],"",time()-3600,"/");
		     	}
		     	else
		     		echo "error in db query";
		     }
		     else 
		     	echo "cooki value and code are not same";

		}
		else
			echo "cookie has been disabled"; 
		   
	}
	else
		header("location:login.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>confirm page</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

</head>
<body>

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle = "collapse" data-target="#nvbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="../rail/">RAILWAY</a>
    </div>
    <div class="collapse navbar-collapse" id="nvbar">
      <ul class="nav navbar-nav">
        <li><a href="../rail/">Home</a></li>
        <li><a href="#">News</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="tbwsta.php">B/W station</a></li>
        <li><a href="troute.php">Train route</a></li>

      </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
        <li><a href="../rail/"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>
      </ul>   
    </div>
  </div>
</nav>


<a href="login.php">loginpage</a>


<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>