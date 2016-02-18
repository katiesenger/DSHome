
USE DSHome;


DROP TABLE IF EXISTS tLog;

CREATE TABLE IF NOT EXISTS tLog(
	
  LogID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	LogEntered DateTime NOT NULL,
  UserID int(11) NOT NULL,
	Action nvarchar(255) NOT NULL,
	TableName nvarchar(255) NOT NULL,
  Statement nvarchar(255) NOT NULL
  )