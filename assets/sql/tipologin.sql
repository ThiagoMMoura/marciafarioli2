-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/08/2015 às 23:58
-- Versão do servidor: 5.6.21
-- Versão do PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `dbmf`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipologin`
--

CREATE TABLE IF NOT EXISTS `tipologin` (
`id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `descricao` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `comentar` tinyint(1) DEFAULT '0',
  `postar` tinyint(1) DEFAULT '0',
  `upmidia` tinyint(1) DEFAULT '0',
  `editarusuario` tinyint(1) DEFAULT '0',
  `inserirusuario` tinyint(1) DEFAULT '0',
  `inserirtipousuario` tinyint(1) DEFAULT '0',
  `editartipousuario` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tipologin`
--
ALTER TABLE `tipologin`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nome` (`nome`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tipologin`
--
ALTER TABLE `tipologin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
