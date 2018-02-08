/*
Navicat MySQL Data Transfer

Source Server         : Sistema Local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : alvelador

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-11-17 17:23:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for comuna
-- ----------------------------
DROP TABLE IF EXISTS `comuna`;
CREATE TABLE `comuna` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID unico de la comuna',
  `Region_Id` int(11) unsigned NOT NULL COMMENT 'ID de la provincia asociada',
  `Comuna` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Nombre descriptivo de la comuna',
  PRIMARY KEY (`id`,`Region_Id`),
  KEY `Region_Id_Fk` (`Region_Id`),
  KEY `id` (`id`),
  CONSTRAINT `Region_Id_Fk` FOREIGN KEY (`Region_Id`) REFERENCES `region` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=347 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Lista de comunas por provincias';

-- ----------------------------
-- Records of comuna
-- ----------------------------
INSERT INTO `comuna` VALUES ('1', '1', 'Arica');
INSERT INTO `comuna` VALUES ('2', '1', 'Camarones');
INSERT INTO `comuna` VALUES ('3', '1', 'Putre');
INSERT INTO `comuna` VALUES ('4', '1', 'General Lagos');
INSERT INTO `comuna` VALUES ('5', '2', 'Iquique');
INSERT INTO `comuna` VALUES ('6', '2', 'Alto Hospicio');
INSERT INTO `comuna` VALUES ('7', '2', 'Pozo Almonte');
INSERT INTO `comuna` VALUES ('8', '2', 'Camiña');
INSERT INTO `comuna` VALUES ('9', '2', 'Colchane');
INSERT INTO `comuna` VALUES ('10', '2', 'Huara');
INSERT INTO `comuna` VALUES ('11', '2', 'Pica');
INSERT INTO `comuna` VALUES ('12', '3', 'Antofagasta');
INSERT INTO `comuna` VALUES ('13', '3', 'Mejillones');
INSERT INTO `comuna` VALUES ('14', '3', 'Sierra Gorda');
INSERT INTO `comuna` VALUES ('15', '3', 'Taltal');
INSERT INTO `comuna` VALUES ('16', '3', 'Calama');
INSERT INTO `comuna` VALUES ('17', '3', 'Ollagüe');
INSERT INTO `comuna` VALUES ('18', '3', 'San Pedro De Atacama');
INSERT INTO `comuna` VALUES ('19', '3', 'Tocopilla');
INSERT INTO `comuna` VALUES ('20', '3', 'María Elena');
INSERT INTO `comuna` VALUES ('21', '4', 'Copiapó');
INSERT INTO `comuna` VALUES ('22', '4', 'Caldera');
INSERT INTO `comuna` VALUES ('23', '4', 'Tierra Amarilla');
INSERT INTO `comuna` VALUES ('24', '4', 'Chañaral');
INSERT INTO `comuna` VALUES ('25', '4', 'Diego De Almagro');
INSERT INTO `comuna` VALUES ('26', '4', 'Vallenar');
INSERT INTO `comuna` VALUES ('27', '4', 'Alto Del Carmen');
INSERT INTO `comuna` VALUES ('28', '4', 'Freirina');
INSERT INTO `comuna` VALUES ('29', '4', 'Huasco');
INSERT INTO `comuna` VALUES ('30', '5', 'La Serena');
INSERT INTO `comuna` VALUES ('31', '5', 'Coquimbo');
INSERT INTO `comuna` VALUES ('32', '5', 'Andacollo');
INSERT INTO `comuna` VALUES ('33', '5', 'La Higuera');
INSERT INTO `comuna` VALUES ('34', '5', 'Paiguano');
INSERT INTO `comuna` VALUES ('35', '5', 'Vicuña');
INSERT INTO `comuna` VALUES ('36', '5', 'Illapel');
INSERT INTO `comuna` VALUES ('37', '5', 'Canela');
INSERT INTO `comuna` VALUES ('38', '5', 'Los Vilos');
INSERT INTO `comuna` VALUES ('39', '5', 'Salamanca');
INSERT INTO `comuna` VALUES ('40', '5', 'Ovalle');
INSERT INTO `comuna` VALUES ('41', '5', 'Combarbalá');
INSERT INTO `comuna` VALUES ('42', '5', 'Monte Patria');
INSERT INTO `comuna` VALUES ('43', '5', 'Punitaqui');
INSERT INTO `comuna` VALUES ('44', '5', 'Río Hurtado');
INSERT INTO `comuna` VALUES ('45', '6', 'Valparaíso');
INSERT INTO `comuna` VALUES ('46', '6', 'Casablanca');
INSERT INTO `comuna` VALUES ('47', '6', 'Concón');
INSERT INTO `comuna` VALUES ('48', '6', 'Juan Fernández');
INSERT INTO `comuna` VALUES ('49', '6', 'Puchuncaví');
INSERT INTO `comuna` VALUES ('50', '6', 'Quintero');
INSERT INTO `comuna` VALUES ('51', '6', 'Viña Del Mar');
INSERT INTO `comuna` VALUES ('52', '6', 'Isla De Pascua');
INSERT INTO `comuna` VALUES ('53', '6', 'Los Andes');
INSERT INTO `comuna` VALUES ('54', '6', 'Calle Larga');
INSERT INTO `comuna` VALUES ('55', '6', 'Rinconada');
INSERT INTO `comuna` VALUES ('56', '6', 'San Esteban');
INSERT INTO `comuna` VALUES ('57', '6', 'La Ligua');
INSERT INTO `comuna` VALUES ('58', '6', 'Cabildo');
INSERT INTO `comuna` VALUES ('59', '6', 'Papudo');
INSERT INTO `comuna` VALUES ('60', '6', 'Petorca');
INSERT INTO `comuna` VALUES ('61', '6', 'Zapallar');
INSERT INTO `comuna` VALUES ('62', '6', 'Quillota');
INSERT INTO `comuna` VALUES ('63', '6', 'Calera');
INSERT INTO `comuna` VALUES ('64', '6', 'Hijuelas');
INSERT INTO `comuna` VALUES ('65', '6', 'La Cruz');
INSERT INTO `comuna` VALUES ('66', '6', 'Nogales');
INSERT INTO `comuna` VALUES ('67', '6', 'San Antonio');
INSERT INTO `comuna` VALUES ('68', '6', 'Algarrobo');
INSERT INTO `comuna` VALUES ('69', '6', 'Cartagena');
INSERT INTO `comuna` VALUES ('70', '6', 'El Quisco');
INSERT INTO `comuna` VALUES ('71', '6', 'El Tabo');
INSERT INTO `comuna` VALUES ('72', '6', 'Santo Domingo');
INSERT INTO `comuna` VALUES ('73', '6', 'San Felipe');
INSERT INTO `comuna` VALUES ('74', '6', 'Catemu');
INSERT INTO `comuna` VALUES ('75', '6', 'Llaillay');
INSERT INTO `comuna` VALUES ('76', '6', 'Panquehue');
INSERT INTO `comuna` VALUES ('77', '6', 'Putaendo');
INSERT INTO `comuna` VALUES ('78', '6', 'Santa María');
INSERT INTO `comuna` VALUES ('79', '6', 'Limache');
INSERT INTO `comuna` VALUES ('80', '6', 'Quilpué');
INSERT INTO `comuna` VALUES ('81', '6', 'Villa Alemana');
INSERT INTO `comuna` VALUES ('82', '6', 'Olmué');
INSERT INTO `comuna` VALUES ('83', '7', 'Rancagua');
INSERT INTO `comuna` VALUES ('84', '7', 'Codegua');
INSERT INTO `comuna` VALUES ('85', '7', 'Coinco');
INSERT INTO `comuna` VALUES ('86', '7', 'Coltauco');
INSERT INTO `comuna` VALUES ('87', '7', 'Doñihue');
INSERT INTO `comuna` VALUES ('88', '7', 'Graneros');
INSERT INTO `comuna` VALUES ('89', '7', 'Las Cabras');
INSERT INTO `comuna` VALUES ('90', '7', 'Machalí');
INSERT INTO `comuna` VALUES ('91', '7', 'Malloa');
INSERT INTO `comuna` VALUES ('92', '7', 'Mostazal');
INSERT INTO `comuna` VALUES ('93', '7', 'Olivar');
INSERT INTO `comuna` VALUES ('94', '7', 'Peumo');
INSERT INTO `comuna` VALUES ('95', '7', 'Pichidegua');
INSERT INTO `comuna` VALUES ('96', '7', 'Quinta De Tilcoco');
INSERT INTO `comuna` VALUES ('97', '7', 'Rengo');
INSERT INTO `comuna` VALUES ('98', '7', 'Requínoa');
INSERT INTO `comuna` VALUES ('99', '7', 'San Vicente');
INSERT INTO `comuna` VALUES ('100', '7', 'Pichilemu');
INSERT INTO `comuna` VALUES ('101', '7', 'La Estrella');
INSERT INTO `comuna` VALUES ('102', '7', 'Litueche');
INSERT INTO `comuna` VALUES ('103', '7', 'Marchihue');
INSERT INTO `comuna` VALUES ('104', '7', 'Navidad');
INSERT INTO `comuna` VALUES ('105', '7', 'Paredones');
INSERT INTO `comuna` VALUES ('106', '7', 'San Fernando');
INSERT INTO `comuna` VALUES ('107', '7', 'Chépica');
INSERT INTO `comuna` VALUES ('108', '7', 'Chimbarongo');
INSERT INTO `comuna` VALUES ('109', '7', 'Lolol');
INSERT INTO `comuna` VALUES ('110', '7', 'Nancagua');
INSERT INTO `comuna` VALUES ('111', '7', 'Palmilla');
INSERT INTO `comuna` VALUES ('112', '7', 'Peralillo');
INSERT INTO `comuna` VALUES ('113', '7', 'Placilla');
INSERT INTO `comuna` VALUES ('114', '7', 'Pumanque');
INSERT INTO `comuna` VALUES ('115', '7', 'Santa Cruz');
INSERT INTO `comuna` VALUES ('116', '8', 'Talca');
INSERT INTO `comuna` VALUES ('117', '8', 'Constitución');
INSERT INTO `comuna` VALUES ('118', '8', 'Curepto');
INSERT INTO `comuna` VALUES ('119', '8', 'Empedrado');
INSERT INTO `comuna` VALUES ('120', '8', 'Maule');
INSERT INTO `comuna` VALUES ('121', '8', 'Pelarco');
INSERT INTO `comuna` VALUES ('122', '8', 'Pencahue');
INSERT INTO `comuna` VALUES ('123', '8', 'Río Claro');
INSERT INTO `comuna` VALUES ('124', '8', 'San Clemente');
INSERT INTO `comuna` VALUES ('125', '8', 'San Rafael');
INSERT INTO `comuna` VALUES ('126', '8', 'Cauquenes');
INSERT INTO `comuna` VALUES ('127', '8', 'Chanco');
INSERT INTO `comuna` VALUES ('128', '8', 'Pelluhue');
INSERT INTO `comuna` VALUES ('129', '8', 'Curicó');
INSERT INTO `comuna` VALUES ('130', '8', 'Hualañé');
INSERT INTO `comuna` VALUES ('131', '8', 'Licantén');
INSERT INTO `comuna` VALUES ('132', '8', 'Molina');
INSERT INTO `comuna` VALUES ('133', '8', 'Rauco');
INSERT INTO `comuna` VALUES ('134', '8', 'Romeral');
INSERT INTO `comuna` VALUES ('135', '8', 'Sagrada Familia');
INSERT INTO `comuna` VALUES ('136', '8', 'Teno');
INSERT INTO `comuna` VALUES ('137', '8', 'Vichuquén');
INSERT INTO `comuna` VALUES ('138', '8', 'Linares');
INSERT INTO `comuna` VALUES ('139', '8', 'Colbún');
INSERT INTO `comuna` VALUES ('140', '8', 'Longaví');
INSERT INTO `comuna` VALUES ('141', '8', 'Parral');
INSERT INTO `comuna` VALUES ('142', '8', 'Retiro');
INSERT INTO `comuna` VALUES ('143', '8', 'San Javier');
INSERT INTO `comuna` VALUES ('144', '8', 'Villa Alegre');
INSERT INTO `comuna` VALUES ('145', '8', 'Yerbas Buenas');
INSERT INTO `comuna` VALUES ('146', '9', 'Concepción');
INSERT INTO `comuna` VALUES ('147', '9', 'Coronel');
INSERT INTO `comuna` VALUES ('148', '9', 'Chiguayante');
INSERT INTO `comuna` VALUES ('149', '9', 'Florida');
INSERT INTO `comuna` VALUES ('150', '9', 'Hualqui');
INSERT INTO `comuna` VALUES ('151', '9', 'Lota');
INSERT INTO `comuna` VALUES ('152', '9', 'Penco');
INSERT INTO `comuna` VALUES ('153', '9', 'San Pedro De La Paz');
INSERT INTO `comuna` VALUES ('154', '9', 'Santa Juana');
INSERT INTO `comuna` VALUES ('155', '9', 'Talcahuano');
INSERT INTO `comuna` VALUES ('156', '9', 'Tomé');
INSERT INTO `comuna` VALUES ('157', '9', 'Hualpén');
INSERT INTO `comuna` VALUES ('158', '9', 'Lebu');
INSERT INTO `comuna` VALUES ('159', '9', 'Arauco');
INSERT INTO `comuna` VALUES ('160', '9', 'Cañete');
INSERT INTO `comuna` VALUES ('161', '9', 'Contulmo');
INSERT INTO `comuna` VALUES ('162', '9', 'Curanilahue');
INSERT INTO `comuna` VALUES ('163', '9', 'Los Alamos');
INSERT INTO `comuna` VALUES ('164', '9', 'Tirúa');
INSERT INTO `comuna` VALUES ('165', '9', 'Los Angeles');
INSERT INTO `comuna` VALUES ('166', '9', 'Antuco');
INSERT INTO `comuna` VALUES ('167', '9', 'Cabrero');
INSERT INTO `comuna` VALUES ('168', '9', 'Laja');
INSERT INTO `comuna` VALUES ('169', '9', 'Mulchén');
INSERT INTO `comuna` VALUES ('170', '9', 'Nacimiento');
INSERT INTO `comuna` VALUES ('171', '9', 'Negrete');
INSERT INTO `comuna` VALUES ('172', '9', 'Quilaco');
INSERT INTO `comuna` VALUES ('173', '9', 'Quilleco');
INSERT INTO `comuna` VALUES ('174', '9', 'San Rosendo');
INSERT INTO `comuna` VALUES ('175', '9', 'Santa Bárbara');
INSERT INTO `comuna` VALUES ('176', '9', 'Tucapel');
INSERT INTO `comuna` VALUES ('177', '9', 'Yumbel');
INSERT INTO `comuna` VALUES ('178', '9', 'Alto Biobío');
INSERT INTO `comuna` VALUES ('179', '9', 'Chillán');
INSERT INTO `comuna` VALUES ('180', '9', 'Bulnes');
INSERT INTO `comuna` VALUES ('181', '9', 'Cobquecura');
INSERT INTO `comuna` VALUES ('182', '9', 'Coelemu');
INSERT INTO `comuna` VALUES ('183', '9', 'Coihueco');
INSERT INTO `comuna` VALUES ('184', '9', 'Chillán Viejo');
INSERT INTO `comuna` VALUES ('185', '9', 'El Carmen');
INSERT INTO `comuna` VALUES ('186', '9', 'Ninhue');
INSERT INTO `comuna` VALUES ('187', '9', 'Ñiquén');
INSERT INTO `comuna` VALUES ('188', '9', 'Pemuco');
INSERT INTO `comuna` VALUES ('189', '9', 'Pinto');
INSERT INTO `comuna` VALUES ('190', '9', 'Portezuelo');
INSERT INTO `comuna` VALUES ('191', '9', 'Quillón');
INSERT INTO `comuna` VALUES ('192', '9', 'Quirihue');
INSERT INTO `comuna` VALUES ('193', '9', 'Ránquil');
INSERT INTO `comuna` VALUES ('194', '9', 'San Carlos');
INSERT INTO `comuna` VALUES ('195', '9', 'San Fabián');
INSERT INTO `comuna` VALUES ('196', '9', 'San Ignacio');
INSERT INTO `comuna` VALUES ('197', '9', 'San Nicolás');
INSERT INTO `comuna` VALUES ('198', '9', 'Treguaco');
INSERT INTO `comuna` VALUES ('199', '9', 'Yungay');
INSERT INTO `comuna` VALUES ('200', '10', 'Temuco');
INSERT INTO `comuna` VALUES ('201', '10', 'Carahue');
INSERT INTO `comuna` VALUES ('202', '10', 'Cunco');
INSERT INTO `comuna` VALUES ('203', '10', 'Curarrehue');
INSERT INTO `comuna` VALUES ('204', '10', 'Freire');
INSERT INTO `comuna` VALUES ('205', '10', 'Galvarino');
INSERT INTO `comuna` VALUES ('206', '10', 'Gorbea');
INSERT INTO `comuna` VALUES ('207', '10', 'Lautaro');
INSERT INTO `comuna` VALUES ('208', '10', 'Loncoche');
INSERT INTO `comuna` VALUES ('209', '10', 'Melipeuco');
INSERT INTO `comuna` VALUES ('210', '10', 'Nueva Imperial');
INSERT INTO `comuna` VALUES ('211', '10', 'Padre Las Casas');
INSERT INTO `comuna` VALUES ('212', '10', 'Perquenco');
INSERT INTO `comuna` VALUES ('213', '10', 'Pitrufquén');
INSERT INTO `comuna` VALUES ('214', '10', 'Pucón');
INSERT INTO `comuna` VALUES ('215', '10', 'Saavedra');
INSERT INTO `comuna` VALUES ('216', '10', 'Teodoro Schmidt');
INSERT INTO `comuna` VALUES ('217', '10', 'Toltén');
INSERT INTO `comuna` VALUES ('218', '10', 'Vilcún');
INSERT INTO `comuna` VALUES ('219', '10', 'Villarrica');
INSERT INTO `comuna` VALUES ('220', '10', 'Cholchol');
INSERT INTO `comuna` VALUES ('221', '10', 'Angol');
INSERT INTO `comuna` VALUES ('222', '10', 'Collipulli');
INSERT INTO `comuna` VALUES ('223', '10', 'Curacautín');
INSERT INTO `comuna` VALUES ('224', '10', 'Ercilla');
INSERT INTO `comuna` VALUES ('225', '10', 'Lonquimay');
INSERT INTO `comuna` VALUES ('226', '10', 'Los Sauces');
INSERT INTO `comuna` VALUES ('227', '10', 'Lumaco');
INSERT INTO `comuna` VALUES ('228', '10', 'Purén');
INSERT INTO `comuna` VALUES ('229', '10', 'Renaico');
INSERT INTO `comuna` VALUES ('230', '10', 'Traiguén');
INSERT INTO `comuna` VALUES ('231', '10', 'Victoria');
INSERT INTO `comuna` VALUES ('232', '11', 'Valdivia');
INSERT INTO `comuna` VALUES ('233', '11', 'Corral');
INSERT INTO `comuna` VALUES ('234', '11', 'Lanco');
INSERT INTO `comuna` VALUES ('235', '11', 'Los Lagos');
INSERT INTO `comuna` VALUES ('236', '11', 'Máfil');
INSERT INTO `comuna` VALUES ('237', '11', 'Mariquina');
INSERT INTO `comuna` VALUES ('238', '11', 'Paillaco');
INSERT INTO `comuna` VALUES ('239', '11', 'Panguipulli');
INSERT INTO `comuna` VALUES ('240', '11', 'La Unión');
INSERT INTO `comuna` VALUES ('241', '11', 'Futrono');
INSERT INTO `comuna` VALUES ('242', '11', 'Lago Ranco');
INSERT INTO `comuna` VALUES ('243', '11', 'Río Bueno');
INSERT INTO `comuna` VALUES ('244', '12', 'Puerto Montt');
INSERT INTO `comuna` VALUES ('245', '12', 'Calbuco');
INSERT INTO `comuna` VALUES ('246', '12', 'Cochamó');
INSERT INTO `comuna` VALUES ('247', '12', 'Fresia');
INSERT INTO `comuna` VALUES ('248', '12', 'Frutillar');
INSERT INTO `comuna` VALUES ('249', '12', 'Los Muermos');
INSERT INTO `comuna` VALUES ('250', '12', 'Llanquihue');
INSERT INTO `comuna` VALUES ('251', '12', 'Maullín');
INSERT INTO `comuna` VALUES ('252', '12', 'Puerto Varas');
INSERT INTO `comuna` VALUES ('253', '12', 'Castro');
INSERT INTO `comuna` VALUES ('254', '12', 'Ancud');
INSERT INTO `comuna` VALUES ('255', '12', 'Chonchi');
INSERT INTO `comuna` VALUES ('256', '12', 'Curaco De Vélez');
INSERT INTO `comuna` VALUES ('257', '12', 'Dalcahue');
INSERT INTO `comuna` VALUES ('258', '12', 'Puqueldón');
INSERT INTO `comuna` VALUES ('259', '12', 'Queilén');
INSERT INTO `comuna` VALUES ('260', '12', 'Quellón');
INSERT INTO `comuna` VALUES ('261', '12', 'Quemchi');
INSERT INTO `comuna` VALUES ('262', '12', 'Quinchao');
INSERT INTO `comuna` VALUES ('263', '12', 'Osorno');
INSERT INTO `comuna` VALUES ('264', '12', 'Puerto Octay');
INSERT INTO `comuna` VALUES ('265', '12', 'Purranque');
INSERT INTO `comuna` VALUES ('266', '12', 'Puyehue');
INSERT INTO `comuna` VALUES ('267', '12', 'Río Negro');
INSERT INTO `comuna` VALUES ('268', '12', 'San Juan De La Costa');
INSERT INTO `comuna` VALUES ('269', '12', 'San Pablo');
INSERT INTO `comuna` VALUES ('270', '12', 'Chaitén');
INSERT INTO `comuna` VALUES ('271', '12', 'Futaleufú');
INSERT INTO `comuna` VALUES ('272', '12', 'Hualaihué');
INSERT INTO `comuna` VALUES ('273', '12', 'Palena');
INSERT INTO `comuna` VALUES ('274', '13', 'Coihaique');
INSERT INTO `comuna` VALUES ('275', '13', 'Lago Verde');
INSERT INTO `comuna` VALUES ('276', '13', 'Aisén');
INSERT INTO `comuna` VALUES ('277', '13', 'Cisnes');
INSERT INTO `comuna` VALUES ('278', '13', 'Guaitecas');
INSERT INTO `comuna` VALUES ('279', '13', 'Cochrane');
INSERT INTO `comuna` VALUES ('280', '13', 'O\'Higgins');
INSERT INTO `comuna` VALUES ('281', '13', 'Tortel');
INSERT INTO `comuna` VALUES ('282', '13', 'Chile Chico');
INSERT INTO `comuna` VALUES ('283', '13', 'Río Ibáñez');
INSERT INTO `comuna` VALUES ('284', '14', 'Punta Arenas');
INSERT INTO `comuna` VALUES ('285', '14', 'Laguna Blanca');
INSERT INTO `comuna` VALUES ('286', '14', 'Río Verde');
INSERT INTO `comuna` VALUES ('287', '14', 'San Gregorio');
INSERT INTO `comuna` VALUES ('288', '14', 'Cabo De Hornos');
INSERT INTO `comuna` VALUES ('289', '14', 'Antártica');
INSERT INTO `comuna` VALUES ('290', '14', 'Porvenir');
INSERT INTO `comuna` VALUES ('291', '14', 'Primavera');
INSERT INTO `comuna` VALUES ('292', '14', 'Timaukel');
INSERT INTO `comuna` VALUES ('293', '14', 'Natales');
INSERT INTO `comuna` VALUES ('294', '14', 'Torres Del Paine');
INSERT INTO `comuna` VALUES ('295', '15', 'Santiago');
INSERT INTO `comuna` VALUES ('296', '15', 'Cerrillos');
INSERT INTO `comuna` VALUES ('297', '15', 'Cerro Navia');
INSERT INTO `comuna` VALUES ('298', '15', 'Conchalí');
INSERT INTO `comuna` VALUES ('299', '15', 'El Bosque');
INSERT INTO `comuna` VALUES ('300', '15', 'Estación Central');
INSERT INTO `comuna` VALUES ('301', '15', 'Huechuraba');
INSERT INTO `comuna` VALUES ('302', '15', 'Independencia');
INSERT INTO `comuna` VALUES ('303', '15', 'La Cisterna');
INSERT INTO `comuna` VALUES ('304', '15', 'La Florida');
INSERT INTO `comuna` VALUES ('305', '15', 'La Granja');
INSERT INTO `comuna` VALUES ('306', '15', 'La Pintana');
INSERT INTO `comuna` VALUES ('307', '15', 'La Reina');
INSERT INTO `comuna` VALUES ('308', '15', 'Las Condes');
INSERT INTO `comuna` VALUES ('309', '15', 'Lo Barnechea');
INSERT INTO `comuna` VALUES ('310', '15', 'Lo Espejo');
INSERT INTO `comuna` VALUES ('311', '15', 'Lo Prado');
INSERT INTO `comuna` VALUES ('312', '15', 'Macul');
INSERT INTO `comuna` VALUES ('313', '15', 'Maipú');
INSERT INTO `comuna` VALUES ('314', '15', 'Ñuñoa');
INSERT INTO `comuna` VALUES ('315', '15', 'Pedro Aguirre Cerda');
INSERT INTO `comuna` VALUES ('316', '15', 'Peñalolén');
INSERT INTO `comuna` VALUES ('317', '15', 'Providencia');
INSERT INTO `comuna` VALUES ('318', '15', 'Pudahuel');
INSERT INTO `comuna` VALUES ('319', '15', 'Quilicura');
INSERT INTO `comuna` VALUES ('320', '15', 'Quinta Normal');
INSERT INTO `comuna` VALUES ('321', '15', 'Recoleta');
INSERT INTO `comuna` VALUES ('322', '15', 'Renca');
INSERT INTO `comuna` VALUES ('323', '15', 'San Joaquín');
INSERT INTO `comuna` VALUES ('324', '15', 'San Miguel');
INSERT INTO `comuna` VALUES ('325', '15', 'San Ramón');
INSERT INTO `comuna` VALUES ('326', '15', 'Vitacura');
INSERT INTO `comuna` VALUES ('327', '15', 'Puente Alto');
INSERT INTO `comuna` VALUES ('328', '15', 'Pirque');
INSERT INTO `comuna` VALUES ('329', '15', 'San José De Maipo');
INSERT INTO `comuna` VALUES ('330', '15', 'Colina');
INSERT INTO `comuna` VALUES ('331', '15', 'Lampa');
INSERT INTO `comuna` VALUES ('332', '15', 'Tiltil');
INSERT INTO `comuna` VALUES ('333', '15', 'San Bernardo');
INSERT INTO `comuna` VALUES ('334', '15', 'Buin');
INSERT INTO `comuna` VALUES ('335', '15', 'Calera De Tango');
INSERT INTO `comuna` VALUES ('336', '15', 'Paine');
INSERT INTO `comuna` VALUES ('337', '15', 'Melipilla');
INSERT INTO `comuna` VALUES ('338', '15', 'Alhué');
INSERT INTO `comuna` VALUES ('339', '15', 'Curacaví');
INSERT INTO `comuna` VALUES ('340', '15', 'María Pinto');
INSERT INTO `comuna` VALUES ('341', '15', 'San Pedro');
INSERT INTO `comuna` VALUES ('342', '15', 'Talagante');
INSERT INTO `comuna` VALUES ('343', '15', 'El Monte');
INSERT INTO `comuna` VALUES ('344', '15', 'Isla De Maipo');
INSERT INTO `comuna` VALUES ('345', '15', 'Padre Hurtado');
INSERT INTO `comuna` VALUES ('346', '15', 'Peñaflor');

-- ----------------------------
-- Table structure for motel
-- ----------------------------
DROP TABLE IF EXISTS `motel`;
CREATE TABLE `motel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Url` varchar(255) DEFAULT NULL,
  `Telefono` varchar(30) DEFAULT NULL,
  `Comuna_Id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Motel_Comuna_Id_fk` (`Comuna_Id`),
  CONSTRAINT `Motel_Comuna_Id_fk` FOREIGN KEY (`Comuna_Id`) REFERENCES `comuna` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of motel
-- ----------------------------
INSERT INTO `motel` VALUES ('1', 'Monte Verde', 'Lincoyan 1246', 'monteverde@gmail.com', 'Monte_Verde', '+412951980', '9');
INSERT INTO `motel` VALUES ('2', 'Alicante ', 'José Mercedes García  200', '', 'Alicante ', '+412382332', '9');
INSERT INTO `motel` VALUES ('3', 'Arcoiris ', '', null, 'Arcoiris', null, '9');
INSERT INTO `motel` VALUES ('4', 'Artis    ', '', '', 'Artis', '', '9');
INSERT INTO `motel` VALUES ('5', 'Caracol   ', 'Camino a Bulnes km 4', '', 'Caracol', '+412310259', '9');
INSERT INTO `motel` VALUES ('6', 'Cruz     ', '', '', 'Cruz', '', '9');
INSERT INTO `motel` VALUES ('7', 'El Conquistador ', '', '', 'El Conquistador', null, '9');
INSERT INTO `motel` VALUES ('8', 'El Marqués de Sade II ', '', null, 'Marquez_I', null, '9');
INSERT INTO `motel` VALUES ('9', 'El Parque ', '', '', 'El Parque', '', '9');
INSERT INTO `motel` VALUES ('10', 'El Prado ', '', null, 'El_Prado', null, '9');
INSERT INTO `motel` VALUES ('11', 'Fish ', '', '', 'Fish', null, '9');
INSERT INTO `motel` VALUES ('12', 'Iguazu ', '', '', 'Iguazu', null, '9');
INSERT INTO `motel` VALUES ('13', 'La Cascada ', '', '', 'La_Cascada', '', '9');
INSERT INTO `motel` VALUES ('14', 'Las Torres ', '', null, 'Las_Torres', null, '9');
INSERT INTO `motel` VALUES ('15', 'Liguria ', '', '', 'Liguria', '', '9');
INSERT INTO `motel` VALUES ('16', 'Manquimavida ', '', '', 'Manquimavida', null, '9');
INSERT INTO `motel` VALUES ('17', 'Marqués De Sade I ', '', '', 'Marquez_II', null, '9');
INSERT INTO `motel` VALUES ('18', 'Nevada ', null, null, 'Nevada', null, '9');
INSERT INTO `motel` VALUES ('19', 'Paradiso ', '', '', 'Paraiso', '', '9');
INSERT INTO `motel` VALUES ('20', 'Venezia ', '', '', 'Venezia', '', '9');

-- ----------------------------
-- Table structure for region
-- ----------------------------
DROP TABLE IF EXISTS `region`;
CREATE TABLE `region` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID unico',
  `Region` varchar(60) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Nombre extenso',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Lista de regiones de Chile';

-- ----------------------------
-- Records of region
-- ----------------------------
INSERT INTO `region` VALUES ('1', 'Arica Y Parinacota');
INSERT INTO `region` VALUES ('2', 'Tarapacá');
INSERT INTO `region` VALUES ('3', 'Antofagasta');
INSERT INTO `region` VALUES ('4', 'Atacama ');
INSERT INTO `region` VALUES ('5', 'Coquimbo ');
INSERT INTO `region` VALUES ('6', 'Valparaíso ');
INSERT INTO `region` VALUES ('7', 'Del Libertador Gral. Bernardo O\'Higgins ');
INSERT INTO `region` VALUES ('8', 'Del Maule');
INSERT INTO `region` VALUES ('9', 'Del Biobío ');
INSERT INTO `region` VALUES ('10', 'De La Araucanía');
INSERT INTO `region` VALUES ('11', 'De Los Ríos');
INSERT INTO `region` VALUES ('12', 'De Los Lagos');
INSERT INTO `region` VALUES ('13', 'Aisén Del Gral. Carlos Ibañez Del Campo ');
INSERT INTO `region` VALUES ('14', 'Magallanes Y De La Antártica Chilena');
INSERT INTO `region` VALUES ('15', 'Metropolitana De Santiago');

-- ----------------------------
-- Table structure for servicios
-- ----------------------------
DROP TABLE IF EXISTS `servicios`;
CREATE TABLE `servicios` (
  `di` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Servicio` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`di`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- ----------------------------
-- Records of servicios
-- ----------------------------
INSERT INTO `servicios` VALUES ('1', 'Tv Cable');
INSERT INTO `servicios` VALUES ('2', 'Estacionamiento');
INSERT INTO `servicios` VALUES ('3', 'Climatización');
INSERT INTO `servicios` VALUES ('4', 'Serv. a la habitación');
INSERT INTO `servicios` VALUES ('5', 'Television');
INSERT INTO `servicios` VALUES ('6', 'Wi-Fi');
INSERT INTO `servicios` VALUES ('7', 'Jacuzzi');
INSERT INTO `servicios` VALUES ('8', 'Películas XXX');
INSERT INTO `servicios` VALUES ('9', 'Silla del Amor');
INSERT INTO `servicios` VALUES ('10', 'Ambientes');
INSERT INTO `servicios` VALUES ('11', 'Bar - Restaurat las 24 horas. ');
INSERT INTO `servicios` VALUES ('12', 'Piscina. ');
INSERT INTO `servicios` VALUES ('13', 'Multicacha. ');
INSERT INTO `servicios` VALUES ('14', 'Lavandería. ');
INSERT INTO `servicios` VALUES ('15', 'Calefacción Central. ');
