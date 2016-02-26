<?php
session_start();

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
else if(isset($_SESSION['user'])!="")
{
 header("Location: home.php");
}

if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['user']);
 header("Location: index.php");
}
include_once './panels/getVariables.php';
$userid = getUser();

include_once './panels/dbConnect.php';
		$dbh = OpenConn();
  	$stmt = $dbh->prepare("UPDATE tUser Set LastLogout=getDate() WHERE UserID=:UserID"); 
		$stmt->bindParam(":UserID",$userid);
		$stmt->execute();
		$dbh = null;
?>