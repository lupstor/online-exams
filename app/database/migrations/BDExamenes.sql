SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `examenes` ;
CREATE SCHEMA IF NOT EXISTS `examenes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `examenes` ;

-- -----------------------------------------------------
-- Table `examenes`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `examenes`.`Usuario` ;

CREATE  TABLE IF NOT EXISTS `examenes`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `usuario` VARCHAR(15) NOT NULL ,
  `password` VARCHAR(500) NOT NULL ,
  `nombre` VARCHAR(100) NOT NULL ,
  `email` VARCHAR(100) NOT NULL ,
  `rol` VARCHAR(15) NOT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;

ALTER TABLE `examenes`.`Usuario` ADD CONSTRAINT chk_Rol CHECK (rol = 'admin' OR rol = 'profesor' OR rol = 'alumno');
-- -----------------------------------------------------
-- Table `examenes`.`Curso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `examenes`.`Curso` ;

CREATE  TABLE IF NOT EXISTS `examenes`.`Curso` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `catedratico` INT NOT NULL ,
  `nombre` VARCHAR(100) NOT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `idCatedratico_idx` (`catedratico` ASC) ,
  CONSTRAINT `catedratico`
    FOREIGN KEY (`catedratico` )
    REFERENCES `examenes`.`Usuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `examenes`.`Examen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `examenes`.`Examen` ;

CREATE  TABLE IF NOT EXISTS `examenes`.`Examen` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `curso` INT NOT NULL ,
  `titulo` VARCHAR(45) NOT NULL ,
  `nPreguntas` INT NOT NULL ,
  `nIntentos` INT NOT NULL ,
  `duracion` INT NOT NULL ,
  `horaInicio` TIME NOT NULL ,
  `horaFin` TIME NOT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `idCurso_idx` (`curso` ASC) ,
  CONSTRAINT `idCurso`
    FOREIGN KEY (`curso` )
    REFERENCES `examenes`.`Curso` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `examenes`.`Pregunta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `examenes`.`Pregunta` ;

CREATE  TABLE IF NOT EXISTS `examenes`.`Pregunta` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `examen` INT NOT NULL ,
  `tipoRespuesta` VARCHAR(15) NOT NULL ,
  `Instruccion` VARCHAR(500) NOT NULL ,
  `pregunta` VARCHAR(300) NOT NULL ,
  `punteo` DECIMAL NOT NULL ,
  `respuestaCorrecta` VARCHAR(45) NOT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `idExamen_idx` (`examen` ASC) ,
  CONSTRAINT `idExamen`
    FOREIGN KEY (`examen` )
    REFERENCES `examenes`.`Examen` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

ALTER TABLE `examenes`.`Pregunta` ADD CONSTRAINT chk_Rol CHECK (tipoRespuesta = 'fv' OR tipoRespuesta = 'sel_mul' OR tipoRespuesta = 'directa');
-- -----------------------------------------------------
-- Table `examenes`.`Respuesta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `examenes`.`Respuesta` ;

CREATE  TABLE IF NOT EXISTS `examenes`.`Respuesta` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `pregunta` INT NOT NULL ,
  `respuesta` VARCHAR(200) NOT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  INDEX `idPregunta_idx` (`pregunta` ASC) ,
  PRIMARY KEY (`id`, `pregunta`) ,
  CONSTRAINT `idPregunta`
    FOREIGN KEY (`pregunta` )
    REFERENCES `examenes`.`Pregunta` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `examenes`.`Evaluacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `examenes`.`Evaluacion` ;

CREATE  TABLE IF NOT EXISTS `examenes`.`Evaluacion` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `alumno` INT NOT NULL ,
  `examen` INT NOT NULL ,
  `punteo` DECIMAL NOT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `idExamen_idx` (`examen` ASC) ,
  INDEX `fk_Evaluacion_Usuario1_idx` (`alumno` ASC) ,
  CONSTRAINT `evaluacion_examen`
    FOREIGN KEY (`examen` )
    REFERENCES `examenes`.`Examen` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `evaluacion_alumno`
    FOREIGN KEY (`alumno` )
    REFERENCES `examenes`.`Usuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `examenes`.`DetalleEvaluacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `examenes`.`DetalleEvaluacion` ;

CREATE  TABLE IF NOT EXISTS `examenes`.`DetalleEvaluacion` (
  `evaluacion` INT NOT NULL ,
  `pregunta` INT NOT NULL ,
  `respuesta` VARCHAR(200) NOT NULL ,
  `punteo` DECIMAL NOT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  PRIMARY KEY (`evaluacion`, `pregunta`) ,
  INDEX `idPregunta_idx` (`pregunta` ASC) ,
  INDEX `idEvaluacion_idx` (`evaluacion` ASC) ,
  CONSTRAINT `detalle_evaluacion`
    FOREIGN KEY (`pregunta` )
    REFERENCES `examenes`.`Pregunta` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `detalle_pregunta`
    FOREIGN KEY (`evaluacion` )
    REFERENCES `examenes`.`Evaluacion` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `examenes`.`Asignacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `examenes`.`Asignacion` ;

CREATE  TABLE IF NOT EXISTS `examenes`.`Asignacion` (
  `curso` INT NULL ,
  `alumno` INT NULL ,
  `created_at` TIMESTAMP NULL ,
  `updated_at` TIMESTAMP NULL ,
  INDEX `idCurso_idx` (`curso` ASC) ,
  INDEX `fk_Asignacion_Usuario1_idx` (`alumno` ASC) ,
  PRIMARY KEY (`curso`, `alumno`) ,
  CONSTRAINT `asignacion_curso`
    FOREIGN KEY (`curso` )
    REFERENCES `examenes`.`Curso` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `asignacion_alumno`
    FOREIGN KEY (`alumno` )
    REFERENCES `examenes`.`Usuario` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

