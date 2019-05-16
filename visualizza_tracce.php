<?php
  include "script/db_connect.php";
	$query = $mysqli->query(" SELECT TRACCE.id_tracce, titolo, ARTISTI.nome AS A_nome, ALBUM.nome AS AL_nome, ALBUM.id_album,
                                ARTISTI.id_artisti
                                FROM TRACCE, ALBUM,CANZONI_ARTISTI,ARTISTI 
                                WHERE TRACCE.id_album=ALBUM.id_album
                                AND CANZONI_ARTISTI.id_tracce=TRACCE.id_tracce
                                AND CANZONI_ARTISTI.id_artisti=ARTISTI.id_artisti
                                ORDER BY titolo" );
	$rows = array();
	while($r = mysqli_fetch_assoc($query))
    	$rows[] = $r;
	echo json_encode($rows);
?>
