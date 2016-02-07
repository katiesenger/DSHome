USE DSHome;
DROP TABLE IF EXISTS tInventoryOwner;
CREATE TABLE tInventoryOwner(
	InventoryOwnerID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	InventoryOwnerName nvarchar(100) NOT NULL
);

INSERT INTO tInventoryOwner(InventoryOwnerName) VALUES('Katie');
INSERT INTO tInventoryOwner(InventoryOwnerName) VALUES('Jon');
INSERT INTO tInventoryOwner(InventoryOwnerName) VALUES('Andrew');
INSERT INTO tInventoryOwner(InventoryOwnerName) VALUES('Oliver');
INSERT INTO tInventoryOwner(InventoryOwnerName) VALUES('DS Home Computing Ltd');