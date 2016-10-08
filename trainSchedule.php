<!DOCTYPE html>
<html>
<head>
    <title>RailWays</title>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">

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
        <li><a href="login.php"><span class="glyphicon glyphicon-arrow-left"></span> Login</a></li>
        <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      </ul>   
    </div>
  </div>
</nav>

<!-- Details --> 
<div class="container">
    <ul class="nav nav-pills nav-justified" style="width: 100%;"> 
        <li><a data-toggle="pill" href="#menu1">Train Between Stations</a></li>
        <li class="active"><a data-toggle="pill" href="#menu2">Train Schedule</a></li>
        <li><a data-toggle="pill" href="#menu3">Live Train Status</a></li>
        <li><a data-toggle="pill" href="#menu4">Live Station</a></li>
    </ul>
    <div id="tab">
    <div class="tab-content">
        <div id="menu1" class="tab-pane fade">

            <form class="form-inline" method="post" action="index.php">
                <input type="text" class="form-control" name="sources" placeholder="Source Station" role="textbox" >

                <input type="text" class="form-control" name="dests" placeholder="Destination Station" role="textbox" >

                <input type="date" class="form-control" name="jdate" placeholder="DD-MM-YYYY" >

                <button type="submit" class="btn btn-info" >Get Trains</button>
            </form>
        </div>
        
        <div id="menu2" class="tab-pane fade in active">
            <form class="form-inline" method="post" action="trainSchedule.php">
                <input type="text" class="form-control" name="tnos" placeholder="Train Number" role="textbox" 
                value="<?php if(isset($_POST['tnos'])) echo $_POST['tnos']; ?>">

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
                <input type="text" class="form-control " name="sname" placeholder="Station" role="textbox" 
                value="<?php if(isset($_POST['sname'])) echo $_POST['sname']; ?>">

                <select name="times" class="form-control">
                    <option value="2" selected>2 Hours</option>
                    <option  value="4">4 Hours</option>
                </select>

                
                <button type="submit" class="btn btn-info" >Get Station Status</button>
            </form>


        </div>
    </div>
    </div>

    <div class="display">
    
        <?php
            $tno = $_POST['tnos'];
            echo $tno;

            if (!empty($tno)) {
                $url = "http://api.railwayapi.com/route/train/" . $tno . "/apikey/xmluw9445/";
                $jsondata = file_get_contents($url);
                $data = json_decode($jsondata);

                echo $data->response_code;

                foreach ($data->route as $route) {
                    echo '&nbsp;&nbsp;&nbsp;' . $route->no;
                    echo '&nbsp;&nbsp;&nbsp;' . $route->fullname;
                    echo '&nbsp;&nbsp;&nbsp;' . $route->scharr;
                    echo '&nbsp;&nbsp;&nbsp;' . $route->schdep;
                    echo '<br>';
                }
            }
        ?>
    </div>
</div>
<!--    <script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
    <script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>