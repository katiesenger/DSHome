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
	$pass1 = $pass2 = $username = $firstname = $lastname = $email = "";

		$pass1 = $_POST["Password1"];

		$pass2 = $_POST["Password2"];

		$username = $_POST["username"];

		$firstname  = $_POST["FirstName"];

		$lastname = $_POST["LastName"];

		$email = $_POST["email"];



if($pass1 != $pass2)
{
	die("<p class='error'>Passwords do not match</p>");
}
else
{
	echo "<p class='debug'>Passwords do match</p>";
}

include_once './panels/dbConnect.php';
echo "<p class='debug'>connect</p>";
$existingQuery = "Select UserID FROM tUser where UserName='$username' or email='$email'";
echo "<p class='debug'>$existingQuery</p>";
$existingResult = mysql_query($existingQuery, $database);
$rows = mysql_num_rows($existingResult);

if (! $rows == 0) {
	die("<p class='error'>User name or email already in use</p><p><a href='register.php'>Return to registration</a></p>");
}


$newUser = "INSERT INTO tUser(UserName,FirstName,LastName,Email,UPassword) VALUES('$username','$firstname','$lastname','$email','$pass1');";

echo "<p class='debug'>Query: $newUser</p>";


if ( !($result = mysql_query($newUser,$database)))
{
  	die("<p class='error'>Error in registration: " . mysql_error() . "</p>");
}

		echo "<p class='debug'>Check Password</p>";


		$pwdQuery = "Select UserID FROM tUser where UserName='$username' AND UPassword='$pass1' limit 1";

		echo "<p class='debug'>$pwdQuery</p>";

		$pwdResult = mysql_query($pwdQuery, $database);

		if(! $pwdResult) {

			die("<p class='error'>Password does not match file " . mysql_error() . "</p></body></html>");

		}

		$row = mysql_fetch_array($pwdResult, MYSQL_BOTH);
		$userid = $row[0];

		echo "<p class='error'>UserID: $userid</p>";			

		print("<H2>Login Completed</H2><p>Thanks $username, you have been logged in</p>");
		print("<form method='post' name='getList' action='index.php' autocomplete='on'>");

		print("<input type='hidden' name='userid' value='$userid' />");

		print("<input type='submit' value='Request Services'/>");
		print("</form>");
		?>

		<script language="JavaScript">document.getList.submit();</script>

	</div>
</body>

</html>