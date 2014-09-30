-- MySQL dump 10.13  Distrib 5.6.19, for Win64 (x86_64)
--
-- Host: localhost    Database: sophie_bc_245
-- ------------------------------------------------------
-- Server version	5.6.19

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
-- Table structure for table `catalogs`
--

DROP TABLE IF EXISTS `catalogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catalogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateReleased` datetime DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateLastModified` datetime DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `_current` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalogs`
--

LOCK TABLES `catalogs` WRITE;
/*!40000 ALTER TABLE `catalogs` DISABLE KEYS */;
INSERT INTO `catalogs` VALUES (1,'2014-09-18 00:00:00','2014-09-18 00:00:00','2014-09-18 00:00:00','Catalog 70',1);
/*!40000 ALTER TABLE `catalogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `zipcode` varchar(5) DEFAULT NULL,
  `provinceId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Cities_Provinces1_idx` (`provinceId`),
  CONSTRAINT `fk_Cities_Provinces1` FOREIGN KEY (`provinceId`) REFERENCES `provinces` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Lapu-lapu','6015',1),(2,'Mandaue','6014',1),(3,'Cebu','6000',1),(4,'Cordova','6017',1);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memberCode` varchar(10) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `sponsorId` int(11) DEFAULT NULL,
  `_active` tinyint(1) DEFAULT '1',
  `homePhone` varchar(13) DEFAULT NULL,
  `mobilePhone` varchar(13) DEFAULT NULL,
  `emailAddress` varchar(100) DEFAULT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `cityId` int(11) DEFAULT NULL,
  `dateJoined` datetime DEFAULT NULL,
  `sponsorCode` varchar(45) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `memberCode_UNIQUE` (`memberCode`),
  KEY `fk_Members_Cities1_idx` (`cityId`),
  KEY `fk_Member_Member1_idx` (`sponsorId`),
  CONSTRAINT `fk_Member_Member1` FOREIGN KEY (`sponsorId`) REFERENCES `members` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `fk_Members_Cities1` FOREIGN KEY (`cityId`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'30199376','Fefimina Bensi','Mansueto','',1,1,'','','','','',1,'2014-09-30 00:00:00','30199391','Partner\r\n'),(2,'30321386','Wilmer Marangao','Inting','',1,1,'','9238273994','','','',1,'2014-09-30 00:00:01','30315312','Franchise'),(3,'30348295','Mary Grace Englis','Agnes','',1,1,'','9323354155','','','',1,'2014-09-30 00:00:02','30321850','Franchise'),(4,'30529415','Imee Mendoza','Payao','',1,1,'','9064492602','','','',1,'2014-09-30 00:00:03','30503342','Partner'),(5,'30575783','Maylin Avanzado','Ligad','',1,1,'','9158471578','','','',1,'2014-09-30 00:00:04','30567728','Partner'),(6,'30576566','Romie Po','Lee','',1,1,'','9328840180','','','',1,'2014-09-30 00:00:05','30567720','Partner'),(7,'30576571','Florenda Monsanto','Tan','',1,1,'','9156808701','','','',1,'2014-09-30 00:00:06','30576591','Franchise'),(8,'30600149','Marichu Atregenio','Bustamante','',1,1,'','9056604181','','','',1,'2014-09-30 00:00:07','30600151','Partner'),(9,'30600150','Jo-Ann Pregoner','Tomada','',1,1,'','9209463431','','','',1,'2014-09-30 00:00:08','30600151','Partner'),(10,'30600151','Jonie Belga','Gusinalem','',1,1,'','9173280814','','','',1,'2014-09-30 00:00:09','30604987','Franchise'),(11,'30600154','Hannah Dungog','Tse','',1,1,'','9159008566','','','',1,'2014-09-30 00:00:10','30606714','Partner'),(12,'30600155','Jovic Canillas','Gilbaliga','',1,1,'','9333349571','','','',1,'2014-09-30 00:00:11','30600151','Partner'),(13,'30600156','Natasha Paola Baldove','Jimenez','',1,1,'','9173102669','','','',1,'2014-09-30 00:00:12','30606714','Partner'),(14,'30600159','Marietone Tangarorang','Alcordo','',1,1,'','9228878426','','','',1,'2014-09-30 00:00:13','30606714','Partner'),(15,'30602714','Maricel Silawan','Mingay','',1,1,'','9173012190','','','',1,'2014-09-30 00:00:14','30556168','Partner'),(16,'30602750','Julito Cutin','Talictic','',1,1,'','9996104735','','','',1,'2014-09-30 00:00:15','30602714','Partner'),(17,'30604987','Carlos Jr Badiang','Banawan','',1,1,'','9236289044','','','',1,'2014-09-30 00:00:16','30311118','Gold F'),(18,'30606695','Leizel Salomon','Buagas','',1,1,'','9173233174','','','',1,'2014-09-30 00:00:17','30604987','Partner'),(19,'30606696','Raissa Veloso','Lofranco','',1,1,'','9173058638','','','',1,'2014-09-30 00:00:18','30604987','Franchise'),(20,'30606700','Laarmie Andagao','Limba','',1,1,'','9092758276','','','',1,'2014-09-30 00:00:19','30604987','Partner'),(21,'30606714','Mark Chester Puno','Albutra','',1,1,'','9322603245','','','',1,'2014-09-30 00:00:20','30604987','Franchise'),(22,'30606721','Owen Neo','Lagula','',1,1,'','9998856014','','','',1,'2014-09-30 00:00:21','30604987','Franchise'),(23,'30606740','Jamaica Marie Ziga','Casia','',1,1,'','9322192279','','','',1,'2014-09-30 00:00:22','30604987','Partner'),(24,'30608023','Patricio Jr. Sunico','Flores','',1,1,'','9053161012','','','',1,'2014-09-30 00:00:23','30600151','Partner'),(25,'30608024','Mona Lisa Ruelan','Dosdos','',1,1,'','9333920306','','','',1,'2014-09-30 00:00:24','30604987','Partner'),(26,'30608025','Julieta Rollon','Fuentes','',1,1,'','9325971727','','','',1,'2014-09-30 00:00:25','30604987','Partner'),(27,'30608026','Evella Demit','Durango','',1,1,'','9283857738','','','',1,'2014-09-30 00:00:26','30604987','Partner'),(28,'30608028','Juliet Ca¥Ada','Sarusal','',1,1,'','9333061277','','','',1,'2014-09-30 00:00:27','30604987','Partner'),(29,'30608029','Maricel Machica','Lariosa','',1,1,'','9213561897','','','',1,'2014-09-30 00:00:28','30604987','Partner'),(30,'30608207','Eunice Pe¥Alosa','Villoria','',1,1,'','9177091103','','','',1,'2014-09-30 00:00:29','30600151','Partner'),(31,'30608208','Derick Miraflor','Avellana','',1,1,'','9174863021','','','',1,'2014-09-30 00:00:30','30600151','Partner'),(32,'30608209','Estelle Fe Almazan','Palomares','',1,1,'','9284066728','','','',1,'2014-09-30 00:00:31','30604987','Partner'),(33,'30608212','Marife Wagwag','Oyao','',1,1,'','9496976017','','','',1,'2014-09-30 00:00:32','30604987','Partner'),(34,'30608213','Rosalina Mabalcon','Sta.Ana','',1,1,'','9299041255','','','',1,'2014-09-30 00:00:33','30604987','Partner'),(35,'30608214','Carl Jan Badiang','Banawan','',1,1,'','9177187538','','','',1,'2014-09-30 00:00:34','30604987','Franchise'),(36,'30608215','Lourdes Pacubas','Leach','',1,1,'','9999031052','','','',1,'2014-09-30 00:00:35','30604987','Partner'),(37,'30608216','Alma Sambaan','Lacro','',1,1,'','9425693518','','','',1,'2014-09-30 00:00:36','30604987','Partner'),(38,'30608217','Hannah Nicart','Doble','',1,1,'','9393286337','','','',1,'2014-09-30 00:00:37','30600151','Partner'),(39,'30608240','Casil Farola','Rogaciano','',1,1,'','9994195608','','','',1,'2014-09-30 00:00:38','30604987','Partner'),(40,'30608925','Doreen Grace Licayan','Granada','',1,1,'','9072891774','','','',1,'2014-09-30 00:00:39','30606696','Partner'),(41,'30608926','Rizza Baba','Guzman','',1,1,'','9434449027','','','',1,'2014-09-30 00:00:40','30610187','Partner'),(42,'30608927','Caryl Badiana','Banawan','',1,1,'','9298036611','','','',1,'2014-09-30 00:00:41','30606696','Partner'),(43,'30608928','Amelita Florenosos','Genaro','',1,1,'','9082704596','','','',1,'2014-09-30 00:00:42','30610172','Partner'),(44,'30608930','Roshen May Ta¥Amor','Ta¥Amor','',1,1,'','9327237981','','','',1,'2014-09-30 00:00:43','30604987','Partner'),(45,'30609194','Maricris Gipala','Gorospe','',1,1,'','9399104300','','','',1,'2014-09-30 00:00:44','30600151','Partner'),(46,'30609197','Jojie Mae Belga','Vedad','',1,1,'','9155677673','','','',1,'2014-09-30 00:00:45','30600151','Partner'),(47,'30609217','John David Solibaga','Baltazar','',1,1,'','9161429583','','','',1,'2014-09-30 00:00:46','30604987','Partner'),(48,'30609218','Emelie Diamante','Anggoy','',1,1,'','9255007985','','','',1,'2014-09-30 00:00:47','30606696','Partner'),(49,'30609219','Danysse Tiffany Batutay','Te','',1,1,'','9432705731','','','',1,'2014-09-30 00:00:48','30604987','Partner'),(50,'30609225','Jade Naraja','Judaya','',1,1,'','9328860260','','','',1,'2014-09-30 00:00:49','30606714','Partner'),(51,'30609226','Lucilyn Olavidez','Tangian','',1,1,'','9985495905','','','',1,'2014-09-30 00:00:50','30606696','Partner'),(52,'30609227','Marechel Avergonzado','Baranda','',1,1,'','9325242675','','','',1,'2014-09-30 00:00:51','30604987','Partner'),(53,'30609232','Eli Marie Coquilla','Galon','',1,1,'','9321306112','','','',1,'2014-09-30 00:00:52','30606696','Partner'),(54,'30609238','Jenelyn Juezan','Delegencia','',1,1,'','9498255846','','','',1,'2014-09-30 00:00:53','30604987','Partner'),(55,'30609239','Jamaica Brazil','Rena','',1,1,'','9998879510','','','',1,'2014-09-30 00:00:54','30606696','Partner'),(56,'30609240','Samuel Allen De Leon','Samson','',1,1,'','9399104856','','','',1,'2014-09-30 00:00:55','30606714','Partner'),(57,'30610094','Marjorie Ann Cruz','Sta Maria','',1,1,'','9088178129','','','',1,'2014-09-30 00:00:56','30604987','Partner'),(58,'30610095','Jade Aldevera','Jamili','',1,1,'','9322359877','','','',1,'2014-09-30 00:00:57','30604987','Partner'),(59,'30610096','Mayamina Cerna','Dela Cruz','',1,1,'','9333635501','','','',1,'2014-09-30 00:00:58','30604987','Partner'),(60,'30610126','Rochelle Amen','Tan','',1,1,'','9193828006','','','',1,'2014-09-30 00:00:59','30604987','Partner'),(61,'30610127','Tom Jeremy Ylanan','Tan','',1,1,'','9183313748','','','',1,'2014-09-30 00:00:00','30606696','Partner'),(62,'30610129','Doyenne Faye Ara¥As','Barcebal','',1,1,'','9498103718','','','',1,'2014-09-30 00:00:00','30604987','Partner'),(63,'30610130','Jefferson Mag-Asin','Zabala','',1,1,'','9088661522','','','',1,'2014-09-30 00:00:00','30606714','Partner'),(64,'30610132','Leny Cifra','Comontas','',1,1,'','9331161820','','','',1,'2014-09-30 00:00:00','30600151','Partner'),(65,'30610133','Junny Avela','Estardo','',1,1,'','9239324431','','','',1,'2014-09-30 00:00:00','30604987','Partner'),(66,'30610140','Irish Benologa','Kadusale','',1,1,'','9209485405','','','',1,'2014-09-30 00:00:00','30610172','Partner'),(67,'30610141','Normalita Muyuela','Vergara','',1,1,'','9224661477','','','',1,'2014-09-30 00:00:00','30610133','Partner'),(68,'30610142','Meriam Natural','Anacta','',1,1,'','9235250566','','','',1,'2014-09-30 00:00:00','30610172','Partner'),(69,'30610152','Mark Lucky Tapia','Rebong','',1,1,'','9234129442','','','',1,'2014-09-30 00:00:00','30604987','Partner'),(70,'30610153','Vibelle Daphne Talipis','Iligan','',1,1,'','9222607967','','','',1,'2014-09-30 00:00:00','30604987','Franchise'),(71,'30610154','Kristel Marie De Los Angeles','Pitogo','',1,1,'','9225050021','','','',1,'2014-09-30 00:00:00','30606696','Partner'),(72,'30610155','Cyd Ogatis','Narciso','',1,1,'','9231496650','','','',1,'2014-09-30 00:00:00','30610172','Partner'),(73,'30610156','Claire Lequin','Cabier','',1,1,'','9266636726','','','',1,'2014-09-30 00:00:00','30610133','Partner'),(74,'30610159','Annabelloe Namoy','Mapa','',1,1,'','9173023553','','','',1,'2014-09-30 00:00:00','30604987','Partner'),(75,'30610160','Kristel Loubil Tumulak','Caballo','',1,1,'','9399134339','','','',1,'2014-09-30 00:00:00','30606696','Partner'),(76,'30610161','Daisy Anne Paez','Mauro','',1,1,'','9275265482','','','',1,'2014-09-30 00:00:00','30606696','Partner'),(77,'30610170','Josephine Tan','Uy','',1,1,'','9333377650','','','',1,'2014-09-30 00:00:00','30600151','Partner'),(78,'30610172','Maria Arcilla Ogatis','Narciso','',1,1,'','9238838054','','','',1,'2014-09-30 00:00:00','30604987','Partner'),(79,'30610187','Emerita Espinosa','Camasura','',1,1,'','9226752934','','','',1,'2014-09-30 00:00:00','30600151','Partner'),(80,'30610188','Jeannette Torres','Diloy','',1,1,'','9088861893','','','',1,'2014-09-30 00:00:00','30600151','Partner'),(81,'30615876','Marilou Da¥O','Arong','',1,1,'','9222407266','','','',1,'2014-09-30 00:00:00','30604987','Partner'),(82,'30615880','Luz Maria Venda Rulete','Suico','',1,1,'','9208717003','','','',1,'2014-09-30 00:00:00','30604987','Partner'),(83,'30615881','Michelle Tedor','Quitos','',1,1,'','9222170336','','','',1,'2014-09-30 00:00:00','30604987','Partner'),(84,'30617301','Eunice Dianne Biato','Lardizabal','',1,1,'','9496486974','','','',1,'2014-09-30 00:00:00','30604987','Partner'),(85,'30617302','Juliet Mata','Molina','',1,1,'','9327350440','','','',1,'2014-09-30 00:00:00','30604987','Partner'),(86,'30617312','Novie Jean Lusanta','Belleza','',1,1,'','9461801607','','','',1,'2014-09-30 00:00:00','30606721','Partner'),(87,'30617313','Liwayway Zabat','Mejia','',1,1,'','9163544907','','','',1,'2014-09-30 00:00:00','30604987','Partner'),(88,'30617314','Maricel Ebina','Domingo','',1,1,'','9392479668','','','',1,'2014-09-30 00:00:00','30604987','Partner'),(89,'30622147','Josilie Tumulak','Oyon-Oyon','',1,1,'','9231801796','','','',1,'2014-09-30 00:00:00','30604987','Partner'),(90,'30622152','Jen Pearl Bedran','Cabucos','',1,1,'','9229364142','','','',1,'2014-09-30 00:00:00','30604987','Partner'),(91,'30622164','Maria Joanah Ocubillo','Abella','',1,1,'','9435041543','','','',1,'2014-09-30 00:00:00','30604987','Partner');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memberspositions`
--

DROP TABLE IF EXISTS `memberspositions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `memberspositions` (
  `memberId` int(11) NOT NULL AUTO_INCREMENT,
  `positionId` int(11) NOT NULL,
  `dateCreated` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`memberId`,`positionId`),
  KEY `fk_Member_has_Position_Position1_idx` (`positionId`),
  KEY `fk_Member_has_Position_Member1_idx` (`memberId`),
  CONSTRAINT `fk_Member_has_Position_Member1` FOREIGN KEY (`memberId`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Member_has_Position_Position1` FOREIGN KEY (`positionId`) REFERENCES `positions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memberspositions`
--

LOCK TABLES `memberspositions` WRITE;
/*!40000 ALTER TABLE `memberspositions` DISABLE KEYS */;
/*!40000 ALTER TABLE `memberspositions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateLastModified` datetime DEFAULT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderDetailStatusId` int(11) NOT NULL,
  `discount` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_OrderDetails_Orders1_idx` (`orderId`),
  KEY `fk_OrderDetails_Products1_idx` (`productId`),
  KEY `fk_OrderDetails_OrderDetailStatus1_idx` (`orderDetailStatusId`),
  CONSTRAINT `fk_OrderDetails_OrderDetailStatus1` FOREIGN KEY (`orderDetailStatusId`) REFERENCES `orderdetailstatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_OrderDetails_Orders1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_OrderDetails_Products1` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderdetails`
--

LOCK TABLES `orderdetails` WRITE;
/*!40000 ALTER TABLE `orderdetails` DISABLE KEYS */;
INSERT INTO `orderdetails` VALUES (21,15,'2014-09-30 22:47:09','2014-09-30 22:47:09',756,1,1,30),(22,15,'2014-09-30 22:53:52','2014-09-30 22:53:52',174,1,1,30),(23,16,'2014-09-30 23:03:49','2014-09-30 23:03:49',311,2,1,30),(24,16,'2014-09-30 23:04:14','2014-09-30 23:04:14',346,5,1,30);
/*!40000 ALTER TABLE `orderdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderdetailstatus`
--

DROP TABLE IF EXISTS `orderdetailstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderdetailstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderdetailstatus`
--

LOCK TABLES `orderdetailstatus` WRITE;
/*!40000 ALTER TABLE `orderdetailstatus` DISABLE KEYS */;
INSERT INTO `orderdetailstatus` VALUES (1,'new','New order item',1);
/*!40000 ALTER TABLE `orderdetailstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreated` datetime DEFAULT NULL,
  `dateLastModified` datetime DEFAULT NULL,
  `memberId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `orderStatusId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Orders_Members1_idx` (`memberId`),
  KEY `fk_Orders_Users1_idx` (`userId`),
  KEY `fk_Orders_UpOrderStatus1_idx` (`orderStatusId`),
  CONSTRAINT `fk_Orders_Members1` FOREIGN KEY (`memberId`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Orders_UpOrderStatus1` FOREIGN KEY (`orderStatusId`) REFERENCES `orderstatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Orders_Users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (15,'2014-09-30 22:46:49','2014-09-30 22:46:49',10,1,4),(16,'2014-09-30 23:03:13','2014-09-30 23:03:13',20,1,4);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderstatus`
--

DROP TABLE IF EXISTS `orderstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderstatus`
--

LOCK TABLES `orderstatus` WRITE;
/*!40000 ALTER TABLE `orderstatus` DISABLE KEYS */;
INSERT INTO `orderstatus` VALUES (1,'New','Order is placed in Business Center',1),(2,'Placed','Order is placed in HQ',1),(3,'Cancelled','Order is cancelled',1),(4,'Temporary','Order is on-hold',1);
/*!40000 ALTER TABLE `orderstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderstatushistory`
--

DROP TABLE IF EXISTS `orderstatushistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderstatushistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreated` datetime DEFAULT NULL,
  `dateLastModified` datetime DEFAULT NULL,
  `orderId` int(11) NOT NULL,
  `orderStatusId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_OrderStatusHistory_Orders1_idx` (`orderId`),
  KEY `fk_OrderStatusHistory_OrderStatus1_idx` (`orderStatusId`),
  KEY `fk_OrderStatusHistory_Users1_idx` (`userId`),
  CONSTRAINT `fk_OrderStatusHistory_Orders1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_OrderStatusHistory_OrderStatus1` FOREIGN KEY (`orderStatusId`) REFERENCES `orderstatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_OrderStatusHistory_Users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderstatushistory`
--

LOCK TABLES `orderstatushistory` WRITE;
/*!40000 ALTER TABLE `orderstatushistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderstatushistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreated` datetime DEFAULT NULL,
  `dateLastModified` datetime DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `paymentTypeId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Payments_Orders1_idx` (`orderId`),
  KEY `fk_Payments_Users1_idx` (`userId`),
  KEY `fk_Payments_PaymentTypes1_idx` (`paymentTypeId`),
  CONSTRAINT `fk_Payments_Orders1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Payments_PaymentTypes1` FOREIGN KEY (`paymentTypeId`) REFERENCES `paymenttypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Payments_Users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (5,'2014-09-30 16:48:12',NULL,150,15,1,NULL,1),(6,'2014-09-30 16:54:09',NULL,525,15,1,NULL,1),(7,'2014-09-30 17:04:29',NULL,377.5,16,1,NULL,1),(8,'2014-09-30 17:05:23',NULL,151,16,1,NULL,1);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paymenttypes`
--

DROP TABLE IF EXISTS `paymenttypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paymenttypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paymenttypes`
--

LOCK TABLES `paymenttypes` WRITE;
/*!40000 ALTER TABLE `paymenttypes` DISABLE KEYS */;
INSERT INTO `paymenttypes` VALUES (1,'deposit','Initial deposit to order'),(2,'full-payment','Full payment of order');
/*!40000 ALTER TABLE `paymenttypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `desciption` varchar(45) DEFAULT NULL,
  `dateCreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `dateLastModified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productgroups`
--

DROP TABLE IF EXISTS `productgroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productgroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `parentId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ProductGroups_FK_1_idx` (`parentId`),
  CONSTRAINT `ProductGroups_FK_1` FOREIGN KEY (`parentId`) REFERENCES `productgroups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productgroups`
--

LOCK TABLES `productgroups` WRITE;
/*!40000 ALTER TABLE `productgroups` DISABLE KEYS */;
INSERT INTO `productgroups` VALUES (1,'accessories','Accessories',NULL),(2,'bag','Bag',NULL),(3,'belt','Belt',NULL),(4,'cosmetics','Cosmetics',NULL),(5,'footwear','Footwear',NULL),(6,'garment','Garment',NULL),(7,'home_sweet_home','Home Sweet Home',NULL),(8,'sunglasses','Sunglasses',NULL),(9,'wallet','Wallet',NULL),(10,'watch','Watch',NULL),(17,'souvenir','Souvenir',NULL);
/*!40000 ALTER TABLE `productgroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) NOT NULL,
  `description` varchar(225) DEFAULT NULL,
  `catalogPrice` double DEFAULT NULL,
  `netPriceDiscount` double DEFAULT '30',
  `stocksOnHand` int(11) DEFAULT NULL,
  `productGroupId` int(11) NOT NULL,
  `catalogId` int(11) NOT NULL,
  `_outOfStocksUp` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_Products_ProductGroups1_idx` (`productGroupId`),
  KEY `fk_Products_Catalogs1_idx` (`catalogId`),
  CONSTRAINT `fk_Products_Catalogs1` FOREIGN KEY (`catalogId`) REFERENCES `catalogs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Products_ProductGroups1` FOREIGN KEY (`productGroupId`) REFERENCES `productgroups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=844 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'B0215','JUANITA',240,30,0,1,1,0),(2,'B0228','ZEINA BRACELET',220,30,0,1,1,0),(3,'E0154','TYWNA EARING',240,30,0,1,1,0),(4,'HDL1','LANIERE BLACK HANDLE',140,30,0,1,1,0),(5,'ESAS067','FIXIE EARING',190,30,0,1,1,0),(6,'NSAS0107','FANCY NECKLACE',280,30,0,1,1,0),(7,'HDL2CT','LANIERE BROWN HANDLE',140,30,0,1,1,0),(8,'KL133','TIRAL NECKLACE',150,30,0,1,1,0),(9,'B0242','BETHARI BRACELET',360,30,0,1,1,0),(10,'B0259','FRILY BRACELET',280,30,0,1,1,0),(11,'N00231','CROSS NECKLACE',290,30,0,1,1,0),(12,'E0157','BRAXTON EARING',250,30,0,1,1,0),(13,'E0158','BRYNDI EARING',190,30,0,1,1,0),(14,'E0163','FELISHA EARING',220,30,0,1,1,0),(15,'GSAS88','FUSCHIA BRACELET',230,30,0,1,1,0),(16,'JKESB81','FAUSIE BRACELET',390,30,0,1,1,0),(17,'JOSET','JOLINA HAIR SET',280,30,0,1,1,0),(18,'N00304','JOLANDA NECKLACE',390,30,0,1,1,0),(19,'N00319','TARISA NECKLACE',390,30,0,1,1,0),(20,'N00329','TIVONA NECKLACE',290,30,0,1,1,0),(21,'N00330','ZARYA NECKLACE',390,30,0,1,1,0),(22,'N00342','TARANE NECKLACE',220,30,0,1,1,0),(23,'NSAS0103','ZEHARI NECKLACE',420,30,0,1,1,0),(24,'N00347','BASSKA NECKLACE',220,30,0,1,1,0),(25,'N00348','BEVERLY NECKLACE',360,30,0,1,1,0),(26,'N00349','BREMY NECKLACE',280,30,0,1,1,0),(27,'N00352','BHAVYA NECKLACE',260,30,0,1,1,0),(28,'N00354','BREANA NECKLACE',220,30,0,1,1,0),(29,'N00355','BRANTI NECKLACE',260,30,0,1,1,0),(30,'N00367','BLUMA NECKLACE',260,30,0,1,1,0),(31,'N00370','FAMY NECKLACE',220,30,0,1,1,0),(32,'N00373','FARLEY NECKLACE',260,30,0,1,1,0),(33,'R397','TANGELA RING',320,30,0,1,1,0),(34,'R40615','TRUDY RING 15',390,30,0,1,1,0),(35,'R40616','TRUDY RING 16',390,30,0,1,1,0),(36,'R40617','TRUDY RING 17',390,30,0,1,1,0),(37,'R40715','TRINA RING 15',220,30,0,1,1,0),(38,'R40716','TRINA RING 16',220,30,0,1,1,0),(39,'R40717','TRINA RING 17',220,30,0,1,1,0),(40,'R40815','TRIXIE RING 15',220,30,0,1,1,0),(41,'R40816','TRIXIE RING 16',220,30,0,1,1,0),(42,'R40817','TRIXIE RING 17',220,30,0,1,1,0),(43,'R41415','BOYCE RING 15',220,30,0,1,1,0),(44,'R41416','BOYCE RING 16',200,30,0,1,1,0),(45,'R41417','BOYCE RING 17',220,30,0,1,1,0),(46,'R41615','BREDA RING 15',190,30,0,1,1,0),(47,'R41616','BREDA RING 16',190,30,0,1,1,0),(48,'R41617','BREDA RING 17',190,30,0,1,1,0),(49,'R42315','BIANCA RING 15',220,30,0,1,1,0),(50,'R42316','BIANCA RING 16',220,30,0,1,1,0),(51,'R42317','BIANCA RING 17',220,30,0,1,1,0),(52,'R42715','BEVIS RING 15',260,30,0,1,1,0),(53,'R42716','BEVIS RING 16',260,30,0,1,1,0),(54,'R42717','BEVIS RING 17',260,30,0,1,1,0),(55,'R43015','FILIA RING 15',190,30,0,1,1,0),(56,'R43016','FILIA RING 16',190,30,0,1,1,0),(57,'R43017','FILIA RING 17',190,30,0,1,1,0),(58,'R43115','FARVA RING 15',190,30,0,1,1,0),(59,'R43116','FARVA RING 16',190,30,0,1,1,0),(60,'R43117','FARVA RING 17',190,30,0,1,1,0),(61,'JKESB74','BLAKE BRACELET',590,30,0,1,1,0),(62,'JKESB77','BREVYN BRACELET',590,30,0,1,1,0),(63,'JKESB79','VARUNA BRACELET',890,30,0,1,1,0),(64,'JKR03315','FETHA RING 15',220,30,0,1,1,0),(65,'JKR03316','FETHA RING 16',220,30,0,1,1,0),(66,'JKR03317','FETHA RING 17',190,30,0,1,1,0),(67,'JKSN30','FARDIS NECKLACE',260,30,0,1,1,0),(68,'N1019','MOITURUER BAG',690,30,0,2,1,0),(69,'N1020','DUVET BAG',1390,30,0,2,1,0),(70,'N1016','ONDULANT BAG',890,30,0,2,1,0),(71,'N1024','MARIONETTE BAG',840,30,0,2,1,0),(72,'BKSGL25','LAGRASSE BAG',1090,30,0,2,1,0),(73,'BKSGL27','SEUDRE BAG',1090,30,0,2,1,0),(74,'COGL4','CAMARA BAG',1190,30,0,2,1,0),(75,'COGL5','CRINOLE BAG',720,30,0,2,1,0),(76,'COGL6','CHEVE BAG',820,30,0,2,1,0),(77,'CH41FL','BERLOU BAG',1420,30,0,2,1,0),(78,'CH45FL','FERRON BAG',890,30,0,2,1,0),(79,'GLBT36','CAVEY BAG',1390,30,0,2,1,0),(80,'GLBT37','LAVIGNE BAG',1290,30,0,2,1,0),(81,'CL115HV','CASTANET BAG',1890,30,0,2,1,0),(82,'CL117CN','FINISTERE',1920,30,0,2,1,0),(83,'CL118CF','ADRIENNE BAG',1590,30,0,2,1,0),(84,'CLLT10','ALBERTA BAG',1390,30,0,2,1,0),(85,'LFB156','EPINE BAG',1290,30,0,2,1,0),(86,'LFB159','SOUCI BAG',990,30,0,2,1,0),(87,'LL10BS','DROLE BAG',1290,30,0,2,1,0),(88,'LL435CL','ROCAMADOUR BAG',1090,30,0,2,1,0),(89,'LL457CL','REBLOCHON BAG',790,30,0,2,1,0),(90,'DDRCL2','CACHET BAG',2340,30,0,2,1,0),(91,'DJ5MR','CEFFIA BAG',990,30,0,2,1,0),(92,'GL73BR','RIVIERE BAG',920,30,0,2,1,0),(93,'GL78OR','CHATEAUVERT',1990,30,0,2,1,0),(94,'GL82GRB','BADAILHAC BAG',1890,30,0,2,1,0),(95,'GL83BR','EN VIMEU BAG',1390,30,0,2,1,0),(96,'LL546B','RIGOTTE BAG',1490,30,0,2,1,0),(97,'LL9BS','FOURME BAG',940,30,0,2,1,0),(98,'GLBT14','THIERRY BAG',1390,30,0,2,1,0),(99,'GLBT35','BANDIAT',1020,30,0,2,1,0),(100,'GSCL6','REINE',1890,30,0,2,1,0),(101,'LFB150','BOUTONNE BAG',990,30,0,2,1,0),(102,'N1034','TANIRE BAG',1190,30,0,2,1,0),(103,'LFB152','AUTOIRE BAG',960,30,0,2,1,0),(104,'NM10FBK','HELLEBORE BAG',590,30,0,2,1,0),(105,'LFB154','ACOLIN BAG',1090,30,0,2,1,0),(106,'LFB155','TARDES BAG',1090,30,0,2,1,0),(107,'LL462','KOENIGSBOURG BAG',1390,30,0,2,1,0),(108,'LL481','BURGSTALL BAG',1090,30,0,2,1,0),(109,'NM20FBK','FLORETTA TRAVEL SET',1690,30,0,2,1,0),(110,'NM27FBK','SCHMITT BAG',1090,30,0,2,1,0),(111,'LL503DM','BILLIO',990,30,0,2,1,0),(112,'SG30LG','ROCUEFORT BAG',990,30,0,2,1,0),(113,'BRMCS1','BAIGNEAUX BAG',1490,30,0,2,1,0),(114,'LL504NV','VALBERG BAG',840,30,0,2,1,0),(115,'LL505NV','ELORN BAG',990,30,0,2,1,0),(116,'COGL2','BANNEGON BAG',1490,30,0,2,1,0),(117,'CSN108BU','BALMONT BAG',1290,30,0,2,1,0),(118,'LL508EM','BLANZY BAG',1290,30,0,2,1,0),(119,'LL512RS','DAUENDORF',1090,30,0,2,1,0),(120,'LL514FS','PONTHIEU BAG',1090,30,0,2,1,0),(121,'LL515DR','MENERBESTY BAG',1240,30,0,2,1,0),(122,'LL516NV','QUARTIER BAG',940,30,0,2,1,0),(123,'LL517NV','CHATENAY BAG',1040,30,0,2,1,0),(124,'LL519RS','CANAVILLES BAG',1190,30,0,2,1,0),(125,'LL520RS','PASSAVANT BAG',1590,30,0,2,1,0),(126,'LL521DR','BANTHELU BAG',1340,30,0,2,1,0),(127,'LL523FS','MONTMIRAL BAG',890,30,0,2,1,0),(128,'LL526DSP','CROTTIN BAG',1240,30,0,2,1,0),(129,'LL528','BONNIEURE BAG',1090,30,0,2,1,0),(130,'LL530','GRUYERE BAG',990,30,0,2,1,0),(131,'LL7BS','LA FORET BAG',890,30,0,2,1,0),(132,'LMGL5','ACHEVILLE BAG',940,30,0,2,1,0),(133,'LL534DR','DIGNAC BAG',840,30,0,2,1,0),(134,'LL535DR','BARJOUVILLE BAG',1290,30,0,2,1,0),(135,'LL536RS','ROQUESTERON BAG',1090,30,0,2,1,0),(136,'LL539FS','ALLIERES BAG',1190,30,0,2,1,0),(137,'LL540SPC','DONZENAC BAG',1090,30,0,2,1,0),(138,'LL541SPC','BEAUGENCY BAG',1390,30,0,2,1,0),(139,'LL542NV','BANNONCOURT BAG',1190,30,0,2,1,0),(140,'LL544MC','CARLEPONT BAG',1090,30,0,2,1,0),(141,'LMGL6','LES THESY BAG',1290,30,0,2,1,0),(142,'LT635CT','NEO HARTWELL',890,30,0,2,1,0),(143,'LT815','BIRON BAG',590,30,0,2,1,0),(144,'LMGL7','AISEREY BAG',1190,30,0,2,1,0),(145,'LT827','SAUJON BAG',640,30,0,2,1,0),(146,'LT836K','DOURGES BAG',1090,30,0,2,1,0),(147,'LT833','LAGUIOLE BAG',990,30,0,2,1,0),(148,'LT834','BOURBINCE BAG',990,30,0,2,1,0),(149,'ML105C','CERNON BAG',490,30,0,2,1,0),(150,'ML189MC','CRAONELLE BAG',1090,30,0,2,1,0),(151,'ML190MC','DUTTLEINHEIM BAG',790,30,0,2,1,0),(152,'ML191MC','ALLAMONT BAG',990,30,0,2,1,0),(153,'ML186MB','DARNILES BAG',550,30,0,2,1,0),(154,'ML187MB','VALENCE BAG',940,30,0,2,1,0),(155,'MR30GL','CARROIS BAG',990,30,0,2,1,0),(156,'NM28FBL','BADEFOLS BAG',940,30,0,2,1,0),(157,'NM31FTS','SEGURET BAG',890,30,0,2,1,0),(158,'NM32FBL','CAUVIGNY BAG',1090,30,0,2,1,0),(159,'NM33FBL','BEAUCHAMP BAG',890,30,0,2,1,0),(160,'NM34FTS','BARQUET BAG',1090,30,0,2,1,0),(161,'NM39FBL','ANDELLAROT BAG',1890,30,0,2,1,0),(162,'NM45FTS','CAMBOULAZET BAG',990,30,0,2,1,0),(163,'NM46FSCR','CAMURAC BAG',1240,30,0,2,1,0),(164,'NM47FSCR','BAR LE DUC BAG',1090,30,0,2,1,0),(165,'NM48FSCR','DOURDAN BAG',390,30,0,2,1,0),(166,'N974','BLESLE BAG',1190,30,0,2,1,0),(167,'NM11FBK','ROYA BAG',690,30,0,2,1,0),(168,'NM11FOR','TROIS BAG',1090,30,0,2,1,0),(169,'NM12FBK','HUNSPACH BAG',690,30,0,2,1,0),(170,'NM12FTS','MARTORY SET BAG',1890,30,0,2,1,0),(171,'NM13FBK','AIGUEZE',790,30,0,2,1,0),(172,'N1005','CURT BAG',690,30,0,2,1,0),(173,'N1006','BERNYCE BAG',690,30,0,2,1,0),(174,'NM15FBK','DIGNE BAG',890,30,0,2,1,0),(175,'NM6FBK','BEUVRON BAG',640,30,0,2,1,0),(176,'DTSCL12','NEO CIVIERES BAG',1990,30,0,2,1,0),(177,'NM7FBL','FOLLETIERE',790,30,0,2,1,0),(178,'GL81BD','NEO RIANS BAG',1790,30,0,2,1,0),(179,'RT11GL','SAUVEUR',1790,30,0,2,1,0),(180,'GL90SK','BARRAUTE BAG',2490,30,0,2,1,0),(181,'GL91BD','MONTAUROUX BAG',2290,30,0,2,1,0),(182,'SG14LDB','DIEULEFIT BAG',2220,30,0,2,1,0),(183,'SG15LS','EN QUERCY BAG',1190,30,0,2,1,0),(184,'SG20LDB','ATLANTIQUES BAG',2190,30,0,2,1,0),(185,'SG22LC','BARBIREY BAG',1690,30,0,2,1,0),(186,'SG25CB','BACHOS BAG',1960,30,0,2,1,0),(187,'SG28LDB','AAST BAG',2890,30,0,2,1,0),(188,'SG16LG','SARRAZIN BAG',1340,30,0,2,1,0),(189,'SG4LC','BANNAY BAG',1960,30,0,2,1,0),(190,'SG17LS','ACCONS BAG',1090,30,0,2,1,0),(191,'SL356','BELGEARD BAG',2790,30,0,2,1,0),(192,'SG2LC','BALIZAC',2300,30,0,2,1,0),(193,'SG3LC','DESTRY BAG',2190,30,0,2,1,0),(194,'SG5LG','DU LOUP',1090,30,0,2,1,0),(195,'SL11MRT','CHALICE BAG',1840,30,0,2,1,0),(196,'SL351','BEAUZELLE',1690,30,0,2,1,0),(197,'SL9MRT','APOLLINE BAG',1590,30,0,2,1,0),(198,'SSGLT1','LOUMASSES BAG',2190,30,0,2,1,0),(199,'SSGLT2','LAPALUD BAG',1690,30,0,2,1,0),(200,'CLMKY2','ADELIE BAG',2190,30,0,2,1,0),(201,'CLMKY3','ADELAIDE BAG',2090,30,0,2,1,0),(202,'DTSCL10','COSETTE BAG',1990,30,0,2,1,0),(203,'SSGLT3','OSANNE BAG',1190,30,0,2,1,0),(204,'TGL1','CHARMAINE BAG',1770,30,0,2,1,0),(205,'TBRL16','ADELINE BAG',2090,30,0,2,1,0),(206,'TVS18','NEO AMI SET',1290,30,0,2,1,0),(207,'IPFER','FERNAND BELT',420,30,0,3,1,0),(208,'IPNP','NEO PETER BELT',990,30,0,3,1,0),(209,'IPFC','FELICIA BELT',320,30,0,3,1,0),(210,'IPFY','FAYE BELT',360,30,0,3,1,0),(211,'IPTR','TRINETTA BELT',290,30,0,3,1,0),(212,'IPFLR','FLORA BELT',320,30,0,3,1,0),(213,'IPFN','FAUNIA BELT',320,30,0,3,1,0),(214,'IPFT','FANTINE BELT',440,30,0,3,1,0),(215,'CPK1','COMPACT PWDR TRANSLUCENT KLG',160,30,0,4,1,0),(216,'FDFSP','SOPHIE PARIS FOOT SPRAY',150,30,0,4,1,0),(217,'IHBW','SP INVINCIBLE HAIR & BODY WASH',195,30,0,4,1,0),(218,'KBLH2','KOSHIZE BLUSH ON PINK DELIGHT',460,30,0,4,1,0),(219,'KBLH3','KOSHIZE BLUSH ON BROWN BERRY',460,30,0,4,1,0),(220,'KCP1','KOSHIZE COMPACT PWD PINK TOUCH',260,30,0,4,1,0),(221,'KCP2','KOSHIZE COM PWD FAIR PORCELAIN',260,30,0,4,1,0),(222,'KDCL1','KOSHIZE DBL CORE LIPS-M.GARNET',320,30,0,4,1,0),(223,'KDCL2','KOSHIZE DBL CORE LP-POP.CHERRY',320,30,0,4,1,0),(224,'KDCL3','KOSHIZE DBL CORE LP-CORAL KISS',320,30,0,4,1,0),(225,'LCHLP1','KLUGE CHUB LIPS TEENAGE DREAM',180,30,0,4,1,0),(226,'LCHLP2','KLUGE CHUBBY LIPS LOVE STORY',180,30,0,4,1,0),(227,'LCHLP3','KLG CHUB LIPS CALIFORNIA GIRLS',180,30,0,4,1,0),(228,'OJOA1','OJO AIMI EDP 15ML BRANCH',390,30,0,4,1,0),(229,'OJOH1','OJO HIKARU EDP 15 ML BRANCH',390,30,0,4,1,0),(230,'OJOS1','OJO DOLL KEIKO EDP 15ML BRANCH',390,30,0,4,1,0),(231,'KDCL4','KOSHIZE DBL CORE LP-SOFT ROSE',320,30,0,4,1,0),(232,'KDPE1','KOSHIZE DUO PRFC ES GRGS PINK',320,30,0,4,1,0),(233,'KDPE2','KOSHIZE DUO PRFC ES ELGNT BLUE',320,30,0,4,1,0),(234,'KDPE3','KOSHIZE DUO PRFC ES GLDN BRNZE',320,30,0,4,1,0),(235,'KDPE4','KOSHIZE DUO PRFC ES INTS GREY',320,30,0,4,1,0),(236,'KDPE5','KOSHIZE DUO PRFC ES HOT BROWN',320,30,0,4,1,0),(237,'KEBL2','KOSHIZE EYBROW LINER TRUE BLAC',150,30,0,4,1,0),(238,'SRCS','SKIN RADIANT COLLAGEN SERUM',360,30,0,4,1,0),(239,'KEL1','KZ EYELINER INTENSE BLACK',150,30,0,4,1,0),(240,'KEL2','KZ EYELINER DEEP BROWN',150,30,0,4,1,0),(241,'KEPE','KZ EYEPRCISION WATRPRF EYELINR',295,30,0,4,1,0),(242,'KLL1','KZ LIPLINER EXQUISITE RED',150,30,0,4,1,0),(243,'KLL2','KZ LIPLINER SPLENDID BROWN',150,30,0,4,1,0),(244,'KNL1','KOSHIZE NUTRLIPS PEACHY PINK',240,30,0,4,1,0),(245,'FDFSC','SOPHIE PARIS FOOT SCRUB',180,30,0,4,1,0),(246,'IMFW','INVNCBLE FOR MEN FCL WASH 50ML',120,30,0,4,1,0),(247,'QFFM','QUICK FRESH FACE MIST 60 ML',85,30,0,4,1,0),(248,'KNL10','KOSHIZE NUTRILIPS SCENTED TERR',240,30,0,4,1,0),(249,'KNL2','KOSHIZE NUTRLIPS PINK MASQUERA',240,30,0,4,1,0),(250,'KNL3','KOSHIZE NUTRILIPS HEARTBEATRED',240,30,0,4,1,0),(251,'KNL4','KOSHIZE NUTRLIPS AMAZING RED',240,30,0,4,1,0),(252,'KNL5','KOSHIZE NUTRLIPS ICED CRANBERY',240,30,0,4,1,0),(253,'KNL6','KOSHIZE NUTRILIPS RED VICTORY',240,30,0,4,1,0),(254,'KNL7','KOSHIZE NUTRILIPS COLONIAL RED',240,30,0,4,1,0),(255,'KNL8','KOSHIZE NUTRILIPS PASSION PINK',240,30,0,4,1,0),(256,'KNL9','KOSHIZE NUTRILIPS RACY PINK',240,30,0,4,1,0),(257,'KNLML','KOSHIZE NUTRILIPS MINI LIPSTIC',280,30,0,4,1,0),(258,'KSL1','KZ SATINLIPS DRAMATIC PINK',240,30,0,4,1,0),(259,'KSL2','KZ SATINLIPS ROSEBUD',240,30,0,4,1,0),(260,'KSL4','KZ SATINLIPS FIERCE CORAL',240,30,0,4,1,0),(261,'KSLML','KOSHIZE SATINLIPS MINI LIPSTIC',240,30,0,4,1,0),(262,'KSLPN','KZ SILK LOOSE POWDER NATURAL',240,30,0,4,1,0),(263,'KSSL1','KOSH SOFT&SHINY LS TANGERINE',280,30,0,4,1,0),(264,'KSSL2','KOSH SOFT&SHINY LS CHERRY',280,30,0,4,1,0),(265,'KSSL3','KOSH SOFT&SHINY LS CHESTNUT',280,30,0,4,1,0),(266,'KSSL4','KOSH SOFT&SHINY LS ALMOND',280,30,0,4,1,0),(267,'KTBL1','KOSHIZE TRIO BO SATIN ROSEWOOD',360,30,0,4,1,0),(268,'KTBL2','KOSHIZE TRIO BO PEACHY BRICK',360,30,0,4,1,0),(269,'KTSC1','KZ TRUE SCRT CONCLR NTRL BEIGE',220,30,0,4,1,0),(270,'KTSC2','KZ TRUE SCRT CONCLR MEDM HONEY',220,30,0,4,1,0),(271,'KTW1','KOSHIZE TWO WAY CAKE IVORY',390,30,0,4,1,0),(272,'KTW2','KOSHZ TWO WAYCAKE NATURAL',390,30,0,4,1,0),(273,'KTW3','KOSHIZE TWO WAY CAKE FAIR',390,30,0,4,1,0),(274,'KTWR1','KSHZ TWO WAY CAKE IVORY REFILL',290,30,0,4,1,0),(275,'KTWR2','KSHZ TWO WAY CAKE NATURAL REF',290,30,0,4,1,0),(276,'KTWR3','KOSHIZE TWC REFILL FAIR',290,30,0,4,1,0),(277,'KVLT1','KOSH VOLUPT LIPTINT CHARM',320,30,0,4,1,0),(278,'KVLT2','KOSH VOLUPT LIPTINT TEMPTATION',320,30,0,4,1,0),(279,'KVLT3','KOSH VOLUPT LIPTINT ALLURE',320,30,0,4,1,0),(280,'KWLM','KOSHIZE WONDER LENGTH MASCARA',350,30,0,4,1,0),(281,'LBSMK','STRAWBERRY MILKSHAKE LIP BALM',95,30,0,4,1,0),(282,'LFKNA','KZ LIQUID FOUNDATION NUDE AMBE',260,30,0,4,1,0),(283,'LG3GA','LIP GLOSS 3D GLAZED AZALEA',120,30,0,4,1,0),(284,'LG3GAN','LIP 3D EFFECT GLAZED AZALEA NW',110,30,0,4,1,0),(285,'LKL11','CANDY PEACH KLUGE LIPSTICK',120,30,0,4,1,0),(286,'LKL13','SISTER PINK KLUGE LIPSTICK',120,30,0,4,1,0),(287,'LKL16','SMOOTH ROSEWOOD KLUGE LIPSTICK',120,30,0,4,1,0),(288,'LKL22','PINK ANGEL KLUGE LIPSTICK',120,30,0,4,1,0),(289,'LKL23','ATOMIC PEACH KLUGE LIPSTICK',120,30,0,4,1,0),(290,'LKL4','APRICOT KLUGE LIPSTICK',120,30,0,4,1,0),(291,'MIDR','SP MEN INVINCIBLE DEO ROLL ON',130,30,0,4,1,0),(292,'MPS','MANICURE PEDICURE SET',330,30,0,4,1,0),(293,'NWBBCN','NEW BODY BUTTER COPPACABANA',350,30,0,4,1,0),(294,'NWBL4','NEW WHTG COPPACABAN BD LOTION',195,30,0,4,1,0),(295,'PDEDP','PRETTY DOLL EDP NT12ML',390,30,0,4,1,0),(296,'POMCO','CHERRY ORANGE PEEL OFF MASK',155,30,0,4,1,0),(297,'POMGA','GREEN TEA APPLE PEEL OFF MASK',155,30,0,4,1,0),(298,'POMHY','HONEY YOGHURT PEEL OFF MASK',155,30,0,4,1,0),(299,'POMMA','MULBERRY AVOCADO PEEL OFF MASK',155,30,0,4,1,0),(300,'POMSM','STRAWBERRY MILK PEEL OF MASK',130,30,0,4,1,0),(301,'PSAAG','PERFECT SKIN ACNE GEL',100,30,0,4,1,0),(302,'PSFC','PERFECT SKIN FOAMING CLEANSER',180,30,0,4,1,0),(303,'PSNT','PERFECT SKIN NIGHT TREATMENT',130,30,0,4,1,0),(304,'PSPOM','PELL OF MASK PERFCT SKIN',130,30,0,4,1,0),(305,'RNA','ROLL ON ANTISEPTIC',160,30,0,4,1,0),(306,'SAD1','SOPHIE ADRENALINE 100ML BRNCHS',640,30,0,4,1,0),(307,'SATT','SOPHIE ATTRACTION 60ML',260,30,0,4,1,0),(308,'SB01','BLUSH ON CORAL TOUCH',190,30,0,4,1,0),(309,'SBM1','NEW SOPHIE PARIS BD MIST FUNKY',165,30,0,4,1,0),(310,'SBM3','NEW SOPHIE PARIS BD MST SPORTY',165,30,0,4,1,0),(311,'SBM4','NEW SOPHIE PARIS BD MIST PARTY',165,30,0,4,1,0),(312,'SCBR','SHEER COLOR BROWNSING ROSE KLG',180,30,0,4,1,0),(313,'SDCS','SOPHIE PARIS HAIR EXPERT DANDRUFF CONTROL SHAMPOO',180,30,0,4,1,0),(314,'SEB1','SOP EYBROWLINR SECRETLY BROWN',120,30,0,4,1,0),(315,'SEB2','SOPHIE TRUE BLACK EYEBROW LNR',120,30,0,4,1,0),(316,'SEKL1','SPARKLING EYELINER KLUGE BLACK',155,30,0,4,1,0),(317,'SEKL2','SPARKLING EYELINER KLUGE SILVE',155,30,0,4,1,0),(318,'SEL2','SOPHIE EYELINER NATURAL BROWN',120,30,0,4,1,0),(319,'SFM80','SOPHIE FOREVER MINE EDP 80ML',390,30,0,4,1,0),(320,'SHHT','SOPHIE PARIS HAIR EXPERT PREVENTION HAIR TONIC',165,30,0,4,1,0),(321,'SHMUP','SOPHIE MAKEUP PALLET2IN1',590,30,0,4,1,0),(322,'SHPS','SOPHIE PARIS HAIR EXPERT DAILY SHAMPOO & CONDITIONER',195,30,0,4,1,0),(323,'SHPTS','SOPHIE PARIS HAIR EXPERT DAILY SERUM',190,30,0,4,1,0),(324,'SLL1','SOPHIE LIP LINER INNOCENT RED',120,30,0,4,1,0),(325,'SLL3','SOPHIE LIP LINR PURELY NATURAL',120,30,0,4,1,0),(326,'SLPB01','CARAMEL SUGAR SOPHIE LIPSTICK',85,30,0,4,1,0),(327,'SLPC02','MANGO PEACH SOPHIE LIPSTICK',85,30,0,4,1,0),(328,'SLPK01','SOPHIE LIPSTICK ICE PINK',85,30,0,4,1,0),(329,'SLPK02','SUMMER PINK SOPHIE LIPSTICK',85,30,0,4,1,0),(330,'SLPK04','BLUSHY PINK SOPHIE LIPSTICK',85,30,0,4,1,0),(331,'SLPK05','SOPHIE LSPT V.I.PINK',85,30,0,4,1,0),(332,'SLPN01','VELVET NUDE SOPHIE LIPSTICK',85,30,0,4,1,0),(333,'SLRD01','RUSSIAN RED SOPHIE LIPSTICK',85,30,0,4,1,0),(334,'SLRD02','FANTASTIC RED SOPHIE LIPSTICK',85,30,0,4,1,0),(335,'SLRD03','RED PEPPER SOPHIE LIPSTICK',85,30,0,4,1,0),(336,'SLRD04','RED WINE SOPHIE LIPSTICK',85,30,0,4,1,0),(337,'SMC1','SOPHIE MASCARA DEFINING BLACK',230,30,0,4,1,0),(338,'SMPC','SOPHIE PARIS MAGIC PINK CREAM',85,30,0,4,1,0),(339,'SPFHW','SPH PRS FEMININE HYGIENE WASH',125,30,0,4,1,0),(340,'SPFNC','SPH PRS FAIRNESS NIGHT CREAM',145,30,0,4,1,0),(341,'SPFPOM','SP FAIRNESS PEEL OFF MASK',130,30,0,4,1,0),(342,'SPFS','SOPHIE PARIS FAIRNESS SERUM',350,30,0,4,1,0),(343,'SPIM','SOPHIE PARIS INCREDIBLY ME EDP',190,30,0,4,1,0),(344,'SPMI','SPH PAR MEN INVSBLE PERF 90ML',320,30,0,4,1,0),(345,'SPMLS1','SOPHIE PARIS MINI LIPSTICK 1',85,30,0,4,1,0),(346,'SPMLS2','SOPHIE PARIS MINI LISPTICK 2',85,30,0,4,1,0),(347,'SPMLS3','SOPHIE PARIS MINI LISPTICK 3',85,30,0,4,1,0),(348,'SPMPL','SOPHIE MAGIC PINK LIPSTICK',140,30,0,4,1,0),(349,'SPTR','SOPHIE PANTY LINER',150,30,0,4,1,0),(350,'SRCDC','SKIN RADIANT COLLAGEN DAY CREA',360,30,0,4,1,0),(351,'SRCNC','SKIN RADIANT COLLAGEN NIGHT CR',360,30,0,4,1,0),(352,'SSACRM','SMART SLIM ANTI CEL ROLL MSGR',220,30,0,4,1,0),(353,'SSBCC','SMARTSLIM BUST CONTOUR CREAM',390,30,0,4,1,0),(354,'SSBFC','SMARTSLIM BUTT FIRMING CREAM',390,30,0,4,1,0),(355,'SSPD','SANITARY PAD DAY USE',150,30,0,4,1,0),(356,'SSPN','SOPHIE SANITARY PAD NIGHT',165,30,0,4,1,0),(357,'STBF','BLUSH AND FOUNDATION BRUSH',235,30,0,4,1,0),(358,'STECN','SOPHIE EYE CURLER',90,30,0,4,1,0),(359,'STELB','EYESHADOW AND LIPS BRUSH',160,30,0,4,1,0),(360,'STERM','EYE RELAXING MASK',120,30,0,4,1,0),(361,'STFCP','SOPHIE FACIAL CLEANSING PAD',95,30,0,4,1,0),(362,'STFPS','SOPHIE TOOLS FULL PEDICURE SET',165,30,0,4,1,0),(363,'STHEC','HEATED EYELASH CURLER',195,30,0,4,1,0),(364,'STNB','5 IN 1 NAIL BUFFER',60,30,0,4,1,0),(365,'SWLBC','SOPHIE WITH LOVE BODYCARE',420,30,0,4,1,0),(366,'SYWP2','SOPHIE PASSIONISTA EDP 15ML',190,30,0,4,1,0),(367,'SBM2','NEW SOPHIE PARIS BD MS RMANTIC',165,30,0,4,1,0),(368,'SABBL','ABBY EVA SANDAL L',720,30,0,5,1,0),(369,'SABBM','ABBY EVA SANDAL M',720,30,0,5,1,0),(370,'SABBS','ABBY EVA SANDAL S',720,30,0,5,1,0),(371,'SATIA36','TIA SHOES 36',690,30,0,5,1,0),(372,'SATIA37','TIA SHOES 37',690,30,0,5,1,0),(373,'SATIA38','TIA SHOES 38',690,30,0,5,1,0),(374,'SFBRL','FABRONI EVA SANDAL L',490,30,0,5,1,0),(375,'SFBRM','FABRONI EVA SANDAL M',490,30,0,5,1,0),(376,'SFBRS','FABRONI EVA SANDAL S',490,30,0,5,1,0),(377,'SFON39','FONDA SHOES 39',1640,30,0,5,1,0),(378,'SFON40','FONDA SHOES 40',1640,30,0,5,1,0),(379,'SFON41','FONDA SHOES 41',1640,30,0,5,1,0),(380,'SFON42','FONDA SHOES 42',1640,30,0,5,1,0),(381,'SFON43','FONDA SHOES 43',1640,30,0,5,1,0),(382,'SFRK39','FRANKY SHOES 39',1590,30,0,5,1,0),(383,'SFRK40','FRANKY SHOES 40',1590,30,0,5,1,0),(384,'SFRK41','FRANKY SHOES 41',1590,30,0,5,1,0),(385,'SFRK42','FRANKY SHOES 42',1590,30,0,5,1,0),(386,'SFRK43','FRANKY SHOES 43',1590,30,0,5,1,0),(387,'SFRM39','FREMAN SHOES 39',1490,30,0,5,1,0),(388,'SFRM40','FREMAN SHOES 40',1490,30,0,5,1,0),(389,'SFRM41','FREMAN SHOES 41',1490,30,0,5,1,0),(390,'SFRM42','FREMAN SHOES 42',1490,30,0,5,1,0),(391,'SFRM43','FREMAN SHOES 43',1490,30,0,5,1,0),(392,'SATIA39','TIA SHOES 39',690,30,0,5,1,0),(393,'SATIA40','TIA SHOES 40',690,30,0,5,1,0),(394,'SBTTL','BRETTA',690,30,0,5,1,0),(395,'SBTTM','BRETTA',690,30,0,5,1,0),(396,'SBTTS','BRETTA',690,30,0,5,1,0),(397,'SDMCL','DOMINIC EVA SANDAL L',720,30,0,5,1,0),(398,'SDMCM','DOMINIC EVA SANDAL M',720,30,0,5,1,0),(399,'SDMCS','DOMINIC EVA SANDAL S',720,30,0,5,1,0),(400,'SDTTL','DOTTY EVA SANDAL L',690,30,0,5,1,0),(401,'SDTTM','DOTTY EVA SANDAL M',690,30,0,5,1,0),(402,'SDTTS','DOTTY EVA SANDAL S',690,30,0,5,1,0),(403,'SELAI36','ELAINA SANDAL 36',1340,30,0,5,1,0),(404,'SELAI37','ELAINA SANDAL 37',1340,30,0,5,1,0),(405,'SELAI38','ELAINA SANDAL 38',1340,30,0,5,1,0),(406,'SELAI39','ELAINA SANDAL 39',1340,30,0,5,1,0),(407,'SELAI40','ELAINA SANDAL 40',1340,30,0,5,1,0),(408,'SELIC36','ELICIA SHOES 36',1290,30,0,5,1,0),(409,'SELIC37','ELICIA SHOES 37',1290,30,0,5,1,0),(410,'SELIC38','ELICIA SHOES 38',1290,30,0,5,1,0),(411,'SEND36','ENDA SANDAL 36',490,30,0,5,1,0),(412,'SEND37','ENDA SANDAL 37',490,30,0,5,1,0),(413,'SEND38','ENDA SANDAL 38',490,30,0,5,1,0),(414,'SEND39','ENDA SANDAL 39',490,30,0,5,1,0),(415,'SEND40','ENDA SANDAL 40',490,30,0,5,1,0),(416,'SELIC39','ELICIA SHOES 39',1290,30,0,5,1,0),(417,'SELIC40','ELICIA SHOES 40',1290,30,0,5,1,0),(418,'SERN36','ERNA SHOES 36',1140,30,0,5,1,0),(419,'SERN37','ERNA SHOES 37',1140,30,0,5,1,0),(420,'SERN38','ERNA SHOES 38',1140,30,0,5,1,0),(421,'SERN39','ERNA SHOES 39',1140,30,0,5,1,0),(422,'SERN40','ERNA SHOES 40',1140,30,0,5,1,0),(423,'SETA36','ETTA SHOES 36',790,30,0,5,1,0),(424,'SETA37','ETTA SHOES 37',790,30,0,5,1,0),(425,'SETA38','ETTA SHOES 38',790,30,0,5,1,0),(426,'SETA39','ETTA SHOES 39',790,30,0,5,1,0),(427,'SETA40','ETTA SHOES 40',790,30,0,5,1,0),(428,'SEVB36','EVA BLUE SANDAL 36',540,30,0,5,1,0),(429,'SEVB37','EVA BLUE SANDAL 37',540,30,0,5,1,0),(430,'SEVB38','EVA BLUE SANDAL 38',540,30,0,5,1,0),(431,'SEVB39','EVA BLUE SANDAL 39',540,30,0,5,1,0),(432,'SEVB40','EVA BLUE SANDAL 40',540,30,0,5,1,0),(433,'SEVG36','EVA GREEN SANDAL 36',540,30,0,5,1,0),(434,'SEVG37','EVA GREEN SANDAL 37',540,30,0,5,1,0),(435,'SEVG38','EVA GREEN SANDAL 38',540,30,0,5,1,0),(436,'SFAU36','FAUSTINE SHOES 36',790,30,0,5,1,0),(437,'SFAU37','FAUSTINE SHOES 37',790,30,0,5,1,0),(438,'SFAU38','FAUSTINE SHOES 38',790,30,0,5,1,0),(439,'SFAU39','FAUSTINE SHOES 39',790,30,0,5,1,0),(440,'SFAU40','FAUSTINE SHOES 40',790,30,0,5,1,0),(441,'SFCE36','FRANCENA SANDAL 36',560,30,0,5,1,0),(442,'SFCE37','FRANCENA SANDAL 37',560,30,0,5,1,0),(443,'SFCE38','FRANCENA SANDAL 38',560,30,0,5,1,0),(444,'SFCE39','FRANCENA SANDAL 39',560,30,0,5,1,0),(445,'SFCE40','FRANCENA SANDAL 40',560,30,0,5,1,0),(446,'SFIA36','FIA SHOES 36',790,30,0,5,1,0),(447,'SFIA37','FIA SHOES 37',790,30,0,5,1,0),(448,'SFIA38','FIA SHOES 38',790,30,0,5,1,0),(449,'SFIA39','FIA SHOES 39',790,30,0,5,1,0),(450,'SFIA40','FIA SHOES 40',790,30,0,5,1,0),(451,'SFINL','FINI EVA SANDAL L',540,30,0,5,1,0),(452,'SFINM','FINI EVA SANDAL M',540,30,0,5,1,0),(453,'SFINS','FINI EVA SANDAL S',540,30,0,5,1,0),(454,'SFIOL','FIONA EVA SANDAL L',760,30,0,5,1,0),(455,'SFIOM','FIONA EVA SANDAL M',760,30,0,5,1,0),(456,'SFIOS','FIONA EVA SANDAL S',760,30,0,5,1,0),(457,'SFIZ36','FIORENZA SANDAL 36',690,30,0,5,1,0),(458,'SFIZ37','FIORENZA SANDAL 37',690,30,0,5,1,0),(459,'SFIZ38','FIORENZA SANDAL 38',690,30,0,5,1,0),(460,'SFIZ39','FIORENZA SANDAL 39',690,30,0,5,1,0),(461,'SFIZ40','FIORENZA SANDAL 40',690,30,0,5,1,0),(462,'SFOR36','FORTUNE SANDAL 36',1240,30,0,5,1,0),(463,'SFOR37','FORTUNE SANDAL 37',1240,30,0,5,1,0),(464,'SFOR38','FORTUNE SANDAL 38',1240,30,0,5,1,0),(465,'SFOR39','FORTUNE SANDAL 39',1240,30,0,5,1,0),(466,'SFOR40','FORTUNE SANDAL 40',1240,30,0,5,1,0),(467,'SFRT36','FLORETTA SANDAL 36',1340,30,0,5,1,0),(468,'SFRT37','FLORETTA SANDAL 37',1340,30,0,5,1,0),(469,'SFRT38','FLORETTA SANDAL 38',1340,30,0,5,1,0),(470,'SFRT39','FLORETTA SANDAL 39',1340,30,0,5,1,0),(471,'SFRT40','FLORETTA SANDAL 40',1340,30,0,5,1,0),(472,'SFYB36','FENY BROWN SHOES 36',790,30,0,5,1,0),(473,'SFYB37','FENY BROWN SHOES 37',790,30,0,5,1,0),(474,'SFYB38','FENY BROWN SHOES 38',790,30,0,5,1,0),(475,'SFYB39','FENY BROWN SHOES 39',790,30,0,5,1,0),(476,'SFYB40','FENY BROWN SHOES 40',790,30,0,5,1,0),(477,'SFYR36','FENY RED SHOES 36',790,30,0,5,1,0),(478,'SFYR37','FENY RED SHOES 37',790,30,0,5,1,0),(479,'SFYR38','FENY RED SHOES 38',790,30,0,5,1,0),(480,'SFYR39','FENY RED SHOES 39',790,30,0,5,1,0),(481,'SFYR40','FENY RED SHOES 40',790,30,0,5,1,0),(482,'SGRI36','GAURI SHOES 36',840,30,0,5,1,0),(483,'SGRI37','GAURI SHOES 37',840,30,0,5,1,0),(484,'SGRI38','GAURI SHOES 38',840,30,0,5,1,0),(485,'SGRI39','GAURI SHOES 39',840,30,0,5,1,0),(486,'SGRI40','GAURI SHOES 40',840,30,0,5,1,0),(487,'SGSA36','GENISA SANDAL 36',690,30,0,5,1,0),(488,'SGSA37','GENISA SANDAL 37',690,30,0,5,1,0),(489,'SGSA38','GENISA SANDAL 38',690,30,0,5,1,0),(490,'SGSA39','GENISA SANDAL 39',690,30,0,5,1,0),(491,'SGSA40','GENISA SANDAL 40',690,30,0,5,1,0),(492,'SEVG39','EVA GREEN SANDAL 39',540,30,0,5,1,0),(493,'SEVG40','EVA GREEN SANDAL 40',540,30,0,5,1,0),(494,'SEVOR36','EVA ORANGE SANDAL 36',540,30,0,5,1,0),(495,'SEVOR37','EVA ORANGE SANDAL 37',540,30,0,5,1,0),(496,'SEVOR38','EVA ORANGE SANDAL 38',540,30,0,5,1,0),(497,'SSFI36','FIO SHOES 36',790,30,0,5,1,0),(498,'SSFI37','FIO SHOES 37',790,30,0,5,1,0),(499,'SSFI38','FIO SHOES 38',790,30,0,5,1,0),(500,'SSFI39','FIO SHOES 39',790,30,0,5,1,0),(501,'SSFI40','FIO SHOES 40',790,30,0,5,1,0),(502,'SEVOR39','EVA ORANGE SANDAL 39',540,30,0,5,1,0),(503,'SEVOR40','EVA ORANGE SANDAL 40',540,30,0,5,1,0),(504,'SORI36','AMORI SHOES 36',790,30,0,5,1,0),(505,'SORI37','AMORI SHOES 37',790,30,0,5,1,0),(506,'SORI38','AMORI SHOES 38',790,30,0,5,1,0),(507,'SORI39','AMORI SHOES 39',790,30,0,5,1,0),(508,'SORI40','AMORI SHOES 40',790,30,0,5,1,0),(509,'STIBL','TIBBY EVA SANDAL L',690,30,0,5,1,0),(510,'STIBM','TIBBY EVA SANDAL M',690,30,0,5,1,0),(511,'STIBS','TIBBY EVA SANDAL S',690,30,0,5,1,0),(512,'SFAAB636','FANYA SANDAL 36',1340,30,0,5,1,0),(513,'SFAAB637','FANYA SANDAL 37',1340,30,0,5,1,0),(514,'SFAAB638','FANYA SANDAL 38',1340,30,0,5,1,0),(515,'SFAAB639','FANYA SANDAL 39',1340,30,0,5,1,0),(516,'SFAAB640','FANYA SANDAL 40',1340,30,0,5,1,0),(517,'SFSS36','FLORESSA SANDAL 36',1340,30,0,5,1,0),(518,'SFSS37','FLORESSA SANDAL 37',1340,30,0,5,1,0),(519,'SFSS38','FLORESSA SANDAL 38',1340,30,0,5,1,0),(520,'SFSS39','FLORESSA SANDAL 39',1340,30,0,5,1,0),(521,'SFSS40','FLORESSA SANDAL 40',1340,30,0,5,1,0),(522,'SFIT36','FITZY SANDAL 36',1290,30,0,5,1,0),(523,'SFIT37','FITZY SANDAL 37',1290,30,0,5,1,0),(524,'SFIT38','FITZY SANDAL 38',1290,30,0,5,1,0),(525,'SFIT39','FITZY SANDAL 39',1290,30,0,5,1,0),(526,'SFIT40','FITZY SANDAL 40',1290,30,0,5,1,0),(527,'SFLT36','FELITA SANDAL 36',1240,30,0,5,1,0),(528,'SFLT37','FELITA SANDAL 37',1240,30,0,5,1,0),(529,'SFLT38','FELITA SANDAL 38',1240,30,0,5,1,0),(530,'SFLT39','FELITA SANDAL 39',1240,30,0,5,1,0),(531,'SFLT40','FELITA SANDAL 40',1240,30,0,5,1,0),(532,'SFRN36','FLORENTINA SHOES 36',1190,30,0,5,1,0),(533,'SFRN37','FLORENTINA SHOES 37',1190,30,0,5,1,0),(534,'SFRN38','FLORENTINA SHOES 38',1190,30,0,5,1,0),(535,'SFRN39','FLORENTINA SHOES 39',1190,30,0,5,1,0),(536,'SFRN40','FLORENTINA SHOES 40',1190,30,0,5,1,0),(537,'BFIFB6L','FIFELE BLOUSE BLUE L',540,30,0,6,1,0),(538,'BFIFB6M','FIFELE BLOUSE BLUE M',540,30,0,6,1,0),(539,'BFIFB6S','FIFELE BLOUSE BLUE S',540,30,0,6,1,0),(540,'BFIFB6XS','FIFELE BLOUSE BLUE XS',540,30,0,6,1,0),(541,'BFIFP3L','FIFELE BLOUSE PINK L',540,30,0,6,1,0),(542,'BFIFP3M','FIFELE BLOUSE PINK M',540,30,0,6,1,0),(543,'BFIFP3S','FIFELE BLOUSE PINK S',540,30,0,6,1,0),(544,'BFIFP3XS','FIFELE BLOUSE PINK XS',540,30,0,6,1,0),(545,'BFIFT3L','FIFELE BLOUSE TOSCA L',540,30,0,6,1,0),(546,'BFIFT3M','FIFELE BLOUSE TOSCA M',540,30,0,6,1,0),(547,'BFIFT3S','FIFELE BLOUSE TOSCA S',540,30,0,6,1,0),(548,'BFIFT3XS','FIFELE BLOUSE TOSCA XS',540,30,0,6,1,0),(549,'DCRIP4L','CARRIE PURPLE L',1090,30,0,6,1,0),(550,'DCRIP4M','CARRIE PURPLE M',1090,30,0,6,1,0),(551,'DCRIP4S','CARRIE PURPLE S',1090,30,0,6,1,0),(552,'DCRIP4XS','CARRIE PURPLE XS',1090,30,0,6,1,0),(553,'DEARB2L','EARNA BERRY L',740,30,0,6,1,0),(554,'DEARB2M','EARNA BERRY M',740,30,0,6,1,0),(555,'DEARB2S','EARNA BERRY S',740,30,0,6,1,0),(556,'DEARB2XS','EARNA BERRY XS',740,30,0,6,1,0),(557,'DEARP4L','EARNA PURPLE L',740,30,0,6,1,0),(558,'DEARP4M','EARNA PURPLE M',740,30,0,6,1,0),(559,'DEARP4S','EARNA PURPLE S',740,30,0,6,1,0),(560,'DEARP4XS','EARNA PURPLE XS',740,30,0,6,1,0),(561,'DFAPB2L','FAPIOLA DRESS BERRY L',590,30,0,6,1,0),(562,'DFAPB2M','FAPIOLA DRESS BERRY M',590,30,0,6,1,0),(563,'DFAPB2S','FAPIOLA DRESS BERRY S',590,30,0,6,1,0),(564,'DFAPB2XL','FAPIOLA DRESS BERRY XL',590,30,0,6,1,0),(565,'DFAPO3L','FAPIOLA DRESS ORANGE L',590,30,0,6,1,0),(566,'DFAPO3M','FAPIOLA DRESS ORANGE M',590,30,0,6,1,0),(567,'DFAPO3S','FAPIOLA DRESS ORANGE S',590,30,0,6,1,0),(568,'DFAPO3XL','FAPIOLA DRESS ORANGE XL',590,30,0,6,1,0),(569,'DFAPP3L','FAPIOLA DRESS PINK L',590,30,0,6,1,0),(570,'DFAPP3M','FAPIOLA DRESS PINK M',590,30,0,6,1,0),(571,'DFAPP3S','FAPIOLA DRESS PINK S',590,30,0,6,1,0),(572,'DFAPP3XL','FAPIOLA DRESS PINK XL',590,30,0,6,1,0),(573,'DFRLB6L','FERLOTA DRESS BLUE L',590,30,0,6,1,0),(574,'DFRLB6M','FERLOTA DRESS BLUE M',590,30,0,6,1,0),(575,'DFRLB6S','FERLOTA DRESS BLUE S',590,30,0,6,1,0),(576,'DFRLB6XS','FERLOTA DRESS BLUE XS',590,30,0,6,1,0),(577,'DFRLG3L','FERLOTA DRESS GREY L',590,30,0,6,1,0),(578,'DFRLG3M','FERLOTA DRESS GREY M',590,30,0,6,1,0),(579,'DFRLG3S','FERLOTA DRESS GREY S',590,30,0,6,1,0),(580,'DFRLG3XS','FERLOTA DRESS GREY XS',590,30,0,6,1,0),(581,'DFRLP4L','FERLOTA DRESS PURPLE L',590,30,0,6,1,0),(582,'DFRLP4M','FERLOTA DRESS PURPLE M',590,30,0,6,1,0),(583,'DFRLP4S','FERLOTA DRESS PURPLE S',590,30,0,6,1,0),(584,'DFRLP4XS','FERLOTA DRESS PURPLE XS',590,30,0,6,1,0),(585,'DEARR1L','EARNA RED L',740,30,0,6,1,0),(586,'DEARR1M','EARNA RED M',740,30,0,6,1,0),(587,'DEARR1S','EARNA RED S',740,30,0,6,1,0),(588,'DEARR1XS','EARNA RED XS',740,30,0,6,1,0),(589,'KBAIP42L','BAILEE T-SHIRT PURPLE XXL',390,30,0,6,1,0),(590,'KBAIP4L','BAILEE T-SHIRT PURPLE L',390,30,0,6,1,0),(591,'KBAIP4M','BAILEE T-SHIRT PURPLE M',390,30,0,6,1,0),(592,'KBAIP4S','BAILEE T-SHIRT PURPLE S',390,30,0,6,1,0),(593,'KBAIP4XL','BAILEE T-SHIRT PURPLE XL',390,30,0,6,1,0),(594,'KBAIP4XS','BAILEE T-SHIRT PURPLE XS',390,30,0,6,1,0),(595,'KCICB1L','CICELY BATA',540,30,0,6,1,0),(596,'KCICB1M','CICELY BATA',540,30,0,6,1,0),(597,'KFRHB1L','FERISHA T-SHIRT BATA L',590,30,0,6,1,0),(598,'KFRHB1M','FERISHA T-SHIRT BATA M',590,30,0,6,1,0),(599,'KFRHB1S','FERISHA T-SHIRT BATA S',590,30,0,6,1,0),(600,'KFRHB1XL','FERISHA T-SHIRT BATA XL',590,30,0,6,1,0),(601,'KFRHB6L','FERISHA T-SHIRT BLUE L',590,30,0,6,1,0),(602,'KFRHB6M','FERISHA T-SHIRT BLUE M',590,30,0,6,1,0),(603,'KFRHB6S','FERISHA T-SHIRT BLUE S',590,30,0,6,1,0),(604,'KFRHB6XL','FERISHA T-SHIRT BLUE XL',590,30,0,6,1,0),(605,'KFRHP4L','FERISHA T-SHIRT PURPLE L',590,30,0,6,1,0),(606,'KFRHP4M','FERISHA T-SHIRT PURPLE M',590,30,0,6,1,0),(607,'KFRHP4S','FERISHA T-SHIRT PURPLE S',590,30,0,6,1,0),(608,'KFRHP4XL','FERISHA T-SHIRT PURPLE XL',590,30,0,6,1,0),(609,'KFLCB8L','FELCO T-SHIRT BURGUNDY L',540,30,0,6,1,0),(610,'KFLCB8M','FELCO T-SHIRT BURGUNDY M',540,30,0,6,1,0),(611,'KFLCB8S','FELCO T-SHIRT BURGUNDY S',540,30,0,6,1,0),(612,'KFLCB8XL','FELCO T-SHIRT BURGUNDY XL',540,30,0,6,1,0),(613,'KFRRG3L','FERARI T-SHIRT GREY L',520,30,0,6,1,0),(614,'KFRRG3M','FERARI T-SHIRT GREY M',520,30,0,6,1,0),(615,'KFRRG3S','FERARI T-SHIRT GREY S',520,30,0,6,1,0),(616,'KFRRG3XL','FERARI T-SHIRT GREY XL',520,30,0,6,1,0),(617,'KFONB1L','FONTANNE T-SHIRT L',960,30,0,6,1,0),(618,'KFONB1M','FONTANNE T-SHIRT M',960,30,0,6,1,0),(619,'KFONB1S','FONTANNE T-SHIRT S',960,30,0,6,1,0),(620,'KFONB1XL','FONTANNE T-SHIRT XL',960,30,0,6,1,0),(621,'KFRNN1L','FARRANT T-SHIRT NAVY L',490,30,0,6,1,0),(622,'KFRNN1M','FARRANT T-SHIRT NAVY M',490,30,0,6,1,0),(623,'KFRNN1S','FARRANT T-SHIRT NAVY S',490,30,0,6,1,0),(624,'KFRNN1XL','FARRANT T-SHIRT NAVY XL',490,30,0,6,1,0),(625,'KFSTG3L','FORSTERO T-SHIRT GREY L',620,30,0,6,1,0),(626,'KFSTG3M','FORSTERO T-SHIRT GREY M',620,30,0,6,1,0),(627,'KFSTG3S','FORSTERO T-SHIRT GREY S',620,30,0,6,1,0),(628,'KFSTG3XL','FORSTERO T-SHIRT GREY XL',620,30,0,6,1,0),(629,'BNARD1L','NARD DUSTY PINK L',790,30,0,6,1,0),(630,'BNARD1M','NARD DUSTY PINK M',790,30,0,6,1,0),(631,'BNARD1S','NARD DUSTY PINK S',790,30,0,6,1,0),(632,'BNARD1XL','NARD DUSTY PINK XL',790,30,0,6,1,0),(633,'DOREB6L','OREILLETTE BLUE L',740,30,0,6,1,0),(634,'DOREB6M','OREILLETTE BLUE M',740,30,0,6,1,0),(635,'DOREB6S','OREILLETTE BLUE S',740,30,0,6,1,0),(636,'DOREB6XS','OREILLETTE BLUE XS',740,30,0,6,1,0),(637,'DPSSG3L','PASSION GREY L',990,30,0,6,1,0),(638,'DPSSG3M','PASSION GREY M',990,30,0,6,1,0),(639,'DPSSG3S','PASSION GREY S',990,30,0,6,1,0),(640,'DPSSG3XL','PASSION GREY XL',990,30,0,6,1,0),(641,'DRCHB6L','ORCHIS BLUE L',690,30,0,6,1,0),(642,'DRCHB6M','ORCHIS BLUE M',690,30,0,6,1,0),(643,'DRCHB6S','ORCHIS BLUE S',690,30,0,6,1,0),(644,'DRCHB6XS','ORCHIS BLUE XS',690,30,0,6,1,0),(645,'JNID1L','NIGELLE DUSTY PINK L',1090,30,0,6,1,0),(646,'JNID1M','NIGELLE DUSTY PINK M',1090,30,0,6,1,0),(647,'JNID1S','NIGELLE DUSTY PINK S',1090,30,0,6,1,0),(648,'JNID1XS','NIGELLE DUSTY PINK XS',1090,30,0,6,1,0),(649,'KMUP3L','MUGUET PINK L',590,30,0,6,1,0),(650,'KMUP3M','MUGUET PINK M',590,30,0,6,1,0),(651,'KMUP3S','MUGUET PINK S',590,30,0,6,1,0),(652,'KMUP3XL','MUGUET PINK XL',590,30,0,6,1,0),(653,'KOXAB6L','OXALIDE BLUE L',560,30,0,6,1,0),(654,'KOXAB6M','OXALIDE BLUE M',560,30,0,6,1,0),(655,'KOXAB6S','OXALIDE BLUE S',560,30,0,6,1,0),(656,'KOXAB6XS','OXALIDE BLUE XS',560,30,0,6,1,0),(657,'KPATG3L','PASTEL GREY L',720,30,0,6,1,0),(658,'KPATG3M','PASTEL GREY M',720,30,0,6,1,0),(659,'KPATG3S','PASTEL GREY S',720,30,0,6,1,0),(660,'KPATG3XS','PASTEL GREY XS',720,30,0,6,1,0),(661,'BHEOR1L','THEODORA RED BLOUSE L',990,30,0,6,1,0),(662,'BHEOR1M','THEODORA RED BLOUSE M',990,30,0,6,1,0),(663,'BHEOR1S','THEODORA RED BLOUSE S',990,30,0,6,1,0),(664,'BHEOR1XL','THEODORA RED BLOUSE XL',990,30,0,6,1,0),(665,'BPAUP3L','PAULETTE PINK BLOUSE L',590,30,0,6,1,0),(666,'BPAUP3M','PAULETTE PINK BLOUSE M',590,30,0,6,1,0),(667,'BPAUP3S','PAULETTE PINK BLOUSE S',590,30,0,6,1,0),(668,'BPAUP3XL','PAULETTE PINK BLOUSE XL',590,30,0,6,1,0),(669,'BTINM4L','TINNY MULTICOLOUR L',790,30,0,6,1,0),(670,'BTINM4M','TINNY MULTICOLOUR M',790,30,0,6,1,0),(671,'BTINM4S','TINNY MULTICOLOUR S',790,30,0,6,1,0),(672,'BTINM4XS','TINNY MULTICOLOUR XS',790,30,0,6,1,0),(673,'BVALM4L','VALEN MULTICOLOUR L',740,30,0,6,1,0),(674,'BVALM4M','VALEN MULTICOLOUR M',740,30,0,6,1,0),(675,'BVALM4S','VALEN MULTICOLOUR S',740,30,0,6,1,0),(676,'BVALM4XS','VALEN MULTICOLOUR XS',740,30,0,6,1,0),(677,'KCICB1S','CICELY BATA',540,30,0,6,1,0),(678,'KCICB1XL','CICELY BATA',540,30,0,6,1,0),(679,'KCICB2L','CICELY BERRY T-SHIRT L',540,30,0,6,1,0),(680,'KCICB2M','CICELY BERRY T-SHIRT M',540,30,0,6,1,0),(681,'DGUYB6L','GAUDY BLUE L',840,30,0,6,1,0),(682,'DGUYB6M','GAUDY BLUE M',840,30,0,6,1,0),(683,'DGUYB6S','GAUDY BLUE S',840,30,0,6,1,0),(684,'DGUYB6XS','GAUDY BLUE XS',840,30,0,6,1,0),(685,'DOSAM4L','ROSALINE MULTICOLOUR L',1240,30,0,6,1,0),(686,'DOSAM4M','ROSALINE MULTICOLOUR M',1240,30,0,6,1,0),(687,'DOSAM4S','ROSALINE MULTICOLOUR S',1240,30,0,6,1,0),(688,'DOSAM4XL','ROSALINE MULTICOLOUR XL',1240,30,0,6,1,0),(689,'DPINP3L','PINKAN PINK DRESS L',660,30,0,6,1,0),(690,'DPINP3M','PINKAN PINK DRESS M',660,30,0,6,1,0),(691,'DPINP3S','PINKAN PINK DRESS S',660,30,0,6,1,0),(692,'DPINP3XS','PINKAN PINK DRESS XS',660,30,0,6,1,0),(693,'JTRVB627','TREVY BLUE JEANS 27',1790,30,0,6,1,0),(694,'JTRVB628','TREVY BLUE JEANS 28',1790,30,0,6,1,0),(695,'JTRVB629','TREVY BLUE JEANS 29',1790,30,0,6,1,0),(696,'JTRVB630','TREVY BLUE JEANS 30',1790,30,0,6,1,0),(697,'JTRVB631','TREVY BLUE JEANS 31',1790,30,0,6,1,0),(698,'KNEZB4L','INEZ T-SHIRT BEIGE L',590,30,0,6,1,0),(699,'KNEZB4M','INEZ T-SHIRT BEIGE M',590,30,0,6,1,0),(700,'KNEZB4S','INEZ T-SHIRT BEIGE S',590,30,0,6,1,0),(701,'KNEZB4XL','INEZ T-SHIRT BEIGE XL',590,30,0,6,1,0),(702,'KNIKB7L','NIKKY T-SHIRT BROWN L',540,30,0,6,1,0),(703,'KNIKB7M','NIKKY T-SHIRT BROWN M',540,30,0,6,1,0),(704,'KNIKB7S','NIKKY T-SHIRT BROWN S',540,30,0,6,1,0),(705,'KNIKB7XL','NIKKY T-SHIRT BROWN XL',540,30,0,6,1,0),(706,'KNIKG3L','NIKKY T-SHIRT GREY L',540,30,0,6,1,0),(707,'KNIKG3M','NIKKY T-SHIRT GREY M',540,30,0,6,1,0),(708,'KNIKG3S','NIKKY T-SHIRT GREY S',540,30,0,6,1,0),(709,'KNIKG3XL','NIKKY T-SHIRT GREY XL',540,30,0,6,1,0),(710,'KYLLB6L','YOLLIZ T-SHIRT BLUE L',490,30,0,6,1,0),(711,'KYLLB6M','YOLLIZ T-SHIRT BLUE M',490,30,0,6,1,0),(712,'KYLLB6S','YOLLIZ T-SHIRT BLUE S',490,30,0,6,1,0),(713,'KYLLB6XL','YOLLIZ T-SHIRT BLUE XL',490,30,0,6,1,0),(714,'KCICB2S','CICELY BERRY T-SHIRT S',540,30,0,6,1,0),(715,'KCICB2XL','CICELY BERRY T-SHIRT XL',540,30,0,6,1,0),(716,'KCICB6L','CICELY BLUE',540,30,0,6,1,0),(717,'KCICB6M','CICELY BLUE',540,30,0,6,1,0),(718,'KCICB6S','CICELY BLUE',540,30,0,6,1,0),(719,'KCICB6XL','CICELY BLUE',540,30,0,6,1,0),(720,'KGGB62L','AIGGO T-SHIRT BLUE XXL',490,30,0,6,1,0),(721,'KGGB6L','AIGGO T-SHIRT BLUE L',490,30,0,6,1,0),(722,'KGGB6M','AIGGO T-SHIRT BLUE M',490,30,0,6,1,0),(723,'KGGB6S','AIGGO T-SHIRT BLUE S',490,30,0,6,1,0),(724,'KGGB6XL','AIGGO T-SHIRT BLUE XL',490,30,0,6,1,0),(725,'KGGB6XS','AIGGO T-SHIRT BLUE XS',490,30,0,6,1,0),(726,'BPOWT3L','POWAY TOSCA L',1090,30,0,6,1,0),(727,'BPOWT3M','POWAY TOSCA M',1090,30,0,6,1,0),(728,'BPOWT3S','POWAY TOSCA S',1090,30,0,6,1,0),(729,'BPOWT3XL','POWAY TOSCA XL',1090,30,0,6,1,0),(730,'DPSAM4L','PASADENA MULTICOLOUR L',1090,30,0,6,1,0),(731,'DPSAM4M','PASADENA MULTICOLOUR M',1090,30,0,6,1,0),(732,'DPSAM4S','PASADENA MULTICOLOUR S',1090,30,0,6,1,0),(733,'DPSAM4XS','PASADENA MULTICOLOUR XS',1090,30,0,6,1,0),(734,'HL172','MINI PEMARUT DAN JUICER  (Mini Grater & Juicer)',640,30,0,7,1,0),(735,'HL178','CUP CAKE TISSUE BOX',290,30,0,7,1,0),(736,'HL179','SET TEMPAT AIR + GELAS (Kettle Cup Set)',540,30,0,7,1,0),(737,'HL187','MINI GELAS CANTIK  (Mini Pitcher with Cups Set)',290,30,0,7,1,0),(738,'HL208','SQUARE BAG ORGANIZER',620,30,0,7,1,0),(739,'HL210','MAGENTA LUNCH BOX',450,30,0,7,1,0),(740,'NM42B','JACQUELINE BEAUTY BAG',590,30,0,2,1,0),(741,'CCFB','HAND BAG POLISH',150,30,0,17,1,0),(742,'CPCWS','CLEAN POLIS CREAM WITH SPONGE',115,30,0,17,1,0),(743,'JCB','JEWELRY CLEANER BIO',75,30,0,17,1,0),(744,'CLU384','CELLO COUPLE SUNGLASSES',1090,30,0,8,1,0),(745,'LU472','ELLARD SUNGLASSES',690,30,0,8,1,0),(746,'LU617','BENICIO SUNGLASSES',540,30,0,8,1,0),(747,'LU620','HARVEY SUNGLASSES',440,30,0,8,1,0),(748,'LU628','OESTEN SUNGLASSES',490,30,0,8,1,0),(749,'LU632','LYUBOV SUNGLASSES',690,30,0,8,1,0),(750,'LU619','CHUKKA SUNGLASSES',520,30,0,8,1,0),(751,'LU635','KARA SUNGLASSES',460,30,0,8,1,0),(752,'LU636','ESTELLE SUNGLASSES',420,30,0,8,1,0),(753,'DSM1330','VARENNE WALLET',590,30,0,9,1,0),(754,'DSM1375','AMORETTE POUCH',490,30,0,9,1,0),(755,'DSM1486','CALUIRE WALLET',590,30,0,9,1,0),(756,'DSM1789','CASSON WALLET',520,30,0,9,1,0),(757,'DSM1987','DERUET WALLET',790,30,0,9,1,0),(758,'DSM1992','CLOUET WALLET',390,30,0,9,1,0),(759,'DSM1994','QUESNEL WALLET',420,30,0,9,1,0),(760,'DSM1995','CARON WALLET',390,30,0,9,1,0),(761,'DSM1821','OTHAIN WALLET',690,30,0,9,1,0),(762,'DSM1838','GINOLES WALLET',690,30,0,9,1,0),(763,'DSM1849','EN TRIEVES WALLET',520,30,0,9,1,0),(764,'DSM1852','CORDELLE WALLET',560,30,0,9,1,0),(765,'DSM1859','CREUSE WALLET',560,30,0,9,1,0),(766,'DSM1880','SAULDRE WALLET',690,30,0,9,1,0),(767,'DSM1890','ANDELLEX WALLET',690,30,0,9,1,0),(768,'DSM1898','TAURION',390,30,0,9,1,0),(769,'DSM1903','EN MORVAN WALLET',590,30,0,9,1,0),(770,'DSM1914','ALISTRO WALLET',520,30,0,9,1,0),(771,'DSM1917','LE JEUNE WALLET',520,30,0,9,1,0),(772,'DSM1985','GRENADILLE WALLET',490,30,0,9,1,0),(773,'DSM2000','SKYLAR WALLET',490,30,0,9,1,0),(774,'DSM2003','POIVREE WALLET',590,30,0,9,1,0),(775,'DSM2004','MORBIER WALLET',540,30,0,9,1,0),(776,'DSM2006','MONIN WALLET',640,30,0,9,1,0),(777,'DSM1920','BOLOGNA WALLET',540,30,0,9,1,0),(778,'DSM1921','ADAS WALLET',540,30,0,9,1,0),(779,'DSM1922','BARBEREY WALLET',890,30,0,9,1,0),(780,'DSM1923','FLORIEN WALLET',740,30,0,9,1,0),(781,'DSM1925','CEPIE WALLET',760,30,0,9,1,0),(782,'DSM1926','CATERINE WALLET',740,30,0,9,1,0),(783,'DSM1927','BECQUIGNY WALLET',740,30,0,9,1,0),(784,'DSM1928','CAZELLE WALLET',790,30,0,9,1,0),(785,'DSM1934','FOURCES WALLET',450,30,0,9,1,0),(786,'DSM1936','CLEFMONT WALLET',560,30,0,9,1,0),(787,'DSM1937','CHARROUX WALLET',520,30,0,9,1,0),(788,'DSM1967','BARDOS WALLET',590,30,0,9,1,0),(789,'DSM1969','ALIZAY WALLET',540,30,0,9,1,0),(790,'DSM1970','BARSAC WALLET',490,30,0,9,1,0),(791,'DSM1974','BARLEST WALLET',540,30,0,9,1,0),(792,'DSM1980','BECOURT WALLET',490,30,0,9,1,0),(793,'DSM1999','BAGARD WALLET',490,30,0,9,1,0),(794,'DSM1938','VERDON WALLET',560,30,0,9,1,0),(795,'DSM1942','MAROILLES WALLET',490,30,0,9,1,0),(796,'DSM1955','DESSUS WALLET',1090,30,0,9,1,0),(797,'DSM1963','CAMBES WALLET',890,30,0,9,1,0),(798,'DSM1965','BAIVES WALLET',890,30,0,9,1,0),(799,'DSM1944','MUNSTER WALLET',790,30,0,9,1,0),(800,'DSM1945','OSSAV WALLET',690,30,0,9,1,0),(801,'DSM214','ORIGINAL',550,30,0,9,1,0),(802,'DSM1954','CUNEGONDE WALLET',690,30,0,9,1,0),(803,'DSM1960','DOROTHEE WALLET',890,30,0,9,1,0),(804,'CPU25','BARDANE COUPLE WATCH',2290,30,0,10,1,0),(805,'GAL187','NEO FAIRFAX WATCH',1690,30,0,10,1,0),(806,'GAL201','DERRO WATCH',1490,30,0,10,1,0),(807,'GAL202','FALDO WATCH',1790,30,0,10,1,0),(808,'GAL204','DEVON WATCH',1690,30,0,10,1,0),(809,'GAL205','JAVOS WATCH',1490,30,0,10,1,0),(810,'GAL206','ARDON WATCH',1890,30,0,10,1,0),(811,'GAL207','ORVIS WATCH',1890,30,0,10,1,0),(812,'GAL208','MOSI WATCH',1980,30,0,10,1,0),(813,'GAL191','PATRIZIO WATCH',1790,30,0,10,1,0),(814,'GPU377','HACKMAN WATCH',1620,30,0,10,1,0),(815,'GPU382','LANDO WATCH',1390,30,0,10,1,0),(816,'GPU383','DERBY WATCH',1990,30,0,10,1,0),(817,'GPU385','BRODY WATCH',1560,30,0,10,1,0),(818,'GPU386','DYLAN WATCH',1990,30,0,10,1,0),(819,'GPU387','VICKO WATCH',1490,30,0,10,1,0),(820,'GPU389','VASCO WATCH',1790,30,0,10,1,0),(821,'GPU390','GASCO WATCH',1390,30,0,10,1,0),(822,'GPU391','LOGAN WATCH',990,30,0,10,1,0),(823,'GPU392','LOAN WATCH',1090,30,0,10,1,0),(824,'JTX139','NUMORA WATCH',690,30,0,10,1,0),(825,'GPU380','FORCE WATCH',2090,30,0,10,1,0),(826,'WPU411','ALISHKA',890,30,0,10,1,0),(827,'WPU422','CADENCIA WATCH',1090,30,0,10,1,0),(828,'WPU429','NICIA WATCH',1290,30,0,10,1,0),(829,'JTA126','OWL KIDS WATCH',390,30,0,10,1,0),(830,'SASL257','LENA WATCH',1790,30,0,10,1,0),(831,'SASL258','VERA WATCH',1690,30,0,10,1,0),(832,'SASL259','MERIA WATCH',2090,30,0,10,1,0),(833,'SASL261','VALIA WATCH',1490,30,0,10,1,0),(834,'CPU26','GAYLE COUPLE WATCH',1960,30,0,10,1,0),(835,'LAL215','EVELINA WATCH',890,30,0,10,1,0),(836,'WPU440','OTKA WATCH',1090,30,0,10,1,0),(837,'WPU441','MIA WATCH',890,30,0,10,1,0),(838,'WPU442','HEZA WATCH',1190,30,0,10,1,0),(839,'WPU443','ULICA WATCH',1040,30,0,10,1,0),(840,'WPU445','TITANIA WATCH',1120,30,0,10,1,0),(841,'WPU446','VANZIA WATCH',1190,30,0,10,1,0),(842,'WPU447','REISTA WATCH',1090,30,0,10,1,0),(843,'WPU449','CASSY WATCH',990,30,0,10,1,0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shortName` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provinces`
--

LOCK TABLES `provinces` WRITE;
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;
INSERT INTO `provinces` VALUES (1,'CEB','Cebu');
/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uporders`
--

DROP TABLE IF EXISTS `uporders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uporders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreated` datetime DEFAULT NULL,
  `dateLastModified` datetime DEFAULT NULL,
  `dateOrdered` datetime DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `orderStatusId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_UpOrders_Users1_idx` (`userId`),
  KEY `fk_UpOrders_UpOrderStatus1_idx` (`orderStatusId`),
  CONSTRAINT `fk_UpOrders_UpOrderStatus1` FOREIGN KEY (`orderStatusId`) REFERENCES `orderstatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_UpOrders_Users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uporders`
--

LOCK TABLES `uporders` WRITE;
/*!40000 ALTER TABLE `uporders` DISABLE KEYS */;
/*!40000 ALTER TABLE `uporders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upordersorders`
--

DROP TABLE IF EXISTS `upordersorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upordersorders` (
  `upOrderId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateLastModified` datetime DEFAULT NULL,
  PRIMARY KEY (`upOrderId`,`orderId`),
  KEY `fk_UpOrders_has_Orders_Orders1_idx` (`orderId`),
  KEY `fk_UpOrders_has_Orders_UpOrders1_idx` (`upOrderId`),
  CONSTRAINT `fk_UpOrders_has_Orders_Orders1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_UpOrders_has_Orders_UpOrders1` FOREIGN KEY (`upOrderId`) REFERENCES `uporders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upordersorders`
--

LOCK TABLES `upordersorders` WRITE;
/*!40000 ALTER TABLE `upordersorders` DISABLE KEYS */;
/*!40000 ALTER TABLE `upordersorders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uporderstatushistory`
--

DROP TABLE IF EXISTS `uporderstatushistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uporderstatushistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreated` datetime DEFAULT NULL,
  `dateLastModified` datetime DEFAULT NULL,
  `upOrderId` int(11) NOT NULL,
  `orderStatusId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_UpOrderStatus_UpOrders1_idx` (`upOrderId`),
  KEY `fk_UpOrderStatus_OrderStatus1_idx` (`orderStatusId`),
  KEY `fk_UpOrderStatus_Users1_idx` (`userId`),
  CONSTRAINT `fk_UpOrderStatus_OrderStatus1` FOREIGN KEY (`orderStatusId`) REFERENCES `orderstatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_UpOrderStatus_UpOrders1` FOREIGN KEY (`upOrderId`) REFERENCES `uporders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_UpOrderStatus_Users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uporderstatushistory`
--

LOCK TABLES `uporderstatushistory` WRITE;
/*!40000 ALTER TABLE `uporderstatushistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `uporderstatushistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateLastModified` datetime DEFAULT NULL,
  `userTypeId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Users_UserTypes1_idx` (`userTypeId`),
  CONSTRAINT `fk_Users_UserTypes1` FOREIGN KEY (`userTypeId`) REFERENCES `usertypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','2014-09-17 00:00:00','2014-09-17 00:00:00',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersmembers`
--

DROP TABLE IF EXISTS `usersmembers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usersmembers` (
  `memberId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateLastModified` datetime DEFAULT NULL,
  PRIMARY KEY (`memberId`,`userId`),
  KEY `fk_Members_has_Users_Users1_idx` (`userId`),
  KEY `fk_Members_has_Users_Members1_idx` (`memberId`),
  CONSTRAINT `fk_Members_has_Users_Members1` FOREIGN KEY (`memberId`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Members_has_Users_Users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersmembers`
--

LOCK TABLES `usersmembers` WRITE;
/*!40000 ALTER TABLE `usersmembers` DISABLE KEYS */;
/*!40000 ALTER TABLE `usersmembers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usertypes`
--

DROP TABLE IF EXISTS `usertypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usertypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usertypes`
--

LOCK TABLES `usertypes` WRITE;
/*!40000 ALTER TABLE `usertypes` DISABLE KEYS */;
INSERT INTO `usertypes` VALUES (1,'Super Admin','Super Administrator'),(2,'Admin','Application administrators'),(3,'User','Regular users');
/*!40000 ALTER TABLE `usertypes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-30 23:32:40
