<?php
 
function getStatementValue($checkStatement){
   	include_once 'dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare($checkStatement);
    if ($stmt->execute()) {
    while ($row = $stmt->fetch()) {
    {
			echo "<p class='debug'>Value: $row[0]</p>";
			return $row[0];
		}
	$dbh = null;
	}
function getReturnValue($table,$returnColumn,$checkColumn,$checkValue){
   	include_once 'dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT :returnColumn FROM :table WHERE :checkColumn=:checkValue");
		$stmt->bindParam(":returnColumn",$returnColumn);
		$stmt->bindParam(":table",$table);
		$stmt->bindParam(":checkColumn",$checkColumn);
		$stmt->bindParam(":checkValue",$checkValue);
    if ($stmt->execute()) {
    while ($row = $stmt->fetch()) {
    {
			echo "<p class='debug'>Value: $row[0]</p>";
			return $row[0];
		}
	$dbh = null;
	}
?>