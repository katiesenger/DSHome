<?php
function addMenuItem($MenuName,$PagePath,$Sequence,$RequiresAuthentication,$ParentItem,$Color)
{
  
  try {
    include_once 'dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("INSERT INTO tMenu (MenuName, PagePath, Sequence, RequiresAuthentication, ParentItem, Color) VALUES (':MenuName', ':PagePath', ':Sequence', ':RequiresAuthentication', ':ParentItem', ':Color')");
    $stmt->bindParam(':MenuName',$MenuName);
    $stmt->bindParam(':PagePath',$PagePath);
    $stmt->bindParam(':Sequence',$Sequence);
    $stmt->bindParam(':RequiresAuthentication',$RequiresAuthentication);
    $stmt->bindParam(':ParentItem',$ParentItem);
    $stmt->bindParam(':Color',$Color);

    $stmt->execute();
    $dbh = null;
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
    echo "<p class='debug'>$stmt</p>";
    if ($stmt->execute(array($MenuID))) {
    while ($row = $stmt->fetch()) {
      echo "<form id='edit' method='post' action='editMenu.php?u=$userID' autocomplete='on'>";
			echo "<input type='hidden' id='MenuID' name ='MenuID' value='$MenuID'>";
      echo "<input type='hidden' id='action' name='action' value='edit'/>";
      $MenuName = $row['MenuName'];
      echo "<br />Menu Item Name: <input type='text' name'MenuName' id='MenuName' value='$MenuName' />";
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
      dropdown("tMenu",$ParentItem);
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
function listMenu()
{
  try {
    include_once 'dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT * FROM tMenu ORDER BY Sequence");
    if ($stmt->execute()) {
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
?>