-- MySQL Script generated by MySQL Workbench
-- Wed Jul 22 10:21:56 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema pateron
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
-- DROP TABLE IF EXISTS `user` ;

CREATE TABLE IF NOT EXISTS `user` (
  `iduser` INT(11) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` CHAR(60) NULL DEFAULT NULL,
  `token` CHAR(32) NULL DEFAULT NULL,
  `email_verified_at` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`iduser`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `mentor`
-- -----------------------------------------------------
-- DROP TABLE IF EXISTS `mentor` ;

CREATE TABLE IF NOT EXISTS `mentor` (
  `iduser` INT(11) NOT NULL,
  `fullname` VARCHAR(45) NULL DEFAULT NULL,
  `institution` VARCHAR(45) NULL DEFAULT NULL,
  `quote` VARCHAR(255) NULL DEFAULT NULL,
  `photo` MEDIUMBLOB NULL DEFAULT NULL,
  PRIMARY KEY (`iduser`),
  CONSTRAINT `fk_mentor_user1`
    FOREIGN KEY (`iduser`)
    REFERENCES `user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `siswa`
-- -----------------------------------------------------
-- DROP TABLE IF EXISTS `siswa` ;

CREATE TABLE IF NOT EXISTS `siswa` (
  `iduser` INT(11) NOT NULL,
  `fullname` VARCHAR(45) NULL DEFAULT NULL,
  `school` VARCHAR(45) NULL DEFAULT NULL,
  `city` VARCHAR(45) NULL DEFAULT NULL,
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`iduser`),
  CONSTRAINT `fk_siswa_user`
    FOREIGN KEY (`iduser`)
    REFERENCES `user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `tryout`
-- -----------------------------------------------------
-- DROP TABLE IF EXISTS `tryout` ;

CREATE TABLE IF NOT EXISTS `tryout` (
  `idtryout` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `tryout_price` INT NULL,
  `publish_time` VARCHAR(45) NULL,
  PRIMARY KEY (`idtryout`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `timestamps`
-- -----------------------------------------------------
-- DROP TABLE IF EXISTS `timestamps` ;

CREATE TABLE IF NOT EXISTS `timestamps` (
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` TIMESTAMP NULL);


-- -----------------------------------------------------
-- Table `subtest`
-- -----------------------------------------------------
-- DROP TABLE IF EXISTS `subtest` ;

