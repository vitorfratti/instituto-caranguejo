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

-- Copiando estrutura para tabela instituto-caranguejo.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela instituto-caranguejo.projects: ~2 rows (aproximadamente)
INSERT INTO `projects` (`id`, `name`, `date`, `description`, `link`) VALUES
	(37, 'Projeto Teste', '2024-06-16', 'Teste', 'Teste'),
	(38, 'Projeto Teste 2', '2024-06-16', 'Teste', 'Teste');

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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela instituto-caranguejo.users: ~3 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `registration_number`, `course`, `year`, `institution`, `hours_to_be_validated`, `password`, `role`, `approved`) VALUES
	(21, 'Vitor Admin', 'vitor@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$pj2EoVbHd0KR.shprQZUluQlLYxxPnt5vkus3ddJd2ZYyZXaIO2Ge', 1, 1),
	(48, 'Vitor Funcionário', 'vitor@funcionario.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$KcBwqBm0aIEIbLgqKi/s7.hua3i83uijPpHvH6M5QF5K.pv3TEhna', 2, 0),
	(49, 'Vitor', 'vitor@aluno.com', '(11) 1 1111-1111', 11111111111111, 'Engenharia de Software', '2', 'Católica SC', 100, '$2y$10$9LqvTxMZ9V6mu2rQmWgClujJslvOhonCpI/N66oIlwNEK7i4KDm0u', 3, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
