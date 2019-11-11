-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 11 nov. 2019 à 15:10
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

-- Expliquation fichier sql de notre site de vente : 
-- on vérifie si il y a pas déjà une base données hwear si c'est le cas elle sera alors détruite
-- on créer ensuite la base données hwear
-- puis on se postionne sur la base donnée hwear afin que les tables 
-- qui seront crées soient propre à la base de données hwear
-- et pour finir on crée toutes nos tables en insérant toutes les données nescessaires
-- au fonctionnement du site 

DROP DATABASE IF EXISTS `hwear`;
CREATE DATABASE IF NOT EXISTS `hwear`;
USE `hwear`;


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
(1, 'admin', '$2y$12$paMOABEnYs2h3DDIVsPPUe5iZIX/CYU3YxzlWuzfdKNPcpkJArrdC');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `id_admin` int(11) NOT NULL DEFAULT '1',
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
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_commentaires_id_users` (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `message`, `pseudo`, `date_creation`, `id_produit`) VALUES
(1, 'ceci est un commentaire de test', 'test', '2019-11-11 15:07:15', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `id_user`, `statut`) VALUES
(1, 1, 1);

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
  `logo` varchar(255) NOT NULL DEFAULT 'default.png',
  `id_categorie` int(11) NOT NULL,
  `id_sous_categorie` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL DEFAULT '1',
  `confirme` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_produit_id_sous_categories` (`id_sous_categorie`),
  KEY `FK_produit_id_admin` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `logo`, `id_categorie`, `id_sous_categorie`, `id_admin`, `confirme`) VALUES
(1, 'T-shirt blanc', 'Taille : M', 15.9, 'tshirt-blanc.png', 1, 1, 1, 1),
(2, 'T-shirt noir et blanc', 'Taille : M ', 15.8, 'tshirt-blanc-noir.png', 1, 1, 1, 1),
(3, 'T-shirt rouge', 'Taille : M', 16.8, 'tshirt-rouge.png', 1, 1, 1, 1),
(4, 'Pull noir', 'Taille : M', 14.9, 'pull-noir.png', 1, 3, 1, 1),
(5, 'Pull blanc', 'Taille : M', 15.1, 'pull-blanc.png', 1, 3, 1, 1),
(6, 'Pull jaune', 'Taille : M', 14.5, 'pull-jaune.png', 1, 3, 1, 1),
(7, 'Pantalon gris foncé', 'Taille : 42', 18.9, 'pantalon-gris-f.png', 1, 2, 1, 1),
(8, 'Pantalon gris clair', 'Taille : 42', 19.8, 'pantalon-gris-c.jpg', 1, 2, 1, 1),
(9, 'Pantalon bleu ciel', 'Taille : 42', 17.9, 'pantalon-bleu-c.jpg', 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sous_categories`
--

DROP TABLE IF EXISTS `sous_categories`;
CREATE TABLE IF NOT EXISTS `sous_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL DEFAULT '1',
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
  `approuve` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `mail`, `password`, `rue`, `code_postal`, `ville`, `telephone`, `approuve`) VALUES
(1, 'testeur', 'testeur', 'test@gmail.com', '$2y$12$Jwdgr8ejHjsKUFrsQ4XVe.jbx9bxBPwnL7A4H1uUWfG7dwysjcBGu', 'autre', 'autre', 'autre', '0623321122', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `FK_categories_id_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`);

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `FK_commentaires_id_users` FOREIGN KEY (`id_produit`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `FK_produit_id_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_produit_id_sous_categories` FOREIGN KEY (`id_sous_categorie`) REFERENCES `sous_categories` (`id`);

--
-- Contraintes pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD CONSTRAINT `FK_sous_categories_id_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_sous_categories_id_categories` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
