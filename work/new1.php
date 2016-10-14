<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

</head>
<body>


<?php
	$host = "localhost";
		$userName = "root";
		$password = "Piyush666";
		$db = "railways";

		$conn = mysqli_connect($host,$userName,$password,$db) or die("unable to connect");
		if (!$conn) {
   				 die('Could not connect: ' . mysqli_error($con));
		}

		if(isset($_POST["query"]))
		{
			$op = '';
			$que = 'select * from stcode where st LIKE "%'.$_POST['query'].'%"';
			$result = $conn->query($que);
			$op = '<ul class="list-unstyled">';
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


/*
		$sql = 'select * from users where type ="'.$p.'"';
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			echo "<tr>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['uid']."</td>";
			echo "<td>".$row['password']."</td>";
			echo "<td>".$row['type']."</td>";
			echo "</tr>";

		}



*/

mysqli_close($conn);

?>
	</table>
</div>


<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="../js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</body>
</html>