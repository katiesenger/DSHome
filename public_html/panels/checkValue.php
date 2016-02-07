<?php
	$qString = $_SERVER['QUERY_STRING'];
	echo "<p class='debug'>Q: $qString</p>";

	$table = $_GET['t'];
	$idColumn  = $_GET['i'];
	$checkValue = $_GET['v'];
	$checkColumn = $_GET['c'];
	$friendly = $_GET['f'];
	$checkStatement = "$friendly :: SELECT $idColumn FROM $table WHERE $checkColumn='$checkValue'";

	echo "<p class='debug'>$checkStatment</p>";
	include_once 'dbConnect.php';

	$existingResult = mysql_query($checkStatment, $database);
	$rows = mysql_num_rows($existingResult);
	if ($rows == 0) {
	die("<p class='error'>$friendly does not contain $checkValue</p>");
	}
	else{
	echo "<p class='debug'>$friendly contains $checkValue</p>";
	}
	mysql_close();
?>