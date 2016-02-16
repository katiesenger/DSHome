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
  include_once './panels/dbFunction.php';
	$userID = getUser();
	include_once 'panels/menu.php';
  include_once 'dbConnect.php';
	include_once './panels/getDropdown.php';
  
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
  
  $qString = $action = $value = $MenuID = $filterBy = $orderBy = "";
  $qString = $_SERVER['QUERY_STRING'];
  if($qString != "")
	{
		$action = getQString('action'); //list, select, sort, add, edit, delete, filter, like
		$value = getQString('v');
		$MenuID = getQString('i');
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
			include_once 'dbConnect.php';
			$returnID = getReturnValue("tMenu","MenuName",$MenuName,"MenuID");
      if($returnID==null OR $returnID == 0)
      {
        $addQuery = "INSERT INTO tMenu (MenuName, PagePath, Sequence, RequiresAuthentication, ParentItem, Color) VALUES ('$MenuName', '$PagePath', '$Sequence', '$RequiresAuthentication', '$ParentItem', '$Color')";
  		echo "<p class='debug'>$addQuery</p>";
				include_once 'dbConnect.php';
				if ( !( $result = mysql_query( $addQuery) ) ) {
					echo "<p class='error'>Could not add $value " . mysql_error() . "</p>";
				}
			}
			else{
				echo "<p class='error'>$value already exists</p>";
				listData($listQuery);
			}
			break;
		case "select":
			$selectQuery = $listQuery . " WHERE tMenu.MenuID=$MenuID";
			$result = mysql_query($selectQuery);
			while($row = mysql_fetch_row($result)){
				$MenuID = $row[0];
				$MenuName = $row[1];
				$PagePath = $row[2];
				$Sequence = $row[3];
				$RequiresAuthentication = $row[4];
				$ParentItem = $row[5];
				$Color = $row[6];
			}
			echo "<form id='edit' method='post' action='editMenu.php?u=$userID' autocomplete='on'>";
			echo "<input type='hidden' id='MenuID' name ='MenuID' value='$MenuID'>";
      echo "<input type='hidden' id='action' name='action' value='edit'/>";
      echo "<br />Menu Item Name: <input type='text' name'MenuName' id='MenuName' value='$MenuName' />";
      echo "<br />Page Path: <input type='text' name='PagePath' id='PagePath' value='$PagePath' />";
      echo "<br />Sequence: <input type='text' name='Sequence' id='Sequence' value='$Sequence' />";
      echo "<br />Requires Authentication: ";
      echo "<input type = 'radio' name='RequiresAuthentication' id='RequiresAuthentication' value='1' ";
      if($RequiresAuthentication==1)
        echo " checked='checked' ";
      echo "/> Yes ";
      echo "<input type = 'radio' name='RequiresAuthentication' id='RequiresAuthentication' value='0'  ";
      if($RequiresAuthentication==0)
        echo " checked='checked' ";
      echo "/> No ";
      dropdown("tMenu",$ParentItem);
      echo "<br />Color: ";
      echo "<input type = 'radio' name='Color' id='Color' value='black' ";
      if($Color=="black")
        echo " checked='checked' ";
      echo "/> black ";
      echo "<input type = 'radio' name='Color' id='Color' value='white' ";
      if($Color=="white")
        echo " checked='checked' ";
      echo "/> white ";
      echo "<input type = 'radio' name='Color' id='Color' value='grey' ";
      if($Color=="grey")
        echo " checked='checked' ";
      echo "/> grey ";
      echo "<br /><input type='submit' name='update' value='update' />";
			echo "</form>";
			break;
		case "edit":
			$fields = "MenuName, PagePath, Sequence, RequiresAuthentication, ParentItem, Color";
      foreach($fields as $field)
      {
        $newValue = $POST_[$field];
        $oldValue = getReturnValue("tMenu",$field,$newValue);
        if($oldValue!=$newValue)
        {
          $editQuery = "UPDATE tMenu SET $field='$newValue' Where MenuID='$MenuID'";
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
    function filterDropDown($fields){
   dropdownFields($fields,"Filter By","filterBy",$filterBy);
}

function orderDropDown($fields){
  dropdownFields($fields,"Order By","orderBy",$orderBy);
}
	listData($listQuery);
	function listData($listQuery)
	{
	
		if ( !( $result = mysql_query( $listQuery) ) ) {
			echo "<p class='error'>Could not find menu listing " . mysql_error() . "</p>";
		}
		else {
			echo "<h2>Menu</h2>";
    $fields = array("MenuID","MenuName","PagePath","Sequence","RequiresAuthentication","ParentItem","Color");
      //orderDropDown($fields);
      //filterDropDown($fields);
      $data = mysql_query( $listQuery);
			echo "<form><table class='displayData'>";
			// printing table rows
      echo "<tr><th>&nbsp;</th><th>ID</th>";
      $count = count($fields)+1;
      echo "<tr><td colspan='$count'>$count</td></tr>";
      foreach($fields as $field)
      {
        echo "<th>$field</th>";
      }
  echo "</tr>";
      
      $userID = getUser();
      while($row = mysql_fetch_row($result))
      {
        echo "<tr>";
        echo "<td>";
        echo "<a href='editMenu.php?u=$userID&i=$row[0]&action=select'>Edit</a> ";
        echo "<a href='editMenu.php?u=$userID&i=$row[0]&action=delete'>Delete</a> ";
        echo "</td>";
        for($i=0;$i<$count-1;$i++)
        {
          if($i==4)
					{	
						if($row[$i]==1)
							echo "<td>Yes</td>";
						else
							echo "<td>No</td>";
					}
					else {
						echo "<td>$row[$i]</td>";
					}
					
        }
        echo "</tr>\n";
      }
		mysql_free_result($result);

		echo "</table></form>";
		echo "<br /><br /><a href='newMenu.php?u=$userID'>Add Menu Item</a>";
		}
	}
	
	?>
</div>
</body>
</html>
