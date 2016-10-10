<!DOCTYPE html>
<html>
<head>
	<title>user page</title>

 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <style>
  ul.hint{
    background-color: #eee;
    cursor: pointer;
  
  }
  ul.hint li{
    padding: 12px;
  }

  .showSlist{
    /*height: 100px;*/
    overflow: hidden;
  }

</style>


<script type="text/javascript">
 
    function mdate()
    {
      var today = new Date();
 //var today;
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd;
    } 
    if(mm<10){
        mm='0'+mm;
    } 

today = yyyy+'-'+mm+'-'+dd;

//alert(today);
var att = document.createAttribute("min");
                att.value = today;
                
                  document.getElementById("datefield").setAttributeNode(att);
//document.getElementById("datefield").setAttribute("min", today);
     
    }



   function checkAvail(){
        var mt_no =document.forms['bookfrm']['t_no'].value;
        var mt_jdate = document.forms['bookfrm']['t_jdate'].value;
        var mt_class = document.forms['bookfrm']['t_class'].value;
       // $('#myModal').modal('hide');
        //alert("mt_jdate");
         alert(mt_class);

        
        //return false;
      }
   

  $(document).ready(function(){
    $('#srcst').keyup(function(){
      var query = $(this).val();
      if(query != '')
      {
        $.ajax({
          url:"../sthint.php",
          method:"POST",
          data:{query:query},
          success:function(data)
          {
            $('#txtHint').fadeIn();
            $('#txtHint').html(data);
          }
        });
      }
    }); 
    $('#txtHint').on('click','li',function(){
      $('#srcst').val($(this).text());
      $('#txtHint').fadeOut();
    });

  });



  $(document).ready(function(){
    $('#dstst').keyup(function(){
      var query1 = $(this).val();
      if(query1 != '')
      {
        $.ajax({
          url:"../sthint.php",
          method:"POST",
          data:{query:query1},
          success:function(data)
          {
            $('#desHint').fadeIn();
            $('#desHint').html(data);
          }
        });
      }
    }); 
    $('#desHint').on('click','li',function(){
      $('#dstst').val($(this).text());
      $('#desHint').fadeOut();
    });

  });





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
        <li><a href="cancel.php">Your Tickets</a></li>

      </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
        <li><a href="../../rail/"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> logout</a></li>
      </ul>   
    </div>
  </div>
</nav>





<?php
require '../phpfiles/classes.php';

session_start();
if(empty($_SESSION['userId'])){
  header("location:../login.php");
	//echo $_SESSION['userId'];
/*
$conn = new connect();
$que = "select * from users where userId = '" . $_SESSION["userId"]. "'";
$result = $conn->exeQuery($que);
$row = $result->fetch_assoc();

//echo "isActive ====  ".$row['isActive'];
*/
}
?>


<?php
/*
if(!isset($_COOKIE[$_SESSION['userId']])) {
    echo "Cookie named '" . $_SESSION['userId'] . "' is not set!";
} else {
    echo "Cookie '" . $_SESSION['userId'] . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$_SESSION['userId']];
}*/
?>

<?php

