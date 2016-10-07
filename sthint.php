<!DOCTYPE html>
<html>
<head>
	<title></title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

</head>
<body>
<?php
		require 'phpfiles/classes.php';

		if(isset($_POST["query"]))
		{

			$conn = new connect();	
			$op = '';
			$que = 'select * from stcode where st LIKE "%'.$_POST['query'].'%"';
			$result = $conn->exeQuery($que);
			$op = '<ul class="hint list-unstyled">';
			if(mysqli_num_rows($result) > 0 ){
				while($row = $result->fetch_assoc()){
					$op .= '<li>'.$row['st'].'</li>';
				}

			}
			else{
				$op .= '<li>not fountd</li>'; 
			}
			$op .= '</ul>';
			echo $op;
		}



//error_reporting(0);

?>




<!--  <script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
  <script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>