#Purpose: Store a list of registered customers able to request services and registered staff


USE DSHome;

DROP TABLE IF EXISTS tUser;

CREATE TABLE IF NOT EXISTS tUser(
	UserID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	UserName varchar(50) NOT NULL,
	FirstName varchar(50) NOT NULL,
	LastName varchar(50) NOT NULL,
	Email varchar(100) NOT NULL,
	UPassword varchar(15) NOT NULL,
	PhoneNumber varchar(21) NOT NULL,
	MailingAddress varchar(100) NOT NULL,
	StreetAddress varchar(100) NOT NULL,
	City varchar(50) NOT NULL,
	Province varchar(2) NOT NULL,
	Country varchar(50) NOT NULL,
	PostCode varchar(10) NOT NULL,
	IsStaff int(1) NOT NULL,
	IsAdmin int(1) NOT NULL,
	IsContact int(1) NOT NULL,
	PasswordQuestion1 nvarchar(100) NULL,
	PasswordAnswer1 nvarchar(100) NULL,
	PasswordQuestion2 nvarchar(100) NULL,
	PasswordAnswer2 nvarchar(100) NULL,
	PasswordQuestion3 nvarchar(100) NULL,
	PasswordAnswer3 nvarchar(100) NULL,
	PasswordQuestion4 nvarchar(100) NULL,
	PasswordAnswer4 nvarchar(100) NULL,
	PasswordQuestion5 nvarchar(100) NULL,
	PasswordAnswer5 nvarchar(100) NULL,
	PasswordQuestion6 nvarchar(100) NULL,
	PasswordAnswer6 nvarchar(100) NULL,
	LastLogin DateTime,
	LastLogout DateTime,
	LastPasswordChange DateTime,
	CreationDate DateTime,
	IsLockedOut int(1),
	LastLockedOutDate DateTime,
	LastChanged DateTime,
	LastEditBy nvarchar(100)
);


INSERT INTO tUser(UserName,FirstName,LastName,Email,UPassword,PhoneNumber,MailingAddress,StreetAddress,City,Province,Country,PostCode,IsStaff,IsAdmin,IsContact)
VALUES ('Contact1','Doug','Senger','doug.senger@gmail.com','DSHome','780-940-7067','','3007 134 Avenue NW','Edmonton','AB','Canada','T5A5C3',0,0,1);
INSERT INTO tUser(UserName,FirstName,LastName,Email,UPassword,PhoneNumber,MailingAddress,StreetAddress,City,Province,Country,PostCode,IsStaff,IsAdmin,IsContact)
VALUES ('Contact2','Katie','Snow','ksenger@gmail.com','DSHome','780-720-2683','','3007 134 Avenue NW','Edmonton','AB','Canada','T5A5C3',0,0,1);