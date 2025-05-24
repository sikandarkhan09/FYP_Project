-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2025 at 10:16 AM
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
-- Database: `user_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('student','faculty','head') NOT NULL,
  `registration_id` varchar(100) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `Semester` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `user_type`, `registration_id`, `department`, `Semester`, `created_at`) VALUES
(8, 'ali', '', 'sp22-bse-045@cuiatk.edu.pk', '$2y$10$hlnyUO32US8XW3s3DpVkAOsRMhOJu49edtBwOJTs8iwG.HAO3gCUq', 'student', 'SP25-BSE-048', 'EE', NULL, '2025-04-27 13:32:03'),
(12, 'Sikandar Khan', '', 'SP22-BSE-041@cuiatk.edu.pk', '$2y$10$mg7EKkymjEfoUkxKuUFojegWJAPVb.qNe13./NiHQ54YpqG31NjAO', 'student', 'SP22-BSE-041', 'CS', NULL, '2025-05-01 06:35:07'),
(13, 'Sufyan', '', 'FA22-BSE-045@cuiatk.edu.pk', '$2y$10$FX9ycWhpPec6EVDKJ70kP.fzwfrwvvmhe9C0YmKIzz3dXRHpWSHBi', 'student', 'FA22-BSE-045', 'CS', NULL, '2025-05-01 06:38:25'),
(14, 'farhan', '', 'farhan.aadil@cuiatk.edu.pk', '$2y$10$ndwlF.gMXvZXrNzQiJypvuPxZJbvdhBpMKEb6oj6RPELtJ98kgynO', 'faculty', 'CS-005', 'cs', NULL, '2025-05-01 06:40:07'),
(15, 'unknown', '', 'SP25-BCS-001@cuiatk.edu.pk', '$2y$10$LeXzk9X7pgVRqXOSifvPf.MNaOyHlANFqxbB4tTSkov8brAIC818u', 'faculty', 'CS-020', 'cs', NULL, '2025-05-01 07:38:07'),
(17, 'muhammad sufyan', '', 'SP25-BSs-001@cuiatk.edu.pk', '$2y$10$Vuc0fwEitAp.nzYZbO55GuqJ/7HzwBGSv0N.YQ.Mq/ztdjLuWhEhC', 'student', 'SP25-BSs-001', 'EE', 'BSs-2', '2025-05-01 07:43:47'),
(18, 'mOLI', '', 'SP22-BSE-044@cuiatk.edu.pk', '$2y$10$YruoXEY7eSL1Fs5uxewq5O2pV9HjQs8exZgr71ml96Mo8kMuGv.8W', 'student', 'SP22-BSE-044', 'CS', 'BSE-7', '2025-05-01 07:45:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `registration_id` (`registration_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
