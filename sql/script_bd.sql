-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema tcc
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tcc` DEFAULT CHARACTER SET utf8 ;
USE `tcc` ;

CREATE TABLE IF NOT EXISTS `tcc`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NULL,
  `email` VARCHAR(250) NULL,
  `senha` VARCHAR(250) NULL,
  `tipo` VARCHAR(250) NULL,
  `cpf` VARCHAR(250) NULL,
  `telefone` VARCHAR(250) NULL,
  `curriculo` VARCHAR(250) NULL,
  `status` VARCHAR(250) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tcc`.`projeto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NULL,
  `prazoinicio` DATE NULL,
  `prazofim` DATE NULL,
  `descricao` VARCHAR(550) NULL,
  `edital` VARCHAR(550) NULL,
  `analista` INT NOT NULL,
  `status` VARCHAR(250) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tcc`.`requisito` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NULL,
  `prazo` DATE NULL,
  `descricao` VARCHAR(550) NULL,
  `idpro` INT NOT NULL,
  `status` VARCHAR(250) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_requisito_projeto_idx` (`id` ASC),
  CONSTRAINT `fk_requisito_projeto`
    FOREIGN KEY (`idpro`)
    REFERENCES `tcc`.`projeto` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tcc`.`arquivo_pro` (
  `arquivos` VARCHAR(550) NULL,
  `idpro` INT NOT NULL,
  INDEX `fk_arquivo_pro_projeto_idx` (`idpro` ASC),
  CONSTRAINT `fk_arquivo_pro_projeto`
    FOREIGN KEY (`idpro`)
    REFERENCES `tcc`.`projeto` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tcc`.`arquivo_req` (
  `arquivos` VARCHAR(550) NULL,
  `idreq` INT NOT NULL,
  INDEX `fk_arquivo_pro_requisito_idx` (`idreq` ASC),
  CONSTRAINT `fk_arquivo_pro_requisito`
    FOREIGN KEY (`idreq`)
    REFERENCES `tcc`.`requisito` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tcc`.`usuario_projeto` (
  `idusu` INT NOT NULL,
  `idpro` INT NOT NULL,
  PRIMARY KEY (`idusu`, `idpro`),
  INDEX `fk_usuario_projeto_projeto_idx` (`idpro` ASC),
  INDEX `fk_usuario_projeto_usuario_idx` (`idusu` ASC),
  CONSTRAINT `fk_usuario_projeto_usuario`
    FOREIGN KEY (`idusu`)
    REFERENCES `tcc`.`usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_projeto_projeto`
    FOREIGN KEY (`idpro`)
    REFERENCES `tcc`.`projeto` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tcc`.`usuario_requisito` (
  `idusu` INT NOT NULL,
  `idreq` INT NOT NULL,
  PRIMARY KEY (`idusu`, `idreq`),
  INDEX `fk_usuario_requisito_requisito_idx` (`idreq` ASC),
  INDEX `fk_usuario_requisito_usuario_idx` (`idusu` ASC),
  CONSTRAINT `fk_usuario_requisito_usuario`
    FOREIGN KEY (`idusu`)
    REFERENCES `tcc`.`usuario` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_requisito_requisito`
    FOREIGN KEY (`idreq`)
    REFERENCES `tcc`.`requisito` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
