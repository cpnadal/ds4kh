-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 08 Janvier 2016 à 17:36
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
CREATE DATABASE IF NOT EXISTS `signage` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `signage`;

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

DROP TABLE IF EXISTS `langue`;
CREATE TABLE IF NOT EXISTS `langue` (
  `langue_id` int(11) NOT NULL AUTO_INCREMENT,
  `langue_nom` text NOT NULL,
  `langue_texte_annuel` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `langue_cantique` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `langue_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`langue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `langue`
--

INSERT INTO `langue` (`langue_id`, `langue_nom`, `langue_texte_annuel`, `langue_cantique`, `langue_active`) VALUES
(1, 'Français', '<p style="text-align: center;"><span style="font-size: 132pt;">« Que votre amour fraternel demeure »</span></p>\n<p style="text-align: center;"><span style="font-size: 132pt;">(Hébreux 13:1)</span></p>', 'Cantique', 1),
(2, 'Portugais', '<p style="text-align: center;"><span style="font-size: 132pt;">« Que o seu amor fraternal continue »</span></p>\r\n<p style="text-align: center;"><span style="font-size: 132pt;">(Hebreus 13:1)</span></p>', 'Cântico', 1),
(3, 'Russe', '<p style="text-align: center;"><span style="font-size: 132pt;">« Братолюбие между вами да пребывает »</span></p>\r\n<p style="text-align: center;"><span style="font-size: 132pt;">(Евреям 13:1)</span></p>', 'Песня', 1),
(4, 'Malgache', '<p><span style="font-size: 132pt;"><span style="text-align: center;">«</span><span style="text-align: center;"> </span>Aoka haharitra ny fitiavanareo ny rahalahy<span style="text-align: center;"> </span><span style="text-align: center;">»</span></span></p>\n<p><span style="font-size: 132pt;"><span style="text-align: center;">(H</span>ebreo 13:1)</span></p>', 'Hira', 1),
(5, 'Vietnamien', '<p><span style="font-size: 132pt;"><span style="text-align: center;">«</span><span style="text-align: center;"> </span>Hãy tiếp tục yêu thương nhau như anh em<span style="text-align: center;"> </span><span style="text-align: center;">»</span></span></p>\r\n<p><span style="font-size: 132pt;"><span style="text-align: center;">(</span>Hê-bơ-rơ 13:1)</span></p>', 'Bài hát', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'ce7c0dcb707083a5953857be0416db44');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
