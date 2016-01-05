<?php 
	session_start();
	$id = preg_replace('#[^0-9]#i', '', $_SESSION["ida"]);
	unset($_SESSION['ida']);
	unset($_SESSION['managera']);
	unset($_SESSION['passworda']);
	include "../functions/connect_to_mysql.php";

$query="UPDATE admin SET last_logout_date = now() WHERE aid ='".$id."'";

$sql = mysql_query($query) or die (mysql_error());
	echo "<script language=javascript> alert(' You have been logged out Successfully ') </script>";
	echo "<script>window.location = 'index.php';</script>";
//header("location: index.php");

?>