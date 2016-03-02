<!DOCTYPE html>

<!-- Purpose: Contact Us Page from tUsers where IsContact is true --> 
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
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT * from tUser Where IsContact=1");
    if ($stmt->execute()) {
			echo "<table class='displayData'>";
			echo "<tr><th>User Name</th><th>Name</th><th>Email</th><th>Phone Number</th><th>Address</th></tr>";
    while ($row = $stmt->fetch()) {
			echo "<tr><td>".$row['UserName']."</td><td>".$row['FirstName']." ".$row['LastName']."</td><td>".$row['Email'];
			echo "</td><td>".$row['PhoneNumber']."</td><td>".$row['MailingAddress']."<br />".$row['StreetAddress'];
			echo "<br />".$row['City'].", ".$row['Province']."  ".$row['PostCode']." ".$row['Country']."</td></tr>";
    }
		}
		else {
			echo "No contacts registered.";
		}
    $dbh = null;

  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
	?>

</div>
</body>
</html>
