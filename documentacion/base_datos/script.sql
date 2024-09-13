-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema Base_datos_patio_bonito
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Base_datos_patio_bonito
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Base_datos_patio_bonito` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `Base_datos_patio_bonito` ;

-- -----------------------------------------------------
-- Table `Base_datos_patio_bonito`.`Roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_datos_patio_bonito`.`Roles` (
  `id_Roles` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_Roles`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Base_datos_patio_bonito`.`Usarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_datos_patio_bonito`.`Usarios` (
  `id_Usarios` INT NOT NULL AUTO_INCREMENT,
  `nombre_usuario` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `contraseña` VARCHAR(45) NULL,
  PRIMARY KEY (`id_Usarios`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Base_datos_patio_bonito`.`Usuario_rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_datos_patio_bonito`.`Usuario_rol` (
  `id_Usuario_rol` INT NOT NULL AUTO_INCREMENT,
  `id_Roles` INT NOT NULL,
  `id_Usarios` INT NOT NULL,
  PRIMARY KEY (`id_Usuario_rol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Base_datos_patio_bonito`.`Productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_datos_patio_bonito`.`Productos` (
  `id_Productos` INT NOT NULL AUTO_INCREMENT,
  `nombre_producto` VARCHAR(45) NULL,
  `descripcion_producto` TEXT(100) NULL,
  `precio_compra` DECIMAL(50) NULL,
  `cantidad` INT NULL,
  `fecha_creacion` DATETIME NULL,
  PRIMARY KEY (`id_Productos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Base_datos_patio_bonito`.`Pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_datos_patio_bonito`.`Pedidos` (
  `id_Pedidos` INT NOT NULL AUTO_INCREMENT,
  `numero_mesa` INT NULL,
  `estado` VARCHAR(45) NULL,
  `fecha_pedido` DATETIME NULL,
  `cantidad` INT NULL,
  `detalles` VARCHAR(100) NULL,
  PRIMARY KEY (`id_Pedidos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Base_datos_patio_bonito`.`pedido_producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_datos_patio_bonito`.`pedido_producto` (
  `id_pedido_producto` INT NOT NULL AUTO_INCREMENT,
  `id_Productos` INT NOT NULL,
  `id_Pedidos` INT NOT NULL,
  PRIMARY KEY (`id_pedido_producto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Base_datos_patio_bonito`.`pedidos_usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_datos_patio_bonito`.`pedidos_usuarios` (
  `id_pedidos_usuarios` INT NOT NULL AUTO_INCREMENT,
  `id_Usarios` INT NOT NULL,
  `id_Pedidos` INT NOT NULL,
  PRIMARY KEY (`id_pedidos_usuarios`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Base_datos_patio_bonito`.`entrada_inventario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_datos_patio_bonito`.`entrada_inventario` (
  `id_entrada_inventario` INT NOT NULL AUTO_INCREMENT,
  `Productos_id_Productos` INT NOT NULL,
  `cantidad` INT NULL,
  `fecha_entrada` DATETIME NULL,
  PRIMARY KEY (`id_entrada_inventario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Base_datos_patio_bonito`.`salida_inventario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Base_datos_patio_bonito`.`salida_inventario` (
  `id_salida_inventario` INT NOT NULL AUTO_INCREMENT,
  `Productos_id_Productos` INT NOT NULL,
  `cantidad_utilizada` INT NULL,
  `fecha_salida` DATETIME NULL,
  `motivo_salida` VARCHAR(45) NULL,
  PRIMARY KEY (`id_salida_inventario`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
