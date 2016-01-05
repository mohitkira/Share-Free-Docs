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

<?php include('header.php')?>
    
    <div id="templatemo_main">
    
    	<div class="col_w620 float_l">
<h2>Account Information</h2>
            <img src="aimage/<?php echo $pic; ?>" class="image_wrapper image_fr" alt="about us" width="160" height="160" />
            
          
            <table  border="0">
             
			  <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2">To change Academic Info. <a href="academicinfo.php">Click here</a></td>
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2">To change Personal details <a href="personalinfo.php">Click here</a></td>
              </tr>
              <tr>
                <td width="112"><p align="justify">&nbsp;</p></td>
                <td width="178">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2">To change Address detail <a href="addressaccount.php">Click here</a></td>
              </tr>
              </table>
               <form action="x_profilepicture.php" method="post"
enctype="multipart/form-data">    
<table  border="0" align="right">
  <tr>
    <td colspan="2">Change the profile picture:</td>
  </tr>
  <tr>
    <td>
    
    <input type="file" name="file" id="file"></td>
    <td>
      
<input type="submit" name="submit" value="Upload">
    </td>
  </tr>
  
</table></form>
              <table  border="0">
              <tr>
                <td width="112"><p align="justify">&nbsp;</p></td>
                <td width="178">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2">To change Password  <a href="passwordchange.php">Click here</a></td>
              </tr>
              <tr>
                <td ><p align="justify">&nbsp;</p></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
              <td colspan="2">To view the Uploaded file <a href="user_doc_view.php">Click here</a></td>
             </tr>
             <tr>
                <td ><p align="justify">&nbsp;</p></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
              <td colspan="2">To create a group <a href="create_group.php">Click here</a></td>
             </tr>
          </table>
          
     
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