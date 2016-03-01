#Purpose: Store a list of user and group conections.
USE DSHome;
DROP TABLE IF EXISTS tMenuGroup;
CREATE TABLE IF NOT EXISTS tMenuGroup(
	MenuGroupID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  MenuID int(11) NOT NULL,
  GroupID int(11) NOT NULL
  );