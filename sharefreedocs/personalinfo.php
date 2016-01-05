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
if(isset($_POST['fname']))
{
		$fname = mysql_real_escape_string($_POST['fname']);
		$lname = mysql_real_escape_string($_POST['lname']);
		$mobile = mysql_real_escape_string($_POST['mobile']);
		$email = mysql_real_escape_string($_POST['email']);
		
			$sql = mysql_query("UPDATE register SET firstname='$fname', lastname='$lname', mobile='$mobile',email='$email'  WHERE rid='$managerID'");
			
			echo "<script language=javascript> alert(' Information Updated Successfully ') </script>";
			
			
	echo "<script>window.location = 'main.php';</script>";	
}
?>

<?php 
// Gather this product's full information for inserting automatically into the edit form below on page

	
    $sql = mysql_query("SELECT * FROM register WHERE rid='$managerID' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             
			 $fname = $row["firstname"];
			 $lname = $row["lastname"];
			 $mobile = $row["mobile"];
			 $email = $row["email"];
			 $pic = $row["pic"];
			         }
    } 

?>

<?php include('header.php')?>
    
    <div id="templatemo_main">
    
    	<div class="col_w620 float_l">
<h2>Personal Details</h2> 
            <img src="aimage/<?php echo $pic; ?>" class="image_wrapper image_fr" alt="about us" width="160" height="160" />
            
          <form action="personalinfo.php" method="post">
            <table  border="0">
              <tr>
                <td width="112" ><em>First Name: </em></td>
                <td width="196" >
                  <input type="text" name="fname" value="<?php echo $fname; ?>" id="textfield"  />
                </td>
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><em>Last Name:</em></td>
                <td><input type="text" name="lname" id="textfield2" value="<?php echo $lname; ?>"/></td>
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><em>Mobile No.:</em></td>
                <td><input type="text" name="mobile" id="textfield3" value="<?php echo $mobile; ?>" /></td>
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="138"><em>E-mail:</em></td>
                <td width="170"><input type="text" name="email" id="textfield2" value="<?php echo $email; ?>" /></td>
              </tr>
             
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td><input type="submit" name="button2" id="button2" value="Update" /></td>
              </tr>
          </table>
            <p>&nbsp;</p>
          </form>
            
        </div>
        
        <div class="col_w300 float_r">
        
        	<h3>People you may know</h3>
            
            <?php include "sidebar_friends.php"; ?>
            
          	<a class="more" href="all_friends_view.php">View All</a>
            
            <div class="cleaner h30"></div>
            
            <?php include"advertise.php"; ?>
            
        </div>
        
        <div class="cleaner"></div>
    </div> <!-- end of main -->
	<?php include('footer.php')?>