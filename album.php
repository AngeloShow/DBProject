<?php
include ("script/db_connect.php");
if(isset($_POST['album-submit']))
{
    $nome = mysqli_real_escape_string($mysqli,$_POST['nome_alb']);
    $data = mysqli_real_escape_string($mysqli,$_POST['date']);
    $dato= $mysqli->query("SHOW TABLE STATUS WHERE `Name` = 'ALBUM'");
    $temp=mysqli_fetch_array($dato,MYSQLI_ASSOC);
    $id_album=$temp['Auto_increment'];
    $target_file = "copertine/$id_album.jpg";
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    if (file_exists($target_file))
        $uploadOk = 0;
    if($imageFileType != "jpg" && $imageFileType != "jpeg")
        $uploadOk = 0;
    if ($uploadOk != 0)
    {
        if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file))
        $target_file = "copertine/default.jpg";

    }
    $query=" INSERT INTO ALBUM (nome,data_pubblicazione,path_copertina) VALUES ('$nome','$data','$target_file') ";
    if(!mysqli_query($mysqli, $query))
    {
      echo "<script>alert('Errore nell/' inserimento:".mysqli_error($mysqli)."')</script>";
      echo "<script>window.open('insert.php','_self')</script>";
    }
    else
      {
        foreach ($_POST['select_alb'] as $artisti)
        {
          $query1="INSERT INTO ARTISTI_ALBUM VALUES ('$artisti','$id_album')";
          $mysqli->query($query1);
        }
        echo "<script>alert('Album inserito con successo!')</script>";
        echo "<script>window.open('insert.php','_self')</script>";

      }




  }




?>
