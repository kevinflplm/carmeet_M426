-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 14 oct. 2022 à 06:31
-- Version du serveur : 10.6.7-MariaDB
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_carmeet`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `label` text NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `label`) VALUES
(1, 'Sportives'),
(2, 'Supersportives'),
(3, 'Muscles Car'),
(4, 'JDM'),
(5, 'SUV'),
(6, 'Classiques 90s'),
(7, 'Tous');

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `idEvenement` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  KEY `idEvenement` (`idEvenement`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`idEvenement`, `idUser`) VALUES
(2, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `meet`
--

DROP TABLE IF EXISTS `meet`;
CREATE TABLE IF NOT EXISTS `meet` (
  `idEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `partcipantsMax` int(3) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `adresse` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`idEvenement`),
  KEY `idCategorie` (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `meet`
--

INSERT INTO `meet` (`idEvenement`, `titre`, `partcipantsMax`, `idCategorie`, `adresse`, `date`) VALUES
(2, 'Sportive ONLY', 12, 1, 'Chemin de l\'enfer 1212', '2022-11-16'),
(3, 'Super Car', 10, 2, 'chemin de la richesse 12', '2022-11-19'),
(4, 'Off Road ++ ', 30, 5, 'Ch. du sahara 38', '2023-02-10'),
(5, 'My Japonese Girl', 28, 4, 'Ch. veloktur 90', '2022-12-21'),
(13, '90s meet', 20, 6, 'Ch. Deparici 38', '2022-10-27'),
(15, 'My muscles', 10, 3, 'Ch. Deparici 38', '2023-02-02');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `Pseudo` varchar(15) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `photoProfil` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `Pseudo`, `Email`, `Password`, `photoProfil`, `role`) VALUES
(3, 'Kevinho', 'kevin.flplm@eduge.ch', '$2y$10$rxJVHjj2nu6NU43QboxFkehl0s7jvA39VUw.KZsPCIzQpQUhaxTJS', '3.png', 'admin'),
(4, 'jay', 'jay@gmail.com', '$2y$10$GXoHrbqMwFlVEDRCAiNjfe5YMZrqQKCnILoGNX1UISTlBUACIlNY6', 'img/profil/avatar.jpg', 'user'),
(5, 'Many', 'many@gmail.com', '$2y$10$n.ViAxS8yH.RiNwEOnLsT.nfDL8fyrajUMvMtxmrQdZv/kphbt2Xm', 'img/profil/avatar.jpg', 'user');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`idEvenement`) REFERENCES `meet` (`idEvenement`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `meet`
--
ALTER TABLE `meet`
  ADD CONSTRAINT `meet_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
