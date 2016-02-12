USE DSHome;
DROP TABLE IF EXISTS tPriority;
CREATE TABLE tPriority(
  PriorityID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  PriorityName nvarchar(255) NOT NULL 
);
INSERT INTO tPriority(PriorityName) VALUES ('High');
INSERT INTO tPriority(PriorityName) VALUES ('Medium');
INSERT INTO tPriority(PriorityName) VALUES ('Low');
