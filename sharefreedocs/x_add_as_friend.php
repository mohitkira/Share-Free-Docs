<?php 
if (isset($_GET['managerid']))
{
$managerid=$_GET['managerid'];
$add=$_GET['toadd'];
//echo $managerid."<br>".$add;
include "functions/connect_to_mysql.php";

$sql = mysql_query("SELECT * FROM status".$managerid." WHERE friendid='$add' AND confirm='1'");
	$productMatch = mysql_num_rows($sql); // count the output amount
    if ($productMatch > 0) {
		echo "<script language=javascript> alert(' You are already friend!!!! ') </script>";
	echo "<script>window.location = 'main.php';</script>";
	}
	else
	{
$sql = mysql_query("SELECT * FROM status".$managerid." WHERE friendid='$add'");
	$productMatch = mysql_num_rows($sql); // count the output amount
    if ($productMatch > 0) {
		echo "<script language=javascript> alert(' You have already send friend Request!!!! ') </script>";
	echo "<script>window.location = 'main.php';</script>";
	}
	else
	{

$query="INSERT INTO status".$managerid."(friendid, confirm) VALUES('$add',0)";

$sql = mysql_query($query) or die (mysql_error());

$query1="INSERT INTO status".$add."(friendid, confirm, notification) VALUES('$managerid',0,1)";

$sql1 = mysql_query($query1) or die (mysql_error());

echo "<script>window.location = 'main.php';</script>";
}
}
}
?>