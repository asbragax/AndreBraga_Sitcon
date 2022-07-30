Utilizei no teste a forma de acesso a dados que tenho costume de usar (DAO), claro que unindo ao time me adequarei a forma de trabalho da empresa.

Como não ficou especificado, pela lógica só mostrei os procedimentos, pacientes e afins que estavam marcados como 'ativo'.

ESTRUTURA DO BANCO DE DADOS (Obs: O Arquivo para importar o BD está no projeto)


CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `dataNasc` date NOT NULL,
  `CPF` varchar(14) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `procedimentos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `profissional` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `profissionalatende` (
  `id` int(11) NOT NULL,
  `procedimento_id` int(11) NOT NULL,
  `profissional_id` int(11) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `solicitacao_procedimento` (
  `id` int(11) NOT NULL,
  `solicitacao_id` int(11) NOT NULL,
  `procedimento_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `solicitacoes` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `profissional_id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tiposolicitacao` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `status` char(10) NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nome` (`nome`),
  ADD KEY `cpf` (`CPF`),
  ADD KEY `status` (`status`);

ALTER TABLE `procedimentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `descricao` (`descricao`),
  ADD KEY `status` (`status`),
  ADD KEY `tipo_id` (`tipo_id`);

ALTER TABLE `profissional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nome` (`nome`),
  ADD KEY `status` (`status`);

ALTER TABLE `profissionalatende`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `procedimento_id` (`procedimento_id`),
  ADD KEY `profissional_id` (`profissional_id`);


ALTER TABLE `solicitacao_procedimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitacao_id` (`solicitacao_id`),
  ADD KEY `procedimento_id` (`procedimento_id`);


ALTER TABLE `solicitacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data` (`data`),
  ADD KEY `hora` (`hora`),
  ADD KEY `paciente_id` (`paciente_id`),
  ADD KEY `profissional_id` (`profissional_id`),
  ADD KEY `tipo_id` (`tipo_id`);

ALTER TABLE `tiposolicitacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `descricao` (`descricao`),
  ADD KEY `status` (`status`);


ALTER TABLE `procedimentos`
  ADD CONSTRAINT `procedimentos_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tiposolicitacao` (`id`);


ALTER TABLE `profissionalatende`
  ADD CONSTRAINT `profissionalatende_ibfk_1` FOREIGN KEY (`procedimento_id`) REFERENCES `procedimentos` (`id`),
  ADD CONSTRAINT `profissionalatende_ibfk_2` FOREIGN KEY (`profissional_id`) REFERENCES `profissional` (`id`);


ALTER TABLE `solicitacao_procedimento`
  ADD CONSTRAINT `solicitacao_procedimento_ibfk_1` FOREIGN KEY (`solicitacao_id`) REFERENCES `solicitacoes` (`id`),
  ADD CONSTRAINT `solicitacao_procedimento_ibfk_2` FOREIGN KEY (`procedimento_id`) REFERENCES `procedimentos` (`id`);

ALTER TABLE `solicitacoes`
  ADD CONSTRAINT `solicitacoes_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`),
  ADD CONSTRAINT `solicitacoes_ibfk_2` FOREIGN KEY (`profissional_id`) REFERENCES `profissional` (`id`),
  ADD CONSTRAINT `solicitacoes_ibfk_3` FOREIGN KEY (`tipo_id`) REFERENCES `tiposolicitacao` (`id`);