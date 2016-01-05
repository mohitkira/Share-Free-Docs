<?php
function email($to,$subject,$message)
{
	 require_once "Mail.php";
	 $from = "ShareFreeDocs <mohit@aimorigami.com>";
	 $host = "localhost";
	 $username = "mohit@aimorigami.com";
	 $password = "mohit12345";
	 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);
 $smtp = Mail::factory('smtp',
   array ('host' => $host,
     'auth' => true,
     'username' => $username,
     'password' => $password));
 
 $mail = $smtp->send($to, $headers, $message);
 }


?>