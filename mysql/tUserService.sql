#Purpose: Store a list of services requested by registered customers
#		:One customer (user) may have many service requests
#		:One service may be requested by multiple users
#		:One UserService appears on One Invoice
#		:One Invoice may have many UserServices

USE DSHome;
DROP TABLE IF EXISTS tUserService;
CREATE TABLE IF NOT EXISTS tUserService(
UserServiceID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
UserID int(11) NOT NULL,
ServiceID int(11) NOT NULL,
DateRequested DateTime NOT NULL,
DateSubmitted DateTime NULL,
DateComplete DateTime NULL,
CompleteByUserID int(11) NULL,
InvoiceID int(11) NULL
);

