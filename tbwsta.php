<!DOCTYPE html>
<html>
<head>
  <title>user page</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

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
        <li><a href="tbwsta.php">B/W station</a></li>
        <li><a href="troute.php">Train route</a></li>
        
      </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
        <li><a href="../rail/"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
       
      </ul>   
    </div>
  </div>
</nav>





<?php
require 'phpfiles/classes.php';
/*
session_start();
if(empty($_SESSION['userId'])){
  header("location:login.php");
  //echo $_SESSION['userId'];

$conn = new connect();
$que = "select * from users where userId = '" . $_SESSION["userId"]. "'";
$result = $conn->exeQuery($que);
$row = $result->fetch_assoc();

//echo "isActive ====  ".$row['isActive'];

}
*/
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
      <form name="srctodes" action="#" method="post">
        src code:
        <input class= "form-control" placeholder="src code" type="text" name="sname" required >
        dst code:
        <input class= "form-control" placeholder="des code" type="text" name="dname" required >
        journey date:
        
        <input class= "form-control" type="date" name="jdate" id="datefield" onfocus="" required>
        <button class="btn btn-primary" type="submit">check</button>
      </form>
    </div>
    <!-- 1st col over  -->
    <!-- 2nd col for result -->

    <div class="col-lg-10 col-md-10 col-sm-10">
    <iframe  name="myf" src="blank.php"   width="100%" frameborder="0" sandbox="allow-same-origin allow-scripts   allow-top-navigation allow-forms">
    
     
    </iframe>
   
   <?php 
/*
   error_reporting(0);
    if(!empty($_POST['t_class'] ) && !empty($_POST['t_name']) && !empty($_POST['t_arrtime'])  && !empty($_POST['t_from']) && !empty($_POST['t_to']) && !empty($_POST['t_deptime']) && !empty($_POST['t_jdate']) && !empty($_POST['t_no']))
{

        $pt_no = $_POST['t_no'];
        $pt_jdate = $_POST['t_jdate'];
        $pt_name = $_POST['t_name'];
        $pt_class = $_POST['t_class'];
        $pt_from = $_POST['t_from'];
        $pt_to = $_POST['t_to'];
        $pt_deptime = $_POST['t_deptime'];
        $pt_arrtime = $_POST['t_arrtime'];
              
          echo "<div class='col-lg-5'>";
          echo '<table class="table table-responsive table-bordered"><tr><b>Train detail</b></tr>';
          echo '<tr><th>class</th><td>'.$pt_class.'</td>';
          echo '<th>train name</th><td>'.$pt_name.'</td></tr>';
          echo '<tr><th>trainno</th><td>'.$pt_no.'</td>';
          echo '<th>Journey date</th><td>'.$pt_jdate.'</td></tr></table>';
          echo "</div>";
          //echo $pt_class;
          //echo $pt_no;
          //echo '2016-'.$pt_jdate;
          $pyr = substr($pt_jdate,0,4);
          $pmo = substr($pt_jdate,5,2);
          $pda = substr($pt_jdate,8,2);

          //$pda = $pda+1;
         // echo "increment date".$pda;
            $i = 1;
             echo '  <div class="col-lg-7"  id="avail">';
            // echo '<table><tr>';


          while ( $i<= 4) {
            
            $pt_jdate = $pyr.'-'.$pmo.'-'.$pda;


          $conn = new connect();
          $flag = 0;
        $check = 'select * from book where t_class="'.$pt_class.'" and t_no = "'.$pt_no.'" and t_jdate="'.$pt_jdate.'"';
        $result = $conn->exeQuery($check);

    while ($row = $result->fetch_assoc()) {
      ++$flag;
    } 
          //echo '<td>';
          echo "<div class='col-lg-3 col-md-3'>";
          $flag = 5-$flag;
         
          echo 'date:'.$pt_jdate;
          echo '<br>';
          echo 'train no : '.$pt_no;
          echo '<br>';
          echo  'seats available:'.$flag;
         // echo '</td>';
          
          if($flag > 0)
          {


           echo "<form name='frm2' action='booktkt.php' method='post'> ";
            echo "<input type ='hidden' name='t_no' value='".$pt_no. "' required>";
            echo "<input type ='hidden' name='t_jdate' value='".$pt_jdate. "' required>";
            echo "<input type ='hidden' name='t_name' value='".$pt_name. "' required>";
            echo "<input type ='hidden' name='t_from' value='".$pt_to. "' required>";
            //echo "<input type ='hidden' name='t_from_code' value='".$trainno->from->code. "' required>";
            echo "<input type ='hidden' name='t_deptime' value='".$pt_deptime. "' required>";
            echo "<input type ='hidden' name='t_to' value='".$pt_to. "' required>";
            //echo "<input type ='hidden' name='t_to_code' value=" " required>";
            echo "<input type ='hidden' name='t_arrtime' value='".$pt_arrtime. "' required>";
            echo "<input type ='hidden' name='t_class' value='".$pt_class. "' required>";
           
            echo "<button type='submit' class='btn btn-xs btn-default btn-xs'>Buy</button>"; 
            
             echo "</form>";


          }

          echo "</div>";
          $pda = $pda+1;
            $i++;
          } // end of while
         // echo "</tr></table>";

          echo '</div>';


       
        }
*/
   ?>


  



