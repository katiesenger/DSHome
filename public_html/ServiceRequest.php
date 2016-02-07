<!DOCTYPE html>

 
<!--Purpose: Display a list of requested services for the user to maintain their list. 

-->
 

<html>
 

<head>

 
	<meta charset = "utf-8">

 
	<title>Service Requests</title>

 
	<link href="DSHome.css" rel="stylesheet" />

</head>


<body>

<h2>My Service Requests</h2>

<?php
	$userID ="";
	$userID = $_POST["userid"];


	include_once 'panels/menu.php?$userID';

?>

<div class='box'>

<?php

	
$servicesQuery = "SELECT ServiceID, ServiceName, Price, ShopHours FROM tService";

	echo "<p class='debug'>$servicesQuery</a>";


		include_once 'dbConnect.php';

		
if ( !( $result = mysql_query( $servicesQuery) ) ) {

			echo "<p class='error'>Could not find service listing " . mysql_error() . "</p>";

		}

		else {

			echo "<h3>Available Services</h3>";


			$services = mysql_query( $servicesQuery,$database);

			echo "<form><table class='displayData'>";

			echo "<tr><th>&nbsp;</th><th>ID</th><th>Service Name</th><th>Price</th><th>Service Time</th></tr>";

			// printing table rows

			while($row = mysql_fetch_row($result))

			{

			    echo "<tr>";

			    echo "<td><input type='hidden' name='serviceid' value='$row[0]' />";

			    echo "<input type='hidden' name='userid' value='$userID' />";

			    echo "<a href='addService.php?s=$row[0]&u=$userID'>Request</a></td>";

			    echo "<td>$row[1]</td>";

			    echo "<td>$row[2]</td>";

			    echo "<td>$row[3]</td>";


			    echo "</tr>\n";

			}

			mysql_free_result($result);

			echo "</table></form>";


			$requestedServices = "SELECT tUserService.UserServiceID, tService.ServiceName, tUserService.DateRequested, tUserService.DateComplete, tUserService.InvoiceID FROM tUserService inner join tService on tUserService.ServiceID=tService.ServiceID WHERE tUserService.UserID=$userID and (tUserService.InvoiceID <> 0 or tUserService.InvoiceID is null)";

			echo "<p class='debug'>$requestedServices</p>";

			
echo "<h3>Requested Services</h3>";


			$requested = mysql_query ($requestedServices) ;

			echo "<table class='displayData'>";

			echo "<tr><th>ID</th><th>Service Name</th><th>Date Requested</th><th>Date Completed</th><th>Invoice</th></tr>";

			while($row = mysql_fetch_row($requested))

			{

			    echo "<tr>";

			    echo "<td><input type='hidden' name='serviceid' value='$row[0]' />";

			    echo "<input type='hidden' name='userid' value='$userID' />";

			    echo "<a href='cancelService.php?s=$row[0]&u=$userID'>Cancel</a></td>";

			    echo "<td>$row[1]</td>";

			    echo "<td>$row[2]</td>";

			    echo "<td>$row[3]</td>";

			    echo "<td>$row[4]</td>";

			    echo "</tr>\n";

			}

			mysql_free_result($requested);

			echo "</form></table>";

		}

		mysql_close();


		print("<form method='post' name='getList' action='mailform.php' autocomplete='on'>");

		print("<input type='hidden' name='userid' value='$userID' />");

		print("<input type='submit' value='Request Services'/>");

		print("</form>");


		
	?>



	
</div>

</body>


</html>
