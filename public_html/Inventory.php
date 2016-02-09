<!DOCTYPE html>
<!-- 	Purpose: crud inventory --> 
<html>
<head>
	<meta charset = "utf-8">
	<title>Inventory</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h2>Inventory</h2>
<?php
	$userID = "";
	$userID = $_POST["userid"];
	include_once 'panels/menu.php';
?>
	<div class='box'>
	<?php
		include_once 'dbConnect.php';
		include_once 'ajax.php';
		
		$inventoryQuery = "SELECT InventoryID, 	InventoryDescription, InventoryTypeID,	PurchasePrice,	PurchaseLocation,	InventoryLocationID,	InventoryOwnerID, Picture1Location, Picture2Location,	DateSold from tInventory";
"
		echo "<p class='debug'>$servicesQuery</a>";
		include_once 'dbConnect.php';

		if ( !( $result = mysql_query( $servicesQuery) ) ) {
			echo "<p class='error'>Could not find contact listing " . mysql_error() . "</p>";
		}

		else {
			echo "<h3>Our Staff</h3>";
			$services = mysql_query( $contactQuery,$database);
			echo "<form><table class='displayData'>";
			// printing table rows
			echo "<tr>";
			while($row = mysql_fetch_row($result))
			{
			  echo "<td>";
				echo "<b><a href='mailto:$row[3]' />$row[1] $row[2]</a></b><br />";
				echo "<b>Phone: </b>$row[4]<br />";
				echo "$row[5]<br />"; //Mailing
				echo "$row[6]<br />"; //Street
				echo "$row[7] $row[8], $row[9]  $row[10]  $row[11]<br />";
				echo "</td>";
			}
		  echo "</tr>\n";
		mysql_free_result($result);
		echo "</table></form>";
		}
?>
</div>
</body>
</html>
