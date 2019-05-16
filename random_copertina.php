<?php
  include "script/db_connect.php";
	$temp=""+$_POST['str'];
    $query = $mysqli->query(' SELECT * FROM `ALBUM` WHERE `path_copertina` NOT LIKE '.$temp.' ORDER BY RAND() ' );
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC); 
    echo json_encode($row);
    
?>
