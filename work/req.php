<?php
/* 
$a[] = "Anna";
$a[] = "Brittany";
$a[] = "Cinderella";
$a[] = "Diana";
$a[] = "Eva";
$a[] = "Fiona";
$a[] = "Gunda";
$a[] = "Hege";
$a[] = "Inga";
$a[] = "Johanna";
$a[] = "Kitty";
$a[] = "Linda";
$a[] = "Nina";
$a[] = "Ophelia";
$a[] = "Piyush";
$a[] = "Amanda";
$a[] = "Raquel";
$a[] = "Cindy";
$a[] = "Doris";
$a[] = "Eve";
$a[] = "Evita";
$a[] = "Sunniva";
$a[] = "Tove";
$a[] = "Unni";
$a[] = "Violet";
$a[] = "Liza";
$a[] = "Elizabeth";
$a[] = "Ellen";
$a[] = "Wenche";
$a[] = "Vicky";

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion" : $hint;
*/



// now mysql example...
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


<div class="container">
	<table class="table table-striped">
		<th>name</th>
		<th>uid</th>
		<th>password</th>
		<th>type</th>
<?php
	$host = "localhost";
		$userName = "root";
		$password = "Piyush666";
		$db = "piyush";

		$conn = mysqli_connect($host,$userName,$password,$db) or die("unable to connect");
		if (!$conn) {
    die('Could not connect: ' . mysqli_error($con));
}


		$p = $_GET['q'];

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





mysqli_close($conn);

?>
	</table>
</div>


<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="../js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</body>
</html>