<html>

<head>

	<title> Add Inventory </title>

</head>

<body>

<?php 

	//pull form data
	$userID = $description = $inventoryType = $purchasePrice = $purchaseLocation = "";
	$inventoryLocation = inventoryOwner = "";

	$userID = $_POST['userID'];
	$description = $_POST['description'];
	$inventoryType = $_POST['inventoryType'];
	$purchasePrice = $_POST['purchasePrice'];
	$purchaseLocation = $_POST['purchaseLocation'];
	$inventoryLocation = $_POST['inventoryLocation'];
	$inventoryOwner = $_POST['inventoryOwner'];

	
	$insertString = "INSERT INTO tInventory(UserID,ServiceID,DateRequested) VALUES($userID,$serviceID,now())";
	echo "<p class='debug'>Query: $insertString </p>";

	include_once 'dbConnect.php';
	include_once 'checkValue.php?t=tInventoryType&i=InventoryTypeID&v=$inventoryType&c=InventoryTypeID&f=Inventory Type";
	include_once 'checkValue.php?t=tInventoryOwner&i=InventoryOwnerID&v=$inventoryOwner&c=InventoryOwnerID&f=Inventory Owner";
	include_once 'checkValue.php?t=tInventoryLocation&i=InventoryLocationID&v=$inventoryLocation&c=InventoryLocationID&f=Inventory Location";

	if (! mysql_query($insertString,$database))
	{
		echo "<p class='debug'>Added</p>";

	}
	else
	{
		echo "<p class='error'> Add Failed: " . mysql_error() . "</p>";
	}

		echo "<form method='post' name='getList' action='InventoryListing.php' autocomplete='on'>";

		echo "<input type='hidden' name='userid' value='$userID' />";

		echo "<input type='submit' value='List Inventory'/>";

		echo "</form>";


	mysql_close();
?>
<script language="JavaScript">document.getList.submit();</script>




</body>

</html>