<!--
    <table class="table table-responsive">
    <thead>
      <th>No</th>
      <th>Train number</th>
      <th>Train name</th>
      <th>Source</th>
      <th>Departure</th>
      <th>destination</th>
      <th>arrival</th>
      <th>
      <table class="table table-bordered table-responsive">
        <thead>days</thead>
        <tbody>
          <tr >
            <td>M</td><td>T</td><td>W</td><td>T</td><td>F</td><td>S</td><td>S</td>
          </tr>
        </tbody>
      </table>
      </th>
      <th>class</th>
    </thead>  -->
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
        $dname = $_POST['dname'];
        $jdate = $_POST['jdate'];
        //$jdate = substr($jdate,5);
          $apmo = substr($jdate,5,2);
          $apda = substr($jdate,8,2);
          $apdate = $apda."-".$apmo;

      }

      if (!empty($sname) && !empty($dname) && !empty($apdate) ) {
      
       //$url = "http://api.railwayapi.com/between/source/" . $sname . "/dest/" . $dname . "/date/" . $apdate . "/apikey/ehuty1836/";
        $url = "http://api.railwayapi.com/between/source/" . $sname . "/dest/" . $dname . "/date/" . $apdate . "/apikey/xmluw9445/";
        //$url = "http://api.railwayapi.com/between/source/" . $sname . "/dest/" . $dname . "/date/" . $apdate . "/apikey/wgfe12838/";


      $jsondata = file_get_contents($url);
      $data = json_decode($jsondata);
      if($data->train){
           echo '<div class="table-responsive"><table class="table table-responsive table-bordered table-condensed">';

    echo '<thead>
      <th>No</th>
      <th>Train number</th>
      <th>Train name</th>
      <th>Source</th>
      <th>Departure</th>
      <th>destination</th>
      <th>arrival</th>
      <th>
      <table class="table table-bordered table-responsive table-condensed ">
        
        <tbody>
          <tr >
            <td>M</td><td>T</td><td>W</td><td>T</td><td>F</td><td>S</td><td>S</td>
          </tr>
        </tbody>
      </table>
      </th>
      <th>class</th>
    </thead>';
      }
      
      foreach ($data->train as $trainno) {
        echo "<tr><td>";
        echo $trainno->no;
        echo "</td><td>";
        echo $trainno->number;
        echo "</td><td>";

        echo  '<a target="_blank" href="troute.php?tname_ro='.$trainno->number.  '">'.$trainno->name.'</a>';
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
        echo  "<table class='table table-bordered table-responsive table-condensed ' ><tr >";
        foreach ($trainno->days as $tdays) {
          echo "<td>".$tdays->runs."</td>";
        }
        echo "</tr></table>";

        echo "</td><td>";
        //echo  "<table class='table table-responsive' ><tr >";
        $chr = 'class-code';
        foreach ($trainno->classes as $tclass) {
            echo "<div class='btn-group btn-group-xs' role='group'>";
            
            echo "<form name='bookfrm' onsubmit='return checkAvail()' action='blank.php' target='myf' method='post'> ";
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

    }
      ?>
      </table></div>
    </div> 

  </div>
</div>















<!--  <script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
  <script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>


