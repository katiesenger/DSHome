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
include_once './panels/getDropdown.php';
$userID = getUser();
include_once './panels/menu.php';
  
  echo "<div class='box'>";
  echo "</table></form>";
  echo "<form id='add' method='post' action='addMenu.php?u=$userID&action=add' autocomplete='on' type='submit'>";
  echo "<br />Menu Item Name: <input type='text' name'MenuName' id='MenuName' />";
  echo "<br />Page Path: <input type='text' name='PagePath' id='PagePath' />";
  echo "<br />Sequence: <input type='text' name='Sequence' id='Sequence' />";
  echo "<br />Requires Authentication: ";
  echo "<input type = 'radio' name='RequiresAuthentication' id='RequiresAuthentication' value='1' checked='checked' /> Yes ";
  echo "<input type = 'radio' name='RequiresAuthentication' id='RequiresAuthentication' value='0' /> No ";
  dropdown("tMenu","");
  echo "<br />Color: ";
  echo "<input type = 'radio' name='Color' id='Color' value='black' /> black ";
  echo "<input type = 'radio' name='Color' id='Color' value='white' /> white ";
  echo "<input type = 'radio' name='Color' id='Color' value='grey' /> grey ";
  echo "<br /><input type='submit' value='submit' id='submit' />";
  echo "</form>";
  echo "</div>";
?>
  </body></html>