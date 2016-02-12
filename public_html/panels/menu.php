
<p class="menu">
<nav>
		<ul>
			<li><a href="index.php" class="blackButton">Home</a></li>
 
<?php

 
		$userID = ""; 
		$userID = $_SERVER['QUERY_STRING'];
		if(empty($userID)){

			echo "<p class='error'>Please <a href='login.php'>Log in</a> to continue.</p>";
			include_once 'loginPanel.php';		
		}

		else{
			echo "<li><a href='editProfile.php?u=$userID' class='whiteButton'>Edit Profile</a></li>";
			echo "<li><a href='./Forms/index.php' class='whiteButton'>Forms</a></li>";
			echo "<li><a href='contact.php' class='whiteButton'>Contact Us</a></li>";
			echo "<li><a href='logout.php' class='whiteButton'>Log out</a></li>";
			echo "<li><a href='inventory.php' class='whiteButton'>Inventory</a></li>";
			echo "<form><input type='hidden' id='userid' name='userid' value='$userID' />";
}


	?>
		</ul>
	</nav>
</p>