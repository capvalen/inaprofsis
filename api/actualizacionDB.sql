/* Importar la DB de:
http://www.strategy.org.pe/articulos/cbdf11_strategy_76382231-UBIGEO-PERU-MYSQL.pdf

*/

CREATE TABLE `inaprofsis`.`pagos` (`id` INT NOT NULL AUTO_INCREMENT , `idMatricula` INT NOT NULL , `registro` DATETIME NULL , `fecha` DATE NOT NULL , `idBanco` INT NOT NULL , `nOperacion` INT NOT NULL , `vbColaborador` INT NOT NULL , `vbBanco` INT NOT NULL , `monto` INT NOT NULL , `idRazon` INT NOT NULL , `observaciones` INT NOT NULL , `idUsuario` INT NOT NULL , `activo` INT NULL DEFAULT '1' , PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `inaprofsis`.`bancos` (`id` INT NOT NULL AUTO_INCREMENT , `entidad` VARCHAR(250) NOT NULL , `nCuenta` VARCHAR(250) NOT NULL , `activo` INT NULL DEFAULT '1' , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `bancos` (`id`, `entidad`, `nCuenta`, `activo`) VALUES (NULL, 'Ninguno', '', '1'), (NULL, 'BCP', '', '1'), (NULL, 'Yape', '', '1'), (NULL, 'Plin', '', '1'), (NULL, 'Interbank', '', '1'), (NULL, 'BBVA', '', '1'), (NULL, 'Caja Huancayo', '', '1'), (NULL, 'Efectivo', '', '1'), (NULL, 'Banco de la nación', '', '1');


ALTER TABLE `pagos` CHANGE `vbColaborador` `vbColaborador` INT(11) NULL DEFAULT '0' COMMENT '0=no, 1=si';
ALTER TABLE `pagos` CHANGE `vbBanco` `vbBanco` INT(11) NULL DEFAULT '0' COMMENT '0=no, 1=si';
ALTER TABLE `pagos` DROP `idRazon`;
ALTER TABLE `pagos` CHANGE `vbColaborador` `vbColaborador` INT(11) NULL DEFAULT '0' COMMENT '0=nada, 1=verificado, 2=rechazado';
ALTER TABLE `pagos` CHANGE `vbBanco` `vbBanco` INT(11) NULL DEFAULT '0' COMMENT '0=nada, 1=verificado, 2=rechazado';

CREATE TABLE `inaprofsis`.`cargos` (`id` INT NOT NULL AUTO_INCREMENT , `descripcion` VARCHAR(100) NOT NULL , `activo` INT NULL DEFAULT '1' , PRIMARY KEY (`id`)) ENGINE = InnoDB;
INSERT INTO `cargos` (`id`, `descripcion`, `activo`) VALUES (NULL, 'Matrícula', '1'), (NULL, 'Certificado', '1'), (NULL, 'Examen extemporáneo', '1'), (NULL, 'Delivery', '1'), (NULL, 'Otros', '1');

ALTER TABLE `pagos` ADD `idCargos` INT NULL DEFAULT '1' AFTER `idMatricula`;
ALTER TABLE `pagos` ADD `pagado` FLOAT NOT NULL DEFAULT '0' AFTER `monto`;

CREATE TABLE `inaprofsis`.`deliverys` (`id` INT NOT NULL AUTO_INCREMENT , `idMatricula` INT NOT NULL , `idCourier` INT NOT NULL , `idDepartamento` INT NOT NULL , `idProvincia` INT NOT NULL , `idDistrito` INT NOT NULL , `direccion` TEXT NOT NULL , `referencia` TEXT NOT NULL , `confirmaDireccion` INT NOT NULL , `impreso` INT NOT NULL COMMENT '0=no, 1=si' , `idCertificadoEstado` INT NOT NULL , `observaciones` TEXT NOT NULL , `costo` FLOAT NOT NULL , `activo` INT NULL DEFAULT '1' , `idUsuario` INT NOT NULL DEFAULT '1' , PRIMARY KEY (`id`)) ENGINE = InnoDB;

UPDATE `ubprovincia` SET `provincia` = 'CAÑETE' WHERE `ubprovincia`.`idProv` = 131;
UPDATE `ubprovincia` SET `provincia` = 'MARAÑON' WHERE `ubprovincia`.`idProv` = 93;
UPDATE `ubprovincia` SET `provincia` = 'FERREÑAFE' WHERE `ubprovincia`.`idProv` = 125;
UPDATE `ubdistrito` SET `distrito` = 'SAN JUAN DE CHACÑA' WHERE `ubdistrito`.`idDist` = 295;
UPDATE `ubdistrito` SET `distrito` = 'SAÑAYCA' WHERE `ubdistrito`.`idDist` = 296;
UPDATE `ubdistrito` SET `distrito` = 'OCOÑA' WHERE `ubdistrito`.`idDist` = 364;
UPDATE `ubdistrito` SET `distrito` = 'UÑON' WHERE `ubdistrito`.`idDist` = 391;
UPDATE `ubdistrito` SET `distrito` = 'NEPEÑA' WHERE `ubdistrito`.`idDist` = 228;
UPDATE `ubdistrito` SET `distrito` = 'QUEQUEÑA' WHERE `ubdistrito`.`idDist` = 344;
UPDATE `ubdistrito` SET `distrito` = 'CHAVIÑA' WHERE `ubdistrito`.`idDist` = 484;
UPDATE `ubdistrito` SET `distrito` = 'OCAÑA' WHERE `ubdistrito`.`idDist` = 491;
UPDATE `ubdistrito` SET `distrito` = 'CORONEL CASTAÑEDA' WHERE `ubdistrito`.`idDist` = 503;
UPDATE `ubdistrito` SET `distrito` = 'HUACAÑA' WHERE `ubdistrito`.`idDist` = 523;
UPDATE `ubdistrito` SET `distrito` = 'LOS BAÑOS DEL INCA' WHERE `ubdistrito`.`idDist` = 558;
UPDATE `ubdistrito` SET `distrito` = 'ENCAÑADA' WHERE `ubdistrito`.`idDist` = 555;
UPDATE `ubdistrito` SET `distrito` = 'CHANCAYBAÑOS' WHERE `ubdistrito`.`idDist` = 671;
UPDATE `ubdistrito` SET `distrito` = 'QUIÑOTA' WHERE `ubdistrito`.`idDist` = 739;
UPDATE `ubdistrito` SET `distrito` = 'KOSÑIPATA' WHERE `ubdistrito`.`idDist` = 773;
UPDATE `ubdistrito` SET `distrito` = 'ÑAHUIMPUQUIO' WHERE `ubdistrito`.`idDist` = 879;
UPDATE `ubdistrito` SET `distrito` = 'PUÑOS' WHERE `ubdistrito`.`idDist` = 927;
UPDATE `ubdistrito` SET `distrito` = 'BAÑOS' WHERE `ubdistrito`.`idDist` = 949;
UPDATE `ubdistrito` SET `distrito` = 'LA TINGUIÑA' WHERE `ubdistrito`.`idDist` = 964;
UPDATE `ubdistrito` SET `distrito` = 'SAÑO' WHERE `ubdistrito`.`idDist` = 1029;
UPDATE `ubdistrito` SET `distrito` = 'LEONOR ORDOÑEZ' WHERE `ubdistrito`.`idDist` = 1067;
UPDATE `ubdistrito` SET `distrito` = 'SAÑA' WHERE `ubdistrito`.`idDist` = 1227;
UPDATE `ubdistrito` SET `distrito` = 'FERREÑAFE' WHERE `ubdistrito`.`idDist` = 1233;
UPDATE `ubdistrito` SET `distrito` = 'CAÑARIS' WHERE `ubdistrito`.`idDist` = 1234;
UPDATE `ubdistrito` SET `distrito` = 'BREÑA' WHERE `ubdistrito`.`idDist` = 1255;
UPDATE `ubdistrito` SET `distrito` = 'SAN VICENTE DE CAÑETE' WHERE `ubdistrito`.`idDist` = 1311;
UPDATE `ubdistrito` SET `distrito` = 'ZUÑIGA' WHERE `ubdistrito`.`idDist` = 1326;
UPDATE `ubdistrito` SET `distrito` = 'HUAÑEC' WHERE `ubdistrito`.`idDist` = 1405;
UPDATE `ubdistrito` SET `distrito` = 'VIÑAC' WHERE `ubdistrito`.`idDist` = 1420;
UPDATE `ubdistrito` SET `distrito` = 'IÑAPARI' WHERE `ubdistrito`.`idDist` = 1479;
UPDATE `ubdistrito` SET `distrito` = 'ICHUÑA' WHERE `ubdistrito`.`idDist` = 1491;
UPDATE `ubdistrito` SET `distrito` = 'PARIÑAS' WHERE `ubdistrito`.`idDist` = 1582;
UPDATE `ubdistrito` SET `distrito` = 'MAÑAZO' WHERE `ubdistrito`.`idDist` = 1602;
UPDATE `ubdistrito` SET `distrito` = 'MUÑANI' WHERE `ubdistrito`.`idDist` = 1616;
UPDATE `ubdistrito` SET `distrito` = 'NUÑOA' WHERE `ubdistrito`.`idDist` = 1669;
UPDATE `ubdistrito` SET `distrito` = 'CUÑUMBUQUI' WHERE `ubdistrito`.`idDist` = 1729;


ALTER TABLE `pagos` CHANGE `observaciones` `observaciones` TEXT NOT NULL;
ALTER TABLE `pagos` CHANGE `registro` `registro` DATETIME NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `pagos` ADD `idAlumno` INT NOT NULL AFTER `idMatricula`;
ALTER TABLE `oficios` ADD `suscribe` VARCHAR(250) NOT NULL AFTER `de`;
