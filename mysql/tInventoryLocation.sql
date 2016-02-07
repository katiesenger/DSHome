USE DSHome;
DROP TABLE IF EXISTS tInventoryLocation;
CREATE TABLE tInventoryLocation(
	InventoryLocationID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	InventoryLocationName nvarchar(100) NOT NULL
);

INSERT INTO tInventoryLocation(InventoryLocationName) VALUES('Master Bedroom');
INSERT INTO tInventoryLocation(InventoryLocationName) VALUES('Olivers Room');
INSERT INTO tInventoryLocation(InventoryLocationName) VALUES('Office');
INSERT INTO tInventoryLocation(InventoryLocationName) VALUES('Living Room');
INSERT INTO tInventoryLocation(InventoryLocationName) VALUES('Dining Room');
INSERT INTO tInventoryLocation(InventoryLocationName) VALUES('Kitchen');
INSERT INTO tInventoryLocation(InventoryLocationName) VALUES('Basement');
INSERT INTO tInventoryLocation(InventoryLocationName) VALUES('Garage');
INSERT INTO tInventoryLocation(InventoryLocationName) VALUES('Andrews Room');