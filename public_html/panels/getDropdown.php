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
$thisQuery = "SELECT $idColumn, $nameColumn FROM $simpleTable WHERE $nameColumn IS NOT NULL ORDER BY $nameColumn";
	echo "<p class='debug'>$thisQuery</p>";

	include_once 'dbConnect.php';

	$thisData = mysql_query( $thisQuery);
	echo "<br /><select name=$idColumn required=true>";
	while($row = mysql_fetch_row($thisData))
	{
		echo "<option value='$row[0]' ";
			if($selected==$row[1])
				echo "selected=true ";
		echo ">$row[1]</option>";
	}
	echo "</select>\n";
	mysql_free_result($thisData);
	

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