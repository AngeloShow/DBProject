<?php
session_start();
session_unset();
session_destroy();
echo "<script>alert('Logout effettuato con succeso!')</script>";
echo "<script>window.open('signin.html','_self')</script>";
?>
