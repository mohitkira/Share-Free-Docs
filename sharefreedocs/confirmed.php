
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
          <p>
            <!--<img src="aimage/<?php echo $pic; ?>" class="image_wrapper image_fr" alt="about us" width="160" height="160" />--></p>
         <?php
		 include "functions/connect_to_mysql.php";
		 if (isset($_GET['chid'])) {
	$targetID = $_GET['chid'];
$sql = mysql_query("UPDATE register SET confirm='1' WHERE rid='$targetID'");
echo '<font face="Comic Sans MS, cursive" size="+1">Thank you for registeration!!!! You can login by clicking <a href="index.php"><font face="Comic Sans MS, cursive" size="+1">here</font></a></font>';
}
?>

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