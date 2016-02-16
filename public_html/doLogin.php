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
		include_once './panels/dbCheckRows.php';
		$pwdQuery = "Select UserID FROM tUser where UserName='$username' AND UPassword='$password' limit 1";
		$rows = getRows($pwdQuery);
		if($rows === 0)
			die("<p class='error'>Password does not match file " . mysql_error() . "</p></body></html>");
		include_once './panels/dbFunction.php';
	$userID = getThisValue($pwdQuery);
	
	print("<H2>Login Completed</H2><p>Thanks $username, you have been logged in</p>");
	print("<form method='post' name='getList' action='home.php?$userid' autocomplete='on'>");
	print("<input type='hidden' name='userid' value='$userid' />");
	print("<input type='submit' value='Request Services'/>");
	print("</form>");
	
	?>

	<script language="JavaScript">document.getList.submit();</script>

<p class='debug'>End Test</p>

</body>

</html>
