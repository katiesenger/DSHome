USE DSHome;
DROP TABLE IF EXISTS tEmail;
CREATE TABLE tEmail(
  EmailID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ToEmail nvarchar(255) NOT NULL,
  CcEmail nvarchar(255) NULL,
  Subject nvarchar(255) NOT NULL,
  DateSent DateTime NOT NULL,
  EmailBody nvarchar(max) NOT NULL 
);
