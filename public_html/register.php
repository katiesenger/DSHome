<html>

<head>

	<title>Register</title>

	<link href="DSHome.css" rel="stylesheet" />

</head>

<body>

	<h1>Welcome to DS Home</h1>

<?php
		$userID="";
		include_once "./panels/menu.php";
	?>
	<p class="main">

		<form method="post" action="doRegister.php" autocomplete="on" class="box">

			<p>Desired User Name: <input type="text" name="username" id="username" /></p>

			<p>Password: <input type="password" name="Password1" /></p>

			<p>Retype Password: <input type="password" name="Password2" /></p>

			<p>First Name: <input type="text" name="FirstName" /></p>

			<p>Last Name: <input type="text" name="LastName" /></p>
			<p>Email: <input type="email" name="email" /></p>

			<p><input type="submit" /></p>

		</form>

	</p>

</body>

</html>
