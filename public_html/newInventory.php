<html>

<head>

	<title>Add Inventory Item</title>

	<link href="DSHome.css" rel="stylesheet" />

</head>

<body>

	<h1>Welcome to DS Home</h1>

	
<?php

		$userID ="";
		$userID = $_POST["userid"];


		include_once 'panels/menu.php?$userID';
	?>
	
	<p class="main">

		<form method="post" action="addInventory.php" autocomplete="on" class="box">

			<p>Inventory Description: <input type="text" name="description" id="description" /></p>

			<p>Inventory Type: 
		<?php
			include_once 'panels/dropdown.php?t=tInventoryType&o=InventoryTypeName&i=InventoryTypeID&n=InventoryTypeID';
		?>
			</p>
			<p>Purchase Price: <input type="text" name="PurchasePrice" id="PurchasePrice" /></p>
			<p>Purchase Location: <input type="text" name="PurchaseLocation" id="PurchaseLocation" /></p>
			<p>Inventory Location:
		<?php
			include_once 'panels/dropdown.php?t=tInventoryLocation&o=InventoryLocationName&i=InventoryLocationID&n=InventoryLocationID';
		?>
			</p>
			<p>Inventory Owner:
		<?php
			include_once 'panels/dropdown.php?t=tInventoryOwner&o=InventoryOwnerName&i=InventoryOwnerID&n=InventoryOwnerID';
		?>
			</p>
			<p>Picture 1 File Path: <input type="text" name="Picture1Location" id="Picture1Location" /></p>
			<p>Picture 2 File Path: <input type="text" name="Picture2Location" id="Picture2Location" /></p>
			<p><input type="submit" /></p>

		</form>

	</p>

</body>

</html>
