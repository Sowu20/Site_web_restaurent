-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 13 juil. 2023 à 11:09
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `products`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_cl` int(5) NOT NULL,
  `nom_cli` varchar(35) NOT NULL,
  `prenom_cli` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `telephone` int(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `pass` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_cl`, `nom_cli`, `prenom_cli`, `adresse`, `telephone`, `email`, `pass`) VALUES
(20, 'Femme', 'Abicha', 'Davié', 99108428, 'Ds@gmail.com', 'mlm'),
(32, 'MAZOU', 'Odette', 'gnamassi', 90556238, 'odette@gmail.com', '2002'),
(33, 'ZOGBEMA', 'Yawa', 'Camp GP', 90109155, 'zogbema@gmail.com', 'doroté'),
(35, 'KPANLA', 'Arsene', 'Davé', 99787845, 'arsene@gmail.com', 'kpanlaarserne'),
(36, 'KOMBATE', 'Armel', 'Mame', 99874555, 'armel@gmail.com', 'am'),
(37, 'DJOGBEMA', 'Audrey', 'lomé', 99108428, 'audrey@gmail.com', 'aud'),
(40, 'AMEGBLE', 'Henok', 'kara', 98781232, 'henok@gmail.com', 'henoo'),
(41, 'DZOBA', 'Christian', 'Lomé', 99745155, 'chist@gmail', 'christ'),
(42, 'AKPADI', 'Fortuna', 'Kégué', 98745212, 'fortuna@gmail.com', 'fort'),
(43, 'FOTO', 'DODO', 'Athiegou', 99784525, 'fofo@gmail', 'foto'),
(44, 'ALILO', 'Ama', 'Lema', 99108428, 'alilo@gmail.com', 'ali');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_cmd` int(5) NOT NULL,
  `id_cli` int(5) NOT NULL,
  `date_achat` date NOT NULL,
  `montant_t` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_cmd`, `id_cli`, `date_achat`, `montant_t`) VALUES
(23, 20, '2023-06-20', 3900),
(25, 36, '2023-06-21', 8600),
(26, 33, '2023-06-21', 4800),
(27, 37, '2023-06-21', 13700),
(29, 42, '2023-07-03', 2200),
(30, 44, '2023-07-12', 3100);

-- --------------------------------------------------------

--
-- Structure de la table `commander`
--

CREATE TABLE `commander` (
  `id_cmde` int(5) NOT NULL,
  `id_cli` int(5) NOT NULL,
  `id_pro` int(5) NOT NULL,
  `quantite` int(10) NOT NULL,
  `montant_partiel` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commander`
--

INSERT INTO `commander` (`id_cmde`, `id_cli`, `id_pro`, `quantite`, `montant_partiel`) VALUES
(27, 1, 3, 1, 600),
(30, 20, 3, 3, 1800),
(32, 36, 11, 1, 2000),
(33, 36, 3, 1, 600),
(34, 36, 12, 1, 2500),
(35, 36, 4, 1, 3500),
(36, 33, 2, 3, 1800),
(37, 33, 1, 1, 1000),
(38, 33, 5, 1, 2000),
(39, 37, 11, 1, 2000),
(40, 37, 2, 1, 600),
(41, 37, 3, 1, 600),
(42, 37, 4, 3, 10500),
(43, 39, 10, 1, 1500),
(44, 39, 3, 1, 600),
(45, 39, 5, 1, 2000),
(46, 42, 1, 1, 1000),
(47, 42, 2, 1, 600),
(48, 42, 3, 1, 600),
(49, 44, 1, 1, 1000),
(50, 44, 2, 1, 600),
(51, 44, 10, 1, 1500);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `prix` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `img`, `prix`, `nom`) VALUES
(1, 'ablo.jpeg', 1000, 'Super Ablo'),
(2, 'akpa.jpeg', 600, 'Super Akpan'),
(3, 'kom.jpeg', 600, 'Super Kom'),
(4, 'xkyh.jpeg', 3500, 'Super PIZZA'),
(5, 'dje.jpeg', 2000, 'Super Pâte'),
(10, '1686570563de.jpeg', 1500, 'Salade'),
(11, '1686584746heqhrhq.jpeg', 2000, 'Brochette'),
(12, '1687211627OIP (6).jpeg', 2500, 'Super Ablo avec poisson'),
(13, '1687326833htormhtjr.jpeg', 700, 'Super Aloko');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_u` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_u`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_cl`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_cmd`),
  ADD KEY `id_cli` (`id_cli`);

--
-- Index pour la table `commander`
--
ALTER TABLE `commander`
  ADD PRIMARY KEY (`id_cmde`),
  ADD KEY `id_pro` (`id_pro`),
  ADD KEY `id_cli` (`id_cli`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_u`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_cl` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_cmd` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `commander`
--
ALTER TABLE `commander`
  MODIFY `id_cmde` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_cli`) REFERENCES `client` (`id_cl`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commander`
--
ALTER TABLE `commander`
  ADD CONSTRAINT `commander_ibfk_2` FOREIGN KEY (`id_pro`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
