<?php



?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<base href="../rail/">  
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
<div class="container-fluid"  >
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
           echo '<div class="row">';
          echo "<div class='col-lg-4 col-md-4 '>";
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
             echo '  <div class="col-lg-8 col-md-8"  id="avail">';
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
          echo "<div class='col-lg-2 col-md-2' >";
          $flag = 5-$flag;
         
          echo '<b>'.$pt_jdate.'</b>';
          echo '<br>';
          echo 'train no : '.$pt_no;
          echo '<br>';
          echo  'seats available:<b>'.$flag.'</b>';
         // echo '</td>';
          
          if($flag > 0)
          {


           echo "<form name='frm2' action='booktkt.php' target ='_parent' method='post'> ";
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
           
            echo "<button type='submit' class='btn btn-sm btn-info '>Buy</button>"; 
            
             echo "</form>";


          }

          echo "</div>";
          $pda = $pda+1;
            $i++;
          } // end of while
         // echo "</tr></table>";

          echo '</div>';
          echo '</div>';  // row end

       
        }

   ?>

</div>


<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</body>
</html>