-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 29 sep. 2025 à 18:30
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blockchain_jobs`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidatures`
--

CREATE TABLE `candidatures` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `cv_filename` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_candidature` datetime DEFAULT current_timestamp(),
  `statut` enum('en_attente','en_cours','acceptee','refusee') DEFAULT 'en_attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `candidatures`
--

INSERT INTO `candidatures` (`id`, `job_id`, `fullname`, `email`, `phone`, `cv_filename`, `message`, `date_candidature`, `statut`) VALUES
(1, 1, 'METCHIHOUNGBE Fernand', 'marilucmetchihoungbe@gmail.com', '+229 54 00 62 06', '68d995b6dc461_METCHIHOUNGBE_Fernand.pdf', '// Sample job data\r\n        const jobs = [\r\n            {\r\n                id: 1,\r\n                title: \"Développeur Blockchain Solidity\",\r\n                company: \"CryptoCorp\",\r\n                location: \"Paris, France\",\r\n                remote: \"Hybride\",\r\n                type: \"CDI\",\r\n                experience: \"Intermédiaire\",\r\n                salary: \"70k-90k €\",\r\n                description: \"Nous recherchons un développeur Solidity expérimenté pour rejoindre notre équipe de développement DeFi.\",\r\n                tags: [\"Solidity\", \"Ethereum\", \"DeFi\", \"Smart Contracts\"]\r\n            },\r\n            {\r\n                id: 2,\r\n                title: \"Ingénieur Rust Blockchain\",\r\n                company: \"Web3Solutions\",\r\n                location: \"Lyon, France\",\r\n                remote: \"100% remote\",\r\n                type: \"CDI\",\r\n                experience: \"Senior\",\r\n                salary: \"80k-100k €\",\r\n                description: \"Rejoignez notre équipe pour développer la prochaine génération de protocoles blockchain en Rust.\",\r\n                tags: [\"Rust\", \"Substrate\", \"Polkadot\", \"Web3\"]\r\n            },\r\n            {\r\n                id: 3,\r\n                title: \"Architecte Blockchain\",\r\n                company: \"ChainTech\",\r\n                location: \"Toulouse, France\",\r\n                remote: \"Sur site\",\r\n                type: \"CDI\",\r\n                experience: \"Senior\",\r\n                salary: \"90k-110k €\",\r\n                description: \"Concevez et implémentez des solutions blockchain enterprise pour nos clients.\",\r\n                tags: [\"Hyperledger\", \"Architecture\", \"Enterprise\", \"Solutions\"]\r\n            },\r\n            {\r\n                id: 4,\r\n                title: \"Développeur Web3 Frontend\",\r\n                company: \"DAppFactory\",\r\n                location: \"Bordeaux, France\",\r\n                remote: \"Hybride\",\r\n                type: \"CDI\",\r\n                experience: \"Intermédiaire\",\r\n                salary: \"50k-70k €\",\r\n                description: \"Créez des interfaces utilisateur intuitives pour des applications décentralisées.\",\r\n                tags: [\"React\", \"Web3.js\", \"Ethers.js\", \"DApps\"]\r\n            },\r\n            {\r\n                id: 5,\r\n                title: \"Expert Smart Contracts\",\r\n                company: \"SecureBlock\",\r\n                location: \"Nantes, France\",\r\n                remote: \"100% remote\",\r\n                type: \"Freelance\",\r\n                experience: \"Senior\",\r\n                salary: \"€€€\",\r\n                description: \"Audit et développement de smart contracts sécurisés pour divers projets blockchain.\",\r\n                tags: [\"Audit\", \"Sécurité\", \"Solidity\", \"Smart Contracts\"]\r\n            },\r\n            {\r\n                id: 6,\r\n                title: \"Stagiaire Développement Blockchain\",\r\n                company: \"BlockStart\",\r\n                location: \"Lille, France\",\r\n                remote: \"Sur site\",\r\n                type: \"Stage\",\r\n                experience: \"Junior\",\r\n                salary: \"Indemnités\",\r\n                description: \"Opportunité de stage pour apprendre le développement blockchain avec notre équipe.\",\r\n                tags: [\"Apprentissage\", \"Solidity\", \"JavaScript\", \"Stage\"]\r\n            }\r\n        ];', '2025-09-28 21:08:22', 'en_attente');

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` int(11) NOT NULL,
  `nom_entreprise` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_creation` datetime DEFAULT current_timestamp(),
  `statut` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom_entreprise`, `email`, `password`, `date_creation`, `statut`) VALUES
(1, 'Flash', 'flash@gmail.com', '$2y$10$m7CFdialyALWG04GVjBc..GJIRaSLxMhvInDZkz3z86XwEHV3DJPy', '2025-09-28 20:25:55', 'active'),
(2, 'Gozem', 'gozem@gmail.com', '$2y$10$K89mI0V8JhxvEUhu40XQA.MoRffIGXC7VMshupza58ifrkJYwIPf6', '2025-09-28 20:28:25', 'active');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `remote` enum('Sur site','Hybride','100% remote') DEFAULT 'Sur site',
  `type` enum('CDI','CDD','Freelance','Stage','Alternance') DEFAULT 'CDI',
  `experience` enum('Junior','Intermédiaire','Senior','Expert') DEFAULT 'Intermédiaire',
  `salary` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `tags` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `statut` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidatures`
--
ALTER TABLE `candidatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_job_id` (`job_id`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_date` (`date_candidature`);

--
-- Index pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom_entreprise` (`nom_entreprise`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_nom_entreprise` (`nom_entreprise`),
  ADD KEY `idx_email` (`email`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidatures`
--
ALTER TABLE `candidatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
