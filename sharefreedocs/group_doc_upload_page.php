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

    $sql = mysql_query("SELECT * FROM register WHERE rid='$managerID' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             
			 $pic = $row["pic"];
			 $profession = $row["profession"];
			 
			         }
    } 

?>
<?php

if(isset($_POST['filename']))
{
	$gid = $_POST["group"];
	$name = $_FILES["uploadedfile"]["name"];
		$filename = mysql_real_escape_string($_POST['filename']);
		$desc = mysql_real_escape_string($_POST['desc']);
		
		$rid = mysql_real_escape_string($_POST['thisID']);
		
		
		

$ext1 = pathinfo($name, PATHINFO_EXTENSION);
include "functions/connect_to_mysql.php"; 
if($ext1 == "djvu" || $ext1 == "epub" || $ext1 == "fb2" || $ext1 == "azw" || $ext1 == "azw" || $ext1 == "mobi" || $ext1 == "pdb" || $ext1 == "txt" || $ext1 == "pdb" || $ext1 == "pdf" || $ext1 == "ps" || $ext1 == "7z" || $ext1 == "s7z" || $ext1 == "rar" || $ext1 == "zip" || $ext1 == "zipx" || $ext1 == "ppt" )
{
	$sql = mysql_query("INSERT INTO upload (`filename` ,`description` ,`uploaderid` ,`profession`,`group_restricted` ,`uploaded`,`approved` ) VALUES ('$filename','$desc','$rid','$profession','1',NOW(),'1')") or die (mysql_error());

     $uid = mysql_insert_id();
	 $sqlgroup = mysql_query("SELECT document_id FROM group_upload WHERE gid='$gid'");
	 while($row = mysql_fetch_array($sqlgroup)){ 
             $document_id = $row["document_id"];
	 }
	 $document_id = $document_id." ".$uid ;
	 $sql = mysql_query("UPDATE group_upload SET document_id='$document_id' WHERE gid='$gid'");
	 
	$newname = "$uid.$ext1";
	move_uploaded_file( $_FILES['uploadedfile']['tmp_name'], "docs/$newname");
	$sql = mysql_query("UPDATE upload SET fullname='$newname' WHERE uid='$uid'");
	echo "<script language=javascript> alert(' Document uploaded successfully ') </script>";
	echo "<script>window.location = 'main.php';</script>";	 

}
 else
 {
	echo "<script language=javascript> alert(' Please select a document or compressed file to upload..!!! ') </script>"; 
	echo "<script>window.location = 'uploadpage.php';</script>";
	 }
 }
?>


<?php include('header.php')?>
    
    <div id="templatemo_main">
    
    	<div class="col_w620 float_l">
<h2>Upload Notes</h2> 
            <img src="aimage/<?php echo $pic; ?>" class="image_wrapper image_fr" alt="about us" width="160" height="160" />
            
          <form action="group_doc_upload_page.php" method="post" enctype="multipart/form-data" >
            <table  border="0">
            	<tr>
              <td>
              <em>Select the Group:</em>
              </td>
                <td  align="center">
                 <select autofocus name="group" size="10" style="width:90%;">
                 <?php
				 $sql_group_members = mysql_query("select group_name,gid from group_upload where create_id='$managerID'");
				 while($row = mysql_fetch_array($sql_group_members))
				 {
					 $id = $row["gid"];
					 $group_name = $row["group_name"];
					 echo '<option value="'.$id.'" >'.$group_name.'</option>';
					 }
                 ?>
                 </select>
                </td>
               
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
              <td>
              <em>Select the file:</em>
              </td>
                <td  align="center">
                  <input type="file" name="uploadedfile" id="uploadedfile">
                </td>
               
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="112" ><em>File Name: </em></td>
                <td width="196" >
                  <input type="text" name="filename" id="textfield"  />                </td>
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
                <td width="138"><input name="thisID" type="hidden" value="<?php echo $managerID; ?>" /></td>
                <td width="170"><input type="submit" name="submit" value="Upload"></td>
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