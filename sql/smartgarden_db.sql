-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3312
-- Tempo de geração: 15/06/2024 às 03:45
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `smartgarden_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `garden`
--

CREATE TABLE `garden` (
  `id` varchar(255) NOT NULL,
  `plant_name` varchar(255) NOT NULL,
  `plant_type` varchar(100) NOT NULL,
  `plant_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` varchar(255) NOT NULL,
  `soil_moisture` int(11) NOT NULL,
  `planting_date` date NOT NULL,
  `harvest_date` date DEFAULT NULL,
  `additional_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `garden`
--

INSERT INTO `garden` (`id`, `plant_name`, `plant_type`, `plant_image`, `created_at`, `user_id`, `soil_moisture`, `planting_date`, `harvest_date`, `additional_notes`) VALUES
('666cf21a5f3e7', 'nome', 'Planta', 'fullsize_2020_06_05_09_Logo-268264_6769_091032054_1452812056.jpg', '2024-06-15 01:44:58', '666ce909684d0', 45, '2024-06-13', '2024-06-27', 'dasdasda');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sensor`
--

CREATE TABLE `sensor` (
  `id` varchar(255) NOT NULL,
  `garden_id` varchar(255) NOT NULL,
  `humidity_value` decimal(5,2) NOT NULL,
  `recorded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sensor`
--

INSERT INTO `sensor` (`id`, `garden_id`, `humidity_value`, `recorded_at`) VALUES
('666cf21a602a3', '666cf21a5f3e7', 0.00, '2024-06-15 01:44:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `created_at`) VALUES
('666ce909684d0', 'admin', 'admin@admin.com', '$2y$10$ADDNWRefNk8B2TzS4rmOqu3gpVPofDDBuqf7P0o6Td14wMoivXS4O', '2024-06-15 01:06:17');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `garden`
--
ALTER TABLE `garden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_garden_user` (`user_id`);

--
-- Índices de tabela `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_garden_id` (`garden_id`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `garden`
--
ALTER TABLE `garden`
  ADD CONSTRAINT `fk_garden_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `sensor`
--
ALTER TABLE `sensor`
  ADD CONSTRAINT `fk_garden_id` FOREIGN KEY (`garden_id`) REFERENCES `garden` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sensor_ibfk_1` FOREIGN KEY (`garden_id`) REFERENCES `garden` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
