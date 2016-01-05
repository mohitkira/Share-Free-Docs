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
if (isset($_GET['pid']))
{
	$rid = $_GET['pid'];
include "functions/connect_to_mysql.php"; 
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
		$querynewall= 'SELECT * FROM status'.$managerID.' where  friendid ='.$rid;
				$sql = mysql_query($querynewall);
				$existCount = mysql_num_rows($sql);
if ($existCount == 0) {
	 
}
else
{
	$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) 
		{
	while($row = mysql_fetch_array($sql))
				{ 
             $confirm = $row["confirm"];
			 $notification = $row["notification"];
				}
		}
	}
}
?> 

<?php include('header.php')?>
    
    <div id="templatemo_main">
    
    	<div class="col_w620 float_l">
<h2 align="center"><?php echo $fullname; ?></h2> 
            <img src="aimage/<?php echo $pic; ?>" class="image_wrapper image_fr" alt="Profile Picture" width="160" height="160" />
            
          
            <table  border="0">
             
			  <tr>
                <td  colspan="2" > 
               <?php 
			   if ($existCount == 0) {
				   
			   echo '<a href="x_add_as_friend.php?managerid='.$managerID.'&toadd='.$rid.'">
                <img src="images/addfriend.jpeg" width="20" height="20"  /> Send a Friend Request </a> </td>';
			   }
			   else
			   {
				   if($confirm==1)
				   {echo"<b>You are Friend with ".$fullname."</b>";}
				   else
				   {
					   if($notification=="1")
					   {
						    echo'<a href="x_confirm.php?managerid='.$managerID.'&toadd='.$rid.'"><br>Confirm</a> OR <a  href="x_reject.php?managerid='.$managerID.'&toadd='.$rid.'">Reject</a>';
					   }
					   else
					   {
						   echo"You have send ".$fullname." Friend Request";}
						   
				   }
				   }
				
				?>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td width="91">Name:</td>
                <td width="314"><?php echo $firstname; ?></td>
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
        
        <div class="col_w300 float_r">
        
        	<h3>People you may know</h3>
            
           <?php include "sidebar_friends.php"; ?>
            
          	<a class="more" href="all_friends_view.php">View All</a>
            
            <div class="cleaner h30"></div>
            
            <?php include "advertise.php"; ?>
            
        </div>
        
        <div class="cleaner"></div>
    </div> <!-- end of main -->
	<?php include('footer.php')?>