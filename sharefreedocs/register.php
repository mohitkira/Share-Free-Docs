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
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); // filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters
// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  
include "functions/connect_to_mysql.php"; 
$sql = mysql_query("SELECT rid FROM register WHERE username='$manager' AND password='$password' AND confirm='1' LIMIT 1"); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysql_num_rows($sql); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo "<script language=javascript> alert('Your login session data is not on record in the database.')</script>";
	 echo "<script>window.location = 'index.php';</script>";
     exit();
}
}
?>

<!DOCTYPE html>
<html>
<head>

<title>
Registration page
</title>

<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="generator" content="Wufoo">
<meta name="robots" content="index, follow">

<!-- CSS -->
<link href="css/structure.css" rel="stylesheet">
<link href="css/form.css" rel="stylesheet">

<!-- JavaScript -->
<script src="scripts/wufoo.js"></script>
<script >
// JavaScript Document
function validateForm()
{
var fname=document.forms["form69"]["fname"].value;
var lname=document.forms["form69"]["lname"].value;
var username=document.forms["form69"]["username"].value;
var password=document.forms["form69"]["password"].value;
var repassword=document.forms["form69"]["repassword"].value;
var mobile=document.forms["form69"]["mobile"].value;
if ((username.length < 5) || (username.length > 15))
{
	//document.getElementById("username").innerHTML="<font face='Georgia, Times New Roman, Times, serif' color='#FF1100'></font>";
	alert("Your Character must be 5 to 15 Character");
document.form69.username.select();
return false;
}
else
  {
  //document.getElementById("username").innerHTML=" ";
  }
  //validation for username	  
	  
	  
	  
if(password != repassword) {
	  alert("Password does not match..!!!");
  document.form69.password.focus();
  return false;
	  } 
  
	if(password.length < 5) {
		  
		alert("Password must contain at least five characters!");
        document.form69.password.focus();
        return false;
      }  

	//validation for password  
	  
	
			if(mobile.length==0) 
            {
                alert("Please enter cell number");
                document.form69.mobile.focus();
                return false;
            }
			
           if(isNaN(mobile))
              {
                 alert("Enter numeric value");
				 document.form69.mobile.focus();
                 return false; 
              }
			  
				  if (!(mobile.length == 10)) { 
alert("The phone number is the wrong length. \nPlease enter 10 digit mobile no."); 
document.form69.mobile.focus();
return false; 
} 
			
 
/* if(document.form69.college.selectedIndex==0)
{ 
//document.getElementById("college").innerHTML="<font face='Georgia, Times New Roman, Times, serif' color='#FF1100'></font>";
alert("Please select your college..!!");
document.login.type.select();
return false;
}*/
 
   
}
</script>
<!--[if lt IE 10]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body id="public">
<div id="container" class="ltr">

<h1 id="logo">

</h1>

<form id="form69" name="form69" class="wufoo topLabel page" enctype="multipart/form-data" method="post" onsubmit="return validateForm()"
action="x_register.php">

<header id="header" class="info">
<h2>Registration Form</h2>
<div>Personal Information</div>
</header>

<ul>

<li id="foli0" class="notranslate      ">
<label class="desc" id="title0" for="Field0">
Name<span id="req_2" class="req">*</span>
</label>
<span>
<input id="fname" name="fname" type="text" class="field text fn" value="" size="10" tabindex="1" required />
<label for="Field0">First</label>
</span>
<span>
<input id="lname" name="lname" type="text" class="field text ln" value="" size="20" tabindex="2" required/><b id="name"></b>
<label for="Field1">Last</label>
</span>
</li>
<li id="foli0" class="notranslate      ">
<label class="desc" id="title0" for="Field0">
Username<span id="req_2" class="req">*</span>
</label>
<span>
<input id="username" name="username" type="text" class="field text fn" value="" size="18" tabindex="1" required/><b id="username"></b>
<label for="Field0">  Enter 5 to 15 Character</label>
</span>
</li>
<li id="foli0" class="notranslate      ">
<label class="desc" id="title0" for="Field0">
Password<span id="req_2" class="req">*</span>
</label>
<span>
<input id="password" name="password" type="password" class="field text fn" value="" size="18" tabindex="1" required/>

