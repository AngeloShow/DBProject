 <?php
  include "script/db_connect.php";
  $nome =$_POST['nome'];

    $query = $mysqli->query(" SELECT PLAYLIST.nome
				                FROM PLAYLIST
				                WHERE PLAYLIST.id_utente='$nome'
				                GROUP BY PLAYLIST.nome
				                ORDER BY PLAYLIST.nome" );
	$rows = array();
	while($r = mysqli_fetch_assoc($query))
    	$rows[] = $r;
	echo json_encode($rows);

?>

