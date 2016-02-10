USE DSHome;
DROP TABLE IF EXISTS tInventoryCondition;
CREATE TABLE tInventoryCondition(
	InventoryConditionID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	InventoryConditionName nvarchar(100) NOT NULL
);

INSERT INTO tInventoryCondition(InventoryConditionName) VALUES('New with tags');
INSERT INTO tInventoryCondition(InventoryConditionName) VALUES('New');
INSERT INTO tInventoryCondition(InventoryConditionName) VALUES('Gently Used');
INSERT INTO tInventoryCondition(InventoryConditionName) VALUES('Used');
INSERT INTO tInventoryCondition(InventoryConditionName) VALUES('Well Used');
INSERT INTO tInventoryCondition(InventoryConditionName) VALUES('Deplorable');
