<!DOCTYPE html>
<html>
<head>
	<title>Payment Details</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript">
  function getUpto(){
    var mm = document.getElementById('vMM').value;
    var yy = document.getElementById('vYY').value;
    var up = mm.concat("/",yy);
    document.getElementById('vUpto').value = up;
    var name = document.getElementById('cname').value;
    name = name.toUpperCase();
    document.getElementById('cname').value = name;
  }
</script>

</head>
<body>


<?php

require 'phpfiles/classes.php';
session_start();
if(empty($_SESSION['userId'])){
  $message = " please login first and then try !";
  echo "<script type='text/javascript'>  var r =confirm('$message');
      if (r == true){  
        window.location='login.php';
        }else
    window.location='index.php';
   </script>";
  
}
else{
$userId = $_SESSION['userId'];


if(!empty($_POST['t_class'] ) && !empty($_POST['t_name']) && !empty($_POST['t_arrtime'])  && !empty($_POST['t_from']) && !empty($_POST['t_to']) && !empty($_POST['t_deptime']) && !empty($_POST['t_jdate']) && !empty($_POST['t_no']))
{

$t_no = $_POST['t_no'];
$t_jdate = $_POST['t_jdate'];
$t_name = $_POST['t_name'];
$t_class = $_POST['t_class'];
$t_from = $_POST['t_from'];
$t_to = $_POST['t_to'];
$t_deptime = $_POST['t_deptime'];
$t_arrtime = $_POST['t_arrtime'];
      
    $conn = new connect();
    $flag = 0;
    $check = 'select * from book where t_class="'.$t_class.'" and t_no = "'.$t_no.'" and t_jdate="'.$t_jdate.'"';
    
    if($result = $conn->exeQuery($check)){

    while ($row = $result->fetch_assoc()) {
      ++$flag;
    } 
  }
  if($flag>= 5)
  {
    session_start();
    $_SESSION['noseat'] = 'there is no seat for your Query';
    header("location:user/");
  }
  else{
  if(!empty($_POST['p_name']) &&  !empty($_POST['p_age']) &&  !empty($_POST['p_idcard']) &&  !empty($_POST['p_idno']) &&  !empty($_POST['p_gender']))
  {   
      $tFare = 200;
      $catCharge = 100;
      $servCharge = 50;
      $totalFare = $tFare+$catCharge+$servCharge;
      setcookie("t_no",$t_no,time()+(60*2),"/");
      setcookie("t_name",$t_no,time()+(60*2),"/");
      setcookie("t_class",$t_no,time()+(60*2),"/");
      setcookie("t_from",$t_no,time()+(60*2),"/");
      setcookie("t_to",$t_no,time()+(60*2),"/");
      setcookie("t_jdat",$t_no,time()+(60*2),"/");
      ////////
      setcookie("p_name",$_POST['p_name'],time()+(60*2),"/");
      setcookie("p_age",$_POST['p_age'],time()+(60*2),"/");
      setcookie("p_idno",$_POST['p_idno'],time()+(60*2),"/");
      setcookie("p_idcard",$_POST['p_idcard'],time()+(60*2),"/");
      setcookie("p_gender",$_POST['p_gender'],time()+(60*2),"/");
      ///////
      setcookie("tFare",$tFare,time()+(60*2),"/");
      setcookie("catCharge",$catCharge,time()+(60*2),"/");
      setcookie("servCharge",$servCharge,time()+(60*2),"/");
      setcookie("totalFare",$totalFare,time()+(60*2),"/");




    //$book = new book();
    //$bid = $book->insertTkt($userId,$t_no,$t_name,$t_class,$t_from,$t_to,$t_jdate);
    //$book->insertPdetail($_POST['p_name'],$_POST['p_age'],$_POST['p_idno'],$_POST['p_idcard'],$_POST['p_gender']);
    //$book->insertFare($tFare ,$catCharge,$servCharge,$totalFare);
    /*
    if($bid != 0){
      header("location:printTicket.php?bookid=".$bid);
    }
    //echo "your tickt is book happy journey";
    */
 

  






if(isset($_POST['num'])){
 /*
    echo $_POST['num'];
    echo "<br>".$_POST['cardSel'];
    echo "<br>".$_POST['vUpto'];

    echo "<br>".$_POST['cvvCode'];
    echo "<br>".$_POST['cardname'];
    */
}

?>
<div class="container">
<center class="text text-info"><h1>Payment method</h1></center>
<div class="col-lg-6 col-lg-offset-2 col-md-6 col-sm-6 form-group">
<form  onsubmit="getUpto()" action="" method="POST">
<input class="form-control" type="text" name="num" maxlength="16" pattern="[0-9]{16,16}" title="16-digit number" placeholder="16-digit card number" required>
<label for="sel1">Select list (select one):</label>
      <select class="form-control" name="cardSel" id="sel1" required>
        <option value="rupay">Rupay</option>
        <option value="master">Master Card</option>
        <option value="visa">Visa</option>
        <option value="mestro">Mestro</option>
      </select>
      <br>
<p>
<input class="form-control" type="number" name="vMM" id="vMM" maxlength="2"  max="12"  placeholder="MM" required>
/
<input class="form-control" type="number" name="vYY" id="vYY" maxlength="2" max="99"  placeholder="YY" required>
</p>
<input type="hidden" name="vUpto" id="vUpto"> 
<br>
<input class="form-control" type="text" name="cvvCode" maxlength="3" pattern="[0-9]{3,3}" title="3-digit number" placeholder="cvv code" required >
<input class="form-control" type="text" name="cardname" id="cname" placeholder="cardholder name" style="text-transform:uppercase" required>
<input type="hidden" name="userid">
<input type="hidden" name="amt" value="<?php echo $totalFare; ?>">

<button class="btn btn-info" name="payment" type="submit" >submit</button>  
</form>
</div>

  
</div>
<?php


  }
}


}




} // main else

?>


<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>