<?php
function addMenuItem($MenuName,$PagePath,$Sequence,$RequiresAuthentication,$ParentItem,$Color)
{
  
  try {
    include_once 'dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("INSERT INTO tMenu (MenuName, PagePath, Sequence, RequiresAuthentication, ParentItem, Color) VALUES (:MenuName, :PagePath, :Sequence, :RequiresAuthentication, :ParentItem, :Color)");
    $stmt->bindParam(':MenuName',$MenuName);
    $stmt->bindParam(':PagePath',$PagePath);
    $stmt->bindParam(':Sequence',$Sequence);
    $stmt->bindParam(':RequiresAuthentication',$RequiresAuthentication);
    $stmt->bindParam(':ParentItem',$ParentItem);
    $stmt->bindParam(':Color',$Color);

    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$MenuName added.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function updateMenuItem($MenuName,$PagePath,$Sequence,$RequiresAuthentication,$ParentItem,$Color,$MenuID)
{
  
  try {
    include_once 'dbConnect.php';
    $dbh = OpenConn();
		echo "<p class='debug'>UPDATE tMenu SET MenuName=$MenuName, PagePath=$PagePath, Sequence=$Sequence, RequiresAuthentication=$RequiresAuthentication, ParentItem=$ParentItem, Color=$Color WHERE MenuID=$MenuID</p>";
    $stmt = $dbh->prepare("UPDATE tMenu SET MenuName=:MenuName, PagePath=:PagePath, Sequence=:Sequence, RequiresAuthentication=:RequiresAuthentication, ParentItem=:ParentItem, Color=:Color WHERE MenuID=:MenuID");
    $stmt->bindParam(':MenuName',$MenuName);
    $stmt->bindParam(':PagePath',$PagePath);
    $stmt->bindParam(':Sequence',$Sequence);
    $stmt->bindParam(':RequiresAuthentication',$RequiresAuthentication);
    $stmt->bindParam(':ParentItem',$ParentItem);
    $stmt->bindParam(':Color',$Color);
		$stmt->bindParam(":MenuID",$MenuID);
    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$MenuName updated.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function getMenuItem($MenuID,$userID)
{
  try {
    include_once 'dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT * FROM tMenu where MenuID=?");
    if ($stmt->execute(array($MenuID))) {
    while ($row = $stmt->fetch()) {
      echo "<form id='edit' method='post' action='editMenu.php?u=$userID' autocomplete='on'>";
			echo "<input type='hidden' id='MenuID' name='MenuID' value='$MenuID'>";
      echo "<input type='hidden' id='action' name='action' value='edit'/>";
      $MenuName = $row['MenuName'];
      echo "<br />Menu Item Name: <input type='text' name='MenuName' id='MenuName' value='$MenuName' />";
      $PagePath = $row['PagePath'];
      echo "<br />Page Path: <input type='text' name='PagePath' id='PagePath' value='$PagePath' />";
      $Sequence = $row['Sequence'];
      echo "<br />Sequence: <input type='text' name='Sequence' id='Sequence' value='$Sequence' />";
      echo "<br />Requires Authentication: ";
      $RequiresAuthentication = $row['RequiresAuthentication'];
      echo "<input type = 'radio' name='RequiresAuthentication' id='RequiresAuthentication' value='1' ";
      if($RequiresAuthentication==1)
        echo " checked='checked' ";
      echo "/> Yes ";
      echo "<input type = 'radio' name='RequiresAuthentication' id='RequiresAuthentication' value='0'  ";
      if($RequiresAuthentication==0)
        echo " checked='checked' ";
      echo "/> No ";
      $ParentItem = $row['ParentItem'];
      getMenuDropDown($ParentItem);
      echo "<br />Color: ";
      $Color = $row['Color'];
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
			
    }
    $dbh = null;
  }
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}


function getMenu($requiresAuthentication, $userID)
{
  try {
    include_once 'dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT * FROM tMenu where RequiresAuthentication=? ORDER BY Sequence");
    if ($stmt->execute(array($requiresAuthentication))) {
    while ($row = $stmt->fetch()) {
		  echo "<li><a href='".$row['PagePath']."?u=".$userID."' class='" . $row['Color'] . "Button'>".$row['MenuName']."</a></li>";
	   }
    }
      else {
        echo "<li>No Menu Items for $requiresAuthentication</li>";
      }    
$dbh = null;
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function listMenu($userID)
{
  try {
    include_once 'dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT tMenu.MenuID, tMenu.MenuName, tMenu.PagePath, tMenu.Sequence, tMenu.RequiresAuthentication, tParentMenu.MenuName as ParentItem, tMenu.Color FROM tMenu left outer join tMenu as tParentMenu on tMenu.ParentItem=tParentMenu.MenuID ORDER BY Sequence");
    if ($stmt->execute()) {
			echo "<h2>Menu</h2>";
    	$fields = array("MenuID","MenuName","PagePath","Sequence","RequiresAuthentication","ParentItem","Color");
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
				echo "<a href='editMenu.php?u=".$userID."&i=".$row['MenuID']."&action=select'>Edit</a> ";
				echo "<a href='editMenu.php?u=".$userID."&i=".$row['MenuID']."&action=delete'>Delete</a> ";
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
function getMenuDropDown($selected)
{
	include_once 'dbConnect.php';
	$dbh = OpenConn();
	$stmt = $dbh->prepare("SELECT MenuID, MenuName from tMenu ORDER BY MenuName");
	if ($stmt->execute()) {
		echo "<br />Parent Menu Item: <select name='ParentItem' required=true>";
		while ($row = $stmt->fetch()) {
			echo "<option value='".$row['MenuID']."' ";
			if($selected==$row['MenuID'] OR $selected==$row['MenuName'])
				echo "selected=true ";
		echo ">".$row['MenuName']."</option>";
		}
	echo "</select>\n";
	}
		else{echo "Broken";}
	$dbh=null;
	
}
function deleteMenuItem($MenuID)
{
  
  try {
    include_once 'dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("DELETE from tMenu WHERE MenuID=:MenuID");
    $stmt->bindParam(':MenuID',$MenuID);
		if ($stmt->execute()) {
			echo "<p class='debug'>$MenuID Deleted</p>";
		}
	}
	catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
?>