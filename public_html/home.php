<!DOCTYPE html>
<!--Index Page -->

<head>
	<meta charset="utf=8">
	<title>DSHome.ca</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h1>Welcome to DSHome.ca</h1>
	<?php
	include_once './panels/getVariables.php';
	$userID ="";
  $userID = getPost('userid');
	include_once './panels/menu.php';
	echo "<form><input type='hidden' name='userid' id='userid' value='$userID' /></form>";
	?>

		
</body>

</html>