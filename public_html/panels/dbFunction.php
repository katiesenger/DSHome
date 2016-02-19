<?php
 
function getStatementValue($checkStatement){
   	include_once 'dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare($checkStatement);
    if ($stmt->execute()) 
		{
			while ($row = $stmt->fetch()) 
			{
				echo "<p class='debug'>Value: $row[0]</p>";
				return $row[0];
			}
	$dbh = null;
	}
}
function getReturnValue($table,$returnColumn,$checkColumn,$checkValue){
  
	include_once 'dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT :returnColumn FROM :table WHERE :checkColumn=:checkValue");
		$stmt->bindParam(":returnColumn",$returnColumn);
		$stmt->bindParam(":table",$table);
		$stmt->bindParam(":checkColumn",$checkColumn);
		$stmt->bindParam(":checkValue",$checkValue);
  echo ":: SELECT $returnColumn FROM $table WHERE $checkColumn='$checkValue'";
	if ($stmt->execute()) 
		{
			while ($row = $stmt->fetch()) 
			{
				echo "<p class='debug'>Value: $row[0]</p>";
				return $row[0];
			}
		}
	$dbh = null;
	}
function getStatementByQuery() {
		$qString = $_SERVER['QUERY_STRING'];
	echo "<p class='debug'>Q: $qString</p>";

	$table = $_GET['t'];
	$idColumn  = $_GET['i'];
	$checkValue = $_GET['v'];
	$checkColumn = $_GET['c'];
	$friendly = $_GET['f'];
	$checkStatement = "$friendly :: SELECT $idColumn FROM $table WHERE $checkColumn='$checkValue'";

	   include_once 'dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT :returnColumn FROM :table WHERE :checkColumn=:checkValue");
		$stmt->bindParam(":returnColumn",$idColumn);
		$stmt->bindParam(":table",$table);
		$stmt->bindParam(":checkColumn",$checkColumn);
		$stmt->bindParam(":checkValue",$checkValue);
    if ($stmt->execute()) 
		{
			while ($row = $stmt->fetch()) 
			{
				echo "<p class='debug'>$friendly =  $row[0]</p>";
				return $row[0];
			}
		}
	$dbh = null;
	}
?>