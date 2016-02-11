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
	$userID = "";
	$userID = $_POST["userid"];
	include_once 'panels/menu.php';
?>
	<div class='box'>
	<?php
	$userID = $description = $inventoryType = $purchasePrice = $purchaseLocation = "";
	$inventoryLocation = $inventoryOwner = $picture1 = $picture2 = $inventoryCondition = "";

	$userID = $_POST['userID'];
	$description = $_POST['description'];
	$inventoryType = $_POST['inventoryType'];
	$purchasePrice = $_POST['purchasePrice'];
	$purchaseLocation = $_POST['purchaseLocation'];
	$inventoryLocation = $_POST['inventoryLocation'];
	$inventoryOwner = $_POST['inventoryOwner'];
  $inventoryCondition = $_POST['inventoryCondition'];
  $picture1 = $_POST['picture1Path'];
  $picture2 = $_POST['picture2Path'];
  $action = $_POST['action'];
  $upc = $_POST['upc'];
  $filterBy = $_POST['orderBy'];
  $sortBy = $_POST['sortBy'];

  $qString = $_SERVER['QUERY_STRING'];

  if($qString != "")
	{
		$userID = $_GET['u'];
		$action = $_GET['action']; //list, select, sort, add, edit, delete, filter, like
		$value = $_GET['v'];
		$id = $_GET['i'];
  }

	include_once 'dbConnect.php';

	function checkValue($columnName,$value,$returnColumn)
	{
		$checkStatement = "SELECT $returnColumn FROM tInventory WHERE $columnName = '$value'";
		$existingResult = mysql_query($checkStatment, $database);
		$rows = mysql_num_rows($existingResult);
		if ($rows == 0) {		return null;	}
		else{	return $rows[0]; }
		mysql_close();
	}
function dropdown($simpleTable,$selected==null){
		$friendlyName = $columnName = $idColumn = $nameColumn ="";
		$words = preg_split('/(?=[A-Z])/',$table);
		$count = count($words)-2;
		for($i=0,$i<=count,$i++)
		{
			$friendlyName=$friendlyName . " " . $words[$i];
			$columnName = $columnName . $words[$i];
		}
		$idColumn = $columnName . "ID";
		$nameColumn = $columnName . "Name";
    $table = "t" . $columnName;
	}
  echo "<p class='debug'>Gathering $nameColumn and $idColumn from $table to label as $friendlyName</p>";
	
	$thisQuery = "SELECT $idColumn, $nameColumn FROM $table WHERE $nameColumn IS NOT NULL ORDER BY $nameColumn;"
	echo "<p class='debug'>$thisQuery</p>";

	include_once 'dbConnect.php';

	$thisData = mysql_query( $thisQuery,$database);
	echo "<br /><select name=$idColumn required=true>";
	while($row = mysql_fetch_row($result))
	{
		echo "<option value='$row[0]' ";
			if($selected==$row[1])
				echo "selected=true ";
		echo ">$row[1]</option>"
	}
	echo "</select>\n";
	mysql_free_result($result);
}
	
  $inventoryQuery = "SELECT InventoryID, 	InventoryDescription, InventoryTypeID,	PurchasePrice,	PurchaseLocation,	InventoryLocationID,	InventoryOwnerID, Picture1Location, Picture2Location,	DateSold, InventoryConditionID, UPC from tInventory";
	
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
			if(checkValue("ID",$value,"ID")==$value)
			{
				$deleteQuery = "DELETE FROM tInventory WHERE InventoryID=$value";
				if ( !( $result = mysql_query( $deleteQuery) ) ) {
					echo "<p class='error'>Could not remove $value  " . mysql_error() . "</p>";
				}
			}
			else {
				echo "<p class='error'>Could not find $value to remove it</p>";
			}
			break;
		case "add":
			if(checkValue("UPC",$upc,"ID")==null && checkValue("Description",$description,"ID")==null)
      {
        $addQuery = "INSERT INTO tInventory (InventoryDescription, InventoryTypeID,	PurchasePrice,	PurchaseLocation,	InventoryLocationID,	InventoryOwnerID, Picture1Location, Picture2Location,	DateSold, InventoryConditionID, UPC) VALUES('$description','$inventoryType','$purchasePrice','$purchaseLocation','$inventoryLocation','$inventoryOwner','$picture1','$picture2','$dateSold','$inventoryCondition','$upc')"
  
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
			$existingValue = getValue();
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
      echo "<input type='submit' name='update' value='update' />";
			echo "</form>";
			break;
		case "edit":
			$fields = "InventoryDescription, InventoryTypeID,	PurchasePrice,	PurchaseLocation,	InventoryLocationID,	InventoryOwnerID, Picture1Location, Picture2Location,	DateSold, InventoryConditionID, UPC";
      foreach($field in $fields)
      {
        $newValue = $POST_[$field];
        $oldValue = checkValue($field,$newValue);
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
function filterDropDown(){
  $fields = "InventoryDescription, InventoryTypeID,	PurchasePrice,	PurchaseLocation,	InventoryLocationID,	InventoryOwnerID, Picture1Location, Picture2Location,	DateSold, InventoryConditionID, UPC";
  echo "Filter By: <select id='filterBy' name='filterBy'>";
  echo "<option value='none'";
  if($filterBy=="")
      echo "selected=selected";
  echo ">No Filter</option>";
      foreach($field in $fields)
      {
        echo "<option value='$field'";
        if($filterBy==$field)
          echo "selected=selected";
        echo ">$field</option>'"
      }
  echo "</select>";
}
function orderDropDown(){
  $fields = "InventoryDescription, InventoryTypeID,	PurchasePrice,	PurchaseLocation,	InventoryLocationID,	InventoryOwnerID, Picture1Location, Picture2Location,	DateSold, InventoryConditionID, UPC";
  echo "Order By: <select id='orderBy' name='orderBy'>";
  echo "<option value='All' ";
  if($orderBy=="")
      echo "selected=selected";
  echo ">Show All</option>";
      foreach($field in $fields)
      {
        echo "<option value='$field' ";
        if($orderBy==$field)
          echo "selected=selected";
        echo ">$field</option>'"
      }
  echo "</select>";
}

	listData();
	function listData()
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
    $fields = "InventoryDescription, InventoryTypeID,	PurchasePrice,	PurchaseLocation,	InventoryLocationID,	InventoryOwnerID, Picture1Location, Picture2Location,	DateSold, InventoryConditionID, UPC";
      echo "<tr><th>&nbsp;</th><th>ID</th>";
      foreach($field in $fields)
      {
        echo "<th>$field</th>";
      }
  echo "</tr>";
      $count = count($fields)+1;
      while($row = mysql_fetch_row($result))
      {
        echo "<tr>";
        echo "<td>";
        echo "<a href='Inventory.php?u=$userID&i=$row[0]&action=select'>Edit</a> ";
        echo "<a href='Inventory.php?u=$userID&i=$row[0]&action=select'>Delete</a> ";
        echo "</td>";
        for($i=1,$i<=$count,$i++)
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

</div>
</body>
</html>
