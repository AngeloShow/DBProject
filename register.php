<?php
session_start();
include "script/db_connect.php";
if(isset($_SESSION['autorizzato']) && $_SESSION['autorizzato']==1)
{
  echo "<script>alert('Sei gia\' loggato!')</script>";
  echo "<script>window.open('home.html','_self')</script>";
	//echo "sei autorizzato!";
}
else if(isset($_POST['register-submit']))
{
  $user = mysqli_real_escape_string($mysqli,$_POST['username1']);
  $sel_user = "select * from UTENTE where username='$user' ";
  $check_user = mysqli_num_rows(mysqli_query($mysqli,$sel_user));

  if($check_user>0)
  {
    echo "<script>alert('Username gia\' usato,prova con un altro!')</script>";
    echo "<script>window.open('signin.html','_self')</script>";

  }
  else
  {
    $pass = mysqli_real_escape_string($mysqli,$_POST['password1']);
    $nome = mysqli_real_escape_string($mysqli,$_POST['nome']);
    $cognome = mysqli_real_escape_string($mysqli,$_POST['cognome']);
    $email = mysqli_real_escape_string($mysqli,$_POST['email']);
    $pass=MD5($pass);
    $tipo=$_POST['options'];

    $query="INSERT INTO UTENTE VALUES ('$user','$pass','$email','$nome','$cognome','$tipo')";
    $run_user = mysqli_query($mysqli, $query);


    	echo "<script>alert('Utente registrato con successo!')</script>";
    	echo "<script>window.open('signin.html','_self')</script>";



    }

}


?>
