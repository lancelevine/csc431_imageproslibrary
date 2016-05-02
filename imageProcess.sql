CREATE TABLE `imagepr2_mainDB`.`Images` (
	`IID` INT NOT NULL ,
	`name` VARCHAR(350),
	`UID` INT NOT NULL ,
	`tags` VARCHAR(1000) ,
	`format` VARCHAR(20) NOT NULL ,
	`sharing` VARCHAR(1000) NOT NULL,
	`dateTaken` DATETIME ,
	`locationTaken` VARCHAR(150) ,
	`photographer` VARCHAR(150) ,
	`cameraUsed` VARCHAR(150) ,
	`peopleInPhoto` VARCHAR(150) ,
	
	PRIMARY KEY(`IID`),
	
	CONSTRAINT `UIDs`
    FOREIGN KEY (`UID`)
    REFERENCES `imagepr2_mainDB`.`Users` (`UID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

