<?php
  include "script/db_connect.php";
	$query = $mysqli->query(" SELECT ALBUM.nome AS AL_nome, ARTISTI.nome AS A_nome, ALBUM.id_album, ARTISTI.id_artisti
                                FROM ALBUM, ARTISTI_ALBUM AS AA, ARTISTI 
                                WHERE AA.id_album=ALBUM.id_album
                                AND AA.id_artisti=ARTISTI.id_artisti
                                ORDER BY AL_nome" );
	$rows = array();
	while($r = mysqli_fetch_assoc($query))
    	$rows[] = $r;
	echo json_encode($rows);
?>
