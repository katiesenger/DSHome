<?php
$database = mysql_connect("localhost","prof","ds");
if(! $database)
{
     die('Connection Problem: '.mysql_error());
}
	
if(!mysql_select_db("DSHome"))
{
     die('Database Selection Error: '.mysql_error());
}
echo "<p class='debug'>Connected</p>";
?>