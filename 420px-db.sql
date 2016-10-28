-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 30 Septembre 2016 à 18:11
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `420px-db`
--

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rgb` varchar(64) NOT NULL,
  `path` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `rgb`, `path`, `user_id`) VALUES
(1, '171,158,147', 'files/img_1.png', 1),
(2, '181,181,181', 'files/img_2.jpg', 1),
(3, '127,127,127', 'files/img_3.jpg', 1),
(4, '198,175,109', 'files/img_4.jpg', 1),
(5, '203,154,153', 'files/img_5.jpg', 2),
(6, '148,111,102', 'files/img_6.jpg', 2),
(7, '99,111,58', 'files/img_7.jpg', 3),
(8, '156,105,89', 'files/img_8.png', 3),
(9, '186,151,114', 'files/img_9.png', 3),
(10, '158,158,158', 'files/img_10.jpg', 3),
(11, '98,98,41', 'files/img_11.png', 1),
(12, '173,139,139', 'files/img_12.jpg', 1),
(13, '155,118,94', 'files/img_13.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `password`) VALUES
(1, 'Lemurantin', 'password'),
(2, 'Fantin', 'password'),
(3, 'Random Guy', 'password'),
(4, 'Philippe', 'password'),
(5, '<script>window.location = ''https://www.anonymous-france.eu/''</script>', 'toto');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
