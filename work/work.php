<!DOCTYPE html>
<html>
<head>
	<title>working page:trail and error</title>
<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<style>
	ul{
		background-color: #eee;
		cursor: pointer;
	}
	li{
		padding: 12px;
	}
</style>
<script>
	$(document).ready(function(){
		$('#piyin').keyup(function(){
			vay qu = $(this).val();
			if(qu != '')
			{
				$.ajax({
					url:"new2.php".
					method:"POST",
					data:{query:qu},
					success:function(data){
						//$("#dl").html(data);
						$("#myff").append(data);
					}
				});
			}
		});
	});


	$(document).ready(function(){
		$('#country').keyup(function(){
			var query = $(this).val();
			if(query != '')
			{
				$.ajax({
					url:"new1.php",
					method:"POST",
					data:{query:query},
					success:function(data)
					{
						$('#countryList').fadeIn();
						$('#countryList').html(data);
					}
				});
			}
		}); 
		$(document).on('click','li',function(){
			$('#country').val($(this).text());
			$('#countryList').fadeOut();
		});

	});
</script>


</head>
<body>
<form  id="myff" action="">
<input type="text" name="co" id="piyin" class='form-control' list="dl">
<!--<datalist id="dl"></datalist>-->
</form>



<!--
<h3>Start typing a name in the input field below:</h3>

<form action="">
First name: <input type="text" id="txt1" onkeyup="showHint(this.value)">
</form>

<p>Suggestions:</p> <div class="container" id="txtHint">this will go</div>




<form action="">
	<input type="text" name="country" id="country" class="form-control" placeholder="station name">
	
	<div id="countryList"></div>
</form>

<input type="text" name="my">


-->

<script>
/*
function showHint(str) {
  var xhttp;
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "req.php?q="+str, true);
  xhttp.send();
}
*/
</script>



<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="../js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</body>
</html>
