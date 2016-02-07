<!DOCTYPE html>


<!-- 
	
	Purpose: Contact Us Page from tUsers where IsContact is true

--> 


<html>
 

<head>

 
	<meta charset = "utf-8">

 
	<title>Contact Us</title>

 
	<link href="DSHome.css" rel="stylesheet" />

</head>


<body>

	<h2>Contact Us</h2>

	
 
<?php

		include_once 'panels/menu.php';
	?>
	<div class='box'>
	<?php


		$contactQuery = "SELECT UserName,FirstName,LastName,Email,UPassword,PhoneNumber,MailingAddress,StreetAddress,City,Province,Country,PostCode,IsStaff,IsAdmin,IsContact from tUser Where IsContact=1";
		echo "<p class='debug'>$contactQuery</a>";


		include_once 'dbConnect.php';

		
if ( !( $result = mysql_query( $contactQuery) ) ) {

			echo "<p class='error'>Could not find contact listing " . mysql_error() . "</p>";

		}

		else {

			
echo "<h3>Our Staff</h3>";


			$services = mysql_query( $contactQuery,$database);

			echo "<form><table class='displayData'>";

			// printing table rows
			echo "<tr>";
			while($row = mysql_fetch_row($result))

			{

			    	echo "<td>";

				echo "<b><a href='mailto:$row[3]' />$row[1] $row[2]</a></b><br />";
				echo "<b>Phone: </b>$row[4]<br />";
				echo "$row[5]<br />"; //Mailing
				echo "$row[6]<br />"; //Street
				echo "$row[7] $row[8], $row[9]  $row[10]  $row[11]<br />";
				echo "</td>"
			}
		    	echo "</tr>\n";


			mysql_free_result($result);

			echo "</table></form>";


		}

	?>



	
</div>

</body>


</html>
