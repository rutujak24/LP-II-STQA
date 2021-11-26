<?php

require_once "header.php";

if(!$loggedin){ 
die();
}



echo"</body></html>";

echo<<<_END
<html>
<head>
<script src="javascript.js"></script>
<style>

table {
  width: 100%;
  border: 1px solid #000;
}

th, td {
  width: 20%;
  text-align: left;
  vertical-align: top;
  border: 1px solid #000;
  border-collapse: collapse;
  padding: 0.3em;
  caption-side: bottom;
}

caption {
  padding: 0.3em;
  color: #fff;
  background: #000;
}

th {
  background: #eee;
}
</style>

<script>
function refresh(){
	
	O('price').value=0;
	O('qty').value=0;
}
</script>

</head>

<body>
<form name="myform" id="form_1" action="order.php" method="post" onload="refresh()">
<table>
<th>ADD TO CART</th>
<tr><td>Item</td>
<td>Price</td>
<td>Qty</td>
<td>Add</td>
</tr>
<tr>
	<td><label for="item">Choose Item:</label>

<select id="item" name="item">
  <option value="V01">Crispy Corn and Cheese</option>
    <option value="V02">Fresh Veggie</option>
	  <option value="V03">Veg Extravaganza</option>
	    <option value="V04">Veggie Paradise</option>
		  <option value="NV01">Chicken Golden Delight</option>
		    <option value="NV02">Chicken Sausage</option>
  <option value="NV03">Chicken Dominator</option>
  <option value="NV04">Chicken Tikka</option>  
  <option value="D01A">Margarita(S)</option>  
  <option value="D01B">Margarita</option> 
  <option value="D02A">Mojito(S)</option> 
  <option value="D02B">Mojito</option> 
</select>
	</td>
	<td><input type="text" id="price" disabled="true" name="price"></td>
	<td><input type="number" id='qty' min="0" max="15" step="1" value="0" size="6" name="qty"></td>
	<td><input type="submit" value="ADD"></td>
	
	</tr>
	</table>
	
	 <input type="radio" name="final" id="final"  value="CALCULATE BILL">
 <label for="final">FINAL BILL</label><br>
	
	</form>

	
	<table id="t2">
<th>CURRENT ITEM</th>
<tr><td>Item Id</td>
<td>Qty</td>
<td>Total</td>
</tr>


<br>
<br>



<style>
.registerbtn {
  background-color: #a14025;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

</style>



_END;

$error=$user = $pass = $tot="";


//static $index=1;


if(isset($_POST['item']))
{
	
	//echo"<br><br>".$_POST['item'];
	//echo"<br>".$_POST['final'];
$user = sanitizeString($_SESSION['user']);
$pass = sanitizeString($_POST['item']);

//echo"<br><br>".$_SESSION['oid'];



if ($user == "" || $pass == ""){
$error = "Not all fields were entered<br>";
//die("No values entered!<br>");
}
else
{
$result = queryMySQL("SELECT price FROM items WHERE itemid='$pass'");
if ($result->num_rows == 0)
{

	//die("Username/Password invalid");
$error = "<span class='error'></span>invalid<br><br>";
}
else
{
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$v= $row['price'];
		//echo $row['price'];
	echo"<script> O('price').value = '$v' ; </script>";
//$_SESSION['user'] = $user;
//$_SESSION['pass'] = $pass;
//echo"<script> alert('Valid details entered!'); </script>";
//die("You are now logged in. Please <a href='index.php'>" ."click here</a> to continue.<br><br>");

echo<<<_END

<script>
t=O('t2');
rw=t.insertRow(-1);


c1=rw.insertCell(0);
c2=rw.insertCell(1);
c3=rw.insertCell(2);
a="$_POST[item]";
b=$_POST[qty];
c=$v;
c1.innerHTML=a;
c2.innerHTML=b;

c3.innerHTML=b*c;



</script>"
_END;



$tot= $_POST['qty']*$v;

//echo"<br>".$_SESSION[oid];
//echo"<br>".$_POST['item'];
//echo"<br>".$_POST['qty'];
//echo"<br>".$tot;
if($tot!=0)
$insert= queryMySQL("insert into orderdetails(itemid,qty,total) values('$_POST[item]','$_POST[qty]','$tot')");

}
}
}
else{
	
	echo"<br><br>ERRROR!";
}


//echo"</body></html>";

//echo"<br>".$_SESSION["oid"];

//echo"<br>".$_POST["item"];

echo<<<_END



_END;

if(isset($_POST['final'])){
	
	
	$sql= queryMySQL("select max(orderid)+1 as ord from orders");
	
	$row=$sql->fetch_array(MYSQLI_ASSOC);
	
	$oid=$row['ord'];
	
	echo"Order id:".$oid;
	
	$stmt= queryMySQL("insert into orders values('$oid','$_SESSION[user]',0)");
	
	$stmt2= queryMySQL("update orderdetails set orderid='$oid' where orderid IS NULL");
	
	
	$stmt3= queryMySQL("select sum(total) as ttl from orderdetails where orderid='$oid'");
	
	$rss= $stmt3->fetch_array(MYSQLI_ASSOC);
	$x=$rss['ttl'];
	echo"<br>Amount to be paid:".$x;
	
	
	$stmt4= queryMySQL("update orders set bill='$x' where orderid='$oid'");
	
	echo"<br>BILL:";
	
	$stmt5= queryMySQL("select * from orders where username='$_SESSION[user]'");
	
	$f= $stmt5->fetch_array(MYSQLI_ASSOC);
	
	echo"<br> ORDER ID:".$f['orderid'];
	echo"<br> USERNAME:".$f['username'];
	echo"<br> TOTAL BILL:".$f['bill'];
	
	echo"<br> ORDER DETAILS: <br>";
	
	$g=queryMySQL("select * from orderdetails where orderid='$oid'");
	
	$rows=$g->num_rows;
	
	for($j=0 ; $j<$rows ; $j++){
		
		$g->data_seek($j);
		
		echo '  Item Code: '. $g->fetch_array()[1]; 
	
		
		
	}
	
	echo"<br>";
	
	for($j=0 ; $j<$rows ; $j++){
		
		$g->data_seek($j);
		
		 
	
		echo ' Qty: '. $g->fetch_array()[2];
		
	}
	
	echo"<br>";
	
	for($j=0 ; $j<$rows ; $j++){
		
		$g->data_seek($j);
		
	 
	
		echo ' Amount: '.$g->fetch_array()[3];
		
		
	}
	
		
	
		
	
	
	
	
}




?>


</body>

</html>