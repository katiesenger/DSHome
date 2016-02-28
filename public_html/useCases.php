<!DOCTYPE html>
<!-- 	Purpose: crud Use Cases --> 
<html>
<head>
	<meta charset = "utf-8">
	<title>Use Case Management</title>
	<link href="DSHome.css" rel="stylesheet" />
</head>
<body>
	<h2>Use Case Management</h2>
<?php
	include_once './panels/getVariables.php';
	$userID = getUser();
	include_once './panels/menu.php';

 
?>
	<div class='box'>
	<?php
    
  $UseCaseID = $UseCaseTitle = $UseCaseDescription = $PrimaryActor = $AlternateActors = $PreRequisits = $PostConditions = $MainPathSteps = $AlternatePathSteps = $SuccessCriteria = $PotentialFailures = $FrequencyOfUse = $OwnerUserID = $PriorityID = $CaseStatusID = "";
  $UseCaseID = getPost('UseCaseID');
  $UseCaseTitle = getPost('UseCaseTitle');
  $UseCaseDescription = getPost('UseCaseDescription');
  $PrimaryActor = getPost('PrimaryActor');
  $AlternateActors = getPost('AlternateActors');
  $PreRequisits = getPost('PreRequisits');
  $PostConditions = getPost('PostConditions');
  $MainPathSteps = getPost('MainPathSteps');
  $AlternatePathSteps = getPost('AlternatePathSteps');
  $SuccessCriteria = getPost('SuccessCriteria');
  $PotentialFailures = getPost('PotentialFailures');
  $FrequencyOfUse = getPost('FrequencyOfUse');
  $OwnerUserID = getPost('OwnerUserID');
  $PriorityID = getPost('PriorityID');
  $CaseStatusID = getPost('CaseStatusID');

  $fields = "UseCaseTitle, UseCaseDescription, PrimaryActor, AlternateActors, PreRequisits, PostConditions, MainPathSteps, AlternatePathSteps, SuccessCriteria, PotentialFailures, FrequencyOfUse, OwnerUserID, PriorityID, CaseStatusID";
  
  $qString = $action = $value = $id = $filterBy = $orderBy = "";
  $qString = $_SERVER['QUERY_STRING'];
  if($qString != "")
	{
		$action = getQString('action'); //list, select, sort, add, edit, delete, filter, like
		$value = getQString('v');
		$id = getQString('i');
  }

	if(empty($UseCaseID) AND !empty($id))
	{
		$UseCaseID=$id;
	}
    
