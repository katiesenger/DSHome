USE DSHome;
DROP TABLE IF EXISTS tGroup;
CREATE TABLE tGroup(
  GroupID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  GroupName nvarchar(255) NOT NULL 
);
INSERT INTO tGroup(GroupName) VALUES ('Admin');
INSERT INTO tGroup(GroupName) VALUES ('Owner');
INSERT INTO tGroup(GroupName) VALUES ('Tester');
