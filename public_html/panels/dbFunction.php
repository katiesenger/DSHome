<?php
 
function getThisValue($checkStatement){
   include_once 'dbConnect.php';
    echo "<p class='debug'>$checkStatement</p>";
		$existingResult = mysqli_query($checkStatement);
		while($row = mysqli_fetch_row($existingResult))
		{
			echo "<p class='debug'>Value: $row[0]</p>";
			return $row[0];
		}
	$existingResult->close();

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
	include_once 'dbConnect.php';
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
				if ( !( $result = mysqli_query( $deleteQuery) ) ) {
				echo "<p class='error'>Could not remove $id from $table " . mysql_error() . "</p>";
			}
			else {
				echo "<p class='error'>Could not find $id to remove it from $table</p>";
			}
	}
}
?>