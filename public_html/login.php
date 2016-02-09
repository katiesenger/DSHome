<!DOCTYPE html>
<!--Log in -->


<head>

	<meta charset = "utf=8">
	<title>DSHome.ca</title>

	<link href="DSHome.css" rel="stylesheet" />

</head>

<body>

	<h1>Welcome to eKat.ca</h1>

	<?php
		$userID="";
		include_once "./panels/menu.php";
	?>
	<div class="box">

		<form id="login" method="post" action="doLogin.php" autocomplete="on" type="submit">

			<input type="hidden" name="userid" />

			<br />User Name:<input type="text" name="username" />

			<br />Password: <input type="password" name="password" />

			<br /><input type="submit" />
		</form>

	</div>

</body>	
