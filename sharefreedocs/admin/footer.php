	</div> <!-- end of content -->
<div id="sidebar">

		<div class="templatemo_sitebar_top"></div>
        
        <div class="templatemo_sitebar">
        	<div id="site_title">
            
                <h1><a href="index.php" target="_parent"><img src="images/templatemo_logo.jpg" alt="logo" width="200" height="52" />
                	<span>Admin page</span></a></h1>
                
            </div> <!-- end of site_title -->
        </div>
        <div class="templatemo_sidebar_bottom_01"></div>
        
        <div class="templatemo_sitebar">
        
        	<ul id="templatemo_menu">
                <li><a href="index.php">New Uploads</a></li>
                <li><a href="old_upload.php">Old Uploads</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="create_another_admin.php">Create Admin</a></li>
                <li><a href="change_password.php">Edit Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            
        </div>
        
        <div class="templatemo_sidebar_bottom_01"></div>
        
        <div class="templatemo_sitebar">
        
        	<h4>Last Admin Logged in</h4>
            <?php 
$sql = mysql_query("SELECT * 
FROM  admin 
ORDER BY  last_login_date DESC 
LIMIT 4");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	
	while($row = mysql_fetch_array($sql)){ 
             $aid = $row["aid"];
			 $firstname = ucfirst($row["firstname"]);
			 $lastname = ucfirst($row["lastname"]);
			 $full_admin_name=$firstname." ".$lastname;
			 $last_login_date = strftime("%b %d, %Y", strtotime($row["last_login_date"]));
           
		   echo ' <div class="news_box">
				<div class="date">'.$last_login_date.'</div>
                <p><strong>'.$full_admin_name.'</strong></p>
              
                
          </div>';
                       
	}}?>
            <div class="button float_r"><a href="admin_logs.php">View all..</a></div>
            
            <div class="cleaner"></div>
                    
        </div>
        <div class="templatemo_sidebar_bottom_02"></div>

    </div> <!-- end of sidebar -->
    
    <div class="cleaner"></div>
    
</div> <!-- end of template_wrapper -->

<div id="templatemo_footer_wrapper">
     <div id="templatemo_footer">

        Copyright &copy; 2013 <a href="main.php">ShareFreeDocs</a> - 
        Designed by <a href="https://www.facebook.com/mohithamgaonkar" target="_parent">Mohit Amgaonkar </a> ,<a href="https://www.facebook.com/gss786" target="_parent">gurdeep suri </a>,<a href="https://www.facebook.com/ashghatbandhe" target="_parent"> ashish ghatbandhe</a>
    
    </div> <!-- end of templatemo_footer -->
</div>

</body>
</html>