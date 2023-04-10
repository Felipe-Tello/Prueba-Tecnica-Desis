-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema php_tecnica
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema php_tecnica
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `php_tecnica` DEFAULT CHARACTER SET utf8 ;
USE `php_tecnica` ;

-- -----------------------------------------------------
-- Table `php_tecnica`.`candidato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `php_tecnica`.`candidato` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated _at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `php_tecnica`.`region`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `php_tecnica`.`region` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated _at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 17
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `php_tecnica`.`provincia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `php_tecnica`.`provincia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated _at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `region_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_provincia_region_idx` (`region_id` ASC) VISIBLE,
  CONSTRAINT `fk_provincia_region`
    FOREIGN KEY (`region_id`)
    REFERENCES `php_tecnica`.`region` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 164
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `php_tecnica`.`comuna`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `php_tecnica`.`comuna` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated _at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` VARCHAR(45) NOT NULL,
  `provincia_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comuna_provincia1_idx` (`provincia_id` ASC) VISIBLE,
  CONSTRAINT `fk_comuna_provincia1`
    FOREIGN KEY (`provincia_id`)
    REFERENCES `php_tecnica`.`provincia` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 15203
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `php_tecnica`.`votante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `php_tecnica`.`votante` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rut` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `alias` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `contacto` SET('Web', 'TV', 'Redes Sociales', 'Amigo') NOT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated _at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comuna_id` INT NOT NULL,
  `region_id` INT NOT NULL,
  `candidato_id` INT NOT NULL,
  PRIMARY KEY (`id`, `rut`),
  INDEX `fk_votante_comuna1_idx` (`comuna_id` ASC) VISIBLE,
  INDEX `fk_votante_region1_idx` (`region_id` ASC) VISIBLE,
  INDEX `fk_votante_candidato1_idx` (`candidato_id` ASC) VISIBLE,
  CONSTRAINT `fk_votante_candidato1`
    FOREIGN KEY (`candidato_id`)
    REFERENCES `php_tecnica`.`candidato` (`id`),
  CONSTRAINT `fk_votante_comuna1`
    FOREIGN KEY (`comuna_id`)
    REFERENCES `php_tecnica`.`comuna` (`id`),
  CONSTRAINT `fk_votante_region1`
    FOREIGN KEY (`region_id`)
    REFERENCES `php_tecnica`.`region` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 23
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
