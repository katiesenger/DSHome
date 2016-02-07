<html>
 

<head>

 
	<meta charset = "utf-8">

 
	<title>Edit Profile</title>

 
	<link href="DSHome.css" rel="stylesheet" />

</head>


<body>

<h2>My Profile</h2>

<?	
	
	//make querystring variable into local variable
	
	$qString = $_SERVER['QUERY_STRING'];
	
	
	$userID = $_GET['u'];

	
	$error = $_GET['e'];
	
	if(!$error)
		
		echo "<p class='error'>$error</p>";



	php include_once 'panels/menu.php?$userID'; 

	echo "<div class='box'>";

	
	//echo out query string details
	
	echo "<p class='debug'>Q: $qString</p>";
	echo "<p class='debug'>U: $userID</p>";

	echo "<p class='debug'>E: $error</p>";



	$getDetails = "SELECT UserID, UserName, FirstName, LastName, Email, PhoneNumber, MailingAddress,StreetAddress,City,Province,Country,PostCode, IsStaff, IsAdmin FROM tUser WHERE UserID='$userID'";

//	$getDetails = "SELECT * FROM tUser WHERE UserID='$userID'";

	echo "<p class='debug'>Query: $getDetails </p>";


	include_once 'dbConnect.php';


	if (! ($result = mysql_query($getDetails))) {

		echo "<p class='error'>There is an error with your profile, please contact a staff member</p>";

	}

	else{

		echo $userID;

		$profile = mysql_query($getDetails,$database);

		echo "<form method='post' name='getList' action='updateProfile.php' autocomplete='on'>";

		echo "<table class='displayData'>";

		while($row = mysql_fetch_row($profile))

		{

			echo "<tr><th>User ID</th><td><input type='hidden' name='userid' value='$row[0]' />$row[0]</td></tr>";

			echo "<tr><th>User Name</th><td>$row[1]</td></tr>";

			echo "<tr><th>First Name</th><td><input type='text' name='firstname' value='$row[2]' /></td></tr>";

			echo "<tr><th>Last Name</th><td><input type='text' name='lastname' value='$row[3]' /></td></tr>";

			echo "<tr><th>Email</th><td><input type='text' name='email' value='$row[4]' /></td></tr>";

			echo "<tr><th>Phone Number</th><td><input type='text' name='phonenumber' value='$row[5]' /></td></tr>";

			echo "<tr><th>Mailing Address</th><td><input type='text' name='mailingaddress' value='$row[6]' /></td></tr>";

			echo "<tr><th>Street Address</th><td><input type='text' name='streetaddress' value='$row[7]' /></td></tr>";

			echo "<tr><th>City</th><td><input type='text' name='city' value='$row[8]' /></td></tr>";

			echo "<tr><th>Province/State</th><td><input type='text' name='province' value='$row[9]' /></td></tr>";

			echo "<tr><th>Country</th><td><input type='text' name='country' value='$row[10]' /></td></tr>";

			echo "<tr><th>Post Code</th><td><input type='text' name='postcode' value='$row[11]' /></td></tr>";

//			echo "<tr><th>Admin</th><td><input type='text' name='isAdmin' value='$row[13]' /></td></tr>";

//			echo "<tr><th>Staff</th><td><input type='text' name='isStaff' value=' $row[12]' /></td></tr>";


		}

		echo "<tr><td colspan='2'><input type='submit' value='Update Profile'/></td></tr>";


		echo "</table></form>";

	}


	mysql_close();

	
echo "<p class='debug'>UserID: $userID</p>";
	print("<form method='post' name='getList' action='ServiceRequest.php' autocomplete='on'>");

	print("<input type='hidden' name='userid' value='$userID' />");

	print("<input type='submit' value='Request Services'/>");

	print("</form>");


	print("<form method='post' name='deleteUser' action='deleteUser.php' autocomplete='on'>");

	print("<input type='hidden' name='userid' value='$userID' />");

	print("<input type='submit' value='Delete My Profile'/>");

	print("</form>");

	print("<form method='post' name='addStaff' action='addStaff.php' autocomplete='on'>");

	print("<input type='hidden' name='userid' value='$userID' />");

	print("<input type='submit' value='Add as Staff'/>");

	print("</form>");



	?>



	
</div>
</body>

</html>
