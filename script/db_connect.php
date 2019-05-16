<?php
	$mysqli=new mysqli('localhost','soundweb','','my_soundweb');

	if (mysqli_connect_errno())
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
 	}
 
 ?>
