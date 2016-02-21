<!DOCTYPE html>
<!--Index Page -->

<head>
	<meta charset="utf=8">
	<title>DSHome.ca</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h1>Welcome to DSHome.ca</h1>
	<?php
	$userID ="";
	include_once './panels/menu.php';
	?>
	<div class='box'>
		
<?php
		include_once './panels/getVariables.php';
	$pass1 = $pass2 = $username = $firstname = $lastname = $email = "";
	$pass1 = getPost("Password1");
	$pass2 = getPost("Password2");
	$username = getPost("username");
	$firstname  = getPost("FirstName");
	$lastname = getPost("LastName");
	$email = getPost("email");

	if($pass1 != $pass2)
	{
		die("<p class='error'>Passwords do not match</p>");
	}
	else
	{
		echo "<p class='debug'>Passwords do match</p>";
	}

	include_once './panels/dbConnect.php';
	
	
  $dbh = OpenConn();
  $stmt = $dbh->prepare("SELECT UserID,UserName,UPassword, Email FROM tUser Where UserName=:UserName or Email=:Email"); 
	$stmt->bindParam(":UserName",$username);
	$stmt->bindParam(":Email",$email);
	$stmt->execute();
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
 	if(count($results) > 0 && $pass1===$results['UPassword']) // password_verify($password, $results['UPassword']))
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
			$dbh = null; 
			$dbh = OpenConn();
			$stmt = $dbh->prepare("INSERT INTO tUser(UserName,FirstName,LastName,Email,UPassword) VALUES(:username,:firstname,:lastname,:email,:pass1)");
			$stmt->bindParam(":username",$username);
			$stmt->bindParam(":firstname",$firstname);
			$stmt->bindParam(":lastname",$lastname);
			$stmt->bindParam(":email",$email);
			$stmt->bindParam(":pass1",$pass1);
			$stmt->execute();
			echo "<p class='debug'>User added</p>";
			$dbh = null;
														
			$dbh = OpenConn();
			$stmt = $dbh->prepare("SELECT UserID,UserName,UPassword FROM tUser Where UserName=:UserName"); 
			$stmt->bindParam(":UserName",$username);
			$stmt->execute();
			$results = $stmt->fetch(PDO::FETCH_ASSOC);
			if(count($results) > 0 && $pass1===$results['UPassword']) // password_verify($password, $results['UPassword']))
			{
				$userid=$results['UserID'];
				print("<H2>Login Completed</H2><p>Thanks $username, you have been logged in</p>");
				print("<form method='post' name='getList' action='home.php?$userid' autocomplete='on'>");
				print("<input type='hidden' name='userid' value='$userid' />");
				print("<input type='submit' value='Request Services'/>");
				print("</form>");
				attemptedLoginSuccess($userid);
				setLogin($userid);
			}
														
		}
	
	
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
	
	?>

<script language="JavaScript">document.getList.submit();</script> 

<p class='debug'>End Test</p>
	</div>
</body>

</html>
