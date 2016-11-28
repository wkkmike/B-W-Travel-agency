<?php
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    
    // Create connection
    $db = mysql_connect($servername, $username, $password);
    
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    
    if (!mysql_select_db("mydb", $db)) {
        if (mysql_query("CREATE DATABASE mydb",$db))
        {
            echo "Database created";
        }
        else
        {
            echo "Error creating database: " . mysql_error();
        }
        mysql_select_db("mydb", $db);
    }
    
    // Create table in my_db database
    
    $sql = "
        SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;";
    mysql_query($sql, $db);
    $sql = "
        SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;";
    mysql_query($sql, $db);
    $sql = "
        SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';";
    mysql_query($sql, $db);
    
    //-- -----------------------------------------------------
    //-- Table `mydb`.`User`
    //-- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `mydb`.`User` ;";
    mysql_query($sql, $db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `mydb`.`User` (
        `UserAccount` VARCHAR(45) NOT NULL,
        `UserPassword` CHAR(32) NOT NULL,
        `UserEmail` VARCHAR(45) NOT NULL,
        `UserPhoneNum` DECIMAL(8) NOT NULL,
        `UserBirthday` DATE NULL,
        PRIMARY KEY (`UserAccount`),
        UNIQUE INDEX `UserAccount_UNIQUE` (`UserAccount` ASC),
        UNIQUE INDEX `UserEmail_UNIQUE` (`UserEmail` ASC),
        UNIQUE INDEX `UserPhoneNum_UNIQUE` (`UserPhoneNum` ASC))
        ENGINE = InnoDB;";
    mysql_query($sql, $db);
    
    
    //-- -----------------------------------------------------
    //-- Table `mydb`.`Destination`
    //-- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `mydb`.`Destination` ;";
    mysql_query($sql, $db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `mydb`.`Destination` (
        `DesName` VARCHAR(45) NOT NULL,
        `DesType` VARCHAR(1) NOT NULL,
        `DesDescribe` VARCHAR(1000) NULL,
        PRIMARY KEY (`DesName`),
        UNIQUE INDEX `DesName_UNIQUE` (`DesName` ASC))
        ENGINE = InnoDB;";
    mysql_query($sql, $db);
    
    
    // -- -----------------------------------------------------
    // -- Table `mydb`.`Accomodation`
    // -- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `mydb`.`Accomodation`;";
    
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `mydb`.`Accomodation` (
        `AccName` VARCHAR(45) NOT NULL,
        `AccAddress` VARCHAR(45) NOT NULL,
        `AccRating` DOUBLE NOT NULL,
        `AccPrice` DOUBLE NOT NULL,
        `Destination_DesName` VARCHAR(45) NOT NULL,
        `LAT` DOUBLE NOT NULL,
        `LNG` DOUBLE NOT NULL,
        PRIMARY KEY (`AccName`),
        INDEX `fk_Accomodation_Destination1_idx` (`Destination_DesName` ASC),
        CONSTRAINT `fk_Accomodation_Destination1`
        FOREIGN KEY (`Destination_DesName`)
        REFERENCES `mydb`.`Destination` (`DesName`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
        ENGINE = InnoDB;";
    
    mysql_query($sql,$db);
    
    
    // -- -----------------------------------------------------
    // -- Table `mydb`.`Flight`
    // -- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `mydb`.`Flight`;";
    
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `mydb`.`Flight` (
        `FlightDepTime` VARCHAR(45) NOT NULL,
        `FlightArrTime` VARCHAR(45) NOT NULL,
        `FlightPrice` DOUBLE NOT NULL,
        `FlightNum` VARCHAR(45) NOT NULL,
        `Destination_DesName` VARCHAR(45) NOT NULL,
        PRIMARY KEY (`FlightNum`),
        INDEX `fk_Flight_Destination1_idx` (`Destination_DesName` ASC),
        CONSTRAINT `fk_Flight_Destination1`
        FOREIGN KEY (`Destination_DesName`)
        REFERENCES `mydb`.`Destination` (`DesName`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
        ENGINE = InnoDB;";
    
    mysql_query($sql,$db);
    // -- -----------------------------------------------------
    // -- Table `mydb`.`TravelPlan`
    // -- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `mydb`.`TravelPlan` ;";
    
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `mydb`.`TravelPlan` (
        `TPId` INT NOT NULL AUTO_INCREMENT,
        `TPStartDate` DATE NOT NULL,
        `TPDuration` INT NOT NULL,
        `TPQuota` VARCHAR(45) NULL,
        `Accomodation_AccName` VARCHAR(45) NOT NULL,
        `Flight_FlightNum` VARCHAR(45) NOT NULL,
        `Destination_DesName` VARCHAR(45) NOT NULL,
        PRIMARY KEY (`TPId`),
        UNIQUE INDEX `AdminAccount_UNIQUE` (`TPId` ASC),
        INDEX `fk_TravelPlan_Accomodation1_idx` (`Accomodation_AccName` ASC),
        INDEX `fk_TravelPlan_Flight1_idx` (`Flight_FlightNum` ASC),
        INDEX `fk_TravelPlan_Destination1_idx` (`Destination_DesName` ASC),
        CONSTRAINT `fk_TravelPlan_Accomodation1`
        FOREIGN KEY (`Accomodation_AccName`)
        REFERENCES `mydb`.`Accomodation` (`AccName`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT `fk_TravelPlan_Flight1`
        FOREIGN KEY (`Flight_FlightNum`)
        REFERENCES `mydb`.`Flight` (`FlightNum`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT `fk_TravelPlan_Destination1`
        FOREIGN KEY (`Destination_DesName`)
        REFERENCES `mydb`.`Destination` (`DesName`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
        ENGINE = InnoDB;";
    
    mysql_query($sql,$db);
    
    
    // -- -----------------------------------------------------
    // -- Table `mydb`.`Admin`
    // -- -----------------------------------------------------
    
    $sql =  "DROP TABLE IF EXISTS `mydb`.`Admin` ;";
    
    mysql_query($sql,$db);
    
    $sql =  "CREATE TABLE IF NOT EXISTS `mydb`.`Admin` (
        `AdminAccount` VARCHAR(45) NOT NULL,
        `AdminPassword` CHAR(32) NOT NULL,
        PRIMARY KEY (`AdminAccount`),
        UNIQUE INDEX `AdminAccount_UNIQUE` (`AdminAccount` ASC))
        ENGINE = InnoDB;";
    
    mysql_query($sql,$db);
    
    // -- -----------------------------------------------------
    // -- Table `mydb`.`Order`
    // -- -----------------------------------------------------
    $sql = "DROP TABLE IF EXISTS `mydb`.`OrderIF` ;";
    
    mysql_query($sql,$db);
    
    $sql = "DROP TABLE IF EXISTS `mydb`.`Order` ;";
    
    mysql_query($sql,$db);
    
    $sql = "CREATE TABLE IF NOT EXISTS `mydb`.`OrderIF` (
        `OrderId` INT NOT NULL AUTO_INCREMENT,
        `User_UserAccount` VARCHAR(45) NOT NULL,
        `TravelPlan_TPId` INT NOT NULL,
        PRIMARY KEY (`OrderId`),
        UNIQUE INDEX `OrderId_UNIQUE` (`OrderId` ASC),
        INDEX `fk_OrderIF_TravelPlan1_idx` (`TravelPlan_TPId` ASC),
        CONSTRAINT `fk_OrderIF_User`
        FOREIGN KEY (`User_UserAccount`)
        REFERENCES `mydb`.`User` (`UserAccount`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
        CONSTRAINT `fk_OrderIF_TravelPlan1`
        FOREIGN KEY (`TravelPlan_TPId`)
        REFERENCES `mydb`.`TravelPlan` (`TPId`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
        ENGINE = InnoDB;";
    mysql_query($sql,$db);
    
    $sql="INSERT INTO Admin
        VALUES ('autumnperimemory','111111')";
    $num=mysql_query($sql);
    
    $sql="INSERT INTO Admin
        VALUES ('cowboymark','111111')";
    $num=mysql_query($sql);
    
    
    $sql = "SET SQL_MODE=@OLD_SQL_MODE;";
    mysql_query($sql,$db);
    $sql = "SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;";
    mysql_query($sql,$db);
    $sql = "SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;";
    mysql_query($sql,$db);
?>