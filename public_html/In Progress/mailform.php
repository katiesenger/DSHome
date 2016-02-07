<html> 

<head>
 
	<meta charset = "utf-8">
 
	<title>COMP470: Task 5</title>
 
	<link href="Task5.css" rel="stylesheet" />
</head>

<body>
<h2>Mail Request</h2>

	
<p class="menu">

	<nav>

		<ul>

			<li><a href="index.html" class="blackButton">Home</a></li>
	 
	<?php
 
		$userID = "";
 
		$userID = $_POST["userid"];

		if(empty($userID)){
			echo "<p class='error'>Please <a href='login.html'>Log in</a> to continue.</p>";
		}
		else{
			
			echo "<li><a href='ServiceRequest.php' class='whiteButton'>Request Services</a></li>";
			echo "<li><a href='editProfile.php?u=$userID' class='whiteButton'>Edit Profile</a></li>";
			echo "<li><a href='./Forms/index.html' class='whiteButton'>Forms</a></li>";			

		}
		echo "</ul>";
		echo "</nav>";
		echo "</p>";
		echo "<div class='box'>";
	
		$query = "SELECT tUser.FirstName, tUser.LastName, tUser.Email from tUser Where tUser.UserID='$userID'";
		$serviceQuery = "SELECT tService.ServiceName, tUserService.DateRequested from tService inner join tUserService on tService.ServiceID=tUserService.ServiceID WHERE tUserService.UserID='$userID'";
		echo "<p class='debug'>$query<br />$serviceQuery</p>";

		include_once 'dbConnect.php';
		
		if ( !( $result = mysql_query( $query) ) ) {
			echo "<p class='error'>Could not find requested services " . mysql_error() . "</p>";
		}
		else {
			$profile = mysql_query($query,$database);
			echo "<form name='feedback' method='POST' action='./cgi-bin/mailform.cgi' autocomplete='on' accept-charset='UTF-8'>";
			while($row=mysql_fetch_row($profile))
			{
				$name = $row[0].' '.$row[1];
				echo "Name: <br> <input type='text' name='Name' size='20' value='$name' /><br>";
				echo "Email: <br> <input type='text' name='Email' size='20' value='$row[2]' /><br>";
				echo "Requested services: <br>";
				echo "<textarea name='Comments' cols='50' rows='8'>";
			}
			mysql_free_result($result);
			mysql_free_result($row);
			$services = mysql_query($serviceQuery,$database);
			while($row=mysql_fetch_row($services))
			{
				echo "$row[0] requested $row[1]  ";
			}
			echo "</textarea><br>";
			mysql_free_result($services);
			mysql_free_result($row);
			echo "<br>";
			echo "<input type='hidden' name='recipient' value='katie.snow.ca@gmail.com' />";
			echo "<input type='submit' name='Submit' value='Submit'/>";
			echo "</form>";
		}
	?>

</div>
</body>

</html>
