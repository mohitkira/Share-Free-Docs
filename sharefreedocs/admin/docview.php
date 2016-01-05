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

if (isset($_GET['uid']))
{
	$uid = $_GET['uid'];
$sql = mysql_query("SELECT * FROM upload where uid=$uid");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) 
		{
	while($row = mysql_fetch_array($sql))
				{ 
			 $filename = ucfirst($row["filename"]);
			 $description = $row["description"];
			 $uploaderid = $row["uploaderid"];
			 $path = $row["fullname"];
			 $date = strftime("%b %d, %Y", strtotime($row["uploaded"]));
			 
$sql23 = mysql_query("SELECT * FROM register where rid='$uploaderid'");
$productCount23 = mysql_num_rows($sql23); // count the output amount
if ($productCount23 > 0) 
		{
	while($row = mysql_fetch_array($sql23))
				{ 
			 $firstname = ucfirst($row["firstname"]);
			 $lastname = ucfirst($row["lastname"]);
			 $fullname = $firstname.' '.$lastname;
			  $collegename = $row["collegename"];
			 $profession = ucfirst($row["profession"]);
			
			 	}
		}			 
			 	}
		}
}
?> 
<?php include('header.php')?>   
        <div id="content">
        	<h2><?php echo $filename; ?></h2>
<br>
<table  border="0">
             
		  
              <tr>
                <td >File Name is :</td>
                <td> <?php echo $filename; ?> </td>
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td >Uploaded by :</td>
                <td><a href="profileview.php?pid=<?php echo $uploaderid; ?>"> <?php echo $fullname ; ?></a> </td>
              </tr>
              <tr>
                <td width="125"><p align="justify">&nbsp;</p></td>
                <td width="370">&nbsp;</td>
              </tr>
              <tr>
                <td>description :</td>
                <td><?php echo $description; ?></td>
              </tr>
              <tr>
                <td ><p align="justify">&nbsp;</p></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td>Uploaded on :</td>
                <td><?php echo $date; ?></td>
              </tr>
              <tr>
                <td ><p align="justify">&nbsp;</p></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td>Profession :</td>
                <td><?php echo $profession; ?></td>
              </tr>
              <tr>
                <td ><p align="justify">&nbsp;</p></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td>Uploader College Name :</td>
                <td><?php echo $collegename; ?></td>
              </tr>
              <tr>
                <td ><p align="justify">&nbsp;</p></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="center"><a href="read_document_view.php?uid=<?php echo $uid; ?>"><img src="images/file_view.jpg" width="44" height="44" ></a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a href="x_approve.php?uid=<?php echo $uid; ?>"><img src="images/approve_hand.gif" width="44"  height="44"></a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="x_reject.php?uid=<?php echo $uid; ?>"><img src="images/reject.jpg" width="44"  height="44"></a>
       </td></tr>
              <tr>
                <td ><p align="justify">&nbsp;</p></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="center"></td>  
              </tr>
              <tr>
                <td colspan="2" align="center"></td>  
              </tr>
              </table>
           
             
		</div> <!-- end of content wrapper -->

	<?php include('footer.php')?>