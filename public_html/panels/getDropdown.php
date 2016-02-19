<?php
function dropdown($simpleTable,$selected=null){
		$friendlyName = $columnName = $idColumn = $nameColumn ="";
		$words = preg_split('/(?=[A-Z])/',$simpleTable);
		$count = count($words);
		for($i=0;$i<$count;$i++)
		{
			if($words[$i] != "t"){
				
			$friendlyName=$friendlyName . " " . $words[$i];
			$columnName = $columnName . $words[$i];
			}
		}
		$idColumn = $columnName . "ID";
		$nameColumn = $columnName . "Name";
    $table = "t" . $columnName;
	
	echo "<p class='debug'>Table: $table, IDCol: $idColumn, NameCol: $nameColumn</p>";
	
	include_once 'dbConnect.php';
	$dbh = OpenConn();
	$stmt = $dbh->prepare("SELECT :idColumn, :nameColumn FROM :table WHERE :nameColumn IS NOT NULL ORDER BY :nameColumn");
	$stmt->bindParam(":idColumn",$idColumn);
	$stmt->bindParam(":nameColumn",$nameColumn);
	$stmt->bindParam(":table",$table);
	if ($stmt->execute()) {
		echo "<br /><select name='$idColumn' required=true>";
		while ($row = $stmt->fetch()) {
			echo "<option value='".$row[$idColumn]."' ";
			if($selected==$row[$nameColumn])
				echo "selected=true ";
		echo ">".$row[$nameColumn]."</option>";
		}
	echo "</select>\n";
	}
		else{echo "Broken";}
	$dbh=null;
	

}
function dropdownFields($fields, $friendlyName, $fieldName, $selected)
{
	echo "$friendlyName <select id='$fieldName' name='$fieldName'>";
  echo "<option value='none'";
  if($selected=="")
      echo "selected=selected";
  echo ">No Filter</option>";
      foreach($fields as $field)
      {
        echo "<option value='$field'";
        if($filterBy==$field)
          echo "selected=selected";
        echo ">$field</option>'";
      }
  echo "</select>";
}

 ?>