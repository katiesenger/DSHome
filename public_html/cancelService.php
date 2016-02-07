<html>

<head>

	<title> Cancel Service </title>

</head>

<body>

<?php 

	//make querystring variable into local variable
	$qString = $_SERVER['QUERY_STRING'];
	echo "<p class='debug'>Q: $qString</p>";

	$userID = $_GET['u'];
	echo "<p class='debug'>U: $userID</p>";

	$UserServiceID = $_GET['s'];
	echo "<p class='debug'>S: $UserServiceID</p>";

	$updateDate = "UPDATE tUserService SET DateComplete=now() WHERE UserServiceID=$UserServiceID";
	echo "<p class='debug'>Query: $updateDate</p>";

	$updateBy = "UPDATE tUserService SET CompleteByUserID=$userID WHERE UserServiceID=$UserServiceID";
	echo "<p class='debug'>Query: $updateBy</p>";

	$fullUpdate = "UPDATE tUserService SET CompleteByUserID=$userID, InvoiceID=0, DateComplete=now() WHERE UserServiceID=$UserServiceID";
	echo "<p class='debug'>Query: $fullUpdate</p>";

	include_once 'dbConnect.php';

	if (! mysql_query($fullUpdate, $database))
	{
		echo "<p class='debug'>Updated</p>";
	}
	else
	{
		echo "<p class='error'> Update Failed: " . mysql_error() . "</p>";
	}

//	if (! mysql_query($updateDate, $database))
//	{
//		echo "<p class='debug'>Updated Date</p>";
//	}
//	else
//	{
//		echo "<p class='error'> Date Update Failed: " . mysql_error() . "</p>";
//	}
//	if (! mysql_query($updateBy, $database))
//	{
//		echo "<p class='debug'>Updated By</p>";
//	}
//	else
//	{
//		echo "<p class='error'> By Update Failed: " . mysql_error() . "</p>";
//	}

	echo "<form method='post' name='getList' action='ServiceRequest.php' autocomplete='on'>";

	echo "<input type='hidden' name='userid' value='$userID' />";

	echo "<input type='submit' value='Request Services'/>";

	echo "</form>";


	mysql_close();
?>
<script language="JavaScript">document.getList.submit();</script>

</body>

</html>
