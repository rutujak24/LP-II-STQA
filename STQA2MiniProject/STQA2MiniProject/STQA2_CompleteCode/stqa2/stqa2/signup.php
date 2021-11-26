<?php
require_once 'header.php';
echo"</body></html>";


echo <<<_END
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

</style>

<link rel="stylesheet" href="style1.css">

<script src="javascript.js"></script>


<script>  
function validateform(){  
//var name=document.myform.name.value;  
//var password=document.myform.password.value;  

var fname=document.myform2.First.value;  
var lname=document.myform2.Last.value;  
var username=document.myform2.username.value;  
var password=document.myform2.psw.value;  
var passwordrepeat=document.myform2.pswrepeat.value;  
var email=document.myform2.email.value;  
var contact=document.myform2.contact.value; 
var address=document.myform2.address.value;  
  var atposition=email.indexOf("@");  
var dotposition=email.lastIndexOf(".");   
  
if (fname==null || fname=="" ||lname==null || lname=="" || username==null || username=="" ){  
  alert("Name can't be blank");  
  return false;  
}else if (atposition<1 || dotposition<atposition+2 || dotposition+2>=email.length){  
  alert("Please enter a valid e-mail address");  
  return false;  
  } else if(password.length<6){  
  alert("Password must be at least 6 characters long.");  
  return false;  
  } else if(password!=passwordrepeat){  
  alert("Password must be same");  
  return false;  
  } else if (isNaN(contact)){  
 alert("Wrong number format");  
  return false;  
}else if (/[^a-zA-Z0-9_-]/.test(username)){
	alert("Only a-z, A-Z, 0-9, - and _ allowed in Usernames"); 
	return false;
}
else if (!/[a-z]/.test(password) || ! /[A-Z]/.test(password) ||!/[0-9]/.test(password))
{ alert("Passwords require one each of a-z, A-Z and 0-9.");
return false;
}
else if(!((email.indexOf(".") > 0) &&(email.indexOf("@") > 0)) ||/[^a-zA-Z0-9.@_-]/.test(email))
{alert("The Email address is invalid");
return false;

}

if(password==password_repeat){  
return true;  
}  
else{  
alert("password must be same!");  
return false;  
}  
  
}  
</script> 


</head>




<body>


<script>
function checkUser(user)
{
if (user.value == '')
{
O('info').innerHTML = ''
return
}
params = "username=" + user.value
request = new ajaxRequest()
request.open("POST", "checkuser.php", true)
request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
request.setRequestHeader("Content-length", params.length)
request.setRequestHeader("Connection", "close")
request.onreadystatechange = function()
{if (this.readyState == 4)
if (this.status == 200)
if (this.responseText != null)
O('info').innerHTML = this.responseText
}
request.send(params)
}
function ajaxRequest()
{
try { var request = new XMLHttpRequest() }
catch(e1) {
try { request = new ActiveXObject("Msxml2.XMLHTTP") }
catch(e2) {
try { request = new ActiveXObject("Microsoft.XMLHTTP") }
catch(e3) {
request = false
} } }
return request
}
</script>
<div class='main'><h3>Please enter your details to sign up</h3></div>

_END;
$error = $First= $Last= $username=$email=$psw=$pswrepeat=$contact=$address="";

if (isset($_SESSION['user'])) destroySession();
if (isset($_POST['username']))
{
$username = sanitizeString($_POST['username']);
$psw = sanitizeString($_POST['psw']);
$First=sanitizeString($_POST['First']);
$Last=sanitizeString($_POST['Last']);
$email=sanitizeString($_POST['email']);
$pswrepeat=sanitizeString($_POST['pswrepeat']);
$contact=sanitizeString($_POST['contact']);
$address=sanitizeString($_POST['address']);
if ($username == "" || $psw == "" || $First==""|| $Last=="" || $pswrepeat==""||$contact==""||$address=="" || $email=="")
$error = "Not all fields were entered<br><br>";
else
{
$result = queryMysql("SELECT * FROM user WHERE username='$username'");
if ($result->num_rows)
$error = "That username already exists<br><br>";
else
{
queryMysql("INSERT INTO user VALUES('$First','$Last','$username', '$email','$psw', '$contact','$address')");
die("<h4>Account created</h4>Please Log in.<br><br>");
}
}
}
echo <<<_END




<form name="myform2"  id="form_2" action="signup.php" method="post" onsubmit="return validateform()">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

	
	
    <label for="First"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name" name="First" value="$First" required>
	
    <label for="Last"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="Last" value="$Last" required>
	
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username"  value="$username" required onBlur='checkUser(this)'>
	<span id='info'></span>
	<br>
	
	
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" value="$email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" value="$psw" required>

    <label for="pswrepeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="pswrepeat" value= "$pswrepeat" required>


	
    <label for="contact"><b>Contact number</b></label>
    <input type="text" placeholder="Enter contact number" name="contact" value="$contact" required>
	
	
	
    <label for="address"><b>Address</b></label>
    <input type="text" placeholder="Enter Address" name="address" value="$address" required>



    <hr>
    <!--p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p-->

    <button type="submit" name="Register" class="registerbtn" >Register</button>
  </div>
  
  <div class="container signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>

</body>
</html>





_END;
?>

