<html>

<head>

	<title> Simple Delete </title>

</head>

<body>

<?php 
	$qString = $_SERVER['QUERY_STRING'];
	echo "<p class='debug'>Q: $qString</p>";

	$userID = $_GET['u'];
	$tableName = $_GET['t'];
	$id = $_GET['i'];
	$deleteString = "DELETE FROM $tableName WHERE $columnName='$columnValue'";
	$checkString = "SELECT $columnName FROM $tableName WHERE $columnName='$columnValue'";

	echo "<p class='debug'>#DELETE: $deleteString</p>";
	echo "<p class='debug'>#CHECK: $checkString</p>";

	include_once 'dbConnect.php';

	$existingResult = mysql_query($checkString, $database);
	$rows = mysql_num_rows($existingResult);
	if (! $rows == 0) {
		echo("<p class='debug'>$columnName contains $checkValue</p>");
		if (! mysql_query($deleteString,$database))
		{
			echo "<p class='debug'>Deleted</p>";
		}
		else
		{
			echo "<p class='error'> Delete Failed: " . mysql_error() . "</p>";
		}
	}
	else{
		die("<p class='error'>$checkValue does not exists</p>");
	}
	mysql_close();

		echo "<form method='post' name='getList' action='$returnPage.php' autocomplete='on'>";

		echo "<input type='hidden' name='userid' value='$userID' />";

		echo "<input type='submit' value='Return to List'/>";

		echo "</form>";


	mysql_close();
?>
<script language="JavaScript">document.getList.submit();</script>




</body>

</html>
