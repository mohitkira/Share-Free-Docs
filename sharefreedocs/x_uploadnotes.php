<?php
$name = $_FILES["file"]["name"];
if(isset($_POST['filename']))
{
		$filename = mysql_real_escape_string($_POST['filename']);
		$desc = mysql_real_escape_string($_POST['desc']);
		
		$rid = mysql_real_escape_string($_POST['thisID']);
		
		
		

$ext1 = pathinfo($name, PATHINFO_EXTENSION);
include "functions/connect_to_mysql.php"; 
if($ext1 == "djvu" || $ext1 == "epub" || $ext1 == "fb2" || $ext1 == "azw" || $ext1 == "azw" || $ext1 == "mobi" || $ext1 == "pdb" || $ext1 == "txt" || $ext1 == "pdb" || $ext1 == "pdf" || $ext1 == "ps" || $ext1 == "7z" || $ext1 == "s7z" || $ext1 == "rar" || $ext1 == "zip" || $ext1 == "zipx" )
{
	$sql = mysql_query("INSERT INTO upload (`filename` ,`description` ,`uploaderid` ,`uploaded`) VALUES ('$filename','$desc','$rid',NOW())") or die (mysql_error());


	
	
     $uid = mysql_insert_id();
	$newname = "$uid.$ext1";
	move_uploaded_file( $_FILES['file']['tmp_name'], "notes/$newname");
	echo "<script language=javascript> alert(' Information Updated Successfully ') </script>";
	echo "<script>window.location = 'main.php';</script>";	 

}
 else
 {
	echo "<script language=javascript> alert(' Please select a document or compressed file to upload..!!! ') </script>"; 
	echo "<script>window.location = 'uploadpage.php';</script>";
	 }
 }
?>