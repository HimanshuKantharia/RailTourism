<?php
  require '../phpfiles/classes.php';  
$conn = new connect();
	$que = 'select * from stcode';
	$result = $conn->exeQuery($que);
	while($row = $result->fetch_assoc()){
		$a[] = $row['st'];
		$pq=json_encode($a);
	}
	
$data = json_decode($pq);
	foreach ($data as $k) {
	echo $k."</br>";
	}



?>