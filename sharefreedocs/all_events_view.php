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
<?php
include "functions/connect_to_mysql.php"; 
$sql = mysql_query("SELECT * FROM events ORDER BY eid DESC");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             $eid = $row["eid"];
			 $eventname = ucfirst($row["eventname"]);
			 $uploaderid = $row["uploaderid"];
			 $description = $row["description"];
			 $collegename = $row["collegename"];
			 $path = $row["fullname"];
			 $udate = strftime("%b %d, %Y", strtotime($row["date_of_event"]));
			        
$sql1 = mysql_query("SELECT * FROM register where rid=$uploaderid");
$productCount = mysql_num_rows($sql1); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql1)){ 
             $rid = $row["rid"];
			 $firstname = ucfirst($row["firstname"]);
			 $lastname = ucfirst($row["lastname"]);
			 $profession = ucfirst($row["profession"]);
			 $fullname = $firstname.' '.$lastname;
			 $pic = $row["pic"];
			 			 
			 echo '
			 
			 <div class="post_box">
            	<div class="post_header">
                    
                    <a style="text-decoration:none;" href="eventview.php?eid='.$eid.'"><h3 style="color: #3d8e7d;  font-size: 20spx">'.$eventname.'</h3></a>
				</div>
                <a href="eventview.php?eid='.$eid.'"><img  src="events/'.$path.'" height="350" width="350" alt="Image" /></a>
              <p>'.$description.'.</p>
                <a class="more" href="eventview.php?eid='.$eid.'">More</a>
				<p class="post_meta"><span class="cat">Posted by <a href="profileview.php?pid='.$rid.'">'.$fullname.'</a> From '.$collegename.'</span> | Date of Event: '.$udate.'</p>
                <div class="cleaner"></div>
            </div>
			 
			 ';
	}
	}
	 }
    } 
?> 
    
    
        	
            
        </div>
        
        <div class="col_w300 float_r">
        	
          
        	
            <h3>People you may know</h3>
            
            <?php include "sidebar_friends.php"; ?>
            
          	<a class="more" href="all_friends_view.php">View All</a>
            
            <div class="cleaner h30"></div>
            
            <div class="cleaner h30"></div>
            
            <?php include "advertise.php";?>
            
        </div>
        
        <div class="cleaner"></div>
    </div> <!-- end of main -->
	<?php include('footer.php')?>