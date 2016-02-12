<?php
  
function getThisValue($checkStatement){
   include_once 'dbConnect.php';
    echo "<p class='debug'>$checkStatement</p>";
		$existingResult = mysql_query($checkStatement);
		$rows = mysql_num_rows($existingResult);
		echo "<p class='debug'>Returned: $rows</p>";
		if ($rows == 0) {		return 0;	}
		else{
			while($row = mysql_fetch_row($existingResult))
			{
        echo "<p class='debug'>Value: $row[0]</p>";
				return $row[0];
			}
		}
		mysql_close();
	}
	function checkValueByID($table,$idColumn,$nameColumn,$value)
	{
		$checkStatement = "SELECT $idColumn FROM $table WHERE $idColumn = $value";
		return getThisValue($checkStatement);
  }
function checkValueByName($table,$idColumn,$nameColumn,$value)
	{
		$checkStatement = "SELECT $idColumn FROM $table WHERE $nameColumn = '$value'";
		return getThisValue($checkStatement);
	}
	function getValue($table,$idColumn,$nameColumn,$value)
	{
		$checkStatement = "SELECT $nameColumn FROM $table WHERE $idColumn = '$value'";
		return getThisValue($checkStatement);
	}
?>