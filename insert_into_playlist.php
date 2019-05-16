 <?php
  include "script/db_connect.php";
  $track =$_POST['track'];
  $utente =$_POST['utente'];
  $nome =$_POST['nome'];
  $query=" SELECT * FROM `PLAYLIST` WHERE id_tracce='$track' AND id_utente='$utente' AND nome='$nome' ";
  $result=$mysqli->query($query);
  if(mysqli_num_rows($result))
	echo "Traccia già presente";
  else{
  	$insertquery=" INSERT INTO `PLAYLIST`(`id_tracce`, `id_utente`, `nome`) VALUES ('$track','$utente','$nome') ";
    if ($mysqli->query($insertquery)) 
      echo "Inserimento riuscito";
    else 
      echo "Inserimento traccia fallito";
  }

?>