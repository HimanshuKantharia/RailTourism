<!DOCTYPE html>
<html style="height:100%">
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
    /*height: 100px;*/
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
        <li><a href="#">contact</a></li>
        <li><a href="#">About us</a></li>
      </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
       
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
        
        <div id="menu3" class="tab-pane fade">
            <form class="form-inline" method="post" action="trainStatus.php">
                <input type="text" class="form-control " name="tnost" placeholder="Train Number" role="textbox" >

                <input type="date" class="form-control" name="tdate" placeholder="DD-MM-YYYY"  >

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
    <div class="row">
    

    </div>

    <?php
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
           echo '<div class="table-responsive"><table class="table table-bordered table-condensed">';

    echo '<thead>
      <th>No</th>
      <th>Train number</th>
      <th>Train name</th>
      <th>Source</th>
      <th>Departure</th>
      <th>destination</th>
      <th>arrival</th>
      <th>
      <table class="table table-bordered table-condensed "  >
        
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

        echo  '<a target="_blank" href="trainSchedule.php?tname_ro='.$trainno->number.  '">'.$trainno->name.'</a>';
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
        echo  "<table class='table table-bordered table-condensed' ><tr >";
        foreach ($trainno->days as $tdays) {
          echo "<td>".$tdays->runs."</td>";
        }
        echo "</tr></table>";

        echo "</td><td>";
        //echo  "<table class='table table-responsive' ><tr >";
        $chr = 'class-code';
        foreach ($trainno->classes as $tclass) {
            echo "<div class='btn-group btn-group-xs' role='group'>";
            if($tclass->available == "Y"  ){
          echo "<button type='submit' class='btn btn-default btn-xs'>".$tclass->$chr."</button>"; 
            }
            echo "</div>";
        }
       //     echo "</tr></table>";
        echo "</td></tr>";
        //echo "<br>";
      }
        echo "</table></div>";
      }
    }


    /*
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
    }*/





?>

</div>
</div>




<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>