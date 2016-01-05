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
        <style>
		th{
			background-color:#D8D8D8;
			}
		
		</style>
        <div id="content">
        	
           <h1 align="center" style="color:#66FF00">User Information</h1>
           <p align="center" style="color:#66FF00">&nbsp;</p>
            
                    <table cellpadding="0" cellspacing="1" border="1">
                        <tr>
                        	<th width="30">ID</th>
                            <th width="52">User Name</th>
                            <th width="47">E-mail id.</th>
                            <th width="65">Mobile no.</th>
                            <th width="41">Gender</th>
                            <th width="62">Profession</th>
                            <th width="59">College Name</th>
                            <th width="56">Branch</th>
                            <th width="79">Date Created</th>
                            <th width="59">City</th>
                            <th width="79">Last Date Login</th>
                        </tr>
                        <?php

$sql = mysql_query("SELECT * FROM register");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) 
		{
	while($row = mysql_fetch_array($sql))
				{ 
				$rid =$row["rid"];
			 $firstname = ucfirst($row["firstname"]);
			 $lastname = ucfirst($row["lastname"]);
			 $sex = ucfirst($row["sex"]);
			 $email = $row["email"];
			 $mobile = ucfirst($row["mobile"]);
			  $profession = ucfirst($row["profession"]);
			   $collegename = ucfirst($row["collegename"]);
			    $branch = ucfirst($row["branch"]);
				 $city = ucfirst($row["city"]);
				  $mobile = ucfirst($row["mobile"]);
				  
			 $fullname = $firstname.' '.$lastname;
			 $pic = $row["pic"];
			 $date = strftime("%b %d, %Y", strtotime($row["date_register"]));
			 
			 $last_log_date = strftime("%b %d, %Y", strtotime($row["last_log_date"]));
			 echo ' <tr>
                            <td align="center">'.$rid.'</td>
                            <td align="center"><a href="profileview.php?pid='.$rid.'"><strong>'.$fullname.'</strong></a></td>
							<td align="center">'.$email.'</td>
                            <td align="center">'.$mobile.'</td>
                            <td align="center">'.$sex.'</td>
                            <td align="center">'.$profession.'</td>
							<td align="center">'.$collegename.'</td>
							<td align="center">'.$branch.'</td>
							
                            <td align="center"><em>Created on '.$date.'</em></td>
                            <td align="center">'.$city.'</td>
                            <td align="center"><em>'.$last_log_date.'</em></td>
                        </tr>';
			 	}
		}

        ?>
                        
                    </table>
	</div> <!-- end of content -->

	<?php include('footer.php')?>