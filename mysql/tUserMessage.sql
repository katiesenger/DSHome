#Purpose: Stores messages betwen users

USE DSHome;

DROP TABLE IF EXISTS tUserMessage;

CREATE TABLE IF NOT EXISTS tUserMessage(
	UserMessageID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ToUserID int(11) NOT NULL,
  FromUserID int(11) NOT NULL,
  DateSent DateTime,
  DateRead DateTime,
  SubjectText nvarchar(100),
  MessageText nvarchar(255)
  )