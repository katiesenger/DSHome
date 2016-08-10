<html>
<head>
	<title> Send Email </title>
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
	echo "<p class='debug'>S: $subject</p>";
  $toEmail = $_GET['t'];
  echo "<p class='debug'>T: $toEmail</p>";
  $ccEmail = $_GET['c'];
  echo "<p class='debug'>C: $ccEmail</p>";
  $body = $_GET['b'];
  echo "<p class='debug'>B: $body</p>";
  
  $headers = "MIME-Version = 1.0 " . "\r\n";
  $headers .= "Content-Type=text/html; charset=UTF-8" . "\r\n";
  $headers .= "FROM: <webmaster@dshome.ca>" . "\r\n";
  $headers .= "CC: $ccEmail " . "\r\n";
  
  mailto($toEmail, $subject, $body, $headers);


  
	$insertString = "INSERT INTO tEmail (ToEmail, CcEmail, Subject, Body, DateSent, SentBy) Values(:ToEmail, :CcEmail, :Subject, :Body, now(), :UserID);
        echo "<p class='debug'>Query: $insertString </p>";
	include_once './panels/dbConnect.php';
	$dbh = OpenConn();
  $stmt = $dbh->prepare($insertString); 
	$stmt->bindParam(":ToEmail", $toEmail);
        $stmt->bindParam(":CcEmail", $ccEmail);
        $stmt->bindParam(":Subject", $subject);
        $stmt->bindParam(":Body", $body);
        $stmt->bindParam(":UserID", $UserID);
	$stmt->execute();
	$dbh=null;
?>
<script language="JavaScript">document.getList.submit();</script>
</body>
</HTML>
