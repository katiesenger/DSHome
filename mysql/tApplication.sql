#Purpose: Store a list of applications

USE DSHome;

DROP TABLE IF EXISTS tApplication;

CREATE TABLE IF NOT EXISTS tApplication(
	ApplicaitonID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ApplicationName nvarchar(255) NOT NULL,
  OwnerUserID int(11) NOT NULL,
  DelegateUserID int(11) NOT NULL,
  ProgrammerUserID int(11) NOT NULL,
  RequestedDescription nvarchar(255) NOT NULL,
  SummarizedScope nvarchar(255) NOT NULL,
  DevelopmentStartDate DateTime,
  ApprovedDate DateTime,
  ApproverUserID int(11),
  ApproverNotes nvarchar(255),
  ProgrammerNotes nvarchar(255),
  SupportStartDate DateTime,
  SupportEndDate DateTime,
  ApplicationStartDate DateTime,
  ApplicationEndDate DateTime,
  ProjectCompletionDate DateTime
  );