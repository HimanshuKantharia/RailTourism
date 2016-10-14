<!DOCTYPE html>
<html>
<head>
	<title>Cancellation</title>

 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

<script type="text/javascript">
      function cancelconfrim()
      {
        var r = confirm("Are you sure you want to cancel your reservation ! we will not ask you again and there is no refund");
        if(r == true)
          return true;
        else
          return false;
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
      <a class="navbar-brand" href="../../rail/">RAILWAY</a>
    </div>
    <div class="collapse navbar-collapse" id="nvbar">
      <ul class="nav navbar-nav">
        <li><a href="../../rail/">Home</a></li>
        <li><a href="#">News</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="../stationStatus.php">Station status</a></li>
        <li><a href="../trainSchedule.php">Train Schedule</a></li>
      </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
        <li><a href="../user/"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> logout</a></li>
      </ul>   
    </div>
  </div>
</nav>





<?php
require '../phpfiles/classes.php';

if(!empty($_POST['bookedId']))
{
  //$que = 'delete from bookdetail where bookid="'.$_POST['bookedId'].'"';
  $query ='delete from book where bookid ="'.$_POST['bookedId'].'"';
  $conn = new connect();
  //if($conn->exeQuery($que)){
    if($conn->exeQuery($query))
      echo "Your reservation is cancel";
 // }
  //else
   //   echo "not canceled";  
}


session_start();
if(empty($_SESSION['userId']))
{
  header("location:../../rail/");
}
?>
<div class ="container">
<h2>Your Tickets</h2>
<hr>
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 "></div>

  <?php

    //$book = new book();
    //$book->showMyTkt($_SESSION['userId']);
  $conn = new connect();
  $que = 'select * from book where userId="'.$_SESSION['userId'].'"';
  $result = $conn->exeQuery($que);
  if($result)
  {
    $r = $result->fetch_assoc();
    echo  '<div class="col-lg-12 col-md-12 col-sm-12 table-responsive"><table class="table">
  <thead>
    <th>bookID</th>
    <th>traino</th>
    <th>train name</th>
    <th>Journey date</th>
    <th>Class</th>
    <th>From</th>
    <th>To</th>
  </thead>
  <tbody>';

  
  $result = $conn->exeQuery($que);

  while ($row = $result->fetch_assoc()) {
    echo "<tr><td>";
    echo $row["bookid"];
    echo "</td><td>";
    echo $row["t_no"];
    echo "</td><td>";
    echo $row["t_name"];
    echo "</td><td>";
    echo $row["t_jdate"];
    echo "</td><td>";
    echo $row["t_class"];  
    echo "</td><td>";  
    echo  $row["t_from"];
    echo "</td><td>";
    echo $row["t_to"];
    echo "</td><td>";
    
    echo '<form name="cancelfrm" onsubmit="return cancelconfrim()" action="cancel.php" method="post">';
    echo '<input type="hidden" name="bookedId" value="'.$row['bookid'].'" required>';
    echo "<button type='submit' class='btn btn-danger'>cancel</button></form>";
    echo "</td><td>";
    echo "<a target='_blank' href='../printTicket.php?bookid=".$row['bookid']."'  >print Ticket </a>";
    echo "</td></tr>";
  }
  

  echo "</tbody></table></div>";

 } 

 ?> 
</div>




<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="../js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>


