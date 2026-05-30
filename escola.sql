-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27-Ago-2018 às 22:30
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `escola`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `matricula` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `endereço` varchar(50) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `codcurso` int(11) NOT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`matricula`, `nome`, `endereço`, `cidade`, `codcurso`) VALUES
(2012, 'Rikelme', 'Jose luis goncalves', 'Palmares Paulista', 2),
(2013, 'Luis', 'Rua Brasil', 'catanduva', 5),
(2014, 'pedro', 'rua pau', 'Palmares Paulista', 6),
(2015, 'daniela', 'rual escola', 'Catanduva', 4),
(2016, 'Tiago', 'Rua da depre', 'Catanduva', 2),
(2017, 'Bianca', 'Rua do cafe', 'Catanduva', 3);

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
