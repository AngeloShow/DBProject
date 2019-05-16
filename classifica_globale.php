<?php
function class_glo()
{
include "script/db_connect.php";
$mysqli->query("DELETE FROM CLASSIFICA_GLOBALE");
$query=$mysqli->query("SELECT `id_tracce` FROM TRACCE ORDER BY `views_totati` DESC LIMIT 10");
$c=1;

if ($query)
{

     while ($res = $query->fetch_assoc())
     {
       $r=$res['id_tracce'];
       $mysqli->query("INSERT INTO CLASSIFICA_GLOBALE VALUES ('$c' ,'$r')");
       $c++;
     }

      $query->free();


}
}





?>
