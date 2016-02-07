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


		echo "<p class='debug'>Check Password</p>";


		include_once 'dbConnect.php';

		$pwdQuery = "Select UserID FROM tUser where UserName='$username' AND UPassword='$password' limit 1";

		echo "<p class='debug'>$pwdQuery</p>";

		$pwdResult = mysql_query($pwdQuery,$database);

		if(! $pwdResult) {

			die("<p class='error'>Password does not match file " . mysql_error() . "</p></body></html>");

		}

		$row = mysql_fetch_array($pwdResult, MYSQL_BOTH);
		$userid = $row[0];

		echo "<p class='error'>UserID: $userid</p>";			

		print("<H2>Login Completed</H2><p>Thanks $username, you have been logged in</p>");
		print("<form method='post' name='getList' action='ServiceRequest.php' autocomplete='on'>");

		print("<input type='hidden' name='userid' value='$userid' />");

		print("<input type='submit' value='Request Services'/>");
		print("</form>");
		?>

		<script language="JavaScript">document.getList.submit();</script>



	<p class='debug'>End Test</p>

</body>

</html>
