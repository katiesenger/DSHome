<!DOCTYPE html>
<!-- 	Purpose: crud menu --> 
<html>
<head>
	<meta charset = "utf-8">
	<title>Menu Management</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h2>Menu Management</h2>
<?php
	include_once './panels/getVariables.php';
	$userID = getUser();
	include_once './panels/menu.php';

 
?>
	<div class='box'>
	<?php
  $MenuID =	$MenuName = $PagePath = $Sequence = $RequiresAuthentication = $ParentItem = $Color = "";
  $MenuID = getPost('MenuID');
  $MenuName = getPost('MenuName');
  $PagePath = getPost('PagePath');
  $Sequence = getPost('Sequence');
  $RequiresAuthentication = getPost('RequiresAuthentication');
  $ParentItem = getPost('ParentItem');
  $Color = getPost('Color');
	
  $fields = "MenuName, PagePath, Sequence, RequiresAuthentication, ParentItem, Color";
  
  $qString = $action = $value = $id = $filterBy = $orderBy = "";
  $qString = $_SERVER['QUERY_STRING'];
  if($qString != "")
	{
		$action = getQString('action'); //list, select, sort, add, edit, delete, filter, like
		$value = getQString('v');
		$id = getQString('i');
  }

	if(empty($MenuID) AND !empty($id))
	{
		$MenuID=$id;
	}
	
  $listQuery = "SELECT tMenu.MenuID, tMenu.MenuName, tMenu.PagePath, tMenu.Sequence, tMenu.RequiresAuthentication, tParentMenu.MenuName, tMenu.Color FROM tMenu left outer join tMenu as tParentMenu on tMenu.ParentItem=tParentMenu.MenuID";
	
		echo "<p class='debug'>Action: $action </p>";
  switch($action) {
		case "list":
			break;
		case "sort":
			$listQuery = $listQuery . " ORDER BY $value";
			break;
    case "filter":
      $listQuery = $listQuery . " WHERE $columnName = $value";
      break;
    case "like":
      $listQuery = $listQuery . " WHERE $columnName like '%" . $value . "%'";
      break;
		case "delete":
			$deleteQuery = "DELETE FROM tMenu WHERE MenuID=$value";
			deleteRow("tMenu",$MenuID,$deleteQuery);
			break;
		case "add":
			include_once './panels/dbMenuItem.php';
			addMenuItem($MenuName,$PagePath,$Sequence,$RequiresAuthentication,$ParentItem,$Color);
			listData($listQuery,$userID);
			break;
		case "select":
			echo "<p class='debug'>MenuID: $MenuID :: ID: $id</p>";
			include_once './panels/dbMenuItem.php';
			if($MenuID != "")
				getMenuItem($MenuID,$userID);
			else if($id != "")
				getMenuItem($id,$userID);
			break;
		case "edit":
			include_once './panels/dbMenuItem.php';
			updateMenuItem($MenuName,$PagePath,$Sequence,$RequiresAuthentication,$ParentItem,$Color,$MenuID);
			//listData($listQuery,$userID);
			break;
	}
    function filterDropDown($fields){
   dropdownFields($fields,"Filter By","filterBy",$filterBy);
}

function orderDropDown($fields){
  dropdownFields($fields,"Order By","orderBy",$orderBy);
}
	listData($listQuery,$userID);
	function listData($listQuery,$userID)
	{
		include_once './panels/dbMenuItem.php';
		listMenu($userID);
		echo "<br /><br /><a href='newMenu.php?u=$userID'>Add Menu Item</a>";
		
	}
	
	?>
</div>
</body>
</html>
