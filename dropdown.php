<?php
	$q = $_SERVER['QUERY_STRING'];
	$userID = $_GET['u'];

	
	$table = $_GET['t'];
	
	$option = $_GET['o'];
	$idColumn = $_GET['i'];
	$fieldName = $_GET['n'];
	$selected = $_GET['s'];
	
	echo "<p class='debug'>Query String: $q</p>";
	echo "<p class='debug'>Gathering $option and $idColumn from $table to label as $fieldName</p>";
	
	$thisQuery = "SELECT $idColumn, $option FROM $table WHERE $option IS NOT NULL ORDER BY $option;"
	echo "<p class='debug'>$thisQuery</p>";

	include_once 'dbConnect.php';

	$thisData = mysql_query( $thisQuery,$database);


	echo "<select name=$fieldName required=true>";
	while($row = mysql_fetch_row($result))

	{

		echo "<option value='$row[0]' ";
			if($selected==$row[1])
				echo "selected=true ";
		echo ">$row[1]</option>"
	}
	echo "</select>\n";
	mysql_free_result($result);

?>
