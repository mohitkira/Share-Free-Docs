<?php 
session_start();
if (isset($_SESSION["managera"])) {
    header("location:index.php"); 
    exit();
}
?>
<?php 
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

	$managera = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); // filter everything but numbers and letters
    $passworda = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); // filter everything but numbers and letters
    // Connect to the MySQL database  
   include "../functions/connect_to_mysql.php";
    $sql = mysql_query("SELECT aid FROM admin WHERE username='$managera' AND password='$passworda' LIMIT 1"); // query the person
    // ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    $existCount = mysql_num_rows($sql); // count the row nums
    if ($existCount == 1) { // evaluate the count
	     while($row = mysql_fetch_array($sql)){ 
             $id = $row["aid"];
		 }
		 $_SESSION["ida"] = $id;
		 $_SESSION["managera"] = $managera;
		 $_SESSION["passworda"] = $passworda;
		 $query="UPDATE admin SET last_login_date = now() WHERE aid ='".$id."'";

$sql = mysql_query($query) or die (mysql_error());
		 header("location:index.php");
         exit();
    } else {
		echo "<script language=javascript> alert(' The Information you have entered is Incorrect!!!! ') </script>";
	echo "<script>window.location = 'index.php';</script>";
	}
}
?>
<!doctype html>

<head>

	<!-- Basics -->
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Login</title>

	<!-- CSS -->
	
	<link rel="stylesheet" href="csslogin/reset.css">
	<link rel="stylesheet" href="csslogin/animate.css">
	<link rel="stylesheet" href="csslogin/styles.css">
	
</head>

	<!-- Main HTML -->
	
<body>
	
	<!-- Begin Page Content -->
	
	<div id="container">
		
		<form action="admin_login.php" method="post" enctype="multipart/form-data">
		
		<label for="name">Username:</label>
		
		<input type="name" name="username" required autofocus>
		
		<label for="username">Password:</label>
		
		<p><a href="forget.php">Forgot your password?</a>
		
		<input type="password" name="password" required>
		
		<div id="lower">
		
		
		
		<input type="submit" value="Login">
		
		</div>
		
		</form>
		
	</div>
	
	
	<!-- End Page Content -->
	
</body>

</html>
	
	
	
	
	
		
	