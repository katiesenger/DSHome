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
	$qString = $UserID = $q1 = $q2 = $q3 = $username = "";
  include_once './panels/getVariables.php';
	$userID = getUser();
	include_once './panels/menu.php';

 
?>
	<div class='box'>
	<?php

	$qString = $_SERVER['QUERY_STRING'];
  if($qString <> "")
  {
    echo "<p class='debug'>Q: $qString</p>";
    $userID = $_GET['u'];
    echo "<p class='debug'>U: $userID</p>";
    $q1 = $_GET['q1'];
    $q2 = $_GET['q2'];
    $q3 = $_GET['q3'];
    echo "<p class='debug'>Qs: $q1, $q2, $q3</p>";
  }
  $username = getPost('username');
  if($username == "")
  {
    echo "<form method='post' name='getList' action='forgotPassword.php' autocomplete='on'>";
    echo "User Name: <input type='text' name='username' />";
    echo "<input type='submit' name='submit' value='submit'/ >";
  }
  else
  {
    echo "<p class='debug'>u: $username</p>";
		if($q1==""){
			$q1 = mt_rand(1,6);
			while($q1==$q2 OR $q2 =="")
			{
				$q2 = mt_rand(1,6);
			}
			while($q1==$q3 OR $q2 ==$q3 OR $q3 =="")
			{
				$q3 = mt_rand(1,6);
			}
		}
		$questions = "PasswordQuestion".$q1.",PasswordQuestion".$q2.",PasswordQuestion".$q3;
		echo "<p class='debug'>$questions</p>";
		
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
		$stmt = $dbh->prepare("SELECT UserID,UserName,UPassword,PasswordQuestion1, PasswordQuestion2,PasswordQuestion3,PasswordQuestion4,PasswordQuestion5,PasswordQuestion6,PasswordAnswer1, PasswordAnswer2,PasswordAnswer3,PasswordAnswer4,PasswordAnswer5,PasswordAnswer6 FROM tUser Where UserName=:UserName"); 
		$stmt->bindParam(":UserName",$username);
		$stmt->execute();
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
	 if(count($results) > 0)
    {
		 echo "<h2>Password Reset Feature</h2>";
      $UserID=$results['UserID'];
      echo "<form method='post' name='resetPassword' action='resetPassword.php?$userID' autocomplete='on'>";
		 	echo " <input type='hidden' name='userid' value='$userID' />";
		  echo "<br />".$results["PasswordQuestion".$q1].": <input type='text' name='PasswordResponse$q1' /> <input type='hidden' name='PasswordAnswer$q1' value='".$results["PasswordAnswer".$q1]."' />";
      echo "<br />".$results["PasswordQuestion".$q2].": <input type='text' name='PasswordResponse$q2' /> <input type='hidden' name='PasswordAnswer$q2' value='".$results["PasswordAnswer".$q2]."' />";
      echo "<br />".$results["PasswordQuestion".$q3].": <input type='text' name='PasswordResponse$q3' /> <input type='hidden' name='PasswordAnswer$q3' value='".$results["PasswordAnswer".$q3]."' />";
      echo "<br />New Password: <input type='password' name='Pass1' />";
      echo "<br />Confirm Password: <input type='password' name='Pass2' />";
		 echo "<input type='submit' name='submit' value='submit'/ >";
    }
    else{
      echo "<p class='error'>User Name not registered</p>";
    }
    $dbh=null;
  }
  
  
?>
<!--<script language="JavaScript">document.getList.submit();</script>-->
</body>
</html>