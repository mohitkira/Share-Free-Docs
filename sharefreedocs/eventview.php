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

if (isset($_GET['eid']))
{
	$eid = $_GET['eid'];
$sql = mysql_query("SELECT * FROM events where eid=$eid");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) 
		{
	while($row = mysql_fetch_array($sql))
				{ 
			 $filename = ucfirst($row["eventname"]);
			 $description = $row["description"];
			 $uploaderid = $row["uploaderid"];
			  $collegename = $row["collegename"];
			 $path = $row["fullname"];
			 $date_of_event = strftime("%b %d, %Y", strtotime($row["date_of_event"]));
			 $date = strftime("%b %d, %Y", strtotime($row["date_upload"]));
$sql23 = mysql_query("SELECT * FROM register where rid='$uploaderid'");
$productCount23 = mysql_num_rows($sql23); // count the output amount
if ($productCount23 > 0) 
		{
	while($row = mysql_fetch_array($sql23))
				{ 
			 $firstname = ucfirst($row["firstname"]);
			 $lastname = ucfirst($row["lastname"]);
			 $fullname = $firstname.' '.$lastname;
			 $profession = ucfirst($row["profession"]);
			
			 	}
		}			 
			 	}
		}
}
?> 

<?php include('header.php')?>
    
    <div id="templatemo_main">
    
    	<div class="col_w620 float_l">
<h2><?php echo $filename; ?></h2>
<br>
<table  border="0">
             
		  
              <tr>
                <td >Event Name is :</td>
                <td> <?php echo $filename; ?> </td>
              </tr>
              <tr>
                <td><p align="justify">&nbsp;</p></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td >Date of Event :</td>
                <td> <?php echo $date_of_event ; ?></a> </td>
              </tr>
              <tr>
                <td width="112"><p align="justify">&nbsp;</p></td>
                <td width="370">&nbsp;</td>
              </tr>
              <tr>
                <td >Uploaded by :</td>
                <td><a href="profileview.php?pid=<?php echo $uploaderid; ?>"> <?php echo $fullname ; ?></a> </td>
              </tr>
              <tr>
                <td width="112"><p align="justify">&nbsp;</p></td>
                <td width="370">&nbsp;</td>
              </tr>
              <tr>
                <td>description :</td>
                <td><?php echo $description; ?></td>
              </tr>
              <tr>
                <td width="112"><p align="justify">&nbsp;</p></td>
                <td width="370">&nbsp;</td>
              </tr>
              <tr>
                <td>Uploaded on :</td>
                <td><?php echo $date; ?></td>
              </tr>
              <tr>
                <td width="112"><p align="justify">&nbsp;</p></td>
                <td width="370">&nbsp;</td>
              </tr>
              <tr>
                <td>Profession :</td>
                <td><?php echo $profession; ?></td>
              </tr>
              <tr>
                <td width="112"><p align="justify">&nbsp;</p></td>
                <td width="370">&nbsp;</td>
              </tr>
              <tr>
                <td>Event at :</td>
                <td><?php echo $collegename; ?></td>
              </tr>
              <tr>
                <td width="112"><p align="justify">&nbsp;</p></td>
                <td width="370">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="center"> To View the poster of Event <a href="events\<?php echo $path; ?>"> Click Here</a></td>
              </tr>
              <tr>
              <td colspan="2" align="center">&nbsp;</td>
              </tr></table>
               
             
          
     
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