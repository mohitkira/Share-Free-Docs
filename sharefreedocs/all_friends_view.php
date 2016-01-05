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
    
    	<div style=" width: 940px; margin-bottom: 40px;">
<?php
	$jointquery="select * from register where rid!=".$managerID;;
		$check_if_present=0;
$sql = mysql_query($jointquery);
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $rid = $row["rid"];
			 $firstname = ucfirst($row["firstname"]);
			 $lastname = ucfirst($row["lastname"]);
			 $profession = ucfirst($row["profession"]);
			 $fullname = $firstname.' '.$lastname;
			 $pic = $row["pic"];
			 $date = strftime("%b %d, %Y", strtotime($row["date_register"]));
			$innerquery="select friendid from status".$managerID;
		$check_if_present = 0;
$innersql = mysql_query($innerquery);
$productCount = mysql_num_rows($innersql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($innersql)){ 
             $friendid = $row["friendid"];
			 if($friendid == $rid){
				 $check_if_present=1;
				 }
				 
			 }}
			 if($check_if_present == 0)
			 {
			 echo '<div style="margin-left: 140px;" class="p_box">
			 
			 <a style="text-decoration:none;" href="profileview.php?pid='.$rid.'"><h3 style="color: #3d8e7d;  font-size: 20spx">'.$fullname.'</h3></a>
          <div class="image_frame"><a href="profileview.php?pid='.$rid.'"><img src="aimage/'.$pic.'" width="110" height="110" alt="image 3" /></a></div>
            Profession: '.$profession.'<br>
            Registered on '.$date.'
			
            <a href="x_add_as_friend.php?managerid='.$managerID.'&toadd='.$rid.'" style="margin-right: 520px;" class="allfriendview_more"></a>
          <div class="cleaner"></div> 
		  </div><br>';
		}
	}
	}
	
?> 
        </div>
        
        
    </div> <!-- end of main -->
	<?php include('footer.php')?>