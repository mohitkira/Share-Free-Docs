// JavaScript Document
function validateForm()
{
var fname=document.forms["form69"]["fname"].value;
var lname=document.forms["form69"]["lname"].value;
var username=document.forms["form69"]["username"].value;
var password=document.forms["form69"]["password"].value;
var repassword=document.forms["form69"]["repassword"].value;
var email=document.forms["form69"]["mobile"].value;
var mobile=document.forms["form69"]["email"].value;

if (fname==null || fname=="")
  {
  //document.getElementById("fname").innerHTML="<font face='Georgia, Times New Roman, Times, serif' color='#FF1100'> </font>";
   alert("Please fill the First name field..!!!");
  document.form69.fname.focus();
  return false;
  }
  else{
	 // document.getElementById("fname").innerHTML=" ";
	  }
if (lname==null || lname=="")
  {
	 
  //document.getElementById("lname").innerHTML="<font face='Georgia, Times New Roman, Times, serif' color='#FF1100'>please fill the name field..!!!</font>";
   alert("Please fill the Last name field..!!!");
  document.form69.lname.focus();
  return false;
  }  
  else{
	//  document.getElementById("lname").innerHTML=" ";
	  }
	  //name validation
	  
	 
  

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
	  
	  
	  
if(password != "" && password == repassword) {
      if(form.pwd1.value.length < 5) {
		  //document.getElementById("").innerHTML="<font face='Georgia, Times New Roman, Times, serif' color='#FF1100'></font>";
		  alert("Password must contain at least five characters!");
        document.form69.password.focus();
        return false;
      }
  }	 
  else{
	  //document.getElementById("password").innerHTML="<font face='Georgia, Times New Roman, Times, serif' color='#FF1100'></font>";
	  alert("Please enter the password properly..!!!");
  document.form69.password.focus();
  return false;
	  } 
	//validation for password  
	  
	  


if(isNaN(mobile))
{
	//document.getElementById("mobile").innerHTML="<font face='Georgia, Times New Roman, Times, serif' color='#FF1100'></font>";
	alert("Enter the valid Mobile Number(Like : 7276671866)");
document.form69.mobile.focus();
return false;
}
else
  {
	  if((mobile.length < 1) || (mobile.length > 10))
{
	//document.getElementById("mobile").innerHTML="<font face='Georgia, Times New Roman, Times, serif' color='#FF1100'></font>";
	alert("Your Mobile Number must be 1 to 10 Integers");
document.form69.mobile.select();
return false;
} 
  //document.getElementById("mobile").innerHTML=" ";
  }

 
  //mobile validation
  
  
	  
/*if (email==null || email=="")
  {
  document.getElementById("email").innerHTML="<font face='Georgia, Times New Roman, Times, serif' color='#FF1100'> please fill the email address</font>";
  alert("");
  document.form69.email.focus();
  return false;
  } 
  else{
	  //document.getElementById("email").innerHTML=" ";
	  }
	  //email validation
	  */



  
 if(document.form69.college.selectedIndex==0)
{ 
//document.getElementById("college").innerHTML="<font face='Georgia, Times New Roman, Times, serif' color='#FF1100'></font>";
alert("Please select your college..!!");
document.login.type.focus();
return false;
}
else
  {
  //document.getElementById("college").innerHTML=" ";
  }  
  //validation for college 
  
  
 return true; 
}