function getQString($q){
		if(isset($_REQUEST[$q]))
		{
			if(empty($_REQUEST[$q])){
				return "";
			}
			else {
				return $_REQUEST[$q];
			}
		}
		else{
			return "";
		}
	}
	function getPost($p){
		if(isset($_POST[$p]))
		{
			if(empty($_POST[$p])){
				return "";
			}
			else {
				return $_POST[$p];
			}
		}
		else{
			return "";
		}
	}
	