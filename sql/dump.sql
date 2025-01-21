-- MySQL dump 10.13  Distrib 9.1.0, for Win64 (x86_64)
--
-- Host: localhost    Database: sae_gds
-- ------------------------------------------------------
-- Server version	9.1.0

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
-- Current Database: `sae_gds`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `sae_gds` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `sae_gds`;

--
-- Table structure for table `action`
--

DROP TABLE IF EXISTS `action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `action` (
  `id_Departement` int DEFAULT NULL,
  `numSemestre` int DEFAULT NULL,
  `id` int DEFAULT NULL,
  `annee` int DEFAULT NULL,
  `id_Stage` int DEFAULT NULL,
  `id_Action` int NOT NULL AUTO_INCREMENT,
  `date_realisation` date DEFAULT NULL,
  `lienDocument` varchar(50) DEFAULT NULL,
  `id_TypeAction` int NOT NULL,
  `id_1` int NOT NULL,
  PRIMARY KEY (`id_Action`),
  KEY `id_Stage` (`id_Stage`),
  KEY `id_TypeAction` (`id_TypeAction`),
  KEY `id_1` (`id_1`),
  CONSTRAINT `action_ibfk_1` FOREIGN KEY (`id_Stage`) REFERENCES `stage` (`id_Stage`),
  CONSTRAINT `action_ibfk_2` FOREIGN KEY (`id_TypeAction`) REFERENCES `typeaction` (`id_TypeAction`),
  CONSTRAINT `action_ibfk_3` FOREIGN KEY (`id_1`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action`
--

