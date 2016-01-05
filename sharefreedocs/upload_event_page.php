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
if(isset($_POST['eventname']))
{
	$name = $_FILES["file"]["name"];
		$filename = mysql_real_escape_string($_POST['eventname']);
		$desc = mysql_real_escape_string($_POST['desc']);
		$college = mysql_real_escape_string($_POST['college']);
		$date = mysql_real_escape_string($_POST['edate']);
$ext1 = pathinfo($name, PATHINFO_EXTENSION);
include "functions/connect_to_mysql.php"; 
if($ext1 == "jpg" || $ext1 == "png" || $ext1 == "gif" || $ext1 == "jpeg" || $ext1 == "bmp" || $ext1 == "png" || $ext1 == "tif" || $ext1 == "tiff" || $ext1 == "yuv" || $ext1 == "JPG" || $ext1 == "JPEG" )
{
	$sql = mysql_query("INSERT INTO events(eventname, uploaderid, description, collegename, date_of_event, date_upload) VALUES('$filename','$managerID','$desc','$college','$date',now())") or die (mysql_error());
	
     $uid = mysql_insert_id();
	$newname = "$uid.$ext1";
	move_uploaded_file( $_FILES['file']['tmp_name'], "events/$newname");
	$sql = mysql_query("UPDATE events SET fullname='$newname' WHERE eid='$uid'");
	echo "<script language=javascript> alert(' Information Updated Successfully ') </script>";
	echo "<script>window.location = 'main.php';</script>";	 

}
 else
 {
	echo "<script language=javascript> alert(' Please select a document or compressed file to upload..!!! ') </script>"; 
	echo "<script>window.location = 'uploadpage.php';</script>";
	 }
 }
?>
<?php 

    $sql = mysql_query("SELECT * FROM register WHERE rid='$managerID' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             
			 $pic = $row["pic"];
			         }
    } 

?>

<?php include('header.php')?>
    
    <div id="templatemo_main">
    
    	<div class="col_w620 float_l">
<h2>Events Details</h2> 
            <img src="aimage/<?php echo $pic; ?>" class="image_wrapper image_fr" alt="about us" width="160" height="160" />
            
          <form action="eventpage.php" method="post" enctype="multipart/form-data">
            <table  border="0">
              <tr>
                <td width="112" ><em>Event Name: </em></td>
                <td width="196" >
                  <input type="text" name="eventname" id="eventname"  />                </td>
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><em>Description:</em></td>
                <td>
                <textarea name="desc" id="textarea" cols="35" rows="5"></textarea></td>
              </tr>
              
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
              <td>
              <em>Date of Event: </em>
              </td>
                <td ><input type="date" name="edate" id="edate" /></td>
               
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
              <td>
              <em>Name of College:</em></td>
                <td ><input type="text" name="college" /></td>
               
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
              <td>
              <em>Select the Pic. of Event:</em>
              </td>
                <td  align="center"><em>
                  <input type="file" name="file" id="file" />
                </em></td>
               
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="138">&nbsp;</td>
                <td width="170"><input type="submit" name="button2" id="button2" value="Upload" /></td>
              </tr>
             
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td></td>
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