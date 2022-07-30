-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Jul-2022 às 00:25
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `andrebraga_sitcon`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `dataNasc` date NOT NULL,
  `CPF` varchar(14) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `nome`, `dataNasc`, `CPF`, `status`) VALUES
(1, 'Augusto Fernandes', '2000-08-10', '210.298.293-09', 'ativo'),
(2, 'Maria Silva Oliveira', '1999-03-21', '210.298.293-09', 'ativo'),
(3, 'Alfonse Smikchuz', '2002-10-02', '210.298.293-09', 'ativo'),
(4, 'Nagela Perreira', '1997-05-16', '210.298.293-09', 'ativo'),
(5, 'Gustavo Hernanes', '2001-07-10', '210.298.293-09', 'ativo'),
(6, 'João Paulo Ferreira', '1995-06-26', '210.298.293-09', 'inativo'),
(7, 'Julio Costa Martins', '1980-11-23', '210.298.293-09', 'ativo'),
(8, 'Helena Marques', '2000-01-11', '210.298.293-09', 'ativo'),
(9, 'Zira Silva', '2003-02-14', '210.298.293-09', 'ativo'),
(10, 'João Bicalho', '1993-03-12', '210.298.293-09', 'inativo'),
(11, 'Paulina Araujo', '2002-08-10', '210.298.293-09', 'ativo'),
(12, 'Carolina Rosa Silva', '2001-12-24', '210.298.293-09', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `procedimentos`
--

CREATE TABLE `procedimentos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `procedimentos`
--

INSERT INTO `procedimentos` (`id`, `descricao`, `tipo_id`, `status`) VALUES
(1, 'Consulta Pediátrica ', 1, 'ativo'),
(2, 'Consulta Clínico Geral', 1, 'ativo'),
(3, 'Hemograma', 2, 'ativo'),
(4, 'Glicemia', 2, 'ativo'),
(5, 'Colesterol', 2, 'ativo'),
(6, 'Triglicerídeos', 2, 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissional`
--

CREATE TABLE `profissional` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `profissional`
--

INSERT INTO `profissional` (`id`, `nome`, `status`) VALUES
(1, 'Orlando Nobrega', 'ativo'),
(2, 'Rafaela Tenorio', 'ativo'),
(3, 'João Paulo Nobrega', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissionalatende`
--

CREATE TABLE `profissionalatende` (
  `id` int(11) NOT NULL,
  `procedimento_id` int(11) NOT NULL,
  `profissional_id` int(11) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `profissionalatende`
--

INSERT INTO `profissionalatende` (`id`, `procedimento_id`, `profissional_id`, `status`) VALUES
(1, 1, 2, 'ativo'),
(2, 2, 2, 'ativo'),
(3, 2, 3, 'ativo'),
(4, 3, 1, 'ativo'),
(5, 4, 1, 'ativo'),
(6, 5, 1, 'ativo'),
(7, 6, 1, 'ativo'),
(8, 1, 3, 'inativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao_procedimento`
--

CREATE TABLE `solicitacao_procedimento` (
  `id` int(11) NOT NULL,
  `solicitacao_id` int(11) NOT NULL,
  `procedimento_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `solicitacao_procedimento`
--

INSERT INTO `solicitacao_procedimento` (`id`, `solicitacao_id`, `procedimento_id`) VALUES
(1, 2, 2),
(2, 3, 4),
(3, 3, 3),
(4, 3, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacoes`
--

CREATE TABLE `solicitacoes` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `profissional_id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `solicitacoes`
--

INSERT INTO `solicitacoes` (`id`, `paciente_id`, `profissional_id`, `tipo_id`, `data`, `hora`) VALUES
(2, 3, 3, 1, '2022-07-30', '11:00'),
(3, 12, 1, 2, '2022-07-30', '12:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tiposolicitacao`
--

CREATE TABLE `tiposolicitacao` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tiposolicitacao`
--

INSERT INTO `tiposolicitacao` (`id`, `descricao`, `status`) VALUES
(1, 'Consulta', 'ativo'),
(2, 'Exames Laboratoriais', 'ativo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nome` (`nome`),
  ADD KEY `cpf` (`CPF`),
  ADD KEY `status` (`status`);

--
-- Índices para tabela `procedimentos`
--
ALTER TABLE `procedimentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `descricao` (`descricao`),
  ADD KEY `status` (`status`),
  ADD KEY `tipo_id` (`tipo_id`);

--
-- Índices para tabela `profissional`
--
ALTER TABLE `profissional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nome` (`nome`),
  ADD KEY `status` (`status`);

--
-- Índices para tabela `profissionalatende`
--
ALTER TABLE `profissionalatende`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `procedimento_id` (`procedimento_id`),
  ADD KEY `profissional_id` (`profissional_id`);

--
-- Índices para tabela `solicitacao_procedimento`
--
ALTER TABLE `solicitacao_procedimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitacao_id` (`solicitacao_id`),
  ADD KEY `procedimento_id` (`procedimento_id`);

--
-- Índices para tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data` (`data`),
  ADD KEY `hora` (`hora`),
  ADD KEY `paciente_id` (`paciente_id`),
  ADD KEY `profissional_id` (`profissional_id`),
  ADD KEY `tipo_id` (`tipo_id`);

--
-- Índices para tabela `tiposolicitacao`
--
ALTER TABLE `tiposolicitacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `descricao` (`descricao`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `procedimentos`
--
ALTER TABLE `procedimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `profissional`
--
ALTER TABLE `profissional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `profissionalatende`
--
ALTER TABLE `profissionalatende`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `solicitacao_procedimento`
--
ALTER TABLE `solicitacao_procedimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tiposolicitacao`
--
ALTER TABLE `tiposolicitacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `procedimentos`
--
ALTER TABLE `procedimentos`
  ADD CONSTRAINT `procedimentos_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tiposolicitacao` (`id`);

--
-- Limitadores para a tabela `profissionalatende`
--
ALTER TABLE `profissionalatende`
  ADD CONSTRAINT `profissionalatende_ibfk_1` FOREIGN KEY (`procedimento_id`) REFERENCES `procedimentos` (`id`),
  ADD CONSTRAINT `profissionalatende_ibfk_2` FOREIGN KEY (`profissional_id`) REFERENCES `profissional` (`id`);

--
-- Limitadores para a tabela `solicitacao_procedimento`
--
ALTER TABLE `solicitacao_procedimento`
  ADD CONSTRAINT `solicitacao_procedimento_ibfk_1` FOREIGN KEY (`solicitacao_id`) REFERENCES `solicitacoes` (`id`),
  ADD CONSTRAINT `solicitacao_procedimento_ibfk_2` FOREIGN KEY (`procedimento_id`) REFERENCES `procedimentos` (`id`);

--
-- Limitadores para a tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD CONSTRAINT `solicitacoes_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`),
  ADD CONSTRAINT `solicitacoes_ibfk_2` FOREIGN KEY (`profissional_id`) REFERENCES `profissional` (`id`),
  ADD CONSTRAINT `solicitacoes_ibfk_3` FOREIGN KEY (`tipo_id`) REFERENCES `tiposolicitacao` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
