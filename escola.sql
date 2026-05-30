-- CONFIGURAÇÕES INICIAIS
Set Names utf8mb4;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
Set FOREIGN_KEY_CHECKS = 0;


--
--- CRIAÇÃO DO BANCO
Drop DATABASE IF EXISTS escola (
  
CREATE DATABASE escola
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE escola;



--
-- Tabela disciplina
CREATE TABLE disciplina (
  coddisciplina INT NOT NULL
  nome_disciplina VARCHAR(50) NOT NULL,
  PRIMARY KEY (coddisciplina)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- Dados das disciplinas
INSERT INTO disciplina(coddisciplina, nome_disciplina) VALUES
(1, 'LTT'),
(2, 'Banco de Dados'),
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `codcurso` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `coddisciplina01` int(11) NOT NULL,
  `coddisciplina02` int(11) NOT NULL,
  `coddisciplina03` int(11) NOT NULL,
  PRIMARY KEY (`codcurso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`codcurso`, `nome`, `coddisciplina01`, `coddisciplina02`, `coddisciplina03`) VALUES
(101, 'informatica', 1, 2, 3),
(102, 'mecanica', 2, 5, 4),
(103, 'quimica', 6, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `coddisciplina` int(11) NOT NULL,
  `nome_disciplina` varchar(50) NOT NULL,
  PRIMARY KEY (`coddisciplina`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
