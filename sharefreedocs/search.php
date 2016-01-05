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
 /*$sql = mysql_query("SELECT * FROM register WHERE rid='$managerID' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
			 $pic = $row["pic"];
			         }
    } 
*/
?>

<?php include('header.php')?>
    
    <div id="templatemo_main">
    
    	<div class="col_w620 float_l">
<h2>Search</h2>
            <?php
 if (isset($_POST['keyword']))
 {
 $search=$_POST['keyword'];
//query details table begins
$sql_search = mysql_query("SELECT * FROM register WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%' AND rid!=$managerID LIMIT 0, 15");

	$productCount1 = mysql_num_rows($sql_search);
	if ($productCount1 > 0) {
	while($row = mysql_fetch_array($sql_search)){ 
			 $rid = ucfirst($row["rid"]);
             $firstname = ucfirst($row["firstname"]);
			 $lastname = ucfirst($row["lastname"]);
			 $profession = ucfirst($row["profession"]);
			 $branch = ucfirst($row["branch"]);
			 $date_register = ucfirst($row["date_register"]);
			 $pic = $row["pic"];
			 $fullname = $firstname.' '.$lastname; }	 
			 echo '<div class="p_box">
			 <br>
			 <a style="text-decoration:none;" href="profileview.php?pid='.$rid.'"><h3 style="color: #3d8e7d;  font-size: 20spx">'.$fullname.'</h3></a>
          <div class="image_frame"><a href="profileview.php?pid='.$rid.'"><img src="aimage/'.$pic.'" width="110" height="110" alt="image 3" /></a></div>
           Profession : '.$profession.' <br>
            Branch : '.$branch.' <br>
            Registered on '.$date_register.'
			
            
          <div class="cleaner"></div> 
		  </div>';
			
    
}  else {
	$display="No search result found.";
}
 }
 else
 {
	$display="Please enter text in search box";
	 	 }?>
            
          
           
           
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