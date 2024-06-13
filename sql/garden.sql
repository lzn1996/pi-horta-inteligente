-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3312
-- Tempo de geração: 13/06/2024 às 19:00
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

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `garden`
--
ALTER TABLE `garden`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
