<!DOCTYPE html>
<html>
<head>

 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Password recovery</title>
  
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

<script type="text/javascript">
		function passCheck()
  { 
    var password = document.forms["passForm"]["new_pass"].value;
    var repassword = document.forms["passForm"]["new_retype"].value;
    if(password != repassword){
      //alert("Check the password and retry again!");
      
      document.getElementById('passError').innerHTML = "Dosn't match !";
      return false;
    }
    else
      document.getElementById('passError').innerHTML = "";    
 
  }






		function validateEmail(){
			//var recEmail = document.forms["recover"]["recEmail"].value;
			return true;
		}
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
      <a class="navbar-brand" href="../rail/">RAILWAY</a>
    </div>
    <div class="collapse navbar-collapse" id="nvbar">
      <ul class="nav navbar-nav">
        <li><a href="../rail/">Home</a></li>
        <li><a href="#">News</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">About Us</a></li>
      </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
        <li><a href="../rail/"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
        
      </ul>   
    </div>
  </div>
</nav>


<div class= "container">
<?php
  require 'phpfiles/classes.php'; 


  if(!empty($_POST['new_pass']) && !empty($_POST['new_retype']) && !empty($_POST['email1']) )
  {		
  		if($_POST['new_pass'] == $_POST['new_retype'])
  		{
  		$conn1 = new connect();
  		$query = 'UPDATE users SET password ="' .$_POST['new_pass']. '" WHERE email="' .$_POST['email1']. '"';
  		if($conn1->exeQuery($query))
  		{
  			echo "<h2>Your password has been successfully changed!!!</h2>";
  		} 
  		else
  			echo "<h3>your pass can't be changed</h3>";
  	}
  	else
  		echo "<h3>password does not match</h3>";
  }

if(!empty($_POST['verff']) && !empty($_POST['originff']) && !empty($_POST['emailChange']) )
{
	if($_POST['verff'] ==  $_POST['originff'])
	{	
		?>
		<div class="container" style="margin-top:5% ;padding:5% 25% 2% 25%;border: 0px solid "  >
		<h2>Chnage your password</h2>
		<form name="passForm" onsubmit="return passCheck()" action="recovery.php" method="post">
		<label>New password :</label>
		<input type="password" placeholder="New password" class="form-control" name="new_pass">
		<label>Confirm password</label>
		<input type="password" class="form-control" placeholder="Confirm password" name="new_retype">
		<input type="hidden" name="email1" value="<?php echo $_POST['emailChange']; ?>" >
		<button type="submit" class="btn btn-primary" onfocus = "passCheck()">change</button>
		</form>
		<p id="passError"></p>
		</div>


		<?php
		
	}
	else
	{
		echo "<h2>your code is wrong to generate another OTP clink link below!<br></h2>"; 
		echo "<a style='text-decoration:none;' href='recovery.php'>reload page</a>";
	}
}



if(!empty($_POST['recEmail']))
{
	$conn = new connect();
	$que = 'select * from users where email = "'.$_POST['recEmail'].'"';
	$result = $conn->exeQuery($que);
	if($row = $result->fetch_assoc())
	{
		$code = rand(1234,9876);

		$to = $row['email'];
		$subject = "RCOVERY OF PASSWORD";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$message = "Dear ".$row['fullname']." please write this one time code ".$code." to site and recover your password";
		// More headers
		$headers .= 'From: <webmaster@railways.com>' . "\r\n";
		$headers .= 'Cc: rs@railways.com' . "\r\n";

		if(mail($to,$subject,$message,$headers))
		{
		echo "<h3>mail hasbeen send to ".$to." check it now.</h3>";

?>		<div class="container" style="margin-top:5% ;padding:5% 25% 2% 25%;border: 0px solid "  >
		<form action="recovery.php" method="post">
		<input type="text" class="form-control" placeholder="Code" name="verff" required>
		<input type="hidden" name="originff"  value="<?php echo $code;  ?>" >
		<input type="hidden" name="emailChange" value ="<?php echo $to; ?>" >  
		<button class="btn btn-primary" type="submit">submit</button>
		</form>
		</div>
<?php	
		}
		else 
		{
			echo "<h3>mail failed </h3>";
			$code = rand(1234,9876);
		}


	}
	else 
		echo "<h3 class='text-danger'>this is not a valid email</h3>";
}

?>
</div>

	<div class="container" style="margin-top:5% ;padding:5% 25% 2% 25%;border: 0px solid "  >
		<h2>Enter your email </h2>
		<form name="recover" onsubmit="validateEmail()" action="" method="post">
			<input type="email" class="form-control" placeholder="verified Email" name="recEmail" required>
			<button class="btn btn-primary" type="submit">create Code</button>
		</form>		
	</div>


<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>