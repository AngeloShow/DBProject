<?php
include ("script/db_connect.php");
if(isset($_POST['traccia-submit']))
{
    $titolo = mysqli_real_escape_string($mysqli,$_POST['titolo_tra']);
    $data = mysqli_real_escape_string($mysqli,$_POST['date']);
    $genere = mysqli_real_escape_string($mysqli,$_POST['selectgen_tra']);
    $album = mysqli_real_escape_string($mysqli,$_POST['selectalb_tra']);

    $dato= $mysqli->query("SHOW TABLE STATUS WHERE `Name` = 'TRACCE'");
    $temp=mysqli_fetch_array($dato,MYSQLI_ASSOC);
    $id_traccia=$temp['Auto_increment'];
    $target_file = "music/$id_traccia.mp3";
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    if (file_exists($target_file))
        $uploadOk = 0;
    if($imageFileType != "mp3")
        $uploadOk = 0;
    if ($uploadOk != 0)
    {
        if (move_uploaded_file($_FILES['file_tra']['tmp_name'], $target_file))
        {
          $query="INSERT INTO TRACCE (titolo,path,id_generi,id_album,data_pubblicazione)VALUES ('$titolo','$target_file','$genere','$album','$data')";
          if(!mysqli_query($mysqli, $query))
          {
            echo "<script>alert('Errore nell/' inserimento:".mysqli_error($mysqli)."')</script>";
            echo "<script>window.open('insert.php','_self')</script>";
          }
          else
            {
              foreach ($_POST['selectart_tra'] as $artisti)
              {
                $query1="INSERT INTO CANZONI_ARTISTI VALUES ('$artisti','$id_traccia')";
                $mysqli->query($query1);
              }
              echo "<script>alert('Traccia inserita con successo!')</script>";
              echo "<script>window.open('insert.php','_self')</script>";

            }
        }
        else {
          echo "<script>alert('Errore nell/' inserimento del file!')</script>";
          echo "<script>window.open('insert.php','_self')</script>";
        }


    }



  }



?>
