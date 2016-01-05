<?php
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["rid"]);

$queryverify1="SELECT * FROM status".$managerID." WHERE notification=1";
$sql1 = mysql_query($queryverify1);
    $productCount1 = mysql_num_rows($sql1); // count the output amount
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>ShareFreeDocs</title>

<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>
</head>
<body>
<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">
	    
    <div id="templatemo_header">
    
        <div id="site_title">
          <h1>ShareFreeDocs</h1></div>
        
        <div id="search_box">
            <form action="search.php" method="post">
                <input type="text" value="Search" name="keyword" size="10" id="searchfield" title="searchfield" onfocus="clearText(this)" onblur="clearText(this)" />
            </form>
        </div>
        
    </div> <!-- end of templatemo header class="current" -->
    
    <div id="templatemo_menu">
        <ul>
            <li><a href="main.php" >Home</a></li>
            <li><a href="notification.php">Notification<?php
			if ($productCount1 > 0) {
	   echo "(".$productCount1.")";
    } 
			?></a></li>
            <li><a href="account.php" >Account</a></li>			<li><a href="uploadselect.php" >Upload</a></li>
            <li><a href="group_doc_view.php" >Group_doc</a></li>
            <li><a href="logout.php" class="last">Logout</a></li>
             
        </ul>    	
    </div> <!-- end of templatemo_menu -->