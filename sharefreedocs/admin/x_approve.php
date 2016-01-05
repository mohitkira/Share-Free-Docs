<?php 
if (isset($_GET['uid']))
{
$uid=$_GET['uid'];
include "../functions/connect_to_mysql.php";

$query="UPDATE upload SET approved = '1' WHERE uid ='".$uid."'";

$sql = mysql_query($query) or die (mysql_error());

echo "<script>window.location = 'index.php';</script>";
}

?>