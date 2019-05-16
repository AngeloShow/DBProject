<?php
include ("script/db_connect.php");
if(isset($_POST['artista-submit']))
{
    $nome = mysqli_real_escape_string($mysqli,$_POST['nome_art']);
    $commento = mysqli_real_escape_string($mysqli,$_POST['desc_art']);


    $dato= $mysqli->query("SHOW TABLE STATUS WHERE `Name` = 'ARTISTI'");
    $temp=mysqli_fetch_array($dato,MYSQLI_ASSOC);
    $id_artista=$temp['Auto_increment'];
    $target_file = "artisti/$id_artista.jpg";
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    if (file_exists($target_file))
        $uploadOk = 0;
    if($imageFileType != "jpg" && $imageFileType != "jpeg")
        $uploadOk = 0;
    if ($uploadOk != 0)
    {
        if (!move_uploaded_file($_FILES['file_art']['tmp_name'], $target_file))
        $target_file = "artisti/default.jpg";

    }
  $query="INSERT INTO ARTISTI (nome,descrizione,path_img)VALUES ('$nome','$commento','$target_file')";
  if(mysqli_query($mysqli, $query))
    {
      echo "<script>alert('Artista inserito con successo!')</script>";
      echo "<script>window.open('insert.php','_self')</script>";

    }
    else {
      echo "<script>alert('Errore nell/' inserimento:".mysqli_error($mysqli)."')</script>";
      echo "<script>window.open('insert.php','_self')</script>";

    }
  }

?>
