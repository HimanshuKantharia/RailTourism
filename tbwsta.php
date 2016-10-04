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
    <div class="col-lg-2 col-lg-offset-1 col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-1">
      <form name="srctodes" action="tbwsta.php" method="post">
        src code:
        <input class= "form-control" placeholder="st code" type="text" name="sname" required >
        dst code:
        <input class= "form-control" placeholder="st code" type="text" name="dname" required >
        journey date:
        <input class= "form-control" placeholder="dd-mm" type="text" name="jdate" required>
        <button class="btn btn-primary" type="submit">check</button>
      </form>
    </div>
    <!-- 1st col over  -->
    <!-- 2nd col for result -->
    <div class="col-lg-9 col-md-9 col-sm-9">
    <table class="table table-responsive">

      <?php
      if(!empty($_POST['sname']) && !empty($_POST['dname'])  && !empty($_POST['jdate']))
      {
        $sname = $_POST['sname'];
        $dname = $_POST['dname'];
        $jdate = $_POST['jdate'];
      }

      if (!empty($sname) && !empty($dname)) {
  

      $url = "http://api.railwayapi.com/between/source/" . $sname . "/dest/" . $dname . "/date/" . $jdate . "/apikey/ehuty1836/";
      //  $url = "http://api.railwayapi.com/between/source/" . $sname . "/dest/" . $dname . "/date/" . $jdate . "/apikey/xmluw9445/";

      $jsondata = file_get_contents($url);
      $data = json_decode($jsondata);

      foreach ($data->train as $trainno) {
        echo "<tr><td>";
        echo $trainno->no;
        echo "</td><td>";
       // echo "&nbsp; &nbsp; &nbsp; &nbsp;";
    /*
        echo "<form action='center2.php' method='post'>";
        echo '<button type="submit" >' .$trainno->name . '</button>';
        echo "<input type='hidden' value='". $trainno->number . "' name = 'tno'>";
        echo "</form>";*/
        echo  '<a href="troute.php?tname_ro='.$trainno->number.  '">'.$trainno->name.'</a>';
        echo "</td><td>";
       // echo "&nbsp; &nbsp; &nbsp; &nbsp;";
        echo $trainno->number;
        echo "</td><td>";
        //echo "&nbsp; &nbsp; &nbsp; &nbsp;";
        echo $trainno->src_departure_time;
        echo "</td><td>";
        //echo "&nbsp; &nbsp; &nbsp; &nbsp;";
        echo $trainno->dest_arrival_time;
        echo "</td></tr>";
        //echo "<br>";
      }

    }
     
      ?>
      </table>
    </div> 

  </div>
</div>


<!--  <script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
  <script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>