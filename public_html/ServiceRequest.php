<!DOCTYPE html>
<!--Purpose: Display a list of requested services for the user to maintain their list. -->
<html>
<head>
	<meta charset = "utf-8">
	<title>Service Requests</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
<h2>My Service Requests</h2>
<?php
	include_once './panels/getVariables.php';
	$userID ="";
	$userID = getUser();
	include_once './panels/menu.php';
?>
<div class='box'>
<?php
	
$servicesQuery = "SELECT ServiceID, ServiceName, Price, ShopHours FROM tService";

	echo "<p class='debug'>$servicesQuery</a>";
	include_once './panels/dbConnect.php';
	$dbh = OpenConn();
  $stmt = $dbh->prepare($servicesQuery); 
	$stmt->execute();
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
 	if(count($results) > 0)
	{
		echo "<h3>Available Services</h3>";
		echo "<form><table class='displayData'>";
		echo "<tr><th>&nbsp;</th><th>ID</th><th>Service Name</th><th>Price</th><th>Service Time</th></tr>";
		while ($row = $stmt->fetch()) {
	    echo "<tr>";
	    echo "<td><input type='hidden' name='serviceid' value='".$row['ServiceID']."' />";
	    echo "<input type='hidden' name='userid' value='$userID' />";
	    echo "<a href='addService.php?s=".$row["ServiceID"]."&u=$userID'>Request</a></td>";
		  echo "<td>".$row['ServiceName']."</td>";
	    echo "<td>".$row['Price']."</td>";
	    echo "<td>".$row['ShopHours']."</td>";
	    echo "</tr>\n";
		}
	$dbh = null;
	echo "</table></form>";
	}
	else {
		echo "<p class='error'> No Services available.</p>";
	}
	$requestedServices = "SELECT tUserService.UserServiceID, tService.ServiceName, tUserService.DateRequested, tUserService.DateComplete, tUserService.InvoiceID FROM tUserService inner join tService on tUserService.ServiceID=tService.ServiceID WHERE tUserService.UserID=:userID and (tUserService.InvoiceID <> 0 or tUserService.InvoiceID is null)";
	echo "<p class='debug'>$requestedServices</p>";
	$dbh = OpenConn();
  $stmt = $dbh->prepare($requestedServices); 
	$stmt->bindParam(":userID",$userID);
	$stmt->execute();
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
 	if(count($results) > 0)
	{
		echo "<h3>Requested Services</h3>";
		echo "<table class='displayData'>";
		echo "<tr><th>ID</th><th>Service Name</th><th>Date Requested</th><th>Date Completed</th><th>Invoice</th></tr>";
		while ($row = $stmt->fetch()) {
		    echo "<tr>";
		    echo "<td><input type='hidden' name='serviceid' value='".$row['UserServiceID']."' />";
		    echo "<input type='hidden' name='userid' value='$userID' />";
		    echo "<a href='cancelService.php?s=".$row['UserServiceID']."&u=$userID'>Cancel</a></td>";
		    echo "<td>".$row['ServiceName']."</td>";
		    echo "<td>".$row['DateRequested']."</td>";
		    echo "<td>".$row['DateComplete']."</td>";
		    echo "<td>".$row['InvoiceID']."</td>";
		    echo "</tr>\n";
		}
		echo "</form></table>";
		$dbh = null;
	}
	print("<form method='post' name='getList' action='mailform.php' autocomplete='on'>");
	print("<input type='hidden' name='userid' value='$userID' />");
	print("<input type='submit' value='Request Services'/>");
	print("</form>");
		
	?>

</div>
</body>
</html>