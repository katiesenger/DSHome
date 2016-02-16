<?php
ini_set('error_reporting', E_ALL|E_STRICT);
ini_set('display_errors', 1);
$mysqli = mysqli_init();
$database = new mysqli("localhost", "dsh", "dsh", "DSHome");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo "<p class='debug'>Connected</p>\n";
?>