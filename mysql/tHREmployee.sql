#Purpose: Store a list of employees for HR purposes in people module.

USE DSHome;

DROP TABLE IF EXISTS tHREmployee;

CREATE TABLE IF NOT EXISTS tHREmployee(
	EmployeeID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FirstName nvarchar(255) NOT NULL,
  LastName nvarchar(255) NOT NULL,
  StreetAddress nvarchar(255) NOT NULL,
  City  nvarchar(255) NOT NULL,
  Province nvarchar(255) NOT NULL,
  PostalCode  nvarchar(255) NOT NULL,
  MailingAddress  nvarchar(255) NOT NULL,
  Country  nvarchar(255) NOT NULL,
  SIN nvarchar(11) NOT NULL,
  BirthDate DateTime,
  PrimaryPhoneNumber  nvarchar(25) NOT NULL,
  SecondaryPhoneNumber  nvarchar(25) NOT NULL,
  EmergencyContactName  nvarchar(255) NOT NULL,
  EmergencyContactNumber  nvarchar(25) NOT NULL,
  PrimaryDepartureAirportID int(11),
  PrimaryTransitionAirportID int(11),
  SecondaryDepartureAirportID int(11),
  SecondaryTransitionAirportID int(11),
  PayrollCode  nvarchar(25) NOT NULL,
  ClinetID int(11),
  BadgeNumber  nvarchar(25) NOT NULL
 )