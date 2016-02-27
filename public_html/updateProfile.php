<html>
<head>
	<title> Update Profile </title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<p class='debug'>Start Test</p>
	<?php
	
	include_once './panels/getVariables.php';
	$UserID = $UserName = $FirstName = $LastName = $Email = $ExistingPassword = $Pass1 = $Pass2 = "";
	$PhoneNumber = $MailingAddress = $StreetAddress = $City = "";
	$Province = $Country = $PostCode = $IsStaff = $IsAdmin = $IsContact = $PasswordQuestion1 = $PasswordAnswer1 = $PasswordQuestion2 = "";
	$PasswordAnswer2 = $PasswordQuestion3 = $PasswordAnswer3 = $PasswordQuestion4 = $PasswordAnswer4 = $PasswordQuestion5 = "";
	$PasswordAnswer5 = $PasswordQuestion6 = $PasswordAnswer6 = $LastLogin = $LastLogout = $LastPasswordChange = $CreationDate = "";
	$IsLockedOut = $LastLockedOutDate = $LastChanged = $LastEditBy = "";
		
	$UserID = getPost('UserID');
	$UserName = getPost('UserName');
	$FirstName = getPost('FirstName');
	$LastName = getPost('LastName');
	$Email = getPost('Email');
	$UPassword = getPost('UPassword');
	$ExistingPassword = getPost('ExistingPassword');
	$Pass1 = getPost('Pass1');
	$Pass2 = getPost('Pass2');
	$PhoneNumber = getPost('PhoneNumber');
	$MailingAddress = getPost('MailingAddress');
	$StreetAddress = getPost('StreetAddress');
	$City = getPost('City');
	$Province = getPost('Province');
	$Country = getPost('Country');
	$PostCode = getPost('PostCode');
	$IsStaff = getPost('IsStaff');
	$IsAdmin = getPost('IsAdmin');
	$IsContact = getPost('IsContact');
	$PasswordQuestion1 = getPost('PasswordQuestion1');
	$PasswordAnswer1 = getPost('PasswordAnswer1');
	$PasswordQuestion2 = getPost('PasswordQuestion2');
	$PasswordAnswer2 = getPost('PasswordAnswer2');
	$PasswordQuestion3 = getPost('PasswordQuestion3');
	$PasswordAnswer3 = getPost('PasswordAnswer3');
	$PasswordQuestion4 = getPost('PasswordQuestion4');
	$PasswordAnswer4 = getPost('PasswordAnswer4');
	$PasswordQuestion5 = getPost('PasswordQuestion5');
	$PasswordAnswer5 = getPost('PasswordAnswer5');
	$PasswordQuestion6 = getPost('PasswordQuestion6');
	$PasswordAnswer6 = getPost('PasswordAnswer6');
	$LastLogin = getPost('LastLogin');
	$LastLogout = getPost('LastLogout');
	$LastPasswordChange = getPost('LastPasswordChange');
	$CreationDate = getPost('CreationDate');
	$IsLockedOut = getPost('IsLockedOut');
	$LastLockedOutDate = getPost('LastLockedOutDate');
	$LastChanged = getPost('LastChanged');
	$LastEditBy = getPost('LastEditBy');

	include_once './panels/menu.php';
	
	$dbh = OpenConn();
  $stmt = $dbh->prepare("SELECT UserID,UserName,UPassword FROM tUser Where UserID=:UserID"); 
	$stmt->bindParam(':UserID',$UserID);
	$stmt->execute();
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
 	if(count($results) > 0 && $password===$results['UPassword']) // password_verify($password, $results['UPassword']))
	{
		$userid=$results['UserID'];
		if ($Pass1===$Pass2)
		{
			include_once './panels/dbConnect.php';
			$dbh = OpenConn();
			$stmt = $dbh->prepare("UPDATE tUser SET UPassword=:UPassword WHERE UserID=:UserID");
			$stmt->bindParam(':UserID',$UserID);
			$stmt->bindParam(':UPassword',$Pass1);
			$stmt->execute();
			$dbh = null;
		}
	}
 	try {
		include_once './panels/dbConnect.php';
		$dbh = OpenConn();
		$stmt = $dbh->prepare("UPDATE tUser SET UserName=:UserName, FirstName=:FirstName, LastName=:LastName, Email=:Email, PhoneNumber=:PhoneNumber, MailingAddress=:MailingAddress, StreetAddress=:StreetAddress, City=:City, Province=:Province, Country=:Country, PostCode=:PostCode, IsStaff=:IsStaff, IsAdmin=:IsAdmin, IsContact=:IsContact, PasswordQuestion1=:PasswordQuestion1, PasswordAnswer1=:PasswordAnswer1, PasswordQuestion2=:PasswordQuestion2, PasswordAnswer2=:PasswordAnswer2, PasswordQuestion3=:PasswordQuestion3, PasswordAnswer3=:PasswordAnswer3, PasswordQuestion4=:PasswordQuestion4, PasswordAnswer4=:PasswordAnswer4, PasswordQuestion5=:PasswordQuestion5, PasswordAnswer5=:PasswordAnswer5, PasswordQuestion6=:PasswordQuestion6, PasswordAnswer6=:PasswordAnswer6, LastLogin=:LastLogin, LastLogout=:LastLogout, LastPasswordChange=:LastPasswordChange, CreationDate=:CreationDate, IsLockedOut=:IsLockedOut, LastLockedOutDate=:LastLockedOutDate, LastChanged=:LastChanged, LastEditBy=:LastEditBy WHERE UserID=:UserID");
		$stmt->bindParam(':UserID',$UserID);
		$stmt->bindParam(':UserName',$UserName);
		$stmt->bindParam(':FirstName',$FirstName);
		$stmt->bindParam(':LastName',$LastName);
		$stmt->bindParam(':Email',$Email);
		$stmt->bindParam(':PhoneNumber',$PhoneNumber);
		$stmt->bindParam(':MailingAddress',$MailingAddress);
		$stmt->bindParam(':StreetAddress',$StreetAddress);
		$stmt->bindParam(':City',$City);
		$stmt->bindParam(':Province',$Province);
		$stmt->bindParam(':Country',$Country);
    $stmt->bindParam(':PostCode',$PostCode);
    $stmt->bindParam(':IsStaff',$IsStaff);
    $stmt->bindParam(':IsAdmin',$IsAdmin);
    $stmt->bindParam(':IsContact',$IsContact);
    $stmt->bindParam(':PasswordQuestion1',$PasswordQuestion1);
    $stmt->bindParam(':PasswordAnswer1',$PasswordAnswer1);
    $stmt->bindParam(':PasswordQuestion2',$PasswordQuestion2);
    $stmt->bindParam(':PasswordAnswer2',$PasswordAnswer2);
    $stmt->bindParam(':PasswordQuestion3',$PasswordQuestion3);
    $stmt->bindParam(':PasswordAnswer3',$PasswordAnswer3);
		$stmt->bindParam(':PasswordQuestion4',$PasswordQuestion4);
		$stmt->bindParam(':PasswordAnswer4',$PasswordAnswer4);
		$stmt->bindParam(':PasswordQuestion5',$PasswordQuestion5);
		$stmt->bindParam(':PasswordAnswer5',$PasswordAnswer5);
		$stmt->bindParam(':PasswordQuestion6',$PasswordQuestion6);
		$stmt->bindParam(':PasswordAnswer6',$PasswordAnswer6);
		$stmt->bindParam(':LastLogin',$LastLogin);
		$stmt->bindParam(':LastLogout',$LastLogout);
		$stmt->bindParam(':LastPasswordChange',$LastPasswordChange);
		$stmt->bindParam(':CreationDate',$CreationDate);
		$stmt->bindParam(':IsLockedOut',$IsLockedOut);
		$stmt->bindParam(':LastLockedOutDate',$LastLockedOutDate);
		$stmt->bindParam(':LastChanged',$LastChanged);
		$stmt->bindParam(':LastEditBy',$LastEditBy);
		$stmt->execute();
		$dbh = null;
		echo "<p class='debug'>Updated</p>";
	}
	catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    echo "<form method='post' name='getList' action='editProfile.php?u=$UserID' autocomplete='on'>";
    echo "<input type='submit' value='View Profile'/>";
    echo "</form>";
    ?>
    <!--    <script language="JavaScript">document.getList.submit();</script>-->
        <p class='debug'>End Test</p>

</body>
</html>
