
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Signup Page</title>
  
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script src="cryptojs/rollups/md5.js"></script>

<script language="javascript" type="text/javascript">
  
function val2(){
  var p = passCheck() 
   if(p){
            
          var hash = CryptoJS.MD5(document.forms["myformS"]["Newpassword"].value);
           document.forms["myformS"]["Newpassword"].value = hash;

          return true;
      }else{
        alert("wrong pass");
        return false;
      }

}


  function passCheck()
  { 
    var password = document.forms["myformS"]["Newpassword"].value;
    var repassword = document.forms["myformS"]["re-password"].value;
    if(password != repassword){
     // alert("Check the password and retry again!");
      document.getElementById('passError').innerHTML = "Dosn't match !";
      return false;
    }
    else{
       <?php
           // echo "document.getElementById('passError').innerHTML = 'print me'";
      ?>

      document.getElementById('passError').innerHTML = "";    
      return true;
    }
 
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

      </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
        <li><a href="../rail/"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login in</a></li>
      </ul>   
    </div>
  </div>
</nav>


<?php
  //call for classes &function
  
  require 'phpfiles/classes.php';

  //if user already logrdIn take back him to userPage;
  //if the user is already logged in, send him away
  
  
//for session
  session_start();
  if(!empty($_SESSION['userName']))
    header("location:user/");

 // if(!empty($_SESSION["admin"]))
   // header("location:../admin/");

if(!empty($_POST["emailID"]) && !empty($_POST["password"]))
{
  //$login = new LOGIN();
  //$login->seprate($_POST["emailID"],$_POST["password"]);
  
  if(!empty($_SESSION['userName']))
      header("location:user/");

}



//the php code for the signup of the user will come here.
  if(!empty($_POST['Newname']) && !empty($_POST['Newpassword']) && !empty($_POST['newEmail']) && !empty($_POST['fullName']) && !empty($_POST['newTel']))
  {
    
    $user = new users();
        $user->createUser($_POST['Newname'],$_POST['Newpassword'],$_POST['newEmail'],$_POST['fullName'],$_POST['newTel']);
  }
  

   
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
      <form name="myformS" onsubmit="return val2()" action="signup.php" method="post">
        <h2 >sign up here </h2>
        <!-- 1st row -->  
        <div class="row">
          <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1">
            <label >Username:</label>     
          </div>
          <div class="col-lg-7 col-md-7">
            <input type="text" class="form-control" name="Newname" id="newuser" placeholder="Username" required autofocus >
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1">
            <label >Password:</label>     
          </div>
          <div class="col-lg-7 col-md-7">
            <input type="password" class="form-control" name="Newpassword" id="Newpassword" placeholder="Password" required ><br>
          </div>
        </div>

           <div class="row">
          <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1">
            <label >Confirm password:</label>     
          </div>
          <div class="col-lg-7 col-md-7">
              <input type="password" class="form-control" name="re-password" id="re-password" required placeholder="Re-Password" >
          </div>
        </div>
        <small><p class="text text-danger" id="passError"  ></p></small>
          <hr>
          <h2>Personal  details </h2>

          <div class="row">
          <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1">
            <label >Fullname:</label>     
          </div>
          <div class="col-lg-7 col-md-7">
            <input type="text" class="form-control" name="fullName" id="newfull" placeholder="YourName" onfocus="passCheck()" required  >
          </div>
        </div>  

        <div class="row">
          <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1">
            <label >email:</label>     
          </div>
          <div class="col-lg-7 col-md-7">
            <input type="email" class="form-control" name="newEmail" id="newemail" placeholder="YourEmail id" required  >
          </div>
        </div>  
          <div class="row">
          <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1">
            <label >Contact number:</label>     
          </div>
          <div class="col-lg-7 col-md-7">
            <input type="text" maxlength="10" pattern="[0-9]{10,10}" title="10 digit number" class="form-control" name="newTel" id="newtel" placeholder="Your mobile " required  >
          </div>
        </div>
        <br>
        <div class="col-lg-3 col-lg-offset-5">

              <input class="btn btn-lg btn-primary" type="submit" name="submit" value="SignUp Now" >    
        </div>



      
     <br>


      </form>


    </div>
  </div>

</div>





<!--  <script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
  <script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</body>
</html>