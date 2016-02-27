<html>
<head>
	<meta charset = "utf-8">
	<title>Edit Profile</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
<h2>My Profile</h2>
<?php
	include_once './panels/getVariables.php';
	$userID = getUser();
	
	include_once 'panels/menu.php'; 
	echo "<div class='box'>";

	include_once './panels/dbConnect.php';
	
	$dbh = OpenConn();
  $stmt = $dbh->prepare("SELECT * FROM tUser WHERE UserID=:userID");
	$stmt->bindParam(":userID",$userID);
	$stmt->execute();
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
 
	echo "<form method='post' name='getList' action='updateProfile.php' autocomplete='on'>";
	echo "<table class='displayData'>";
echo "<tr><th>UserID</th><td><label name='userid' value='" . $results['UserID'] ."' />" . $results['UserID'] ."</td></tr>";
echo "<tr><th>UserName</th><td><input type='text' name='UserName' value='". $results['UserName'] . "' /></td></tr>";
echo "<tr><th>FirstName</th><td><input type='text' name='FirstName' value='". $results['FirstName'] . "' /></td></tr>";
echo "<tr><th>LastName</th><td><input type='text' name='LastName' value='". $results['LastName'] . "' /></td></tr>";
echo "<tr><th>Email</th><td><input type='text' name='Email' value='". $results['Email'] . "' /></td></tr>";
echo "<tr><th>PhoneNumber</th><td><input type='text' name='PhoneNumber' value='". $results['PhoneNumber'] . "' /></td></tr>";
echo "<tr><th>MailingAddress</th><td><input type='text' name='MailingAddress' value='". $results['MailingAddress'] . "' /></td></tr>";
echo "<tr><th>StreetAddress</th><td><input type='text' name='StreetAddress' value='". $results['StreetAddress'] . "' /></td></tr>";
echo "<tr><th>City</th><td><input type='text' name='City' value='". $results['City'] . "' /></td></tr>";
echo "<tr><th>Province</th><td><input type='text' name='Province' value='". $results['Province'] . "' /></td></tr>";
echo "<tr><th>Country</th><td><input type='text' name='Country' value='". $results['Country'] . "' /></td></tr>";
echo "<tr><th>PostCode</th><td><input type='text' name='PostCode' value='". $results['PostCode'] . "' /></td></tr>";
echo "<tr><th>IsStaff</th><td><label name='userid' value='" . $results['IsStaff'] ."' />" . $results['IsStaff'] ."</td></tr>";
echo "<tr><th>IsAdmin</th><td><label name='userid' value='" . $results['IsAdmin'] ."' />" . $results['IsAdmin'] ."</td></tr>";
echo "<tr><th>IsContact</th><td><label name='userid' value='" . $results['IsContact'] ."' />" . $results['IsContact'] ."</td></tr>";
echo "<tr><th>PasswordQuestion1</th><td><input type='text' name='PasswordQuestion1' value='". $results['PasswordQuestion1'] . "' /></td></tr>";
echo "<tr><th>PasswordAnswer1</th><td><input type='text' name='PasswordAnswer1' value='". $results['PasswordAnswer1'] . "' /></td></tr>";
echo "<tr><th>PasswordQuestion2</th><td><input type='text' name='PasswordQuestion2' value='". $results['PasswordQuestion2'] . "' /></td></tr>";
echo "<tr><th>PasswordAnswer2</th><td><input type='text' name='PasswordAnswer2' value='". $results['PasswordAnswer2'] . "' /></td></tr>";
echo "<tr><th>PasswordQuestion3</th><td><input type='text' name='PasswordQuestion3' value='". $results['PasswordQuestion3'] . "' /></td></tr>";
echo "<tr><th>PasswordAnswer3</th><td><input type='text' name='PasswordAnswer3' value='". $results['PasswordAnswer3'] . "' /></td></tr>";
echo "<tr><th>PasswordQuestion4</th><td><input type='text' name='PasswordQuestion4' value='". $results['PasswordQuestion4'] . "' /></td></tr>";
echo "<tr><th>PasswordAnswer4</th><td><input type='text' name='PasswordAnswer4' value='". $results['PasswordAnswer4'] . "' /></td></tr>";
echo "<tr><th>PasswordQuestion5</th><td><input type='text' name='PasswordQuestion5' value='". $results['PasswordQuestion5'] . "' /></td></tr>";
echo "<tr><th>PasswordAnswer5</th><td><input type='text' name='PasswordAnswer5' value='". $results['PasswordAnswer5'] . "' /></td></tr>";
echo "<tr><th>PasswordQuestion6</th><td><input type='text' name='PasswordQuestion6' value='". $results['PasswordQuestion6'] . "' /></td></tr>";
echo "<tr><th>PasswordAnswer6</th><td><input type='text' name='PasswordAnswer6' value='". $results['PasswordAnswer6'] . "' /></td></tr>";
echo "<tr><th>LastLogin</th><td><input type='text' name='LastLogin' value='". $results['LastLogin'] . "' /></td></tr>";
echo "<tr><th>LastLogout</th><td><input type='text' name='LastLogout' value='". $results['LastLogout'] . "' /></td></tr>";
echo "<tr><th>LastPasswordChange</th><td><input type='text' name='LastPasswordChange' value='". $results['LastPasswordChange'] . "' /></td></tr>";
echo "<tr><th>CreationDate</th><td><input type='text' name='CreationDate' value='". $results['CreationDate'] . "' /></td></tr>";
echo "<tr><th>IsLockedOut</th><td><label name='userid' value='" . $results['IsLockedOut'] ."' />" . $results['IsLockedOut'] ."</td></tr>";
echo "<tr><th>LastLockedOutDate</th><td><input type='text' name='LastLockedOutDate' value='". $results['LastLockedOutDate'] . "' /></td></tr>";
echo "<tr><th>LastChanged</th><td><input type='text' name='LastChanged' value='". $results['LastChanged'] . "' /></td></tr>";
echo "<tr><th>LastEditBy</th><td><input type='text' name='LastEditBy' value='". $results['LastEditBy'] . "' /></td></tr>";

echo "<tr><th>Existing Password</th><td><input type='password' name='ExistingPassword' /></td></tr>";
	echo "<tr><th>New Password</th><td><input type='password' name='Pass1' /></td></tr>";
	echo "<tr><th>Re-Enter Password</th><td><input type='password' name='Pass2' /></td></tr>";

	echo "<tr><td colspan='2'><input type='submit' value='Update Profile'/></td></tr>";
	echo "</table></form>";

	print("<form method='post' name='deleteUser' action='deleteUser.php' autocomplete='on'>");
	print("<input type='hidden' name='userid' value='$userID' />");
	print("<input type='submit' value='Delete My Profile'/>");
	print("</form>");

	?>
</div>
</body>
</html>