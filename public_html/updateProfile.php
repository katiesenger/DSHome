<html>


<head>


	<title> Update Profile </title>

 
	<link href="DSHome.css" rel="stylesheet" />


</head>


<body>


	<p class='debug'>Start Test</p>


	<?php



		$userid = $firstname = $lastname = $email = "";

		$phoneNumber = $mailingaddress = $streetaddress = $city = $province = $postcode = $country = "";



		
$userid = $_POST["userid"];

		$firstname = $_POST["firstname"];

		$lastname = $_POST["lastname"];

		$email = $_POST["email"];

		$phonenumber = $_POST["phonenumber"];

		$mailingaddress = $_POST["mailingaddress"];

		$streetaddress = $_POST["streetaddress"];

		$city = $_POST["city"];

		$province = $_POST["province"];

		$country = $_POST["country"];

		$postcode = $_POST["postcode"];



		include_once 'panels/menu.php?$userid';
		include_once 'dbConnect.php';



		$updateQuery = "UPDATE tUser SET firstname='$firstname', lastname='$lastname', email='$email', phonenumber='$phonenumber', mailingaddress='$mailingaddress', streetaddress='$streetaddress', city='$city', province='$province', country='$country', postcode='$postcode' where UserID='$userid'";

		

		echo "<p class='debug'>$updateQuery</p>";


		$result = mysql_query($updateQuery,$database);



		if(! $result) {


			die("<p class='error'>$error</p><p class='error'>Profile not updated: " . mysql_error() . "</p></body></html>");


		}

		else{

			echo "<form method='post' name='getList' action='editProfile.php?u=$userid' autocomplete='on'>";


			echo "<input type='submit' value='View Profile'/>";


			echo "</form>";


			mysql_close();

		}

	?>

		<script language="JavaScript">document.getList.submit();</script>



		<p class='debug'>End Test</p>


</body>

</html>
