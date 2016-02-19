<?php
function OpenConn(){
$user = "dsh";
$pass = "dsh";
try {
    $dbh = new PDO('mysql:host=localhost;dbname=DSHome', $user, $pass);
    return $dbh;
  echo "<p class='debug'>Connected</p>";

} catch (PDOException $e) {
    print "<p class='error'>Error!: " . $e->getMessage() . "</p><br/>";
    die();
}
}
function CloseCon()
{
  echo "<p class='debug'>Connection closed</p>";
   $dbh = null;
}
?>