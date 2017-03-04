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
    
    if (!mysql_select_db("13104036d", $db)) {
        if (mysql_query("CREATE DATABASE 13104036d",$db))
        {
            echo "Database created";
        }
        else
        {
            echo "Error creating database: " . mysql_error();
        }
        mysql_select_db("13104036d", $db);
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
// -- Schema 13104036d
// -- -----------------------------------------------------
    $sql = "DROP SCHEMA IF EXISTS `13104036d` ;";
    mysql_query($sql,$db);

// -- -----------------------------------------------------
// -- Schema 13104036d
// -- -----------------------------------------------------
    $sql = "CREATE SCHEMA IF NOT EXISTS `13104036d` DEFAULT CHARACTER SET utf8 ;";
    mysql_query($sql,$db);
    $sql = "USE `13104036d` ;";
    mysql_query($sql,$db);

// -- -----------------------------------------------------
// -- Table `13104036d`.`User`
// -- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `13104036d`.`User` ;";
    mysql_query($sql,$db);

    $sql = "CREATE TABLE IF NOT EXISTS `13104036d`.`User` (
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
// -- Table `13104036d`.`Destination`
// -- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `13104036d`.`Destination` ;";
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `13104036d`.`Destination` (
        `DesName` VARCHAR(45) NOT NULL,
        `DesType` VARCHAR(1) NOT NULL,
        `DesId` INT NOT NULL AUTO_INCREMENT,
        UNIQUE INDEX `DesId_UNIQUE` (`DesName` ASC),
        PRIMARY KEY (`DesId`))
        ENGINE = InnoDB;";
    mysql_query($sql,$db);

//-- -----------------------------------------------------
//-- Table `13104036d`.`Accomodation`
//-- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `13104036d`.`Accomodation` ;";
    
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `13104036d`.`Accomodation` (
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
        REFERENCES `13104036d`.`Destination` (`DesName`)
        ON DELETE CASCADE
        ON UPDATE NO ACTION)
        ENGINE = InnoDB;";
    
    mysql_query($sql,$db);

//-- -----------------------------------------------------
//-- Table `13104036d`.`TravelPlan`
//-- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `13104036d`.`TravelPlan` ;";
    
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `13104036d`.`TravelPlan` (
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
        REFERENCES `13104036d`.`Accomodation` (`AccName`)
        ON DELETE CASCADE
        ON UPDATE NO ACTION,
        CONSTRAINT `fk_TravelPlan_Destination1`
        FOREIGN KEY (`Destination_DesName`)
        REFERENCES `13104036d`.`Destination` (`DesName`)
        ON DELETE CASCADE
        ON UPDATE NO ACTION)
        ENGINE = InnoDB;";

    mysql_query($sql,$db);

// -- -----------------------------------------------------
// -- Table `13104036d`.`Admin`
// -- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `13104036d`.`Admin` ;";
    
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `13104036d`.`Admin` (
        `AdminAccount` VARCHAR(45) NOT NULL,
        `AdminPassword` VARCHAR(45) NOT NULL,
        PRIMARY KEY (`AdminAccount`),
        UNIQUE INDEX `AdminAccount_UNIQUE` (`AdminAccount` ASC))
        ENGINE = InnoDB;";
    
    mysql_query($sql,$db);

//-- -----------------------------------------------------
//-- Table `13104036d`.`History`
//-- -----------------------------------------------------
    
    $sql = "DROP TABLE IF EXISTS `13104036d`.`History` ;";
    
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `13104036d`.`History` (
        `HistoryDate` VARCHAR(45) NOT NULL,
        `Visitor` int NULL,
        `SalesCount` int NULL,
        PRIMARY KEY (`HistoryDate`),
        UNIQUE INDEX `HistoryDate_UNIQUE` (`HistoryDate` ASC))
        ENGINE = InnoDB;";
    
    mysql_query($sql,$db);




//-- -----------------------------------------------------
//-- Table `13104036d`.`UserOrder`
//-- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `13104036d`.`UserOrder` ;"
    ;
    
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `13104036d`.`UserOrder` (
        `User_UserAccount` VARCHAR(45) NOT NULL,
        `TravelPlan_TPId` INT NOT NULL,
        `OrderStartDate` DATE NOT NULL,
        `OrderQuota` INT NOT NULL,
        PRIMARY KEY (`User_UserAccount`, `TravelPlan_TPId`),
        INDEX `fk_User_has_TravelPlan_TravelPlan1_idx` (`TravelPlan_TPId` ASC),
        INDEX `fk_User_has_TravelPlan_User1_idx` (`User_UserAccount` ASC),
        CONSTRAINT `fk_User_has_TravelPlan_User1`
        FOREIGN KEY (`User_UserAccount`)
        REFERENCES `13104036d`.`User` (`UserAccount`)
        ON DELETE CASCADE
        ON UPDATE NO ACTION,
        CONSTRAINT `fk_User_has_TravelPlan_TravelPlan1`
        FOREIGN KEY (`TravelPlan_TPId`)
        REFERENCES `13104036d`.`TravelPlan` (`TPId`)
        ON DELETE CASCADE
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