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
(1, 'LTT'),
(2, 'Banco de Dados'),
(3, 'Lógica de Programação'),
(4, 'Ética'),
(5, 'Matemática'),
(6, 'Português');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `codcurso` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`codcurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`codcurso`, `nome`) VALUES
(101, 'Informática'),
(102, 'Mecânica'),
(103, 'Química');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso_disciplina` (ligação N:N entre curso e disciplina)
-- Cada linha diz "o curso X tem a disciplina Y". Um curso pode ter quantas
-- disciplinas precisar, e uma disciplina pode estar em vários cursos.
--

CREATE TABLE IF NOT EXISTS `curso_disciplina` (
  `codcurso` int(11) NOT NULL,
  `coddisciplina` int(11) NOT NULL,
  PRIMARY KEY (`codcurso`, `coddisciplina`),
  KEY `coddisciplina` (`coddisciplina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `curso_disciplina`
--

INSERT INTO `curso_disciplina` (`codcurso`, `coddisciplina`) VALUES
(101, 1), (101, 2), (101, 3),
(102, 2), (102, 5), (102, 4),
(103, 6), (103, 2), (103, 1);

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
-- Restrições para tabela `curso_disciplina`
-- ON DELETE CASCADE: ao excluir um curso, as ligações dele somem junto.
-- A disciplina não tem CASCADE: o banco impede excluir disciplina usada em algum curso.
--
ALTER TABLE `curso_disciplina`
  ADD CONSTRAINT `cd_curso_fk` FOREIGN KEY (`codcurso`) REFERENCES `curso` (`codcurso`) ON DELETE CASCADE,
  ADD CONSTRAINT `cd_disciplina_fk` FOREIGN KEY (`coddisciplina`) REFERENCES `disciplina` (`coddisciplina`);

--
-- Restrições para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_curso_fk` FOREIGN KEY (`codcurso`) REFERENCES `curso` (`codcurso`);

SET FOREIGN_KEY_CHECKS = 1;
