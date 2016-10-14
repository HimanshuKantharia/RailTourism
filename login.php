<!DOCTYPE html>
<html>
<head>

 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>LogIN Page</title>
  
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script src="cryptojs/rollups/md5.js"></script>
<?php
  //call for classes &function
  
  require 'phpfiles/classes.php';

  //if user already logrdIn take back him to userPage;
  //if the user is already logged in, send him away
  
  
//for session
  session_start();
  if(!empty($_SESSION['userId']))
    header("location:user/");


  //if(!empty($_SESSION["admin"]))
   // header("location:../admin/");

if(!empty($_POST["emailID"]) && !empty($_POST["password"]))
{
  $users = new users();
  $users->login($_POST["emailID"],$_POST["password"]);
  
  if(!empty($_SESSION['userId']))
      header("location:user/");
    
}


//the php code for the signup of the user will come here.
  if(!empty($_POST['Newname']) && !empty($_POST['Newpassword']) && !empty($_POST['newEmail']) && !empty($_POST['fullName']) && !empty($_POST['newTel']))
  {
    echo " in there";
    $user = new users();
    $user->createUser($_POST['Newname'],$_POST['Newpassword'],$_POST['newEmail'],$_POST['fullName'],$_POST['newTel']);
  }
  



   
?>



<script language="javascript" type="text/javascript">
  function validate(){
    var uemail = document.forms["myform"]["emailID"].value;
    var password = document.forms["myform"]["password"].value;
    if(uemail == "" || password == ""){
      alert("both fields are required");
      return false;
    }
    else{
      var hash = CryptoJS.MD5(password);
           document.forms["myform"]["password"].value = hash;
    }

  }

   function validate2(){
    var username = document.forms["myformS"]["Newname"].value;
    var password = document.forms["myformS"]["Newpassword"].value;
    var repassword = document.forms["myformS"]["re-password"].value;
    if(username == "" || password == "" || repassword == "")
    {
     alert("Every fields are required");
     return false; 
    }
    if(password != repassword){
      //alert("Check the password and retry again!");
      
      document.getElementById('passError').innerHTML = "Dosn't match !";
      return false;
    }
    else
      document.getElementById('passError').innerHTML = "";


  //  return userCheck();

  }

<?php /*
  function  userCheck()
 {
     var userName = document.forms["myformS"]["Newname"].value;
      //var userName = document.getElementById('Newname').value;
   
    <?php
      
          $conn = new connect();
          $que = 'SELECT * from users';
          $result = $conn->exeQuery($que);
         


          while($row = $result->fetch_assoc()) {
   ?>  
               if(userName == "<?php echo $row['userName'];  ?>"){
             //   alert("user already there ,chose another name ");
                     document.getElementById('nameError').innerHTML = 'Username already exists, try another!';
                      return false;          

                 }
                 else
                  document.getElementById('nameError').innerHTML = '';

       <?php  } ?>   
  
}
*/
?>

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
        <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      </ul>   
    </div>
  </div>
</nav>






<div class="container" id="login" style="margin-top:5% ;padding:5% 25% 2% 25%;border: 0px solid " >
	<h3 class="text text-danger"><?php 
        if(!empty($_SESSION['noUser'])){
            echo $_SESSION['noUser'];
             
        }
   ?>
  </h3>
   <form class = "form-signin" name ="myform" onsubmit="return validate()" action="login.php" method="post">
     <h2 class="form-sign-heading">please Log in </h2>
     <label for="inuser" class="sr-only">EmailID</label>
     <input type="email" class="form-control" name="emailID" id="inuser" placeholder="Email" required autofocus><br>
     <label for="password" class="sr-only">Password</label>
     <input type="password" class="form-control" name="password" id="password" placeholder="Password" required ><br>

     <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Login">
     <br>
    
   </form>
   <p><a   style="text-decoration: none;"  href="signup.php">New here? Click here to signup</a></p>
   <a style="text-decoration: none;" href = "recovery.php">Forget password?</a>
   </div>
	



<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</body>
</html>

<?php  $_SESSION['noUser'] = ""; ?>