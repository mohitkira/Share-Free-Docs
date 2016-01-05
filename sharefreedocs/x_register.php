<?php
include "functions/connect_to_mysql.php";

if (isset($_POST['username'])) {
	$dob="0000-00-00";
	$fname = mysql_real_escape_string($_POST['fname']);
	$lname = mysql_real_escape_string($_POST['lname']);
	$username = mysql_real_escape_string($_POST['username']);
	$password = mysql_real_escape_string($_POST['password']);
	$sex = $_POST['sex'];
	$dob = mysql_real_escape_string($_POST['dob']);
	$mobile = mysql_real_escape_string($_POST['mobile']);
	$email = mysql_real_escape_string($_POST['email']);
	$profession = mysql_real_escape_string($_POST['profession']);
	$college = mysql_real_escape_string($_POST['college']);
	$country = mysql_real_escape_string($_POST['country']);
	$state = mysql_real_escape_string($_POST['state']);
	$city = mysql_real_escape_string($_POST['city']);
	$address = mysql_real_escape_string($_POST['address']);
	
	if($sex == 'male')
	{
		$pic="male.jpg";
		}
	else
	{
		$pic="female.jpg";
		}	
	$sql = mysql_query("SELECT rid FROM register WHERE username='$username' LIMIT 1");
	$productMatch = mysql_num_rows($sql); // count the output amount
    if ($productMatch > 0) {
		echo "<script language=javascript> alert(' Sorry you tried to place a duplicate Username into the system!!! ') </script>";
	echo "<script>window.location = 'pregister.php';</script>";
	}
	else{
	$sql = mysql_query("SELECT rid FROM register WHERE email='$email' LIMIT 1");
	$productMatch = mysql_num_rows($sql); // count the output amount
    if ($productMatch > 0) {
		echo "<script language=javascript> alert(' This E-mail is already register!!! ') </script>";
	echo "<script>window.location = 'pregister.php';</script>";
	}
	else
	{

	$sql = mysql_query("INSERT INTO register(username, password, firstname, lastname, sex, dateofbirth, mobile, email, address, city, state, country, collegename,profession,pic, date_register) VALUES('$username','$password','$fname','$lname','$sex','$dob','$mobile','$email','$address','$city','$state','$country','$college','$profession','$pic',now())") or die (mysql_error());
	
		$rid = mysql_insert_id();
// Create table
$sqlCommand = "CREATE TABLE status".$rid." (
		 		 zid int(11) NOT NULL auto_increment,
				 friendid int(11) ,
		 		 blockid int(1) ,
		 		 confirm int(1) ,
				 notification int(1) ,
		 		 PRIMARY KEY (zid)
		 		 ) ";
if (!(mysql_query($sqlCommand))){ 
   echo "<script language=javascript> alert('CRITICAL ERROR: admin table has not been created.') </script>"; 
} 
$subject = "Confirmation email for ShareFreeDocs";
$message = "$fname,

Thank you for signing up with ShareFreeDocs. Please click this link to activate your account: 

http://aimorigami.com/sharefreedocs/confirmed.php?chid=".$rid."

(If clicking the link in this message does not work, copy and paste it into the address bar of your browser .)";
$from = "mohit@aimorigami.com";
$headers = "From:" . $from;
include "functions/functions.php";
include "functions/sms.php";
mail($email,$subject,$message,$headers);
$m = "Thank you ".$fname." for signing up with Stationshop. Please check your email-id for confirmation.";
sms($m,$mobile);

		
		echo "<script>window.location = 'index.php';</script>";
	}
	}
}
?>