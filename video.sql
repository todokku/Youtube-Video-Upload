-- CREATE TABLE "video" ----------------------------------------
CREATE TABLE `video` ( 
	`VideoID` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`VideoTitle` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`VideoSize` Int( 11 ) NOT NULL,
	`VideoLength` Int( 11 ) NOT NULL,
	`VideoLink` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	PRIMARY KEY ( `VideoID` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
-- -------------------------------------------------------------
