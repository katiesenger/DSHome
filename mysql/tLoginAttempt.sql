#Purpose: Store a list of login attempts from registered users

USE DSHome;

DROP TABLE IF EXISTS tLoginAttempt;

CREATE TABLE IF NOT EXISTS tLoginAttempt(
	LoginAttemptID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  UserID int(11) NOT NULL,
  ApplicationID int(11) NOT NULL,
  Success int(1) NOT NULL,
  IP nvarchar(25) NOT NULL,
  AttemptedDateTime DateTime
  );