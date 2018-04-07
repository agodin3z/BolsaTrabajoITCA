-- MySQL dump 10.16  Distrib 10.1.33-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: db_bolsatrabajo
-- ------------------------------------------------------
-- Server version	10.1.33-MariaDB

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
-- Current Database: `db_bolsatrabajo`
--
DROP DATABASE IF EXISTS `db_bolsatrabajo`;
CREATE DATABASE /*!32312 IF NOT EXISTS*/ `db_bolsatrabajo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `db_bolsatrabajo`;

--
-- Table structure for table `tbl_CatEmpresas`
--

DROP TABLE IF EXISTS `tbl_CatEmpresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_CatEmpresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_CatEmpresas`
--

LOCK TABLES `tbl_CatEmpresas` WRITE;
/*!40000 ALTER TABLE `tbl_CatEmpresas` DISABLE KEYS */;
INSERT INTO `tbl_CatEmpresas` VALUES (1,'Administración'),(2,'Almacén'),(3,'Artes gráficas'),(4,'Aseo'),(5,'Asesoría'),(6,'Atención a clientes'),(7,'CallCenter'),(8,'Comercio Exterior'),(9,'Compras'),(10,'Comunicación'),(11,'Construccion y obra'),(12,'Contabilidad'),(13,'Dirección'),(14,'Diseño'),(15,'Docencia'),(16,'Finanzas'),(17,'Gerencia'),(18,'Hostelería'),(19,'Informática'),(20,'Ingeniería'),(21,'Investigación y Calidad'),(22,'Legal'),(23,'Logística'),(24,'Mantenimiento y Reparaciones Técnicas'),(25,'Manufactura'),(26,'Medicina'),(27,'Mercadotécnia'),(28,'Oficina'),(29,'Operarios'),(30,'Producción'),(31,'Publicidad'),(32,'Recursos Humanos'),(33,'Salud'),(34,'Seguridad'),(35,'Servicios Generales'),(36,'Telecomunicaciones'),(37,'Telemercadeo'),(38,'Transporte'),(39,'Turismo'),(40,'Ventas');
/*!40000 ALTER TABLE `tbl_CatEmpresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_Conocimientos`
--

DROP TABLE IF EXISTS `tbl_Conocimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Conocimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programa` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersona` (`idPersona`),
  CONSTRAINT `tbl_Conocimientos_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `tbl_Persona` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_Departamento`
--

DROP TABLE IF EXISTS `tbl_Departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pais` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_Departamento_ibfk_1` (`pais`),
  CONSTRAINT `tbl_Departamento_ibfk_1` FOREIGN KEY (`pais`) REFERENCES `tbl_Pais` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_Departamento`
--

