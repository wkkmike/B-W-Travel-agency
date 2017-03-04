<?php
    $servername = 'mysql.comp.polyu.edu.hk';
    $username = '13104036d';
    $password = "markalvin";
    // Create connection
    $db = mysql_connect($servername, $username, $password);
    
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    
    if (!mysql_select_db("111d", $db)) {
        if (mysql_query("CREATE DATABASE 111d",$db))
        {
            echo "Database created";
        }
        else
        {
            echo "Error creating database: " . mysql_error();
        }
        mysql_select_db("111d", $db);
    }



    $sql = "
        SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;";
    mysql_query($sql, $db);
    $sql = "
        SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;";
    mysql_query($sql, $db);
    $sql = "
        SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';";
    mysql_query($sql, $db);


// -- -----------------------------------------------------
// -- Schema 111d
// -- -----------------------------------------------------
    $sql = "DROP SCHEMA IF EXISTS `111d` ;";
    mysql_query($sql,$db);

// -- -----------------------------------------------------
// -- Schema 111d
// -- -----------------------------------------------------
    $sql = "CREATE SCHEMA IF NOT EXISTS `111d` DEFAULT CHARACTER SET utf8 ;";
    mysql_query($sql,$db);
    $sql = "USE `111d` ;";
    mysql_query($sql,$db);

// -- -----------------------------------------------------
// -- Table `111d`.`User`
// -- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `111d`.`User` ;";
    mysql_query($sql,$db);

    $sql = "CREATE TABLE IF NOT EXISTS `111d`.`User` (
        `UserAccount` VARCHAR(45) NOT NULL,
        `UserPassword` VARCHAR(45) NOT NULL,
        `UserEmail` VARCHAR(45) NOT NULL,
        `UserPhoneNum` DECIMAL(8) NOT NULL,
        `UserBirthday` DATE NOT NULL,
        `UserLoginTime` TIMESTAMP NOT NULL,
        `UserFirstName` VARCHAR(45) NOT NULL,
        `UserLastName` VARCHAR(45) NOT NULL,
        PRIMARY KEY (`UserAccount`),
        UNIQUE INDEX `UserAccount_UNIQUE` (`UserAccount` ASC),
        UNIQUE INDEX `UserEmail_UNIQUE` (`UserEmail` ASC),
        UNIQUE INDEX `UserPhoneNum_UNIQUE` (`UserPhoneNum` ASC))
        ENGINE = InnoDB;";
    mysql_query($sql,$db);


// -- -----------------------------------------------------
// -- Table `111d`.`Destination`
// -- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `111d`.`Destination` ;";
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `111d`.`Destination` (
        `DesName` VARCHAR(45) NOT NULL,
        `DesType` VARCHAR(1) NOT NULL,
        `DesId` INT NOT NULL AUTO_INCREMENT,
        UNIQUE INDEX `DesId_UNIQUE` (`DesName` ASC),
        PRIMARY KEY (`DesId`))
        ENGINE = InnoDB;";
    mysql_query($sql,$db);

