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

<?php include('header.php')?>   
        <div id="content">
        	
           
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
$numberOfRows = mysql_num_rows(mysql_query('SELECT * FROM upload where approved = 1 OR approved = 2'));
if($numberOfRows == 0){
	echo "<h3> There is no recent upload by users.!!!";
}
else
{
$totalPages = ceil($numberOfRows / $resultsPerPage);


$sql = mysql_query("SELECT * FROM upload where approved = 1 OR approved = 2 LIMIT $startResults, $resultsPerPage");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $uid = $row["uid"];
			 $filename = ucfirst($row["filename"]);
			 $uploaderid = $row["uploaderid"];
			 $approved = $row["approved"];
			 
			 $date = strftime("%b %d, %Y", strtotime($row["uploaded"]));
			 if($approved == 1){
				 $status = "Approved";
				 }
				 else{
					 $status = "Denied";
					 }
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
          <div class="image_frame"><a href="profileview.php?pid='.$uploaderid.'"><img src="../aimage/'.$pic.'" width="110" height="110" alt="image 3" /></a></div>
            Uploaded by <a style="text-decoration:none;" href="profileview.php?pid='.$uploaderid.'">'.$fullname.'</a><br>
            Status : '.$status.' <br>
            uploaded on '.$date.'
			
            <a href="x_approve.php?uid='.$uid.'" class="read_more"></a><br><br>&nbsp;&nbsp;&nbsp;
			<a href="x_reject.php?uid='.$uid.'"><img align="right" src="images/reject.jpg"></a>
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
}
?>
		</div> 
        
        
  <?php include('footer.php')?>