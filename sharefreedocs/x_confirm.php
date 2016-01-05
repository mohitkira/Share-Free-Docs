<?php 
if (isset($_GET['managerid']))
{
$managerid=$_GET['managerid'];
$add=$_GET['toadd'];
include "functions/connect_to_mysql.php";

$query="UPDATE status".$managerid." SET confirm = '1', notification = '0' WHERE friendid ='".$add."'";

$sql = mysql_query($query) or die (mysql_error());


$query1="UPDATE status".$add." SET confirm = '1', notification = '0' WHERE friendid ='".$managerid."'";

$sql1 = mysql_query($query1) or die (mysql_error());

echo "<script>window.location = 'main.php';</script>";
}

?>