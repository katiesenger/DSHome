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
function getReturnValue($table,$checkColumn,$value,$returnColumn)
{
	$checkStatement = "SELECT $returnColumn FROM $table WHERE $checkColumn='$value'";
	return getThisValue($checkStatement);
}

	function displayValue($table,$checkColumn,$value,$returnColumn,$showBeside=0)
	{
	
	$checkStatement = "SELECT $getColumn FROM $table WHERE $idColumn='$checkValue'";
	$value = getReturnValue($table,$checkColumn,$value,$returnColumn);
	if($showBeside==1)
		{
			echo "<th>$friendly</th><td>$value</td>";
		}
		else{
			echo $value;
		}
	}

function deleteRow($table,$id,$deleteQuery)
{
	if(getReturnValue($table,"ID",$id,"ID")==$id)
			{
				include_once './dbConnect.php';
				if ( !( $result = mysql_query( $deleteQuery) ) ) {
				echo "<p class='error'>Could not remove $value from $table " . mysql_error() . "</p>";
			}
			else {
				echo "<p class='error'>Could not find $value to remove it from $table</p>";
			}
	}
}
?>