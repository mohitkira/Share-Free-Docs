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
        
    <div id="templatemo_middle">
    
    	<a href="main.php" target="_parent"><img src="images/documents.jpg" alt="Free Template" /></a>
        
<div id="mid_title">
        	Welcome to ShareFreeDocs</div>
            
        <p>A place where you can upload and download documents freely</p>
        
        <div id="learn_more"><a href="about.html"></a></div>
        
        <div class="cleaner"></div>
        
	</div> <!-- end of middle -->
    
    <div id="templatemo_fp_services">
    
<div class="fp_services_box">
            <div class="fps_title"><a href="#">Lecturer Notes</a></div>
            <p>These are Notes uploaded by lectures and experts.</p>
            <a href="view_teacher.php" class="sb_more">View</a>
        </div>
        
        <div class="fp_services_box">
            <div class="fps_title"><a href="#">Students Notes</a></div>
            <p>These are Notes uploaded by Students.</p>
            <a href="view_student.php" class="sb_more">View</a>
        </div>
        
        <div class="fp_services_box l_box">
            <div class="fps_title"><a href="#">Interactive Media</a></div>
            <p>News, Events and other activities in different college.</p>
            <a href="all_events_view.php" class="sb_more">View</a>
        </div>
    
    </div> <!-- end of templatemo fp services -->
    
    <div id="templatemo_main">
    
    	<div class="col_w620 float_r"> 
           <?php
if(isset($_GET['page']))
{	
$page = (int) $_GET['page'];
if ($page < 1) $page = 1;
}
else
{
	$page = 1;
	}
$resultsPerPage = 6;
$startResults = ($page - 1) * $resultsPerPage;
$numberOfRows = mysql_num_rows(mysql_query('SELECT * FROM upload where approved = 1 AND group_restricted = 0 AND uploaderid!='.$managerID.''));
$totalPages = ceil($numberOfRows / $resultsPerPage);


$sql = mysql_query("SELECT * FROM upload where approved = 1 AND group_restricted = 0 AND uploaderid!=$managerID LIMIT $startResults, $resultsPerPage");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $uid = $row["uid"];
			 $filename = ucfirst($row["filename"]);
			 $uploaderid = $row["uploaderid"];
			 $date = strftime("%b %d, %Y", strtotime($row["uploaded"]));
$sql1 = mysql_query("SELECT * FROM register WHERE rid='$uploaderid' LIMIT 1");
	$productCount1 = mysql_num_rows($sql1);
	if ($productCount1 > 0) {
	while($row = mysql_fetch_array($sql1)){ 
             $firstname = ucfirst($row["firstname"]);
			 $lastname = ucfirst($row["lastname"]);
			 $pic = $row["pic"];
			 $fullname = $firstname.' '.$lastname; }	}	 
			 echo '<div class="p_box">
			 <br>
			 <a style="text-decoration:none;" href="docview.php?uid='.$uid.'"><h3 style="color: #3d8e7d;  font-size: 20spx">'.$filename.'</h3></a>
          <div class="image_frame"><a href="profileview.php?pid='.$uploaderid.'"><img src="aimage/'.$pic.'" width="110" height="110" alt="image 3" /></a></div>
            Uploaded by <a style="text-decoration:none;" href="profileview.php?pid='.$uploaderid.'">'.$fullname.'</a><br>
            Access : Public <br>
            uploaded on '.$date.'
			
            <a href="docview.php?uid='.$uid.'" class="read_more"></a>
          <div class="cleaner"></div> 
		  </div>';
		  	}
	}
	echo "<br><center>";
	echo '<a href="?page=1">First</a>&nbsp';

if($page > 1)
	echo '<a href="?page='.($page - 1).'">Back</a>&nbsp';

for($i = 1; $i <= $totalPages; $i++)
{
	if($i == $page)
		echo '<strong>'.$i.'</strong>&nbsp';
	else
		echo '<a href="?page='.$i.'">'.$i.'</a>&nbsp';
}

if ($page < $totalPages)
	echo '<a href="?page='.($page + 1).'">Next</a>&nbsp;';

echo '<a href="?page='.$totalPages.'">Last</a>';
echo "</center>";
?> 

        	
            
      <p><em> </em></p>
          	
            <p align="justify"></p>
          
          	<div class="cleaner h10"></div>
            
            <ul class="tmo_list float_l">
            	
		  	</ul>
            
            <ul class="tmo_list float_r">
               
		  	</ul>
            
            <div class="cleaner"></div>
            
            
            
      </div>
        
        <div class="col_w300 float_l">
          <h3>People you may know</h3>
<?php include "sidebar_friends.php"; ?>
          	<a class="more" href="all_friends_view.php">View All</a>
        </div>
        
        <div class="cleaner"></div>
    </div> <!-- end of main -->
	<?php include('footer.php')?>