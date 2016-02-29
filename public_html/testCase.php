<!DOCTYPE html>
<!-- 	Purpose: CRUD Test Case --> 
<html>
<head>
	<meta charset = "utf-8">
	<title>Test Case Management</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h2>Test Case Management</h2>
<?php
	include_once './panels/getVariables.php';
	$userID = getUser();
	include_once './panels/menu.php';

 
?>
	<div class='box'>
	<?php
  $TestCaseID= $TestCaseDescription= $DateLogged= $DateTested= $PreaparedBy= $TestedBy= $Module= $FeatureName= $UseCaseID= $TestData= $TestSteps= $ExpectedResults= $ActualResults= $Pass= $PriorityID= "";
    
  $TestCaseID = getPost('TestCaseID');
  $TestCaseDescription = getPost('TestCaseDescription');
  $DateLogged = getPost('DateLogged');
  $DateTested = getPost('DateTested');
  $PreaparedBy = getPost('PreaparedBy');
  $TestedBy = getPost('TestedBy');
  $Module = getPost('Module');
  $FeatureName = getPost('FeatureName');
  $UseCaseID = getPost('UseCaseID');
  $TestData = getPost('TestData');
  $TestSteps = getPost('TestSteps');
  $ExpectedResults = getPost('ExpectedResults');
  $ActualResults = getPost('ActualResults');
  $Pass = getPost('Pass');
  $PriorityID = getPost('PriorityID');

  $fields = "TestCaseID, TestCaseDescription, DateLogged, DateTested, PreaparedBy, TestedBy, Module, FeatureName, UseCaseID, TestData, TestSteps, ExpectedResults, ActualResults, Pass, PriorityID";
  
  $qString = $action = $value = $id = $filterBy = $orderBy = "";
  $qString = $_SERVER['QUERY_STRING'];
  if($qString != "")
	{
		$action = getQString('action'); //list, select, sort, add, edit, delete, filter, like
		$value = getQString('v');
		$id = getQString('i');
  }

	if(empty($TestCaseID) AND !empty($id))
	{
		$TestCaseID=$id;
	}
    
