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
$sql = mysql_query("SELECT rid,group_id FROM register WHERE username='$manager' AND password='$password' AND confirm='1' LIMIT 1"); // query the person
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
if(isset($_POST["group_name"]))
{
	$group_name = $_POST["group_name"];
	$member = $_POST["members"]; 
	$count_no = count($member);
    $members_name = ""; 
 
    for($i=0; $i < $count_no; $i++)
    {
		$members_name .= $member[$i] . " ";
    }
	$queryverification = "SELECT gid FROM group_upload WHERE group_name='$group_name' LIMIT 1";
	$sql = mysql_query($queryverification);
	$productMatch = mysql_num_rows($sql); // count the output amount
    if ($productMatch > 0) {
		echo "<script language=javascript> alert(' Sorry Group name already exist!!! ') </script>";
	echo "<script>window.location = 'create_group.php';</script>";
	}
	else
	{
	
	$insert_query="INSERT INTO group_upload ( create_id, group_name, group_member, date_created) VALUES('$managerID','$group_name','$members_name',now())";
	$sql = mysql_query($insert_query) or die (mysql_error());
	$rid = mysql_insert_id();
	
	$sqlselect = mysql_query("SELECT group_id FROM register WHERE rid='$managerID' LIMIT 1");
	while($row = mysql_fetch_array($sqlselect)){ 
			 $group_id = $row["group_id"];
			         }
	$group_id .= $rid;				 
	$sqlupadatequery ="UPDATE  register SET  group_id =  '$group_id' WHERE  rid='$managerID' LIMIT 1 ;";
	$sql = mysql_query($sqlupadatequery) or die (mysql_error());
	for($i=0; $i < $count_no; $i++)
    {
		$sqlselect = mysql_query("SELECT group_id FROM register WHERE rid='$member[$i]' LIMIT 1");
		while($row = mysql_fetch_array($sqlselect)){ 
			 $group_id = $row["group_id"];
			         }
		$group_id .= $rid;	
		$sqlupadatequery ="UPDATE  register SET  `group_id` =  '$group_id' WHERE  rid = '$member[$i]' LIMIT 1 ;";
		$sql = mysql_query($sqlupadatequery) or die (mysql_error());
	echo "<script language=javascript> alert('Group ".$group_name ." is created.')</script>";
	 echo "<script>window.location = 'index.php';</script>";
    }
	
}
}



?>

<?php include('header.php')?>
    
    <div id="templatemo_main">
    
    	<div class="col_w620 float_l">
<h2 align="center">Create a Group</h2>
<form action="create_group.php" method="post" enctype="multipart/form-data">
          <table  border="0">
           <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td width="91">Group Name::</td>
                <td width="314"><input type="text" name="group_name" id="group_name" required="required" autofocus /></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td>Members:</td>
                <td><select name="members[]" multiple="multiple" size="10">
                    <?php
					
					function name($friendid)
					{
						$q="select * from register where rid=".$friendid;
						$statement1= mysql_query($q);
						$count =mysql_num_rows($statement1);
						if($count > 0)
						{
							while($tablerow = mysql_fetch_array($statement1))
							{
								$firstname = ucfirst($tablerow["firstname"]);
			 $lastname = ucfirst($tablerow["lastname"]);
			 $fullname = $firstname.' '.$lastname;
			 echo '<option value="'.$friendid.'">'.$fullname.'</option>';
								}
							
						}
					}
					$query= "SELECT * FROM status".$managerID." where confirm='1'";
                    $sql = mysql_query($query);
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) 
		{
	while($row = mysql_fetch_array($sql))
				{ 
			 $friendid = $row["friendid"];
			 echo $friendid;
			 name($friendid);
			  	}
		}
					
					?>
                    </select></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" colspan="2"><input type="submit" value="Create" /></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
             
              </table>
             
     </form>
        </div>
        
        <div class="col_w300 float_r">
        
        	<h3>People you may know</h3>
            
           <?php include "sidebar_friends.php"; ?>
            
          	<a class="more" href="all_friends_view.php">View All</a>
            
            <div class="cleaner h30"></div>
            
            <?php include"advertise.php"; ?>
            
</div>
        
        <div class="cleaner"></div>
    </div> <!-- end of main -->
	<?php include('footer.php')?>