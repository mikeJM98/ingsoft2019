-- MySQL Script generated by MySQL Workbench
-- mar 30 abr 2019 01:20:53 -05
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`modulos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`modulos` (
  `idmodulo` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idmodulo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`perfiles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`perfiles` (
  `idperfil` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(50) NOT NULL,
  `estado` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idperfil`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`permisos` (
  `idperfil` INT NOT NULL,
  `idmodulo` INT NOT NULL,
  `estado` TINYINT(1) NOT NULL,
  INDEX `fk_permisos_perfiles1_idx` (`idperfil` ASC),
  INDEX `fk_permisos_modulos1_idx` (`idmodulo` ASC),
  CONSTRAINT `fk_permisos_perfiles1`
    FOREIGN KEY (`idperfil`)
    REFERENCES `mydb`.`perfiles` (`idperfil`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_permisos_modulos1`
    FOREIGN KEY (`idmodulo`)
    REFERENCES `mydb`.`modulos` (`idmodulo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuarios` (
  `usuario_id` INT NOT NULL,
  `perfil_id` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `usuario` VARCHAR(20) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `fecha_registro` DATE NOT NULL,
  `celular` CHAR(9) NULL,
  `direccion` VARCHAR(45) NULL,
  `estado` CHAR(1) NOT NULL,
  PRIMARY KEY (`usuario_id`),
  INDEX `fk_usuarios_perfiles1_idx` (`perfil_id` ASC),
  CONSTRAINT `fk_usuarios_perfiles1`
    FOREIGN KEY (`perfil_id`)
    REFERENCES `mydb`.`perfiles` (`idperfil`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
