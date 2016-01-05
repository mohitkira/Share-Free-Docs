<?php 
	session_start();
	session_destroy();
	
	echo "<script language=javascript> alert(' You have been logged out Successfully ') </script>";
	echo "<script>window.location = 'index.php';</script>";
//header("location: index.php");

?>