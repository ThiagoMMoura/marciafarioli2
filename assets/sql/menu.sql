
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 08/01/2016 às 23:21:36
-- Versão do Servidor: 10.0.20-MariaDB
-- Versão do PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `u857456774_dbmf`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grupo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `formato` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permissao` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'consultar',
  `icone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nivel` int(5) NOT NULL DEFAULT '1',
  `ordem` int(5) NOT NULL,
  `idmenupai` int(11) DEFAULT NULL,
  `sistema` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `menu`
--

REPLACE INTO `menu` (`id`, `nome`, `descricao`, `url`, `grupo`, `tipo`, `formato`, `permissao`, `icone`, `nivel`, `ordem`, `idmenupai`, `sistema`) VALUES
(1, 'Entre', 'Menu para login', 'usuario/login', 'top bar menu', 'link', 'link', 'consultar', NULL, 1, 1, NULL, 0),
(2, 'Cadastre-se', 'Menu para Cadastrar usuário', 'usuario/cadastro', 'top bar menu', 'link', 'link', 'consultar', NULL, 1, 2, NULL, 0),
(3, 'Administração', 'Menu para administração do site', NULL, 'top bar menu', 'menu', 'dropdown', 'consultar', NULL, 1, 1, NULL, 1),
(4, 'Usuario', 'Grupo de links para administração de usuario', NULL, 'administracao', 'menu', 'dropdown', 'consultar', NULL, 2, 1, 3, 1),
(5, 'Níveis de permissão', 'Link para Busca e edição dos niveis de permissão', 'admin/usuario/nivel/busca', 'nivel', 'item', 'link', 'consultar', NULL, 3, 1, 4, 1),
(6, 'Cadastro de Nivel', 'Link para cadastro de Nível de permissão', 'admin/usuario/nivel/cadastro', 'nivel', 'item', 'link', 'consultar', NULL, 3, 2, 4, 1),
(7, 'Sistema', NULL, NULL, 'administracao', 'menu', 'dropdown', 'consultar', NULL, 2, 2, 3, 1),
(8, 'Logs', 'Busca de Logs do sistema', 'admin/sistema/log/busca', 'log', 'item', 'link', 'consultar', NULL, 3, 1, 7, 1),
(9, 'Menus', 'Para busca de Menus cadastrados no sistema', 'admin/sistema/menu/busca', 'menu', 'item', 'link', 'consultar', NULL, 3, 2, 7, 1),
(10, 'Cadastro de Menu', 'Formulário para cadastrar menus no Sistema', 'admin/sistema/menu/cadastro', 'menu', 'item', 'link', 'consultar', NULL, 3, 2, 7, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
