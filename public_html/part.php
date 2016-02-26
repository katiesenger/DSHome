<!DOCTYPE html>
<!-- 	Purpose: crud parts --> 
<html>
<head>
	<meta charset = "utf-8">
	<title>Part Management</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h2>Part Management</h2>
<?php
	include_once './panels/getVariables.php';
	$userID = getUser();
	include_once './panels/menu.php';

 
?>
	<div class='box'>
	<?php
  $PartID = $PartName = $Price = $ShopHours = "";
  $PartID = getPost('PartID');
  $PartName = getPost('PartName');
  $Price = getPost('Price');
  $ShopHours = getPost('ShopHours');
	
  $fields = "PartName,Price,ShopHours";
  
  $qString = $action = $value = $id = $filterBy = $orderBy = "";
  $qString = $_SERVER['QUERY_STRING'];
  if($qString != "")
	{
		$action = getQString('action'); //list, select, sort, add, edit, delete, filter, like
		$value = getQString('v');
		$id = getQString('i');
  }

	if(empty($PartID) AND !empty($id))
	{
		$PartID=$id;
	}
    
function addPartItem($PartName,$Price, $ShopHours)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("INSERT INTO tPart (PartName, Price, ShopHours) VALUES (:PartName, :Price, :ShopHours)");
    $stmt->bindParam(':PartName',$PartName);
    $stmt->bindParam(':Price',$Price);
    $stmt->bindParam(':ShopHours',$ShopHours);
    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$PartName added.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function updatePartItem($PartName,$Price,$ShopHours,$PartID)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
		echo "<p class='debug'>UPDATE tPart SET PartName=$PartName, Price=$Price, ShopHours=$ShopHours WHERE PartID=$PartID</p>";
    $stmt = $dbh->prepare("UPDATE tPart SET PartName=:PartName, Price=:Price, ShopHours=:ShopHours WHERE PartID=:PartID");
    $stmt->bindParam(':PartName',$PartName);
    $stmt->bindParam(':Price',$Price);
    $stmt->bindParam(':ShopHours',$ShopHours);
    $stmt->bindParam(":PartID",$PartID);
    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$PartName updated.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function getPartItem($PartID,$userID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT * FROM tPart where PartID=?");
    if ($stmt->execute(array($PartID))) {
    while ($row = $stmt->fetch()) {
      echo "<form id='edit' method='post' action='service.php?u=$userID&action=edit' autocomplete='on'>";
			echo "<input type='hidden' id='PartID' name='PartID' value='$PartID'>";
      echo "<input type='hidden' id='action' name='action' value='edit'/>";
      $PartName = $row['PartName'];
      echo "<br />Part Item Name: <input type='text' name='PartName' id='PartName' value='$PartName' />";
      $Price = $row['Price'];
      echo "<br />Page Path: <input type='text' name='Price' id='Price' value='$Price' />";
      $ShopHours = $row['ShopHours'];
      echo "<br />ShopHours: <input type='text' name='ShopHours' id='ShopHours' value='$ShopHours' />";
      
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
      echo "<form id='add' method='post' action='service.php?u=$userID&action=add' autocomplete='on' type='submit'>";
      echo "<br />Part Item Name: <input type='text' name='PartName' id='PartName' />";
      echo "<br />Price: <input type='text' name='Price' id='Price' />";
      echo "<br />Shop Hours: <input type='text' name='ShopHours' id='ShopHours' />";
      echo "<br /><input type='submit' value='submit' id='submit' />";
      echo "</form>";
    }
function listPart($userID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT tPart.PartID, tPart.PartName, tPart.Price, tPart.ShopHours FROM tPart ORDER BY PartName");
    if ($stmt->execute()) {
			echo "<h2>Part</h2>";
    	$fields = array("PartID","PartName","Price","ShopHours");
			echo "<form><table class='displayData'>";
      echo "<tr><th>&nbsp;</th><th>ID</th>";
      foreach($fields as $field)
      {
        echo "<th>$field</th>";
      }
  		echo "</tr>";
    	while ($row = $stmt->fetch()) {
				echo "<tr>";
				echo "<td>";
				echo "<a href='service.php?u=".$userID."&i=".$row['PartID']."&action=select'>Edit</a> ";
				echo "<a href='service.php?u=".$userID."&i=".$row['PartID']."&action=delete'>Delete</a> ";
				echo "</td>";
				foreach($fields as $field)
				{
					echo "<td>$row[$field]</td>";
				}
			}
		}
	$dbh = null;
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function deletePartItem($PartID)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("DELETE from tPart WHERE PartID=:PartID");
    $stmt->bindParam(':PartID',$PartID);
		if ($stmt->execute()) {
			echo "<p class='debug'>$PartID Deleted</p>";
		}
	}
	catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
    
  $listQuery = "SELECT PartID, PartName, Price, ShopHours FROM tPart";// ORDER BY PartName";
	
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
			deletePartItem($PartID);
      	listData($listQuery,$userID);
			break;
    case "new":
      showNew($userID);
      break;
		case "add":
			addPartItem($PartName,$Price, $ShopHours);
      	listData($listQuery,$userID);
			break;
		case "select":
			echo "<p class='debug'>PartID: $PartID :: ID: $id</p>";
			if($PartID != "")
				getPartItem($PartID,$userID);
			else if($id != "")
				getPartItem($id,$userID);
			break;
		case "edit":
			updatePartItem($PartName,$Price, $ShopHours,$PartID);
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
		listPart($userID);
		echo "<br /><br /><a href='service.php?u=$userID&action=new'>Add Part Item</a>";
		
	}
	?>
		<script language="JavaScript">document.getList.submit();</script>
</div>
</body>
</html>
