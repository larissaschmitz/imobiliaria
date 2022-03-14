-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema imobiliaria
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema imobiliaria
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `imobiliaria` DEFAULT CHARACTER SET utf8 ;
USE `imobiliaria` ;

-- -----------------------------------------------------
-- Table `imobiliaria`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `imobiliaria`.`endereco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `estado` VARCHAR(45) NULL,
  `cidade` VARCHAR(45) NULL,
  `bairro` VARCHAR(45) NULL,
  `rua` VARCHAR(45) NULL,
  `numero` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;




-- -----------------------------------------------------
-- Table `imobiliaria`.`locatario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `imobiliaria`.`locatario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `dataNasc` DATE NULL,
  `email` VARCHAR(100) NULL,
  `senha` VARCHAR(45) NULL,
  `endereco_id` INT NOT NULL,
  PRIMARY KEY (`id`, `endereco_id`),
  INDEX `fk_locatario_endereco_idx` (`endereco_id` ASC) VISIBLE,
  CONSTRAINT `fk_locatario_endereco`
    FOREIGN KEY (`endereco_id`)
    REFERENCES `imobiliaria`.`endereco` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `imobiliaria`.`imovel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `imobiliaria`.`imovel` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NULL,
  `quartos` INT NULL,
  `banheiros` INT NULL,
  `endereco` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `imobiliaria`.`locacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `imobiliaria`.`locacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `dataEntrada` DATE NULL,
  `dataSaida` DATE NULL,
  `valor` VARCHAR(45) NULL,
  `locatario_id` INT NOT NULL,
  `imovel_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_locacao_locatario1_idx` (`locatario_id` ASC) VISIBLE,
  INDEX `fk_locacao_imovel1_idx` (`imovel_id` ASC) VISIBLE,
  CONSTRAINT `fk_locacao_locatario1`
    FOREIGN KEY (`locatario_id`)
    REFERENCES `imobiliaria`.`locatario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_locacao_imovel1`
    FOREIGN KEY (`imovel_id`)
    REFERENCES `imobiliaria`.`imovel` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `imobiliaria`.`locador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `imobiliaria`.`locador` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `dataNasc` DATE NULL,
  `email` VARCHAR(100) NULL,
  `senha` VARCHAR(45) NULL,
  `quantImoveis` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `imobiliaria`.`imovel_has_locador`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `imobiliaria`.`imovel_has_locador` (
  `imovel_id` INT NOT NULL,
  `locador_id` INT NOT NULL,
  PRIMARY KEY (`imovel_id`, `locador_id`),
  INDEX `fk_imovel_has_locador_locador1_idx` (`locador_id` ASC) VISIBLE,
  INDEX `fk_imovel_has_locador_imovel1_idx` (`imovel_id` ASC) VISIBLE,
  CONSTRAINT `fk_imovel_has_locador_imovel1`
    FOREIGN KEY (`imovel_id`)
    REFERENCES `imobiliaria`.`imovel` (`id`),
  CONSTRAINT `fk_imovel_has_locador_locador1`
    FOREIGN KEY (`locador_id`)
    REFERENCES `imobiliaria`.`locador` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
