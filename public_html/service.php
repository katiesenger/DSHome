<!DOCTYPE html>
<!-- 	Purpose: crud services --> 
<html>
<head>
	<meta charset = "utf-8">
	<title>Service Management</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h2>Service Management</h2>
<?php
	include_once './panels/getVariables.php';
	$userID = getUser();
	include_once './panels/menu.php';

 
?>
	<div class='box'>
	<?php
  $ServiceID = $ServiceName = $Price = $ShopHours = "";
  $ServiceID = getPost('ServiceID');
  $ServiceName = getPost('ServiceName');
  $Price = getPost('Price');
  $ShopHours = getPost('ShopHours');
	
  $fields = "ServiceName,Price,ShopHours";
  
  $qString = $action = $value = $id = $filterBy = $orderBy = "";
  $qString = $_SERVER['QUERY_STRING'];
  if($qString != "")
	{
		$action = getQString('action'); //list, select, sort, add, edit, delete, filter, like
		$value = getQString('v');
		$id = getQString('i');
  }

	if(empty($ServiceID) AND !empty($id))
	{
		$ServiceID=$id;
	}
    
function addServiceItem($ServiceName,$Price, $ShopHours)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("INSERT INTO tService (ServiceName, Price, ShopHours) VALUES (:ServiceName, :Price, :ShopHours)");
    $stmt->bindParam(':ServiceName',$ServiceName);
    $stmt->bindParam(':Price',$Price);
    $stmt->bindParam(':ShopHours',$ShopHours);
    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$ServiceName added.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function updateServiceItem($ServiceName,$Price,$ShopHours,$ServiceID)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
		echo "<p class='debug'>UPDATE tService SET ServiceName=$ServiceName, Price=$Price, ShopHours=$ShopHours WHERE ServiceID=$ServiceID</p>";
    $stmt = $dbh->prepare("UPDATE tService SET ServiceName=:ServiceName, Price=:Price, ShopHours=:ShopHours WHERE ServiceID=:ServiceID");
    $stmt->bindParam(':ServiceName',$ServiceName);
    $stmt->bindParam(':Price',$Price);
    $stmt->bindParam(':ShopHours',$ShopHours);
    $stmt->bindParam(":ServiceID",$ServiceID);
    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$ServiceName updated.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function getServiceItem($ServiceID,$userID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT * FROM tService where ServiceID=?");
    if ($stmt->execute(array($ServiceID))) {
    while ($row = $stmt->fetch()) {
      echo "<form id='edit' method='post' action='service.php?u=$userID&action=edit' autocomplete='on'>";
			echo "<input type='hidden' id='ServiceID' name='ServiceID' value='$ServiceID'>";
      echo "<input type='hidden' id='action' name='action' value='edit'/>";
      $ServiceName = $row['ServiceName'];
      echo "<br />Service Item Name: <input type='text' name='ServiceName' id='ServiceName' value='$ServiceName' />";
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
      echo "<br />Service Item Name: <input type='text' name='ServiceName' id='ServiceName' />";
      echo "<br />Price: <input type='text' name='Price' id='Price' />";
      echo "<br />Shop Hours: <input type='text' name='ShopHours' id='ShopHours' />";
      echo "<br /><input type='submit' value='submit' id='submit' />";
      echo "</form>";
    }
function listService($userID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT tService.ServiceID, tService.ServiceName, tService.Price, tService.ShopHours FROM tService ORDER BY ServiceName");
    if ($stmt->execute()) {
			echo "<h2>Service</h2>";
    	$fields = array("ServiceID","ServiceName","Price","ShopHours");
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
				echo "<a href='service.php?u=".$userID."&i=".$row['ServiceID']."&action=select'>Edit</a> ";
				echo "<a href='service.php?u=".$userID."&i=".$row['ServiceID']."&action=delete'>Delete</a> ";
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
function deleteServiceItem($ServiceID)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("DELETE from tService WHERE ServiceID=:ServiceID");
    $stmt->bindParam(':ServiceID',$ServiceID);
		if ($stmt->execute()) {
			echo "<p class='debug'>$ServiceID Deleted</p>";
		}
	}
	catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
    
  $listQuery = "SELECT ServiceID, ServiceName, Price, ShopHours FROM tService";// ORDER BY ServiceName";
	
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
			deleteServiceItem($ServiceID);
      	listData($listQuery,$userID);
			break;
    case "new":
      showNew($userID);
      break;
		case "add":
			addServiceItem($ServiceName,$Price, $ShopHours);
      	listData($listQuery,$userID);
			break;
		case "select":
			echo "<p class='debug'>ServiceID: $ServiceID :: ID: $id</p>";
			if($ServiceID != "")
				getServiceItem($ServiceID,$userID);
			else if($id != "")
				getServiceItem($id,$userID);
			break;
		case "edit":
			updateServiceItem($ServiceName,$Price, $ShopHours,$ServiceID);
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
		listService($userID);
		echo "<br /><br /><a href='service.php?u=$userID&action=new'>Add Service Item</a>";
		
	}
	?>
		<script language="JavaScript">document.getList.submit();</script>
</div>
</body>
</html>
