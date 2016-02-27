<!DOCTYPE html>
<!-- 	Purpose: crud CaseStatuss --> 
<html>
<head>
	<meta charset = "utf-8">
	<title>Case Status Management</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h2>Case Status Management</h2>
<?php
	include_once './panels/getVariables.php';
	$userID = getUser();
	include_once './panels/menu.php';

 
?>
	<div class='box'>
	<?php
  $CaseStatusID = $CaseStatusName = $Price = $ShopHours = "";
  $CaseStatusID = getPost('CaseStatusID');
  $CaseStatusName = getPost('CaseStatusName');
  
  $fields = "CaseStatusName";
  
  $qString = $action = $value = $id = $filterBy = $orderBy = "";
  $qString = $_SERVER['QUERY_STRING'];
  if($qString != "")
	{
		$action = getQString('action'); //list, select, sort, add, edit, delete, filter, like
		$value = getQString('v');
		$id = getQString('i');
  }

	if(empty($CaseStatusID) AND !empty($id))
	{
		$CaseStatusID=$id;
	}
    
function addCaseStatusItem($CaseStatusName)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("INSERT INTO tCaseStatus (CaseStatusName) VALUES (:CaseStatusName)");
    $stmt->bindParam(':CaseStatusName',$CaseStatusName);
    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$CaseStatusName added.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function updateCaseStatusItem($CaseStatusName,$CaseStatusID)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
		echo "<p class='debug'>UPDATE tCaseStatus SET CaseStatusName=$CaseStatusName WHERE CaseStatusID=$CaseStatusID</p>";
    $stmt = $dbh->prepare("UPDATE tCaseStatus SET CaseStatusName=:CaseStatusName WHERE CaseStatusID=:CaseStatusID");
    $stmt->bindParam(':CaseStatusName',$CaseStatusName);
    $stmt->bindParam(":CaseStatusID",$CaseStatusID);
    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$CaseStatusName updated.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function getCaseStatusItem($CaseStatusID,$userID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT * FROM tCaseStatus where CaseStatusID=?");
    if ($stmt->execute(array($CaseStatusID))) {
    while ($row = $stmt->fetch()) {
      echo "<form id='edit' method='post' action='caseStatus.php?u=$userID&action=edit' autocomplete='on'>";
			echo "<input type='hidden' id='CaseStatusID' name='CaseStatusID' value='$CaseStatusID'>";
      echo "<input type='hidden' id='action' name='action' value='edit'/>";
      $CaseStatusName = $row['CaseStatusName'];
      echo "<br />Case Status Item Name: <input type='text' name='CaseStatusName' id='CaseStatusName' value='$CaseStatusName' />";
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
      echo "<form id='add' method='post' action='caseStatus.php?u=$userID&action=add' autocomplete='on' type='submit'>";
      echo "<br />Case Status Item Name: <input type='text' name='CaseStatusName' id='CaseStatusName' />";
      echo "<br /><input type='submit' value='submit' id='submit' />";
      echo "</form>";
    }
function listCaseStatus($userID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT tCaseStatus.CaseStatusID, tCaseStatus.CaseStatusName FROM tCaseStatus ORDER BY CaseStatusName");
    if ($stmt->execute()) {
			echo "<h2>Case Status</h2>";
    	$fields = array("CaseStatusID","CaseStatusName");
			echo "<form><table class='displayData'>";
      echo "<tr><th>&nbsp;</th><th>ID</th><th>Case Status Name</th></tr>";
    	while ($row = $stmt->fetch()) {
				echo "<tr>";
				echo "<td>";
				echo "<a href='caseStatus.php?u=".$userID."&i=".$row['CaseStatusID']."&action=select'>Edit</a> ";
				echo "<a href='caseStatus.php?u=".$userID."&i=".$row['CaseStatusID']."&action=delete'>Delete</a> ";
				echo "</td>";
				echo "<td>".$row['CaseStatusName']."</td>";
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
function deleteCaseStatusItem($CaseStatusID)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("DELETE from tCaseStatus WHERE CaseStatusID=:CaseStatusID");
    $stmt->bindParam(':CaseStatusID',$CaseStatusID);
		if ($stmt->execute()) {
			echo "<p class='debug'>$CaseStatusID Deleted</p>";
		}
	}
	catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
    
  $listQuery = "SELECT CaseStatusID, CaseStatusName FROM tCaseStatus";// ORDER BY CaseStatusName";
	
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
			deleteCaseStatusItem($CaseStatusID);
      	listData($listQuery,$userID);
			break;
    case "new":
      showNew($userID);
      break;
		case "add":
			addCaseStatusItem($CaseStatusName);
      	listData($listQuery,$userID);
			break;
		case "select":
			echo "<p class='debug'>Case StatusID: $CaseStatusID :: ID: $id</p>";
			if($CaseStatusID != "")
				getCaseStatusItem($CaseStatusID,$userID);
			else if($id != "")
				getCaseStatusItem($id,$userID);
			break;
		case "edit":
			updateCaseStatusItem($CaseStatusName,$CaseStatusID);
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
		listCaseStatus($userID);
		echo "<br /><br /><a href='caseStatus.php?u=$userID&action=new'>Add Case Status Item</a>";
		
	}
	?>
		<script language="JavaScript">document.getList.submit();</script>
</div>
</body>
</html>
