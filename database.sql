-- MySQL dump 10.13  Distrib 8.0.31, for macos12.6 (arm64)
--
-- Host: localhost    Database: leandrox_neopro
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `colaboradores`
--

DROP TABLE IF EXISTS `colaboradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `colaboradores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `funcao` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colaboradores`
--

LOCK TABLES `colaboradores` WRITE;
/*!40000 ALTER TABLE `colaboradores` DISABLE KEYS */;
INSERT INTO `colaboradores` VALUES (73,'jucio','gerente','125'),(74,'maria','gerente de obras','165'),(75,'teste1','gerente','15.95'),(76,'teste2','estagiario','15.99'),(77,'jucio Gabriel araujo da costa','Gerente ','15'),(78,'Leandro','engenheiro','100.5'),(79,'Leandro.J','diretor','90'),(80,'teste001','gerente','150'),(81,'teste002','administrador','250');
/*!40000 ALTER TABLE `colaboradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horas_trabalhadas`
--

DROP TABLE IF EXISTS `horas_trabalhadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horas_trabalhadas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `inicio` datetime NOT NULL,
  `almoco` datetime NOT NULL,
  `termino` datetime NOT NULL,
  `projeto` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `horas` int NOT NULL,
  `minutos` int NOT NULL,
  `feriado` varchar(255) DEFAULT NULL,
  `nome_usuario` varchar(255) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `fim_almoco` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horas_trabalhadas`
--

LOCK TABLES `horas_trabalhadas` WRITE;
/*!40000 ALTER TABLE `horas_trabalhadas` DISABLE KEYS */;
INSERT INTO `horas_trabalhadas` VALUES (71,'2023-01-01 08:00:00','2023-01-01 12:00:00','2023-01-01 18:00:00','SASHI ADS','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, sem in auctor congue, ligula turpis varius magna, vitae rutrum erat enim et ex. Sed volutpat, velit vel laoreet viverra, velit quam semper justo, eu placerat ante lectus in nulla. Nullam aliquam laoreet justo, ac volutpat ipsum fringilla eu. Vivamus congue dictum elit, vel tincidunt velit pharetra vel. Sed auctor nulla vel risus blandit luctus. Ut et orci vel turpis tincidunt accumsan. In porta blandit dolor, eu mollis justo congue non.',9,0,'sim','jucio','2023-01-01','2023-01-01 13:00:00'),(72,'2023-02-01 08:00:00','2023-02-01 12:00:00','2023-02-01 18:00:00','SASHI ADS','Lorem ipsum....testing description',9,0,'nao','jucio','2023-02-01','2023-02-01 13:00:00');
/*!40000 ALTER TABLE `horas_trabalhadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projetos`
--

DROP TABLE IF EXISTS `projetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projetos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(30) NOT NULL,
  `bu` varchar(30) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `statusp` varchar(30) NOT NULL,
  `cliente` varchar(30) NOT NULL,
  `descricao` text NOT NULL,
  `engenheirochefe` varchar(30) NOT NULL,
  `gerentedeprojeto` varchar(30) NOT NULL,
  `cpm` varchar(30) NOT NULL,
  `projeto` varchar(30) NOT NULL,
  `os` varchar(30) NOT NULL,
  `horasfabrica` varchar(255) NOT NULL,
  `horasteste` varchar(255) NOT NULL,
  `servicosemcampo` varchar(255) NOT NULL,
  `servicosemgarantia` varchar(255) NOT NULL,
  `projetoeletrico` varchar(255) NOT NULL,
  `projetomecanico` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projetos`
--

LOCK TABLES `projetos` WRITE;
/*!40000 ALTER TABLE `projetos` DISABLE KEYS */;
INSERT INTO `projetos` VALUES (11,'563','MC','HH','APROVADO','SIEMENS/CO','Siemens/CO - Contecar - STS/RTG - ELETROMECANICO','JUCIO COSTA','KARA GOMES','DE OLIVEIRA, JULIA','SASHI ADS','60','4','3','2','1','5','2');
/*!40000 ALTER TABLE `projetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relatorio`
--

DROP TABLE IF EXISTS `relatorio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relatorio` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `cliente` varchar(255) NOT NULL,
  `local` varchar(255) NOT NULL,
  `resneopro` varchar(255) NOT NULL,
  `colaboradores` varchar(255) NOT NULL,
  `obra` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `respcliente` varchar(255) NOT NULL,
  `atividades` text NOT NULL,
  `fotos` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relatorio`
--

LOCK TABLES `relatorio` WRITE;
/*!40000 ALTER TABLE `relatorio` DISABLE KEYS */;
INSERT INTO `relatorio` VALUES (48,'SIEMENS/CO','djshdjs','fjdf','sfhjsh','hjshsd','2023-02-10','dsjdhjss',' hgh','foto_obra/63d345a6ec2e2.pdf','jucio'),(49,'SIEMENS/CO','djshdjs','fjdf','sfhjsh','hjshsd','2023-01-20','dsjdhjss','gh','foto_obra/63d34612a089b.pdf','jucio');
/*!40000 ALTER TABLE `relatorio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `administrador` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (8,'leandro_ceo','123',1),(22,'jucio','123',0),(23,'maria','123',1),(24,'teste1','123',0),(25,'teste2','123',0),(26,'jucio Gabriel araujo da costa','123',1),(27,'Leandro.teste','123',0),(28,'Leandro.J','123',0),(29,'teste001','123',0),(30,'teste002','123',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-07  0:08:00
