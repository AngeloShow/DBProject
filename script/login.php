<?php
session_start();
include "db_connect.php";
if(isset($_SESSION['autorizzato']) && $_SESSION['autorizzato']==1)
{
	echo "sei autorizzato!";
}
$user = mysqli_real_escape_string($mysqli,$_POST['username']);
$pass = mysqli_real_escape_string($mysqli,$_POST['password']);
$pass=MD5($pass);
$sel_user = "select * from UTENTE where username='$user' AND password='$pass'";
$run_user = mysqli_query($mysqli, $sel_user);
$check_user = mysqli_num_rows($run_user);
if($check_user>0)
{
	$_SESSION['username']=$user;
	echo "apposto!";
	echo "<script>window.open('index.html','_self')</script>";
	$_SESSION['autorizzato']=1;
}
else
{
	echo "<script>alert('Email or password is not correct, try again!')</script>";
}
?>
