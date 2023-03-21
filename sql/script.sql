-- MySQL Workbench Forward Engineering
SET
  @OLD_UNIQUE_CHECKS = @ @UNIQUE_CHECKS,
  UNIQUE_CHECKS = 0;
SET
  @OLD_FOREIGN_KEY_CHECKS = @ @FOREIGN_KEY_CHECKS,
  FOREIGN_KEY_CHECKS = 0;
SET
  @OLD_SQL_MODE = @ @SQL_MODE,
  SQL_MODE = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
-- -----------------------------------------------------
  -- Schema bienes-raices
  -- -----------------------------------------------------
  -- -----------------------------------------------------
  -- Schema bienes-raices
  -- -----------------------------------------------------
  CREATE SCHEMA IF NOT EXISTS `bienes-raices` DEFAULT CHARACTER SET utf8;
USE `bienes-raices`;
-- -----------------------------------------------------
  -- Table `bienes-raices`.`vendedores`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `bienes-raices`.`vendedores` (
    `id` INT(11) NOT NULL,
    `nombre` VARCHAR(45) NULL,
    `apellido` VARCHAR(45) NULL,
    `telefono` VARCHAR(15) NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB;
CREATE TABLE IF NOT EXISTS `bienes-raices`.`usuarios` (
    `id` INT(11) NOT NULL,
    `nombre` VARCHAR(45) NULL,
    `apellido` VARCHAR(45) NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` CHAR(60) NULL,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB;
-- -----------------------------------------------------
  -- Table `bienes-raices`.`propiedades`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `bienes-raices`.`propiedades` (
    `id` INT(11) NOT NULL,
    `titulo` VARCHAR(45) NULL,
    `precio` DECIMAL(16, 2) NULL,
    `imagen` VARCHAR(255) NULL,
    `descripcion` LONGTEXT NULL,
    `habitaciones` INT(1) NULL,
    `wc` INT(1) NULL,
    `estacionamiento` INT(1) NULL,
    `creado` DATE NULL,
    `vendedores_id` INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_propiedades_vendedores` FOREIGN KEY (`vendedores_id`) REFERENCES `bienes-raices`.`vendedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
  ) ENGINE = InnoDB;
SET
  SQL_MODE = @OLD_SQL_MODE;
SET
  FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET
  UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;
-- -----------------------------------------------------
  -- Data for table `bienes-raices`.`vendedores`
  -- -----------------------------------------------------
  START TRANSACTION;
USE `bienes-raices`;
INSERT INTO
  `bienes-raices`.`vendedores` (`id`, `nombre`, `apellido`, `telefono`)
VALUES
  (1, 'Fabrizio', 'Ferroni', '3535693037');
INSERT INTO
  `bienes-raices`.`vendedores` (`id`, `nombre`, `apellido`, `telefono`)
VALUES
  (2, 'Augusto', 'Ferroni', '3534196762');
COMMIT;