<!DOCTYPE html>
<!-- 	Purpose: Reset Password by answering questions --> 
<html>
<head>
	<meta charset = "utf-8">
	<title>Password Reset</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h2>Password Reset</h2>
<?php
	include_once './panels/getVariables.php';
	$userID = getUser();
	include_once './panels/menu.php';
  
?>
	<div class='box'>
	<?php
  $r1 = getPost('PasswordResponse1');
  $r2 = getPost('PasswordResponse2');
  $r3 = getPost('PasswordResponse3');
  $r4 = getPost('PasswordResponse4');
  $r5 = getPost('PasswordResponse5');
  $r6 = getPost('PasswordResponse6');
  $a1 = getPost('PasswordAnswer1');
  $a2 = getPost('PasswordAnswer2');
  $a3 = getPost('PasswordAnswer3');
  $a4 = getPost('PasswordAnswer4');
  $a5 = getPost('PasswordAnswer5');
  $a6 = getPost('PasswordAnswer6');
  $pass1 = getPost('Pass1');
  $pass2 = getPost('Pass2');
		$username = getPost('username');
	if($r1==$a1 and $r2==$a2 and $r3==$a3 and $r4==$a4 and $r5==$a5 and $r6==$a6 and $pass1==$pass2)
  {
    echo "<p class='debug'>$pass1 for $userID</p>";
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
		$stmt = $dbh->prepare("UPDATE tUser SET UPassword=:pwd WHERE UserName=:username");
    $stmt->bindParam(":pwd",$pass1);
		$stmt->bindParam(":username",$username);
		$stmt->execute();
    echo "<form method='post' name='getList' action='index.php' autocomplete='on'>";
    echo "User Name: <input type='text' name='username' />";
    echo "<input type='submit' name='submit' value='submit'/ >";
  }
  else
  {
    echo "<p class='error'>One of your questions was answered incorrectly, please try again or contact support.</p>";
  }
  
  
?>
<!--<script language="JavaScript">document.getList.submit();</script>-->
</body>
</html>