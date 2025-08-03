-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2025 at 09:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamezone`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `feedback_text` text NOT NULL,
  `submitted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `image_url` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `description`, `image`, `url`, `created_at`, `image_url`) VALUES
(1, 'RUN JUMP', 'A fast-paced, brick breaking balancing act! Jump over obstacles and collect coins in this endless runner game.', 'Run (4).png', 'game 1/index.php', '2025-06-23 12:32:41', ''),
(2, 'FIRE GAME', 'Dodge the traps and race to the end! Shoot your way through enemies in this action-packed adventure.', 'RunShoot.png', 'firegame.html', '2025-06-23 12:32:41', '');

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `high_score` int(11) NOT NULL,
  `achieved_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaderboard`
--

INSERT INTO `leaderboard` (`id`, `user_id`, `game_id`, `high_score`, `achieved_at`) VALUES
(6, 16, 1, 58, '2025-06-23 19:06:01'),
(7, 17, 1, 57, '2025-06-23 19:19:22'),
(8, 18, 1, 297, '2025-06-23 19:21:00'),
(9, 19, 1, 177, '2025-06-23 19:22:56'),
(10, 20, 1, 297, '2025-06-23 19:27:28'),
(11, 21, 1, 57, '2025-06-24 01:23:01'),
(12, 22, 1, 337, '2025-06-24 03:43:25'),
(14, 23, 1, 137, '2025-06-24 11:38:04'),
(15, 24, 1, 177, '2025-06-24 12:22:58'),
(16, 25, 1, 137, '2025-06-24 12:47:41'),
(18, 35, 1, 97, '2025-06-26 14:26:22'),
(19, 41, 1, 57, '2025-06-26 14:39:12'),
(20, 62, 1, 137, '2025-07-22 19:01:47'),
(21, 64, 1, 57, '2025-07-22 19:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `achieved_at` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `user_id`, `game_id`, `score`, `achieved_at`, `created_at`) VALUES
(26, 16, 1, 58, '2025-06-23 19:06:01', '2025-06-23 19:06:01'),
(27, 17, 1, 57, '2025-06-23 19:19:21', '2025-06-23 19:19:21'),
(28, 18, 1, 297, '2025-06-23 19:21:00', '2025-06-23 19:21:00'),
(29, 19, 1, 177, '2025-06-23 19:22:56', '2025-06-23 19:22:56'),
(30, 20, 1, 58, '2025-06-23 19:24:56', '2025-06-23 19:24:56'),
(31, 20, 1, 58, '2025-06-23 19:27:22', '2025-06-23 19:27:22'),
(32, 20, 1, 177, '2025-06-23 19:27:27', '2025-06-23 19:27:27'),
(33, 20, 1, 297, '2025-06-23 19:27:28', '2025-06-23 19:27:28'),
(34, 20, 1, 57, '2025-06-23 19:27:30', '2025-06-23 19:27:30'),
(35, 20, 1, 58, '2025-06-23 19:27:34', '2025-06-23 19:27:34'),
(36, 21, 1, 57, '2025-06-24 01:23:01', '2025-06-24 01:23:01'),
(37, 22, 1, 337, '2025-06-24 03:43:25', '2025-06-24 03:43:25'),
(38, 1, 1, 337, '2025-06-24 03:57:50', '2025-06-24 03:57:50'),
(39, 23, 1, 137, '2025-06-24 11:38:04', '2025-06-24 11:38:04'),
(40, 24, 1, 177, '2025-06-24 12:22:58', '2025-06-24 12:22:58'),
(41, 25, 1, 137, '2025-06-24 12:47:41', '2025-06-24 12:47:41'),
(42, 29, 1, 137, '2025-06-26 14:20:14', '2025-06-26 14:20:14'),
(43, 35, 1, 97, '2025-06-26 14:26:22', '2025-06-26 14:26:22'),
(44, 41, 1, 57, '2025-06-26 14:39:12', '2025-06-26 14:39:12'),
(45, 41, 1, 57, '2025-07-22 14:50:41', '2025-07-22 14:50:41'),
(46, 62, 1, 137, '2025-07-22 19:01:47', '2025-07-22 19:01:47'),
(47, 64, 1, 57, '2025-07-22 19:12:21', '2025-07-22 19:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`, `created_at`) VALUES
(16, 'Hasidu Dilshan', 'hasidudilshan@gmail.com', '$2y$10$hTVZadWOPM9DjE8Vwqa9WO6HTjj3f/MGkC59LtR9huW54lG13kVA2', 0, '2025-06-23 19:05:10'),
(17, 'maduka anjana', 'maduka123@gmail.com', '$2y$10$ajJy88e9/P9kDa3fqvvbNeYgNPhv/TrraiCiqF3SpgXjnLsAabEXm', 0, '2025-06-23 19:18:49'),
(18, 'wasana sandaruwani', 'wasana@gmail.com', '$2y$10$2cDCdJnMfKoQ.WKUsWoNneYRv4jJWFOmUDMWCZhI3KUuKQDVPQI6q', 0, '2025-06-23 19:20:03'),
(19, 'Nipun Tharaka', 'nipuntharaka@gmail.com', '$2y$10$/WhJbQmhYwM9Sq9e.BEKvuOB/A3wrtXFYKju/Or1T.sBe225TGAnW', 0, '2025-06-23 19:22:12'),
(20, 'lakshi', 'lakshidinethma345@gmail.com', '$2y$10$NjP2jmyR.4BRCQh4NQ5ynOoQtkLj1oJ7ZCTC5xBTdeg/99VGpyQxu', 0, '2025-06-23 19:24:25'),
(21, 'chenya ranudini', 'chenyaranudinii@gmail.com', '$2y$10$mez79sQ2ZVIaUUoVFHoXo.1.G.nQG8HuZmRYq7Y4Mm878s0bWVLNi', 0, '2025-06-24 01:21:57'),
(22, 'Ruhansa Ranudinii', 'ruhansaranudinii@gmail.com', '$2y$10$0K9hQfvZ620NnDhF09vfc.JH2vjcAqiYZm6hXXsxG2kqTdBGYpNym', 0, '2025-06-24 03:30:52'),
(23, 'vishwa', 'vishwa@gmail.com', '$2y$10$6qUIrb2jQUniKXEp6P6LRO7UtSneWus79TrfJnr6n1eAI5ws.Znra', 0, '2025-06-24 11:02:57'),
(24, 'Kalana', 'kalana@gmail.com', '$2y$10$CX5SnAzC656i5iBEmA465u4VBjKAq.Bbh03kq9K8UlkK3GMhXtFPm', 0, '2025-06-24 12:22:06'),
(25, 'sandun chamara', 'sandunchamra@gmail.com', '$2y$10$Trfowut9O.rjfLHcyY8/UeOxtnPbHsueWDpZklud5Q.620RXgJqUG', 0, '2025-06-24 12:47:02'),
(26, 'hemal', 'hemal@gmal.com', '$2y$10$2HVZJgc6AcLCLd1PAwp91eb8wOhYAC96dtshga3J2fVz/n93/KKRO', 0, '2025-06-26 13:45:06'),
(32, 'MADUSH', 'madusha@gmail.com', '$2y$10$UTsgUwZaTRZ7lc8i//VuSudBT1M7qn4U8VeiAkbMVosVnX5D/X09e', 0, '2025-06-26 14:16:05'),
(34, 'Dasun', 'dasun@gmail.com', '$2y$10$4rWDRi49lTUvjr0DNRRCDOO/5kNXXQ0KfRIA1UIEUozuQ2DDQUHw.', 0, '2025-06-26 14:19:54'),
(35, 'achintha', 'achintha@gmail.com', '$2y$10$9zLsnuLYG9tjr3wwqfe.tOXUoXVHpG2SBKM/9lsPUuMz1DtftWtRe', 0, '2025-06-26 14:22:16'),
(37, 'chamra', 'chamra@gmail.com', '$2y$10$N7Q7RCh4LpBgR5ssiJaSReQKe5VuFzgDmCJQ4wCyxnMl0I/oA/VoK', 0, '2025-06-26 14:31:39'),
(39, 'sangeeth', 'sangeeth@gmail.com', '$2y$10$hrPvpeXfPX6gxPIAClIiKuE..6W/gsN3X2L/Mmvh2hU8EEXt.9aY6', 0, '2025-06-26 14:35:34'),
(41, 'Imasha', 'imasha@gmail.com', '$2y$10$8pzvfFNVefRE4PD2l6E2i.WT/MoY/jOFzWxXFXjLNkhoimXu0UvvK', 0, '2025-06-26 14:38:20'),
(42, 'sadew', 'sadew@gmail.com', '$2y$10$6L65Kqn/7qJnrcMqvqQelOZNarUC8xyaq/66.qimqJuwX4T2jlUbC', 0, '2025-06-26 14:41:03'),
(44, 'Thushan', 'thushan@gmail.com', '$2y$10$VIjKYWjSczo79ZgxSeyNrOH0C64ZTyo5jljAwZVpmSFTiZOaLRJAS', 0, '2025-06-26 14:44:18'),
(46, 'deshan', 'deshan@gmail.com', '$2y$10$BtsS13H7fpXq6G3Pe2xZ5u5CHs821vagAkA/.bdXYKv0sFS5bhC22', 0, '2025-06-26 14:49:28'),
(47, 'Charuka', 'charuka@gmail.com', '$2y$10$xaavCF9dc4maP7EvUFz94eHfG/F/2o1Ypsro65IgLYTXaeIXs7Xty', 0, '2025-06-26 14:58:03'),
(49, 'Amaya', 'amya@gmail.com', '$2y$10$3Cp5q2HKmNuSe.Dp22hhLekNBR09GL7Q4DUA8JPCb9M0o4p.2qZz2', 0, '2025-06-26 15:05:27'),
(50, 'tharush', 'tharusha@gmail.com', '$2y$10$0iqhE4hBjlV0lS6XRlroveiHuGumLrHOVpe7mFup7uWBB5PyHv5oK', 0, '2025-06-26 15:12:24'),
(53, 'thimira', 'thimira@gmail.com', '$2y$10$XdoKd5dHBkXQ4LqmxE5B9.L.JqCXYfDqR3Y.0NUQxEsHNe0DVkMuS', 0, '2025-06-26 15:21:07'),
(57, 'Dilshan123', 'dilshan12345@gmal.com', '$2y$10$Htb2fJnLYeKI3yjkRz6.lO5uxyAyr2qXS.WEYfDgPYxdZXW3KnOKG', 0, '2025-06-26 17:05:08'),
(61, 'tharaka', 'tharaka@gmail.com', '$2y$10$HVxM6JTgbJyTPUc5NExzAOaGSXha89mqPD57s4x/eywUn66W2OsHq', 0, '2025-07-22 14:52:14'),
(62, 'kaushan', 'kaushan@gmail.com', '$2y$10$a9ds9DTkZ3LMQK0kf6.bL.3nhbszy22SmpcrDTROIJqVRNKMYT/l2', 0, '2025-07-22 19:01:09'),
(63, 'dimuthu', 'dimuthu@gmail.com', '$2y$10$Dy/Qq3hFnQmyYi7sS/ZNneggVaV2ndMYw700Ys3vHfSvWb6XbxfkW', 0, '2025-07-22 19:04:38'),
(64, 'prveen', 'praveen@gmail.com', '$2y$10$T4cqm4/Ol8DvM/zlNAN1AujR.qezUjYjVIwYb7OgixPGCE20jKm9C', 0, '2025-07-22 19:11:12'),
(65, 'pradeep', 'pradeep@gmail.com', '$2y$10$IXwqrrkMZTxioXi8Dh4hgeAdekuU6gQlNlcZk6W92uHyCH7jlzS9C', 0, '2025-08-04 01:11:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leaderboard`
--
ALTER TABLE `leaderboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD CONSTRAINT `leaderboard_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leaderboard_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
