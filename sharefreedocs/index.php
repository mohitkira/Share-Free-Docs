<?php 
session_start();
if (isset($_SESSION["manager"])) {
    header("location:main.php"); 
    exit();
}
?>
<?php 
if (isset($_SESSION["manager"])) {
// Be sure to check that this manager SESSION value is in fact in the database
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["rid"]); // filter everything but numbers and letters
$managername = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); // filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters
// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  
include "functions/connect_to_mysql.php"; 
$sql = mysql_query("SELECT rid FROM register WHERE username='$managername' AND password='$password' AND confirm='1' LIMIT 1"); // query the person
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
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

	$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); // filter everything but numbers and letters
    $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); 
	
   include "functions/connect_to_mysql.php";
    $sql = mysql_query("SELECT * FROM register WHERE username='$manager' AND password='$password' AND confirm='1' LIMIT 1"); 
    // ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    $existCount = mysql_num_rows($sql); // count the row nums
    if ($existCount == 1) { // evaluate the count
	     while($row = mysql_fetch_array($sql)){ 
             $rid = $row["rid"];
			 $profession_name = $row["profession"];
		 }
		 $_SESSION["rid"] = $rid;
		 $_SESSION["manager"] = $manager;
		 $_SESSION["password"] = $password;
		 $_SESSION["profession"] = $profession_name;
		 $sql = mysql_query("UPDATE register SET last_log_date = NOW() WHERE rid ='$rid'");
		 echo "<script>window.location = 'main.php';</script>";
         exit();
    } else {
		echo "<script language=javascript> alert(' That information is incorrect, try again ') </script>";
		echo "<script>window.location = 'index.php';</script>";
		exit();
	}
}
?>

<!doctype html>

<head>

	<!-- Basics -->
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>ShareFreeDocs Login</title>

	<!-- CSS -->
	
	<link rel="stylesheet" href="csslogin/reset.css">
	<link rel="stylesheet" href="csslogin/animate.css">
	<link rel="stylesheet" href="csslogin/styles.css">
	
</head>

	<!-- Main HTML -->
	
<body>
	
	<!-- Begin Page Content -->
	
	<div id="container">
		
		<form action="index.php" method="post" enctype="multipart/form-data">
		
		<label for="name">Username:</label>
		
		<input type="name" name="username" required autofocus>
		
		<label for="username">Password:</label>
		
		<p><a href="forget.php">Forgot your password?</a>
		
		<input type="password" name="password" required>
		
		<div id="lower">
		
		<label class="check" for="checkbox">You don't have an account yet? <a href="register.php">Register here</a></label>
		
		<input type="submit" value="Login">
		
		</div>
		
		</form>
		
	</div>
	
	
	<!-- End Page Content -->
	
</body>

</html>