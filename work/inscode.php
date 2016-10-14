<?php


?>



<!DOCTYPE html>
<html>
<head>
	<title>working page:trail and error</title>
<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
<?php

//if(!empty($_POST['cd'])){
//	$cd = $_POST['cd'];
	
	$host = "localhost";
		$userName = "root";
		$password = "Piyush666";
		$db = "railways";

		$conn = mysqli_connect($host,$userName,$password,$db) or die("unable to connect");
		if (!$conn) {
    		die('Could not connect: ' . mysqli_error($con));
		}
		/*
		$sql = 'insert into stcode (st) values ("'.$cd.'")';

		$result = $conn->query($sql);
		
		if($result){
			echo "yr data inserted";
		}else{
			echo "data not inserted";
		}*/
	
//}



$file ="stList1.txt";
$f1 = fopen($file,'r');
$fr = fread($f1,filesize($file));
$f_arr = explode("\n",$fr);
	for($i = 0 ; $i<count($f_arr);$i++)
	{
		$sql = 'insert into stcode (st) values ("'.$f_arr[$i].'")';
		$result = $conn->query($sql);
		if($result){
			echo $i.' :- '.$f_arr[$i];
		}else{
			echo $i.' :- '.$f_arr[$i]."is not inserted";
		}
		echo"<br>";
	}

fclose($f1);




?>
<!--
<form action="inscode.php" method="post">
st name-code: <input type="text" name="cd" required>
<button class="btn" type="submit">submit</button>
</form>
-->

<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="../js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</body>
</html>