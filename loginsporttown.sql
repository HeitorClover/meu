-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 25/06/2025 às 00:06
-- Versão do servidor: 8.0.40
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
  `cnpj` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `target_file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `camps`
--

INSERT INTO `camps` (`id`, `nome`, `nome_dono`, `email`, `senha`, `nicho`, `cep`, `logradouro`, `cidade`, `bairro`, `estado`, `cnpj`, `criado_em`, `target_file`) VALUES
(41, 'Copa TV', 'Empresa3 - SporTTown', 'empresa@3.com', '$2y$10$Es686PZ/m.XL1T/XfqVpJeVHJgVPmuTJbWQKtS8FfCbloBfHevb0S', 'Basquete', '01010-000', 'Rua São Bento', 'São Paulo', 'Centro', 'SP', '11.032.316/0920-08', '2025-06-24 22:13:03', 'imgs/img_685b22ee237dc.png'),
(42, 'Copa Spotify', 'Empresa3 - SporTTown', 'empresa@3.com', '$2y$10$U3haOxu/VnffDIuDgIEX/OjDIGr0d.pqGKOsOePcXLtgxk2SoXyau', 'Xadrez', '02020-000', 'Rua Marechal Hermes da Fonseca', 'São Paulo', 'Santana', 'SP', '11.032.316/0920-08', '2025-06-24 22:14:22', 'imgs/img_685b233daeeae.jpg'),
(43, 'Copa Urso', 'Empresa3 - SporTTown', 'empresa@3.com', '$2y$10$ZywygB7mykxgV9e.tNQ2ruhhn2AB9DjpLwcMuZGz4cWDAVZECF9l.', 'Basquete', '03030-000', 'Rua Padre Vieira', 'São Paulo', 'Canindé', 'SP', '11.032.316/0920-08', '2025-06-24 22:14:59', 'imgs/img_685b23628ddc7.jpg'),
(44, 'Torneio Ajoalhado', 'Empresa1 - Papeis', 'empresa@1.com', '$2y$10$AAI3Wi0oBy72jrJCGXLVZ.T.xglMXx411O6rOKUSTVUSowCSXTjs2', 'Tênis de mesa', '20021-290', 'Rua do Passeio', 'Rio de Janeiro', 'Centro', 'RJ', '12.345.678/9101-11', '2025-06-24 22:18:31', 'imgs/img_685b243726b3f.jpg'),
(46, 'Torneio Criança', 'Empresa1 - Papeis', 'empresa@1.com', '$2y$10$aU85gyU4Us5y0otgQM0QiuYkO6./GWeYaBS1k.lQlCNVOlYxoS1nm', 'Xadrez', '26380-085', 'Rua Quatro', 'Queimados', 'Boa Esperança', 'RJ', '12.345.678/9101-11', '2025-06-24 22:22:17', 'imgs/img_685b251944dd2.jpg');

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
(11, 'Empresa1 - Papeis', '12.345.678/9101-11', 'empresa@1.com', '$2y$10$/sHXsrd7HDOLVU7GNYlyuOL0TWuQlertdn8/OVu40UKf4UPRQasxi'),
(12, 'Empresa2 - Tesoura', '09.876.543/2112-34', 'empresa@2.com', '$2y$10$gXk1Nl0Ju2nWjPM2nX1tPuRpluc/vHAhXF6.ZqYU.IiER23Jb4nse'),
(13, 'Empresa3 - SporTTown', '11.032.316/0920-08', 'empresa@3.com', '$2y$10$WE.raH56D4v5U0yJubS3seEAff8v6hiIQvCVwsBwa.cAm8uMkJwBW');

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
(26, 'Usuario1 - Heitor', 'usuario@1.com', '$2y$10$rUawLcs4Uyap4KXq4.KnBuTCl7sd9G2I8Jz4WdqlCL5XATBGHK3T2'),
(27, 'Usuario2 - Jeová', 'usuario@2.com', '$2y$10$6tu69hAGpnOyqW3.o8ndMefUVriefSGHhTMhfhaiTLfA2l27FrlT6'),
(28, 'Usuario3 - Witney', 'usuario@3.com', '$2y$10$ypPrSQG5J4vnRIjg8C6ZBuV7PgFziBOebsbqjIagt4KpjcqJobRIa');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
