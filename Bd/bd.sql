-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : 2025-08-27
-- Version du serveur : 8.0.18
-- Version de PHP : 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
 /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
 /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 /*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `marmiton_db`
--

-- --------------------------------------------------------
-- Structure de la table `utilisateurs`
-- --------------------------------------------------------
CREATE TABLE `utilisateurs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(255) DEFAULT NULL,
  `email` VARCHAR(255) DEFAULT NULL,
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `niveau` ENUM('débutant','intermédiaire','expert') DEFAULT 'débutant',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--
INSERT INTO `utilisateurs` (`nom`, `email`, `niveau`) VALUES
('umar', 'umarsdq06@gmail.com', 'intermédiaire'),
('ashank', 'ashank@gmail.com', 'intermédiaire'),
('charbel', 'charbel@gmail.com', 'intermédiaire');

-- --------------------------------------------------------
-- Structure de la table `recettes`
-- --------------------------------------------------------
CREATE TABLE `recettes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(255) DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `utilisateur_id` INT(11) DEFAULT NULL,
  `date_creation` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_recettes_utilisateur` (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `recettes`
--
INSERT INTO `recettes` (`titre`, `description`, `utilisateur_id`, `date_creation`) VALUES
('Pâtes ', 'Italien.', 1, CURRENT_TIMESTAMP),
('Salade ', 'Tomates, concombre, olives.', 2, CURRENT_TIMESTAMP),
('Brownies', 'Chocolat.', 3, CURRENT_TIMESTAMP);

-- --------------------------------------------------------
-- Structure de la table `ingredients`
-- --------------------------------------------------------
CREATE TABLE `ingredients` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(255) DEFAULT NULL,
  `recette_id` INT(11) DEFAULT NULL,
  `liste_ingredients` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_ingredients_recette` (`recette_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ingredients`
--
INSERT INTO `ingredients` (`nom`, `recette_id`, `liste_ingredients`) VALUES
('Pancetta', 1, '200g pancetta, 3 œufs, parmesan, poivre'),
('Salade', 2, '1 concombre, 2 tomates, feta, olives, oignon rouge, huile d’olive'),
('Brownie', 3, '200g chocolat, 150g beurre, 3 œufs, 100g farine, 150g sucre');

-- --------------------------------------------------------
-- Contraintes pour les tables déchargées
-- --------------------------------------------------------
ALTER TABLE `recettes`
  ADD CONSTRAINT `fk_recettes_utilisateur`
    FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`)
    ON UPDATE CASCADE
    ON DELETE SET NULL;

ALTER TABLE `ingredients`
  ADD CONSTRAINT `fk_ingredients_recette`
    FOREIGN KEY (`recette_id`) REFERENCES `recettes` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
 /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
 /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
