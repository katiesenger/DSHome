<html>

<head>

	<title>Add Inventory Item</title>

	<link href="DSHome.css" rel="stylesheet" />

	<script language="jquery" type="text">

$(document).ready(function(){
    $('.button').click(function(){
        var clickBtnValue = $(this).val();
        var ajaxurl = 'ajax.php',
        data =  {'action': clickBtnValue};
        $.post(ajaxurl, data, function (response) {
            // Response div goes here.
            alert("action performed successfully");
        });
    });

});

</script>
</head>

<body>

	<h1>Inventory Location</h1>

	
<?php

		$userID ="";
		$userID = $_POST["userid"];


		include_once 'panels/menu.php?$userID';
	?>
	
	<p class="main">

		<h2>Add New Location</h2>
		<form method="post" action="simpleAdd.php" autocomplete="on" class="box">

	<?php 
			echo "<input type='hidden' name='userID' value='$userID' />"
	?>
			<input type='hidden' name='returnPage' value='InventoryLocation' />		
			<input type='hidden' name='tableName' value='tInventoryLocation' />
			<input type='hidden' name='columnName' value='tInventoryLocationName' />		
			<p>Inventory Location: <input type="text" name="description" id="description" /></p>

			<p><input type="submit" /><input type="submit" class="button" name="insert" value="insert" />
<input type="submit" class="button" name="select" value="select" /></p>

		</form>

		<?php
		$listing = "SELECT InventoryLocationID, InventoryLocationName FROM tInventoryLocation ORDER BY InventoryLocationName";
		echo "<p class='debug'>$listing</a>";


		include_once 'dbConnect.php';

		
if ( !( $result = mysql_query( $listing) ) ) {

			echo "<p class='error'>Could not find location listing " . mysql_error() . "</p>";

		}

		else {

			echo "<h3>Available Locations</h3>";


			$locations = mysql_query( $listing,$database);

			echo "<form><table class='displayData'>";

			echo "<tr><th>&nbsp;</th><th>ID</th><th>Location Name</th></tr>";

			// printing table rows

			while($row = mysql_fetch_row($result))

			{

			    echo "<tr>";

			    echo "<td><input type='hidden' name='locationid' value='$row[0]' />";

			    echo "<input type='hidden' name='userid' value='$userID' />";

			    echo "<a href='simpleRemove.php?i=$row[0]&t=tInventoryLocation&u=$userID'>Remove</a></td>";

			    echo "<td><a href='simpleEdit.php?i=$row[0]&t=tInventoryLocation&u=$userID'>Edit</a></td>";

			    echo "<td>$row[1]</td>";

			    echo "</tr>\n";

			}

			mysql_free_result($result);

			echo "</table></form>";


		}
		mysql_close();


		print("<form method='post' name='getList' action='inventoryLocation.php' autocomplete='on'>");

		print("<input type='hidden' name='userid' value='$userID' />");

		print("<input type='submit' value='Request Services'/>");

		print("</form>");


		
	?>



	
</div>


</body>

</html>
