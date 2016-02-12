<!DOCTYPE html>
<!-- 	Purpose: simple table management (ID and Name only) --> 
<html>
<head>
	<meta charset = "utf-8">
	<title>Inventory Management</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h2>Inventory</h2>
<?php
	include_once './panels/getVariables.php';
	$userID = $table = $action = $value = $id = "";
	$userID = $_POST["userid"];
	if($userID == "")
	{
		$qString = $_SERVER['QUERY_STRING'];
		$userID = getQString('u');
		$table = getQString('t');
		$action = getQString('action'); //list, select, sort, add, edit, delete
		$value = getQString('v');
		$id = getQString('i');
		
		$friendlyName = $columnName = $idColumn = $nameColumn ="";
		$words = preg_split('/(?=[A-Z])/',$table);
		$count = count($words);
		for($i=0;$i<=count;$i++)
		{
			if($words[$i]=="t")
				$i++;
			$friendlyName=$friendlyName . " " . $words[$i];
			$columnName = $columnName . $words[$i];
		}
		$idColumn = $columnName . "ID";
		$nameColumn = $columnName . "Name";
	}
	include_once 'panels/menu.php?$userID';
	
	echo "<div class='box'>";
	
	include_once 'dbConnect.php';

	function checkValueByName()
	{
		$checkStatement = "SELECT $idColumn FROM $table WHERE $nameColumn = '$value'";
		$existingResult = mysql_query($checkStatment, $database);
		$rows = mysql_num_rows($existingResult);
		if ($rows == 0) {		return 0;	}
		else{	return $rows[0]; }
		mysql_close();
	}
	function getValue()
	{
		$checkStatement = "SELECT $nameColumn FROM $table WHERE $idColumn = '$value'";
		$existingResult = mysql_query($checkStatment, $database);
		$rows = mysql_num_rows($existingResult);
		if ($rows == 0) {		return 0;	}
		else{	return $rows[0]; }
		mysql_close();
	}
	
	function checkValueByID()
	{
		$checkStatement = "SELECT $idColumn FROM $table WHERE $idColumn = '$value'";
		$existingResult = mysql_query($checkStatment, $database);
		$rows = mysql_num_rows($existingResult);
		if ($rows == 0) {		return 0;	}
		else{	return $rows[0]; }
		mysql_close();
	}
	
	$listQuery = "SELECT $idColumn, $nameColumn FROM $table ORDER BY $nameColumn";
	switch($action) {
		case "list":
			break;
		case "sort":
			$listQuery = "SELECT $idColumn, $nameColumn FROM $table ORDER BY $value";
			break;
		case "delete":
			if(checkValueByID()==$value)
			{
				$deleteQuery = "DELETE FROM $table WHERE $idColumn=$value";
				if ( !( $result = mysql_query( $deleteQuery) ) ) {
					echo "<p class='error'>Could not remove $value  " . mysql_error() . "</p>";
				}
			}
			else {
				echo "<p class='error'>Could not find $value to remove it</p>";
			}
			break;
		case "add":
			$value = $_POST['addNew'];
			if(checkValueByName()==0)
			{
				$addQuery = "INSERT INTO $table($nameColumn) VALUES ('$value')";
				if ( !( $result = mysql_query( $addQuery) ) ) {
					echo "<p class='error'>Could not add $value " . mysql_error() . "</p>";
				}
			}
			else{
				echo "<p class='error'>$value already exists</p>";
				listData();
			}
			break;
		case "select":
			$existingValue = getValue();
			echo "<form id='edit' method='post' action='simpleTable.php?u=$userID&t=$table&action=edit' autocomplete='on' type='submit'>";
			echo "Add $friendlyName: <input type='text' name='editValue' id='editValue' value='$existingValue' />";
			echo "<input type='submit' name='add' value='add' />";
			echo "</form>";
			break;
		case "edit":
			$newValue = $_POST['editValue'];
			if(checkValueByID==$value)
			{
				$oldValue = $value;
				$value = $newValue;
				if(checkValueByName != 0 && checkValueByName != $oldValue)
				{
					echo "<p class='error'>$value already exists</p>";
				}
				else
				{
					$editQuery = "UPDATE $table SET $nameColumn='$newValue' Where $idColumn=$oldValue";
					if ( !( $result = mysql_query( $editQuery) ) ) {
						echo "<p class='error'>Could not edit $value " . mysql_error() . "</p>";
					}
				}
			}
			else{
				echo "<p class='error'>Error in edit for $value</p>";
			}
	
	}
	listData();
	function listData()
	{
	
		if ( !( $result = mysql_query( $listQuery) ) ) {
			echo "<p class='error'>Could not find $friendlyName listing " . mysql_error() . "</p>";
		}
		else {
			echo "<h2>$friendlyName</h2>";
			$data = mysql_query( $listQuery,$database);
			echo "<form><table class='displayData'>";
			// printing table rows
			echo "<tr><th>&nbsp;</th><th>ID</th><th>Name</th></tr>\n";
			while($row = mysql_fetch_row($result))
			{
			  echo "<tr>";
				echo "<td>";
				echo "<a href='simpleTable.php?u=$userID&t=$table&action=select&i=$row[0]'>Edit</a> ";
				echo "<a href='simpleTable.php?u=$userID&t=$table&action=delete&i=$row[0]'>Delete</a> ";
				echo "</td>";
				echo "<td>$row[0]</td>";
				echo "<td>$row[1]</td>";
				echo "</tr>\n";
			}
		mysql_free_result($result);
		echo "</table></form>";
		}
	}
	
	echo "<form id='add' method='post' action='simpleTable.php?u=$userID&t=$table&action=add' autocomplete='on' type='submit'>";
	echo "Add $friendlyName: <input type='text' name='addNew' id='addNew' />";
	echo "<input type='submit' name='add' value='add' />";
	echo "</form>";
	?>
</div>
</body>
</html>
