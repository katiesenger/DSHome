<?php 
function parseQString()
{
	$qString = $_SERVER['QUERY_STRING'];
	$thisSet = parse_str($qString,$result);
	$count = count($result);
	echo "<p class='debug'><h2>Parse Query String</h2><h3>$qString</h3>";
	for($i=0;$i<$count;$i++)
	{
		echo $result[$i];
	}
	echo "</p>";
}
function getQString($q){
	$result = "";
	if(empty($q))
	{
		$result = $_SERVER['QUERY_STRING'];
	}
	else{
		if(isset($_REQUEST[$q]))
		{
			if(empty($_REQUEST[$q])){
				$result = "";
			}
			else {
				$result = $_REQUEST[$q];
			}
		}
		else{
			$result = "";
		}
	}
	$result = str_replace("$q=","",$result);
	echo "<p class='debug'>getQString: $q -> $result</p>";
	return $result;
	}
	function getPost($p){
		$result = "";
		if(isset($_POST[$p]))
		{
			if(empty($_POST[$p])){
				$result =  "";
			}
			else {
				$result =  $_POST[$p];
			}
		}
		else{
			$result = "";
		}
		$result = str_replace("$p=","",$result);
	echo "<p class='debug'>getPost: $p -> $result</p>";
	return $result;
	}
function getUser(){
$userID = "";
$userID =  getPost('userID');
  if(empty($userID)){
    $userID=getQString('u');
		if(empty($userID))
			$userID=getQString('');
		echo "<p class='debug'>User By Query: $userID</p>";
	}
	else {
		echo "<p class='debug'>User By Post: $userID</p>";
	}
	if(strlen($userID)>3)
	{
		$userID = null;
	}
  return $userID;
}
	?>