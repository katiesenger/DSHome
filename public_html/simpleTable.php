<!DOCTYPE html>
<!-- 	Purpose: crud simple table (ID and Name only)--> 
<html>
<head>
	<meta charset = "utf-8">
	<title>Simple Table Management</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h2>Simple Table Management</h2>
<?php
	include_once './panels/getVariables.php';
	$userID = getUser();
	
	
	$userID = getQString('u');
	$table = getQString('t');
	$action = getQString('action'); //list, select, sort, add, edit, delete
	$value = getQString('v');
	$id = getQString('i');

	$friendlyName = $columnName = $idColumn = $nameColumn ="";
	$words = preg_split('/(?=[A-Z])/',$table);
	$count = count($words);
	echo "<p class='debug'>$table has $count pieces</p>";
	for($i=0;$i<$count;$i++)
	{
		if($words[$i]=="t")
			$i++;
		echo "<p class='debug'>$i: $words[$i]</p>";
		$friendlyName=$friendlyName . " " . $words[$i];
		$columnName = $columnName . $words[$i];

	}
	$idColumn = $columnName . "ID";
	$nameColumn = $columnName . "Name";
	
	include_once './panels/menu.php';
	echo "<div class='box'>";
	$newValue = $existingValue = $textValue = "";
	
  function addItem($newValue,$table,$nameColumn,$idColumn)
	{
  	try {
			include_once './panels/dbConnect.php';
			$dbh = OpenConn();
			$stmt = $dbh->prepare("INSERT INTO :table (:nameColumn) VALUES (:newValue)");
			$stmt->bindParam(":table",$table);
			$stmt->bindParam(":nameColumn",$nameColumn);
			$stmt->bindParam(":newValue",$newValue);
			$stmt->execute();
			$dbh = null;
			echo "<p class='debug'>$newValue added.</p>";
		}
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function updateItem($newValue,$table,$nameColumn,$idColumn,$ID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
		$stmt = $dbh->prepare("UPDATE :table SET :nameColumn=:newValue WHERE :idColumn=:ID");
		$stmt->bindParam(":table",$table);
		$stmt->bindParam(":nameColumn",$nameColumn);
		$stmt->bindParam(":newValue",$newValue);
		$stmt->bindParam(":idColumn",$idColumn);
		$stmt->bindParam(":ID",$id);
		$stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$newValue updated.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function getItem($table,$idColumn,$ID,$nameColumn,$userID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT * FROM :table where :idColumn=?");
		$stmt->bindParam(":table",$table);
		$stmt->bindParam(":idColumn",$idColumn);
		$stmt->bindParam(":ID",$id);
    if ($stmt->execute(array($PartID))) {
    while ($row = $stmt->fetch()) {
      echo "<form id='edit' method='post' action='simpleTable.php?u=$userID&t=$table&action=edit' autocomplete='on'>";
			echo "<input type='hidden' id='ID' name='ID' value='".$row[$idColumn]."'>";
      echo "<input type='hidden' id='action' name='action' value='edit'/>";
      $existingValue = $row[$nameColumn];
      echo "<br />Item Name: <input type='text' name='ExisingName' id='ExistingName' value='".$row[$nameColumn]."' />";
      echo "<br /><input type='submit' name='update' value='update' />";
			echo "</form>";
    }
    $dbh = null;
  }
  }

  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
    
    function showNew($table,$idColumn,$nameColumn,$userID)
    {
      echo "<form id='add' method='post' action='simpleTable.php?u=$userID&t=$table&action=add' autocomplete='on' type='submit'>";
      echo "<br />Item Name: <input type='text' name='newName' id='newName' />";
      echo "<br /><input type='submit' value='submit' id='submit' />";
      echo "</form>";
    }
function listing($userID,$table)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT * FROM :table");
		$stmt->bindParam(":table",$table);
		if ($stmt->execute()) {
			echo "<p class='debug'>going in</p>";
			echo "<h2>$table</h2>";
			echo "<form><table class='displayData'>";
      echo "<tr><th>&nbsp;</th><th>ID</th><th>Name</th></tr>";
      while ($row = $stmt->fetch()) {
				echo "<tr>";
				echo "<td>";
				echo "<a href='simpleTable.php?u=".$userID."&t=$table&i=".$row[$idColumn]."&action=select'>Edit</a> ";
				echo "<a href='simpleTable.php?u=".$userID."&t=$table&i=".$row[$idColumn]."&action=delete'>Delete</a> ";
				echo "</td>";
				echo "<td>".$row[$idColumn]."</td>";
				echo "<td>".$row[$nameColumn]."</td>";
				echo "</tr>";
			}
		}else{ echo "<p class='debug'>Broke</p>";
	$dbh = null;
	
  }
	}
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function deleteItem($table,$idColumn,$id)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("DELETE from :table WHERE :idColumn=:id");
		$stmt->bindParam(":table",$table);
		$stmt->bindParam(":idColumn",$idColumn);
		$stmt->bindParam(":ID",$id);
		if ($stmt->execute()) {
			echo "<p class='debug'>$id Deleted</p>";
		}
	}
	catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
    
  $listQuery = "SELECT $idColumn,$nameColumn FROM $table";// ORDER BY PartName";
	
		echo "<p class='debug'>Action: $action </p>";
  switch($action) {
		case "list":
      	listing($userID,$table);
			break;
		case "sort":
			$listQuery = $listQuery . " ORDER BY $value";
      	listing($userID,$table);
			break;
    case "filter":
      $listQuery = $listQuery . " WHERE $columnName = $value";
      	listing($userID,$table);
      break;
    case "like":
      $listQuery = $listQuery . " WHERE $columnName like '%" . $value . "%'";
      	listing($userID,$table);
      break;
		case "delete":
			deleteItem($table,$idColumn,$id);
      	listing($userID,$table);
			break;
    case "new":
      showNew($table,$idColumn,$nameColumn,$userID);
      break;
		case "add":
			addItem($newValue,$table,$nameColumn,$idColumn);
      	listing($userID,$table);
			break;
		case "select":
			getItem($table,$idColumn,$ID,$nameColumn,$userID);
			break;
		case "edit":
			updateItem($newValue,$table,$nameColumn,$idColumn,$ID);
      	listing($userID,$table);
			break;
    case "":
      listing($userID,$table);
      break;
	}
    function filterDropDown($fields){
   dropdownFields($fields,"Filter By","filterBy",$filterBy);
}

function orderDropDown($fields){
  dropdownFields($fields,"Order By","orderBy",$orderBy);
}

	function listData($listQuery,$userID)
	{
		listing($userID,$table);
		echo "<br /><br /><a href='simpleTable.php?u=$userID&t=$table&action=new'>Add Item</a>";
		
	}
	?>
		<script language="JavaScript">document.getList.submit();</script>
</div>
</body>
</html>
