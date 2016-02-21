<html>
<head>
	<title> Cancel Service </title>
</head>
<body>
<?php 

	//make querystring variable into local variable
	$qString = $_SERVER['QUERY_STRING'];
	echo "<p class='debug'>Q: $qString</p>";

	$userID = $_GET['u'];
	echo "<p class='debug'>U: $userID</p>";

	$UserServiceID = $_GET['s'];
	echo "<p class='debug'>S: $UserServiceID</p>";

	$updateDate = "UPDATE tUserService SET DateComplete=now() WHERE UserServiceID=:UserServiceID";
	echo "<p class='debug'>Query: $updateDate</p>";

	$updateBy = "UPDATE tUserService SET CompleteByUserID=:userID WHERE UserServiceID=:UserServiceID";
	echo "<p class='debug'>Query: $updateBy</p>";

	$fullUpdate = "UPDATE tUserService SET CompleteByUserID=:userID, InvoiceID=0, DateComplete=now() WHERE UserServiceID=:UserServiceID";
	echo "<p class='debug'>Query: $fullUpdate</p>";

	include_once './panels/dbConnect.php';
	$dbh = OpenConn();
  $stmt = $dbh->prepare($fullUpdate); 
	$stmt->bindParam(":userID",$userID);
	$stmt->bindParam(":UserServiceID",$UserServiceID);
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
