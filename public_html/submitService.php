<html>
<head>
	<title> Submit Services </title>
</head>
<body>
<?php 

	//make querystring variable into local variable
	include_once './panels/getVariables.php';
	
	$qString = $_SERVER['QUERY_STRING'];
	echo "<p class='debug'>Q: $qString</p>";
	$userID = $_GET['u'];
	echo "<p class='debug'>U: $userID</p>";
	
	$updateString = "UPDATE tUserService SET DateSubmitted=now() WHERE UserID=$userID AND DateSubmitted is null";
	echo "<p class='debug'>$updateString</p>";
	$updateString = "UPDATE tUserService SET DateSubmitted=now() WHERE UserID=:UserID AND DateSubmitted is null";
	
	include_once './panels/dbConnect.php';
	$dbh = OpenConn();
  $stmt = $dbh->prepare($updateString); 
	$stmt->bindParam(":UserID",$userID);
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