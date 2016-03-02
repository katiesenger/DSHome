<!DOCTYPE html>
<!-- 	Purpose: crud Links --> 
<html>
<head>
	<meta charset = "utf-8">
	<title>Link Management</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h2>Link Management</h2>
<?php
	include_once './panels/getVariables.php';
	$userID = getUser();
	include_once './panels/menu.php';

 
?>
	<div class='box'>
	<?php
  $LinkID = $LinkName = $LinkDestination= "";
  $LinkID = getPost('LinkID');
  $LinkName = getPost('LinkName');
  $LinkDestination = getPost('LinkDestination');
  
  $fields = "LinkName,LinkDestination";
  
  $qString = $action = $value = $id = $filterBy = $orderBy = "";
  $qString = $_SERVER['QUERY_STRING'];
  if($qString != "")
	{
		$action = getQString('action'); //list, select, sort, add, edit, delete, filter, like
		$value = getQString('v');
		$id = getQString('i');
  }

	if(empty($LinkID) AND !empty($id))
	{
		$LinkID=$id;
	}
    
function addLinkItem($LinkName, $LinkDestination)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("INSERT INTO tLink (LinkName,LinkDestination) VALUES (:LinkName,:LinkDestination)");
    $stmt->bindParam(':LinkName',$LinkName);
    $stmt->bindParam(':LinkDestination',$LinkDestination);
    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$LinkName added.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function updateLinkItem($LinkName,$LinkDestination, $LinkID)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
		echo "<p class='debug'>UPDATE tLink SET LinkName=$LinkName,LinkDestionation=$LinkDestination WHERE LinkID=$LinkID</p>";
    $stmt = $dbh->prepare("UPDATE tLink SET LinkName=:LinkName,LinkDestination=:LinkDestination WHERE LinkID=:LinkID");
    $stmt->bindParam(':LinkName',$LinkName);
    $stmt->bindParam(':LinkDestination',$LinkDestination);
    $stmt->bindParam(":LinkID",$LinkID);
    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$LinkName updated.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function getLinkItem($LinkID,$userID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT * FROM tLink where LinkID=?");
    if ($stmt->execute(array($LinkID))) {
    while ($row = $stmt->fetch()) {
      echo "<form id='edit' method='post' action='link.php?u=$userID&action=edit' autocomplete='on'>";
			echo "<input type='hidden' id='LinkID' name='LinkID' value='$LinkID'>";
      echo "<input type='hidden' id='action' name='action' value='edit'/>";
      $LinkName = $row['LinkName'];
      echo "<br />Link Item Name: <input type='text' name='LinkName' id='LinkName' value='$LinkName' />";
			$LinkDestination = $row['LinkDestination'];
      echo "<br />Link Destination: <input type='text' name='LinkDestination' id='LinkName' value='$LinkDestination' />";
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
      echo "<form id='add' method='post' action='link.php?u=$userID&action=add' autocomplete='on' type='submit'>";
      echo "<br />Link Item Name: <input type='text' name='LinkName' id='LinkName' />";
      echo "<br />Link Destination: <input type='text' name='LinkDestination' id='LinkDestination' />";
      echo "<br /><input type='submit' value='submit' id='submit' />";
      echo "</form>";
    }
function listLink($userID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT tLink.LinkID, tLink.LinkName, tLink.LinkDestination FROM tLink ORDER BY LinkName");
    if ($stmt->execute()) {
			echo "<h2>Link</h2>";
    	$fields = array("LinkID","LinkName");
			echo "<form><table class='displayData'>";
      echo "<tr><th>&nbsp;</th><th>ID</th><th>Link Name</th></tr>";
    	while ($row = $stmt->fetch()) {
				echo "<tr>";
				echo "<td>";
				echo "<a href='link.php?u=".$userID."&i=".$row['LinkID']."&action=select'>Edit</a> ";
				echo "<a href='link.php?u=".$userID."&i=".$row['LinkID']."&action=delete'>Delete</a> ";
				echo "</td>";
				echo "<td><a href='".$row['LinkDestination']."'>".$row['LinkName']."</a></td>";
        echo "<td>".$row['LinkDestination']."</td>";
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
function deleteLinkItem($LinkID)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("DELETE from tLink WHERE LinkID=:LinkID");
    $stmt->bindParam(':LinkID',$LinkID);
		if ($stmt->execute()) {
			echo "<p class='debug'>$LinkID Deleted</p>";
		}
	}
	catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
    
  $listQuery = "SELECT LinkID, LinkName, LinkDestination FROM tLink";// ORDER BY LinkName";
	
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
			deleteLinkItem($LinkID);
      	listData($listQuery,$userID);
			break;
    case "new":
      showNew($userID);
      break;
		case "add":
			addLinkItem($LinkName, $LinkDestination);
      	listData($listQuery,$userID);
			break;
		case "select":
			echo "<p class='debug'>LinkID: $LinkID :: ID: $id</p>";
			if($LinkID != "")
				getLinkItem($LinkID,$userID);
			else if($id != "")
				getLinkItem($id,$userID);
			break;
		case "edit":
			updateLinkItem($LinkName,$LinkDestination,$LinkID);
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
		listLink($userID);
		echo "<br /><br /><a href='link.php?u=$userID&action=new'>Add Link Item</a>";
		
	}
	?>
		<script language="JavaScript">document.getList.submit();</script>
</div>
</body>
</html>
