<!DOCTYPE html>
<html style="height:100%">
<head>
	<title>RailWays</title>
		<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
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
        <li><a href="tbwsta.php">B/W station</a></li>
        <li><a href="troute.php">Train route</a></li>
      </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Login</a></li>
       
      </ul>   
    </div>
  </div>
</nav>

<div class="jumbotron">
  <div class="container">
 
  <h1> Railways </h1>
       
  </div>
</div>

<!-- Details --> 
<div class="container">
    <ul class="nav nav-pills nav-justified" style="width: 100%;"> 
        <li class="active"><a data-toggle="pill" href="#menu1">Train Between Stations</a></li>
        <li><a data-toggle="pill" href="#menu2">Train Schedule</a></li>
        <li><a data-toggle="pill" href="#menu3">Live Train Status</a></li>
        <li><a data-toggle="pill" href="#menu4">Live Station</a></li>
    </ul>
    <div id="tab">
    <div class="tab-content">
        <div id="menu1" class="tab-pane fade in active">

            <form class="form-inline" method="post" action="index.php">
                <input type="text" class="form-control" name="sources" placeholder="Source Station" role="textbox" 
                value="<?php if(isset($_POST['sources'])) echo $_POST['sources']; ?>">

                <input type="text" class="form-control" name="dests" placeholder="Destination Station" role="textbox" 
                value="<?php if(isset($_POST['dests'])) echo $_POST['dests']; ?>">

                <input type="date" class="form-control" name="jdate" placeholder="DD-MM-YYYY"  
                value="<?php if(isset($_POST['jdate'])) echo $_POST['jdate']; ?>">

                <button type="submit" class="btn btn-info" >Get Trains</button>
            </form>
        </div>
        
        <div id="menu2" class="tab-pane fade">
            <form class="form-inline" method="post" action="trainSchedule.php">
                <input type="text" class="form-control" name="tnos" placeholder="Train Number" role="textbox" >

                <button type="submit" class="btn btn-info" >Get Schedule</button>
            </form>

        </div>
        
        <div id="menu3" class="tab-pane fade">
            <form class="form-inline" method="post" action="trainStatus.php">
                <input type="text" class="form-control " name="tnost" placeholder="Train Number" role="textbox" >

                <input type="date" class="form-control" name="tdate" placeholder="DD-MM-YYYY"  >

                <button type="submit" class="btn btn-info" >Get Status</button>
            </form>

        </div>
        
        <div id="menu4" class="tab-pane fade">
            <form class="form-inline" method="post" action="stationStatus.php">
                <input type="text" class="form-control " name="sname" placeholder="Station" role="textbox" >

                <input type="text" class="form-control" name="sdate" placeholder="Time" role="textbox" >

                <button type="submit" class="btn btn-info" >Get Status</button>
            </form>

        </div>
    </div>
    </div>

    <div class="display">
    
    <?php
    if (isset($_POST['sources']) && isset($_POST['dests']) && isset($_POST['jdate'])) {


        $sources = $_POST['sources'];
        $dests = $_POST['dests'];
        $date = $_POST['jdate'];

        if (!empty($sources) && !empty($dests) && !empty($date)) {
            
            
        $a = explode('-',$date);
        $date = $a[2].'-'.$a[1];
        
        $url = "http://api.railwayapi.com/between/source/" . $sources . "/dest/" . $dests . "/date/" . $date . "/apikey/xmluw9445/";
        $jsondata = file_get_contents($url);
        $data = json_decode($jsondata);
        
        echo '<table class="table table-responsive">';
        echo '<thead>
        
        <th>No</th>
        <th>Train number</th>
        <th>Train name</th>
        <th>Source</th>
        <th>Departure</th>
        <th>destination</th>
        <th>arrival</th>
        <th>
            <table class="table table-bordered">
        
            <tbody>
                 <tr >
              <td>M</td><td>T</td><td>W</td><td>T</td><td>F</td><td>S</td><td>S</td>
            </tr>
            </tbody>
            </table>
      
        </th>
      
        </thead>';

                echo $data->response_code . '<br>';
                echo $data->total . '<br>';

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
            echo "<input type ='hidden' name='t_jdate' value='".$date. "' >";
            echo "<input type ='hidden' name='t_name' value='".$trainno->name. "' >";
            echo "<input type ='hidden' name='t_from' value='".$trainno->from->name. "' >";
            echo "<input type ='hidden' name='t_from_code' value='".$trainno->from->code. "' >";
            echo "<input type ='hidden' name='t_deptime' value='".$trainno->src_departure_time. "' >";
            echo "<input type ='hidden' name='t_to' value='".$trainno->to->name. "' >";
            echo "<input type ='hidden' name='t_to_code' value='".$trainno->to->code. "' >";
            echo "<input type ='hidden' name='t_arrtime' value='".$trainno->dest_arrival_time. "' >";
            
            echo "</form>";    
            echo "</div>";
        }
       //     echo "</tr></table>";
        echo "</td></tr>";
        //echo "<br>";
                }

        }
    }
?>


<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>