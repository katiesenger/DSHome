<!DOCTYPE html>
<!-- 	Purpose: crud inventory --> 
<html>
<head>
	<meta charset = "utf-8">
	<title>Inventory Management</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h2>Inventory Management</h2>
<?php
	include_once './panels/getVariables.php';
	include_once './panels/dbFunction.php';
	$userID = "";
	$userID = getPost("userid");
	include_once 'panels/menu.php';
?>
	<div class='box'>
	<?php
	$userID = $description = $inventoryType = $purchasePrice = $purchaseLocation = $customID = "";
	$inventoryLocation = $inventoryOwner = $picture1 = $picture2 = $inventoryCondition = "";

	$userID = getPost('userID');
	$description = getPost('description');
	$inventoryType = getPost('inventoryType');
	$purchasePrice = getPost('purchasePrice');
	$purchaseLocation = getPost('purchaseLocation');
	$inventoryLocation = getPost('inventoryLocation');
	$inventoryOwner = getPost('inventoryOwner');
  $inventoryCondition = getPost('inventoryCondition');
  $picture1 = getPost('picture1Path');
  $picture2 = getPost('picture2Path');
  $action = getPost('action');
  $upc = getPost('upc');
  $filterBy = getPost('orderBy');
  $sortBy = getPost('sortBy');
	$customID = getPost('customID');
		
  $qString = $_SERVER['QUERY_STRING'];

  if($qString != "")
	{
		$userID = getQString('u');
		$action = getQString('action'); //list, select, sort, add, edit, delete, filter, like
		$value = getQString('v');
		$id = getQString('i');
		$customID = getQString('c');
  }

	include_once 'dbConnect.php';
	include_once './panels/getDropdown.php';

	$inventoryQuery = "SELECT InventoryID, 	InventoryDescription, InventoryTypeID,	PurchasePrice,	PurchaseLocation,	InventoryLocationID,	InventoryOwnerID, Picture1Location, Picture2Location,	DateSold, InventoryConditionID, UPC, CustomID from tInventory";
	
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
			$deleteQuery = "DELETE FROM tInventory WHERE InventoryID=$value";
			deleteRow("tInventory",$id,$deleteQuery);
			break;
		case "add":
			if(getReturnValue("tInventory","UPC",$upc,"ID")==null and getReturnValue("tInventory","Description",$description,"ID")==null)
      {
        $addQuery = "INSERT INTO tInventory (InventoryDescription, InventoryTypeID,	PurchasePrice,	PurchaseLocation,	InventoryLocationID,	InventoryOwnerID, Picture1Location, Picture2Location,	DateSold, InventoryConditionID, UPC, CustomID) VALUES('$description','$inventoryType','$purchasePrice','$purchaseLocation','$inventoryLocation','$inventoryOwner','$picture1','$picture2','$dateSold','$inventoryCondition','$upc','$customID')";
  			if ( !( $result = mysql_query( $addQuery) ) ) {
					echo "<p class='error'>Could not add $value " . mysql_error() . "</p>";
				}
			}
			else{
				echo "<p class='error'>$value already exists</p>";
				listData();
			}
			break;
		case "select":
			echo "<form id='edit' method='post' action='inventoryFunction.php' autocomplete='on' type='submit'>";
			echo "<input type='hidden' id='InventoryID' name ='InventoryID' value='$id'>";
      echo "<input type='hidden' id='UserID' name='UserID' value='$userID'/>";
      echo "<input type='hidden' id='action' name='action' value='edit'/>";
      echo "<br />Description: <input type='text' name='InventoryDescription' id='InventoryDescription' />";
      dropdown("InventoryTypeID",$inventoryType);
      echo "<br />Purchase Price: <input type='text' name='PurchasePrice' id='PurchasePrice' value='$purchasePrice' />";
      echo "<br />Purchase Location: <input type='text' name='PurchaseLocation' id='PurchaseLocation' value='$purchaseLocation' />";
      dropdown("InventoryLocationID",$inventoryLocation);      
      dropdown("InventoryOwnerID",$inventoryOwner);
      echo "<br />Picture 1 File Path: <input type='text' name='Picture1Location' id='Picture1Location' value='$picture1'/><a href='$picture1'><img src='$picture1' alt='Picture 1' height='100px' width='100px' /></a>";
      echo "<br />Picture 2 File Path: <input type='text' name='Picture2Location' id='Picture2Location' value='$picture2'/><a href='$picture2'><img src='$picture2' alt='Picture 2' height='200px' width='200px' /></a>";
      echo "<br />Date Sold: <input type='text' name='DateSold' id='DateSold' value='$dateSold' placemarker='dd-mmm-yyyy' />";
      dropdown("InventoryConditionID",$inventoryCondition);
      echo "<br />UPC: <input type='text' name='upc' id='upc' value='$upc'/>";
			echo "<br />Custm ID: <input type='text' name='customID' id='customID' value='$customID' />";
      echo "<input type='submit' name='update' value='update' />";
			echo "</form>";
			break;
		case "edit":
			$fields = "InventoryDescription, InventoryTypeID,	PurchasePrice,	PurchaseLocation,	InventoryLocationID,	InventoryOwnerID, Picture1Location, Picture2Location,	DateSold, InventoryConditionID, UPC, CustomID";
      foreach($fields as $field)
      {
        $newValue = $POST_[$field];
        $oldValue = getReturnValue("tInventory",$field,$newValue);
        if($oldValue!=$newValue)
        {
          $editQuery = "UPDATE tInventory SET $field='$newValue' Where InventoryID='$id'";
					if ( !( $result = mysql_query( $editQuery) ) ) {
						echo "<p class='error'>Could not edit $value " . mysql_error() . "</p>";
					}
          else{
            echo "<p class='debug'>$field updated from $oldValue to $newValue</p>";
          }
        }
      }
      break;
	}
		$fields = "InventoryDescription, InventoryTypeID,	PurchasePrice,	PurchaseLocation,	InventoryLocationID,	InventoryOwnerID, Picture1Location, Picture2Location,	DateSold, InventoryConditionID, UPC, CustomID";
function filterDropDown(){
  
  dropdownFields($fields,"Filter By","filterBy",$filterBy);
}
function orderDropDown(){
  dropdownFields($fields,"Order By","orderBy",$orderBy);
}

	listData($listQuery);
	function listData($listQuery)
	{
	
		if ( !( $result = mysql_query( $listQuery) ) ) {
			echo "<p class='error'>Could not find inventory listing " . mysql_error() . "</p>";
		}
		else {
			echo "<h2>Inventory</h2>";
			orderDropDown();
      filterDropDown();
      $data = mysql_query( $listQuery,$database);
			echo "<form><table class='displayData'>";
			// printing table rows
      echo "<tr><th>&nbsp;</th><th>ID</th>";
      foreach($fields as $field)
      {
        echo "<th>$field</th>";
      }
  echo "</tr>";
unset($_SERVER['QUERY_STRING']);
			$count = count($fields)+1;
      while($row = mysql_fetch_row($result))
      {
        echo "<tr>";
        echo "<td>";
        echo "<a href='Inventory.php?u=$userID&i=$row[0]&action=select'>Edit</a> ";
        echo "<a href='Inventory.php?u=$userID&i=$row[0]&action=select'>Delete</a> ";
        echo "</td>";
        for($i=1;$i<=$count;$i++)
        {
          echo "<td>$row[$i]</td>";
        }
        echo "</tr>\n";
      }
		mysql_free_result($result);
		echo "</table></form>";
		}
	}
	
	?>
</div>
</body>
</html>
