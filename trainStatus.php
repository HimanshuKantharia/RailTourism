<!DOCTYPE html>
<html>
<head>
	<title>RailWays</title>
		<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
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
   /* height: 100px;
    */
    overflow: hidden;
  }

</style>

<script>
  
  $(document).ready(function(){
    $('#srcst').keyup(function(){
      var query = $(this).val();
      if(query != '')
      {
        $.ajax({
          url:"sthint.php",
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
          url:"sthint.php",
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





 $(document).ready(function(){
    $('#stationId').keyup(function(){
      var query1 = $(this).val();
      if(query1 != '')
      {
        $.ajax({
          url:"sthint.php",
          method:"POST",
          data:{query:query1},
          success:function(data)
          {
            $('#stHint1').fadeIn();
            $('#stHint1').html(data);
          }
        });
      }
    }); 
    $('#stHint1').on('click','li',function(){
      $('#stationId').val($(this).text());
      $('#stHint1').fadeOut();
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
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      </ul>   
    </div>
  </div>
</nav>

<!-- Details --> 
<div class="container">
    <ul class="nav nav-pills nav-justified" style="width: 100%;"> 
        <li><a data-toggle="pill" href="#menu1">Train Between Stations</a></li>
        <li><a data-toggle="pill" href="#menu2">Train Schedule</a></li>
        <li class="active"><a data-toggle="pill" href="#menu3">Live Train Status</a></li>
        <li><a data-toggle="pill" href="#menu4">Live Station</a></li>
    </ul>
    <div id="tab">
    <div class="tab-content">
         <div id="menu1" class="tab-pane fade">

            <form class="form-inline" method="post" action="index.php">
                <div class="col-lg-2 col-md-2">
                <div class="row">
                <input type="text" class="form-control" name="sname"   id="srcst" autocomplete="off" placeholder="Source Station" role="textbox" required 
                value="<?php if(isset($_POST['sname'])) echo $_POST['sname']; ?>">
                </div>
                <div class="row showSlist" id="txtHint"></div>
                </div>
                <div class="col-lg-2 col-md-2">
                <div class="row">
                <input type="text" class="form-control" name="dname" id="dstst" autocomplete="off" placeholder="Destination Station" role="textbox" required
                value="<?php if(isset($_POST['dname'])) echo $_POST['dname']; ?>">
                </div>
                 <div class="row showSlist" id="desHint"></div>
                 </div>   
                <input type="date" class="form-control" name="jdate" placeholder="DD-MM-YYYY"  required
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
        
        <div id="menu3" class="tab-pane fade  in active">
            <form class="form-inline" method="post" action="trainStatus.php">
                <input type="text" class="form-control " name="tnost" placeholder="Train Number" role="textbox" 
                value="<?php if(isset($_POST['tnost'])) echo $_POST['tnost']; ?>">

                <input type="date" class="form-control" name="tdate" placeholder="DD-MM-YYYY"  
                value="<?php if(isset($_POST['tdate'])) echo $_POST['tdate']; ?>">

                <button type="submit" class="btn btn-info" >Get Status</button>
            </form>

        </div>
        
            <div id="menu4" class="tab-pane fade ">
            <form class="form-inline" method="post" action="stationStatus.php">
                <div class="col-lg-2 col-md-2">
                <div class="row">
                <input type="text" class="form-control " id="stationId" name="stname" placeholder="Station" role="textbox" 
                value="<?php if(isset($_POST['stname'])) echo $_POST['stname']; ?>">
    
                </div>
                <div class="row showSlist" id="stHint1"></div>
                </div>

                
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
        if(isset($_POST['tnost']) && isset($_POST['tdate']) ){   
            $tno = $_POST['tnost'];
            $tdate = $_POST['tdate'];

            $a = explode('-',$tdate);
            $tdate = $a[0].$a[1].$a[2];
                        echo $tno;
            echo '<br>' . $tdate . '<br>';


        }
            

            if (!empty($tno) && !empty($tdate)) {
                
                http://api.railwayapi.com/live/train/<train number>/doj/<yyyymmdd>/apikey/<apikey>/
                $url = "http://api.railwayapi.com/live/train/" . $tno . "/doj/" . $tdate . "/apikey/xmluw9445/";
                $jsondata = file_get_contents($url);
                $data = json_decode($jsondata);

                echo $data->response_code;
                echo $data->error;
                foreach ($data->route as $route) {
                    echo $route->no;

                    echo "<br>";
                }
            }
        ?>

</div>
</div>
<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
    <script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>