<!DOCTYPE html> <!-- Assignment: COMP470 - Task 5 Student: Katrina Snow (2427350) Purpose: Uses PHP to validate the user login. --> 
<html> <head> <meta charset = "utf-8"> <title>COMP470: Task 5</title> <link href="task5.css" rel="stylesheet" /> </head> <body> <?php 
//make post variables into local variables $pass1 = $username = $userid = ""; if ($_SERVER["REQUEST_METHOD"] == "POST") { $pass1 = 
$_POST["password"]; $username = $_POST["username"];
}
//set up a check string to see if any id's match user name and password provided. $checkString = "Select 'ID' from 'tUsers' where 
'password'='$pass1' and 'username'='$username'"; //connection to mysql if ( ! ( $database = mysql_connect( "localhost:81","prof","au") 
) ){ die(" Could not connect to database </body></html>");
}
if( !mysql_select_db("COMP470",$database)) { die(" Could not open COMP470 database</body></html>");
}
if ( !( $result = mysql_query( $checkString, $database ) ) ) { print("<p>Could not check user!</p>"); die( mysql_error() . 
"</body></html>") ;
}
if ( $row = mysql_fetch_row( $result ) ) { foreach ($row as $key => $value) { $userid = $value; print ("<h2>Welcome $username</h2><br 
/>"); print("<form method='post' name='getList' action='ServiceRequest.php' autocomplete='on'><input type='hidden' name='userid' 
value='$userid'/><input type='submit' value='Get my list'/></form>"); ?> <script 
language="JavaScript">document.getList.submit();</script> <?php
}
}
else { //user name and password combination don't match print("<h2>Login Failed</h2><p class='error'>Password does not match our 
records, please use the browsers back button to try again.</p>"); die(); //end this script
}
?> </body>
</html>
