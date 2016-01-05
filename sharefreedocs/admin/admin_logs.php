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
        	
           <table width="641" cellpadding="0" cellspacing="0" class="listing">
                        <tr>
                        	<th width="32">ID</th>
                            <th width="138">User Name</th>
                            <th width="116">E-mail id.</th>
                            <th width="127">Mobile no.</th>
                            <th width="105">Date Registered</th>
                            <th width="93">Last Date Login</th>
                        </tr>
                        <?php 
// This block grabs the whole list for viewing
$product_list = "";
$sql = mysql_query("SELECT * FROM admin ORDER BY last_login_date DESC");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["aid"];
			 $fname = ucfirst($row["firstname"]);
			 $lname = ucfirst($row["lastname"]);
			 $email = $row["email"];
			 $mobileno = $row["mobile"];
			 $date_registered = strftime("%b %d, %Y", strtotime($row["date_register"]));
			 $last_log_date = strftime("%b %d, %Y", strtotime($row["last_login_date"]));
			 echo'
			 <tr>
                            <td class="style1">'.$id.'</td>
                            <td><strong>'.$fname.' '.$lname.'</strong></td>
							<td>'.$email.'</td>
                            <td>'.$mobileno.'</td>
                            <td><em>Created on '.$date_registered.'</em></td>
                            <td><em>'.$last_log_date.'</em></td>
                        </tr>';
			 
    }
} else {
	$product_list = "You have no products listed in your store yet";
}
?>
                        
                        </table>
             
	  </div> 
        
        
  <?php include('footer.php')?>