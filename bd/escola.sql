-- CONFIGURAÇÕES INICIAIS
SET NAMES utf8mb4;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS = 0;

--
--- CRIAÇÃO DO BANCO
--
DROP DATABASE IF EXISTS escola;

CREATE DATABASE escola
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE escola;

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `coddisciplina` int(11) NOT NULL,
  `nome_disciplina` varchar(50) NOT NULL,
  PRIMARY KEY (`coddisciplina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`coddisciplina`, `nome_disciplina`) VALUES
(1, 'ltt'),
(2, 'banco_de_dados'),
(3, 'logica_de_programacao'),
(4, 'etica'),
(5, 'matematica'),
(6, 'portugues');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `codcurso` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `coddisciplina01` int(11) NOT NULL,
  `coddisciplina02` int(11) NOT NULL,
  `coddisciplina03` int(11) NOT NULL,
  PRIMARY KEY (`codcurso`),
  KEY `coddisciplina01` (`coddisciplina01`),
  KEY `coddisciplina02` (`coddisciplina02`),
  KEY `coddisciplina03` (`coddisciplina03`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`codcurso`, `nome`, `coddisciplina01`, `coddisciplina02`, `coddisciplina03`) VALUES
(101, 'informatica', 1, 2, 3),
(102, 'mecanica', 2, 5, 4),
(103, 'quimica', 6, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `matricula` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `codcurso` int(11) NOT NULL,
  PRIMARY KEY (`matricula`),
  KEY `codcurso` (`codcurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Restrições para tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_disciplina01_fk` FOREIGN KEY (`coddisciplina01`) REFERENCES `disciplina` (`coddisciplina`),
  ADD CONSTRAINT `curso_disciplina02_fk` FOREIGN KEY (`coddisciplina02`) REFERENCES `disciplina` (`coddisciplina`),
  ADD CONSTRAINT `curso_disciplina03_fk` FOREIGN KEY (`coddisciplina03`) REFERENCES `disciplina` (`coddisciplina`);

--
-- Restrições para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_curso_fk` FOREIGN KEY (`codcurso`) REFERENCES `curso` (`codcurso`);

SET FOREIGN_KEY_CHECKS = 1;
