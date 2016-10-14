<!DOCTYPE html>
<html>
<head>
	<title>encryption using javascript</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/md5.js"></script>-->
	<script src="../cryptojs/rollups/md5.js"></script>

</head>

<body>
<?php
	if(isset($_POST['pass1'])){
		echo $_POST['pass1'];
	}
	else{
?>
<form  action="" method="POST">
<input type="password" name="pass1" id="ppass">
<button type="submit" onclick="myenc()">sub</button>
</form>
<script type="text/javascript">
	function myenc(){
		var mes = document.getElementById("ppass").value;
		var hash = CryptoJS.MD5(mes);
		//var hash = "pppoodododoodod";
		//document.getElementById('print').innerHTML = hash;
		document.getElementById("ppass").value= hash;
	}
</script>
<?php
}
?>

<p id="print"></p>


<script src="../js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</body>
</html>