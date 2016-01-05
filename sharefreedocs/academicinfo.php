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
if(isset($_POST['interest']))
{
	
		$interest = mysql_real_escape_string($_POST['interest']);
		$branch = mysql_real_escape_string($_POST['branch']);
		$profession = mysql_real_escape_string($_POST['profession']);
		$college = mysql_real_escape_string($_POST['college']);
		
			$sql = mysql_query("UPDATE register SET interest='$interest',branch='$branch',profession='$profession',collegename='$college' WHERE rid='$managerID'");
			
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
             
			 $interest = $row["interest"];
			 $pic = $row["pic"];
			         }
    } 

?>
<?php include('header.php')?>
    
    <div id="templatemo_main">
    
    	<div class="col_w620 float_l">
<h2>Change Academic Information</h2> 
            <img src="aimage/<?php echo $pic; ?>" class="image_wrapper image_fr" alt="about us" width="160" height="160" />
            
          <form action="academicinfo.php" method="post">
            <table  border="0">
            <tr>
                <td><em>Special Interest: </em></td>
                <td>
                <input type="text" name="interest" id="textfield" value="<?php echo $interest; ?>" required="required" /></td>
              </tr>
            <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
            <tr>
                <td width="138"><em>Branch:  </em></td>
                <td><select id="Field7" name="branch" class="field select addr" tabindex="18" >
<option value="Information Technology" selected="selected">Information Technology</option>
<option value="Computer Science" >Computer Science</option>
<option value="Electronics Engineering" >Electronics Engineering</option>
<option value="Electronics and Telecommunication" >Electronics and Telecommunication</option>
<option value="Electrical Engineering" >Electrical Engineering</option>
<option value="Mechanical Engineering" >Mechanical Engineering</option>
<option value="Civil Engineering" >Civil Engineering</option>
<option value="Computer Engineering" >Computer Engineering</option>
<option value="Computer Technology">Computer Technology</option>
</select></td>
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><em>Select Profession:  </em></td>
                <td><select id="Field7" name="profession" class="field select addr" tabindex="18" >
<option value="student"  selected>Student</option>
<option value="teacher" >Teacher</option>
</select></td>
              </tr>
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><em>Select College:</em></td>
                <td><select id="Field7" name="college" class="field select addr" tabindex="18" >
<option value="VNIET" selected="selected">VNIET</option>
<option value="GNIET" >GNIET</option>
<option value="GNIEM" >GNIEM</option>
<option value="S.B.JAIN" >S.B.JAIN</option>
<option value="JD" >JD</option>
<option value="NIT" >NIT</option>
<option value="RKNEC" >RKNEC</option>
<option value="YCCE" >YCCE</option>
<option value="G.H.Raisoni" >G.H.Raisoni</option>
</select></td>
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