<?php 
session_start();
if (!isset($_SESSION["manager"])) {
    header("location:index.php"); 
    exit();
}
?>
<?php 
if (isset($_SESSION["manager"])) {
// Be sure to check that this manager SESSION value is in fact in the database
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["rid"]); // filter everything but numbers and letters
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); // filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters
// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  
include "functions/connect_to_mysql.php"; 
$sql = mysql_query("SELECT rid FROM register WHERE username='$manager' AND password='$password' AND confirm='1' LIMIT 1"); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysql_num_rows($sql); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo "<script language=javascript> alert('Your login session data is not on record in the database.')</script>";
	 echo "<script>window.location = 'index.php';</script>";
     exit();
}

}
?>
<?php 
// Gather this product's full information for inserting automatically into the edit form below on page

	
    $sql = mysql_query("SELECT * FROM register WHERE rid='$managerID' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
			 $pic = $row["pic"];
			         }
    } 

?>
<?php
if(isset($_POST['old']))
{
	if($password == $_POST['old'])
	{
		$newpassword = mysql_real_escape_string($_POST['new']);
		$renewpassword = mysql_real_escape_string($_POST['renew']);
		if($newpassword == $renewpassword)
		{
			$sql = mysql_query("UPDATE register SET password='$newpassword' WHERE rid='$managerID'");
			
			echo "<script language=javascript> alert(' Password Updated Successfully ') </script>";
			$_SESSION["password"]=$newpassword;
			
			$sql = mysql_query("SELECT * FROM register WHERE rid='$managerID'");
		while ($row = mysql_fetch_array($sql)) {
			$email = $row["email"];
		}
		
$subject = "Password Changed email for StationShop";
$message = $manager.",

You have changed your passoword successfully. Your new password is ".$newpassword;
//email($email,$subject,$message);
	echo "<script>window.location = 'main.php';</script>";
			}
		}
		else
		{
			echo "<script language=javascript> alert(' Incorrect password please re-enter the password..!!') </script>";
	echo "<script>window.location = 'passwordchange.php';</script>";
		}
}
?>
<?php include('header.php')?>
    
    <div id="templatemo_main">
    
    	<div class="col_w620 float_l">
<h2>Change Password</h2> 
            <img src="aimage/<?php echo $pic; ?>" class="image_wrapper image_fr" alt="about us" width="160" height="160" />
            
          <form action="passwordchange.php" method="post">
            <table  border="0">
            <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
            <tr>
                <td><p align="justify"><em>Old Password: </em></p></td>
                <td><input type="password" id="old" name="old" required="required" /></td>
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="138" ><em>Password: </em></td>
                <td width="170" >
                  <input type="password" name="new" id="textfield" required="required" />
                </td>
              </tr>
              <tr>
                <td><p align="justify"><em>Re-type Password:</em></p></td>
                <td><input type="password" name="renew" id="textfield4" required="required" /></td>
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input type="submit" value="Update"/></td>
              </tr>
             
          </table>
            <p>&nbsp;</p>
          </form><form id="form1" name="form1" method="post" action="account.php"></form><form action="account.php">
  <p>&nbsp;</p>
          </form>

        </div>
        
        <div class="col_w300 float_r">
        
        	<h3>People you may know</h3>
            
            <?php include "sidebar_friends.php"; ?>
            
          	<a class="more" href="all_friends_view.php">View All</a>
            
            <div class="cleaner h30"></div>
            
            <?php include "advertise.php";?>
            
        </div>
        
        <div class="cleaner"></div>
    </div> <!-- end of main -->
	<?php include('footer.php')?>