<!DOCTYPE html>
<html>
<head>
	<title>user page</title>

 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

<script type="text/javascript">

</script>
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
      <a class="navbar-brand" href="../../rail/">RAILWAY</a>
    </div>
    <div class="collapse navbar-collapse" id="nvbar">
      <ul class="nav navbar-nav">
        <li><a href="../../rail/">Home</a></li>
        <li><a href="#">News</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="../tbwsta.php">B/W station</a></li>
        <li><a href="../troute.php">Train route</a></li>

      </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
        <li><a href="../../rail/"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> logout</a></li>
      </ul>   
    </div>
  </div>
</nav>




<h2>
<?php
require '../phpfiles/classes.php';

session_start();
if(!empty($_SESSION['userId'])){
	echo $_SESSION['userId'];

$conn = new connect();
$que = "select * from users where userId = '" . $_SESSION["userId"]. "'";
$result = $conn->exeQuery($que);
$row = $result->fetch_assoc();

echo "isActive ====  ".$row['isActive'];

}





?>
</h2>
<a href="../logout.php"> logout</a>

<h3>cookie</h3>

<?php
if(!isset($_COOKIE[$_SESSION['userId']])) {
    echo "Cookie named '" . $_SESSION['userId'] . "' is not set!";
} else {
    echo "Cookie '" . $_SESSION['userId'] . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$_SESSION['userId']];
}
?>







<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="../js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>


