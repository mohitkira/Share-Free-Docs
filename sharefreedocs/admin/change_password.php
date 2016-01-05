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
if(isset($_POST['old']))
{
	if($passworda == $_POST['old'])
	{
		$newpassword = mysql_real_escape_string($_POST['new']);
		$renewpassword = mysql_real_escape_string($_POST['renew']);
		if($newpassword == $renewpassword)
		{
			$sql = mysql_query("UPDATE admin SET password='$newpassword' WHERE aid='$managerIDa'");
			
			echo "<script language=javascript> alert(' Password Updated Successfully ') </script>";
			$_SESSION["passworda"]=$newpassword;
	echo "<script>window.location = 'index.php';</script>";
			}
		}
		else
		{
			echo "<script language=javascript> alert(' Incorrect password please reenter the password') </script>";
	echo "<script>window.location = 'setting.php';</script>";
			}
}


?> 
<?php include('header.php')?>   
        <div id="content">
        	<h2 align="center">Change password</h2>
<br>
<form action="change_password.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
    	 <tr>
        <td width="20%" align="right">User-id</td>
        <td width="40%"><label>
          <?php echo $managera; ?>
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">Old Passord</td>
        <td width="40%"><label>
          <input type="password" id="old" name="old" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">New Password</td>
        <td width="40%"><label>
         <input type="password" id="new" name="new" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">Retype New Password</td>
        <td width="40%"><label>
         <input type="password" id="renew" name="renew" />
        </label></td>
      </tr>
     <tr>
        <td>&nbsp;</td>
        <td><label>
          <input type="submit" name="button" id="button" value="Change Password" />
        </label></td>
      </tr>
    </table>
    </form>
           
             
		</div> <!-- end of content wrapper -->

	<?php include('footer.php')?>