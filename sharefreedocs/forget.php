<?php 
session_start();
if (isset($_SESSION["manager"])) {
    header("location:main.php"); 
    exit();
}
?>

<?php 
if (isset($_POST["email"])) 
{
include "functions/connect_to_mysql.php"; 
	$email =$_POST["email"];
   
    $sql_check = mysql_query("SELECT * FROM register WHERE email='$email' LIMIT 1"); 
    // ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    $exist_Count = mysql_num_rows($sql_check); // count the row nums
    if ($exist_Count == 1) { // evaluate the count
	     while($row = mysql_fetch_array($sql_check)){ 
             $username = $row["username"];
			 $password = $row["password"];
			 $firstname = ucfirst($row["firstname"]);
			 $lastname = ucfirst($row["lastname"]);
			 $fullname = $firstname." ".$lastname;
		 }
		 $subject = "Your account details for login from ShareFreeDocs";
		$message = $fullname.",

Your account details are as follows 
		Username : ".$username."
		Password : ".$password;	 
		 include "functions/functions.php";
		 email($email,$subject,$message);
		 echo "<script language=javascript> alert(' Username and Password is send to your Email-id ') </script>";
		 echo "<script>window.location = 'index.php';</script>";
         exit();
    } else {
		echo "<script language=javascript> alert(' Email-id does not exist in database...!!! ') </script>";
		echo "<script>window.location = 'forget.php';</script>";
		exit();
	}
}
?>

<!doctype html>

<head>

	<!-- Basics -->
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>ShareFreeDocs</title>

	<!-- CSS -->
	
	<link rel="stylesheet" href="csslogin/reset.css">
	<link rel="stylesheet" href="csslogin/animate.css">
	<link rel="stylesheet" href="csslogin/styles.css">
	
</head>

	<!-- Main HTML -->
	
<body>
	
	<!-- Begin Page Content -->
	
	<div id="container">
		
		<form action="forget.php" method="post" >
		
		<label for="name">Email-id:</label>
		
		<input type="name" name="email" required autofocus>
		
		<br>
        <br>
        <label style=" margin-left:10px; margin-right:10px">Enter your Email-id above password will be send to your Email-id.</label>
		<br>
		
		<br>
		<div id="lower">
		
				
		<input type="submit" value="Submit" align="middle" >
		
		</div>
		
		</form>
		
	</div>
	
	
	<!-- End Page Content -->
	
</body>

</html>