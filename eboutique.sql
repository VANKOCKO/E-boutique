-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 19 déc. 2021 à 18:00
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

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

CREATE TABLE `adresse_facturation` (
  `id_adresse_facturation` int(11) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `societe` varchar(40) NOT NULL,
  `adresse` varchar(38) NOT NULL,
  `complement_adresse` varchar(38) NOT NULL,
  `ville` varchar(45) NOT NULL,
  `cp` int(5) NOT NULL,
  `pays` varchar(58) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `adresse_livraison`
--

CREATE TABLE `adresse_livraison` (
  `id_adresse_livraison` int(11) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `societe` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `complement_adresse` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `cp` varchar(255) DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
(18, 'test', 'test', 'test', 'test', 'test', 'test', '00000', 'France', '0987654356', 1),
(19, 'van', 'kocko`', '', '4', 'credon', 'marville', '55600', 'France', '0651171435', 1),
(20, 'van', 'kocko', '', '4', 'credon', 'marville', '55600', 'France', '0651171435', 1),
(21, 'van', 'kocko', 'infozone', '4 rue ', 'de credon', 'marville', '55600', 'France', '0651171435', 1),
(22, 'van', 'kocko', '', '4 rue', 'de credon', 'marville', '55600', 'France', '0651171435', 1),
(23, 'van', 'kocko', '', '4 rue', 'de credon', 'marville', '55600', 'France', '0651171435', 1),
(24, 'van', 'kocko', '', '4 rue', 'credon', 'marville', '55600', 'France', '0651171435', 1),
(25, 'van', 'kocko', '', '4 rue', 'de credon', 'marville', '55600', 'France', '0651171435', 1),
(26, 'van', 'kocko', '', '4 rue', 'de credon', 'marville', '55600', 'France', '0651171435', 1),
(27, 'van', 'kocko', '', '4 rue', 'de credon', 'marville', '55600', 'France', '0651171435', 1),
(28, 'van', 'kocko', '', '4 rue', 'de credon', 'marville', '55600', 'France', '0651171435', 1),
(29, 'van', 'kocko', '', '4 rue', 'de credon', 'marville', '55600', 'France', '0651171435', 1),
(30, 'van', 'kocko', '', '4 rue', 'credon', 'marville', '55600', 'France', '0651171435', 1),
(31, 'van', 'kocko', '', '4 rue', 'de credon', 'marville', '55600', 'France', '0651171435', 1),
(32, 'van', 'kocko', '', '4 rue', 'credon', 'marville', '55600', 'France', '0651171435', 1),
(33, 'van', 'kocko', '', '4 rue', 'de credon', 'marville', '55600', 'France', '0651171435', 1),
(34, 'van', 'kocko', '', '4 rue', 'de credon', 'marville', '55600', 'France', '0651171435', 1),
(35, 'van', 'kocko', '', '4 rue', 'de credon', 'marville', '55600', 'France', '0651171435', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `lib_cat` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `lib_cat`) VALUES
(1, 'TOUTES LES MARQUES'),
(2, 'ORDINATEURS & ACCESSOIRES'),
(3, 'ECRAN & MONITEUR'),
(4, 'IMPRIMANTE'),
(5, 'High-Tech'),
(6, 'High-Tech'),
(7, 'fgfhfgh'),
(8, 'fgfhfgh'),
(9, 'fgfhfgh'),
(10, 'fgfhfgh'),
(11, 'High-Tech'),
(12, 'khjhjh');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `confirmation_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `pseudo`, `email`, `mdp`, `confirmation_token`, `confirmation_date`) VALUES
(1, 'test', 'test@gmail.com', '$2y$10$kLFpCHpYZnwm6IXsAX4Gn.faBqCFkIcucVIXgjPEg5EaaLVelfkq2', NULL, '2021-11-03 11:01:49');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `num_commande` int(11) NOT NULL,
  `date_commande` int(11) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE `contenir` (
  `id_produit` int(11) NOT NULL,
  `id_panier` int(11) NOT NULL,
  `qte` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `date_cmd`
--

CREATE TABLE `date_cmd` (
  `date_commande` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id_image` int(11) NOT NULL,
  `lien` varchar(50) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_panier` int(11) NOT NULL,
  `prix_ht` decimal(4,2) DEFAULT NULL,
  `prix_ttc` decimal(4,2) DEFAULT NULL,
  `date_ajout_panier` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `possede`
--

CREATE TABLE `possede` (
  `id_client` int(11) NOT NULL,
  `id_adresse_livraison` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `titre` varchar(20) DEFAULT NULL,
  `reference` varchar(20) DEFAULT NULL,
  `description` text NOT NULL,
  `prix_ht` double(10,1) DEFAULT NULL,
  `prix_ttc` double(10,1) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `titre`, `reference`, `description`, `prix_ht`, `prix_ttc`, `image`, `id_categorie`) VALUES
(1, 'test', 'test', 'test\r\n', 500.0, 500.0, 'upload/acer.PNG', 2),
(2, 'Hp', 'hp pro', 'tres bon produit !\r\n', 200.0, 200.0, 'upload/hp1.PNG', 2),
(3, 'canon ', 'xp 245', 'Tres bonne imprimante\r\n', 250.0, 250.0, 'upload/canon.PNG', 4),
(4, 'test', 'test', 'test\r\n', 10.0, 10.0, 'upload/acer.PNG', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `mdp` varchar(300) NOT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmation_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `prenom`, `email`, `role`, `mdp`, `confirmation_token`, `confirmation_date`) VALUES
(1, 'test', 'test@gmail.com', 'Administrateur', '$2y$10$cQguGimwmAQP4tRgaK1..uZjsnFfoUdLpqNFrPuEcAPOAvJBwQUVu', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresse_facturation`
--
ALTER TABLE `adresse_facturation`
  ADD PRIMARY KEY (`id_adresse_facturation`),
  ADD UNIQUE KEY `id_client` (`id_client`);

--
-- Index pour la table `adresse_livraison`
--
ALTER TABLE `adresse_livraison`
  ADD PRIMARY KEY (`id_adresse_livraison`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`num_commande`),
  ADD KEY `date_commande` (`date_commande`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`id_produit`,`id_panier`),
  ADD KEY `id_panier` (`id_panier`);

--
-- Index pour la table `date_cmd`
--
ALTER TABLE `date_cmd`
  ADD PRIMARY KEY (`date_commande`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_panier`);

--
-- Index pour la table `possede`
--
ALTER TABLE `possede`
  ADD PRIMARY KEY (`id_client`,`id_adresse_livraison`),
  ADD KEY `id_adresse_livraison` (`id_adresse_livraison`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse_facturation`
--
ALTER TABLE `adresse_facturation`
  MODIFY `id_adresse_facturation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `adresse_livraison`
--
ALTER TABLE `adresse_livraison`
  MODIFY `id_adresse_livraison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `num_commande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `date_cmd`
--
ALTER TABLE `date_cmd`
  MODIFY `date_commande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id_panier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
