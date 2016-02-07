<!DOCTYPE html>
<!-- 
	Purpose: Mark selected user for deletion
--> 
<html> 
<head>
	<meta charset = "utf-8">
	<title>Delete User</title>
 	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
<h2>Delete User</h2>
<?php
 
		$userID = "";
 
		$userID = $_POST["userid"];
		include_once 'panels/menu.php?$userID';
 ?>

<div class="box">	
 
	

		if(empty($userID)){
			echo "<p class='error'>Please <a href='login.html'>Log in</a> to continue.</p>";
		}
		else{
			echo "<a href='editProfile.php?u=$userID' class='whiteButton'>Edit Profile</a>";			
		}
	
		$deleteQuery = "UPDATE tUser SET UPassword='delete' where UserID=$userID";
		echo "<p class='debug'>$deleteQuery</a>";

		include_once 'dbConnect.php';
		
		if ( !( $result = mysql_query( $deleteQuery) ) ) {
			echo "<p class='error'>Error marking profile for deletion " . mysql_error() . "</p>";
		}
		else
		{
			echo "<p class='success'>Profile marked for deletion, contact administrator if this is an error</p>";
		}

		mysql_close();

		
	?>


	
</div>
</body>

</html>
