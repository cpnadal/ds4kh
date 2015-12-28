-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 06 Octobre 2015 à 04:55
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `signage`
--

-- --------------------------------------------------------

--
-- Structure de la table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_name` text NOT NULL,
  `config_value` text NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `config`
--

INSERT INTO `config` (`config_id`, `config_name`, `config_value`) VALUES
(1, 'mode', '1'),
(2, 'server_address', 'ds4kh.dev'),
(3, 'client_name', 'Scene');

-- --------------------------------------------------------

--
-- Structure de la table `congregation`
--

CREATE TABLE IF NOT EXISTS `congregation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `layout`
--

CREATE TABLE IF NOT EXISTS `layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `datetime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `layout`
--

INSERT INTO `layout` (`id`, `name`, `text`, `active`, `datetime`) VALUES
(1, 'Texte de bienvenue', '<p><span style="font-size: 84pt; font-family: arial, helvetica, sans-serif;">BIENVENUE À</span><span style="font-size: 84pt; font-family: arial, helvetica, sans-serif;"> LA</span></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><span style="font-size: 84pt; font-family: arial, helvetica, sans-serif;">SALLE DU ROYAUME</span></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><span style="font-size: 84pt; font-family: arial, helvetica, sans-serif;">DES</span></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><span style="font-size: 84pt; font-family: arial, helvetica, sans-serif;">TÉMOINS DE JÉHOVAH.</span></p>', 1, 1),
(2, 'Texte Annuel 2015 - Français', '<p><span style="font-size: 108pt; font-family: arial, helvetica, sans-serif;">« Rendez grâces</span></p>\r\n<p><span style="font-size: 108pt; font-family: arial, helvetica, sans-serif;">à Jéhovah,</span></p>\r\n<p><span style="font-size: 108pt; font-family: arial, helvetica, sans-serif;">car il est bon »</span></p>\r\n<p><span style="font-family: arial, helvetica, sans-serif;"> </span></p>\r\n<p><span style="font-size: 108pt; font-family: arial, helvetica, sans-serif;">(PS. 106:1).</span></p>', 1, 0),
(3, 'Texte Annuel 2015 - Portugaise', '<p><span style="font-size: 108pt;">‘Agradeçam a Jeová,</span></p>\r\n<p><span style="font-size: 108pt;">porque ele é bom.’</span></p>\r\n<p> </p>\r\n<p><span style="font-size: 108pt;">— SAL. 106:1.</span></p>', 1, 0),
(4, 'Texte Annuel 2015 - Russe', '<p><span style="font-size: 108pt;">«Благодарите Иегову,</span></p>\r\n<p><span style="font-size: 108pt;">потому что он добр»</span></p>\r\n<p> </p>\r\n<p><span style="font-size: 108pt;">(Псалом 106:1).</span></p>', 1, 0),
(5, 'Texte Annuel 2015 - Malgache', '<p><span style="font-size: 108pt;">“Misaora an’i Jehovah</span></p>\r\n<p><span style="font-size: 108pt;">fa tsara izy.”</span></p>\r\n<p> </p>\r\n<p><span style="font-size: 108pt;">—SAL. 106:1.</span></p>', 1, 0),
(6, 'Texte Annuel 2015 - Vietnamien', '<p><span style="font-size: 144px;">“Hãy cảm tạ Đức Giê-hô-va, bởi ngài thật tốt”.—THI 106:1, NW.</span></p>', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'ce7c0dcb707083a5953857be0416db44'),
(2, 'operateur', '66a54374e4c17e650058d3e44209c3c6');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
