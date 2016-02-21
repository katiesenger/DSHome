<html>
<head>
	<title> Add Service </title>
</head>
<body>
<?php 

	//make querystring variable into local variable
	include_once './panels/getVariables.php';
	
	$qString = $_SERVER['QUERY_STRING'];
	echo "<p class='debug'>Q: $qString</p>";
	$userID = $_GET['u'];
	echo "<p class='debug'>U: $userID</p>";
	$serviceID = $_GET['s'];
	echo "<p class='debug'>S: $serviceID</p>";

	$insertString = "INSERT INTO tUserService(UserID,ServiceID,DateRequested) VALUES(:userid,:serviceid,now())";
	echo "<p class='debug'>Query: $insertString </p>";

	include_once './panels/dbConnect.php';
	$dbh = OpenConn();
  $stmt = $dbh->prepare($insertString); 
	$stmt->bindParam(":userid",$userID);
	$stmt->bindParam(":serviceid",$serviceID);
	$stmt->execute();
	$dbh=null;
	
	echo "<form method='post' name='getList' action='ServiceRequest.php?u=$userID' autocomplete='on'>";
	echo "<input type='hidden' name='userid' value='$userID' />";
	echo "<input type='submit' value='Request Services'/>";
	echo "</form>";

?>
<script language="JavaScript">document.getList.submit();</script>
</body>
</html>