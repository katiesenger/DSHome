<!DOCTYPE html>
<!-- 	Purpose: crud inventory --> 
<html>
<head>
	<meta charset = "utf-8">
	<title>Inventory Management</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h2>Inventory Management</h2>
<?php
	$userID = "";
	$userID = $_POST["userid"];
	include_once 'panels/menu.php';
?>
	<div class='box'>
	<?php
		include_once 'inventoryFunction.php';
		}
?>
</div>
</body>
</html>
