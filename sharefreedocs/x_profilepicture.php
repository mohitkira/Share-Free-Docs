<?php
session_start();
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["rid"]);

$name = $_FILES["file"]["name"];

$ext1 = pathinfo($name, PATHINFO_EXTENSION);
$nameoffile= $managerID.".".$ext1;
if($ext1 == "jpg" || $ext1 == "png" || $ext1 == "gif" || $ext1 == "jpeg" || $ext1 == "bmp" || $ext1 == "png" || $ext1 == "tif" || $ext1 == "tiff" || $ext1 == "yuv" || $ext1 == "JPG" || $ext1 == "JPEG" )
{
	move_uploaded_file( $_FILES['file']['tmp_name'], "aimage/$nameoffile");
	
include "functions/connect_to_mysql.php"; 
$sql = mysql_query("UPDATE register SET pic='$nameoffile' WHERE rid='$managerID'");
echo "<script>window.location = 'account.php';</script>";
}
 else
 {
	echo "<script language=javascript> alert(' Please select an image file..!!! ') </script>"; 
	echo "<script>window.location = 'account.php';</script>";
	 }
?>