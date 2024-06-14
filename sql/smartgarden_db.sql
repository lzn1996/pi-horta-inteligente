-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3312
-- Tempo de geração: 14/06/2024 às 03:41
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
  `plant_description` text NOT NULL,
  `plant_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `garden`
--

INSERT INTO `garden` (`id`, `plant_name`, `plant_type`, `plant_description`, `plant_image`, `created_at`) VALUES
('666b2495b1aba', 'dasdsa', 'sadsa', 'asdas', 'fullsize_2020_06_05_09_Logo-268264_6769_091032054_1452812056.jpg', '2024-06-13 16:55:49');

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
('666b2495b551e', '666b2495b1aba', 0.00, '2024-06-13 16:55:49');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `created_at`) VALUES
(666, 'admin', 'admin@admin.com', '$2y$10$WjaWYRJLpFMQAmIxnceIsugS.KT6Z1b9JKuE0y2xBNikVZJFCya2u', '2024-06-13 14:12:57');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `garden`
--
ALTER TABLE `garden`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_garden_id` (`garden_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_unico` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1717957789;

--
-- Restrições para tabelas despejadas
--

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
