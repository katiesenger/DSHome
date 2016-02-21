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
  echo "<div class='box'>";
  
  $MenuID =	$MenuName = $PagePath = $Sequence = $RequiresAuthentication = $ParentItem = $Color = "";
  $MenuID = getPost('MenuID');
  $MenuName = getPost('MenuName');
  $PagePath = getPost('PagePath');
  $Sequence = getPost('Sequence');
  $RequiresAuthentication = getPost('RequiresAuthentication');
  $ParentItem = getPost('ParentItem');
  $Color = getPost('Color');
	
	include_once './panels/dbFunction.php';
	
  $returnID = getReturnValue("tMenu","MenuName",$MenuName,"MenuID");
  if($returnID==null OR $returnID == 0)
  {
    include_once './panels/dbMenuItem.php';
		addMenuItem($MenuName,$PagePath,$Sequence,$RequiresAuthentication,$ParentItem,$Color);		
		echo "<form method='post' name='getList' action='editMenu.php?u=$userID' autocomplete='on'>";
  	echo "<input type='hidden' name='userid' value='$userID' />";
		echo "<input type='submit' value='Request Services'/>";
		echo "</form>";

	}
	else{
		echo "<p class='error'>$value already exists</p>";
    echo "<form method='post' name='getList' action='newMenu.php?u=$userID' autocomplete='on'>";
  	echo "<input type='hidden' name='userid' value='$userID' />";
		echo "<input type='submit' value='Request Services'/>";
		echo "</form>";

	}
	
  ?>
  </div>
  <script language="JavaScript">document.getList.submit();</script>
  </body></html>