function addUseCaseItem($UseCaseTitle, $UseCaseDescription, $PrimaryActor, $AlternateActors, $PreRequisits, $PostConditions, $MainPathSteps, $AlternatePathSteps, $SuccessCriteria, $PotentialFailures, $FrequencyOfUse, $OwnerUserID, $PriorityID, $CaseStatusID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("INSERT INTO tUseCase (UseCaseTitle, UseCaseDescription, PrimaryActor, AlternateActors, PreRequisits, PostConditions, MainPathSteps, AlternatePathSteps, SuccessCriteria, PotentialFailures, FrequencyOfUse, OwnerUserID, PriorityID, CaseStatusID) VALUES (:UseCaseTitle, :UseCaseDescription, :PrimaryActor, :AlternateActors, :PreRequisits, :PostConditions, :MainPathSteps, :AlternatePathSteps, :SuccessCriteria, :PotentialFailures, :FrequencyOfUse, :OwnerUserID, :PriorityID, :CaseStatusID)");    
		$stmt->bindParam(':UseCaseTitle',$UseCaseTitle);
    $stmt->bindParam(':UseCaseDescription',$UseCaseDescription);
    $stmt->bindParam(':PrimaryActor',$PrimaryActor);
    $stmt->bindParam(':AlternateActors',$AlternateActors);
    $stmt->bindParam(':PreRequisits',$PreRequisits);
    $stmt->bindParam(':PostConditions',$PostConditions);
    $stmt->bindParam(':MainPathSteps',$MainPathSteps);
    $stmt->bindParam(':AlternatePathSteps',$AlternatePathSteps);
    $stmt->bindParam(':SuccessCriteria',$SuccessCriteria);
    $stmt->bindParam(':PotentialFailures',$PotentialFailures);
    $stmt->bindParam(':FrequencyOfUse',$FrequencyOfUse);
    $stmt->bindParam(':OwnerUserID',$OwnerUserID);
    $stmt->bindParam(':PriorityID',$PriorityID);
    $stmt->bindParam(':CaseStatusID',$CaseStatusID);
    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$UseCaseTitle added.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function updateUseCaseItem($UseCaseID, $UseCaseTitle, $UseCaseDescription, $PrimaryActor, $AlternateActors, $PreRequisits, $PostConditions, $MainPathSteps, $AlternatePathSteps, $SuccessCriteria, $PotentialFailures, $FrequencyOfUse, $OwnerUserID, $PriorityID, $CaseStatusID)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
		echo "<p class='debug'>UPDATE tUseCase SET UseCaseTitle=$UseCaseTitle, UseCaseDescription=$UseCaseDescription, PrimaryActor=$PrimaryActor, AlternateActors=$AlternateActors, PreRequisits=$PreRequisits, PostConditions=$PostConditions, MainPathSteps=$MainPathSteps, AlternatePathSteps=$AlternatePathSteps, SuccessCriteria=$SuccessCriteria, PotentialFailures=$PotentialFailures, FrequencyOfUse=$FrequencyOfUse, OwnerUserID=$OwnerUserID, PriorityID=$PriorityID, CaseStatusID=$CaseStatusID WHERE UseCaseID=$UseCaseID</p>";
    $stmt = $dbh->prepare("UPDATE tUseCase SET UseCaseTitle=:UseCaseTitle, UseCaseDescription=:UseCaseDescription, PrimaryActor=:PrimaryActor, AlternateActors=:AlternateActors, PreRequisits=:PreRequisits, PostConditions=:PostConditions, MainPathSteps=:MainPathSteps, AlternatePathSteps=:AlternatePathSteps, SuccessCriteria=:SuccessCriteria, PotentialFailures=:PotentialFailures, FrequencyOfUse=:FrequencyOfUse, OwnerUserID=:OwnerUserID, PriorityID=:PriorityID, CaseStatusID=:CaseStatusID WHERE UseCaseID=:UseCaseID");
    $stmt->bindParam(':UseCaseTitle',$UseCaseTitle);
    $stmt->bindParam(':UseCaseDescription',$UseCaseDescription);
    $stmt->bindParam(':PrimaryActor',$PrimaryActor);
    $stmt->bindParam(':AlternateActors',$AlternateActors);
    $stmt->bindParam(':PreRequisits',$PreRequisits);
    $stmt->bindParam(':PostConditions',$PostConditions);
    $stmt->bindParam(':MainPathSteps',$MainPathSteps);
    $stmt->bindParam(':AlternatePathSteps',$AlternatePathSteps);
    $stmt->bindParam(':SuccessCriteria',$SuccessCriteria);
    $stmt->bindParam(':PotentialFailures',$PotentialFailures);
    $stmt->bindParam(':FrequencyOfUse',$FrequencyOfUse);
    $stmt->bindParam(':OwnerUserID',$OwnerUserID);
    $stmt->bindParam(':PriorityID',$PriorityID);
    $stmt->bindParam(':CaseStatusID',$CaseStatusID);
    $stmt->bindParam(":UseCaseID",$UseCaseID);
    $stmt->execute();
    $dbh = null;
		echo "<p class='debug'>$UseCaseName updated.</p>";
  }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
