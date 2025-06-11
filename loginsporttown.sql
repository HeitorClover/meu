-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 11/06/2025 às 19:37
-- Versão do servidor: 8.0.42
-- Versão do PHP: 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loginsporttown`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `camps`
--

CREATE TABLE `camps` (
  `id` int NOT NULL,
  `nome` varchar(500) NOT NULL,
  `nome_dono` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `senha` varchar(225) NOT NULL,
  `nicho` varchar(500) NOT NULL,
  `cep` varchar(200) NOT NULL,
  `logradouro` varchar(200) NOT NULL,
  `cidade` varchar(200) NOT NULL,
  `bairro` varchar(200) NOT NULL,
  `estado` varchar(200) NOT NULL,
  `cnpj` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `camps`
--

INSERT INTO `camps` (`id`, `nome`, `nome_dono`, `email`, `senha`, `nicho`, `cep`, `logradouro`, `cidade`, `bairro`, `estado`, `cnpj`) VALUES
(1, 'CAMP sales', 'Plasticos', 'plasticos@h.com', '123', 'Tênis de Mesa', '', '', '', '', '', ''),
(6, 'gfdgd', 'papeis', 'papeis@p.com', '$2y$10$.1e.A4fRjIciL.oZmy6Tfue2XS597do4HKaU/IRzZ.LPF9WAuj6QC', 'Futebol', '56456-46', '5fdgfdghfdgfd', 'gfdgfdgfd', 'gdgfdgfdgfd', 'GO', ''),
(7, 'HFHF', 'papeis', 'papeis@p.com', '$2y$10$Uepa72RSfQIfWntshl7fquH3TP2WOuWysp1RcXFyt9BE73LFht2Rq', 'Futsal', '65656-565', '5fdgfdghfdgfd', 'gfdgfdgfd', 'gdgfdgfdgfd', 'PI', '99.999.999/9999-99');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` int NOT NULL,
  `nome` varchar(500) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `email` varchar(500) NOT NULL,
  `senha` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `empresa`
--

INSERT INTO `empresa` (`id`, `nome`, `cnpj`, `email`, `senha`) VALUES
(3, 'Plasticos', '001002', 'plasticos@h.com', '$2y$10$fh236Kq/gkEMfMAWhGE5Gu.KMS8JIRnpvsqdfoVjywsAEjwWjYajm'),
(5, 'Papeis', '99.999.999/9999-99', 'papeis@p.com', '$2y$10$O6zumoxYagmHgJD49m9PCejfTK/E.cRpaadJ1CKAYyK8uatrgUreG'),
(6, 'tesoura', '88.888.888/8888-88', 'tesoura@t.com', '$2y$10$TXNsCF/UdwyOqvNI.8re.uYHpjiMvK1qXZy370RA2IV.5Mqns1fyS');

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `tipo` enum('usuario','empresa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(140) NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(17, 'Heitor', 'lima@lima.com', '$2y$10$VeQv/j6aNCg5geXAVJpTgOmpX62WFibAfzVzzdBc/LXVmBwXCwS9C'),
(18, 'Witney', 'heitor.lima@aluno.ce.gov.br', '$2y$10$zW7dzJ42dZrJ3961H3VWb.JQJbODa3M70U7eKyGzulV.8JdN194FC');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `camps`
--
ALTER TABLE `camps`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `camps`
--
ALTER TABLE `camps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
