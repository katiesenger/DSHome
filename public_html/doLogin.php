<html>
<head>
	<title>Login PHP</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<p class='debug'>Start Test</p>
	<?php

		$password = $username = $userid = "";
		$password = $_POST["password"];
		$username = $_POST["username"];
	
	include_once './panels/dbConnect.php';
	
	
  $dbh = OpenConn();
  $stmt = $dbh->prepare("SELECT UserID,UserName,UPassword FROM tUser Where UserName=:UserName"); 
	$stmt->bindParam(":UserName",$username);
	$stmt->execute();
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
 if(count($results) > 0 && $password===$results['UPassword']) // password_verify($password, $results['UPassword']))
	{
		$userid=$results['UserID'];
	 
		print("<H2>Login Completed</H2><p>Thanks $username, you have been logged in</p>");
		print("<form method='post' name='getList' action='home.php?$userid' autocomplete='on'>");
		print("<input type='hidden' name='userid' value='$userid' />");
		print("<input type='submit' value='Request Services'/>");
		print("</form>");
		attemptedLoginSuccess($userid);
	}
		else{
			die("<p class='error'>Password does not match file " . mysql_error() . "</p></body></html>");
			attemptedLoginFailure();
		}
	setLogin($userid);
	
	function setLogin($userid)
	{
		include_once './panels/dbConnect.php';
		$dbh = OpenConn();
  	$stmt = $dbh->prepare("UPDATE tUser Set LastLogin=getDate() WHERE UserID=:UserID"); 
		$stmt->bindParam(":UserID",$userid);
		$stmt->execute();
		$dbh = null;
	}
	function attemptedLoginSuccess($userid)
	{
		include_once './panels/dbConnect.php';
		$dbh = OpenConn();
  	$stmt = $dbh->prepare("INSERT INTO tLoginAttempt (UserID,Success,ApplicationID,IP,AttemptedDateTime) VALUES(:UserID,1,0,:ip,getDate())"); 
		$stmt->bindParam(":UserID",$userid);
		$stmt->bindParam(":ip",$_SERVER['REMOTE_ADDR']);
		$stmt->execute();
		$dbh = null;
	
	}
	function attemptedLoginFailure()
	{
		include_once './panels/dbConnect.php';
		$dbh = OpenConn();
  	$stmt = $dbh->prepare("INSERT INTO tLoginAttempt (UserID,Success,ApplicationID,IP,AttemptedDateTime) VALUES(0,0,0,:ip,getDate())"); 
		$stmt->bindParam(":UserID",$userid);
		$stmt->bindParam(":ip",$_SERVER['REMOTE_ADDR']);
		$stmt->execute();
		$dbh = null;
	
	}
	?>

<script language="JavaScript">document.getList.submit();</script> 

<p class='debug'>End Test</p>

</body>

</html>
