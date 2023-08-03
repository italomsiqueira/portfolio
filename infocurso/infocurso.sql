-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Dez-2022 às 00:51
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `infocurso`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `rg` varchar(30) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `tel` varchar(80) NOT NULL,
  `escolaridade` varchar(50) NOT NULL,
  `turma` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `rg`, `cpf`, `endereco`, `tel`, `escolaridade`, `turma`) VALUES
(11, 'ITALO MENDES SIQUEIRA', '123987658', '147.365.897-74', 'RUA PADRE PEREIRA', '(88) 99865-3214', 'SUPERIOR_INC', 23),
(12, 'RAQUEL DOS SANTOS AMORIM', '147854368925', '258.741.336-95', 'PADRE PEREIRA', '(88) 99874-5633', 'SUPERIOR_INC', 23),
(13, 'DAYANE VIEIRA DA SILVA', '1478956322', '147.888.759-66', 'RUA DO CEMITÉRIO', '(88) 99685-7422', 'SUPERIOR_INC', 18),
(14, 'MARIA DE SOUSA', '1478569333', '125.789.357-99', 'RUA JOAO CASTELO', '(88) 98174-5236', 'MEDIO', 18),
(15, 'MARIA PEREIRA', '1258749632', '102.369.744-58', 'DISTRITO BOA VISTA', '(88) 99874-5698', 'MEDIO', 18),
(16, 'JOAO DA SILVA PONTES', '14785236988', '021.369.987-45', 'RUA CASEMIRO FIUSA', '(88) 99656-8932', 'SUPERIOR', 19),
(17, 'JOSE COSTA DA SILVA', '12365478899', '014.789.653-33', 'RUA NOVA UNIÃO', '(88) 96369-8555', 'SUPERIOR', 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `id` int(50) NOT NULL,
  `hora` varchar(50) NOT NULL,
  `dia1` varchar(50) NOT NULL,
  `dia2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id`, `hora`, `dia1`, `dia2`) VALUES
(1, 'Reserva', '*', '*'),
(18, '08:00', 'SEG', 'QUA'),
(19, '10:00', 'SEG', 'QUA'),
(20, '14:00', 'TER', 'QUI'),
(21, '16:00', 'TER', 'QUI'),
(22, '18:00', 'QUA', 'SEX');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