LOCK TABLES `tbl_Departamento` WRITE;
/*!40000 ALTER TABLE `tbl_Departamento` DISABLE KEYS */;
INSERT INTO `tbl_Departamento` VALUES (1,'Ahuachapán','SV'),(2,'Cabañas','SV'),(3,'Chalatenango','SV'),(4,'Cuscatlán','SV'),(5,'Morazán','SV'),(6,'La Libertad','SV'),(7,'La Paz','SV'),(8,'La Unión','SV'),(9,'San Miguel','SV'),(10,'San Salvador','SV'),(11,'San Vicente','SV'),(12,'Santa Ana','SV'),(13,'Sonsonate','SV'),(14,'Usulután','SV');
/*!40000 ALTER TABLE `tbl_Departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_Empresa`
--

DROP TABLE IF EXISTS `tbl_Empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Empresa` (
  `id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwd` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` int(11) DEFAULT NULL,
  `tel` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_contact` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dir` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pais` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depto` int(11) DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `descripcion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(700) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mision` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vision` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria` (`categoria`),
  CONSTRAINT `tbl_Empresa_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `tbl_CatEmpresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_EstadoCivil`
--

DROP TABLE IF EXISTS `tbl_EstadoCivil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_EstadoCivil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_EstadoCivil`
--

LOCK TABLES `tbl_EstadoCivil` WRITE;
/*!40000 ALTER TABLE `tbl_EstadoCivil` DISABLE KEYS */;
INSERT INTO `tbl_EstadoCivil` VALUES (1,'Soltero(a)'),(2,'Casado(a)'),(3,'Separado(a)/Divorciad(a)'),(4,'Viudo(a)'),(5,'Unión Libre');
/*!40000 ALTER TABLE `tbl_EstadoCivil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_Estudios`
--

DROP TABLE IF EXISTS `tbl_Estudios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Estudios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institucion` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nivel` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notas` varchar(240) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersona` (`idPersona`),
  CONSTRAINT `tbl_Estudios_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `tbl_Persona` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_Experiencias`
--

DROP TABLE IF EXISTS `tbl_Experiencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Experiencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `funciones` varchar(240) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersona` (`idPersona`),
  CONSTRAINT `tbl_Experiencias_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `tbl_Persona` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_Habilidades`
--

DROP TABLE IF EXISTS `tbl_Habilidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Habilidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `habilidad` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersona` (`idPersona`),
  CONSTRAINT `tbl_Habilidades_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `tbl_Persona` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_Idioma_Persona`
--

DROP TABLE IF EXISTS `tbl_Idioma_Persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Idioma_Persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idIdioma` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersona` (`idPersona`),
  KEY `idIdioma` (`idIdioma`),
  CONSTRAINT `tbl_Idioma_Persona_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `tbl_Persona` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tbl_Idioma_Persona_ibfk_2` FOREIGN KEY (`idIdioma`) REFERENCES `tbl_Idiomas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_Idiomas`
--

DROP TABLE IF EXISTS `tbl_Idiomas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Idiomas` (
  `id` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idioma` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_Idiomas`
--

LOCK TABLES `tbl_Idiomas` WRITE;
/*!40000 ALTER TABLE `tbl_Idiomas` DISABLE KEYS */;
INSERT INTO `tbl_Idiomas` VALUES ('ara','Árabe'),('ben','Bengalí'),('chi','Chino'),('dan','Danés'),('dut','Holandés'),('eng','Inglés'),('fre','Francés'),('ger','Alemán'),('hin','Hindi'),('ind','Indonesio'),('ita','Italiano'),('jpn','Japonés'),('nor','Noruego'),('pan','Panyabí'),('pol','Polaco'),('por','Portugués'),('rus','Ruso'),('spa','Español'),('swe','Sueco'),('tur','Turco');
/*!40000 ALTER TABLE `tbl_Idiomas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_Jornada`
--

DROP TABLE IF EXISTS `tbl_Jornada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Jornada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_Jornada`
--

LOCK TABLES `tbl_Jornada` WRITE;
/*!40000 ALTER TABLE `tbl_Jornada` DISABLE KEYS */;
INSERT INTO `tbl_Jornada` VALUES (1,'Beca/Prácticas'),(2,'Desde Casa'),(3,'Medio Tiempo'),(4,'Por Horas'),(5,'Tiempo Completo');
/*!40000 ALTER TABLE `tbl_Jornada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_LinksEmpresa`
--

DROP TABLE IF EXISTS `tbl_LinksEmpresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_LinksEmpresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpresa` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idLink` int(11) NOT NULL,
  `url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idLink` (`idLink`),
  KEY `tbl_LinksEmpresa_ibfk_1` (`idEmpresa`),
  CONSTRAINT `tbl_LinksEmpresa_ibfk_1` FOREIGN KEY (`idEmpresa`) REFERENCES `tbl_Empresa` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tbl_LinksEmpresa_ibfk_2` FOREIGN KEY (`idLink`) REFERENCES `tbl_TipoLinks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_Municipio`
--

DROP TABLE IF EXISTS `tbl_Municipio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Municipio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `depto` (`depto`),
  CONSTRAINT `tbl_Municipio_ibfk_1` FOREIGN KEY (`depto`) REFERENCES `tbl_Departamento` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_Municipio`
--

LOCK TABLES `tbl_Municipio` WRITE;
/*!40000 ALTER TABLE `tbl_Municipio` DISABLE KEYS */;
INSERT INTO `tbl_Municipio` VALUES (1,'Ahuachapán',1),(2,'Jujutla',1),(3,'Atiquizaya',1),(4,'Concepción de Ataco',1),(5,'El Refugio',1),(6,'Guaymango',1),(7,'Apaneca',1),(8,'San Francisco Menéndez',1),(9,'San Lorenzo',1),(10,'San Pedro Puxtla',1),(11,'Tacuba',1),(12,'Turín',1),(13,'Candelaria de la Frontera',12),(14,'Chalchuapa',12),(15,'Coatepeque',12),(16,'El Congo',12),(17,'El Porvenir',12),(18,'Masahuat',12),(19,'Metapán',12),(20,'San Antonio Pajonal',12),(21,'San Sebastián Salitrillo',12),(22,'Santa Ana',12),(23,'Santa Rosa Guachipilín',12),(24,'Santiago de la Frontera',12),(25,'Texistepeque',12),(26,'Acajutla',13),(27,'Armenia',13),(28,'Caluco',13),(29,'Cuisnahuat',13),(30,'Izalco',13),(31,'Juayúa',13),(32,'Nahuizalco',13),(33,'Nahulingo',13),(34,'Salcoatitán',13),(35,'San Antonio del Monte',13),(36,'San Julián',13),(37,'Santa Catarina Masahuat',13),(38,'Santa Isabel Ishuatán',13),(39,'Santo Domingo de Guzmán',13),(40,'Sonsonate',13),(41,'Sonzacate',13),(42,'Alegría',14),(43,'Berlín',14),(44,'California',14),(45,'Concepción Batres',14),(46,'El Triunfo',14),(47,'Ereguayquín',14),(48,'Estanzuelas',14),(49,'Jiquilisco',14),(50,'Jucuapa',14),(51,'Jucuarán',14),(52,'Mercedes Umaña',14),(53,'Nueva Granada',14),(54,'Ozatlán',14),(55,'Puerto El Triunfo',14),(56,'San Agustín',14),(57,'San Buenaventura',14),(58,'San Dionisio',14),(59,'San Francisco Javier',14),(60,'Santa Elena',14),(61,'Santa María',14),(62,'Santiago de María',14),(63,'Tecapán',14),(64,'Usulután',14),(65,'Carolina',9),(66,'Chapeltique',9),(67,'Chinameca',9),(68,'Chirilagua',9),(69,'Ciudad Barrios',9),(70,'Comacarán',9),(71,'El Tránsito',9),(72,'Lolotique',9),(73,'Moncagua',9),(74,'Nueva Guadalupe',9),(75,'Nuevo Edén de San Juan',9),(76,'Quelepa',9),(77,'San Antonio del Mosco',9),(78,'San Gerardo',9),(79,'San Jorge',9),(80,'San Luis de la Reina',9),(81,'San Miguel',9),(82,'San Rafael Oriente',9),(83,'Sesori',9),(84,'Uluazapa',9),(85,'Arambala',5),(86,'Cacaopera',5),(87,'Chilanga',5),(88,'Corinto',5),(89,'Delicias de Concepción',5),(90,'El Divisadero',5),(91,'El Rosario (Morazán)',5),(92,'Gualococti',5),(93,'Guatajiagua',5),(94,'Joateca',5),(95,'Jocoaitique',5),(96,'Jocoro',5),(97,'Lolotiquillo',5),(98,'Meanguera',5),(99,'Osicala',5),(100,'Perquín',5),(101,'San Carlos',5),(102,'San Fernando (Morazán)',5),(103,'San Francisco Gotera',5),(104,'San Isidro (Morazán)',5),(105,'San Simón',5),(106,'Sensembra',5),(107,'Sociedad',5),(108,'Torola',5),(109,'Yamabal',5),(110,'Yoloaiquín',5),(111,'La Unión',8),(112,'San Alejo',8),(113,'Yucuaiquín',8),(114,'Conchagua',8),(115,'Intipucá',8),(116,'San José',8),(117,'El Carmen (La Unión)',8),(118,'Yayantique',8),(119,'Bolívar',8),(120,'Meanguera del Golfo',8),(121,'Santa Rosa de Lima',8),(122,'Pasaquina',8),(123,'Anamoros',8),(124,'Nueva Esparta',8),(125,'El Sauce',8),(126,'Concepción de Oriente',8),(127,'Polorós',8),(128,'Lislique',8),(129,'Antiguo Cuscatlán',6),(130,'Chiltiupán',6),(131,'Ciudad Arce',6),(132,'Colón',6),(133,'Comasagua',6),(134,'Huizúcar',6),(135,'Jayaque',6),(136,'Jicalapa',6),(137,'La Libertad',6),(138,'Santa Tecla',6),(139,'Nuevo Cuscatlán',6),(140,'San Juan Opico',6),(141,'Quezaltepeque',6),(142,'Sacacoyo',6),(143,'San José Villanueva',6),(144,'San Matías',6),(145,'San Pablo Tacachico',6),(146,'Talnique',6),(147,'Tamanique',6),(148,'Teotepeque',6),(149,'Tepecoyo',6),(150,'Zaragoza',6),(151,'Agua Caliente',3),(152,'Arcatao',3),(153,'Azacualpa',3),(154,'Cancasque',3),(155,'Chalatenango',3),(156,'Citalá',3),(157,'Comapala',3),(158,'Concepción Quezaltepeque',3),(159,'Dulce Nombre de María',3),(160,'El Carrizal',3),(161,'El Paraíso',3),(162,'La Laguna',3),(163,'La Palma',3),(164,'La Reina',3),(165,'Las Vueltas',3),(166,'Nueva Concepción',3),(167,'Nueva Trinidad',3),(168,'Nombre de Jesús',3),(169,'Ojos de Agua',3),(170,'Potonico',3),(171,'San Antonio de la Cruz',3),(172,'San Antonio Los Ranchos',3),(173,'San Fernando (Chalatenango)',3),(174,'San Francisco Lempa',3),(175,'San Francisco Morazán',3),(176,'San Ignacio',3),(177,'San Isidro Labrador',3),(178,'Las Flores',3),(179,'San Luis del Carmen',3),(180,'San Miguel de Mercedes',3),(181,'San Rafael',3),(182,'Santa Rita',3),(183,'Tejutla',3),(184,'Cojutepeque',4),(185,'Candelaria',4),(186,'El Carmen (Cuscatlán)',4),(187,'El Rosario (Cuscatlán)',4),(188,'Monte San Juan',4),(189,'Oratorio de Concepción',4),(190,'San Bartolomé Perulapía',4),(191,'San Cristóbal',4),(192,'San José Guayabal',4),(193,'San Pedro Perulapán',4),(194,'San Rafael Cedros',4),(195,'San Ramón',4),(196,'Santa Cruz Analquito',4),(197,'Santa Cruz Michapa',4),(198,'Suchitoto',4),(199,'Tenancingo',4),(200,'Aguilares',10),(201,'Apopa',10),(202,'Ayutuxtepeque',10),(203,'Cuscatancingo',10),(204,'Ciudad Delgado',10),(205,'El Paisnal',10),(206,'Guazapa',10),(207,'Ilopango',10),(208,'Mejicanos',10),(209,'Nejapa',10),(210,'Panchimalco',10),(211,'Rosario de Mora',10),(212,'San Marcos',10),(213,'San Martín',10),(214,'San Salvador',10),(215,'Santiago Texacuangos',10),(216,'Santo Tomás',10),(217,'Soyapango',10),(218,'Tonacatepeque',10),(219,'Zacatecoluca',7),(220,'Cuyultitán',7),(221,'El Rosario (La Paz)',7),(222,'Jerusalén',7),(223,'Mercedes La Ceiba',7),(224,'Olocuilta',7),(225,'Paraíso de Osorio',7),(226,'San Antonio Masahuat',7),(227,'San Emigdio',7),(228,'San Francisco Chinameca',7),(229,'San Pedro Masahuat',7),(230,'San Juan Nonualco',7),(231,'San Juan Talpa',7),(232,'San Juan Tepezontes',7),(233,'San Luis La Herradura',7),(234,'San Luis Talpa',7),(235,'San Miguel Tepezontes',7),(236,'San Pedro Nonualco',7),(237,'San Rafael Obrajuelo',7),(238,'Santa María Ostuma',7),(239,'Santiago Nonualco',7),(240,'Tapalhuaca',7),(241,'Cinquera',2),(242,'Dolores',2),(243,'Guacotecti',2),(244,'Ilobasco',2),(245,'Jutiapa',2),(246,'San Isidro (Cabañas)',2),(247,'Sensuntepeque',2),(248,'Tejutepeque',2),(249,'Victoria',2),(250,'Apastepeque',11),(251,'Guadalupe',11),(252,'San Cayetano Istepeque',11),(253,'San Esteban Catarina',11),(254,'San Ildefonso',11),(255,'San Lorenzo',11),(256,'San Sebastián',11),(257,'San Vicente',11),(258,'Santa Clara',11),(259,'Santo Domingo',11),(260,'Tecoluca',11),(261,'Tepetitán',11),(262,'Verapaz',11);
/*!40000 ALTER TABLE `tbl_Municipio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_Ofertas`
--

DROP TABLE IF EXISTS `tbl_Ofertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Ofertas` (
  `id` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idEmpresa` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contrato` int(11) DEFAULT NULL,
  `jornada` int(11) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `email` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salario` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localizacion` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vacantes` int(11) DEFAULT NULL,
  `educacionMin` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edad` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viajar` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residencia` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaPub` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contrato` (`contrato`),
  KEY `jornada` (`jornada`),
  KEY `categoria` (`categoria`),
  KEY `tbl_Ofertas_ibfk_1` (`idEmpresa`),
  CONSTRAINT `tbl_Ofertas_ibfk_1` FOREIGN KEY (`idEmpresa`) REFERENCES `tbl_Empresa` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tbl_Ofertas_ibfk_2` FOREIGN KEY (`contrato`) REFERENCES `tbl_TipoContrato` (`id`),
  CONSTRAINT `tbl_Ofertas_ibfk_3` FOREIGN KEY (`jornada`) REFERENCES `tbl_Jornada` (`id`),
  CONSTRAINT `tbl_Ofertas_ibfk_4` FOREIGN KEY (`categoria`) REFERENCES `tbl_CatEmpresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_Pais`
--

DROP TABLE IF EXISTS `tbl_Pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Pais` (
  `id` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_Pais`
--

LOCK TABLES `tbl_Pais` WRITE;
/*!40000 ALTER TABLE `tbl_Pais` DISABLE KEYS */;
INSERT INTO `tbl_Pais` VALUES ('AD','Andorra'),('AE','Emiratos Árabes Unidos'),('AF','Afganistán'),('AG','Antigua y Barbuda'),('AI','Anguilla'),('AL','Albania'),('AM','Armenia'),('AN','Antillas Holandesas'),('AO','Angola'),('AQ','Antártida'),('AR','Argentina'),('AS','Samoa Americana'),('AT','Austria'),('AU','Australia'),('AW','Aruba'),('AX','Islas Gland'),('AZ','Azerbaiyán'),('BA','Bosnia y Herzegovina'),('BB','Barbados'),('BD','Bangladesh'),('BE','Bélgica'),('BF','Burkina Faso'),('BG','Bulgaria'),('BH','Bahréin'),('BI','Burundi'),('BJ','Benin'),('BM','Bermudas'),('BN','Brunéi'),('BO','Bolivia'),('BR','Brasil'),('BS','Bahamas'),('BT','Bhután'),('BV','Isla Bouvet'),('BW','Botsuana'),('BY','Bielorrusia'),('BZ','Belice'),('CA','Canadá'),('CC','Islas Cocos'),('CD','República Democrática del Congo'),('CF','República Centroafricana'),('CG','Congo'),('CH','Suiza'),('CI','Costa de Marfil'),('CK','Islas Cook'),('CL','Chile'),('CM','Camerún'),('CN','China'),('CO','Colombia'),('CR','Costa Rica'),('CS','Serbia y Montenegro'),('CU','Cuba'),('CV','Cabo Verde'),('CX','Isla de Navidad'),('CY','Chipre'),('CZ','República Checa'),('DE','Alemania'),('DJ','Yibuti'),('DK','Dinamarca'),('DM','Dominica'),('DO','República Dominicana'),('DZ','Argelia'),('EC','Ecuador'),('EE','Estonia'),('EG','Egipto'),('EH','Sahara Occidental'),('ER','Eritrea'),('ES','España'),('ET','Etiopía'),('FI','Finlandia'),('FJ','Fiyi'),('FK','Islas Malvinas'),('FM','Micronesia'),('FO','Islas Feroe'),('FR','Francia'),('GA','Gabón'),('GB','Reino Unido'),('GD','Granada'),('GE','Georgia'),('GF','Guayana Francesa'),('GH','Ghana'),('GI','Gibraltar'),('GL','Groenlandia'),('GM','Gambia'),('GN','Guinea'),('GP','Guadalupe'),('GQ','Guinea Ecuatorial'),('GR','Grecia'),('GS','Islas Georgias del Sur y Sandwich del Sur'),('GT','Guatemala'),('GU','Guam'),('GW','Guinea-Bissau'),('GY','Guyana'),('HK','Hong Kong'),('HM','Islas Heard y McDonald'),('HN','Honduras'),('HR','Croacia'),('HT','Haití'),('HU','Hungría'),('ID','Indonesia'),('IE','Irlanda'),('IL','Israel'),('IN','India'),('IO','Territorio Británico del Océano Índico'),('IQ','Iraq'),('IR','Irán'),('IS','Islandia'),('IT','Italia'),('JM','Jamaica'),('JO','Jordania'),('JP','Japón'),('KE','Kenia'),('KG','Kirguistán'),('KH','Camboya'),('KI','Kiribati'),('KM','Comoras'),('KN','San Cristóbal y Nevis'),('KP','Corea del Norte'),('KR','Corea del Sur'),('KW','Kuwait'),('KY','Islas Caimán'),('KZ','Kazajstán'),('LA','Laos'),('LB','Líbano'),('LC','Santa Lucía'),('LI','Liechtenstein'),('LK','Sri Lanka'),('LR','Liberia'),('LS','Lesotho'),('LT','Lituania'),('LU','Luxemburgo'),('LV','Letonia'),('LY','Libia'),('MA','Marruecos'),('MC','Mónaco'),('MD','Moldavia'),('MG','Madagascar'),('MH','Islas Marshall'),('MK','ARY Macedonia'),('ML','Malí'),('MM','Myanmar'),('MN','Mongolia'),('MO','Macao'),('MP','Islas Marianas del Norte'),('MQ','Martinica'),('MR','Mauritania'),('MS','Montserrat'),('MT','Malta'),('MU','Mauricio'),('MV','Maldivas'),('MW','Malawi'),('MX','México'),('MY','Malasia'),('MZ','Mozambique'),('NA','Namibia'),('NC','Nueva Caledonia'),('NE','Níger'),('NF','Isla Norfolk'),('NG','Nigeria'),('NI','Nicaragua'),('NL','Países Bajos'),('NO','Noruega'),('NP','Nepal'),('NR','Nauru'),('NU','Niue'),('NZ','Nueva Zelanda'),('OM','Omán'),('PA','Panamá'),('PE','Perú'),('PF','Polinesia Francesa'),('PG','Papúa Nueva Guinea'),('PH','Filipinas'),('PK','Pakistán'),('PL','Polonia'),('PM','San Pedro y Miquelón'),('PN','Islas Pitcairn'),('PR','Puerto Rico'),('PS','Palestina'),('PT','Portugal'),('PW','Palau'),('PY','Paraguay'),('QA','Qatar'),('RE','Reunión'),('RO','Rumania'),('RU','Rusia'),('RW','Ruanda'),('SA','Arabia Saudí'),('SB','Islas Salomón'),('SC','Seychelles'),('SD','Sudán'),('SE','Suecia'),('SG','Singapur'),('SH','Santa Helena'),('SI','Eslovenia'),('SJ','Svalbard y Jan Mayen'),('SK','Eslovaquia'),('SL','Sierra Leona'),('SM','San Marino'),('SN','Senegal'),('SO','Somalia'),('SR','Surinam'),('ST','Santo Tomé y Príncipe'),('SV','El Salvador'),('SY','Siria'),('SZ','Suazilandia'),('TC','Islas Turcas y Caicos'),('TD','Chad'),('TF','Territorios Australes Franceses'),('TG','Togo'),('TH','Tailandia'),('TJ','Tayikistán'),('TK','Tokelau'),('TL','Timor Oriental'),('TM','Turkmenistán'),('TN','Túnez'),('TO','Tonga'),('TR','Turquía'),('TT','Trinidad y Tobago'),('TV','Tuvalu'),('TW','Taiwán'),('TZ','Tanzania'),('UA','Ucrania'),('UG','Uganda'),('UM','Islas ultramarinas de Estados Unidos'),('US','Estados Unidos'),('UY','Uruguay'),('UZ','Uzbekistán'),('VA','Ciudad del Vaticano'),('VC','San Vicente y las Granadinas'),('VE','Venezuela'),('VG','Islas Vírgenes Británicas'),('VI','Islas Vírgenes de los Estados Unidos'),('VN','Vietnam'),('VU','Vanuatu'),('WF','Wallis y Futuna'),('WS','Samoa'),('YE','Yemen'),('YT','Mayotte'),('ZA','Sudáfrica'),('ZM','Zambia'),('ZW','Zimbabue');
/*!40000 ALTER TABLE `tbl_Pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_PerfilPro`
--

DROP TABLE IF EXISTS `tbl_PerfilPro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_PerfilPro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersona` (`idPersona`),
  CONSTRAINT `tbl_PerfilPro_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `tbl_Persona` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_Persona`
--

DROP TABLE IF EXISTS `tbl_Persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Persona` (
  `id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwd` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dui` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaNac` date DEFAULT NULL,
  `sexo` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `pais` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depto` int(11) DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `zip` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dir` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `curriculum` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idEstado` (`idEstado`),
  CONSTRAINT `tbl_Persona_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `tbl_EstadoCivil` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_Preferencias`
--

DROP TABLE IF EXISTS `tbl_Preferencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Preferencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPersona` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `situacion` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salarioMin` decimal(10,2) DEFAULT NULL,
  `depto` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idPersona` (`idPersona`),
  CONSTRAINT `tbl_Preferencias_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `tbl_Persona` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_Testimonios`
--

DROP TABLE IF EXISTS `tbl_Testimonios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_Testimonios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpresa` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonio` varchar(280) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_Testimonios_ibfk_1` (`idEmpresa`),
  CONSTRAINT `tbl_Testimonios_ibfk_1` FOREIGN KEY (`idEmpresa`) REFERENCES `tbl_Empresa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_TipoContrato`
--

DROP TABLE IF EXISTS `tbl_TipoContrato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_TipoContrato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_TipoContrato`
--

LOCK TABLES `tbl_TipoContrato` WRITE;
/*!40000 ALTER TABLE `tbl_TipoContrato` DISABLE KEYS */;
INSERT INTO `tbl_TipoContrato` VALUES (1,'Contrato de Aprendizaje'),(2,'Contrato de obra o labor'),(3,'Por tiempo determinado'),(4,'Por tiempo indefinido'),(5,'Otro tipo de contrato');
/*!40000 ALTER TABLE `tbl_TipoContrato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_TipoLinks`
--

DROP TABLE IF EXISTS `tbl_TipoLinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_TipoLinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_TipoLinks`
--

LOCK TABLES `tbl_TipoLinks` WRITE;
/*!40000 ALTER TABLE `tbl_TipoLinks` DISABLE KEYS */;
INSERT INTO `tbl_TipoLinks` VALUES (1,'Facebook'),(2,'Twitter'),(3,'Google Plus'),(4,'LinkedIn'),(5,'Link');
/*!40000 ALTER TABLE `tbl_TipoLinks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ValoresEmpresa`
--

DROP TABLE IF EXISTS `tbl_ValoresEmpresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_ValoresEmpresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpresa` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_ValoresEmpresa_ibfk_1` (`idEmpresa`),
  CONSTRAINT `tbl_ValoresEmpresa_ibfk_1` FOREIGN KEY (`idEmpresa`) REFERENCES `tbl_Empresa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-25 19:48:49
