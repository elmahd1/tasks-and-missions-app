-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 08:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp0`
--

-- --------------------------------------------------------

--
-- Table structure for table `missions`
--

CREATE TABLE `missions` (
  `id` int(5) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `missions`
--

INSERT INTO `missions` (`id`, `nom`, `description`, `user_id`) VALUES
(1, 'mission1', 'test avec taches', 1),
(2, 'mission2', 'test sans tache', 1);

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `user_id` int(11) NOT NULL,
  `operation` text NOT NULL,
  `dateheur` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operations`
--

INSERT INTO `operations` (`user_id`, `operation`, `dateheur`) VALUES
(1, 'lutilisateur a mis a jour la tache', '2024-10-13 16:51:54'),
(1, 'lutilisateur a mis a jour la tache', '2024-10-13 16:51:56'),
(2, ' a insere la tache test pour compte 2', '2024-10-13 17:38:46'),
(2, ' a partage la tache 8 vers 1', '2024-10-13 17:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `shared_mission`
--

CREATE TABLE `shared_mission` (
  `mission_id` int(11) NOT NULL,
  `user_partage_id` int(11) NOT NULL,
  `droit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shared_tasks`
--

CREATE TABLE `shared_tasks` (
  `task_id` int(5) NOT NULL,
  `user_partage_id` int(5) NOT NULL,
  `droit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shared_tasks`
--

INSERT INTO `shared_tasks` (`task_id`, `user_partage_id`, `droit`) VALUES
(8, 1, 'consultation'),
(8, 1, 'consultation');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(5) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `resultat` text NOT NULL,
  `priorites` int(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `user_id` int(5) NOT NULL,
  `missions_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `nom`, `description`, `resultat`, `priorites`, `status`, `user_id`, `missions_id`) VALUES
(1, 'test1', 'cest juste un test', '', 1, 'impossible', 1, 1),
(8, 'test pour compte 2', 'desc desc ', '', 1, 'facile', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `droit` varchar(10) NOT NULL,
  `etat` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `motde_passe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `droit`, `etat`, `email`, `motde_passe`) VALUES
(1, 'elmahdi', 'admin', 'active', 'elmhadrielmahdi@gmail.com', '$2y$10$ndBL2lo7G6ZfHA8vp7Ld9eOMgVXXZa6yU1s8tEQmWPBcTbK/h7Mp2'),
(2, 'user', 'user', 'active', 'user@gmail.com', '$2y$10$iMxwZP2mme.n9mZjjOv0ROm0A1GZqGlKZNWlS164ICiNO0IQdNGwS'),
(3, 'user2', 'user', 'desactive', 'user2@gmail.com', '$2y$10$U2kdH9s.NfgUnNvnFaLHs.GhzyfqdcihfA2caFNevt0T.K7GDFpQ2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `shared_mission`
--
ALTER TABLE `shared_mission`
  ADD KEY `mission_id` (`mission_id`);

--
-- Indexes for table `shared_tasks`
--
ALTER TABLE `shared_tasks`
  ADD KEY `missions_id` (`task_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `missions_id` (`missions_id`),
  ADD KEY `tasks_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `missions`
--
ALTER TABLE `missions`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `missions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `operations`
--
ALTER TABLE `operations`
  ADD CONSTRAINT `operations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `shared_mission`
--
ALTER TABLE `shared_mission`
  ADD CONSTRAINT `shared_mission_ibfk_1` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
