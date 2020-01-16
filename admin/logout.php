<?php
include 'connection.php';
	session_start();
	$username =$_SESSION['username'];


$setstatus="UPDATE `user_info` SET `status_web`='OFFLINE' WHERE `username` = '$username'";
$connection->query($setstatus);
	if(session_destroy())
	{
		
		header("location:../");
	}
?>