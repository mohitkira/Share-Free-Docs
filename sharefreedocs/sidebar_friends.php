<?php
include "functions/connect_to_mysql.php"; 
$jointquery="select * from register where rid!=".$managerID;
		$check_if_present=0;
		$counter_for_friends=0;
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
$productCount1 = mysql_num_rows($innersql); // count the output amount
if ($productCount1 > 0) {
	while($row1 = mysql_fetch_array($innersql)){ 
             $friendid = $row1["friendid"];
			 if($friendid == $rid){
				 $check_if_present=1;
				 }
				 
			 }}
			 if($check_if_present == 0)
			 {
				if($counter_for_friends<=3)
				{ 
			 echo '<div class="fp_news_box"><a href="profileview.php?pid='.$rid.'">
            	<img src="aimage/'.$pic.'" width="90" height="80" alt="News One" /></a>
                <h6><a href="profileview.php?pid='.$rid.'">'.$fullname.'</a></h6><a href="x_add_as_friend.php?managerid='.$managerID.'&toadd='.$rid.'">
                <img src="images/addfriend.jpeg" width="20" height="20"  />Add Friend</a>
                <div class="fp_news_date">'.$date.'</div>
                <div class="cleaner"></div>
            </div> ';}
			$counter_for_friends++;
	}
	}
}

?> 