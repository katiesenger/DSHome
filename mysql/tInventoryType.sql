USE DSHome;
DROP TABLE IF EXISTS tInventoryType;
CREATE TABLE tInventoryType(
	InventoryTypeID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	InventoryTypeName nvarchar(100) NOT NULL
);

INSERT INTO tInventoryType(InventoryTypeName) VALUES('Tool');
INSERT INTO tInventoryType(InventoryTypeName) VALUES('Collectable');
INSERT INTO tInventoryType(InventoryTypeName) VALUES('Book');
INSERT INTO tInventoryType(InventoryTypeName) VALUES('DVD');
INSERT INTO tInventoryType(InventoryTypeName) VALUES('Furniture');
INSERT INTO tInventoryType(InventoryTypeName) VALUES('Toy');
INSERT INTO tInventoryType(InventoryTypeName) VALUES('Equipment');
INSERT INTO tInventoryType(InventoryTypeName) VALUES('Appliance');
INSERT INTO tInventoryType(InventoryTypeName) VALUES('Other');