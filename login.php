<?php
session_start();
include "script/db_connect.php";
if(isset($_SESSION['autorizzato']) && $_SESSION['autorizzato']==1)
{
	echo "<script>alert('sei gia\' autenticato!')</script>";
	echo "<script>window.open('home.php','_self')</script>";
}
else if(isset($_POST['login-submit']))
{
$user = mysqli_real_escape_string($mysqli,$_POST['username']);
$pass = mysqli_real_escape_string($mysqli,$_POST['password']);
$pass=MD5($pass);
$sel_user = "select * from UTENTE where username='$user' AND password='$pass'";
$run_user = mysqli_query($mysqli, $sel_user);
$check_user = mysqli_num_rows($run_user);
if($check_user>0)
{
	$row=$run_user->fetch_assoc();
	$_SESSION['username']=$user;
	$_SESSION['tipo']=$row['tipo_utente'];
	$_SESSION['autorizzato']=1;
	$_SESSION['nome']=$row['nome'];
	echo"<script>alert('Loggato con successo!')</script>";
	echo "<script>window.open('home.php','_self')</script>";

}
else
{
	echo "<script>alert('Username o password non validi, riprova!')</script>";
	echo "<script>window.open('signin.html','_self')</script>";
}
}
?>
