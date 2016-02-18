<?php
function OpenConn(){
$user = "dsh";
$pass = "dsh";
try {
    $dbh = new PDO('mysql:host=localhost;dbname=DSHome', $user, $pass);
    return $dbh;

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
}
function CloseCon()
{
   $dbh = null;
}
?>