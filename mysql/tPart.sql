#Purpose: Store a list of Parts Available for Request


USE DSHome;

DROP TABLE IF EXISTS tPart;

CREATE TABLE IF NOT EXISTS tPart(
	
PartID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	
PartName varchar(50) NOT NULL,
	
Price DECIMAL(9,2) NOT NULL,

	ShopHours DECIMAL(5,2)  NOT NULL

);



INSERT INTO tPart(PartName,Price,ShopHours) VALUES('Mouse','30.00','0.5');

INSERT INTO tPart(PartName,Price,ShopHours) VALUES('DVD','2.00','1');


 