//-- -----------------------------------------------------
//-- Table `111d`.`Accomodation`
//-- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `111d`.`Accomodation` ;";
    
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `111d`.`Accomodation` (
        `AccName` VARCHAR(45) NOT NULL,
        `AccAddress` VARCHAR(45) NOT NULL,
        `AccRating` INT NOT NULL,
        `Destination_DesName` VARCHAR(45) NOT NULL,
        `LAT` DOUBLE NOT NULL,
        `LNG` DOUBLE NOT NULL,
        `AccId` INT NOT NULL AUTO_INCREMENT,
        PRIMARY KEY (`AccId`),
        UNIQUE INDEX `AccId_UNIQUE` (`AccName` ASC),
        INDEX `fk_Accomodation_Destination1_idx` (`Destination_DesName` ASC),
        CONSTRAINT `fk_Accomodation_Destination1`
        FOREIGN KEY (`Destination_DesName`)
        REFERENCES `111d`.`Destination` (`DesName`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
        ENGINE = InnoDB;";
    
    mysql_query($sql,$db);

//-- -----------------------------------------------------
//-- Table `111d`.`TravelPlan`
//-- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `111d`.`TravelPlan` ;";
    
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `111d`.`TravelPlan` (
        `TPId` INT NOT NULL AUTO_INCREMENT,
        `TPName` VARCHAR(45) NOT NULL,
        `TPDuration` INT NOT NULL,
        `TPQuotaMin` INT NULL,
        `Accomodation_AccName` VARCHAR(45) NOT NULL,
        `Destination_DesName` VARCHAR(45) NOT NULL,
        `TPPrice` INT NOT NULL,
        `TPQuotaMax` INT NULL,
        `TPDescrip` VARCHAR(500) NOT NULL,
        `TPSalesCount` INT NULL,
        PRIMARY KEY (`TPId`),
        UNIQUE INDEX `AdminAccount_UNIQUE` (`TPId` ASC),
        INDEX `fk_TravelPlan_Accomodation1_idx` (`Accomodation_AccName` ASC),
        INDEX `fk_TravelPlan_Destination1_idx` (`Destination_DesName` ASC),
        CONSTRAINT `fk_TravelPlan_Accomodation1`
        FOREIGN KEY (`Accomodation_AccName`)
        REFERENCES `111d`.`Accomodation` (`AccName`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT `fk_TravelPlan_Destination1`
        FOREIGN KEY (`Destination_DesName`)
        REFERENCES `111d`.`Destination` (`DesName`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
        ENGINE = InnoDB;";

    mysql_query($sql,$db);

// -- -----------------------------------------------------
// -- Table `111d`.`Admin`
// -- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `111d`.`Admin` ;";
    
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `111d`.`Admin` (
        `AdminAccount` VARCHAR(45) NOT NULL,
        `AdminPassword` VARCHAR(45) NOT NULL,
        PRIMARY KEY (`AdminAccount`),
        UNIQUE INDEX `AdminAccount_UNIQUE` (`AdminAccount` ASC))
        ENGINE = InnoDB;";
    
    mysql_query($sql,$db);

//-- -----------------------------------------------------
//-- Table `111d`.`Message`
//-- -----------------------------------------------------
    $sql =  "DROP TABLE IF EXISTS `111d`.`Message` ;";
    
    mysql_query($sql,$db);    
    $sql =  "CREATE TABLE IF NOT EXISTS `111d`.`Message` (
        `MessageId` INT NOT NULL,
        `MessageContent` VARCHAR(500) NULL,
        PRIMARY KEY (`MessageId`))
        ENGINE = InnoDB;";

    mysql_query($sql,$db);    
//-- -----------------------------------------------------
//-- Table `111d`.`User_Has_Message`
//-- -----------------------------------------------------
    $sql =  "DROP TABLE IF EXISTS `111d`.`User_Has_Message` ;";
    
    mysql_query($sql,$db);
    
    $sql =  "CREATE TABLE IF NOT EXISTS `111d`.`User_Has_Message` (
        `User_UserAccount` VARCHAR(45) NOT NULL,
        `Message_MessageId` INT NOT NULL,
        PRIMARY KEY (`User_UserAccount`, `Message_MessageId`),
        INDEX `fk_User_has_Message_Message1_idx` (`Message_MessageId` ASC),
        INDEX `fk_User_has_Message_User1_idx` (`User_UserAccount` ASC),
        CONSTRAINT `fk_User_has_Message_User1`
        FOREIGN KEY (`User_UserAccount`)
        REFERENCES `111d`.`User` (`UserAccount`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT `fk_User_has_Message_Message1`
        FOREIGN KEY (`Message_MessageId`)
        REFERENCES `111d`.`Message` (`MessageId`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
        ENGINE = InnoDB;";
    
    mysql_query($sql,$db);


//-- -----------------------------------------------------
//-- Table `111d`.`UserOrder`
//-- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `111d`.`UserOrder` ;"
    ;
    
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `111d`.`UserOrder` (
        `User_UserAccount` VARCHAR(45) NOT NULL,
        `TravelPlan_TPId` INT NOT NULL,
        `OrderStartDate` DATE NOT NULL,
        `OrderQuota` INT NOT NULL,
        PRIMARY KEY (`User_UserAccount`, `TravelPlan_TPId`),
        INDEX `fk_User_has_TravelPlan_TravelPlan1_idx` (`TravelPlan_TPId` ASC),
        INDEX `fk_User_has_TravelPlan_User1_idx` (`User_UserAccount` ASC),
        CONSTRAINT `fk_User_has_TravelPlan_User1`
        FOREIGN KEY (`User_UserAccount`)
        REFERENCES `111d`.`User` (`UserAccount`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT `fk_User_has_TravelPlan_TravelPlan1`
        FOREIGN KEY (`TravelPlan_TPId`)
        REFERENCES `111d`.`TravelPlan` (`TPId`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
        ENGINE = InnoDB;";
    mysql_query($sql,$db);    
    
    
    
    $sql = "SET SQL_MODE=@OLD_SQL_MODE;";
    mysql_query($sql,$db);
    $sql = "SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;";
    mysql_query($sql,$db);
    $sql = "SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;";
    mysql_query($sql,$db);
    
    $sql="INSERT INTO Admin
        VALUES ('autumnperimemory','111111')";
    $num=mysql_query($sql);
    
    $sql="INSERT INTO Admin
        VALUES ('cowboymark','111111')";
    $num=mysql_query($sql);
    ?>