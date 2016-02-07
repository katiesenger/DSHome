<?php
$value = 'something from somewhere';

setcookie("TestCookie", $value);
setcookie("TestCookie", $value, time()+3600);  /* expire in 1 hour */
setcookie("TestCookie", $value, time()+3600, "/~Katie/", "ekat.ca", 1);

echo "TestCookie\n";
echo $_COOKIE["TestCookie"];
?>