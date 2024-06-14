-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3312
-- Tempo de geração: 14/06/2024 às 04:49
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `garden`
--

INSERT INTO `garden` (`id`, `plant_name`, `plant_type`, `plant_description`, `plant_image`, `created_at`, `user_id`) VALUES
('666bafb04efa7', 'horta 1', 'dasd', 'asdaas', 'fullsize_2020_06_05_09_Logo-268264_6769_091032054_1452812056.jpg', '2024-06-14 02:49:20', '666ba2b29b3bc'),
('666bafb6a5d45', 'horta 2', 'dasd', 'asdsaas', 'fullsize_2020_06_05_09_Logo-268264_6769_091032054_1452812056.jpg', '2024-06-14 02:49:26', '666ba2b29b3bc');

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
('666bafb051df7', '666bafb04efa7', 0.00, '2024-06-14 02:49:20'),
('666bafb6a9714', '666bafb6a5d45', 0.00, '2024-06-14 02:49:26');

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
('666ba27da6082', 'admin', 'admin@admin.com', '$2y$10$2Bu7Q9TwBS55.Y4D38i7QOb1yNvgtnwVNRL2T8Jdknw2GhzKLYYEa', '2024-06-14 01:53:01'),
('666ba2b29b3bc', 'teste', 'teste@teste.com', '$2y$10$YCmbOSdDTTg/DtgR7zCbMO1grU8ArN/adE2BfO01P5gUgUiuciJW.', '2024-06-14 01:53:54');

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
