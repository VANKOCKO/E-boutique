-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 15 nov. 2021 à 09:27
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `eboutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse_facturation`
--

DROP TABLE IF EXISTS `adresse_facturation`;
CREATE TABLE IF NOT EXISTS `adresse_facturation` (
  `id_adresse_facturation` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `societe` varchar(40) NOT NULL,
  `adresse` varchar(38) NOT NULL,
  `complement_adresse` varchar(38) NOT NULL,
  `ville` varchar(45) NOT NULL,
  `cp` int(5) NOT NULL,
  `pays` varchar(58) NOT NULL,
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`id_adresse_facturation`),
  UNIQUE KEY `id_client` (`id_client`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `adresse_livraison`
--

DROP TABLE IF EXISTS `adresse_livraison`;
CREATE TABLE IF NOT EXISTS `adresse_livraison` (
  `id_adresse_livraison` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `societe` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `complement_adresse` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `cp` varchar(255) DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`id_adresse_livraison`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adresse_livraison`
--

INSERT INTO `adresse_livraison` (`id_adresse_livraison`, `prenom`, `nom`, `societe`, `adresse`, `complement_adresse`, `ville`, `cp`, `pays`, `tel`, `id_client`) VALUES
(6, 'test', 'test', 'test', 'test', 'test', 'test', '00000', 'France', '0649838102', 1),
(9, 'test', 'test', 'test', 'test', 'test', 'test', '00000', 'France', '0649838102', 1),
(10, 'test', 'test', 'test', 'test', 'test', 'test', '00000', 'France', '0649838102', 1),
(11, 'test', 'test', 'test', 'test', 'test', 'test', '00000', 'France', '0649838102', 1),
(12, 'test', 'test', 'test', 'test', 'test', 'test', '00000', 'France', '0649838102', 1),
(13, 'test', 'test', 'test', 'test', 'test', 'test', '00000', 'France', '0649838102', 1),
(14, 'test', 'test', 'test', 'test', 'test', 'test', '00000', 'France', '0649838102', 1),
(15, 'test', 'test', 'test', 'test', 'test', 'test', '00000', 'France', '0649838102', 1),
(16, 'test', 'test', 'test', 'test', 'test', 'test', '00000', 'France', '0649838102', 1),
(17, 'test', 'test', 'test', 'test', 'test', 'test', '00000', 'France', '0649838102', 1),
(18, 'test', 'test', 'test', 'test', 'test', 'test', '00000', 'France', '0987654356', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `lib_cat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `lib_cat`) VALUES
(1, 'TOUTES LES MARQUES'),
(2, 'ORDINATEURS & ACCESSOIRES'),
(3, 'ECRAN & MONITEUR'),
(4, 'IMPRIMANTE');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `confirmation_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `pseudo`, `email`, `mdp`, `confirmation_token`, `confirmation_date`) VALUES
(1, 'test', 'test@gmail.com', '$2y$10$kLFpCHpYZnwm6IXsAX4Gn.faBqCFkIcucVIXgjPEg5EaaLVelfkq2', NULL, '2021-11-03 11:01:49');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `num_commande` int(11) NOT NULL AUTO_INCREMENT,
  `date_commande` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`num_commande`),
  KEY `date_commande` (`date_commande`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `id_produit` int(11) NOT NULL,
  `id_panier` int(11) NOT NULL,
  `qte` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_produit`,`id_panier`),
  KEY `id_panier` (`id_panier`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `date_cmd`
--

DROP TABLE IF EXISTS `date_cmd`;
CREATE TABLE IF NOT EXISTS `date_cmd` (
  `date_commande` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`date_commande`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `lien` varchar(50) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id_image`),
  KEY `id_produit` (`id_produit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id_panier` int(11) NOT NULL AUTO_INCREMENT,
  `prix_ht` decimal(4,2) DEFAULT NULL,
  `prix_ttc` decimal(4,2) DEFAULT NULL,
  `date_ajout_panier` date DEFAULT NULL,
  PRIMARY KEY (`id_panier`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `possede`
--

DROP TABLE IF EXISTS `possede`;
CREATE TABLE IF NOT EXISTS `possede` (
  `id_client` int(11) NOT NULL,
  `id_adresse_livraison` int(11) NOT NULL,
  PRIMARY KEY (`id_client`,`id_adresse_livraison`),
  KEY `id_adresse_livraison` (`id_adresse_livraison`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(20) DEFAULT NULL,
  `reference` varchar(20) DEFAULT NULL,
  `description` text NOT NULL,
  `prix_ht` double(10,4) DEFAULT NULL,
  `prix_ttc` double(10,4) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `titre`, `reference`, `description`, `prix_ht`, `prix_ttc`, `image`, `id_categorie`) VALUES
(1, 'test', 'test', 'test\r\n', 500.0000, 500.0000, 'upload/acer.PNG', 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `mdp` varchar(300) NOT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmation_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `prenom`, `email`, `role`, `mdp`, `confirmation_token`, `confirmation_date`) VALUES
(1, 'test', 'test@gmail.com', 'Administrateur', '$2y$10$cQguGimwmAQP4tRgaK1..uZjsnFfoUdLpqNFrPuEcAPOAvJBwQUVu', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
