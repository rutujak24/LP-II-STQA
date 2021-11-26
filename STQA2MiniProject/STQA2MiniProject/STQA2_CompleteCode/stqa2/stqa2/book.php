<?php
require_once 'header.php';

if(!$loggedin){ 
die();
}



class Book{
 
 public function bookTable($bid,$guests,$date,$timeslot){
 $qry= queryMySQL("insert into bookings values ('$bid', '$_SESSION[user]','$guests','$date','$timeslot')");
      if(!$qry){
           return FALSE;
          }
      else{
          return TRUE;
                    }
                        
             
                    
                    
                }


}
echo"</body></html>";


echo <<<_END

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

	</head>
	<body>
	
	<form id='f1' name='f1' action="book.php" method="post">
	<br>


	<table>
	<th>Find a table</th>
	<tr>
	<td><label for="guests">Choose number of guests:</label>

<select id="guests" name="guests">
  <option value=2>1-2</option>
  <option value=6>3-6</option>
  <option value=10>6-10</option>
  <option value=14>10-14</option>
</select>
	</td>
	
	<td><label for="date">Select date:</label>
	<input type="date" id="date" value="select" name="date">
	</td>
	
	<td><label for="timeslot">Choose timeslot:</label>

<select id="timeslot" name="timeslot">
  <option value="11am">11 am</option>
  <option value="12noon">12 noon</option>
  <option value="1pm">1 pm</option>
  <option value="2pm">2 pm</option>
  <option value="3pm">3 pm</option>
  <option value="4pm">4 pm</option>
  <option value="5pm">5 pm</option>
  <option value="6pm">6 pm</option>
  <option value="7pm">7 pm</option>
  <option value="8pm">8 pm</option>
  <option value="9pm">9 pm</option>
  <option value="10pm">10 pm</option>
</select>
	</td>
	
	<td>
	<input type="submit" value="BOOK" name="BOOK">
	</td>
	
	</tr>
	</table>
	
	<br>
	<br>
	
	
	<hr>
	
	</form>
	</body>
	</html>
_END;


$guests=$date=$timeslot="";
if(isset($_POST['date'])){
	
	
	$guests = sanitizeString($_POST['guests']);
	$date = sanitizeString($_POST['date']);
	$timeslot = sanitizeString($_POST['timeslot']);
	
	//echo"<br>".$guests."<br>".$date."<br>".$timeslot;


		$bid= rand(1,1000);
		
              
               






             $qry= queryMySQL("insert into bookings values ('$bid', '$_SESSION[user]','$guests','$date','$timeslot')");
		
	//if($qry->num_rows==0)
		//echo"<b> ERROR";
	
	
		$rs= queryMySQL("select * from bookings where bookingid='$bid'");
		$res=$rs->fetch_array();
	
	echo<<<_END
	
	<br>
	<br>
	<hr>
	<p>Thank you for booking with us!</p>
	<p>Booking details:</p>
		<br>Booking Id: $res[0];
		<br>Username: $res[1];
		<br>Table for: max $res[2] guests;
		<br>Date: $date;
		<br>Timeslot: $timeslot;
		
	<hr>
	<br>
	<br>
_END;
	
	}
	

?>
