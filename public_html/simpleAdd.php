<html>

<head>

	<title> Simple Add </title>

</head>

<body>

<?php 

	$userID = $_POST['userID'];
	$returnPage = $_POST['returnPage'];
	$tableName = $_POST['tableName'];
	$columnName = $_POST['columnName'];
	$columnValue = $_POST['description'];
	$insertString = "INSERT INTO $tableName ($columnName) VALUES ('$columnValue')";
	$checkString = "SELECT $columnName FROM $tableName WHERE $columnName='$columnValue'";

	echo "<p class='debug'>#INSERT: $insertString</p>";
	echo "<p class='debug'>#CHECK: $checkString</p>";

	include_once 'dbConnect.php';

	$existingResult = mysql_query($checkString, $database);
	$rows = mysql_num_rows($existingResult);
	if ($rows == 0) {
		echo("<p class='debug'>$columnName does not contain $checkValue</p>");
		if (! mysql_query($insertString,$database))
		{
			echo "<p class='debug'>Added</p>";
		}
		else
		{
			echo "<p class='error'> Add Failed: " . mysql_error() . "</p>";
		}
	}
	else{
		die("<p class='error'>$checkValue already exists</p>");
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