function getUseCaseItem($UseCaseID,$userID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("SELECT * FROM tUseCase where UseCaseID=?");
    if ($stmt->execute(array($UseCaseID))) {
    while ($row = $stmt->fetch()) {
      echo "<form id='edit' method='post' action='useCases.php?u=$userID&action=edit' autocomplete='on'>";
			$UseCaseID=$row['UseCaseID'];	
      echo "<br />UseCaseID: <label name='UseCaseID' id='UseCaseID' value='$UseCaseID' />";
      $UseCaseTitle=$row['UseCaseTitle'];	
      echo "<br />UseCaseTitle: <input type='text' name='UseCaseTitle' id='UseCaseTitle' value='$UseCaseTitle' />";
      $UseCaseDescription=$row['UseCaseDescription'];	
      echo "<br />UseCaseDescription: <input type='text' name='UseCaseDescription' id='UseCaseDescription' value='$UseCaseDescription' />";
      $PrimaryActor=$row['PrimaryActor'];	
      echo "<br />PrimaryActor: <input type='text' name='PrimaryActor' id='PrimaryActor' value='$PrimaryActor' />";
      $AlternateActors=$row['AlternateActors'];	
      echo "<br />AlternateActors: <input type='text' name='AlternateActors' id='AlternateActors' value='$AlternateActors' />";
      $PreRequisits=$row['PreRequisits'];	
      echo "<br />PreRequisits: <input type='text' name='PreRequisits' id='PreRequisits' value='$PreRequisits' />";
      $PostConditions=$row['PostConditions'];	
      echo "<br />PostConditions: <input type='text' name='PostConditions' id='PostConditions' value='$PostConditions' />";
      $MainPathSteps=$row['MainPathSteps'];
      echo "<br />MainPathSteps: <input type='text' name='MainPathSteps' id='MainPathSteps' value='$MainPathSteps' />";
      $AlternatePathSteps=$row['AlternatePathSteps'];	
      echo "<br />AlternatePathSteps: <input type='text' name='AlternatePathSteps' id='AlternatePathSteps' value='$AlternatePathSteps' />";
      $SuccessCriteria=$row['SuccessCriteria'];	
      echo "<br />SuccessCriteria: <input type='text' name='SuccessCriteria' id='SuccessCriteria' value='$SuccessCriteria' />";
      $PotentialFailures=$row['PotentialFailures'];	
      echo "<br />PotentialFailures: <input type='text' name='PotentialFailures' id='PotentialFailures' value='$PotentialFailures' />";
      $FrequencyOfUse=$row['FrequencyOfUse'];	
      echo "<br />FrequencyOfUse: <input type='text' name='FrequencyOfUse' id='FrequencyOfUse' value='$FrequencyOfUse' />";
      $OwnerUserID=$row['OwnerUserID'];	
      include_once './panels/getDropdown.php';
      echo "<br />Owner User ID:";
			userDropdown($OwnerUserID,"Owner User");
      $PriorityID=$row['PriorityID'];	
      echo "<br />Priority: ";
			priorityDropDown($PriorityID);
      $CaseStatusID=$row['CaseStatusID'];	
      echo "<br />Status: ";
			caseStatusDropDown($CaseStatusID);
      echo "<br /><input type='submit' name='update' value='update' />";
			echo "</form>";
			$dbh = null;
			 try {
				include_once './panels/dbConnect.php';
				$dbh = OpenConn();
				$stmt = $dbh->prepare("SELECT tTestCase.*, tPriority.PriorityName FROM tTestCase left outer join tPriority ON tTestCase.PriorityID=tPriority.PriorityID WHERE UseCaseID=:UseCaseID ORDER BY TestCaseDescription");
				$stmt->bindParam(":UseCaseID",$UseCaseID);
    		if ($stmt->execute()) {
					echo "<h2>Test Cases for Use Case</h2>";
    			$fields = array("TestCaseID", "TestCaseDescription","DateLogged","DateTested","PreaparedBy","TestedBy","PriorityName");
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
			
    
  }
  }

  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
    
    function showNew($userID)
    {
      echo "<form id='add' method='post' action='useCases.php?u=$userID&action=add' autocomplete='on' type='submit'>";
      echo "<br />UseCaseTitle: <input type='text' name='UseCaseTitle' id='UseCaseTitle' />";
      echo "<br />UseCaseDescription: <input type='text' name='UseCaseDescription' id='UseCaseDescription' />";
      echo "<br />PrimaryActor: <input type='text' name='PrimaryActor' id='PrimaryActor' />";
      echo "<br />AlternateActors: <input type='text' name='AlternateActors' id='AlternateActors' />";
      echo "<br />PreRequisits: <input type='text' name='PreRequisits' id='PreRequisits' />";
      echo "<br />PostConditions: <input type='text' name='PostConditions' id='PostConditions' />";
      echo "<br />MainPathSteps: <input type='text' name='MainPathSteps' id='MainPathSteps' />";
      echo "<br />AlternatePathSteps: <input type='text' name='AlternatePathSteps' id='AlternatePathSteps' />";
      echo "<br />SuccessCriteria: <input type='text' name='SuccessCriteria' id='SuccessCriteria' />";
      echo "<br />PotentialFailures: <input type='text' name='PotentialFailures' id='PotentialFailures' />";
      echo "<br />FrequencyOfUse: <input type='text' name='FrequencyOfUse' id='FrequencyOfUse' />";
      include_once './panels/getDropdown.php';
      echo "<br />Owner User ID: ";
			userDropdown(null);
      echo "<br />Priority: ";
			priorityDropDown(null);
      echo "<br />Status: ";
			caseStatusDropDown(null);
      echo "<br /><input type='submit' value='submit' id='submit' />";
      echo "</form>";
    }
function listUseCase($userID)
{
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    //$stmt = $dbh->prepare("select tUseCase.*,tPriority.PriorityName,tCaseStatus.CaseStatusName, tUser.UserName as OwnerUserName FROM tUseCase left outer join tPriority on tUseCase.PriorityID=tPriority.PriorityID left outer join tCaseStatus on tUseCase.CaseStatusID=tCaseStatus.CaseStatusID left outer join tUser on tUseCase.OwnerUserID=tUser.UserID");
		$stmt = $dbh->prepare("select tUseCase.UseCaseID, tUseCase.UseCaseTitle, tUseCase.UseCaseDescription from tUseCase");
    if ($stmt->execute()) {
      echo "<h2>UseCase</h2>";
    	//$fields = array("UseCaseID", "UseCaseTitle", "UseCaseDescription", "PrimaryActor", "AlternateActors", "PreRequisits", "PostConditions", "MainPathSteps", "AlternatePathSteps", "SuccessCriteria", "PotentialFailures", "FrequencyOfUse", "OwnerUserID", "PriorityID", "CaseStatusID");
			$fields = array("UseCaseID","UseCaseTitle","UseCaseDescription");
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
				echo "<a href='useCases.php?u=".$userID."&i=".$row['UseCaseID']."&action=select'>Edit</a> ";
				echo "<a href='useCases.php?u=".$userID."&i=".$row['UseCaseID']."&action=delete'>Delete</a> ";
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
function deleteUseCaseItem($UseCaseID)
{
  
  try {
    include_once './panels/dbConnect.php';
    $dbh = OpenConn();
    $stmt = $dbh->prepare("DELETE from tUseCase WHERE UseCaseID=:UseCaseID");
    $stmt->bindParam(':UseCaseID',$UseCaseID);
		if ($stmt->execute()) {
			echo "<p class='debug'>$UseCaseID Deleted</p>";
		}
	}
	catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
}
    
  $listQuery = "SELECT UseCaseID, UseCaseTitle, UseCaseDescription, PrimaryActor, AlternateActors, PreRequisits, PostConditions, MainPathSteps, AlternatePathSteps, SuccessCriteria, PotentialFailures, FrequencyOfUse, OwnerUserID, PriorityID, CaseStatusID FROM tUseCase";// ORDER BY UseCaseName";
	
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
			deleteUseCaseItem($UseCaseID);
      	listData($listQuery,$userID);
			break;
    case "new":
      showNew($userID);
      break;
		case "add":
			addUseCaseItem($UseCaseTitle, $UseCaseDescription, $PrimaryActor, $AlternateActors, $PreRequisits, $PostConditions, $MainPathSteps, $AlternatePathSteps, $SuccessCriteria, $PotentialFailures, $FrequencyOfUse, $OwnerUserID, $PriorityID, $CaseStatusID);
      	listData($listQuery,$userID);
			break;
		case "select":
			echo "<p class='debug'>UseCaseID: $UseCaseID :: ID: $id</p>";
			if($UseCaseID != "")
				getUseCaseItem($UseCaseID,$userID);
			else if($id != "")
				getUseCaseItem($id,$userID);
			break;
		case "edit":
			updateUseCaseItem($UseCaseID, $UseCaseTitle, $UseCaseDescription, $PrimaryActor, $AlternateActors, $PreRequisits, $PostConditions, $MainPathSteps, $AlternatePathSteps, $SuccessCriteria, $PotentialFailures, $FrequencyOfUse, $OwnerUserID, $PriorityID, $CaseStatusID);
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
		listUseCase($userID);
		echo "<br /><br /><a href='useCases.php?u=$userID&action=new'>Add UseCase Item</a>";
		
	}
	?>
		<script language="JavaScript">document.getList.submit();</script>
</div>
</body>
</html>
