 <?php
	include "script/db_connect.php";
	$track =$_POST['track'];
	$utente =$_POST['utente'];
	$insertquery=" INSERT INTO `ASCOLTI`(`id_tracce`, `id_utente`, `data_ascolto`) 
					VALUES ('$track','$utente',NOW()) ";
	$mysqli->query($insertquery);
?>