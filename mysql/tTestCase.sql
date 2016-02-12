

USE DSHome;


DROP TABLE IF EXISTS tTestCase;

CREATE TABLE IF NOT EXISTS tTestCase(
	TestCaseID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	TestCaseDescription nvarchar(255) NULL,
  DateLogged DateTime,
  DateTested DateTime,
  PreaparedBy nvarchar(25) NOT NULL,
  TestedBy nvarchar(25),
  Module nvarchar(25) NOT NULL,
  FeatureName nvarchar(75) NOT NULL,
	UseCaseID int(11) NOT NULL,
	TestData nvarchar(255) NOT NULL,
	TestSteps nvarchar(255) NOT NULL,
	ExpectedResults nvarchar(255) NOT NULL,
	ActualResults nvarchar(255) NULL,
	Pass bit NOT NULL,
	PriorityID int(11) NOT NULL
  
  );