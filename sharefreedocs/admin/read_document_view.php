<?php 
session_start();
if (!isset($_SESSION["managera"])) {
    header("location: admin_login.php"); 
    exit();
}
// Be sure to check that this manager SESSION value is in fact in the database
$managerIDa = preg_replace('#[^0-9]#i', '', $_SESSION["ida"]); // filter everything but numbers and letters
$managera = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["managera"]); // filter everything but numbers and letters
$passworda = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["passworda"]); // filter everything but numbers and letters
// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  
include "../functions/connect_to_mysql.php"; 
$sql = mysql_query("SELECT * FROM admin WHERE aid='$managerIDa' AND username='$managera' AND password='$passworda' LIMIT 1"); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysql_num_rows($sql); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo "<script language=javascript> alert(' Your login session data is not on record in the database.') </script>";
     exit();
}
?>
<?php

if (isset($_GET['uid']))
{
	$uid = $_GET['uid'];
$sql = mysql_query("SELECT fullname FROM upload where uid=$uid");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) 
		{
	while($row = mysql_fetch_array($sql))
				{ 
			 
			 $path = $row["fullname"];
			 
			 
	 
			 	}
		}
}
?> 
<?php include('header.php')?>   
        <div id="content">
        <iframe src="http://docs.google.com/gview?url=http://aimorigami.com/sharefreedocs/docs/<?php  echo $path;  ?>&embedded=true" 
style="width:650px; height:600px;" frameborder="0"></iframe>
        </div> <!-- end of content wrapper -->

	<?php include('footer.php')?>