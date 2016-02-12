USE DSHome;
DROP TABLE IF EXISTS tCaseStatus;
CREATE TABLE tCaseStatus(
  CaseStatusID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  CaseStatusName nvarchar(255) NOT NULL
);

INSERT INTO tCaseStatus(CaseStatusName) VALUES ('New');
INSERT INTO tCaseStatus(CaseStatusName) VALUES ('Editing');
INSERT INTO tCaseStatus(CaseStatusName) VALUES ('Ready to Test');
INSERT INTO tCaseStatus(CaseStatusName) VALUES ('Tested');
INSERT INTO tCaseStatus(CaseStatusName) VALUES ('Deployed');
INSERT INTO tCaseStatus(CaseStatusName) VALUES ('Complete');
INSERT INTO tCaseStatus(CaseStatusName) VALUES ('Pending');
INSERT INTO tCaseStatus(CaseStatusName) VALUES ('Requires Revision');
