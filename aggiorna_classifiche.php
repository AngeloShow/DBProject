<?php
session_start();
include "script/db_connect.php";
include "classifica_mensile.php";
include "classifica_globale.php";
 $dataCorrente = date('Y-m-d-H');


 $query = $mysqli->query(" SELECT DATA FROM ORA_ULTIMA_MOD" );
  //echo "$mysqli->error";
$r = mysqli_fetch_assoc($query);
$c=0;
 if(!$r)
  {
    $c=1;
    $query = $mysqli->query(" INSERT INTO ORA_ULTIMA_MOD (SELECT NOW())" );
    //echo "$mysqli->error";
    $query=$mysqli->query(" SELECT DATA FROM ORA_ULTIMA_MOD" );
  $r = mysqli_fetch_assoc($query);
  }
 $time = strtotime($r['DATA']);
$vecchiaData = date('Y-m-d-H',$time);
 if( $dataCorrente>$vecchiaData || $c==1)
 {
   $mysqli->query("DELETE FROM ORA_ULTIMA_MOD");
   $mysqli->query(" INSERT INTO ORA_ULTIMA_MOD (SELECT NOW())" );
   class_men();
   class_glo();
 }
?>
