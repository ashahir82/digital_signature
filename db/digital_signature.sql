-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 17, 2026 at 01:58 AM
-- Server version: 8.0.43
-- PHP Version: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_signature`
--

-- --------------------------------------------------------

--
-- Table structure for table `document_signatures`
--

CREATE TABLE `document_signatures` (
  `id` int NOT NULL,
  `document_id` int NOT NULL,
  `user_id` int NOT NULL,
  `signature_file` varchar(255) NOT NULL,
  `signed_at` datetime NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `document_signatures`
--

INSERT INTO `document_signatures` (`id`, `document_id`, `user_id`, `signature_file`, `signed_at`, `ip_address`, `created_at`) VALUES
(1, 1, 7, 'sign_1_7_1768565989.png', '2026-01-16 20:19:49', '127.0.0.1', '2026-01-16 12:19:49'),
(2, 1, 7, 'sign_1_7_1768571230.png', '2026-01-16 21:47:10', '127.0.0.1', '2026-01-16 13:47:10'),
(3, 1, 7, 'sign_1_7_1768571416.png', '2026-01-16 21:50:16', '127.0.0.1', '2026-01-16 13:50:16'),
(4, 1, 7, 'sign_1_7_1768571542.png', '2026-01-16 21:52:22', '127.0.0.1', '2026-01-16 13:52:22'),
(5, 1, 7, 'sign_1_7_1768572393.png', '2026-01-16 22:06:33', '127.0.0.1', '2026-01-16 14:06:33'),
(6, 1, 7, 'sign_1_7_1768572976.png', '2026-01-16 22:16:16', '127.0.0.1', '2026-01-16 14:16:16'),
(7, 1, 7, 'sign_1_7_1768574622.png', '2026-01-16 22:43:42', '127.0.0.1', '2026-01-16 14:43:42'),
(8, 1, 7, 'sign_1_7_1768575509.png', '2026-01-16 22:58:29', '127.0.0.1', '2026-01-16 14:58:29'),
(9, 1, 7, 'sign_1_7_1768575850.png', '2026-01-16 23:04:10', '127.0.0.1', '2026-01-16 15:04:10'),
(10, 1, 7, 'sign_1_7_1768576433.png', '2026-01-16 23:13:53', '127.0.0.1', '2026-01-16 15:13:53'),
(11, 1, 7, 'sign_1_7_1768577578.png', '2026-01-16 23:32:58', '127.0.0.1', '2026-01-16 15:32:58'),
(12, 1, 7, 'sign_1_7_1768578282.png', '2026-01-16 23:44:42', '127.0.0.1', '2026-01-16 15:44:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document_signatures`
--
ALTER TABLE `document_signatures`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document_signatures`
--
ALTER TABLE `document_signatures`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
