#Purpose: Store a list of bugs discovered by programmers and users.


USE DSHome;

DROP TABLE IF EXISTS tBugList;

CREATE TABLE IF NOT EXISTS tBugList(
	BugListID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ApplicationID int(11) NOT NULL,
  MenuItemID int(11),
  ReportingUserID int(11),
  ReportedDate DateTime,
  StepsToReproduce nvarchar(255) NOT NULL,
  BugDescription nvarchar(255) NOT NULL,
  ResponseToUser nvarchar(255) NOT NULL,
  SuggestedSolution nvarchar(255) NOT NULL,
  EstimatedHours int(2),
  ActualHours int(2),
  ResolvedByUserID int(11),
  ResolvedDate DateTime,
  ReleaseVersion int(2),
  BugSolution nvarchar(255) NOT NULL,
  AdditionalNotes nvarchar(255) NOT NULL,
  ResolutionCodeID int(11),
  LastEditUserID int(11),
  LastEditDate DateTime
  );