<!DOCTYPE html>
<!-- 	Purpose: crud Prioritys --> 
<html>
<head>
	<meta charset = "utf-8">
	<title>Priority Management</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h2>Priority Management</h2>
<?php
	include_once './panels/getVariables.php';
	$userID = getUser();
	include_once './panels/menu.php';

 
?>
	<div class='box'>
	<?php
  $PriorityID = $PriorityName = $Price = $ShopHours = "";
  $PriorityID = getPost('PriorityID');
  $PriorityName = getPost('PriorityName');
  
  $fields = "PriorityName";
  
  $qString = $action = $value = $id = $filterBy = $orderBy = "";
  $qString = $_SERVER['QUERY_STRING'];
  if($qString != "")
	{
		$action = getQString('action'); //list, select, sort, add, edit, delete, filter, like
		$value = getQString('v');
		$id = getQString('i');
  }

	if(empty($PriorityID) AND !empty($id))
	{
		$PriorityID=$id;
	}
    
function addPriorityItem($PriorityName)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("INSERT INTO tPriority (PriorityName) VALUES (:PriorityName)");
    $stmt->bindParam(':PriorityName',$PriorityName);
    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$PriorityName added.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function updatePriorityItem($PriorityName,$PriorityID)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
		echo "<p class='debug'>UPDATE tPriority SET PriorityName=$PriorityName WHERE PriorityID=$PriorityID</p>";
    $stmt = $dbh->prepare("UPDATE tPriority SET PriorityName=:PriorityName WHERE PriorityID=:PriorityID");
    $stmt->bindParam(':PriorityName',$PriorityName);
    $stmt->bindParam(":PriorityID",$PriorityID);
    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$PriorityName updated.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function getPriorityItem($PriorityID,$userID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT * FROM tPriority where PriorityID=?");
    if ($stmt->execute(array($PriorityID))) {
    while ($row = $stmt->fetch()) {
      echo "<form id='edit' method='post' action='priority.php?u=$userID&action=edit' autocomplete='on'>";
			echo "<input type='hidden' id='PriorityID' name='PriorityID' value='$PriorityID'>";
      echo "<input type='hidden' id='action' name='action' value='edit'/>";
      $PriorityName = $row['PriorityName'];
      echo "<br />Priority Item Name: <input type='text' name='PriorityName' id='PriorityName' value='$PriorityName' />";
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
    
    function showNew($userID)
    {
      echo "<form id='add' method='post' action='priority.php?u=$userID&action=add' autocomplete='on' type='submit'>";
      echo "<br />Priority Item Name: <input type='text' name='PriorityName' id='PriorityName' />";
      echo "<br /><input type='submit' value='submit' id='submit' />";
      echo "</form>";
    }
function listPriority($userID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT tPriority.PriorityID, tPriority.PriorityName FROM tPriority ORDER BY PriorityName");
    if ($stmt->execute()) {
			echo "<h2>Priority</h2>";
    	$fields = array("PriorityID","PriorityName");
			echo "<form><table class='displayData'>";
      echo "<tr><th>&nbsp;</th><th>ID</th><th>Priority Name</th></tr>";
    	while ($row = $stmt->fetch()) {
				echo "<tr>";
				echo "<td>";
				echo "<a href='priority.php?u=".$userID."&i=".$row['PriorityID']."&action=select'>Edit</a> ";
				echo "<a href='priority.php?u=".$userID."&i=".$row['PriorityID']."&action=delete'>Delete</a> ";
				echo "</td>";
				echo "<td>".$row['PriorityName']."</td>";
        echo "</tr>";
				}
			}
	$dbh = null;
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function deletePriorityItem($PriorityID)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("DELETE from tPriority WHERE PriorityID=:PriorityID");
    $stmt->bindParam(':PriorityID',$PriorityID);
		if ($stmt->execute()) {
			echo "<p class='debug'>$PriorityID Deleted</p>";
		}
	}
	catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
    
  $listQuery = "SELECT PriorityID, PriorityName FROM tPriority";// ORDER BY PriorityName";
	
		echo "<p class='debug'>Action: $action </p>";
  switch($action) {
		case "list":
      	listData($listQuery,$userID);
			break;
		case "sort":
			$listQuery = $listQuery . " ORDER BY $value";
      	listData($listQuery,$userID);
			break;
    case "filter":
      $listQuery = $listQuery . " WHERE $columnName = $value";
      	listData($listQuery,$userID);
      break;
    case "like":
      $listQuery = $listQuery . " WHERE $columnName like '%" . $value . "%'";
      	listData($listQuery,$userID);
      break;
		case "delete":
			deletePriorityItem($PriorityID);
      	listData($listQuery,$userID);
			break;
    case "new":
      showNew($userID);
      break;
		case "add":
			addPriorityItem($PriorityName);
      	listData($listQuery,$userID);
			break;
		case "select":
			echo "<p class='debug'>PriorityID: $PriorityID :: ID: $id</p>";
			if($PriorityID != "")
				getPriorityItem($PriorityID,$userID);
			else if($id != "")
				getPriorityItem($id,$userID);
			break;
		case "edit":
			updatePriorityItem($PriorityName,$PriorityID);
      	listData($listQuery,$userID);
			break;
    case "":
      listData($listQuery,$userID);
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
		listPriority($userID);
		echo "<br /><br /><a href='priority.php?u=$userID&action=new'>Add Priority Item</a>";
		
	}
	?>
		<script language="JavaScript">document.getList.submit();</script>
</div>
</body>
</html>
