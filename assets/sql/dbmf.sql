-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/08/2015 às 00:10
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
-- Estrutura para tabela `album`
--

CREATE TABLE IF NOT EXISTS `album` (
`id` int(11) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_bin NOT NULL,
  `descricao` text COLLATE utf8_bin,
  `privado` tinyint(1) NOT NULL DEFAULT '0',
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) COLLATE utf8_bin NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_bin NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('06ba8b7f4f53c2349421939560986d04e9087b78', '::1', 1440789350, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434303738393335303b),
('1213e4e3735f2e37eee6776dcbd1c4a1d70c26c6', '::1', 1440788187, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434303738383138373b),
('230c465e212e55fa1bee66d6ca47a6357c2fe3ce', '::1', 1440785758, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434303738353735383b69647c733a313a2231223b6e6f6d657c733a32333a2254686961676f204d617269616e6f206465204d6f757261223b656d61696c7c733a32363a2261676f31305f6d617269616e6f407961686f6f2e636f6d2e6272223b69647469706f6c6f67696e7c733a313a2231223b6964666f746f70657266696c7c733a32333a2254686961676f204d617269616e6f206465204d6f757261223b6c6f6761646f7c623a313b),
('240dc22047de19ed4d603c067e742f750831696f', '::1', 1440782692, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434303738323638313b69647c733a313a2231223b6e6f6d657c733a32333a2254686961676f204d617269616e6f206465204d6f757261223b656d61696c7c733a32363a2261676f31305f6d617269616e6f407961686f6f2e636f6d2e6272223b69647469706f6c6f67696e7c733a313a2231223b6964666f746f70657266696c7c733a32333a2254686961676f204d617269616e6f206465204d6f757261223b6c6f6761646f7c623a313b),
('2dc4fe1c7553d62df45d24cb5b051a4b64ffdfc3', '::1', 1440787811, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434303738373831313b),
('336a72a6226ce3ee542c26508d036f5b2ac30742', '::1', 1440787119, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434303738373131393b),
('47d3fac82398fb43eb3b64ce39911d51db6b706f', '::1', 1440783207, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434303738333230373b69647c733a313a2231223b6e6f6d657c733a32333a2254686961676f204d617269616e6f206465204d6f757261223b656d61696c7c733a32363a2261676f31305f6d617269616e6f407961686f6f2e636f6d2e6272223b69647469706f6c6f67696e7c733a313a2231223b6964666f746f70657266696c7c733a32333a2254686961676f204d617269616e6f206465204d6f757261223b6c6f6761646f7c623a313b),
('5360bd2fa58d925229385f41f992f9b873c176b2', '::1', 1440791882, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434303739313838323b),
('a6fd41758b58f1b79f37d22624c403b9498be0a8', '::1', 1440788886, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434303738383838363b),
('bec745ba01ea2e5ab243ce634abd74a4223e8ecd', '::1', 1440786120, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434303738363132303b69647c733a313a2231223b6e6f6d657c733a32333a2254686961676f204d617269616e6f206465204d6f757261223b656d61696c7c733a32363a2261676f31305f6d617269616e6f407961686f6f2e636f6d2e6272223b69647469706f6c6f67696e7c733a313a2231223b6964666f746f70657266696c7c733a32333a2254686961676f204d617269616e6f206465204d6f757261223b6c6f6761646f7c623a313b),
('f3791abada2283c26933133a8115d1490df963c7', '::1', 1440787449, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434303738373434393b),
('f7ba6a653a353597ba6aa249d42a116538aa2343', '::1', 1440789660, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434303738393636303b),
('fe63a90c949db15d3adab7fe91cc9df0de79e223', '::1', 1440788528, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434303738383532383b);

-- --------------------------------------------------------

--
-- Estrutura para tabela `config`
--

CREATE TABLE IF NOT EXISTS `config` (
`id` int(11) NOT NULL,
  `nome` varchar(30) COLLATE utf8_bin NOT NULL,
  `valor` text COLLATE utf8_bin
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `config`
--

INSERT INTO `config` (`id`, `nome`, `valor`) VALUES
(1, 'tipousuariopadrao', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `midia`
--

CREATE TABLE IF NOT EXISTS `midia` (
`id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL,
  `biblioteca` enum('imagem','video','audio','documento') COLLATE utf8_bin NOT NULL DEFAULT 'documento',
  `classificacao` enum('usuario','site','sistema','portfolio') COLLATE utf8_bin NOT NULL DEFAULT 'usuario',
  `url` varchar(240) COLLATE utf8_bin NOT NULL,
  `alt` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `local` tinyint(1) NOT NULL DEFAULT '1',
  `privado` tinyint(1) NOT NULL DEFAULT '0',
  `idalbum` int(11) NOT NULL DEFAULT '1',
  `idusuario` int(11) NOT NULL DEFAULT '0',
  `criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `editartipousuario` tinyint(1) DEFAULT '0',
  `editarhome` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `tipologin`
--

INSERT INTO `tipologin` (`id`, `nome`, `descricao`, `comentar`, `postar`, `upmidia`, `editarusuario`, `inserirusuario`, `inserirtipousuario`, `editartipousuario`, `editarhome`) VALUES
(1, 'Administrador Geral', 'Tem acesso as todas as funções do sistema.', 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id` int(11) NOT NULL,
  `email` varchar(60) COLLATE utf8_bin NOT NULL,
  `senha` varchar(50) COLLATE utf8_bin NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `idtipologin` int(11) NOT NULL DEFAULT '4',
  `sexo` varchar(11) COLLATE utf8_bin NOT NULL,
  `idfotoperfil` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `senha`, `nome`, `idtipologin`, `sexo`, `idfotoperfil`) VALUES
(1, 'ago10_mariano@yahoo.com.br', '54980f400762a09e7b11d11a24835517', 'Thiago Mariano de Moura', 1, 'Masculino', NULL);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `album`
--
ALTER TABLE `album`
 ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`id`), ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Índices de tabela `config`
--
ALTER TABLE `config`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices de tabela `midia`
--
ALTER TABLE `midia`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `url` (`url`);

--
-- Índices de tabela `tipologin`
--
ALTER TABLE `tipologin`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `album`
--
ALTER TABLE `album`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `midia`
--
ALTER TABLE `midia`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `tipologin`
--
ALTER TABLE `tipologin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
