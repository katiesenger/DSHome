<html>

<head>

	<title> Add Service </title>

</head>

<body>

<?php 

	//make querystring variable into local variable
	$qString = $_SERVER['QUERY_STRING'];
	echo "<p class='debug'>Q: $qString</p>";

	$userID = $_GET['u'];
	echo "<p class='debug'>U: $userID</p>";

	$serviceID = $_GET['s'];
	echo "<p class='debug'>S: $serviceID</p>";

	$insertString = "INSERT INTO tUserService(UserID,ServiceID,DateRequested) VALUES($userID,$serviceID,now())";
	echo "<p class='debug'>Query: $insertString </p>";

	include_once 'dbConnect.php';

	if (! mysql_query($insertString,$database))
	{
		echo "<p class='debug'>Added</p>";

	}
	else
	{
		echo "<p class='error'> Add Failed: " . mysql_error() . "</p>";
	}

		echo "<form method='post' name='getList' action='ServiceRequest.php' autocomplete='on'>";

		echo "<input type='hidden' name='userid' value='$userID' />";

		echo "<input type='submit' value='Request Services'/>";

		echo "</form>";


	mysql_close();
?>
<script language="JavaScript">document.getList.submit();</script>




</body>

</html>