//session_start();
if(!empty($_SESSION['noseat']))
{
  echo "<h2>".$_SESSION['noseat']."</h2>"; 
  $_SESSION['noseat'] = '';
}
$_SESSION['noseat'] = '';
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2  col-md-2  col-sm-2">
      <form name="srctodes" action="index.php" method="post">
        src code:
        <input class= "form-control" placeholder="src code" type="text" name="sname" id="srcst" autocomplete="off" autofocus required >
        <div  class="showSlist" id="txtHint"></div>
        dst code:
        <input class= "form-control" placeholder="des code" type="text" name="dname" id="dstst" autocomplete="off" required >
        <div class="showSlist" id="desHint"></div>
        journey date:
        <input class= "form-control" type="date" name="jdate" id="datefield" onfocus="" required>
        <button class="btn btn-primary" type="submit">check</button>
      </form>
    </div>
    <!-- 1st col over  -->
    <!-- 2nd col for result -->

    <div class="col-lg-10 col-md-10 col-sm-10">
    <iframe  name="myf" src="../blank.php"   width="100%" frameborder="0" sandbox="allow-same-origin allow-scripts   allow-top-navigation allow-forms">
    <p>dlfjgfgigfig</p>
     
    </iframe>
   
   <?php 

  // error_reporting(0);

   ?>

      <?php

      if(!empty($_POST['t_jdate']) && $_POST['t_from'] && $_POST['t_to'])
      {
        $sname = $_POST['t_from_code'];
        $dname   = $_POST['t_to_code'];
        $jdate = $_POST['t_jdate'];
        $apmo = substr($jdate,5,2);
          $apda = substr($jdate,8,2);
          $apdate = $apda."-".$apmo;


        
      }

      if(!empty($_POST['sname']) && !empty($_POST['dname'])  && !empty($_POST['jdate']))
      {
        $sname = $_POST['sname'];
        $a = explode('-',$sname);
        $sname = $a[1];

        $dname = $_POST['dname'];
        $be = explode('-',$dname);
        $dname=$be[1];

        $jdate = $_POST['jdate'];
        //$jdate = substr($jdate,5);
          $apmo = substr($jdate,5,2);
          $apda = substr($jdate,8,2);
          $apdate = $apda."-".$apmo;

      }

      if (!empty($sname) && !empty($dname) && !empty($apdate) ) {
      
      $url = "http://api.railwayapi.com/between/source/" . $sname . "/dest/" . $dname . "/date/" . $apdate . "/apikey/ehuty1836/";
      
        //$url = "http://api.railwayapi.com/between/source/" . $sname . "/dest/" . $dname . "/date/" . $apdate . "/apikey/xmluw9445/";
        //$url = "http://api.railwayapi.com/between/source/" . $sname . "/dest/" . $dname . "/date/" . $apdate . "/apikey/wgfe12838/";


      $jsondata = file_get_contents($url);
      $data = json_decode($jsondata);
      if($data->train){
           echo '<div class="table-responsive"><table class="table">';

    echo '<thead>
      <th>No</th>
      <th>Train number</th>
      <th>Train name</th>
      <th>Source</th>
      <th>Departure</th>
      <th>destination</th>
      <th>arrival</th>
      <th>
      <table class="table table-bordered table-responsive">
        
        <tbody>
          <tr >
            <td>M</td><td>T</td><td>W</td><td>T</td><td>F</td><td>S</td><td>S</td>
          </tr>
        </tbody>
      </table>
      </th>
      <th>class</th>
    </thead>';
      
      
      foreach ($data->train as $trainno) {
        echo "<tr><td>";
        echo $trainno->no;
        echo "</td><td>";
        echo $trainno->number;
        echo "</td><td>";

        echo  '<a target="_blank" href="../troute.php?tname_ro='.$trainno->number.  '">'.$trainno->name.'</a>';
        echo "</td><td>";
       // echo "&nbsp; &nbsp; &nbsp; &nbsp;";
        echo $trainno->from->name;
        echo "</td><td>";
        //echo "&nbsp; &nbsp; &nbsp; &nbsp;";
        echo $trainno->src_departure_time;
        echo "</td><td>";
        //echo "&nbsp; &nbsp; &nbsp; &nbsp;";
        echo $trainno->to->name;
        echo "</td><td>";
        echo $trainno->dest_arrival_time;
        echo "</td><td>";
        echo  "<table class='table table-bordered table-responsive' ><tr >";
        foreach ($trainno->days as $tdays) {
          echo "<td>".$tdays->runs."</td>";
        }
        echo "</tr></table>";

        echo "</td><td>";
        //echo  "<table class='table table-responsive' ><tr >";
        $chr = 'class-code';
        foreach ($trainno->classes as $tclass) {
            echo "<div class='btn-group btn-group-xs' role='group'>";
            
            echo "<form name='bookfrm' onsubmit='return checkAvail()' action='../blank.php' target='myf' method='post'> ";
            echo "<input type ='hidden' name='t_no' value='".$trainno->number. "' >";
            echo "<input type ='hidden' name='t_jdate' value='".$jdate. "' >";
            echo "<input type ='hidden' name='t_name' value='".$trainno->name. "' >";
            echo "<input type ='hidden' name='t_from' value='".$trainno->from->name. "' >";
            echo "<input type ='hidden' name='t_from_code' value='".$trainno->from->code. "' >";
            echo "<input type ='hidden' name='t_deptime' value='".$trainno->src_departure_time. "' >";
            echo "<input type ='hidden' name='t_to' value='".$trainno->to->name. "' >";
            echo "<input type ='hidden' name='t_to_code' value='".$trainno->to->code. "' >";
            echo "<input type ='hidden' name='t_arrtime' value='".$trainno->dest_arrival_time. "' >";
            echo "<input type ='hidden' name='t_class' value='".$tclass->$chr. "' >";
           
            if($tclass->available == "Y"  ){
          echo "<button type='submit' class='btn btn-default btn-xs'>".$tclass->$chr."</button>"; 
            }
             echo "</form>";    
            echo "</div>";
        }
       //     echo "</tr></table>";
        echo "</td></tr>";
        //echo "<br>";
      }

      echo "</table></div>";
      }
    }
      ?>
      
    </div> 

  </div>
</div>















<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="../js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>


