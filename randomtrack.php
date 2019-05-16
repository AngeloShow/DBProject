<?php
  include "script/db_connect.php";
	$temp =$_POST['str'];
	$temp =(int)$temp;
    $query = $mysqli->query(' SELECT * FROM `TRACCE` WHERE `id_tracce`<>'.$temp.' ORDER BY RAND() ' );
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC); 
    echo json_encode($row);
    
?>
