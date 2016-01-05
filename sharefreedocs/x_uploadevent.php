
<?php
$name = $_FILES["file"]["name"];
if(isset($_POST['eventname']))
{
		$eventname = mysql_real_escape_string($_POST['eventname']);
		$desc = mysql_real_escape_string($_POST['desc']);
		$date = mysql_real_escape_string($_POST['date']);
		$rid = mysql_real_escape_string($_POST['thisID']);
		
		$name = $_FILES["file"]["name"];
		

$ext1 = pathinfo($name, PATHINFO_EXTENSION);
include "functions/connect_to_mysql.php"; 
if($ext1 == "jpg" || $ext1 == "png" || $ext1 == "gif" || $ext1 == "jpeg" || $ext1 == "bmp" || $ext1 == "png" || $ext1 == "tif" || $ext1 == "tiff" || $ext1 == "yuv" )
{
	$sql = mysql_query("INSERT INTO events(eventname, description, uploaderid, date_of_event, date_upload) VALUES('$eventname','$desc','$rid', NOW())") or die (mysql_error());
	
     $eid = mysql_insert_id();
	$newname = "$eid.$ext1";
	move_uploaded_file( $_FILES['file']['tmp_name'], "events/$newname");
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