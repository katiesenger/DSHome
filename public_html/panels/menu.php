<?php
include_once './panels/getVariables.php';

$userID = $menuQuery = $authenticationRequired = $parentItem = "";
$userID = getUser();
echo "<p class='menu'>";
echo "<nav>";
echo "<ul>";

echo "<p class='debug'>User: $userID</p>";
echo "<form><input type='hidden' id='userID' name='userID' value='$userID' /></form>";

include_once 'dbMenuItem.php';

if(empty($userID)){
	getMenu("0",null);
	include_once './panels/loginPanel.php';
}
else
{
	getMenu("1",$userID);
}


echo "</ul>";
echo "</nav></p>\n";


	?>