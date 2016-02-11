

USE DSHome;


DROP TABLE IF EXISTS tInventory;

CREATE TABLE IF NOT EXISTS tInventory(
	
InventoryID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	InventoryDescription nvarchar(255) NULL,
	InventoryTypeID int(11) NOT NULL,
	PurchasePrice DECIMAL(7,2) NOT NULL,
	PurchaseLocation nvarchar(100),
	InventoryLocationID int(11) NOT NULL,
	InventoryOwnerID int(11) NOT NULL,
	Picture1Location nvarchar(255),
	Picture2Location nvarchar(255),
	DateSold datetime,
	InventoryConditionID int(11) NOT NULL,
	UPC nvarchar(25) NULL 
);

