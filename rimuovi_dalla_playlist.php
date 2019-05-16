 <?php
  include "script/db_connect.php";
  $nome =$_POST['nome'];
  $utente =$_POST['utente'];
  $traccia=$_POST['traccia'];
  if($mysqli->query(" DELETE FROM `PLAYLIST` WHERE PLAYLIST.id_tracce='$traccia' AND PLAYLIST.nome='$nome' AND PLAYLIST.id_utente='$utente'" ) )
  	echo "Traccia rimossa";
	
?>

