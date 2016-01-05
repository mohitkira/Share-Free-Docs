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


<?php include('header.php')?>
    
    <div id="templatemo_main">
    
    	<div class="col_w620 float_l">
<h2 align="center">Upload</h2>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p> 



      <table align="center">
      <tr>
      <td width="219"><a href="docs_upload_page.php">
      <img src="images/Books.jpg" width="215" height="185" />
      </a>
      </td>
      <td width="33">
      </td>
      <td width="215"><a href="group_doc_upload_page.php">
      <img src="images/group_upload_pic.jpg"  width="215" height="185"/>
     </a> </td>
      </tr> 
      <tr>
      <td align="center"><a href="docs_upload_page.php"><B >Upload the Notes</B>
      </a>
      </td>
      <td>
      </td>
      <td align="center"><a href="group_doc_upload_page.php"><B>Upload the notes within group</B></a>
      </td>
      </tr>  
      <tr>
      <td>&nbsp;
      </td>
      </tr>    
      <tr>
      <td colspan="3" align="center">
      <a href="upload_event_page.php">
      <img src="images/socialmedia.jpg"  width="215" height="185"/>
     </a>
      </td>
      </tr>
      
      <tr>
      <td align="center" colspan="3"><a href="upload_event_page.php"><B>Post the Events</B></a>
      </td>
      </tr>
      </table>     
      
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