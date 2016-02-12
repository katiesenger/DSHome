<?php 
function getQString($q){
	$result = "";
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
	echo "<p class='debug'>getQString: $p -> $result</p>";
	return $result;
	}
	?>