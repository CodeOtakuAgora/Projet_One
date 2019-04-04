-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 03 avr. 2019 à 17:58
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hwear`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

DROP TABLE IF EXISTS `acheteur`;
CREATE TABLE IF NOT EXISTS `acheteur` (
  `id` int(11) NOT NULL,
  `id_panier` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_panier`),
  KEY `FK_acheteur_id_panier` (`id_panier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Structure de la table `barre_recherche`
--

DROP TABLE IF EXISTS `barre_recherche`;
CREATE TABLE IF NOT EXISTS `barre_recherche` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `id_admin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categories_id_admin` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `id_admin`) VALUES
(1, 'Homme', 1),
(2, 'Femme', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_commande` timestamp NOT NULL,
  `date_envoi` date NOT NULL,
  `date_livraison` date NOT NULL,
  `prix_commande` float NOT NULL,
  `id_users` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_commande_id_users` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commander`
--

DROP TABLE IF EXISTS `commander`;
CREATE TABLE IF NOT EXISTS `commander` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `nom_produit` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `date_creation` timestamp NOT NULL,
  `id_users` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_commentaires_id_users` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `id_user`, `statut`) VALUES
(1, 0, 0),
(2, 0, 0),
(3, 0, 0),
(4, 0, 0),
(5, 0, 0),
(6, 0, 0),
(7, 0, 0),
(8, 0, 0),
(9, 0, 0),
(10, 1, 1),
(11, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `panier_produit`
--

DROP TABLE IF EXISTS `panier_produit`;
CREATE TABLE IF NOT EXISTS `panier_produit` (
  `id_panier` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier_produit`
--

INSERT INTO `panier_produit` (`id_panier`, `id_produit`, `quantity`) VALUES
(10, 1, 29),
(10, 5, 4),
(10, 8, 1),
(11, 5, 1),
(11, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `logo` varchar(25) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_sous_categorie` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_produit_id_sous_categories` (`id_sous_categorie`),
  KEY `FK_produit_id_admin` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `logo`, `id_categorie`, `id_sous_categorie`, `id_admin`) VALUES
(1, 'T-shirt manche courte', 'couleur : blanc / Taille : M', 15.9, 'tshirt-blanc.png', 1, 1, 1),
(2, 'T-shirt manche courte', 'couleur : noir, blanc / Taille : M ', 15.8, 'tshirt-blanc-noir.png', 1, 1, 1),
(3, 'T-shirt manche courte', 'couleur : rouge / taille : M', 16.8, 'tshirt-rouge.png', 1, 1, 1),
(4, 'Pull ', 'couleur : noire / taille : M', 14.9, 'pull-noir.png', 1, 3, 1),
(5, 'Pull', 'couleur :  blanc / taille : M', 15.1, 'pull-blanc.png', 1, 3, 1),
(6, 'Pull', 'couleur : jaune / taille : M', 14.5, 'pull-jaune.png', 1, 3, 1),
(7, 'Pantalon jeans', 'couleur : gris foncé / taille : 42', 18.9, 'pantalon-gris-f.png', 1, 2, 1),
(8, 'Pantalon jeans', 'couleur : gris clair / taille : 42', 19.8, 'pantalon-gris-c.jpg', 1, 2, 1),
(9, 'Pantalon jeans', 'couleur : bleu ciel / taille : 42', 17.9, 'pantalon-bleu-c.jpg', 1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `recherche_produits`
--

DROP TABLE IF EXISTS `recherche_produits`;
CREATE TABLE IF NOT EXISTS `recherche_produits` (
  `id` int(11) NOT NULL,
  `id_barre_recherche` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_barre_recherche`),
  KEY `FK_recherche_produits_id_barre_recherche` (`id_barre_recherche`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `relation_bon_commande`
--

DROP TABLE IF EXISTS `relation_bon_commande`;
CREATE TABLE IF NOT EXISTS `relation_bon_commande` (
  `id` int(11) NOT NULL,
  `id_commander` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_commander`),
  KEY `FK_relation_bon_commande_id_commander` (`id_commander`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `relation_commande`
--

DROP TABLE IF EXISTS `relation_commande`;
CREATE TABLE IF NOT EXISTS `relation_commande` (
  `id` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_produit`),
  KEY `FK_relation_commande_id_produit` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sous_categories`
--

DROP TABLE IF EXISTS `sous_categories`;
CREATE TABLE IF NOT EXISTS `sous_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sous_categories_id_categories` (`id_categorie`),
  KEY `FK_sous_categories_id_admin` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sous_categories`
--

INSERT INTO `sous_categories` (`id`, `nom`, `id_categorie`, `id_admin`) VALUES
(1, 't-shirt', 1, 1),
(2, 'pantalon', 1, 1),
(3, 'pull', 1, 1),
(4, 't-shirt', 2, 1),
(5, 'pull', 2, 1),
(6, 'pantalon', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `suppression_commentaires`
--

DROP TABLE IF EXISTS `suppression_commentaires`;
CREATE TABLE IF NOT EXISTS `suppression_commentaires` (
  `id` int(11) NOT NULL,
  `id_commentaires` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_commentaires`),
  KEY `FK_suppression_commentaires_id_commentaires` (`id_commentaires`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `code_postal` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `telephone` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `mail`, `password`, `rue`, `code_postal`, `ville`, `telephone`) VALUES
(1, 'test', 'test', 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'autre', 'autre', 'autre', '0631134697'),
(2, 'user', 'user', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'autre', 'autre', 'autre', '0631134698');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `acheteur`
--
ALTER TABLE `acheteur`
  ADD CONSTRAINT `FK_acheteur_id` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_acheteur_id_panier` FOREIGN KEY (`id_panier`) REFERENCES `panier` (`id`);

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `FK_categories_id_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_commande_id_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `FK_commentaires_id_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `FK_produit_id_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_produit_id_sous_categories` FOREIGN KEY (`id_sous_categorie`) REFERENCES `sous_categories` (`id`);

--
-- Contraintes pour la table `recherche_produits`
--
ALTER TABLE `recherche_produits`
  ADD CONSTRAINT `FK_recherche_produits_id` FOREIGN KEY (`id`) REFERENCES `produits` (`id`),
  ADD CONSTRAINT `FK_recherche_produits_id_barre_recherche` FOREIGN KEY (`id_barre_recherche`) REFERENCES `barre_recherche` (`id`);

--
-- Contraintes pour la table `relation_bon_commande`
--
ALTER TABLE `relation_bon_commande`
  ADD CONSTRAINT `FK_relation_bon_commande_id` FOREIGN KEY (`id`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `FK_relation_bon_commande_id_commander` FOREIGN KEY (`id_commander`) REFERENCES `commander` (`id`);

--
-- Contraintes pour la table `relation_commande`
--
ALTER TABLE `relation_commande`
  ADD CONSTRAINT `FK_relation_commande_id` FOREIGN KEY (`id`) REFERENCES `commander` (`id`),
  ADD CONSTRAINT `FK_relation_commande_id_produit` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD CONSTRAINT `FK_sous_categories_id_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_sous_categories_id_categories` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `suppression_commentaires`
--
ALTER TABLE `suppression_commentaires`
  ADD CONSTRAINT `FK_suppression_commentaires_id` FOREIGN KEY (`id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_suppression_commentaires_id_commentaires` FOREIGN KEY (`id_commentaires`) REFERENCES `commentaires` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
