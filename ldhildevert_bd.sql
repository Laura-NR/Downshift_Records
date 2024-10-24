-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql-5.7
-- Généré le : jeu. 24 oct. 2024 à 21:02
-- Version du serveur : 5.7.28
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ldhildevert_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `record_Auteur`
--

CREATE TABLE `record_Auteur` (
  `id` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Vignette` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `record_Auteur`
--

INSERT INTO `record_Auteur` (`id`, `Nom`, `Vignette`) VALUES
(5, 'Nickelback', 'f9ce8be2d5ddd1a046227d4b3df9b510.jpg'),
(6, 'Imagine Dragons', 'ad255404a818dfbd6b2ccd17bda35988.jpg'),
(7, 'Daughtry', 'daughtry_petit.png');

-- --------------------------------------------------------

--
-- Structure de la table `record_Cd`
--

CREATE TABLE `record_Cd` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `vignette` varchar(255) NOT NULL,
  `idAuteur` int(11) NOT NULL,
  `vignette_large` varchar(255) NOT NULL,
  `prix` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `record_Cd`
--

INSERT INTO `record_Cd` (`id`, `titre`, `vignette`, `idAuteur`, `vignette_large`, `prix`) VALUES
(9, 'Feed the Machine', 'https___images.genius.com_9d6cfb8585f15bf363bb75483826b8ed.1000x1000x1_small.jpg', 5, 'nickelback-feed-the-machine-cover-1485387482 (1).jpg', '18'),
(10, 'No Fixed Address', 'Nickelback-NofixedAddress_small.jpg', 5, 'Nickelback-NofixedAddress_large.jpg', '20'),
(11, 'Origins', 'Meilleurs-Albums-Imagine-Dragons-Origins_small.jpg', 6, 'Imagine-Dragons-Origins-album-cover-820-820x820.jpg', '16'),
(12, 'Break the Spell', 'break_the_spell-petit.jpg', 7, '81kTW9M+FRL (1).jpg', '15'),
(13, 'Cage to Rattle', 'cage_to_rattle_petit.jpg', 7, 'cage_to_rattle_large.jpg', '17');

-- --------------------------------------------------------

--
-- Structure de la table `record_Chansons`
--

CREATE TABLE `record_Chansons` (
  `id` int(11) NOT NULL,
  `Titre` varchar(100) NOT NULL,
  `Duree` time NOT NULL,
  `id_CD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `record_Chansons`
--

INSERT INTO `record_Chansons` (`id`, `Titre`, `Duree`, `id_CD`) VALUES
(52, 'Feed the Machine', '05:02:00', 9),
(53, 'Coin for the Ferryman', '04:50:00', 9),
(54, 'Song on Fire', '03:51:00', 9),
(55, 'Must be Nice', '03:43:00', 9),
(56, 'After the rain', '03:35:00', 9),
(57, 'For the River', '03:28:00', 9),
(58, 'Home', '03:52:00', 9),
(59, 'The Betrayal (Act III)', '04:20:00', 9),
(60, 'Silent Majority', '03:52:00', 9),
(61, 'Every Time We\'re Together', '03:52:00', 9),
(62, 'The Betrayal (Act I) Instrumental', '02:42:00', 9),
(63, 'Million Miles An Hour', '04:10:00', 10),
(64, 'Edge of a Revolution', '04:03:00', 10),
(65, 'What are you Waiting for?', '03:38:00', 10),
(66, 'She Keeps Me Up', '03:57:00', 10),
(67, 'Make Me Believe Again', '03:33:00', 10),
(68, 'Satellite', '03:57:00', 10),
(69, 'Get \'Em Up', '03:53:00', 10),
(70, 'The Hammer\'s Coming Down', '04:24:00', 10),
(71, 'Miss You', '04:02:00', 10),
(72, 'Got Me Runnin\' Round Feat. Flo Rida', '04:05:00', 10),
(73, 'Sister Sin', '03:25:00', 10),
(74, 'Natural', '03:09:00', 11),
(75, 'Boomerang', '03:07:00', 11),
(76, 'Machine', '03:01:00', 11),
(77, 'Cool Out', '03:37:00', 11),
(78, 'Bad Liar', '04:20:00', 11),
(79, 'West Coast', '03:37:00', 11),
(80, 'Zero', '03:30:00', 11),
(81, 'Bullet in a Gun', '03:24:00', 11),
(82, 'Digital', '03:21:00', 11),
(83, 'Only', '03:00:00', 11),
(84, 'Stuck', '03:10:00', 11),
(85, 'Love', '02:46:00', 11),
(86, 'Renegade', '03:35:00', 12),
(87, 'Crawling Back to You', '03:45:00', 12),
(88, 'Outta My Head', '03:31:00', 12),
(89, 'Start of Something Good', '04:24:00', 12),
(90, 'Crazy', '03:24:00', 12),
(91, 'Break the Spell', '03:32:00', 12),
(92, 'We\'re Not Gonna Fall', '03:39:00', 12),
(93, 'Gone Too Soon', '03:36:00', 12),
(94, 'Losing My Mind', '03:48:00', 12),
(95, 'Rescue Me', '03:22:00', 12),
(96, 'Louder Than Ever', '03:37:00', 12),
(97, 'Spaceship', '03:51:00', 12),
(98, 'Just Found Heaven', '04:14:00', 13),
(99, 'Backbone', '03:01:00', 13),
(100, 'Deep End', '03:51:00', 13),
(101, 'As You Are', '03:45:00', 13),
(102, 'Death of Me', '03:35:00', 13),
(103, 'Bad Habits', '03:30:00', 13),
(104, 'Back in Time', '04:12:00', 13),
(105, 'Gravity', '03:47:00', 13),
(106, 'Stuff of Legends', '03:50:00', 13),
(107, 'White Flag', '04:52:00', 13);

-- --------------------------------------------------------

--
-- Structure de la table `record_utilisateur`
--

CREATE TABLE `record_utilisateur` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `record_utilisateur`
--

INSERT INTO `record_utilisateur` (`id`, `username`, `email`, `mdp`) VALUES
(1, 'lauranunez', 'lauranunez372@gmail.com', '$2y$10$/ZzMram0DFdxVT3eCDtYV.PMrh.q3tzbFbdvO3SK6UBD3KVZyhrUi'),
(2, 'leadespre', 'desprehildevertlea@gmail.com', 'password'),
(3, 'admin', 'admin@example.com', '$2y$10$vWju8VhIo15zqPeTwsRnhOALtSLNZ5uY9H43s2i7GScQ5RhzcaWoa');


--
-- Index pour la table `record_Auteur`
--
ALTER TABLE `record_Auteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `record_Cd`
--
ALTER TABLE `record_Cd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idAuteur` (`idAuteur`);

--
-- Index pour la table `record_Chansons`
--
ALTER TABLE `record_Chansons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `record_Chansons_ibfk_1` (`id_CD`);

--
-- Index pour la table `record_utilisateur`
--
ALTER TABLE `record_utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour la table `record_Auteur`
--
ALTER TABLE `record_Auteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `record_Cd`
--
ALTER TABLE `record_Cd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `record_Chansons`
--
ALTER TABLE `record_Chansons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT pour la table `record_utilisateur`
--
ALTER TABLE `record_utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


--
-- Contraintes pour la table `record_Cd`
--
ALTER TABLE `record_Cd`
  ADD CONSTRAINT `record_Cd_ibfk_1` FOREIGN KEY (`idAuteur`) REFERENCES `record_Auteur` (`id`);

--
-- Contraintes pour la table `record_Chansons`
--
ALTER TABLE `record_Chansons`
  ADD CONSTRAINT `record_Chansons_ibfk_1` FOREIGN KEY (`id_CD`) REFERENCES `record_Cd` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
