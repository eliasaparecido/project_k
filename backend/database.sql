CREATE DATABASE `kabum`
    CHARACTER SET 'utf8'
    COLLATE 'utf8_general_ci';

USE `kabum`;

/* Structure for the `clients` table : */

CREATE TABLE `clients` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) COLLATE latin1_swedish_ci DEFAULT NULL,
  `datanascimento` DATE DEFAULT NULL,
  `cpf` VARCHAR(11) COLLATE latin1_swedish_ci DEFAULT NULL,
  `rg` VARCHAR(15) COLLATE latin1_swedish_ci DEFAULT NULL,
  `telefone` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE KEY `cpf` USING BTREE (`cpf`)
) ENGINE=InnoDB
AUTO_INCREMENT=6 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `client_address` table : */

CREATE TABLE `client_address` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `client_id` INTEGER(11) DEFAULT NULL,
  `endereco` VARCHAR(256) COLLATE latin1_swedish_ci DEFAULT NULL,
  `bairro` VARCHAR(80) COLLATE latin1_swedish_ci DEFAULT NULL,
  `cidade` VARCHAR(80) COLLATE latin1_swedish_ci DEFAULT NULL,
  `estado` VARCHAR(2) COLLATE latin1_swedish_ci DEFAULT NULL,
  `tipo` VARCHAR(80) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  KEY `client_adress_fk1` USING BTREE (`client_id`),
  CONSTRAINT `client_adress_fk1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=9 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `users` table : */

CREATE TABLE `users` (
  `id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) COLLATE latin1_swedish_ci NOT NULL,
  `email` VARCHAR(250) COLLATE latin1_swedish_ci NOT NULL,
  `password` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE KEY `email` USING BTREE (`email`)
) ENGINE=InnoDB
AUTO_INCREMENT=52 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;