CREATE TABLE IF NOT EXISTS `subtest` (
  `idsubtest` INT NOT NULL,
  `tryout_idtryout` INT NOT NULL,
  `judul` VARCHAR(45) NULL,
  `time_in_minute` INT NULL,
  PRIMARY KEY (`idsubtest`, `tryout_idtryout`),
  INDEX `fk_subtest_tryout1_idx` (`tryout_idtryout` ASC),
  CONSTRAINT `fk_subtest_tryout1`
    FOREIGN KEY (`tryout_idtryout`)
    REFERENCES `tryout` (`idtryout`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `soal`
-- -----------------------------------------------------
-- DROP TABLE IF EXISTS `soal` ;

CREATE TABLE IF NOT EXISTS `soal` (
  `no` INT NOT NULL,
  `subtest_idsubtest` INT NOT NULL,
  `subtest_tryout_idtryout` INT NOT NULL,
  `question` LONGTEXT NULL,
  `option_a` MEDIUMTEXT NULL,
  `option_b` MEDIUMTEXT NULL,
  `option_c` MEDIUMTEXT NULL,
  `option_d` MEDIUMTEXT NULL,
  `option_e` MEDIUMTEXT NULL,
  `key` ENUM('A', 'B', 'C', 'D', 'E') NULL,
  `solution` LONGTEXT NULL,
  PRIMARY KEY (`no`, `subtest_idsubtest`, `subtest_tryout_idtryout`),
  INDEX `fk_soal_subtest1_idx` (`subtest_idsubtest` ASC, `subtest_tryout_idtryout` ASC),
  CONSTRAINT `fk_soal_subtest1`
    FOREIGN KEY (`subtest_idsubtest` , `subtest_tryout_idtryout`)
    REFERENCES `subtest` (`idsubtest` , `tryout_idtryout`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `siswa_has_tryout`
-- -----------------------------------------------------
-- DROP TABLE IF EXISTS `siswa_has_tryout` ;

CREATE TABLE IF NOT EXISTS `siswa_has_tryout` (
  `siswa_iduser` INT(11) NOT NULL,
  `tryout_idtryout` INT NOT NULL,
  `confirm_time` VARCHAR(45) NULL,
  PRIMARY KEY (`siswa_iduser`, `tryout_idtryout`),
  INDEX `fk_siswa_has_tryout_tryout1_idx` (`tryout_idtryout` ASC),
  INDEX `fk_siswa_has_tryout_siswa1_idx` (`siswa_iduser` ASC),
  CONSTRAINT `fk_siswa_has_tryout_siswa1`
    FOREIGN KEY (`siswa_iduser`)
    REFERENCES `siswa` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_siswa_has_tryout_tryout1`
    FOREIGN KEY (`tryout_idtryout`)
    REFERENCES `tryout` (`idtryout`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `siswa_has_soal`
-- -----------------------------------------------------
-- DROP TABLE IF EXISTS `siswa_has_soal` ;

CREATE TABLE IF NOT EXISTS `siswa_has_soal` (
  `siswa_iduser` INT(11) NOT NULL,
  `soal_no` INT NOT NULL,
  `soal_subtest_idsubtest` INT NOT NULL,
  `soal_subtest_tryout_idtryout` INT NOT NULL,
  PRIMARY KEY (`siswa_iduser`, `soal_no`, `soal_subtest_idsubtest`, `soal_subtest_tryout_idtryout`),
  INDEX `fk_siswa_has_soal_soal1_idx` (`soal_no` ASC, `soal_subtest_idsubtest` ASC, `soal_subtest_tryout_idtryout` ASC),
  INDEX `fk_siswa_has_soal_siswa1_idx` (`siswa_iduser` ASC),
  CONSTRAINT `fk_siswa_has_soal_siswa1`
    FOREIGN KEY (`siswa_iduser`)
    REFERENCES `siswa` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_siswa_has_soal_soal1`
    FOREIGN KEY (`soal_no` , `soal_subtest_idsubtest` , `soal_subtest_tryout_idtryout`)
    REFERENCES `soal` (`no` , `subtest_idsubtest` , `subtest_tryout_idtryout`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `pateron`.`table1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pateron`.`table1` (
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pateron`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pateron`.`product` (
  `idproduct` INT NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `tryout_idtryout` INT NOT NULL,
  PRIMARY KEY (`idproduct`),
  INDEX `fk_product_tryout1_idx` (`tryout_idtryout` ASC) VISIBLE,
  CONSTRAINT `fk_product_tryout1`
    FOREIGN KEY (`tryout_idtryout`)
    REFERENCES `pateron`.`tryout` (`idtryout`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `pateron`.`siswa_buy_product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pateron`.`siswa_buy_product` (
  `idsiswa_buy_product` INT NOT NULL,
  `iduser` INT NOT NULL,
  `idproduct` INT NOT NULL,
  `buy_time` VARCHAR(45) NOT NULL,
  `pyment_method` VARCHAR(45) NOT NULL,
  `proof_of_pyment` JSON NOT NULL DEFAULT '{}',
  `validation` TINYINT NULL,
  `idadmin` INT NULL,
  PRIMARY KEY (`idsiswa_buy_product`),
  INDEX `idproduct_idx` (`idproduct` ASC) VISIBLE,
  INDEX `iduser_idx` (`iduser` ASC) VISIBLE,
  CONSTRAINT `iduser`
    FOREIGN KEY (`iduser`)
    REFERENCES `pateron`.`siswa` (`iduser`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `idproduct`
    FOREIGN KEY (`idproduct`)
    REFERENCES `pateron`.`product` (`idproduct`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
