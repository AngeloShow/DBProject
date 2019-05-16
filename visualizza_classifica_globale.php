<?php
  include "script/db_connect.php";
  include "aggiorna_classifiche.php";
	$query = $mysqli->query(" SELECT TRACCE.id_tracce, titolo, ARTISTI.nome AS A_nome, ALBUM.nome AS AL_nome
                FROM TRACCE, ALBUM,CANZONI_ARTISTI,ARTISTI ,CLASSIFICA_GLOBALE
                WHERE TRACCE.id_album=ALBUM.id_album
                AND CANZONI_ARTISTI.id_tracce=TRACCE.id_tracce
                AND CANZONI_ARTISTI.id_artisti=ARTISTI.id_artisti
                AND TRACCE.id_tracce=CLASSIFICA_GLOBALE.id_tracce
                ORDER BY posizione" );
	$rows = array();
	while($r = mysqli_fetch_assoc($query))
    	$rows[] = $r;
	echo json_encode($rows);
?>
