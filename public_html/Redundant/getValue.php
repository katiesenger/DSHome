<?php
	$qString = $_SERVER['QUERY_STRING'];
	echo "<p class='debug'>Q: $qString</p>";

	$table = $_GET['t'];
	$idColumn  = $_GET['i'];
	$checkValue = $_GET['v'];
	$getColumn = $_GET['c'];
	$friendly = $_GET['f'];
	$showBeside=$_GET['b']; //1 or 0
	
	$checkStatement = "$friendly :: SELECT $getColumn FROM $table WHERE $idColumn='$checkValue'";

	echo "<p class='debug'>$checkStatment</p>";
	include_once 'dbConnect.php';

	$existingResult = mysql_query($checkStatment, $database);
	$rows = mysql_num_rows($existingResult);
	if ($rows == 0) {
	echo "<p class='error'>$friendly does not contain $checkValue</p>";
	}
	else{
		if($showBeside==1)
		{
			echo "<th>$friendly</th><td>$rows[0]</td>";
		}
		else{
			echo $rows[0];
		}
	}
	mysql_close();
?>