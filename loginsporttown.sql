-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 23/06/2025 às 17:37
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
  `cnpj` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `target_file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `camps`
--

INSERT INTO `camps` (`id`, `nome`, `nome_dono`, `email`, `senha`, `nicho`, `cep`, `logradouro`, `cidade`, `bairro`, `estado`, `cnpj`, `criado_em`, `target_file`) VALUES
(8, 'Copa TV', 'Papeis', 'papeis@p.com', '$2y$10$33l./6KLU5q4.vtyhDR0Ie9utW0cBoIDJMLzYFT.gTYxBQsCeEIqK', 'Futsal', '01001-000', 'Praça da Sé', 'São Paulo', 'Sé', 'SP', '99.999.999/9999-99', '2025-06-12 13:30:42', ''),
(9, 'rolinois', 'Papeis', 'papeis@p.com', '$2y$10$8Fe8PMXHObGrNrZeiIhKeu8TiE84eFsHGoMtDYpOXRutVG4fkHFMe', 'Futebol', '01001-000', 'Praça da Sé', 'São Paulo', 'Sé', 'SP', '99.999.999/9999-99', '2025-06-12 13:35:07', ''),
(10, 'Mayara', 'Mayara', 'sobral@s.com', '$2y$10$4RKiOXPbJ5PtKG464WtBaOmLLUnvl1htKdrF/y.2PInLbs./cLnOm', 'Futebol', '01001-000', 'Praça da Sé', 'São Paulo', 'Sé', 'SP', '55.555.555/5555-55', '2025-06-12 13:46:49', ''),
(11, 'EliGostoso', 'Mayara', 'sobral@s.com', '$2y$10$yhn0t2cRmnv3SyuNbch4z.Lbg2jHc04mSdMT7T/i11XLrk06QIWkC', 'Futebol', '63502-275', 'Rua Padre Cícero', 'Iguatu', 'Santo Antônio', 'CE', '55.555.555/5555-55', '2025-06-12 14:06:34', ''),
(12, 'AyoCoreano', 'Mayara', 'sobral@s.com', '$2y$10$xMaDM4hZ/3Ow9UkD8Sbhzedy96pC5dMck/bRHjyzV3LeyW5qKS17a', 'Xadrez', '63502-275', 'Rua Padre Cícero', 'Iguatu', 'Santo Antônio', 'CE', '55.555.555/5555-55', '2025-06-13 11:36:53', ''),
(23, 'jgjghj', 'Mayara', 'sobral@s.com', '$2y$10$8.xHwRdB5yzIL54gjtNXBuq7MjGdLODz52NALPBnJL6GPY7JJ.J3.', 'Futebol', '01010-000', 'Rua São Bento', 'São Paulo', 'Centro', 'SP', '55.555.555/5555-55', '2025-06-17 16:21:35', 'imgs/img_6851960f2f517.png'),
(24, 'oioioi', 'Witney', 'witney@t.com', '$2y$10$YSTFSm0/6/Y0pa0rDdm8WOAxQOTqsKDa6aRoCRE4SQBJryPv8647e', 'Futsal', '01010-000', 'Rua São Bento', 'São Paulo', 'Centro', 'SP', '88.888.888/8888-88', '2025-06-23 16:24:22', 'imgs/img_68597fb6c140e.png'),
(25, 'oioioi', 'Witney', 'witney@t.com', '$2y$10$.1.a9lUNsIp.ZtYTvtrndOY8dIe87q2BgiB4Clm8E2C1BiiR1tvwy', 'Futsal', '01010-000', 'Rua São Bento', 'São Paulo', 'Centro', 'SP', '88.888.888/8888-88', '2025-06-23 16:54:28', 'imgs/img_685986c3dba5f.jpg'),
(26, 'pedro', 'Witney', 'witney@t.com', '$2y$10$ZASzkasU/gjNjISFO1D5dOngxazwuXLq8sKQcgB2vwihz5QJYAX0S', 'Xadrez', '01010-000', 'Rua São Bento', 'São Paulo', 'Centro', 'SP', '88.888.888/8888-88', '2025-06-23 17:15:45', 'imgs/img_68598bc182e95.png');

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
(6, 'tesoura', '88.888.888/8888-88', 'tesoura@t.com', '$2y$10$TXNsCF/UdwyOqvNI.8re.uYHpjiMvK1qXZy370RA2IV.5Mqns1fyS'),
(9, 'Witney', '88.888.888/8888-88', 'witney@t.com', '$2y$10$RL0f73Oas4oUHZzvLa85Vu5xzOGBg0QsldmoWCq10yY2PTHCGfJ9K');

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
(18, 'Witney', 'heitor.lima@aluno.ce.gov.br', '$2y$10$zW7dzJ42dZrJ3961H3VWb.JQJbODa3M70U7eKyGzulV.8JdN194FC'),
(23, 'rolinois', 'intu@i.com', '$2y$10$MLikocNDZm8X/PbOZkLy2.173ENkv.LGbsLIeemCuYXEFROtpbggO'),
(24, 'Mayara', 'Mayara@m.com', '$2y$10$c9dxdDPEHECT1qz0NhrIpumneAEEbTPeMQlwry0B0IS0BniPz1O/.'),
(25, 'Luiz', 'limaheitor508@gmail.com', '$2y$10$VfTfU1Fr2ZEHvxA.1k0l2.u3snTPkmrZX4igqMo8CFsd4vM7DDNpS');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
