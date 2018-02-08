/*
Navicat MySQL Data Transfer

Source Server         : Sistema Local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : rshbd

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-11-15 12:31:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for nivel
-- ----------------------------
DROP TABLE IF EXISTS `nivel`;
CREATE TABLE `nivel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nivel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of nivel
-- ----------------------------
INSERT INTO `nivel` VALUES ('1', 'Administrador');
INSERT INTO `nivel` VALUES ('2', 'Mantencion');
INSERT INTO `nivel` VALUES ('3', 'Digitacion');
INSERT INTO `nivel` VALUES ('4', 'Consulta');
INSERT INTO `nivel` VALUES ('5', 'Invitado');

-- ----------------------------
-- Table structure for perfil
-- ----------------------------
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Perfil` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of perfil
-- ----------------------------
INSERT INTO `perfil` VALUES ('1', 'Administrador');
INSERT INTO `perfil` VALUES ('2', 'Revisoras');
INSERT INTO `perfil` VALUES ('3', 'Ejecutoras');
INSERT INTO `perfil` VALUES ('4', 'Encuestadoras');
INSERT INTO `perfil` VALUES ('5', 'Digitadoras');
INSERT INTO `perfil` VALUES ('7', 'Consultas');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Rut` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Nivel_Id` int(10) unsigned DEFAULT NULL,
  `Perfil_Id` int(10) unsigned DEFAULT NULL,
  `Fecha_Activacion` date DEFAULT NULL,
  `Estado` int(1) DEFAULT '1',
  `Porsentaje_Id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Nivel_Id_Fk` (`Nivel_Id`),
  KEY `Perfil_Id_Fk` (`Perfil_Id`),
  KEY `Porsentaje_Id_Fk` (`Porsentaje_Id`),
  CONSTRAINT `Nivel_Id_Fk` FOREIGN KEY (`Nivel_Id`) REFERENCES `nivel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Perfil_Id_Fk` FOREIGN KEY (`Perfil_Id`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Porsentaje_Id_Fk` FOREIGN KEY (`Porsentaje_Id`) REFERENCES `porsentaje` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', 'mvera', '25d2114876e73ad95947951a44d6e3f3', '14424961-5', 'Manuel ', 'Vera P.', 'manuel.vera@talcahuano.cl', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('29', 'lgutierrez', '7cbb3252ba6b7e9c422fac5334d22054', '12053220-0', 'Lilian', 'Gutierrez', 'notiene@email.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('30', 'ecabezas', '7cbb3252ba6b7e9c422fac5334d22054', '15613437-6', 'Eva ', 'Cabezas', 'notiene@email.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('31', 'jgutierrez', '7cbb3252ba6b7e9c422fac5334d22054', '12767171-0', 'Jimena ', 'Gutierrez', 'notiene@email.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('32', 'gvalderrama', '7cbb3252ba6b7e9c422fac5334d22054', '8218238-1', 'Gladys ', 'Valderrama', 'notiene@email.com', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('33', 'pbenitez', 'a57ce7b68c5b6aafc835a3462c0f61d6', '12974722-6', 'Paula', 'Benitez', 'notiene@email.com', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('34', 'iarrue', '7cbb3252ba6b7e9c422fac5334d22054', '16765826-1', 'Ivonne', 'Arrue', 'iearrue@tsocial.ucsc.cl', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('35', 'garias', '7cbb3252ba6b7e9c422fac5334d22054', '12026624-1', 'Ginette Gabriela', 'Arias Herrera', 'notiene@email.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('36', 'mlagunas', '7cbb3252ba6b7e9c422fac5334d22054', '17346133-K', 'Maria Paz', 'Lagunas', 'notiene@email.com', '1', '1', '2017-08-28', '2', '1');
INSERT INTO `usuario` VALUES ('37', 'rvalencia', '7cbb3252ba6b7e9c422fac5334d22054', '9184219-K', 'Rosa', 'Valencia', 'notine@email.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('39', 'bcordova', '7cbb3252ba6b7e9c422fac5334d22054', '16326960-0', 'Betzabe Soledad', 'Cordova', 'Henriquez', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('42', 'sfps', '7cbb3252ba6b7e9c422fac5334d22054', '5960560-7', 'Supervisor', 'FPS', 'notiene@email.com', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('43', 'fabarzua', '7cbb3252ba6b7e9c422fac5334d22054', '17332357-3', 'Francisco', 'Abarzua', 'notiene@email.com', '1', '1', '2017-08-28', '2', '1');
INSERT INTO `usuario` VALUES ('44', 'jgomez', '21de1e5b7bf83be5fd0faad10d5322d8', '14058745-1', 'Johana', 'Gomez', 'yubygomez@gmail.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('45', 'gdepaoli', '7cbb3252ba6b7e9c422fac5334d22054', '15612443-5', 'Gladys', 'Depaoli', 'notiene@email.com', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('47', 'sriffo', '7cbb3252ba6b7e9c422fac5334d22054', '11570117-7', 'Susana ', 'Riffo', 'notiene@email.com', '1', '1', '2017-08-28', '2', '1');
INSERT INTO `usuario` VALUES ('48', 'asaldias', '7cbb3252ba6b7e9c422fac5334d22054', '8156509-0', 'Alba', 'Saldias', 'notiene@email.com', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('49', 'nasignada', '7cbb3252ba6b7e9c422fac5334d22054', '1-9', 'No ', 'Asignada', 'notiene@email.com', '1', '1', '2017-08-28', '2', '1');
INSERT INTO `usuario` VALUES ('51', 'ggonzalez', 'b9c3b3d45e1c4cc4acb7804cdb93f9d3', '12730582-K', 'Grecia', 'Gonzalez', 'sedigonz@gmail.com', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('52', 'susr', '7cbb3252ba6b7e9c422fac5334d22054', '1-8', 'Sin', 'Usuario', 'notiene@email.com', '1', '1', '2017-08-28', '2', '1');
INSERT INTO `usuario` VALUES ('53', 'susr2', '7cbb3252ba6b7e9c422fac5334d22054', '1-9', 'Sin', 'Usuario', 'notiene@email.com', '1', '1', '2017-08-28', '2', '1');
INSERT INTO `usuario` VALUES ('54', 'mhenriquez', '7cbb3252ba6b7e9c422fac5334d22054', '14059225-0', 'Maria', 'Henriquez', 'notiene@email.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('55', 'pvera', '7cbb3252ba6b7e9c422fac5334d22054', '17542172-6', 'Pamela ', 'Vera', 'notiene@email.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('56', 'solivares', '7cbb3252ba6b7e9c422fac5334d22054', '9651532-4', 'Sonia', 'Olivares', 'ssuper419@gmail.com', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('57', 'msaldias', '7cbb3252ba6b7e9c422fac5334d22054', '10351185-2', 'Myriam', 'Saldias', 'notiene@email.com', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('58', 'mbustamante', '7cbb3252ba6b7e9c422fac5334d22054', '8487672-0', 'Maria ', 'Bustamante', 'revisorafps@gmail.com', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('59', 'sencuestador', '7cbb3252ba6b7e9c422fac5334d22054', '1-7', 'Sin ', 'Encuestador', 'notiene@email', '1', '1', '2017-08-28', '2', '1');
INSERT INTO `usuario` VALUES ('60', 'amardones', '7cbb3252ba6b7e9c422fac5334d22054', '9174340-K', 'Albertina', 'Mardones', 'albertinaisabel.mardonez@gmail.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('61', 'ksilva', '7cbb3252ba6b7e9c422fac5334d22054', '15928321-6', 'Karla ', 'Silva', 'notiene@email.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('62', 'jquijada', '7cbb3252ba6b7e9c422fac5334d22054', '8916572-5', 'Juana', 'Quijada', 'notiene@email.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('63', 'amaluenda', '7cbb3252ba6b7e9c422fac5334d22054', '12763428-9', 'Alvaro', 'Maluenda', 'notiene@email.cl', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('64', 'nbarra', '7cbb3252ba6b7e9c422fac5334d22054', '16514872-K', 'Nathalie ', 'Barra', 'notiene@fmail.com', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('65', 'mramirez', '7cbb3252ba6b7e9c422fac5334d22054', '17541252-2', 'Melani', 'Ramirez', 'notiene@email.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('66', 'mespinoza', '7cbb3252ba6b7e9c422fac5334d22054', '16039327-0', 'Marcela', 'Espinoza', 'notiene@email.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('67', 'lvaldebenito', '7cbb3252ba6b7e9c422fac5334d22054', '17224322-3', 'Lisette', 'Valdebenito ', 'notiene@email.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('68', 'ncentral', '7cbb3252ba6b7e9c422fac5334d22054', '11111111-1', 'Nivel ', 'Central', 'notiene@email.com', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('69', 'vromanov', '7cbb3252ba6b7e9c422fac5334d22054', '13957328-5', 'Victor', 'Romanov', 'notiene@email.com', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('70', 'cMuñoz', '7cbb3252ba6b7e9c422fac5334d22054', '17347030-4', 'Carolina', 'Muñoz', 'sin@email.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('71', 'ppradenas', '7cbb3252ba6b7e9c422fac5334d22054', '13125158-0', 'Paula', 'Pradenas', 'notiene@email.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('72', 'bgarrido', '7cbb3252ba6b7e9c422fac5334d22054', '18280385-5', 'Bastian', 'Garrido', 'bastiangarrido@udec.cl', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('73', 'rsoto', '7cbb3252ba6b7e9c422fac5334d22054', '15943991-7', 'Richard ', 'Soto Varela', 'richard.soto@talcahuano.cl', '1', '1', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('74', 'cadministrativo', '7cbb3252ba6b7e9c422fac5334d22054', '11111111-1', 'Control', 'Administracion', 'notiene@gmail.com', '1', '1', '2017-08-28', '2', '1');
INSERT INTO `usuario` VALUES ('75', 'mpincheira', '7cbb3252ba6b7e9c422fac5334d22054', '17349741-5', 'Maria de los Angeles', 'Pincheira Sepulveda', 'mdpincheira@gmail.com', '3', '3', '2017-08-28', '1', '1');
INSERT INTO `usuario` VALUES ('76', 'prueba', '25d2114876e73ad95947951a44d6e3f3', '1-9', 'Usuario', 'Prueba', 'notiene@email.com', '3', '3', '2017-08-28', '1', '1');
