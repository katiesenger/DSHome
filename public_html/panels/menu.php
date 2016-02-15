<?php

include_once './panels/getVariables.php';
include_once './dbConnect.php';
$userID = $menuQuery = $authenticationRequired = $parentItem = "";
$userID = getUser();
echo "<p class='menu'>";
echo "<nav>";
echo "<ul>";

echo "<p class='debug'>User: $userID";
echo "<form><input type='hidden' id='userID' name='userID' value='$userID' /></form>";

if(empty($userID)){
	$authenticationRequired = 0;
	include_once './panels/loginPanel.php';
}
else
{
	$authenticationRequired=1;
}

$menuQuery = "SELECT MenuName,PagePath,Color, ParentItem, Sequence FROM tMenu WHERE RequiresAuthentication=$authenticationRequired ORDER BY ParentItem, Sequence";

$thisData = mysql_query($menuQuery);
while($row = mysql_fetch_row($thisData))
	{
		echo "<li><a href='$row[1]?u=$userID' class='" . $row[2] . "Button'>$row[0]</a></li>";
	}
echo "</ul>";
mysql_free_result($thisData);
echo "</nav></p>\n";

	?>