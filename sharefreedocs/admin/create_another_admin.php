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
if (isset($_POST['lname'])) {
	$lname = mysql_real_escape_string($_POST['lname']);
	$fname = mysql_real_escape_string($_POST['fname']);
	$email = mysql_real_escape_string($_POST['email']);
	$mobile = mysql_real_escape_string($_POST['mobile']);
	$password = mysql_real_escape_string($_POST['password']);
	$username = mysql_real_escape_string($_POST['username']);
	$uname = "";
	$mail = "";
	$sql = mysql_query("SELECT * FROM admin where username='$username' OR email='$email'");
		while ($row = mysql_fetch_array($sql)) {
			$uname = $row["username"];
			$mail = $row["email"];			
		}
	if($uname != $username && $password != ""){
		if($mail == $email){echo "<script language=javascript> alert(' Email already exist ') </script>";
	echo "<script>window.location = 'addsupport.php';</script>";
	}
	$sql = mysql_query("INSERT INTO admin (username, password, firstname, lastname, mobile, email, date_register) 
        VALUES('$username','$password','$fname','$lname','$mobile','$email',now())") or die (mysql_error());
		
		$subject = "Username Password form ShareFreeDocs";
$message = '$fname,

Username Password for Admin login is:
Username : '.$username.'
Password : '.$password.'
you can login now by clicking <a href="http://aimorigami.com/sharefreedocs/admin/admin_login.php">here</a>';
$from = "mohit@aimorigami.com";
$headers = "From:" . $from;
include "../functions/functions.php";
mail($email,$subject,$message,$headers);
	echo "<script language=javascript> alert(' You have added new Admin Successfully!!!! ') </script>";
	echo "<script>window.location = 'index.php';</script>";
}
else
{
	echo "<script language=javascript> alert(' Username already exist ') </script>";
	echo "<script>window.location = 'create_another_admin.php';</script>";
	}}

?>
  <?php include('header.php')?>      
        
        <div id="content">
        	
           <h1 align="center" style="color:#66FF00">Admin Registration Form</h1>
           <p align="center" style="color:#66FF00">&nbsp;</p>
             <form action="create_another_admin.php" method="post" enctype="multipart/form-data" >
             <table align="center"> 
           <tr>
           <td width="100">
           First Name:           
           </td>
           <td width="236">
           <input type="text" name="fname" id="fname" required="required" />
           </td>
           </tr>
           <tr><td colspan="2">&nbsp;</td> </tr>
           <tr>
           <td>
           Last Name:           
           </td>
           <td>
           <input type="text" name="lname" id="lname" required="required" />
           </td>
           </tr>
           <tr><td colspan="2">&nbsp;</td> </tr>
           <tr>
           <td>
           Username:           
           </td>
           <td>
           <input type="text" name="username" id="username" required="required" />
           </td>
           </tr>
           <tr><td colspan="2">&nbsp;</td> </tr>
           <tr>
           <td>
           Password:           
           </td>
           <td>
           <input type="password" name="password" id="password" required="required" />
           </td>
           </tr>
           <tr><td colspan="2">&nbsp;</td> </tr>
           <tr>
           <td>
           Mobile:           
           </td>
           <td>
           <input type="text" name="mobile" id="mobile" required="required" />
           </td>
           </tr>
           <tr><td colspan="2">&nbsp;</td> </tr>
           <tr>
           <td>
           E-mail id:           
           </td>
           <td>
           <input type="text" name="email" id="email" required="required" />
           </td>
           </tr>
           <tr><td colspan="2">&nbsp;</td> </tr>
           <tr>
           <td>
           </td>
           <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit"  />
           </td>
           </tr>
           </table>
           </form>
	</div> <!-- end of content -->

	<?php include('footer.php')?>