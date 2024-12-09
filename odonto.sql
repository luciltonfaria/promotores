/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.5.2-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: odonto_db
-- ------------------------------------------------------
-- Server version	11.5.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accounts_user_id_foreign` (`user_id`),
  CONSTRAINT `accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anamnese`
--

DROP TABLE IF EXISTS `anamnese`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anamnese` (
  `codigo_pacient` double NOT NULL,
  `probl_saude` double NOT NULL,
  `probl_saude_quais` varchar(50) DEFAULT NULL,
  `toma_medicamentos` double NOT NULL,
  `toma_medic_quais` varchar(50) DEFAULT NULL,
  `gravida` double NOT NULL,
  `anestesia` double NOT NULL,
  `sentiu_mal` double NOT NULL,
  `alergic_medic` double NOT NULL,
  `alergic_medic_quais` varchar(50) DEFAULT NULL,
  `perdid_peso` double NOT NULL,
  `diabetis` double NOT NULL,
  `probl_cora_` double NOT NULL,
  `probl_cora__quais` varchar(50) DEFAULT NULL,
  `reumatica` double NOT NULL,
  `sangra_muit` double NOT NULL,
  `hepatite` double NOT NULL,
  `cirugia` double NOT NULL,
  `cirugia_quais` varchar(50) DEFAULT NULL,
  `gengiva__sangr` double NOT NULL,
  `mobil_dentes` double NOT NULL,
  `mobil_quais` varchar(50) DEFAULT NULL,
  `escova_dentes` varchar(15) DEFAULT NULL,
  `fio_dental` double NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `sentiu_anestesia` varchar(1) DEFAULT NULL,
  `febre` varchar(1) DEFAULT NULL,
  `tonturas` varchar(1) DEFAULT NULL,
  `aspirina` varchar(1) DEFAULT NULL,
  `fuma` varchar(1) DEFAULT NULL,
  `bebe` varchar(1) DEFAULT NULL,
  `penicilina` varchar(1) DEFAULT NULL,
  `anemia` varchar(1) DEFAULT NULL,
  `infecciosa` varchar(1) DEFAULT NULL,
  `disturbio_neu` varchar(1) DEFAULT NULL,
  `problema_tto` varchar(1) DEFAULT NULL,
  `probl_tto_quais` varchar(30) DEFAULT NULL,
  `anticoagulante` varchar(1) DEFAULT NULL,
  `hemorragia` varchar(1) DEFAULT NULL,
  `complemento` varchar(60) DEFAULT NULL,
  `eplepsia` varchar(1) DEFAULT NULL,
  `codigo` int(11) NOT NULL,
  `hipertensao` varchar(1) DEFAULT NULL,
  `pa` varchar(10) DEFAULT NULL,
  `chb` varchar(20) DEFAULT NULL,
  `oclusao` varchar(20) DEFAULT NULL,
  `gengivas` varchar(20) DEFAULT NULL,
  `mucosa` varchar(20) DEFAULT NULL,
  `aboboda` varchar(20) DEFAULT NULL,
  `assoalho` varchar(20) DEFAULT NULL,
  `lingua` varchar(20) DEFAULT NULL,
  `labios` varchar(20) DEFAULT NULL,
  `bochechas` varchar(20) DEFAULT NULL,
  `outros` varchar(40) DEFAULT NULL,
  `pergunta16` varchar(45) DEFAULT NULL,
  `resposta16` double DEFAULT NULL,
  `complem16` varchar(45) DEFAULT NULL,
  `pergunta17` varchar(45) DEFAULT NULL,
  `resposta17` double DEFAULT NULL,
  `complem17` varchar(45) DEFAULT NULL,
  `pergunta18` varchar(45) DEFAULT NULL,
  `resposta18` double DEFAULT NULL,
  `complem18` varchar(45) DEFAULT NULL,
  `pergunta19` varchar(45) DEFAULT NULL,
  `resposta19` double DEFAULT NULL,
  `complem19` varchar(45) DEFAULT NULL,
  `pergunta20` varchar(45) DEFAULT NULL,
  `resposta20` double DEFAULT NULL,
  `complem20` varchar(45) DEFAULT NULL,
  `pergunta21` varchar(45) DEFAULT NULL,
  `complen21` varchar(45) DEFAULT NULL,
  `pergunta22` varchar(45) DEFAULT NULL,
  `resposta22` double DEFAULT NULL,
  `complem22` varchar(120) DEFAULT NULL,
  `qtd_dia_validade` int(11) DEFAULT NULL,
  `data_validade` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anamnese`
--

LOCK TABLES `anamnese` WRITE;
/*!40000 ALTER TABLE `anamnese` DISABLE KEYS */;
/*!40000 ALTER TABLE `anamnese` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atestados`
--

DROP TABLE IF EXISTS `atestados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atestados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `nome_paciente` varchar(255) NOT NULL,
  `codigo_paciente` varchar(255) NOT NULL,
  `codigo_profissional` varchar(255) NOT NULL,
  `data_comparecimento` date DEFAULT NULL,
  `hora_comparecimento` time DEFAULT NULL,
  `dias_afastamento` int(11) DEFAULT NULL,
  `cid10` varchar(255) DEFAULT NULL,
  `procedimento_descricao` text DEFAULT NULL,
  `data_impressao` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atestados`
--

LOCK TABLES `atestados` WRITE;
/*!40000 ALTER TABLE `atestados` DISABLE KEYS */;
/*!40000 ALTER TABLE `atestados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `convenios`
--

DROP TABLE IF EXISTS `convenios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convenios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `tabela_precos` varchar(255) NOT NULL,
  `pericia` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `convenios_descricao_unique` (`descricao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `convenios`
--

LOCK TABLES `convenios` WRITE;
/*!40000 ALTER TABLE `convenios` DISABLE KEYS */;
/*!40000 ALTER TABLE `convenios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especialidades` (
  `cod_espec` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `especialidade` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cod_espec`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidades`
--

LOCK TABLES `especialidades` WRITE;
/*!40000 ALTER TABLE `especialidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `especialidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `sigla` char(2) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`sigla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES
('MG','Minas Gerais'),
('SP','São Paulo');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagens_orcamentos`
--

DROP TABLE IF EXISTS `imagens_orcamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagens_orcamentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orcamento_id` bigint(20) unsigned NOT NULL,
  `path_imagem` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `imagens_orcamentos_orcamento_id_foreign` (`orcamento_id`),
  CONSTRAINT `imagens_orcamentos_orcamento_id_foreign` FOREIGN KEY (`orcamento_id`) REFERENCES `orcamento` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagens_orcamentos`
--

LOCK TABLES `imagens_orcamentos` WRITE;
/*!40000 ALTER TABLE `imagens_orcamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `imagens_orcamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicamentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `medicamento` varchar(255) NOT NULL,
  `quant` varchar(255) NOT NULL,
  `posologia` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `medicamentos_medicamento_unique` (`medicamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamentos`
--

LOCK TABLES `medicamentos` WRITE;
/*!40000 ALTER TABLE `medicamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),
(4,'2019_08_19_000000_create_failed_jobs_table',1),
(5,'2019_12_14_000001_create_personal_access_tokens_table',1),
(6,'2024_05_30_164445_create_procedimentos_table',1),
(7,'2024_05_30_175315_create_estados',1),
(8,'2024_05_30_211610_create_sessions_table',1),
(9,'2024_05_31_142249_create_medicamentos',1),
(10,'2024_05_31_214005_create_convenios',1),
(11,'2024_05_31_900001_create_pacientes_table_custom',1),
(12,'2024_06_02_124533_create_profissionais',1),
(13,'2024_06_02_191327_create_especialidades',1),
(14,'2024_06_04_012017_create_atestados_table',1),
(15,'2024_06_09_224112_create_receitas_table',1),
(16,'2024_06_09_224315_create_receitas_medicamentos_table',1),
(17,'2024_06_09_234851_add_tipo_receita_to_receitas_table',1),
(18,'2024_06_14_204230_create_recibos_table',1),
(19,'2024_06_16_182818_create_orcamento_table',1),
(20,'2024_06_16_182824_create_servicos_orcamentos_table',1),
(21,'2024_06_16_182829_create_imagens_orcamentos_table',1),
(22,'2024_06_17_213748_create_accounts_table',1),
(23,'2024_06_17_213842_create_transactions_table',1),
(24,'2024_07_13_133824_add_photo_to_users_table',1),
(25,'2024_07_13_134701_add_level_and_professional_id_to_users_table',1),
(26,'2024_07_14_110806_add_is_admin_to_users_table',1),
(27,'2024_09_30_190358_create_tratamento',2),
(28,'2024_09_30_194509_create_anamnese',2),
(29,'2024_09_30_195513_create_pagamentos_tratamentos',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orcamento`
--

DROP TABLE IF EXISTS `orcamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orcamento` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `nome` varchar(80) NOT NULL,
  `endereco` varchar(60) NOT NULL,
  `bairro` varchar(40) NOT NULL,
  `cep` varchar(30) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cpf` varchar(18) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefone1` varchar(14) NOT NULL,
  `tipo1` enum('residencial','comercial','whatsapp') NOT NULL,
  `telefone2` varchar(14) DEFAULT NULL,
  `tipo2` enum('residencial','comercial','whatsapp') DEFAULT NULL,
  `telefone3` varchar(14) DEFAULT NULL,
  `tipo3` enum('residencial','comercial','whatsapp') DEFAULT NULL,
  `valor` double NOT NULL,
  `convenio_id` int(11) DEFAULT NULL,
  `parcelas` int(11) DEFAULT NULL,
  `data_parcela1` timestamp NULL DEFAULT NULL,
  `valor_parcela1` double DEFAULT NULL,
  `data_parcela2` timestamp NULL DEFAULT NULL,
  `valor_parcela2` double DEFAULT NULL,
  `data_parcela3` timestamp NULL DEFAULT NULL,
  `valor_parcela3` double DEFAULT NULL,
  `data_parcela4` timestamp NULL DEFAULT NULL,
  `valor_parcela4` double DEFAULT NULL,
  `data_parcela5` timestamp NULL DEFAULT NULL,
  `valor_parcela5` double DEFAULT NULL,
  `data_parcela6` timestamp NULL DEFAULT NULL,
  `valor_parcela6` double DEFAULT NULL,
  `data_parcela7` timestamp NULL DEFAULT NULL,
  `valor_parcela7` double DEFAULT NULL,
  `data_parcela8` timestamp NULL DEFAULT NULL,
  `valor_parcela8` double DEFAULT NULL,
  `data_parcela9` timestamp NULL DEFAULT NULL,
  `valor_parcela9` double DEFAULT NULL,
  `data_parcela10` timestamp NULL DEFAULT NULL,
  `valor_parcela10` double DEFAULT NULL,
  `data_parcela11` timestamp NULL DEFAULT NULL,
  `valor_parcela11` double DEFAULT NULL,
  `data_parcela12` timestamp NULL DEFAULT NULL,
  `valor_parcela12` double DEFAULT NULL,
  `desconto_percentual` double DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valor_total` double DEFAULT NULL,
  `data1pagto` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orcamento`
--

LOCK TABLES `orcamento` WRITE;
/*!40000 ALTER TABLE `orcamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `orcamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes` (
  `codigo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(35) DEFAULT NULL,
  `dt_nasc` date DEFAULT NULL,
  `dt_cad` date DEFAULT NULL,
  `profissao` varchar(20) DEFAULT NULL,
  `estado_civil` char(1) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `convenio` double DEFAULT NULL,
  `dt_per_ini` date DEFAULT NULL,
  `dt_per_fin` date DEFAULT NULL,
  `per_status` char(1) DEFAULT NULL,
  `indicacao` varchar(30) DEFAULT NULL,
  `end_resid` varchar(50) DEFAULT NULL,
  `bairro_resid` varchar(20) DEFAULT NULL,
  `cidade_resid` varchar(20) DEFAULT NULL,
  `estado_resid` char(2) DEFAULT NULL,
  `cep_resid` varchar(10) DEFAULT NULL,
  `telef_resid` varchar(16) DEFAULT NULL,
  `telef_recado_resid` varchar(16) DEFAULT NULL,
  `celular` varchar(16) DEFAULT NULL,
  `end_comerc` varchar(30) DEFAULT NULL,
  `bairro_comerc` varchar(20) DEFAULT NULL,
  `cidade_comerc` varchar(20) DEFAULT NULL,
  `estado_comerc` char(2) DEFAULT NULL,
  `cep_comerc` varchar(10) DEFAULT NULL,
  `telef_comerc` varchar(16) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `obsev` text DEFAULT NULL,
  `niver` varchar(4) DEFAULT NULL,
  `nro_reg` varchar(13) DEFAULT NULL,
  `nome_seg` varchar(35) DEFAULT NULL,
  `foto` varchar(120) DEFAULT NULL,
  `telef2_resid` varchar(16) DEFAULT NULL,
  `telef2_comer` varchar(16) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rg` varchar(15) DEFAULT NULL,
  `org_rg` varchar(15) DEFAULT NULL,
  `filiacao_mae` varchar(40) DEFAULT NULL,
  `telefone1_tipo` varchar(30) DEFAULT NULL,
  `telefone2_tipo` varchar(30) DEFAULT NULL,
  `telefone3_tipo` varchar(30) DEFAULT NULL,
  `telefone4_tipo` varchar(20) DEFAULT NULL,
  `obs_trat` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`codigo`),
  KEY `pacientes_estado_resid_foreign` (`estado_resid`),
  CONSTRAINT `pacientes_estado_resid_foreign` FOREIGN KEY (`estado_resid`) REFERENCES `estados` (`sigla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagamentos_tratamentos`
--

DROP TABLE IF EXISTS `pagamentos_tratamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagamentos_tratamentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tratamento_id` int(11) NOT NULL,
  `data_parcela` timestamp NULL DEFAULT NULL,
  `valor_parcela` double DEFAULT NULL,
  `data_pagto` timestamp NULL DEFAULT NULL,
  `valor_pagto` double DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `data_lancamento` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagamentos_tratamentos`
--

LOCK TABLES `pagamentos_tratamentos` WRITE;
/*!40000 ALTER TABLE `pagamentos_tratamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagamentos_tratamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procedimentos`
--

DROP TABLE IF EXISTS `procedimentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procedimentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `codigo` varchar(10) DEFAULT NULL,
  `valor_base` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procedimentos`
--

LOCK TABLES `procedimentos` WRITE;
/*!40000 ALTER TABLE `procedimentos` DISABLE KEYS */;
INSERT INTO `procedimentos` VALUES
(1,'Implate Dentário X','2024-09-27 13:36:26','2024-09-27 13:36:26',NULL,NULL),
(2,'Aspiração de Agua','2024-09-27 14:05:38','2024-09-27 14:27:53','A2K',1620);
/*!40000 ALTER TABLE `procedimentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profissionais`
--

DROP TABLE IF EXISTS `profissionais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profissionais` (
  `codigo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(35) DEFAULT NULL,
  `dt_nasc` date DEFAULT NULL,
  `dt_cad` date DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `end_resid` varchar(50) DEFAULT NULL,
  `bairro_resid` varchar(20) DEFAULT NULL,
  `cidade_resid` varchar(20) DEFAULT NULL,
  `estado_resid` char(2) DEFAULT NULL,
  `cep_resid` varchar(10) DEFAULT NULL,
  `telef_resid` varchar(16) DEFAULT NULL,
  `celular` varchar(16) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `obsev` text DEFAULT NULL,
  `nro_conselho` varchar(13) DEFAULT NULL,
  `conselho` varchar(35) DEFAULT NULL,
  `foto` varchar(120) DEFAULT NULL,
  `telef2_resid` varchar(16) DEFAULT NULL,
  `telef2_comer` varchar(16) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rg` varchar(15) DEFAULT NULL,
  `org_rg` varchar(15) DEFAULT NULL,
  `filiacao_mae` varchar(40) DEFAULT NULL,
  `observacoes` longtext DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `profissionais_estado_resid_foreign` (`estado_resid`),
  CONSTRAINT `profissionais_estado_resid_foreign` FOREIGN KEY (`estado_resid`) REFERENCES `estados` (`sigla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profissionais`
--

LOCK TABLES `profissionais` WRITE;
/*!40000 ALTER TABLE `profissionais` DISABLE KEYS */;
/*!40000 ALTER TABLE `profissionais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receitas`
--

DROP TABLE IF EXISTS `receitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receitas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `nome_paciente` varchar(255) NOT NULL,
  `codigo_profissional` bigint(20) unsigned NOT NULL,
  `tipo_receita` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receitas_codigo_profissional_foreign` (`codigo_profissional`),
  CONSTRAINT `receitas_codigo_profissional_foreign` FOREIGN KEY (`codigo_profissional`) REFERENCES `profissionais` (`codigo`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receitas`
--

LOCK TABLES `receitas` WRITE;
/*!40000 ALTER TABLE `receitas` DISABLE KEYS */;
/*!40000 ALTER TABLE `receitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receitas_medicamentos`
--

DROP TABLE IF EXISTS `receitas_medicamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receitas_medicamentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `receita_id` bigint(20) unsigned NOT NULL,
  `medicamento` varchar(255) NOT NULL,
  `quantidade` varchar(255) NOT NULL,
  `modo_usar` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receitas_medicamentos_receita_id_foreign` (`receita_id`),
  CONSTRAINT `receitas_medicamentos_receita_id_foreign` FOREIGN KEY (`receita_id`) REFERENCES `receitas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receitas_medicamentos`
--

LOCK TABLES `receitas_medicamentos` WRITE;
/*!40000 ALTER TABLE `receitas_medicamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `receitas_medicamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recibos`
--

DROP TABLE IF EXISTS `recibos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recibos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `emitido` enum('S','N') NOT NULL DEFAULT 'N',
  `dt_emissao` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recibos`
--

LOCK TABLES `recibos` WRITE;
/*!40000 ALTER TABLE `recibos` DISABLE KEYS */;
/*!40000 ALTER TABLE `recibos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos_orcamentos`
--

DROP TABLE IF EXISTS `servicos_orcamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicos_orcamentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orcamento_id` bigint(20) unsigned NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `dentes` varchar(255) NOT NULL,
  `faces` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `servicos_orcamentos_orcamento_id_foreign` (`orcamento_id`),
  CONSTRAINT `servicos_orcamentos_orcamento_id_foreign` FOREIGN KEY (`orcamento_id`) REFERENCES `orcamento` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos_orcamentos`
--

LOCK TABLES `servicos_orcamentos` WRITE;
/*!40000 ALTER TABLE `servicos_orcamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `servicos_orcamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('vzNaPrvE8cLSEY92R304IYbzsZsPdo9liXN9eftT',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoibVJ3VjVTNXZGSzF2MUFSUk9FYzlUVVdXQzlUZ25ubEVqOXc0dGtmRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wYWNpZW50ZXMvY3JlYXRlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3Mjc3MzgxNjI7fX0=',1727738728);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `type` enum('credit','debit') NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_account_id_foreign` (`account_id`),
  CONSTRAINT `transactions_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tratamentos`
--

DROP TABLE IF EXISTS `tratamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tratamentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `orcamento_id` int(11) NOT NULL,
  `contrato_id` int(11) NOT NULL,
  `especialidade_id` int(11) DEFAULT NULL,
  `convenio_id` int(11) DEFAULT NULL,
  `data_inicio` date NOT NULL,
  `status` int(11) NOT NULL,
  `indicacao` int(11) NOT NULL,
  `pericia_inical` date NOT NULL,
  `pericia_final` int(11) NOT NULL,
  `odontograma_l1` varchar(300) NOT NULL,
  `odontograma_l2` varchar(300) NOT NULL,
  `odontograma_l3` varchar(300) NOT NULL,
  `odontograma_l4` varchar(300) NOT NULL,
  `observacao` text DEFAULT NULL,
  `data_retorno` date NOT NULL,
  `observacao_retorno` text DEFAULT NULL,
  `observacao_financeito` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tratamentos`
--

LOCK TABLES `tratamentos` WRITE;
/*!40000 ALTER TABLE `tratamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tratamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `level` varchar(255) NOT NULL DEFAULT 'user',
  `professional_id` bigint(20) unsigned DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Lucilton Faria','lucilton@gmail.com',NULL,'$2y$10$60Z8PugMxvKDhozbG1jQK.z07Gkxo6P6ZprTfz0zocRrb/7P3Yry6',NULL,NULL,NULL,NULL,NULL,'photos/mWs3UDRfef4bzQ9h2H3SZDYx2xO7XIuO7t4NZsHo.jpg',NULL,NULL,'photos/mWs3UDRfef4bzQ9h2H3SZDYx2xO7XIuO7t4NZsHo.jpg','admin',NULL,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2024-10-01 17:08:23
