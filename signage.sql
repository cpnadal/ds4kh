-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 28 Décembre 2015 à 12:40
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
-- Structure de la table `langue`
--

CREATE TABLE IF NOT EXISTS `langue` (
  `langue_id` int(11) NOT NULL AUTO_INCREMENT,
  `langue_nom` text NOT NULL,
  `langue_texte_annuel` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `langue_cantique` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `langue_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`langue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `langue`
--

INSERT INTO `langue` (`langue_id`, `langue_nom`, `langue_texte_annuel`, `langue_cantique`, `langue_active`) VALUES
(7, 'Français', '<p style="text-align: center;"><span style="font-size: 108pt;">« Rendez grâces</span></p>\r\n<p style="text-align: center;"><span style="font-size: 108pt;">à Jéhovah,</span></p>\r\n<p style="text-align: center;"><span style="font-size: 108pt;">car il est bon »</span></p>\r\n<p style="text-align: center;"> </p>\r\n<p style="text-align: center;"><span style="font-size: 108pt;">(PS. 106:1).</span></p>', 'Cantique', 1),
(8, 'Portugais', '<p style="text-align: center;"><span style="font-size: 108pt;">‘Agradeçam a Jeová,</span></p>\r\n<p style="text-align: center;"><span style="font-size: 108pt;">porque ele é bom.’</span></p>\r\n<p style="text-align: center;"> </p>\r\n<p style="text-align: center;"><span style="font-size: 108pt;">— SAL. 106:1.</span></p>', 'Cântico', 1),
(9, 'Russe', '<p><span style="font-size: 108pt;">«Благодарите Иегову,</span></p>\n<p><span style="font-size: 108pt;">потому что он добр»</span></p>\n<p> </p>\n<p><span style="font-size: 108pt;">(Псалом 106:1).</span></p>', 'Песня', 1),
(10, 'Malgache', '<p><span style="font-size: 108pt;">“Misaora an’i Jehovah</span></p>\n<p><span style="font-size: 108pt;">fa tsara izy.”</span></p>\n<p> </p>\n<p><span style="font-size: 108pt;">—SAL. 106:1.</span></p>', 'Hira', 1),
(11, 'Vietnamien', '<p><span style="font-size: 144px;">“Hãy cảm tạ Đức Giê-hô-va, bởi ngài thật tốt”.—THI 106:1, NW.</span></p>', 'Bài hát', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'ce7c0dcb707083a5953857be0416db44'),
(3, 'sonorisation', '4179bfaf174de35ac247edf34184942f');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