<label for="Field0">type</label>
</span>
<span>
<input id="repassword" name="repassword" type="password" class="field text fn" value="" size="18" tabindex="1" required/><b id="password"></b>
<label for="Field0">Retype</label>
</span>
</li>
<li id="foli0" class="notranslate      ">
<label class="desc" id="title0" for="Field0">
Sex</label>
<span>
<input id="Field0" name="sex" type="radio" class="field text fn" value="male" size="18" tabindex="1" checked /> &nbsp; 
Male&nbsp;
<input id="Field0" name="sex" type="radio" class="field text fn" value="female" size="18" tabindex="1" /> &nbsp; Female
</span>
</li>
<li id="foli0" class="notranslate      ">
<label class="desc" id="title0" for="Field0">
Date of Birth<span id="req_2" class="req">*</span>
</label>
<span>
<input type="date" name="dob" id="dob" required/><b id="dob"></b>
</span>
</li>

<li id="foli8" class="phone notranslate leftHalf     ">
<label class="desc" id="title8" for="Field8">
Mobile No.
<span id="req_2" class="req">*</span>
</label>
<span>
<input id="mobile" name="mobile" type="text" spellcheck="false" class="field text medium" value="" required />
<label for="Field0">
<b id="mobile"></b></label>
</li>
<li id="foli9" class="notranslate rightHalf     ">
<label class="desc" id="title9" for="Field9">
Email
<span id="req_9" class="req">*</span>
</label>
<div>
<input id="email" name="email" type="email" spellcheck="false" class="field text medium" value="" maxlength="255" tabindex="12" required /> <b id="email"></b><label for="Field0">
Please Enter Valid Email-id.</label>
</div>
</li>
<li id="foli11" class=" notranslate      ">
<div>
<label class="desc" id="title11" for="Field11">
Select Profession
</label><br>
<span class="left country">
<select id="Field7" name="profession" class="field select addr" tabindex="18" >
<option value="student"  selected>Student</option>
<option value="teacher" >Teacher</option>
</select>
</span>
</div></li>

<li id="foli11" class=" notranslate      ">
<div>
<label class="desc" id="title11" for="Field11">
Select College
  <span class="req">*</span></label>
<br>
<span class="left country">
<select id="college" name="college" class="field select addr" tabindex="18" >
<option value="VNIET" selected="selected">VNIET</option>
<option value="GNIET" >GNIET</option>
<option value="GNIEM" >GNIEM</option>
<option value="S.B.JAIN" >S.B.JAIN</option>
<option value="JD" >JD</option>
<option value="NIT" >NIT</option>
<option value="RKNEC" >RKNEC</option>
<option value="YCCE" >YCCE</option>
<option value="G.H. Raisoni" >G.H. Raisoni</option>
</select><b id="college"></b>
</span>
</div></li>
<li id="foli11" 
class="notranslate      ">
  <label class="desc" id="title11" for="Field11">
Address
</label>

<div>
<textarea id="Field11" 
name="address" 
class="field textarea medium" 
spellcheck="true" 
rows="10" cols="50" 
tabindex="20" 
onkeyup=""
 ></textarea>

</div>
<li id="foli2" class="complex notranslate      ">

<div>

<span class="left city">
<input id="Field4" name="city" type="text" class="field text addr" value="" tabindex="5"  />
<label for="Field4">City</label>
</span>
<span class="right state">
<input id="Field5" name="state" type="text" class="field text addr" value="" tabindex="6"  />
<label for="Field5">State / Province / Region</label>
</span>

