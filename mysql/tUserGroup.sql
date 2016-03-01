#Purpose: Store a list of user and group conections.
USE DSHome;
DROP TABLE IF EXISTS tUserGroup;
CREATE TABLE IF NOT EXISTS tUserGroup(
	UserGroupID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  UserID int(11) NOT NULL,
  GroupID int(11) NOT NULL
  );