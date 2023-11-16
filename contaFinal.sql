CREATE DATABASE  IF NOT EXISTS `contafinal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `contafinal`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: contafinal
-- ------------------------------------------------------
-- Server version	8.0.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `diario`
--

DROP TABLE IF EXISTS `diario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diario` (
  `nroAsiento` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `nroCuenta` varchar(20) NOT NULL,
  `debe` double DEFAULT NULL,
  `haber` double DEFAULT NULL,
  PRIMARY KEY (`nroAsiento`,`fecha`,`nroCuenta`),
  KEY `nroCuenta` (`nroCuenta`),
  CONSTRAINT `diario_ibfk_1` FOREIGN KEY (`nroCuenta`) REFERENCES `plancuentas` (`nroCuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diario`
--

LOCK TABLES `diario` WRITE;
/*!40000 ALTER TABLE `diario` DISABLE KEYS */;
/*!40000 ALTER TABLE `diario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mayor`
--

DROP TABLE IF EXISTS `mayor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mayor` (
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `nroCuenta` varchar(20) NOT NULL,
  `totalDebe` double DEFAULT NULL,
  `totalHaber` double DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  PRIMARY KEY (`anio`,`mes`,`nroCuenta`),
  KEY `nroCuenta` (`nroCuenta`),
  CONSTRAINT `mayor_ibfk_1` FOREIGN KEY (`nroCuenta`) REFERENCES `plancuentas` (`nroCuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mayor`
--

LOCK TABLES `mayor` WRITE;
/*!40000 ALTER TABLE `mayor` DISABLE KEYS */;
/*!40000 ALTER TABLE `mayor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plancuentas`
--

DROP TABLE IF EXISTS `plancuentas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plancuentas` (
  `nroCuenta` varchar(20) NOT NULL,
  `rubro` char(1) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nroCuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plancuentas`
--

LOCK TABLES `plancuentas` WRITE;
/*!40000 ALTER TABLE `plancuentas` DISABLE KEYS */;
/*!40000 ALTER TABLE `plancuentas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-15 23:05:02
