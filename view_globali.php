<?php
	include "script/db_connect.php";
	$temp =$_POST['track'];
	$temp =(int)$temp;
	echo $temp;
    $mysqli->query(" UPDATE `TRACCE` SET `views_totati`=`views_totati`+1 WHERE `id_tracce`='$temp' ")
?>