function addTestCaseItem($TestCaseDescription, $DateLogged, $DateTested, $PreaparedBy, $TestedBy, $Module, $FeatureName, $UseCaseID, $TestData, $TestSteps, $ExpectedResults, $ActualResults, $Pass, $PriorityID)
{
  
  try {
      include_once './panels/dbConnect.php';
      $dbh = OpenConn();
      $stmt = $dbh->prepare("INSERT INTO tTestCase (TestCaseDescription, DateLogged, DateTested, PreaparedBy, TestedBy, Module, FeatureName, UseCaseID, TestData, TestSteps, ExpectedResults, ActualResults, Pass, PriorityID) VALUES (:TestCaseDescription, :DateLogged, :DateTested, :PreaparedBy, :TestedBy, :Module, :FeatureName, :UseCaseID, :TestData, :TestSteps, :ExpectedResults, :ActualResults, :Pass, :PriorityID)");
      $stmt->bindParam(':TestCaseDescription',$TestCaseDescription);
      $stmt->bindParam(':DateLogged',$DateLogged);
      $stmt->bindParam(':DateTested',$DateTested);
      $stmt->bindParam(':PreaparedBy',$PreaparedBy);
      $stmt->bindParam(':TestedBy',$TestedBy);
      $stmt->bindParam(':Module',$Module);
      $stmt->bindParam(':FeatureName',$FeatureName);
      $stmt->bindParam(':UseCaseID',$UseCaseID);
      $stmt->bindParam(':TestData',$TestData);
      $stmt->bindParam(':TestSteps',$TestSteps);
      $stmt->bindParam(':ExpectedResults',$ExpectedResults);
      $stmt->bindParam(':ActualResults',$ActualResults);
      $stmt->bindParam(':Pass',$Pass);
      $stmt->bindParam(':PriorityID',$PriorityID);

    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$TestCaseDescription added.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function updateTestCaseItem($TestCaseID, $TestCaseDescription, $DateLogged, $DateTested, $PreaparedBy, $TestedBy, $Module, $FeatureName, $UseCaseID, $TestData, $TestSteps, $ExpectedResults, $ActualResults, $Pass, $PriorityID)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
		$stmt = $dbh->prepare("UPDATE tTestCase SET TestCaseDescription=:TestCaseDescription, DateLogged=:DateLogged, DateTested=:DateTested, PreaparedBy=:PreaparedBy, TestedBy=:TestedBy, Module=:Module, FeatureName=:FeatureName, UseCaseID=:UseCaseID, TestData=:TestData, TestSteps=:TestSteps, ExpectedResults=:ExpectedResults, ActualResults=:ActualResults, Pass=:Pass, PriorityID=:PriorityID,  WHERE TestCaseID=:TestCaseID");
    $stmt->bindParam(':TestCaseID',$TestCaseID);
    $stmt->bindParam(':TestCaseDescription',$TestCaseDescription);
    $stmt->bindParam(':DateLogged',$DateLogged);
    $stmt->bindParam(':DateTested',$DateTested);
    $stmt->bindParam(':PreaparedBy',$PreaparedBy);
    $stmt->bindParam(':TestedBy',$TestedBy);
    $stmt->bindParam(':Module',$Module);
    $stmt->bindParam(':FeatureName',$FeatureName);
    $stmt->bindParam(':UseCaseID',$UseCaseID);
    $stmt->bindParam(':TestData',$TestData);
    $stmt->bindParam(':TestSteps',$TestSteps);
    $stmt->bindParam(':ExpectedResults',$ExpectedResults);
    $stmt->bindParam(':ActualResults',$ActualResults);
    $stmt->bindParam(':Pass',$Pass);
    $stmt->bindParam(':PriorityID',$PriorityID);
    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$TestCaseDescription updated.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function getTestCaseItem($TestCaseID,$userID)
{
  try {
    include_once './panels/dbConnect.php';
    include_once './panels/getDropdown.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT * FROM tTestCase where TestCaseID=?");
    if ($stmt->execute(array($TestCaseID))) {
    while ($results = $stmt->fetch()) {
      echo "<form id='edit' method='post' action='testCase.php?u=$userID&action=edit' autocomplete='on'>";
      echo "<table class='displayData'>";
      echo "<tr><th>TestCaseID</th><td><input type='hidden' name='TestCaseID' value='" . $results['TestCaseID'] ."' />" . $results['TestCaseID'] ."</td></tr>";
      echo "<tr><th>TestCaseDescription</th><td><input type='text' name='TestCaseDescription' value='". $results['TestCaseDescription'] . "' /></td></tr>";
      echo "<tr><th>DateLogged</th><td><input type='text' name='DateLogged' value='". $results['DateLogged'] . "' /></td></tr>";
      echo "<tr><th>DateTested</th><td><input type='text' name='DateTested' value='". $results['DateTested'] . "' /></td></tr>";
      echo "<tr><th>PreaparedBy</th><td><input type='text' name='PreaparedBy' value='". $results['PreaparedBy'] . "' /></td></tr>";
      echo "<tr><th>TestedBy</th><td><input type='text' name='TestedBy' value='". $results['TestedBy'] . "' /></td></tr>";
      echo "<tr><th>Module</th><td><input type='text' name='Module' value='". $results['Module'] . "' /></td></tr>";
      echo "<tr><th>FeatureName</th><td><input type='text' name='FeatureName' value='". $results['FeatureName'] . "' /></td></tr>";
      echo "<tr><th>Use Case ID</th><td>";
      useCaseDropdown($results['UseCaseID']);
      echo "</td></tr>";
      echo "<tr><th>TestData</th><td><input type='text' name='TestData' value='". $results['TestData'] . "' /></td></tr>";
      echo "<tr><th>TestSteps</th><td><input type='text' name='TestSteps' value='". $results['TestSteps'] . "' /></td></tr>";
      echo "<tr><th>ExpectedResults</th><td><input type='text' name='ExpectedResults' value='". $results['ExpectedResults'] . "' /></td></tr>";
      echo "<tr><th>ActualResults</th><td><input type='text' name='ActualResults' value='". $results['ActualResults'] . "' /></td></tr>";
      echo "<tr><th>Pass</th><td><input type='text' name='Pass' value='". $results['Pass'] . "' /></td></tr>";
      echo "<tr><th>Priority</th><td>";
      priorityDropdown($results['PriorityID']);
      echo "</td></tr>";
      echo "<tr><td colspan='2'><input type='submit' name='update' value='update' /></td></tr>";
      echo "</table>";
			echo "</form>";
			
    }
    $dbh = null;
  }
  }

  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
    
    function showNew($userID)
    {
      include_once './panels/getDropdown.php';
      echo "<form id='add' method='post' action='testCase.php?u=$userID&action=add' autocomplete='on' type='submit'>";
      echo "<table class='displayData'>";
      echo "<tr><th>TestCaseDescription</th><td><input type='text' name='TestCaseDescription'  /></td></tr>";
      echo "<tr><th>DateLogged</th><td><input type='text' name='DateLogged'  /></td></tr>";
      echo "<tr><th>DateTested</th><td><input type='text' name='DateTested'  /></td></tr>";
      echo "<tr><th>PreaparedBy</th><td><input type='text' name='PreaparedBy'  /></td></tr>";
      echo "<tr><th>TestedBy</th><td><input type='text' name='TestedBy'  /></td></tr>";
      echo "<tr><th>Module</th><td><input type='text' name='Module'  /></td></tr>";
      echo "<tr><th>FeatureName</th><td><input type='text' name='FeatureName'  /></td></tr>";
      echo "<tr><th>Use Case</th><td>";
      useCaseDropdown(null);
      echo "</td></tr>";
      echo "<tr><th>TestData</th><td><input type='text' name='TestData'  /></td></tr>";
      echo "<tr><th>TestSteps</th><td><input type='text' name='TestSteps'  /></td></tr>";
      echo "<tr><th>ExpectedResults</th><td><input type='text' name='ExpectedResults'  /></td></tr>";
      echo "<tr><th>ActualResults</th><td><input type='text' name='ActualResults'  /></td></tr>";
      echo "<tr><th>Pass</th><td><input type='text' name='Pass'  /></td></tr>";
      echo "<tr><th>PriorityID</th><td>";
      priorityDropdown(null);
      echo "</td></tr>";

      echo "<tr><td colspan='2'><input type='submit' value='submit' id='submit' /></td></tr>";
      echo "</table>";
      echo "</form>";
    }
function listTestCase($userID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT tTestCase.* FROM tTestCase ORDER BY TestCaseDescription");
    if ($stmt->execute()) {
			echo "<h2>TestCase</h2>";
    	//$fields = array("TestCaseID", "TestCaseDescription","DateLogged","DateTested","PreaparedBy","TestedBy","Module","FeatureName","UseCaseID","TestData","TestSteps","ExpectedResults","ActualResults","Pass","PriorityID");
      $fields = array("TestCaseID", "TestCaseDescription","DateLogged","DateTested","PreaparedBy","TestedBy","Module","FeatureName","PriorityID");
			echo "<form><table class='displayData'>";
      echo "<tr><th>&nbsp;</th><th>ID</th>";
      foreach($fields as $field)
      {
        echo "<th>$field</th>";
      }
  		echo "</tr>";
    	while ($row = $stmt->fetch()) {
				echo "<tr>";
				echo "<td>";
				echo "<a href='testCase.php?u=".$userID."&i=".$row['TestCaseID']."&action=select'>Edit</a> ";
				echo "<a href='testCase.php?u=".$userID."&i=".$row['TestCaseID']."&action=delete'>Delete</a> ";
				echo "</td>";
				foreach($fields as $field)
				{
					echo "<td>$row[$field]</td>";
				}
			}
		}
	$dbh = null;
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function deleteTestCaseItem($TestCaseID)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("DELETE from tTestCase WHERE TestCaseID=:TestCaseID");
    $stmt->bindParam(':TestCaseID',$TestCaseID);
		if ($stmt->execute()) {
			echo "<p class='debug'>$TestCaseID Deleted</p>";
		}
	}
	catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
    
  $listQuery = "SELECT TestCaseID, TestCaseName FROM tTestCase";// ORDER BY TestCaseName";
	
		echo "<p class='debug'>Action: $action </p>";
  switch($action) {
		case "list":
      	listData($listQuery,$userID);
			break;
		case "sort":
			$listQuery = $listQuery . " ORDER BY $value";
      	listData($listQuery,$userID);
			break;
    case "filter":
      $listQuery = $listQuery . " WHERE $columnName = $value";
      	listData($listQuery,$userID);
      break;
    case "like":
      $listQuery = $listQuery . " WHERE $columnName like '%" . $value . "%'";
      	listData($listQuery,$userID);
      break;
		case "delete":
			deleteTestCaseItem($TestCaseID);
      	listData($listQuery,$userID);
			break;
    case "new":
      showNew($userID);
      break;
		case "add":
			addTestCaseItem($TestCaseDescription, $DateLogged, $DateTested, $PreaparedBy, $TestedBy, $Module, $FeatureName, $UseCaseID, $TestData, $TestSteps, $ExpectedResults, $ActualResults, $Pass, $PriorityID);
      	listData($listQuery,$userID);
			break;
		case "select":
			echo "<p class='debug'>TestCaseID: $TestCaseID :: ID: $id</p>";
			if($TestCaseID != "")
				getTestCaseItem($TestCaseID,$userID);
			else if($id != "")
				getTestCaseItem($id,$userID);
			break;
		case "edit":
			updateTestCaseItem($TestCaseID, $TestCaseDescription, $DateLogged, $DateTested, $PreaparedBy, $TestedBy, $Module, $FeatureName, $UseCaseID, $TestData, $TestSteps, $ExpectedResults, $ActualResults, $Pass, $PriorityID);
      	listData($listQuery,$userID);
			break;
    case "":
      listData($listQuery,$userID);
      break;
	}
    function filterDropDown($fields){
   dropdownFields($fields,"Filter By","filterBy",$filterBy);
}

function orderDropDown($fields){
  dropdownFields($fields,"Order By","orderBy",$orderBy);
}

	function listData($listQuery,$userID)
	{
		listTestCase($userID);
		echo "<br /><br /><a href='testCase.php?u=$userID&action=new'>Add TestCase Item</a>";
		
	}
	?>
		<script language="JavaScript">document.getList.submit();</script>
</div>
</body>
</html>