LOCK TABLES `action` WRITE;
/*!40000 ALTER TABLE `action` DISABLE KEYS */;
INSERT INTO `action` VALUES (1,1,41,2025,15,1,'2025-01-27',NULL,1,41),(1,1,41,2025,15,2,'2025-02-03',NULL,2,41),(1,1,41,2025,15,3,'2025-02-10',NULL,3,41),(1,1,41,2025,15,4,'2025-02-03',NULL,4,41),(1,1,43,2025,16,5,'2025-01-31',NULL,1,43),(1,1,43,2025,16,6,'2025-02-07',NULL,2,43),(1,1,43,2025,16,7,'2025-02-14',NULL,3,43),(1,1,43,2025,16,8,'2025-02-07',NULL,4,43),(1,1,44,2025,17,9,'2025-01-23',NULL,1,44),(1,1,44,2025,17,10,'2025-01-30',NULL,2,44),(1,1,44,2025,17,11,'2025-02-06',NULL,3,44),(1,1,44,2025,17,12,'2025-01-30',NULL,4,44),(2,1,58,2025,19,14,'2025-01-28',NULL,1,58),(2,1,58,2025,19,15,'2025-02-04',NULL,2,58),(2,1,58,2025,19,16,'2025-02-11',NULL,3,58),(2,1,58,2025,19,17,'2025-02-04',NULL,4,58);
/*!40000 ALTER TABLE `action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrateur`
--

LOCK TABLES `administrateur` WRITE;
/*!40000 ALTER TABLE `administrateur` DISABLE KEYS */;
INSERT INTO `administrateur` VALUES (1);
/*!40000 ALTER TABLE `administrateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `annee`
--

DROP TABLE IF EXISTS `annee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `annee` (
  `annee` int NOT NULL,
  PRIMARY KEY (`annee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `annee`
--

LOCK TABLES `annee` WRITE;
/*!40000 ALTER TABLE `annee` DISABLE KEYS */;
INSERT INTO `annee` VALUES (2025),(2026);
/*!40000 ALTER TABLE `annee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departement`
--

DROP TABLE IF EXISTS `departement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departement` (
  `id_Departement` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_Departement`),
  UNIQUE KEY `libelle` (`libelle`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departement`
--

LOCK TABLES `departement` WRITE;
/*!40000 ALTER TABLE `departement` DISABLE KEYS */;
INSERT INTO `departement` VALUES (4,'GEA'),(2,'GEII'),(1,'Informatique'),(3,'Science de donnée');
/*!40000 ALTER TABLE `departement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enseignant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Bureau` varchar(50) DEFAULT NULL,
  `id_Departement` int NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `enseignant_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enseignant`
--

LOCK TABLES `enseignant` WRITE;
/*!40000 ALTER TABLE `enseignant` DISABLE KEYS */;
INSERT INTO `enseignant` VALUES (1,'Bureau 202',1),(2,'Bureau 203',1),(12,NULL,1),(13,NULL,1),(14,NULL,1),(15,NULL,1),(16,NULL,1),(21,NULL,1),(26,NULL,1),(32,NULL,1),(34,NULL,1),(38,NULL,1),(40,NULL,1),(42,NULL,1);
/*!40000 ALTER TABLE `enseignant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entreprise` (
  `id_Entreprise` int NOT NULL AUTO_INCREMENT,
  `adresse` varchar(50) DEFAULT NULL,
  `code_postal` int DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `indicationVisite` varchar(50) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_Entreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entreprise`
--

LOCK TABLES `entreprise` WRITE;
/*!40000 ALTER TABLE `entreprise` DISABLE KEYS */;
INSERT INTO `entreprise` VALUES (1,'5 rue des tulipes',75000,'Paris','','0102030405','Devea'),(2,'10 avenue de l\'Innovation',75001,'Paris','Prendre l\'ascenseur','0102030406','SpaceX');
/*!40000 ALTER TABLE `entreprise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etudiant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_Departement` int NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etudiant`
--

LOCK TABLES `etudiant` WRITE;
/*!40000 ALTER TABLE `etudiant` DISABLE KEYS */;
INSERT INTO `etudiant` VALUES (1,1),(2,1),(6,1),(7,1),(8,1),(10,1),(11,1),(17,1),(18,1),(19,1),(20,1),(22,1),(23,1),(30,1),(41,1),(43,1),(44,1),(58,2);
/*!40000 ALTER TABLE `etudiant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gere`
--

DROP TABLE IF EXISTS `gere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gere` (
  `id` int NOT NULL,
  `id_Departement` int NOT NULL,
  `numSemestre` int NOT NULL,
  PRIMARY KEY (`id`,`id_Departement`,`numSemestre`),
  KEY `id_Departement` (`id_Departement`,`numSemestre`),
  CONSTRAINT `gere_ibfk_1` FOREIGN KEY (`id`) REFERENCES `secretaire` (`id`),
  CONSTRAINT `gere_ibfk_2` FOREIGN KEY (`id_Departement`, `numSemestre`) REFERENCES `semestre` (`id_Departement`, `numSemestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gere`
--

LOCK TABLES `gere` WRITE;
/*!40000 ALTER TABLE `gere` DISABLE KEYS */;
INSERT INTO `gere` VALUES (1,1,1),(2,2,2);
/*!40000 ALTER TABLE `gere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inscription` (
  `id_Departement` int NOT NULL,
  `numSemestre` int NOT NULL,
  `id` int NOT NULL,
  `annee` int NOT NULL,
  PRIMARY KEY (`id_Departement`,`numSemestre`,`id`,`annee`),
  KEY `id` (`id`),
  KEY `annee` (`annee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscription`
--

LOCK TABLES `inscription` WRITE;
/*!40000 ALTER TABLE `inscription` DISABLE KEYS */;
INSERT INTO `inscription` VALUES (1,1,1,2025),(1,1,6,2025),(1,1,11,2025),(1,1,30,2025),(1,1,41,2025),(1,1,43,2025),(1,1,44,2025),(2,1,58,2025);
/*!40000 ALTER TABLE `inscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intervient`
--

DROP TABLE IF EXISTS `intervient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `intervient` (
  `id_Departement` int NOT NULL,
  `id` int NOT NULL,
  `specialise` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_Departement`,`id`),
  KEY `id` (`id`),
  CONSTRAINT `intervient_ibfk_1` FOREIGN KEY (`id_Departement`) REFERENCES `departement` (`id_Departement`),
  CONSTRAINT `intervient_ibfk_2` FOREIGN KEY (`id`) REFERENCES `enseignant` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intervient`
--

LOCK TABLES `intervient` WRITE;
/*!40000 ALTER TABLE `intervient` DISABLE KEYS */;
INSERT INTO `intervient` VALUES (1,1,'Algorithmique'),(2,2,'Analyse mathématique');
/*!40000 ALTER TABLE `intervient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secretaire`
--

DROP TABLE IF EXISTS `secretaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `secretaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Bureau` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `secretaire_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secretaire`
--

LOCK TABLES `secretaire` WRITE;
/*!40000 ALTER TABLE `secretaire` DISABLE KEYS */;
INSERT INTO `secretaire` VALUES (1,'Bureau 101'),(2,'Bureau 102');
/*!40000 ALTER TABLE `secretaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semestre`
--

DROP TABLE IF EXISTS `semestre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `semestre` (
  `id_Departement` int NOT NULL,
  `numSemestre` int NOT NULL,
  `id` int NOT NULL,
  `annee` int NOT NULL,
  PRIMARY KEY (`id_Departement`,`numSemestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semestre`
--

LOCK TABLES `semestre` WRITE;
/*!40000 ALTER TABLE `semestre` DISABLE KEYS */;
/*!40000 ALTER TABLE `semestre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage`
--

DROP TABLE IF EXISTS `stage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stage` (
  `id_Departement` int DEFAULT NULL,
  `numSemestre` int DEFAULT NULL,
  `id` int DEFAULT NULL,
  `annee` int DEFAULT NULL,
  `id_Stage` int NOT NULL AUTO_INCREMENT,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `date_soutenance` date DEFAULT NULL,
  `salle_soutenance` varchar(50) DEFAULT NULL,
  `id_1` int DEFAULT NULL,
  `id_2` int NOT NULL,
  `id_3` int NOT NULL,
  `taches` text,
  `description` text,
  PRIMARY KEY (`id_Stage`),
  KEY `id_Departement` (`id_Departement`,`numSemestre`,`id`,`annee`),
  KEY `id_1` (`id_1`),
  KEY `id_2` (`id_2`),
  KEY `id_3` (`id_3`),
  CONSTRAINT `stage_ibfk_1` FOREIGN KEY (`id_Departement`, `numSemestre`, `id`, `annee`) REFERENCES `inscription` (`id_Departement`, `numSemestre`, `id`, `annee`),
  CONSTRAINT `stage_ibfk_2` FOREIGN KEY (`id_1`) REFERENCES `enseignant` (`id`),
  CONSTRAINT `stage_ibfk_3` FOREIGN KEY (`id_2`) REFERENCES `enseignant` (`id`),
  CONSTRAINT `stage_ibfk_4` FOREIGN KEY (`id_3`) REFERENCES `tuteur_entreprise` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage`
--

LOCK TABLES `stage` WRITE;
/*!40000 ALTER TABLE `stage` DISABLE KEYS */;
INSERT INTO `stage` VALUES (1,1,1,2025,1,'2025-03-01','2025-08-31','Stage en développement','2025-08-01','Salle 101',1,2,1,'Analyse des besoins, développement front-end et back-end','Développement d\'une application web'),(1,1,6,2025,3,'2025-01-14','2025-01-31','web dev','2025-01-31','R201',2,1,1,'coder\r\nprogrammer','dev une appli'),(1,1,11,2025,4,'2025-01-25','2025-01-29','test','2025-01-17','R201',2,1,1,'fdsqfs','fdsqf'),(1,1,41,2025,5,'2025-01-20','2025-01-31','Système d&#039;exploitation','2025-01-21','R201',40,16,39,'programmer','coder'),(1,1,43,2025,16,'2025-01-24','2025-03-21','développeur web','2025-03-23','Q107',21,2,1,'TEST','TEST'),(1,1,44,2025,17,'2025-01-16','2025-01-24','testJeu','2025-01-30','eqzeqzezq',40,40,1,'zqeeeeeeeeeeeeeeeeeeee','qezeqqqq'),(2,1,58,2025,19,'2025-01-21','2025-01-31','stage','2025-01-31','R201',40,12,50,'fdsqfdsq','fdsqf');
/*!40000 ALTER TABLE `stage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tuteur_entreprise`
--

DROP TABLE IF EXISTS `tuteur_entreprise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tuteur_entreprise` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_Entreprise` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_Entreprise` (`id_Entreprise`),
  CONSTRAINT `tuteur_entreprise_ibfk_1` FOREIGN KEY (`id_Entreprise`) REFERENCES `entreprise` (`id_Entreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tuteur_entreprise`
--

LOCK TABLES `tuteur_entreprise` WRITE;
/*!40000 ALTER TABLE `tuteur_entreprise` DISABLE KEYS */;
INSERT INTO `tuteur_entreprise` VALUES (1,1),(2,2),(39,2),(50,2);
/*!40000 ALTER TABLE `tuteur_entreprise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `typeaction`
--

DROP TABLE IF EXISTS `typeaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `typeaction` (
  `id_TypeAction` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) DEFAULT NULL,
  `Executant` int DEFAULT NULL,
  `Destinataire` varchar(50) DEFAULT NULL,
  `delaiEnJours` int DEFAULT NULL,
  `ReferenceDelai` varchar(50) DEFAULT NULL,
  `requiertDoc` tinyint(1) DEFAULT NULL,
  `LienModeleDoc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_TypeAction`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typeaction`
--

LOCK TABLES `typeaction` WRITE;
/*!40000 ALTER TABLE `typeaction` DISABLE KEYS */;
INSERT INTO `typeaction` VALUES (1,'Compte rendu d\'installation',0,'tuteur pedagogique',7,'Début du stage',1,''),(2,'Prise de contact entreprise',1,'tuteur entreprise',14,'Début du stage',0,NULL),(3,'Planification de la soutenance',1,'jury',21,'Début du stage',0,NULL),(4,'Dépôt du rapport de stage',1,'tuteur entreprise-jury',14,'Début du stage',1,NULL);
/*!40000 ALTER TABLE `typeaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `motdepasse` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (1,'Rudiger','Marc','marc.rudiger@gmail.com','0601020305','rudiger_marc','password1'),(2,'Audibert','Laurent','laurent.audibert@univ-paris13.fr','0601020304','audibert_laurent','password2'),(3,'Dupont','Alice','alice.dupont@etu.univ.fr','0601020301','alice_etu','password_hash'),(4,'Martin','Jean','jean.martin@univ.fr','0601020302','jean_tuteur','password_hash'),(5,'Bernard','Paul','paul.bernard@company.com','0601020303','paul_tuteur','password_hash'),(6,'Hadri','Anas','haanas2020@gmail.com','0750011950','12301162','$2y$10$CGyfZZudxRujBXKhI1SpB.qi8S/pgB.m5gdtN8AhOpwOAPsrLC986'),(7,'Ferard','Lucas','lucas.ferard@gmail.com','0783461216','12305189','$2y$10$78DtGzkFfSbJb2IH61ZGy.jf8FrYR8xKleFIAJA8N3Q69JqFFzQuO'),(8,'brunel','benoit','beoit.brunel@gmail.com','1234567890','12316179','$2y$10$UQ3KIVnr3YMTiwb62uX5EOOAN.odjwTYLtzHw.Do5SwvAWfOljPfq'),(10,'dulai','jorawar','jo@gmail.com','0676545658','12316176','$2y$10$ipJgPjZIVXMAT.6gxkWz4OM/C08PTWvi3beWlcYwMdUe3B2zBN2Oy'),(11,'monteiro','gilson','test@gmail.com','123132132','12121212','$2y$10$fIB6Q.k/JnzJytmEZaL5c.i5BDvI7fkAyo/CbecEccjcdAnaSzHUu'),(12,'Finta','Lucian','lucian.finta@univ-paris13.fr','0756437765','L.finta','$2y$10$3rhOmc9vpQFAuUNmh7xZEexBJOdOwbJE2HzNO17OOz2nITXc6Y6qC'),(13,'Bamba','Aboudouramane','abd.bamba@univ-paris13.fr','0758994532','Abd.bamba','$2y$10$AFL/3h7cQHHsniUKnURihuLK/.NI/fQdjASBk8pvuTiB9xAU8SkuC'),(14,'Bacher','Axel','axel.bacher@univ-paris13.fr','0788664433','Axel.bacher','$2y$10$E/9/TLA2fzWRugHd5QAXH.Q1fkPx6CwWisX91vEW7EEudA.6VC5FK'),(15,'Hebert','David','david.hebert@univ-paris13.fr','0799668954','David.hebert','$2y$10$EKi2Pw6To0TVzeEqbjltBOJMTPHRegLgcZjOD5CUhOArCwM.dAPIK'),(16,'Butelle','Franck','franck.butelle@univ-paris13.fr','0756321155','Franck.butelle','$2y$10$4mJHF.3CxG80EIztPBjPU.Kc14qOafcZyHJQ1k3mzsLuGhGLgj5Z2'),(17,'Abdoul','Sajith','sajith.abdoul@univ-paris13.fr','0756432134','Sajith.abdoul','$2y$10$p/mlnpSUbov55CX0X3TbweWCLOudFVaUmFoj1AXKWB68cPH7Dw57a'),(18,'Khessavane','Dhanoush','dhanoush.kessavane@univ-paris13.fr','0789667545','Dhanoush.khessavane','$2y$10$8YcRFvlVOyFr90jbif0MleXpIeesYDPsJYcgzxCKeDHDpll26TTby'),(19,'Gnanapragasam','Royston','royston.gnanapragasam@univ-paris13.fr','0789009865','Royston.gnanapragasam','$2y$10$cNjBSEiU57X9pH.33Q94/.SAOeZXrRhbrfk.He6LNz1NKRhD62FGS'),(20,'Sadki','Mehdi','mehdi.sadki@univ-paris13.fr','0788654533','Mehdi.sadki','$2y$10$DByP0gGn0VveboNXLJzjMuT6bsumv5vVyOqP.QebarQVtTfrSWFRC'),(21,'Gérard','Pierre','pierre.gerard@univ-paris13.fr','0790887965','Pierre.gerard','$2y$10$8b8IXxtw0PiCImfHY73Tb.gUDzbjGup9ikK1Du9ZCOlKTldbefEry'),(22,'Li','Olivier','olivier.li@univ-paris13.fr','0753121134','Olivier.li','$2y$10$RooeFM4HI3oe10SQTn84VeO2LAwLISZmGcEMwZowRb2dJgKzUBH7C'),(23,'Sekar','Cyrille','cyrille.sekar@univ-paris13.fr','0756446355','Cyrille.sekar','$2y$10$G/yLEGgTzeYEtrFZni7JTOApCjWcuD32MX4xtUceeWdF.kvBJpNkK'),(26,'Hellegouarch','Pascale','pascale.hellegouarch@univ-paris13.fr','0756321435','Pascale.hellegouarch','$2y$10$LwcPO.ySwyLZZbTU5VCy7uY4C1wh7o2gB6ic93djFKro6RQK2OcCq'),(30,'test','test','test@gmail.com','15465','aaaa','$2y$10$2CmMxAFo3J3IchQXHgP7M..iessUVAQXuX3Q4KKZ61S9P3uTMDbyq'),(31,'Mezhoud','Lounes','lmezhoud@gmail.com','0612345678','LMezhoud','$2y$10$8bREHpAFBZNjFHgh3gxNPeWdEgultUNMjeXm5ZlF5AsomIKJtRRaS'),(32,'test','Jean','a@gmail.com','0123456789','Jean','$2y$10$r2xz1OuqeeHzlJWnQ7gRL.GCLVqNNblKIq2q5olBgHywpRWtHvEgq'),(33,'Martin','Jean','jean.martin@devea.com','0769089077','Jean.martin','$2y$10$5igTJNEsurihnkQVnRwnA.xjDaQCqjDCpAu70mxuRr2DgEcPg5HXK'),(34,'Bonino','Marc','marc.bonino@univ-paris13.fr','0735461456','Marc.bonino','$2y$10$AhcM.54v7IuQ3t2yQN4E4.CBGT25N/lnfOykvhQZR4GSwVii.NNZe'),(35,'a','a','a@a.a','1','a','$2y$10$SYo2TWEpqTr8rz2uctlHd.eufZEk7rzx4vVFQpWCw9LBshXCEXRde'),(36,'b','b','b@b.b','2','b','$2y$10$hD2mbOxSg5oiipZYPEh.A.VjV/Vtc6CnIoKoJnPH.xO.xZXggRpwu'),(37,'Musk','Elon','elon@x.com','555','elonmusk','$2y$10$MHiXn7XagooEEIQt1tAHP.ZgaaFy0tf2pkGv4O1tTpqlapFdjJqSW'),(38,'z','z','z@z.z','26','z','$2y$10$zUj49RqqQQMDx8ulNtvQBu7Vjz8X6Ebb.PHq.HIOOpnUnbLwX3XHK'),(39,'Champagne','Jason','ja.champagne@gmail.com','0701020304','ja.champagne','$2y$10$EiacdoinZih342tENUZQqeg5BO.8Bdqpf65t93P1r7AtQ5h8W/EDa'),(40,'Blaze','Axel','axel.blaze@gmail.com','0701010101','axel.blaze','$2y$10$HPoBQ9c7nMCoMNUPuJIqQO/Elo/F0DtgwhzFiUgjwRv3C.U3F6lOe'),(41,'Balili','Enzo','enzo.balili@gmail.com','0701010101','enzo.bal','$2y$10$VtUMdjqskj.jYfoC9AKoiO/ZwSrUEqfk.GDeR9shjmWVhC6Iovuzq'),(42,'Nassiet','Aurelie','aurelie.nassiet@univ-paris13.fr','0736748399','Aurelie.nassiet','$2y$10$8QtH75Frl5HgM0aTEoa1h.jKEm/bgvgawfNXJPNwU9AeqevOTf.by'),(43,'laribi','younes','younes.laribi@gmail.com','0645782156','12316175','$2y$10$BxSTpxy9hoRy4rkX/CHG7e6OCACgrh1wmw.m3N05WMSvCRRJt/epC'),(44,'Traore','Karim','karim@gmail.com','0524257859','KarimIsCoding','$2y$10$AePxNmdc1sl.zxol0LqnD.OZoY55d9/dG20ytRIH94bd3v8IvDcc6'),(45,'Humeau','Emryc','emryc.humeau@edu.univ-paris13.fr','0782874293','EEEmryc','$2y$10$1PZUyI12EKIi5jlnVFG7I.pry9lsVDwfAaKy/FBPSXFcyMTP6Tsye'),(46,'laribi','younes','younes.laribi@gmail.com','0676545658','younes.laribi','$2y$10$ZR/vPE4TBDPeSr4rpIeUjuu07Ipf47TEJHJFYCqErzRvFTPIcEZWG'),(50,'Musk','Elon','elon.musk@gmail.com','0710203040','elon.musk','$2y$10$ww0J6FnQhcht6U6AJDcHuONxBl0d/qt2RGNNC0QISOw8A6O0k6duq'),(53,'a','a','anas@gmail.com','0710203040','a.a','$2y$10$rVOsTsgSPnO13DVimFHyrOGOFfOOONmv/UezJPgwg.hNYgbWC.5Ce'),(54,'TestEMryc','Emryc','TESTEMRYC@gmail.com','0782874394','TESTTESTEMryc','$2y$10$UMiEQNa48DP7HOh0wTwlRu8jnF4CJEjBjghpoOVe7/DMY19mhO6aK'),(55,'TESTTTTTTTT','TESTEST','EMRYCTEST@GMAIL.COM','0682874293','EMFCVTEST','$2y$10$o3g2peK5dM36qn9g7rqbi.Hirk3yYcuo5BXzPSbEiMhGkPPjUC1kO'),(56,'hadri','anas','haanas2020@gmail.com','fdsq','aa','$2y$10$qxZX5UbhBMWVrk1FJfbFtewXUQFUVbiIBlcgJYZ./aHw4JZ0vLRyy'),(57,'aaa','aaa','haanas2020@gmail.com','afdsfs','aaa','$2y$10$NUo651mymmT0/XW44LXYROAkqg8Dll9dBaGhupdRWtNmdpyIDRmja'),(58,'TESTESTEST','ETSTEST','zemrjr@gmail.com','0782845693','TEEEEEEEEST','$2y$10$1vTgS2Bult2zS5KwunSIFOBAboT94hvL/OuAWzn08.DrxSREywHKC');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-21 23:58:23
