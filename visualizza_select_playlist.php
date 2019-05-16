 <?php
  include "script/db_connect.php";
  $nome =$_POST['nome'];
  $utente =$_POST['utente'];


    $query = $mysqli->query(" SELECT TRACCE.id_tracce, titolo, ARTISTI.nome AS A_nome, ALBUM.nome AS AL_nome, ALBUM.id_album,
    							ARTISTI.id_artisti
				                FROM TRACCE, ALBUM,CANZONI_ARTISTI,ARTISTI, PLAYLIST
				                WHERE TRACCE.id_album=ALBUM.id_album
				                AND CANZONI_ARTISTI.id_tracce=TRACCE.id_tracce
				                AND CANZONI_ARTISTI.id_artisti=ARTISTI.id_artisti
				                AND PLAYLIST.id_tracce=TRACCE.id_tracce
				                AND PLAYLIST.nome='$nome'
				                AND PLAYLIST.id_utente='$utente'
				                ORDER BY titolo" );
	$rows = array();
	
	while($r = mysqli_fetch_assoc($query))
    	$rows[] = $r;
	echo json_encode($rows);

?>

