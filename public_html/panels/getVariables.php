<?php 
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
  return $userID;
}
	?>