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
if (isset($_GET['pid']))
{
	$rid = $_GET['pid'];
$sql = mysql_query("SELECT * FROM register where rid='$rid'");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) 
		{
	while($row = mysql_fetch_array($sql))
				{ 
			 $firstname = ucfirst($row["firstname"]);
			 $lastname = ucfirst($row["lastname"]);
			 $sex = ucfirst($row["sex"]);
			 $email = ucfirst($row["email"]);
			 $mobile = ucfirst($row["mobile"]);
			  $profession = ucfirst($row["profession"]);
			   $collegename = ucfirst($row["collegename"]);
			    $branch = ucfirst($row["branch"]);
				 $city = ucfirst($row["city"]);
				  $mobile = ucfirst($row["mobile"]);
				  
			 $fullname = $firstname.' '.$lastname;
			 $pic = $row["pic"];
			 $date = strftime("%b %d, %Y", strtotime($row["date_register"]));
			 
			 	}
		}
		
}
?> 
<?php include('header.php')?>   
        <div id="content">
        	
           <h2 align="center"><?php echo $fullname; ?></h2>
            
            <div class="image_wrapper fl_img"><a href="#"><img src="../aimage/<?php echo $pic; ?>" alt="Profile Picture" width="180" height="180"/></a></div>
           <div style=" font-size: 16px"> <table  border="0" align="right">
             
			 
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td width="120">Name:</td>
                <td width="300"><?php echo $firstname; ?></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td>Date of Birth:</td>
                <td><?php echo $date; ?></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td >Sex:</td>
                <td ><?php echo $sex; ?></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td >E-mail:</td>
                <td ><?php echo $email; ?></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td >Mobile:</td>
                <td ><?php echo $mobile; ?></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td >Profession:</td>
                <td ><?php echo $profession; ?></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td >College Name:</td>
                <td ><?php echo $collegename; ?></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td >Branch:</td>
                <td ><?php echo $branch; ?></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td >City:</td>
                <td ><?php echo $city; ?></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
             
              </table>
            
            </div>
            <div class="cleaner_h40"></div>
             
		</div> 
        
        
  <?php include('footer.php')?>