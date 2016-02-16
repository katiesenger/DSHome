<?php
$mysqli = mysqli_init();
include_once './panels/getVariables.php';

$userID = $menuQuery = $authenticationRequired = $parentItem = "";
$userID = getUser();
echo "<p class='menu'>";
echo "<nav>";
echo "<ul>";

echo "<p class='debug'>User: $userID";
echo "<form><input type='hidden' id='userID' name='userID' value='$userID' /></form>";

if(empty($userID)){
$menuQuery = "SELECT MenuName,PagePath,Color, ParentItem, Sequence FROM tMenu WHERE RequiresAuthentication=0 ORDER BY ParentItem, Sequence";
	include_once './panels/loginPanel.php';
}
else
{
	$menuQuery = "SELECT MenuName,PagePath,Color, ParentItem, Sequence FROM tMenu WHERE RequiresAuthentication=1 ORDER BY ParentItem, Sequence";
}

include_once './dbConnect.php';
$thisData =  $database->query($menuQuery);
while($row = $thisData->fetch_assoc())
	{
		echo "<li><a href='".$row['PagePath']."?u=".$userID."' class='" . $row['Color'] . "Button'>".$row['MenuName']."</a></li>";
	}
echo "</ul>";
echo "</nav></p>\n";
$thisData->close();

	?>