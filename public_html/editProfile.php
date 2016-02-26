<html>
<head>
	<meta charset = "utf-8">
	<title>Edit Profile</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
<h2>My Profile</h2>
<?	
	include_once './panels/getVariables.php';
	$userID = getUser();
	
	include_once 'panels/menu.php'; 
	echo "<div class='box'>";

	$getDetails = "SELECT * FROM tUser WHERE UserID='$userID'";
	echo "<p class='debug'>Query: $getDetails </p>";
	
	include_once './panels/dbConnect.php';
	
	$dbh = OpenConn();
  $stmt = $dbh->prepare("SELECT * FROM tUser WHERE UserID=:userID");
	$stmt->bindParam(":userID",$userID);
	$stmt->execute();
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
 if(count($results) =1)
	{
		echo "<form method='post' name='getList' action='updateProfile.php' autocomplete='on'>";
		echo "<table class='displayData'>";
		echo "<tr><th>User ID</th><td><label name='userid' value='" . $results['UserID'] ."/>$row[0]</td></tr>";
		echo "<tr><th>User Name</th><td>". $results['UserName'] . "</td></tr>";
		echo "<tr><th>First Name</th><td><input type='text' name='firstname' value='". $results['Firstame'] . "' /></td></tr>";
		echo "<tr><th>Last Name</th><td><input type='text' name='lastname' value='". $results['LastNAme'] . "' /></td></tr>";
		echo "<tr><th>Email</th><td><input type='text' name='email' value='". $results['Email'] . "' /></td></tr>";
		echo "<tr><th>Existing Password</th><td><input type='password' name='oldPass' /></td></tr>";
	 echo "<tr><th>New Password</th><td><input type='password' name='Pass1' /></td></tr>";
	 echo "<tr><th>Confirm New Password</th><td><input type='password' name='Pass2' /></td></tr>";
	 echo "<tr><th>Phone Number</th><td><input type='text' name='phonenumber' value='". $results['PhoneNumber'] . "' /></td></tr>";
		echo "<tr><th>Mailing Address</th><td><input type='text' name='mailingaddress' value='". $results['MailingAddress'] . "' /></td></tr>";
		echo "<tr><th>Street Address</th><td><input type='text' name='streetaddress' value='". $results['StreetAddress'] . "' /></td></tr>";
		echo "<tr><th>City</th><td><input type='text' name='city' value='". $results['City'] . "' /></td></tr>";
		echo "<tr><th>Province/State</th><td><input type='text' name='province' value='". $results['Province'] . "' /></td></tr>";
		echo "<tr><th>Country</th><td><input type='text' name='country' value='". $results['Country'] . "' /></td></tr>";
		echo "<tr><th>Post Code</th><td><input type='text' name='postcode' value='". $results['PostCode'] . "' /></td></tr>";
		echo "<tr><th>Admin</th><td><input type='text' name='isAdmin' value='". $results['IsAdmin'] . "' /></td></tr>";
		echo "<tr><th>Staff</th><td><input type='text' name='isStaff' value='". $results['IsStaff'] . "' /></td></tr>";
	 echo "<tr><th>Contact</th><td><input type='text' name='isContact' value='". $results['IsContact'] . "' /></td></tr>";

	PasswordQuestion1 nvarchar(100) NULL,
	PasswordAnswer1 nvarchar(100) NULL,
	PasswordQuestion2 nvarchar(100) NULL,
	PasswordAnswer2 nvarchar(100) NULL,
	PasswordQuestion3 nvarchar(100) NULL,
	PasswordAnswer3 nvarchar(100) NULL,
	PasswordQuestion4 nvarchar(100) NULL,
	PasswordAnswer4 nvarchar(100) NULL,
	PasswordQuestion5 nvarchar(100) NULL,
	PasswordAnswer5 nvarchar(100) NULL,
	PasswordQuestion6 nvarchar(100) NULL,
	PasswordAnswer6 nvarchar(100) NULL,
	LastLogin DateTime,
	LastLogout DateTime,
	LastPasswordChange DateTime,
	CreationDate DateTime,
	IsLockedOut int(1),
	LastLockedOutDate DateTime,
	LastChanged DateTime,
	LastEditBy nvarchar(100)
	
	
	}
	echo "<tr><td colspan='2'><input type='submit' value='Update Profile'/></td></tr>";
	echo "</table></form>";

	print("<form method='post' name='deleteUser' action='deleteUser.php' autocomplete='on'>");
	print("<input type='hidden' name='userid' value='$userID' />");
	print("<input type='submit' value='Delete My Profile'/>");
	print("</form>");

}
	else
 {
		echo "<p class='error'>There is an error with your profile, please contact a staff member</p>"; 
 }
	

	?>
</div>
</body>
</html>