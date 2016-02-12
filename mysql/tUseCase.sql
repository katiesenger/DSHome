USE DSHome;
DROP TABLE IF EXISTS tUseCase;
CREATE TABLE tUseCase(
  UseCaseID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  UseCaseTitle nvarchar(255) NOT NULL,
  UseCaseDescription nvarchar(255) NOT NULL,
  PrimaryActor nvarchar(100) NOT NULL,
  AlternateActors nvarchar(255) NULL,
  PreRequisits nvarchar(255) NOT NULL,
  PostConditions nvarchar(255) NOT NULL,
  MainPathSteps nvarchar(255) NOT NULL,
  AlternatePathSteps nvarchar(255) NOT NULL,
  SuccessCriteria nvarchar(255) NOT NULL,
  PotentialFailures nvarchar(255) NOT NULL,
  FrequencyOfUse nvarchar(100) NOT NULL,
  OwnerUserID int(11) NOT NULL,
  PriorityID int(11) NOT NULL,
  CaseStatusID int(11) NOT NULL
);