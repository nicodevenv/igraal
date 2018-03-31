-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost:3306
-- Généré le: Jeu 14 Décembre 2017 à 16:49
-- Version du serveur: 5.5.44-0ubuntu0.14.04.1
-- Version de PHP: 7.0.14-2+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `igraal_stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `commission`
--

CREATE TABLE IF NOT EXISTS `commission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `cashback` decimal(10,2) NOT NULL,
  `idMerchant` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idMerchant` (`idMerchant`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `commission`
--

INSERT INTO `commission` (`id`, `date`, `cashback`, `idMerchant`, `idUser`) VALUES
(1, '2017-12-01 09:00:00', '10.53', 1, 2),
(2, '2017-12-01 09:00:00', '10.53', 1, 2),
(3, '2017-12-03 08:50:00', '8.30', 2, 1),
(4, '2017-11-01 08:00:19', '0.13', 3, 3),
(5, '2017-10-01 04:00:10', '3.10', 4, 1),
(6, '2017-07-01 06:00:20', '0.42', 1, 2),
(7, '2017-09-01 05:00:32', '0.78', 2, 3),
(8, '2017-12-01 01:00:00', '4.93', 3, 1),
(9, '2017-03-01 03:00:00', '2.12', 4, 1),
(10, '2017-05-01 08:00:00', '3.61', 1, 3),
(11, '2017-02-01 11:26:46', '8.93', 2, 1),
(12, '2017-01-01 14:40:07', '10.00', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `merchant`
--

CREATE TABLE IF NOT EXISTS `merchant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `merchant`
--

INSERT INTO `merchant` (`id`, `name`) VALUES
(1, 'Zalando'),
(2, 'Fnac'),
(3, 'Castorama'),
(4, 'Darty');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `profileUrl` varchar(255) DEFAULT NULL,
  `lastLogin` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`,  `name`, `profileUrl`, `lastLogin`, `creationDate`) VALUES
(1, 'elodie@test.com','testelodie','Elodie','https://randomuser.me/api/portraits/women/40.jpg', '2017-01-01 10:30:20', '2018-02-01 15:17:32'),
(2, 'eric@test.com','testelodie','Eric','https://randomuser.me/api/portraits/men/3.jpg', '2017-03-02 10:00:50', '2017-03-02 10:05:53'),
(3, 'pascal@test.com','testelodie','Pascal','https://randomuser.me/api/portraits/men/5.jpg', '2017-05-19 10:53:20', '2017-09-01 12:03:10');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commission`
--
ALTER TABLE `commission`
  ADD CONSTRAINT `commission_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `commission_ibfk_1` FOREIGN KEY (`idMerchant`) REFERENCES `merchant` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
