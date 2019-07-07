-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: hotel
-- ------------------------------------------------------
-- Server version	10.1.38-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_descripcion` varchar(100) DEFAULT NULL,
  `c_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'ARTEFACTOS',1),(2,'GASEOSA',1);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudad` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_pais` int(11) DEFAULT NULL,
  `c_descripcion` varchar(100) DEFAULT NULL,
  `c_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`c_id`),
  KEY `pais_fk` (`c_pais`),
  CONSTRAINT `pais_fk` FOREIGN KEY (`c_pais`) REFERENCES `pais` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudad`
--

LOCK TABLES `ciudad` WRITE;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
INSERT INTO `ciudad` VALUES (0,1,'TARAPOTO - SAN MARTIN',1),(8,8,'Tarapoto',1),(9,11,'rer',1),(10,1,'wewewe',1),(11,1,'cid2',1),(12,4,'ciudad de la plata',1),(13,5,'bogota',1),(14,6,'quito',1),(15,7,'por',1),(16,2,'santiago',1),(17,3,'buenos aires',1);
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_tipocliente` int(11) DEFAULT NULL,
  `c_dni` varchar(8) DEFAULT NULL,
  `c_nombres` varchar(100) DEFAULT NULL,
  `c_direccion` varchar(200) DEFAULT NULL,
  `c_fechareg` date DEFAULT NULL,
  `c_celular` varchar(15) DEFAULT NULL,
  `c_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`c_id`),
  KEY `tipocliente_fk` (`c_tipocliente`),
  CONSTRAINT `tipocliente_fk` FOREIGN KEY (`c_tipocliente`) REFERENCES `tipo_cliente` (`tc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,1,'98538458','juan morales dfgf','Tarapoto','2017-02-06','958485857',1),(3,1,'48515513','Juan Miguel Alvarado Julca','jr. cesar david 123','2019-04-24','927202725',1),(4,1,'70989910','Christian Manue Juárez Rivero','jr. cesar david 126','2019-04-27','956908983',1),(5,1,'70989910','Christian Manue Juárez Rivero','jr. cesar david 126','2019-04-27','956908983',1),(6,1,'70188345','Ricardo salazar Ríos','jr. aviación 345','2019-04-28','945678754',1),(7,1,'21212121','admin admin','dsv sda','2019-05-19','1212121211',1),(8,1,'12312312','NUEVO ','343','2019-07-07','1234567899',1);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumo`
--

DROP TABLE IF EXISTS `consumo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumo` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_cliente` int(11) DEFAULT NULL,
  `c_empleado` int(11) DEFAULT NULL,
  `c_fecha` date DEFAULT NULL,
  `c_total` double DEFAULT NULL,
  `c_igv` double DEFAULT NULL,
  `c_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`c_id`),
  KEY `fk_cliente` (`c_cliente`),
  KEY `fk_empleado` (`c_empleado`),
  CONSTRAINT `fk_cliente` FOREIGN KEY (`c_cliente`) REFERENCES `cliente` (`c_id`),
  CONSTRAINT `fk_empleado` FOREIGN KEY (`c_empleado`) REFERENCES `empleado` (`e_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumo`
--

LOCK TABLES `consumo` WRITE;
/*!40000 ALTER TABLE `consumo` DISABLE KEYS */;
/*!40000 ALTER TABLE `consumo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_consumo`
--

DROP TABLE IF EXISTS `detalle_consumo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_consumo` (
  `dc_consumo` int(11) NOT NULL,
  `dc_producto` int(11) NOT NULL,
  `dc_cantidad` int(11) DEFAULT NULL,
  `dc_precio_unitario` double DEFAULT NULL,
  `dc_igv` double DEFAULT NULL,
  `dc_monto` double DEFAULT NULL,
  `dc_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`dc_consumo`,`dc_producto`),
  KEY `fk_producto` (`dc_producto`),
  CONSTRAINT `fk_consumo` FOREIGN KEY (`dc_consumo`) REFERENCES `consumo` (`c_id`),
  CONSTRAINT `fk_producto` FOREIGN KEY (`dc_producto`) REFERENCES `producto` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_consumo`
--

LOCK TABLES `detalle_consumo` WRITE;
/*!40000 ALTER TABLE `detalle_consumo` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_consumo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_reserva`
--

DROP TABLE IF EXISTS `detalle_reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_reserva` (
  `dr_reserva` int(11) NOT NULL,
  `dr_habitacion` int(11) NOT NULL,
  `dr_monto` double DEFAULT NULL,
  `dr_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`dr_reserva`,`dr_habitacion`),
  KEY `fk_habitacion` (`dr_habitacion`),
  CONSTRAINT `fk_habitacion` FOREIGN KEY (`dr_habitacion`) REFERENCES `habitacion` (`h_id`),
  CONSTRAINT `fk_reserva` FOREIGN KEY (`dr_reserva`) REFERENCES `reserva` (`r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_reserva`
--

LOCK TABLES `detalle_reserva` WRITE;
/*!40000 ALTER TABLE `detalle_reserva` DISABLE KEYS */;
INSERT INTO `detalle_reserva` VALUES (3,1,0,1),(4,1,0,1),(5,3,0,1),(6,6,0,1),(7,7,0,1);
/*!40000 ALTER TABLE `detalle_reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_servicio`
--

DROP TABLE IF EXISTS `detalle_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_servicio` (
  `ds_entrada` int(11) NOT NULL,
  `ds_producto` int(11) NOT NULL,
  `ds_cantidad` int(11) DEFAULT NULL,
  `ds_precio_unitario` double DEFAULT NULL,
  `ds_igv` double DEFAULT NULL,
  `ds_monto` double DEFAULT NULL,
  `ds_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`ds_entrada`,`ds_producto`),
  KEY `fk_producto1` (`ds_producto`),
  CONSTRAINT `fk_entrada1` FOREIGN KEY (`ds_entrada`) REFERENCES `entrada` (`e_id`),
  CONSTRAINT `fk_producto1` FOREIGN KEY (`ds_producto`) REFERENCES `producto` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_servicio`
--

LOCK TABLES `detalle_servicio` WRITE;
/*!40000 ALTER TABLE `detalle_servicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_dni` varchar(8) DEFAULT NULL,
  `e_nombres` varchar(100) DEFAULT NULL,
  `e_apellidos` varchar(100) DEFAULT NULL,
  `e_direccion` varchar(200) DEFAULT NULL,
  `e_usuario` varchar(50) DEFAULT NULL,
  `e_clave` varchar(100) DEFAULT NULL,
  `e_celular` varchar(15) DEFAULT NULL,
  `e_sexo` varchar(15) DEFAULT NULL,
  `e_fechareg` date DEFAULT NULL,
  `e_tipoempleado` int(11) NOT NULL,
  `e_estado` int(11) DEFAULT '1',
  `e_bloqueado` bit(1) DEFAULT b'1',
  PRIMARY KEY (`e_id`),
  KEY `tipoempleado_fk1` (`e_tipoempleado`),
  CONSTRAINT `tipoempleado_fk1` FOREIGN KEY (`e_tipoempleado`) REFERENCES `tipo_empleado` (`te_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'93589585','JUAN','ALVARADO','TARAPOTO','juan','123','3894984848','MASCULINO','2017-02-07',2,1,''),(2,'70989910','Christian Manue','Juárez Rivero','jr. cesar david 126','CMJR','123','956908983','MASCULINO','2019-04-28',2,1,''),(3,'49789796','sokal','sdsdsd','jt libre','admin','admin','4956568984','MASCULINO','2019-05-02',1,1,''),(4,'74276597','fdf','df','mfsl,m','j','j','9999999999','MASCULINO','2019-05-12',2,1,''),(5,'11111111','qq','qqq','1','q','q','1111111111','MASCULINO','2019-05-12',2,1,'\0');
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enseres`
--

DROP TABLE IF EXISTS `enseres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enseres` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_categoria` int(11) NOT NULL,
  `e_habitacion` int(11) NOT NULL,
  `e_descripcion` varchar(100) DEFAULT NULL,
  `e_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`e_id`),
  KEY `fk_habitacion1` (`e_habitacion`),
  KEY `fk_categoria1` (`e_categoria`),
  CONSTRAINT `fk_categoria1` FOREIGN KEY (`e_categoria`) REFERENCES `categoria` (`c_id`),
  CONSTRAINT `fk_habitacion1` FOREIGN KEY (`e_habitacion`) REFERENCES `habitacion` (`h_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enseres`
--

LOCK TABLES `enseres` WRITE;
/*!40000 ALTER TABLE `enseres` DISABLE KEYS */;
INSERT INTO `enseres` VALUES (8,1,4,'TELEVISOR LCD',1),(9,1,3,'TELEVISOR LCD',1),(10,1,2,'TELEVISOR LCD',1),(15,1,6,'TELEVISOR LCD',1),(16,1,5,'TELEVISOR LCD',1),(17,1,7,'TELEVISOR LCD',1),(18,1,1,'TELEVISOR LCD',1),(19,1,1,'VENTILADOR',1);
/*!40000 ALTER TABLE `enseres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrada`
--

DROP TABLE IF EXISTS `entrada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrada` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_huesped` int(11) DEFAULT NULL,
  `e_empleado` int(11) DEFAULT NULL,
  `e_habitacion` int(11) DEFAULT NULL,
  `e_ciudad` int(11) DEFAULT NULL,
  `e_fechaini` date DEFAULT NULL,
  `e_fechafin` date NOT NULL,
  `e_dias` int(11) NOT NULL,
  `e_total` double DEFAULT NULL,
  `e_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`e_id`),
  KEY `fk_huesped` (`e_huesped`),
  KEY `fk_empleado2` (`e_empleado`),
  KEY `fk_ciudad1` (`e_ciudad`),
  KEY `fk_habitacion2` (`e_habitacion`),
  CONSTRAINT `fk_ciudad1` FOREIGN KEY (`e_ciudad`) REFERENCES `ciudad` (`c_id`),
  CONSTRAINT `fk_empleado2` FOREIGN KEY (`e_empleado`) REFERENCES `empleado` (`e_id`),
  CONSTRAINT `fk_habitacion2` FOREIGN KEY (`e_habitacion`) REFERENCES `habitacion` (`h_id`),
  CONSTRAINT `fk_huesped` FOREIGN KEY (`e_huesped`) REFERENCES `huesped` (`h_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrada`
--

LOCK TABLES `entrada` WRITE;
/*!40000 ALTER TABLE `entrada` DISABLE KEYS */;
INSERT INTO `entrada` VALUES (1,3,1,3,0,'2017-02-19','2017-02-20',1,50,0),(7,7,1,7,0,'2019-04-27','2019-04-28',1,100,0),(8,7,1,1,0,'2019-04-28','2019-04-30',2,160,0),(9,7,1,3,0,'2019-04-28','2019-05-01',3,150,0),(10,8,1,1,0,'2019-04-28','2019-04-29',1,80,0),(11,7,1,1,0,'2019-04-28','2019-04-29',1,80,0),(12,7,2,1,0,'2019-04-28','2019-04-29',1,80,0),(13,10,3,8,0,'2019-05-19','2019-05-20',1,10,0),(14,9,3,4,0,'2019-05-25','2019-05-26',1,50,0),(15,9,3,3,0,'2019-05-25','2019-05-26',1,50,0),(16,9,3,3,0,'2019-05-25','2019-05-26',1,50,0),(17,18,3,2,0,'2019-07-06','2019-07-10',4,280,0),(18,10,3,8,0,'2019-07-07','2019-07-09',2,20,0),(19,20,3,6,15,'2019-07-07','2019-07-08',1,60,0),(20,14,3,8,10,'2019-07-07','2019-07-08',1,10,0),(21,14,3,7,16,'2019-07-07','2019-07-08',1,100,1),(22,14,3,7,10,'2019-07-07','2019-07-08',1,100,1),(23,21,3,3,11,'2019-07-07','2019-07-08',1,50,0),(24,21,3,8,16,'2019-07-07','2019-07-08',1,10,0),(25,21,3,1,10,'2019-07-07','2019-07-08',1,80,0),(26,13,3,7,17,'2019-07-07','2019-07-08',1,100,1),(27,16,3,5,17,'2019-07-07','2019-07-08',1,60,0),(28,13,3,4,15,'2019-07-07','2019-07-08',1,50,0),(29,14,3,5,10,'2019-07-07','2019-07-31',24,1440,1),(30,22,3,4,14,'2019-07-07','2019-07-09',2,100,1);
/*!40000 ALTER TABLE `entrada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fail_sesion`
--

DROP TABLE IF EXISTS `fail_sesion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fail_sesion` (
  `u_id` int(11) NOT NULL,
  `intentos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fail_sesion`
--

LOCK TABLES `fail_sesion` WRITE;
/*!40000 ALTER TABLE `fail_sesion` DISABLE KEYS */;
/*!40000 ALTER TABLE `fail_sesion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `habitacion`
--

DROP TABLE IF EXISTS `habitacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `habitacion` (
  `h_id` int(11) NOT NULL AUTO_INCREMENT,
  `h_tipohabitacion` int(11) DEFAULT NULL,
  `h_nro` varchar(10) DEFAULT NULL,
  `h_descripcion` varchar(100) DEFAULT NULL,
  `h_precio` double NOT NULL,
  `h_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`h_id`),
  KEY `tipohabitacion_fk` (`h_tipohabitacion`),
  CONSTRAINT `tipohabitacion_fk` FOREIGN KEY (`h_tipohabitacion`) REFERENCES `tipo_habitacion` (`th_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habitacion`
--

LOCK TABLES `habitacion` WRITE;
/*!40000 ALTER TABLE `habitacion` DISABLE KEYS */;
INSERT INTO `habitacion` VALUES (1,1,'111','Habitacion nueva',80,1),(2,1,'101','Habitacion nueva',70,1),(3,1,'102','Habitacion nueva',50,1),(4,1,'103','Habitacion nueva',50,2),(5,2,'104','Habitacion nueva',60,2),(6,2,'105','Habitacion nueva',60,1),(7,2,'106','Habitacion nueva',100,1),(8,1,'1','habitacion numero 1',10,1);
/*!40000 ALTER TABLE `habitacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `huesped`
--

DROP TABLE IF EXISTS `huesped`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `huesped` (
  `h_id` int(11) NOT NULL AUTO_INCREMENT,
  `h_tipodocumento` int(11) DEFAULT NULL,
  `h_documento` varchar(11) DEFAULT NULL,
  `h_nacionalidad` int(11) NOT NULL,
  `h_nombres` varchar(100) DEFAULT NULL,
  `h_direccion` varchar(200) DEFAULT NULL,
  `h_fechareg` date DEFAULT NULL,
  `h_celular` varchar(15) DEFAULT NULL,
  `h_estado` int(11) DEFAULT '1',
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`h_id`),
  KEY `tipodoc_fk` (`h_tipodocumento`),
  CONSTRAINT `tipodoc_fk` FOREIGN KEY (`h_tipodocumento`) REFERENCES `tipo_documento` (`td_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `huesped`
--

LOCK TABLES `huesped` WRITE;
/*!40000 ALTER TABLE `huesped` DISABLE KEYS */;
INSERT INTO `huesped` VALUES (3,1,'68484885',1,'juan martinez','sas','2017-02-19','123456789',1,'qwe@a'),(4,1,'98344444',5,'Mario Velarde','sasas','2017-02-22','123456789',1,'qwe@a'),(5,1,'49388475',6,'Cristiano Ronaldo','asaas','2017-02-27','123456789',1,'qwe@a'),(7,1,'70989910',2,'Christian Manue Juárez Rivero','jr. cesar david 126','2019-04-27','956908983',1,'qwe@a'),(8,1,'48515513',7,'Ricardo salazar Ríos','HBKHL ','2019-04-28','123456789',1,'qwe@a'),(9,1,'11111111',13,'name lasname','strret ','2019-05-19','1111111111',1,'qwe@a'),(10,1,'74276597',12,'name lasname','adfbvgf','2019-05-19','22222222',1,'swrw@s'),(11,1,'77777777',13,'erty yuiul','dtfyguhijok','2019-05-25','1234567890',1,'qwe@a'),(12,2,'77777777777',11,'erty yuiul','dtfyguhijok','2019-05-25','1234567890',1,'sds@c'),(13,1,'12345678',11,'mbn ghf','dhgfd','2019-07-06','1234567890123',1,'sdm@s'),(14,1,'11114577',10,'name lasname','strret ','2019-07-06','147852369178',1,'s@c.com'),(16,1,'22732878',11,'modmso','msd,m sla dls','2019-07-06','2392839283232',1,'s@c.com'),(17,1,'44444444',11,'ck ','ncx k cks','2019-07-06','2626632637623',1,'m@m.com'),(18,1,'99999999',11,'probando','sdfsvs sds','2019-07-06','7878445454512',1,'sdm@s'),(19,1,'23232323',14,'fsde','rer','2019-07-07','32323232323',1,'df@q'),(20,1,'78965412',15,'qw',NULL,'2019-07-07',NULL,1,NULL),(21,1,'12312312',11,'NUEVO',NULL,'2019-07-07',NULL,1,NULL),(22,1,'23243542',14,'final',NULL,'2019-07-07',NULL,1,NULL);
/*!40000 ALTER TABLE `huesped` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_descripcion` varchar(20) NOT NULL,
  `m_estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES (1,'usuarios',''),(2,'mantenimiento',''),(3,'reportes',''),(4,'habitaciones',''),(5,'estadias',''),(6,'clientes','');
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_descripcion` varchar(100) DEFAULT NULL,
  `p_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` VALUES (1,'PERU',1),(2,'CHILE',1),(3,'ARGENTINA',1),(4,'BRASIL',1),(5,'COLOMBIA',1),(6,'ECUADOR',1),(7,'PORTUGAL',1),(8,'Perú.',0),(9,'l',0),(10,'mjkl',0),(11,'r',0),(12,'BRAZIL',0),(13,'f',1);
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `m_id` int(11) NOT NULL,
  `m_tipo_usuario` int(11) NOT NULL,
  KEY `permisos_tipo_usuario` (`m_tipo_usuario`),
  KEY `permiso_modulos` (`m_id`),
  CONSTRAINT `permiso_modulos` FOREIGN KEY (`m_id`) REFERENCES `modulos` (`m_id`),
  CONSTRAINT `permisos_tipo_usuario` FOREIGN KEY (`m_tipo_usuario`) REFERENCES `tipo_empleado` (`te_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,1),(4,1),(2,1),(3,1),(2,2),(4,2),(5,1),(6,1);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_categoria` int(11) DEFAULT NULL,
  `p_descripcion` varchar(100) DEFAULT NULL,
  `p_stock` int(11) NOT NULL,
  `p_precio` double NOT NULL,
  `p_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`p_id`),
  KEY `categoria_fk` (`p_categoria`),
  CONSTRAINT `categoria_fk` FOREIGN KEY (`p_categoria`) REFERENCES `categoria` (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,2,'Gaseosa 500 ML',10,2.5,1);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserva` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_cliente` int(11) DEFAULT NULL,
  `r_fecha` date DEFAULT NULL,
  `r_total` double DEFAULT NULL,
  `r_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`r_id`),
  KEY `fk_cliente1` (`r_cliente`),
  CONSTRAINT `fk_cliente1` FOREIGN KEY (`r_cliente`) REFERENCES `cliente` (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva`
--

LOCK TABLES `reserva` WRITE;
/*!40000 ALTER TABLE `reserva` DISABLE KEYS */;
INSERT INTO `reserva` VALUES (1,1,'2017-02-19',NULL,2),(2,4,'2019-04-27',NULL,2),(3,5,'2019-04-27',NULL,2),(4,6,'2019-05-02',NULL,2),(5,7,'2019-05-25',NULL,2),(6,6,'2019-07-25',NULL,1),(7,6,'2019-07-08',NULL,1);
/*!40000 ALTER TABLE `reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicio`
--

DROP TABLE IF EXISTS `servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicio` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_entrada` int(11) DEFAULT NULL,
  `s_tiposervicio` int(11) NOT NULL,
  `s_total` double DEFAULT NULL,
  `s_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`s_id`),
  KEY `fk_entrada` (`s_entrada`),
  CONSTRAINT `fk_entrada` FOREIGN KEY (`s_entrada`) REFERENCES `entrada` (`e_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicio`
--

LOCK TABLES `servicio` WRITE;
/*!40000 ALTER TABLE `servicio` DISABLE KEYS */;
INSERT INTO `servicio` VALUES (1,1,1,10,1),(15,8,1,23,1),(16,8,2,44,1),(17,8,1,1,1),(19,1,1,231,1),(25,29,2,45,1),(27,29,1,55,1),(28,29,2,45,1),(29,30,2,432,1),(30,30,1,12,1),(31,30,1,34,1),(32,29,1,3,1),(33,29,2,45,1);
/*!40000 ALTER TABLE `servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_cliente`
--

DROP TABLE IF EXISTS `tipo_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_cliente` (
  `tc_id` int(11) NOT NULL AUTO_INCREMENT,
  `tc_descripcion` varchar(100) DEFAULT NULL,
  `tc_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`tc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_cliente`
--

LOCK TABLES `tipo_cliente` WRITE;
/*!40000 ALTER TABLE `tipo_cliente` DISABLE KEYS */;
INSERT INTO `tipo_cliente` VALUES (1,'NORMAL',1),(2,'EMPRESA',1);
/*!40000 ALTER TABLE `tipo_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_documento` (
  `td_id` int(11) NOT NULL AUTO_INCREMENT,
  `td_descripcion` varchar(100) DEFAULT NULL,
  `td_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`td_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_documento`
--

LOCK TABLES `tipo_documento` WRITE;
/*!40000 ALTER TABLE `tipo_documento` DISABLE KEYS */;
INSERT INTO `tipo_documento` VALUES (1,'DNI',1),(2,'RUC',1);
/*!40000 ALTER TABLE `tipo_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_empleado`
--

DROP TABLE IF EXISTS `tipo_empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_empleado` (
  `te_id` int(11) NOT NULL AUTO_INCREMENT,
  `te_descripcion` varchar(100) DEFAULT NULL,
  `te_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`te_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_empleado`
--

LOCK TABLES `tipo_empleado` WRITE;
/*!40000 ALTER TABLE `tipo_empleado` DISABLE KEYS */;
INSERT INTO `tipo_empleado` VALUES (1,'ADMINISTRADOR',1),(2,'Recepcionista',1),(3,'Barredor',0);
/*!40000 ALTER TABLE `tipo_empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_habitacion`
--

DROP TABLE IF EXISTS `tipo_habitacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_habitacion` (
  `th_id` int(11) NOT NULL AUTO_INCREMENT,
  `th_descripcion` varchar(100) DEFAULT NULL,
  `th_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`th_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_habitacion`
--

LOCK TABLES `tipo_habitacion` WRITE;
/*!40000 ALTER TABLE `tipo_habitacion` DISABLE KEYS */;
INSERT INTO `tipo_habitacion` VALUES (1,'HABITACION SIMPLE',1),(2,'HABITACION DOBLE',1);
/*!40000 ALTER TABLE `tipo_habitacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_servicio`
--

DROP TABLE IF EXISTS `tipo_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_servicio` (
  `ts_id` int(11) NOT NULL AUTO_INCREMENT,
  `ts_descripcion` varchar(100) DEFAULT NULL,
  `ts_estado` int(11) DEFAULT '1',
  PRIMARY KEY (`ts_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_servicio`
--

LOCK TABLES `tipo_servicio` WRITE;
/*!40000 ALTER TABLE `tipo_servicio` DISABLE KEYS */;
INSERT INTO `tipo_servicio` VALUES (1,'RESTAURANT',1),(2,'INTERNET WIFI',1);
/*!40000 ALTER TABLE `tipo_servicio` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-06 23:30:13
