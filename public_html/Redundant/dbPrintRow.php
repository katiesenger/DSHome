<?php
function printQuery($statement)
$user = "dsh";
$pass = "dsh";
try {
    $dbh = new PDO('mysql:host=localhost;dbname=DSHome', $user, $pass);
    foreach($dbh->query($statement) as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