<span class="right country">
<select id="Field7" name="country" class="field select addr" tabindex="8" >
<option value="United States" >United States</option>
<option value="United Kingdom" >United Kingdom</option>
<option value="Australia" >Australia</option>
<option value="Canada" >Canada</option>
<option value="France" >France</option>
<option value="New Zealand" >New Zealand</option>
<option value="India" selected="selected">India</option>
<option value="Brazil" >Brazil</option>
<option value="Afghanistan" >Afghanistan</option>
<option value="Åland Islands" >Åland Islands</option>
<option value="Albania" >Albania</option>
<option value="Algeria" >Algeria</option>
<option value="American Samoa" >American Samoa</option>
<option value="Andorra" >Andorra</option>
<option value="Angola" >Angola</option>
<option value="Anguilla" >Anguilla</option>
<option value="Antarctica" >Antarctica</option>
<option value="Antigua and Barbuda" >Antigua and Barbuda</option>
<option value="Argentina" >Argentina</option>
<option value="Armenia" >Armenia</option>
<option value="Aruba" >Aruba</option>
<option value="Austria" >Austria</option>
<option value="Azerbaijan" >Azerbaijan</option>
<option value="Bahamas" >Bahamas</option>
<option value="Bahrain" >Bahrain</option>
<option value="Bangladesh" >Bangladesh</option>
<option value="Barbados" >Barbados</option>
<option value="Belarus" >Belarus</option>
<option value="Belgium" >Belgium</option>
<option value="Belize" >Belize</option>
<option value="Benin" >Benin</option>
<option value="Bermuda" >Bermuda</option>
<option value="Bhutan" >Bhutan</option>
<option value="Bolivia" >Bolivia</option>
<option value="Bosnia and Herzegovina" >Bosnia and Herzegovina</option>
<option value="Botswana" >Botswana</option>
<option value="British Indian Ocean Territory" >British Indian Ocean Territory</option>
<option value="Brunei Darussalam" >Brunei Darussalam</option>
<option value="Bulgaria" >Bulgaria</option>
<option value="Burkina Faso" >Burkina Faso</option>
<option value="Burundi" >Burundi</option>
<option value="Cambodia" >Cambodia</option>
<option value="Cameroon" >Cameroon</option>
<option value="Cape Verde" >Cape Verde</option>
<option value="Cayman Islands" >Cayman Islands</option>
<option value="Central African Republic" >Central African Republic</option>
<option value="Chad" >Chad</option>
<option value="Chile" >Chile</option>
<option value="China" >China</option>
<option value="Colombia" >Colombia</option>
<option value="Comoros" >Comoros</option>
<option value="Democratic Republic of the Congo" >Democratic Republic of the Congo</option>
<option value="Republic of the Congo" >Republic of the Congo</option>
<option value="Cook Islands" >Cook Islands</option>
<option value="Costa Rica" >Costa Rica</option>
<option value="C&ocirc;te d'Ivoire" >C&ocirc;te d'Ivoire</option>
<option value="Croatia" >Croatia</option>
<option value="Cuba" >Cuba</option>
<option value="Cyprus" >Cyprus</option>
<option value="Czech Republic" >Czech Republic</option>
<option value="Denmark" >Denmark</option>
<option value="Djibouti" >Djibouti</option>
<option value="Dominica" >Dominica</option>
<option value="Dominican Republic" >Dominican Republic</option>
<option value="East Timor" >East Timor</option>
<option value="Ecuador" >Ecuador</option>
<option value="Egypt" >Egypt</option>
<option value="El Salvador" >El Salvador</option>
<option value="Equatorial Guinea" >Equatorial Guinea</option>
<option value="Eritrea" >Eritrea</option>
<option value="Estonia" >Estonia</option>
<option value="Ethiopia" >Ethiopia</option>
<option value="Faroe Islands" >Faroe Islands</option>
<option value="Fiji" >Fiji</option>
<option value="Finland" >Finland</option>
<option value="Gabon" >Gabon</option>
<option value="Gambia" >Gambia</option>
<option value="Georgia" >Georgia</option>
<option value="Germany" >Germany</option>
<option value="Ghana" >Ghana</option>
<option value="Gibraltar" >Gibraltar</option>
<option value="Greece" >Greece</option>
<option value="Grenada" >Grenada</option>
<option value="Guatemala" >Guatemala</option>
<option value="Guinea" >Guinea</option>
<option value="Guinea-Bissau" >Guinea-Bissau</option>
<option value="Guyana" >Guyana</option>
<option value="Haiti" >Haiti</option>
<option value="Honduras" >Honduras</option>
<option value="Hong Kong" >Hong Kong</option>
<option value="Hungary" >Hungary</option>
<option value="Iceland" >Iceland</option>
<option value="Indonesia" >Indonesia</option>
<option value="Iran" >Iran</option>
<option value="Iraq" >Iraq</option>
<option value="Ireland" >Ireland</option>
<option value="Israel" >Israel</option>
<option value="Italy" >Italy</option>
<option value="Jamaica" >Jamaica</option>
<option value="Japan" >Japan</option>
<option value="Jordan" >Jordan</option>
<option value="Kazakhstan" >Kazakhstan</option>
<option value="Kenya" >Kenya</option>
<option value="Kiribati" >Kiribati</option>
<option value="North Korea" >North Korea</option>
<option value="South Korea" >South Korea</option>
<option value="Kuwait" >Kuwait</option>
<option value="Kyrgyzstan" >Kyrgyzstan</option>
<option value="Laos" >Laos</option>
<option value="Latvia" >Latvia</option>
<option value="Lebanon" >Lebanon</option>
<option value="Lesotho" >Lesotho</option>
<option value="Liberia" >Liberia</option>
<option value="Libya" >Libya</option>
<option value="Liechtenstein" >Liechtenstein</option>
<option value="Lithuania" >Lithuania</option>
<option value="Luxembourg" >Luxembourg</option>
<option value="Macedonia" >Macedonia</option>
<option value="Madagascar" >Madagascar</option>
<option value="Malawi" >Malawi</option>
<option value="Malaysia" >Malaysia</option>
<option value="Maldives" >Maldives</option>
<option value="Mali" >Mali</option>
<option value="Malta" >Malta</option>
<option value="Marshall Islands" >Marshall Islands</option>
<option value="Mauritania" >Mauritania</option>
<option value="Mauritius" >Mauritius</option>
<option value="Mexico" >Mexico</option>
<option value="Micronesia" >Micronesia</option>
<option value="Moldova" >Moldova</option>
<option value="Monaco" >Monaco</option>
<option value="Mongolia" >Mongolia</option>
<option value="Montenegro" >Montenegro</option>
<option value="Morocco" >Morocco</option>
<option value="Mozambique" >Mozambique</option>
<option value="Myanmar" >Myanmar</option>
<option value="Namibia" >Namibia</option>
<option value="Nauru" >Nauru</option>
<option value="Nepal" >Nepal</option>
<option value="Netherlands" >Netherlands</option>
<option value="Netherlands Antilles" >Netherlands Antilles</option>
<option value="Nicaragua" >Nicaragua</option>
<option value="Niger" >Niger</option>
<option value="Nigeria" >Nigeria</option>
<option value="Norway" >Norway</option>
<option value="Oman" >Oman</option>
<option value="Pakistan" >Pakistan</option>
<option value="Palau" >Palau</option>
<option value="Palestine" >Palestine</option>
<option value="Panama" >Panama</option>
<option value="Papua New Guinea" >Papua New Guinea</option>
<option value="Paraguay" >Paraguay</option>
<option value="Peru" >Peru</option>
<option value="Philippines" >Philippines</option>
<option value="Poland" >Poland</option>
<option value="Portugal" >Portugal</option>
<option value="Puerto Rico" >Puerto Rico</option>
<option value="Qatar" >Qatar</option>
<option value="Romania" >Romania</option>
<option value="Russia" >Russia</option>
<option value="Rwanda" >Rwanda</option>
<option value="Saint Kitts and Nevis" >Saint Kitts and Nevis</option>
<option value="Saint Lucia" >Saint Lucia</option>
<option value="Saint Vincent and the Grenadines" >Saint Vincent and the Grenadines</option>
<option value="Samoa" >Samoa</option>
<option value="San Marino" >San Marino</option>
<option value="Sao Tome and Principe" >Sao Tome and Principe</option>
<option value="Saudi Arabia" >Saudi Arabia</option>
<option value="Senegal" >Senegal</option>
<option value="Serbia" >Serbia</option>
<option value="Seychelles" >Seychelles</option>
<option value="Sierra Leone" >Sierra Leone</option>
<option value="Singapore" >Singapore</option>
<option value="Slovakia" >Slovakia</option>
<option value="Slovenia" >Slovenia</option>
<option value="Solomon Islands" >Solomon Islands</option>
<option value="Somalia" >Somalia</option>
<option value="South Africa" >South Africa</option>
<option value="Spain" >Spain</option>
<option value="Sri Lanka" >Sri Lanka</option>
<option value="Sudan" >Sudan</option>
<option value="Suriname" >Suriname</option>
<option value="Swaziland" >Swaziland</option>
<option value="Sweden" >Sweden</option>
<option value="Switzerland" >Switzerland</option>
<option value="Syria" >Syria</option>
<option value="Taiwan" >Taiwan</option>
<option value="Tajikistan" >Tajikistan</option>
<option value="Tanzania" >Tanzania</option>
<option value="Thailand" >Thailand</option>
<option value="Togo" >Togo</option>
<option value="Tonga" >Tonga</option>
<option value="Trinidad and Tobago" >Trinidad and Tobago</option>
<option value="Tunisia" >Tunisia</option>
<option value="Turkey" >Turkey</option>
<option value="Turkmenistan" >Turkmenistan</option>
<option value="Tuvalu" >Tuvalu</option>
<option value="Uganda" >Uganda</option>
<option value="Ukraine" >Ukraine</option>
<option value="United Arab Emirates" >United Arab Emirates</option>
<option value="United States Minor Outlying Islands" >United States Minor Outlying Islands</option>
<option value="Uruguay" >Uruguay</option>
<option value="Uzbekistan" >Uzbekistan</option>
<option value="Vanuatu" >Vanuatu</option>
<option value="Vatican City" >Vatican City</option>
<option value="Venezuela" >Venezuela</option>
<option value="Vietnam" >Vietnam</option>
<option value="Virgin Islands, British" >Virgin Islands, British</option>
<option value="Virgin Islands, U.S." >Virgin Islands, U.S.</option>
<option value="Yemen" >Yemen</option>
<option value="Zambia" >Zambia</option>
<option value="Zimbabwe" >Zimbabwe</option>
</select>
<label for="Field7">Country</label>
</span>
</div>
</li>

</li> <li class="buttons ">
<div>

               
                    <input type="submit" name="button" id="button" value="Submit">
</div>
</li>

</ul>
</form> 

</div><!--container-->

<!--<a class="powertiny" href="http://wufoo.com/form-builder/" title="Powered by Wufoo"
style="display:block !important;visibility:visible !important;text-indent:0 !important;position:relative !important;height:auto !important;width:95px !important;overflow:visible !important;text-decoration:none;cursor:pointer !important;margin:0 auto !important">
<span style="background:url(./images/powerlogo.png) no-repeat center 7px; margin:0 auto;display:inline-block !important;visibility:visible !important;text-indent:-9000px !important;position:static !important;overflow: auto !important;width:62px !important;height:30px !important">Wufoo</span>
<b style="display:block !important;visibility:visible !important;text-indent:0 !important;position:static !important;height:auto !important;width:auto !important;overflow: auto !important;font-weight:normal;font-size:9px;color:#777;padding:0 0 0 3px;">Designed</b>
</a>-->
</body>
</html>