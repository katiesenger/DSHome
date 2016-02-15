USE DSHome;
DROP TABLE IF EXISTS tMenu;
CREATE TABLE tMenu (
 MenuID int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  MenuName nvarchar(255) NOT NULL,
  PagePath nvarchar(255) NOT NULL,
  Sequence int(11) NOT NULL,
  RequiresAuthentication BIT NOT NULL,
  ParentItem int(11) NOT NULL,
  Color nvarchar(10) NOT NULL 
);
INSERT INTO tMenu(MenuName, PagePath, Sequence, RequiresAuthentication, ParentItem, Color) VALUES('Index','./index.php',1,0,1,'black');
INSERT INTO tMenu(MenuName, PagePath, Sequence, RequiresAuthentication, ParentItem, Color) VALUES ('Login','./login.php',1,0,1,'white');
INSERT INTO tMenu(MenuName, PagePath, Sequence, RequiresAuthentication, ParentItem, Color) VALUES ('Register','./register.php',2,0,1,'white');
INSERT INTO tMenu(MenuName, PagePath, Sequence, RequiresAuthentication, ParentItem, Color) VALUES('Home','./home.php',1,1,4,'black');
INSERT INTO tMenu(MenuName, PagePath, Sequence, RequiresAuthentication, ParentItem, Color) VALUES('Edit Menu','./editMenu.php',3,1,4,'white');
INSERT INTO tMenu(MenuName, PagePath, Sequence, RequiresAuthentication, ParentItem, Color) VALUES('Logout','./logout.php',2,1,4,'white');