<?php
function class_men()
{
include "script/db_connect.php";
$mysqli->query("DELETE FROM CLASSIFICA_MENSILE");
$query1="SELECT `id_tracce` ,COUNT(*) AS NUM_ASCOLTI
FROM ASCOLTI
WHERE MONTH(data_ascolto)=MONTH(NOW())
GROUP BY `id_tracce`
ORDER BY `NUM_ASCOLTI` DESC
LIMIT 10";
$query=$mysqli->query($query1);
$c=1;

if ($query)
{

     while ($res = $query->fetch_assoc())
     {
       $r=$res['id_tracce'];
       $mysqli->query("INSERT INTO CLASSIFICA_MENSILE VALUES ('$c' ,'$r')");
       $c++;
     }

      $query->free();


}
}





?>
