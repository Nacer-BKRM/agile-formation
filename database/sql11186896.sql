-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Hôte : sql11.freemysqlhosting.net
-- Généré le :  mar. 25 juil. 2017 à 08:24
-- Version du serveur :  5.5.53-0ubuntu0.14.04.1
-- Version de PHP :  7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sql11186896`
--

-- --------------------------------------------------------

--
-- Structure de la table `pcs`
--

CREATE TABLE `pcs` (
  `id_pc` int(11) NOT NULL,
  `nom` varchar(5) NOT NULL,
  `libre` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pcs`
--

INSERT INTO `pcs` (`id_pc`, `nom`, `libre`) VALUES
(1, 'PC-1', 0),
(2, 'PC-2', 0),
(3, 'PC-3', 0),
(4, 'PC-4', 0),
(5, 'PC-5', 0),
(6, 'PC-6', 0),
(7, 'PC-7', 0),
(8, 'PC-8', 0),
(9, 'PC-9', 0),
(10, 'PC-10', 0);

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

CREATE TABLE `prix` (
  `id_prix` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `montant` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `prix`
--

INSERT INTO `prix` (`id_prix`, `nom`, `montant`) VALUES
(1, 'normal', '3'),
(2, 'happyhour', '2');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id_resa` int(11) NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `id_pc` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `credit` decimal(10,0) NOT NULL DEFAULT '0',
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom`, `prenom`, `email`, `password`, `credit`, `role`) VALUES
(1, 'Lenne', 'Johann', 'johann.lenne@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0', 'USER'),
(2, 'Picquette', 'Jonathan', 'jonathan.picquette@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0', 'ADMIN');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pcs`
--
ALTER TABLE `pcs`
  ADD PRIMARY KEY (`id_pc`);

--
-- Index pour la table `prix`
--
ALTER TABLE `prix`
  ADD PRIMARY KEY (`id_prix`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id_resa`),
  ADD KEY `reservation_pc` (`id_pc`),
  ADD KEY `reservation_user` (`id_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pcs`
--
ALTER TABLE `pcs`
  MODIFY `id_pc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `prix`
--
ALTER TABLE `prix`
  MODIFY `id_prix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id_resa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservation_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `reservation_pc` FOREIGN KEY (`id_pc`) REFERENCES `pcs` (`id_pc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
