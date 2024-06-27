-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.3.38-MariaDB-0ubuntu0.20.04.1 - Ubuntu 20.04
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para instituto-caranguejo
CREATE DATABASE IF NOT EXISTS `instituto-caranguejo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `instituto-caranguejo`;

-- Copiando estrutura para tabela instituto-caranguejo.activities
CREATE TABLE IF NOT EXISTS `activities` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `project_id` bigint(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela instituto-caranguejo.activities: ~2 rows (aproximadamente)
INSERT INTO `activities` (`id`, `name`, `slug`, `link`, `date`, `project_id`) VALUES
	(10, 'Atividade 1', 'atividade-1', 'Atividade 1 Link', '2024-06-24', 40),
	(13, 'Teste', 'teste', '', '2024-06-27', 41);

-- Copiando estrutura para tabela instituto-caranguejo.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela instituto-caranguejo.projects: ~2 rows (aproximadamente)
INSERT INTO `projects` (`id`, `name`, `slug`, `description`, `link`, `date`) VALUES
	(40, 'Projeto 1', 'projeto-1-1', 'Projeto 1 Descrição', 'Projeto 1 Link', '2024-06-16'),
	(41, 'Projeto 2', 'projeto-2-1', 'Projeto 2 Descrição', 'Projeto 2 Link', '2024-06-16');

-- Copiando estrutura para tabela instituto-caranguejo.student_activities
CREATE TABLE IF NOT EXISTS `student_activities` (
  `id` bigint(100) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(100) DEFAULT NULL,
  `activity_id` bigint(100) DEFAULT NULL,
  `score` decimal(65,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela instituto-caranguejo.student_activities: ~6 rows (aproximadamente)
INSERT INTO `student_activities` (`id`, `user_id`, `activity_id`, `score`) VALUES
	(15, 49, 10, 9),
	(17, 50, 10, NULL),
	(18, 51, 10, 6),
	(20, 49, 13, 8),
	(22, 51, 13, NULL),
	(25, 55, 10, NULL);

-- Copiando estrutura para tabela instituto-caranguejo.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `registration_number` bigint(100) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL,
  `institution` varchar(150) DEFAULT NULL,
  `hours_to_be_validated` int(100) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `role` bigint(100) DEFAULT NULL,
  `approved` int(100) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela instituto-caranguejo.users: ~4 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `registration_number`, `course`, `year`, `institution`, `hours_to_be_validated`, `password`, `role`, `approved`) VALUES
	(21, 'PAC Admin', 'pac@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$9g9ZiW.j3I.kPbt0rduPtukQKlIvTWO.P3kkV6oNkPaxorqXKit32', 1, 1),
	(54, 'Instituto Caranguejo', 'institutocaranguejo@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$JhZrqB0dJBlNKjWtuCsN3OP3R37bvR8IN1GvvkhRnM.lApiQD0KeO', 1, 1),
	(55, 'Aluno Exemplo', 'aluno@exemplo.com', '(11) 1 1111-1111', 111111111, 'Engenharia de Software', '2', 'Católica SC', 100, '$2y$10$Qa5NVoe0Yv5QroMiqVsC8.y6SBpyD0/mJ8vqoMubGxOa/vxsLzSdS', 3, 0),
	(56, 'Funcionário Exemplo', 'funcionario@exemplo.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$TtTozIOKHTauzrcyEii4sufoptX9i51pZxqYUP8igGzZr5FGFKeEe', 2, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
