<?php
function getRows($statement){
  ini_set('error_reporting', E_ALL|E_STRICT);
  ini_set('display_errors', 1);
  $database = mysqli_init();
  $database = new mysqli("localhost", "dsh", "dsh", "DSHome");
  if ($database->connect_errno) {
      echo "<p class='error'>Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error."</p>";
  }
  else
  {
    $rows=0;
    $result = $database->query($statement);
    $rows = mysqli_num_rows($result);
    echo "<p class='debug'>$statement -> $rows</p>";
    return $rows;
  }
echo "<p class='debug'>Connected</p>\n";
}
?>