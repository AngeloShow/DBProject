<?php
  include "script/db_connect.php";
	$query = $mysqli->query(" SELECT * FROM `ARTISTI` ORDER BY nome" );
	$rows = array();
	while($r = mysqli_fetch_assoc($query))
    	$rows[] = $r;
	echo json_encode($rows);
?>
