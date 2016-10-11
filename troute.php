<!DOCTYPE html>
<html style="height:100%">
<head>
  <title>RailWays</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

</head>
<body>

<nav class="navbar navbar-default " role="navigation">
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

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1 col-sm-6 col-sm-offset-1">
      <form name="frmrot" action="troute.php" method="get">
        <div class="col-lg-2 ">Train no:</div>
        <div class="col-lg-3  ">
        <input class= "form-control" placeholder="Train number" type="text" name="tname_ro" required ></div>
        <div class="col-lg-1">
        <button class="btn btn-primary" type="submit">check</button>
        </div>
      </form>
    </div>
    <!-- 1st col over  -->
    <!-- 2nd col for result -->
    </div>
<br>
    <div class="row" style="margin-left:2px;">
        <?php

        if(!empty($_GET['tname_ro'])){
          $tno = $_GET['tname_ro'];

          //$url =  'http://api.railwayapi.com/route/train/'.$tno.'/apikey/xmluw9445/';
          $url =  'http://api.railwayapi.com/route/train/'.$tno.'/apikey/ehuty1836/';         
         $jsondata = file_get_contents($url);
         $data = json_decode($jsondata);
         if($data->route)
         {
          echo "<div class='table-responsive'>
    <table class='table table-striped table-condensed'>
    <thead>
      <th>no</th>
      <th>distance(km)</th>
      <th>day</th>
      <th>route</th>
      <th>st-name</th>
      <th>lag</th>
      <th>lng</th>
      <th>state</th>
      <th>arr time</th>
      <th>dep time</th>
    </thead>";
         

         foreach ($data->route as $trouteno ) {
          echo "<tr><td>";
          echo $trouteno->no;
          echo "</td><td>";
          echo $trouteno->distance;
          echo "</td><td>";
          echo $trouteno->day;
          echo "</td><td>";
          echo $trouteno->route;
          echo "</td><td>";
          echo $trouteno->fullname;
          echo "</td><td>";
          echo $trouteno->lat;
          echo "</td><td>";
          echo $trouteno->lng;
          echo "</td><td>";
          echo $trouteno->state;
          echo "</td><td>";
          echo $trouteno->scharr;
          echo "</td><td>";
          echo $trouteno->schdep;
          echo "</td></tr>";
         }

          /*
      
      "no": 1,
            "distance": 0,
            "day": 1,
            "halt": 0,
            "route": 1,
            "code": "CDG",
            "fullname": "CHANDIGARH",
            "lat": 30.7333148,
            "lng": 76.7794179,
            "state": "Chandigarh",
            "scharr": "Source",
            "schdep": "12:00"



          */

        }
        
      echo '</table>
      </div>';


    }
    ?>
    </div> 

  
</div>


<!--  <script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
  <script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>