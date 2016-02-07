<html>
<head>
	<title> Test PHP</title>
</head>
<body>
	<p>Start Test</p>
	<?php
//		echo "<p>Get variables from post session</p>";

		$pass1 = $pass2 = $username = $firstname = $lastname = $email = "";
		$pass1 = $_POST["Password1"];
		$pass2 = $_POST["Password2"];
		$username = $_POST["username"];
		$firstname  = $_POST["FirstName"];
		$lastname = $_POST["LastName"];
		$email = $_POST["email"];

//		echo "<p> Registering $username </p>";
//		echo "<p>1= $pass1  2=$pass2</p>";

		if ($pass1 == $pass2){
//			echo "<p>Passwords match</p>";
		}
		else {
			die("<p class='error'>Passwords do not match - use back button to correct.</p></body></html>");
		}
			$checkUser = "SELECT count(UserID) as users from tUser where username='$username'";
//			echo $checkUser;

			if ( ! $database = mysql_connect("localhost","Prof","au")){
				die("Could not connect. </body></html>");
			}
			if (!mysql_select_db("COMP470",$database)) {
				die("Could not connect to database </body></html>");
			}
			$result = mysql_query($checkUser,$database);
			$rowCount = mysql_num_rows($result);
			$resultRows = mysql_fetch_array($result);
			$row = $resultRow['UserId'];
			mysql_close();


//			echo "<p>Rows with this username:  $rowCount</p>";

			if($rows == 0) {
//				echo "<p>New User</p>";
				$newUser = "INSERT INTO tUser(UserName,FirstName,LastName,Email,UPassword) VALUES('$username','$firstname','$lastname','$email','$pass1');";
//				echo $newUser;
				$newDatabase = mysql_connect("localhost","Prof","au");
				mysql_select_db("COMP470",$newDatabase);
				$newResult = mysql_query($newUser,$database);
				if (! $newResult){
					die("<p class='error'>Could not add new user: " . mysql_error() . "</p></body></html>");
				}
				mysql_close();
			}
			else {
				echo "<p>Check Password</p>";
				$pwdDatabase = mysql_connect("localhost","Prof","au");
				mysql_select_db("COMP470",$pwdDatabase);
				$pwdQuery = "Select UserID FROM tUser where UserName='$username' AND UPassword='$pass1';";
				echo $pwdQuery;
				$pwdResult = mysql_query($pwdQuery,$pwdDatbase);
				if(! $pwdResult) {
					die("<p class='error'>Password does not match file " . mysql_error() . "</p></body></html>");
				}
				else{
					echo "<p> You have already registered with this username and password</p>";
				}
				mysql_close();
			}

			echo "<p>Get ID for newly added user</p>";
			$getDatabase = mysql_connect("localhost","Prof","au");
			mysql_select_db("COMP470",$getDatabase);
			$getID = "SELECT UserID, Username, FirstName, LastName, Email  from tUser where username='$username' and UPassword='$pass1'";
			echo $getID;
			$idRow = mysql_query($getID,$getDatabase);
			if (! $idRow){
				die("<p class='error'>Password does not match file" . mysql_error() . "</p></body></html>");
			}
			echo "<table class='displayData'><tr><th>User ID</th><th>User Name</th><th>First Name</th><th>Last Name</th>";
			echo "<th>Email</th></tr>";
			while($thisRow = mysql_fetch_array($idRow)){
				echo "<tr><td>" . $thisRow['UserID'] . "</td><td>" . $thisRow['Username'] . "</td><td>"; 
				echo $thisRow['FirstName'] . "</td><td>" . $thisRow['LastName'] . "</td><td>" ; 
				echo $thisRow['email'] . "</td></tr>";
				$idRow = $thisRow['UserID'];
			}
			echo "</table>";
			mysql_close();

			print("<H2>Registration Completed</H2><p>Thanks $username, you have been successfully registered</p>");
			print("<form method='post' name='getList' action='ServiceRequest.php' autocomplete='on'>");
			print("<input type='hidden' name='userid' value='$userid' />");
			print("<input type='submit' value='Request Services'/>");
			print("</form>");
			?>
//			<script language="JavaScript">document.getList.submit();</script>


	<p>End Test</p>
</body>
</html>
