CREATE DATABASE empleados CHARACTER SET UTF8 COLLATE utf8_spanish2_ci;
USE empleados;

CREATE TABLE empleado (
  cedula char(11) NOT NULL,
  nombres varchar(40) NOT NULL,
  apellidos varchar(40) NOT NULL,
  correo varchar(75) NOT NULL DEFAULT 'example@example.com',
  telefono char(11) NOT NULL,
  tipo_contrato enum('fijo','temporal') NOT NULL,
  salario int(7) UNSIGNED NOT NULL,
  estado enum('activo','inactivo') NOT NULL,
  PRIMARY KEY (cedula)
)ENGINE=InnoDB;