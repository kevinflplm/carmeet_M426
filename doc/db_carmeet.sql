-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 30 sep. 2022 à 06:32
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `label`) VALUES
(1, 'Sportives'),
(2, 'Supersportives'),
(3, 'Muscles Car'),
(4, 'JDM'),
(5, 'SUV'),
(6, 'Classiques 90s');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `meet`
--

INSERT INTO `meet` (`idEvenement`, `titre`, `partcipantsMax`, `idCategorie`, `adresse`, `date`) VALUES
(1, '90s meet', 20, 6, 'Quai Gustave-Ador 82, 1207 Genève', '2022-11-24');

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
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `Pseudo`, `Email`, `Password`, `photoProfil`) VALUES
(3, 'admin', 'kevin.flplm@eduge.ch', '$2y$10$rxJVHjj2nu6NU43QboxFkehl0s7jvA39VUw.KZsPCIzQpQUhaxTJS', ''),
(4, 'jay', 'jay@gmail.com', '$2y$10$GXoHrbqMwFlVEDRCAiNjfe5YMZrqQKCnILoGNX1UISTlBUACIlNY6', '');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `meet`
--
ALTER TABLE `meet`
  ADD CONSTRAINT `meet_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
