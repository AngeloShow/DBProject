<?php
session_start();

  include "script/db_connect.php";
//prelevo le 20 canzoni più ascoltate dall'utente con  i rispettivi generi
	$query = $mysqli->query("
  SELECT A.ID,A.NUM_ASCOLTI, TRACCE.id_generi
  FROM(
  SELECT ASCOLTI.id_tracce AS ID,COUNT(*) AS NUM_ASCOLTI
  FROM ASCOLTI
  WHERE id_utente=\"".$_SESSION['username']."\"
  GROUP BY id_tracce
  ) AS A,TRACCE
  WHERE TRACCE.id_tracce=A.ID
  ORDER BY A.NUM_ASCOLTI DESC
  LIMIT 20");
  //echo "errore:$mysqli->error";

$sum=0;
$num=0;
//salvo tutte le tuple in degli array
    while($r = mysqli_fetch_assoc($query))
    {
      $tracce[$num]=$r['ID'];
      $ascolti[$num]=(int)$r['NUM_ASCOLTI'];
      $generi[$num]=(int)$r['id_generi'];
      $sum+=(int)$r['NUM_ASCOLTI'];
      $num++;
    }
    // creo le percentuali di ascolto per ogni brano
    for( $i=0;$i<$num;$i++)
    {
      //echo "traccia=$tracce[$i]  ascolti=$ascolti[$i] generi=$generi[$i]";
      $perc[$i]=(float)($ascolti[$i]/$sum);

      //echo"perc=$perc[$i]<br/>";
    }
    //raggruppo tutti  i generi uguali delle canzoni più ascoltate dall'utente

    $var=1;
    $numNewGen=0;
    for( $i=0;$i<$num && $var==1;$i++)
    {
      $var=0;
      $k=$i;
      //trovo il primo genere diverso da -1
      while($k<$num && $var==0)
      {
        if($generi[$k]!=-1)
        {
          $newGen[$i]=$generi[$k];
          $generi[$k]=-1;
          $newPerc[$i]=$perc[$k];
          $var=1;
          $numNewGen++;
        }
        $k++;
      }
        //se trovo almeno un genere diverso da -1 VADO AVANTI ALTRIMENTI ESCO
      if($var==1)
      {
        for( $j=$k;$j<$num;$j++)
        {
          if($newGen[$i]==$generi[$j])
          {
            $newPerc[$i]+=(float)$perc[$j];
            $generi[$j]=-1;
          }
        }
      }
    }

    for( $i=0;$i<$numNewGen;$i++)
    {
    //  echo" generi=$newGen[$i]<br/>";
      //echo"perc=$newPerc[$i]<br/>";
      $newPerc[$i]=$newPerc[$i]*100;
      //echo"newperc=$newPerc[$i]<br/>";
    }
      //TROVA LE CANZONI PIù ASCOLTATE PER OGNI GENERE
    for($i=0;$i<$numNewGen;$i++)
    {

      $vetQuery[$i]=$mysqli->query("SELECT TRACCE.id_tracce, titolo, ARTISTI.nome AS A_nome, ALBUM.nome AS AL_nome
      FROM TRACCE, ALBUM,CANZONI_ARTISTI,ARTISTI
      WHERE TRACCE.id_album=ALBUM.id_album
      AND CANZONI_ARTISTI.id_tracce=TRACCE.id_tracce
      AND CANZONI_ARTISTI.id_artisti=ARTISTI.id_artisti
      AND id_generi=\"".$newGen[$i]."\"
      ORDER BY `views_totati` DESC
      LIMIT 10
      ");

      //echo"erorre=$mysqli->error<br/>";
    }
    //consiglio 10 canzoni(se ci sono) in base alle percentuali  sui nuovi generi raggruppati
    $numConsigliati=0;
    $ris = array();

    for($i=0;$i<10;$i++)
    {
      $cont=0;
      $somma=0;
      $random=(float)rand(0,100);
      for($j=0;$j<$numNewGen && $cont==0;$j++)
      {

        if($random>= $somma && $random<=($newPerc[$j]+$somma) && $r = mysqli_fetch_assoc($vetQuery[$j]))
        {
          $cont=1;
          $qualcosa=$r['titolo'];
          //echo"titolo=$qualcosa<br/>";
          $numConsigliati++;
          	$ris[$i] = $r;
        }
        $somma+=$newPerc[$j];
     }
   }
   //echo"num=$numConsigliati";


 echo json_encode($ris);

?>
