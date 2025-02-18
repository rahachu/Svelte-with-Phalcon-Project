-- MySQL Script generated by MySQL Workbench
-- Kam 02 Jul 2020 03:59:01  WIB
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema pateron
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `pateron` ;

-- -----------------------------------------------------
-- Schema pateron
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pateron` ;
USE `pateron` ;

-- -----------------------------------------------------
-- Table `pateron`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pateron`.`user` ;

CREATE TABLE IF NOT EXISTS `pateron`.`user` (
  `iduser` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` CHAR(60) NULL,
  `token` CHAR(32) NULL,
  `email_verified_at` VARCHAR(45) NULL,
  PRIMARY KEY (`iduser`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pateron`.`siswa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pateron`.`siswa` ;

CREATE TABLE IF NOT EXISTS `pateron`.`siswa` (
  `iduser` INT NOT NULL,
  `fullname` VARCHAR(45) NULL,
  `school` VARCHAR(45) NULL,
  `city` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  PRIMARY KEY (`iduser`),
  CONSTRAINT `fk_siswa_user`
    FOREIGN KEY (`iduser`)
    REFERENCES `pateron`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pateron`.`mentor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pateron`.`mentor` ;

CREATE TABLE IF NOT EXISTS `pateron`.`mentor` (
  `iduser` INT NOT NULL,
  `fullname` VARCHAR(45) NULL,
  `institution` VARCHAR(45) NULL,
  `quote` VARCHAR(255) NULL,
  `photo` MEDIUMBLOB NULL,
  PRIMARY KEY (`iduser`),
  CONSTRAINT `fk_mentor_user1`
    FOREIGN KEY (`iduser`)
    REFERENCES `pateron`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
