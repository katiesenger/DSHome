#Purpose: Store a list of links
USE DSHome;
DROP TABLE IF EXISTS tLink;
CREATE TABLE IF NOT EXISTS tLink(
	LinkID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  LinkName nvarchar(255) NOT NULL,
  LinkDestination nvarchar(255) NOT NULL
);