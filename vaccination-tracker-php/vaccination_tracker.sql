-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2025 at 11:31 PM
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
-- Database: `vaccination_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `doses`
--

CREATE TABLE `doses` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `dose_number` int(11) NOT NULL,
  `scheduled_date` date DEFAULT NULL,
  `completed_date` date DEFAULT NULL,
  `status` enum('scheduled','pending','completed','missed') DEFAULT 'scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doses`
--

INSERT INTO `doses` (`id`, `patient_id`, `vaccine_id`, `hospital_id`, `dose_number`, `scheduled_date`, `completed_date`, `status`, `created_at`) VALUES
(202, 9, 4, 4, 1, '2025-08-28', NULL, 'scheduled', '2025-08-26 19:30:29'),
(203, 9, 5, 4, 2, '2025-08-29', NULL, 'scheduled', '2025-08-26 19:30:29'),
(204, 9, 6, 4, 3, '2025-08-30', NULL, 'scheduled', '2025-08-26 19:30:29'),
(235, 8, 4, 1, 1, '2025-08-28', NULL, 'scheduled', '2025-08-26 19:47:44'),
(236, 8, 5, 1, 2, '2025-08-29', NULL, 'scheduled', '2025-08-26 19:47:44'),
(237, 8, 6, 1, 3, '2025-08-30', NULL, 'scheduled', '2025-08-26 19:47:44'),
(238, 8, 9, 1, 4, '2025-08-31', NULL, 'scheduled', '2025-08-26 19:47:44'),
(239, 8, 10, 1, 5, '2025-09-01', NULL, 'scheduled', '2025-08-26 19:47:44'),
(240, 8, 11, 1, 6, '2025-09-02', NULL, 'scheduled', '2025-08-26 19:47:44'),
(247, 7, 4, 2, 1, '2025-08-28', NULL, 'scheduled', '2025-08-26 19:48:13'),
(248, 7, 5, 2, 2, '2025-08-29', NULL, 'scheduled', '2025-08-26 19:48:13'),
(249, 7, 6, 2, 3, '2025-08-30', NULL, 'scheduled', '2025-08-26 19:48:13'),
(250, 7, 9, 2, 4, '2025-08-31', NULL, 'scheduled', '2025-08-26 19:48:13'),
(251, 7, 10, 2, 5, '2025-09-01', NULL, 'scheduled', '2025-08-26 19:48:13'),
(252, 7, 11, 2, 6, '2025-09-02', NULL, 'scheduled', '2025-08-26 19:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `location` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `location`) VALUES
(1, 'City Hospital', 'Dhaka'),
(2, 'Green Clinic', 'Dhaka'),
(4, 'Labid Hospital', 'Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('patient','healthcare','admin') NOT NULL DEFAULT 'patient',
  `hospital_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `hospital_id`, `created_at`) VALUES
(1, 'Admin User', 'admin@example.com', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'admin', 1, '2025-08-26 14:59:56'),
(2, 'Nurse User', 'nurse@example.com', '35608f3146571aa100227a3e68290979ba8a452179a080f888625106076e7de2', 'healthcare', 2, '2025-08-26 14:59:56'),
(3, 'green', 'green@gmail.com', '$2y$10$svH4GK.skkaQaYKo65Weh.i0bX/i5qNgf3q.bQpTJl586iyEc443q', 'healthcare', 1, '2025-08-26 15:06:43'),
(5, 'Arfan', 'arfanalames62@gmail.com', '$2y$10$3gmrvTrR2NBk.SZWrdYrhOtNPrU1Lwd.hMBKipT4pgYtI6XU/1mkq', 'admin', 2, '2025-08-26 15:08:11'),
(7, 'Rahat', 'rahat56@gmail.com', '$2y$10$pFrrT5./7TCPc/dU3GXlJu9YhcurqaE/co4w5nyVDWM0MgQ1UQ9Di', 'patient', 2, '2025-08-26 15:57:06'),
(8, 'Sazzad', 'sazzad@gmail.com', '$2y$10$UO9zx90AP3wmcJbuTEDpeeDW2rJ25lBAfTzdbXdq2OOXGFfcS9OCy', 'patient', 1, '2025-08-26 15:58:18'),
(9, 'Asif', 'asif@gmail.com', '$2y$10$pHMJc9VIXgisDSUw2WG.FOMCengtYjZeMXZVCSD7o0vogdxQ5YahS', 'patient', 4, '2025-08-26 19:21:39'),
(10, 'Esha', 'esha62@gmail.com', '$2y$10$ezNjr9kgFQXJupg.SFyToe3QEcrWQe/F5h3hB9oNsXgx6Wzd9N4q6', 'admin', 1, '2025-08-26 19:31:43'),
(11, 'Shohag', 'shohag14@gmail.com', '$2y$10$HkmORA.PI27.eJt4tUImwO2W.xGIPFINhSzFCL9OLxUnRaRhpFqZC', 'admin', 4, '2025-08-26 19:33:44'),
(12, 'Araf', 'araf@gmail.com', '$2y$10$6aWlh2N/gptKSX8PYGuTGu5K637Q6lAWZ5.TzFGXsNdLt0FlaSQf2', 'healthcare', 2, '2025-08-26 19:36:34'),
(13, 'Sukanto', 'sukanto@gmail.com', '$2y$10$zTYQTIkPzWypDLqQ1FVovOLufLcuL5uQn5JHxjdX/mwpsqQvQvNj.', 'healthcare', 4, '2025-08-26 19:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `vaccinations_log`
--

CREATE TABLE `vaccinations_log` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `dose_number` int(11) NOT NULL,
  `date_given` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccinations_log`
--

INSERT INTO `vaccinations_log` (`id`, `patient_id`, `vaccine_id`, `hospital_id`, `dose_number`, `date_given`, `created_at`) VALUES
(1, 7, 4, 2, 1, '2025-08-27', '2025-08-26 18:01:15'),
(2, 7, 5, 2, 2, '2025-08-27', '2025-08-26 18:01:19'),
(3, 7, 6, 2, 3, '2025-08-27', '2025-08-26 18:01:20'),
(4, 7, 4, 2, 1, '2025-08-27', '2025-08-26 18:08:07'),
(5, 7, 4, 2, 1, '2025-08-27', '2025-08-26 18:08:12'),
(6, 7, 5, 2, 2, '2025-08-27', '2025-08-26 18:10:16'),
(7, 7, 4, 2, 1, '2025-08-27', '2025-08-26 18:10:21'),
(8, 7, 5, 2, 2, '2025-08-27', '2025-08-26 18:10:29'),
(9, 7, 6, 4, 3, '2025-08-27', '2025-08-26 18:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`id`, `name`, `stock`, `created_at`) VALUES
(4, 'Pfizer', 100, '2025-08-26 16:23:40'),
(5, 'Moderna', 100, '2025-08-26 16:26:44'),
(6, 'AstraZeneca', 30, '2025-08-26 16:26:57'),
(9, 'Hepatitis B', 50, '2025-08-26 19:41:58'),
(10, 'Polio', 100, '2025-08-26 19:42:25'),
(11, 'Influenza', 30, '2025-08-26 19:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_stock`
--

CREATE TABLE `vaccine_stock` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccine_stock`
--

INSERT INTO `vaccine_stock` (`id`, `hospital_id`, `vaccine_id`, `stock`, `created_at`) VALUES
(1, 1, 4, 100, '2025-08-26 16:23:40'),
(2, 2, 4, 100, '2025-08-26 16:23:40'),
(3, 4, 4, 100, '2025-08-26 16:23:40'),
(4, 1, 5, 99, '2025-08-26 16:26:44'),
(5, 2, 5, 100, '2025-08-26 16:26:44'),
(6, 4, 5, 100, '2025-08-26 16:26:44'),
(7, 1, 6, 30, '2025-08-26 16:26:57'),
(8, 2, 6, 30, '2025-08-26 16:26:57'),
(9, 4, 6, 30, '2025-08-26 16:26:57'),
(19, 1, 9, 50, '2025-08-26 19:41:58'),
(20, 2, 9, 50, '2025-08-26 19:41:58'),
(21, 4, 9, 50, '2025-08-26 19:41:58'),
(22, 1, 10, 100, '2025-08-26 19:42:25'),
(23, 2, 10, 100, '2025-08-26 19:42:25'),
(24, 4, 10, 100, '2025-08-26 19:42:25'),
(25, 1, 11, 30, '2025-08-26 19:42:40'),
(26, 2, 11, 29, '2025-08-26 19:42:40'),
(27, 4, 11, 30, '2025-08-26 19:42:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doses`
--
ALTER TABLE `doses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `vaccine_id` (`vaccine_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vaccinations_log`
--
ALTER TABLE `vaccinations_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `vaccine_id` (`vaccine_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccine_stock`
--
ALTER TABLE `vaccine_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_id` (`hospital_id`),
  ADD KEY `vaccine_id` (`vaccine_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doses`
--
ALTER TABLE `doses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vaccinations_log`
--
ALTER TABLE `vaccinations_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vaccine_stock`
--
ALTER TABLE `vaccine_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doses`
--
ALTER TABLE `doses`
  ADD CONSTRAINT `doses_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `doses_ibfk_2` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`id`),
  ADD CONSTRAINT `doses_ibfk_3` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`);

--
-- Constraints for table `vaccinations_log`
--
ALTER TABLE `vaccinations_log`
  ADD CONSTRAINT `vaccinations_log_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vaccinations_log_ibfk_2` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`id`),
  ADD CONSTRAINT `vaccinations_log_ibfk_3` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`);

--
-- Constraints for table `vaccine_stock`
--
ALTER TABLE `vaccine_stock`
  ADD CONSTRAINT `vaccine_stock_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vaccine_stock_ibfk_2` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
