<?php
require_once 'header.php';
echo <<<_END
<html>
<head>
<title>$appname$userstr</title>
_END;

echo <<<_END
<!--link rel="sytlesheet" type="text/css" href="style.css"-->

<style>

body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #a14025;
		width:50%;
		background-color:white;
}

input[type=text], input[type=password] {
  width: 70%;
  align:center;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button, input[type=button] {
  background-color: #a14025;
  color: white;
  align:center;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 50%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
	background-color:white;
 margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.bg-img {

background-image:url("bg2.jpg");
background-position:center;
background-repeat:no-repeat;
background-size:cover;
position:relative;


}

.container {
  padding: 16px;
  background-color:white;
}

span.psw {
  float: right;
  padding-top: 16px;
}


@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}



</style>
<script>
var attempt=3;




function cleartext(){
attempt=3;
document.getElementById("username").disabled = false;
document.getElementById("password").disabled = false;
document.getElementById("submit").disabled = false;
}  

function validateform()
{
var name=document.myform.uname.value;  
var password=document.myform.psw.value;  
fail = validateusername(name)
fail += validatepassword(password)

if (fail == "") return true
else { 
attempt --;// Decrementing by one.
alert(fail); 
alert("You have left "+attempt+" attempt;");
// Disabling fields after 3 attempts.
if( attempt == 0){
document.getElementById("username").disabled = true;
document.getElementById("password").disabled = true;
document.getElementById("submit").disabled = true;
}

return false 
}

}




function validateusername(name){
	
	if (name==null || name==""){  
  return  "Name can't be blank.";  
}
else if (name.length < 6)
return "Usernames must be at least 6 characters."
//else if (/[^a-zA-Z0-9_-]/.test(name))
//return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames."
return ""

}

function validatepassword(password){
	
	


if (password == "") return "No Password was entered."
else if (password.length < 6)
return "Passwords must be at least 6 characters."
return ""


	
}





  
</script>  



</head>

<body>
<div>

_END;


$error=$user = $pass = "";

if(isset($_POST['uname']))
{
$user = sanitizeString($_POST['uname']);
$pass = sanitizeString($_POST['psw']);
if ($user == "" || $pass == ""){
$error = "Not all fields were entered<br>";
//die("No values entered!<br>");
}
else
{
$result = queryMySQL("SELECT username,password FROM user WHERE username='$user' AND password='$pass'");
if ($result->num_rows == 0)
{
	//die("Username/Password invalid");
$error = "<span class='error'></span>Username/Password invalid<br><br>";
}
else
{
$_SESSION['user'] = $user;
$_SESSION['pass'] = $pass;
//echo"<script> alert('Valid details entered!'); </script>";
die("You are now logged in. Please <a href='index.php'>" ."click here</a> to continue.<br><br>");
}
}
}

//echo "Username $user  and password $pass";

echo <<<_END
<!--
<hr>
<br>username:$user

<br>password:$pass
-->
<br>$error
<hr>
<div align="center" class="bg-img">
<form name="myform" id="form_1" action="login.php" method="post" onsubmit=" return validateform()" onreset="cleartext()" onload="cleartext()">
  <div class="imgcontainer">
    <img src="assets/logo_black.png" alt="La Piccola Italia" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" id="username" value="$user" required>
	<br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="password" value="$pass" required>
	<br>
    <!--<button type="submit"  onclick="window.location.href='menu.html';">Login</button>-->
	
	<!--input type="button" value="Login" id="submit" onclick="validate()"/-->
	<button type="submit"  name="submitbutton" id="submit" >Login</button>
	
	<br>
	<button type="submit" onclick="window.location.href='register.html';">Register</button>
    <br>
	<!--
	<label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
	-->
	
	
  </div>

  <div class="container" style="background-color:#f7c9bc">
    <button type="reset" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>
</div>

</body>

</html>




_END;


?>

