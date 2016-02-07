#Purpose: Store a list of Services Available for Request


USE DSHome;

DROP TABLE IF EXISTS tService;

CREATE TABLE IF NOT EXISTS tService(
	
ServiceID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	
ServiceName varchar(50) NOT NULL,
	
Price DECIMAL(5,2) NOT NULL,

	ShopHours DECIMAL(5,2)  NOT NULL

);



INSERT INTO tService(ServiceName,Price,ShopHours) VALUES('Computer Set Up','100.00','4');

INSERT INTO tService(ServiceName,Price,ShopHours) VALUES('Hardware Install','25.00','1');

INSERT INTO tService(ServiceName,Price,ShopHours) VALUES('Software Install','50.00','1');

INSERT INTO tService(ServiceName,Price,ShopHours) VALUES('Custom Training','125.00','1');
 
