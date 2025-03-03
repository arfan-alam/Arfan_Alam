-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 05:01 PM
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
-- Database: `train`
--

-- --------------------------------------------------------

--
-- Table structure for table `admindatabase`
--

CREATE TABLE `admindatabase` (
  `UserID` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `DoB` date NOT NULL,
  `Joined_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admindatabase`
--

INSERT INTO `admindatabase` (`UserID`, `Name`, `Email`, `Gender`, `password`, `DoB`, `Joined_on`) VALUES
(1, 'Admin', 'admin@gmail.com', 'M', '1234567', '2000-10-17', '2021-08-14 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `bustransactions`
--

CREATE TABLE `bustransactions` (
  `T_No.` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `source` varchar(50) NOT NULL,
  `dest` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Bus_No` int(11) NOT NULL,
  `NoOfpass` int(11) NOT NULL,
  `card_no` int(25) NOT NULL,
  `expmonth` int(2) NOT NULL,
  `expyear` int(2) NOT NULL,
  `cvv` int(3) NOT NULL,
  `pin` int(4) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Amt` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `source` varchar(50) NOT NULL,
  `dest` varchar(50) NOT NULL,
  `class` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL,
  `Price` int(50) NOT NULL,
  `Route` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`source`, `dest`, `class`, `type`, `Price`, `Route`) VALUES
('Dhaka', 'Chattogram', 'ShovonChair', 'Single', 650, 'Cumilla'),
('Dhaka', 'CoxsBazar', 'ShovonChair', 'Single', 695, 'Chattogram'),
('Dhaka', 'Rangpur', 'ShovonChair', 'Single', 635, 'Rajshahi'),
('Dhaka', 'Sylhet', 'ShovonChair', 'Single', 375, 'Kishoreganj'),
('Dhaka', 'Khulna', 'ShovonChair', 'Single', 625, 'Faridpur'),
('Dhaka', 'Rajshahi', 'ShovonChair', 'Single', 405, 'Mymensingh'),
('Dhaka', 'Mymensingh', 'ShovonChair', 'Single', 145, '-'),
('Dhaka', 'Cumilla', 'ShovonChair', 'Single', 225, 'Narsingdi'),
('Dhaka', 'Noakhali', 'ShovonChair', 'Single', 315, 'Cumilla'),
('Dhaka', 'Chattogram', 'ShovonChair', 'Single', 405, 'Cumilla'),
('Dhaka', 'Faridpur', 'ShovonChair', 'Single', 305, '-'),
('Dhaka', 'Kishoreganj', 'ShovonChair', 'Single', 160, 'Narsingdi'),
('Dhaka', 'Narsingdi', 'ShovonChair', 'Single', 70, '-'),
('Dhaka', 'Jashore', 'ShovonChair', 'Single', 560, 'Faridpur'),
('Dhaka', 'CoxsBazar', 'AC', 'Single', 2328, 'Chattogram'),
('Dhaka', 'Rangpur', 'AC', 'Single', 1455, 'Rajshahi'),
('Dhaka', 'Sylhet', 'AC', 'Single', 863, 'Kishoreganj'),
('Dhaka', 'Khulna', 'AC', 'Single', 2168, 'Faridpur'),
('Dhaka', 'Rajshahi', 'AC', 'Single', 926, 'Mymensingh'),
('Dhaka', 'Mymensingh', 'AC', 'Single', 334, '-'),
('Dhaka', 'Cumilla', 'AC', 'Single', 518, 'Narsingdi'),
('Dhaka', 'Noakhali', 'AC', 'Single', 598, 'Cumilla'),
('Dhaka', 'Chattogram', 'AC', 'Single', 1025, 'Cumilla'),
('Dhaka', 'Faridpur', 'AC', 'Single', 696, '-'),
('Dhaka', 'Kishoreganj', 'AC', 'Single', 368, 'Narsingdi'),
('Dhaka', 'Narsingdi', 'AC', 'Single', 156, '-'),
('Dhaka', 'Jashore', 'AC', 'Single', 1938, 'Faridpur'),
('CoxsBazar', 'Dhaka', 'ShovonChair', 'Single', 695, 'Chattogram'),
('CoxsBazar', 'Chattogram', 'ShovonChair', 'Single', 250, '-'),
('CoxsBazar', 'Dhaka', 'AC', 'Single', 2328, 'Chattogram'),
('CoxsBazar', 'Chattogram', 'AC', 'Single', 565, '-'),
('Rangpur', 'Rajshahi', 'ShovonChair', 'Single', 135, '-'),
('Rangpur', 'Dhaka', 'AC', 'Single', 1455, '-'),
('Rangpur', 'Rajshahi', 'AC', 'Single', 547, '-'),
('Sylhet', 'Dhaka', 'ShovonChair', 'Single', 375, '-'),
('Sylhet', 'Chattogram', 'ShovonChair', 'Single', 450, 'Cumilla'),
('Sylhet', 'Dhaka', 'AC', 'Single', 863, '-'),
('Sylhet', 'Chattogram', 'AC', 'Single', 1541, 'Cumilla'),
('Khulna', 'Dhaka', 'ShovonChair', 'Single', 630, '-'),
('Khulna', 'Dhaka', 'AC', 'Single', 1449, '-'),
('Rajshahi', 'Dhaka', 'ShovonChair', 'Single', 585, '-'),
('Rajshahi', 'Dhaka', 'AC', 'Single', 1024, '-'),
('Mymensingh', 'Dhaka', 'ShovonChair', 'Single', 145, '-'),
('Mymensingh', 'Chattogram', 'ShovonChair', 'Single', 460, 'Cumilla'),
('Mymensingh', 'Dhaka', 'AC', 'Single', 334, '-'),
('Mymensingh', 'Chattogram', 'AC', 'Single', 1587, 'Cumilla'),
('Cumilla', 'Dhaka', 'ShovonChair', 'Single', 225, '-'),
('Cumilla', 'Noakhali', 'ShovonChair', 'Single', 90, '-'),
('Cumilla', 'Chattogram', 'ShovonChair', 'Single', 185, '-'),
('Cumilla', 'Dhaka', 'AC', 'Single', 518, '-'),
('Cumilla', 'Noakhali', 'AC', 'Single', 167, '-'),
('Cumilla', 'Chattogram', 'AC', 'Single', 426, '-'),
('Noakhali', 'Dhaka', 'ShovonChair', 'Single', 315, 'Cumilla'),
('Noakhali', 'Cumilla', 'ShovonChair', 'Single', 90, '-'),
('Noakhali', 'Dhaka', 'AC', 'Single', 598, 'Cumilla '),
('Noakhali', 'Cumilla', 'AC', 'Single', 167, '-'),
('Chattogram', 'Dhaka', 'ShovonChair', 'Single', 405, '- Cumilla -'),
('Chattogram', 'CoxsBazar', 'ShovonChair', 'Single', 250, '- Cumilla -'),
('Chattogram', 'Sylhet', 'ShovonChair', 'Single', 450, '- Cumilla -'),
('Chattogram', 'Mymensingh', 'ShovonChair', 'Single', 460, '- Cumilla -'),
('Chattogram', 'Cumilla', 'ShovonChair', 'Single', 185, '-'),
('Chattogram', 'Dhaka', 'AC', 'Single', 1025, '- Cumilla -'),
('Chattogram', 'CoxsBazar', 'AC', 'Single', 565, '- Cumilla -'),
('Chattogram', 'Sylhet', 'AC', 'Single', 1541, '- Cumilla -'),
('Chattogram', 'Mymensingh', 'AC', 'Single', 1058, '- Cumilla -'),
('Chattogram', 'Cumilla', 'AC', 'Single', 426, '-'),
('Faridpur', 'Dhaka', 'ShovonChair', 'Single', 305, '- Cumilla -'),
('Faridpur', 'Dhaka', 'AC', 'Single', 581, '- Cumilla -'),
('Kishoreganj', 'Dhaka', 'ShovonChair', 'Single', 135, '- Cumilla -'),
('Kishoreganj', 'Chattogram', 'ShovonChair', 'Single', 365, '-'),
('Kishoreganj', 'Dhaka', 'AC', 'Single', 368, '- Cumilla -'),
('Kishoreganj', 'Chattogram', 'AC', 'Single', 1248, '-'),
('Narsingdi', 'Dhaka', 'ShovonChair', 'Single', 70, '- Cumilla -'),
('Narsingdi', 'Dhaka', 'AC', 'Single', 156, '- Cumilla -'),
('Jashore', 'Dhaka', 'ShovonChair', 'Single', 565, '- Cumilla -'),
('Jashore', 'Dhaka', 'AC', 'Single', 1968, '- Cumilla -');

-- --------------------------------------------------------

--
-- Table structure for table `pricebus`
--

CREATE TABLE `pricebus` (
  `No.` int(15) NOT NULL,
  `Bus_No.` int(50) NOT NULL,
  `source` varchar(50) NOT NULL,
  `dest` varchar(50) NOT NULL,
  `Price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pricebus`
--

INSERT INTO `pricebus` (`No.`, `Bus_No.`, `source`, `dest`, `Price`) VALUES
(1, 101, 'Dhaka', 'Chattogram', 680),
(1, 502, 'Dhaka', 'Chattogram', 680),
(2, 501, 'Dhaka', 'Sylhet', 700),
(3, 502, 'Dhaka', 'CoxsBazar', 1000),
(4, 503, 'Dhaka', 'Khulna', 650),
(5, 504, 'Dhaka', 'Rajshahi', 690),
(6, 505, 'Dhaka', 'Rangpur', 800),
(7, 506, 'Dhaka', 'Barishal', 500),
(8, 502, 'Dhaka', 'Dinajpur', 900),
(9, 502, 'Dhaka', 'Kuakata', 800),
(10, 502, 'Dhaka', 'Bogura', 550),
(11, 502, 'Dhaka', 'Noakhali', 500),
(12, 502, 'Dhaka', 'COMILLA', 250),
(13, 502, 'Dhaka', 'Mymensingh', 300),
(14, 502, 'Dhaka', 'Faridpur', 400),
(15, 502, 'Dhaka', 'Brahmanbaria', 300),
(16, 502, 'Dhaka', 'Satkhira', 650),
(17, 502, 'Dhaka', 'Bagerhat', 650),
(18, 502, 'Dhaka', 'Tangail', 550),
(19, 502, 'Dhaka', 'Feni', 500),
(20, 502, 'Feni', 'Chattogram', 300),
(21, 502, 'Feni', 'Sylhet', 800),
(22, 502, 'Feni', 'CoxsBazar', 850),
(23, 502, 'Feni', 'Khulna', 1200),
(24, 502, 'Feni', 'Rajshahi', 1200),
(25, 502, 'Feni', 'Rangpur', 1000),
(26, 502, 'Feni', 'Barishal', 850),
(27, 502, 'Feni', 'Dinajpur', 1200),
(28, 502, 'Feni', 'Kuakata', 1000),
(29, 502, 'Feni', 'Bogura', 1250),
(30, 502, 'Feni', 'Noakhali', 300),
(31, 502, 'Feni', 'COMILLA', 100),
(32, 502, 'Feni', 'Mymensingh', 500),
(33, 502, 'Feni', 'Faridpur', 850),
(34, 502, 'Feni', 'Brahmanbaria', 250),
(35, 502, 'Feni', 'Satkhira', 750),
(36, 502, 'Feni', 'Bagerhat', 900),
(37, 502, 'Feni', 'Tangail', 1000),
(38, 502, 'Feni', 'Dhaka', 500),
(39, 502, 'Tangail', 'Chattogram', 1000),
(40, 502, 'Tangail', 'Sylhet', 1000),
(41, 502, 'Tangail', 'CoxsBazar', 1000),
(42, 502, 'Tangail', 'Khulna', 1000),
(43, 502, 'Tangail', 'Rajshahi', 1000),
(44, 502, 'Tangail', 'Rangpur', 1000),
(45, 502, 'Tangail', 'Barishal', 1000),
(46, 502, 'Tangail', 'Dinajpur', 1000),
(47, 502, 'Tangail', 'Kuakata', 1000),
(48, 502, 'Tangail', 'Bogura', 1000),
(49, 502, 'Tangail', 'Noakhali', 1000),
(50, 502, 'Tangail', 'COMILLA', 1000),
(51, 502, 'Tangail', 'Mymensingh', 1000),
(52, 502, 'Tangail', 'Faridpur', 1000),
(53, 502, 'Tangail', 'Brahmanbaria', 500),
(54, 502, 'Tangail', 'Satkhira', 500),
(55, 502, 'Tangail', 'Bagerhat', 500),
(56, 502, 'Tangail', 'Feni', 500),
(57, 502, 'Tangail', 'Dhaka', 500),
(58, 502, 'Bagerhat', 'Chattogram', 1000),
(59, 502, 'Bagerhat', 'Sylhet', 1000),
(60, 502, 'Bagerhat', 'CoxsBazar', 1000),
(61, 502, 'Bagerhat', 'Khulna', 1000),
(62, 502, 'Bagerhat', 'Rajshahi', 1000),
(63, 502, 'Bagerhat', 'Rangpur', 1000),
(64, 502, 'Bagerhat', 'Barishal', 1000),
(65, 502, 'Bagerhat', 'Dinajpur', 1000),
(66, 502, 'Bagerhat', 'Kuakata', 1000),
(67, 502, 'Bagerhat', 'Bogura', 1000),
(68, 502, 'Bagerhat', 'Noakhali', 1000),
(69, 502, 'Bagerhat', 'COMILLA', 1000),
(70, 502, 'Bagerhat', 'Mymensingh', 1000),
(71, 502, 'Bagerhat', 'Faridpur', 1000),
(72, 502, 'Bagerhat', 'Brahmanbaria', 500),
(73, 502, 'Bagerhat', 'Satkhira', 500),
(74, 502, 'Bagerhat', 'Tangail', 500),
(75, 502, 'Bagerhat', 'Feni', 500),
(76, 502, 'Bagerhat', 'Dhaka', 500),
(77, 502, 'Satkhira', 'Chattogram', 1000),
(78, 502, 'Satkhira', 'Sylhet', 1000),
(79, 502, 'Satkhira', 'CoxsBazar', 1000),
(80, 502, 'Satkhira', 'Khulna', 1000),
(81, 502, 'Satkhira', 'Rajshahi', 1000),
(82, 502, 'Satkhira', 'Rangpur', 1000),
(83, 502, 'Satkhira', 'Barishal', 1000),
(84, 502, 'Satkhira', 'Dinajpur', 1000),
(85, 502, 'Satkhira', 'Kuakata', 1000),
(86, 502, 'Satkhira', 'Bogura', 1000),
(87, 502, 'Satkhira', 'Noakhali', 1000),
(88, 502, 'Satkhira', 'COMILLA', 1000),
(89, 502, 'Satkhira', 'Mymensingh', 1000),
(90, 502, 'Satkhira', 'Faridpur', 1000),
(91, 502, 'Satkhira', 'Brahmanbaria', 500),
(92, 502, 'Satkhira', 'Bagerhat', 500),
(93, 502, 'Satkhira', 'Tangail', 500),
(94, 502, 'Satkhira', 'Feni', 500),
(95, 502, 'Satkhira', 'Dhaka', 500),
(96, 502, 'Brahmanbaria', 'Chattogram', 1000),
(97, 502, 'Brahmanbaria', 'Sylhet', 1000),
(98, 502, 'Mymensingh', 'Brahmanbaria', 500),
(99, 502, 'Mymensingh', 'Faridpur', 500),
(100, 502, 'Mymensingh', 'Satkhira', 1000),
(101, 502, 'Mymensingh', 'Bagerhat', 1000),
(102, 502, 'Mymensingh', 'Tangail', 1000),
(103, 502, 'Mymensingh', 'Feni', 1000),
(104, 502, 'Mymensingh', 'Dhaka', 1000),
(105, 502, 'COMILLA', 'Chattogram', 500),
(106, 502, 'COMILLA', 'Sylhet', 500),
(107, 502, 'COMILLA', 'CoxsBazar', 500),
(108, 502, 'COMILLA', 'Khulna', 500),
(109, 502, 'COMILLA', 'Rajshahi', 500),
(110, 502, 'COMILLA', 'Rangpur', 500),
(111, 502, 'COMILLA', 'Barishal', 500),
(112, 502, 'COMILLA', 'Dinajpur', 500),
(113, 502, 'COMILLA', 'Kuakata', 500),
(114, 502, 'COMILLA', 'Bogura', 500),
(115, 502, 'COMILLA', 'Noakhali', 500),
(116, 502, 'COMILLA', 'Mymensingh', 500),
(117, 502, 'COMILLA', 'Brahmanbaria', 300),
(118, 502, 'COMILLA', 'Faridpur', 500),
(119, 502, 'COMILLA', 'Satkhira', 1000),
(120, 502, 'COMILLA', 'Bagerhat', 1000),
(121, 502, 'COMILLA', 'Tangail', 1000),
(122, 502, 'COMILLA', 'Feni', 1000),
(123, 502, 'COMILLA', 'Dhaka', 1000),
(124, 502, 'Noakhali', 'Chattogram', 500),
(125, 502, 'Noakhali', 'Sylhet', 500),
(126, 502, 'Noakhali', 'CoxsBazar', 500),
(127, 502, 'Noakhali', 'Khulna', 500),
(128, 502, 'Noakhali', 'Rajshahi', 500),
(129, 502, 'Noakhali', 'Rangpur', 500),
(130, 502, 'Noakhali', 'Barishal', 500),
(131, 502, 'Noakhali', 'Dinajpur', 500),
(132, 502, 'Noakhali', 'Kuakata', 500),
(133, 502, 'Noakhali', 'Bogura', 500),
(134, 502, 'Noakhali', 'COMILLA', 500),
(135, 502, 'Noakhali', 'Mymensingh', 500),
(136, 502, 'Noakhali', 'Brahmanbaria', 500),
(137, 502, 'Noakhali', 'Faridpur', 500),
(138, 502, 'Noakhali', 'Satkhira', 1000),
(139, 502, 'Noakhali', 'Bagerhat', 1000),
(140, 502, 'Noakhali', 'Tangail', 1000),
(141, 502, 'Noakhali', 'Feni', 1000),
(142, 502, 'Noakhali', 'Dhaka', 1000),
(143, 502, 'Bogura', 'Chattogram', 500),
(144, 502, 'Bogura', 'Sylhet', 500),
(145, 502, 'Bogura', 'CoxsBazar', 500),
(146, 502, 'Bogura', 'Khulna', 500),
(147, 502, 'Bogura', 'Rajshahi', 500),
(148, 502, 'Bogura', 'Rangpur', 500),
(149, 502, 'Bogura', 'Barishal', 500),
(150, 502, 'Bogura', 'Dinajpur', 500),
(151, 502, 'Bogura', 'Kuakata', 500),
(152, 502, 'Bogura', 'Noakhali', 500),
(153, 502, 'Bogura', 'COMILLA', 500),
(154, 502, 'Bogura', 'Mymensingh', 500),
(155, 502, 'Bogura', 'Brahmanbaria', 500),
(156, 502, 'Bogura', 'Faridpur', 500),
(157, 502, 'Bogura', 'Satkhira', 1000),
(158, 502, 'Bogura', 'Bagerhat', 1000),
(159, 502, 'Bogura', 'Tangail', 1000),
(160, 502, 'Bogura', 'Feni', 1000),
(161, 502, 'Bogura', 'Dhaka', 1000),
(162, 502, 'Kuakata', 'Sylhet', 500),
(163, 502, 'Kuakata', 'CoxsBazar', 500),
(164, 502, 'Kuakata', 'Khulna', 500),
(165, 502, 'Kuakata', 'Rajshahi', 500),
(166, 502, 'Kuakata', 'Rangpur', 500),
(167, 502, 'Kuakata', 'Barishal', 500),
(168, 502, 'Kuakata', 'Dinajpur', 500),
(169, 502, 'Kuakata', 'Bogura', 500),
(170, 502, 'Kuakata', 'Noakhali', 500),
(171, 502, 'Kuakata', 'Mymensingh', 500),
(172, 502, 'Kuakata', 'Brahmanbaria', 500),
(173, 502, 'Kuakata', 'Faridpur', 500),
(174, 502, 'Kuakata', 'Satkhira', 1000),
(175, 502, 'Kuakata', 'Bagerhat', 1000),
(176, 502, 'Kuakata', 'Tangail', 1000),
(177, 502, 'Kuakata', 'Feni', 1000),
(179, 502, 'Kuakata', 'Dhaka', 1000),
(180, 502, 'Dinajpur', 'Chattogram', 500),
(181, 502, 'Dinajpur', 'Sylhet', 500),
(182, 502, 'Dinajpur', 'CoxsBazar', 500),
(183, 502, 'Dinajpur', 'Khulna', 500),
(184, 502, 'Dinajpur', 'Rajshahi', 500),
(185, 502, 'Dinajpur', 'Rangpur', 500),
(186, 502, 'Dinajpur', 'Barishal', 500),
(187, 502, 'Dinajpur', 'Kuakata', 500),
(188, 502, 'Dinajpur', 'Bogura', 500),
(189, 502, 'Dinajpur', 'Noakhali', 500),
(190, 502, 'Dinajpur', 'COMILLA', 500),
(191, 502, 'Dinajpur', 'Mymensingh', 500),
(192, 502, 'Dinajpur', 'Brahmanbaria', 500),
(193, 502, 'Dinajpur', 'Faridpur', 500),
(194, 502, 'Dinajpur', 'Satkhira', 1000),
(195, 502, 'Dinajpur', 'Bagerhat', 1000),
(196, 502, 'Dinajpur', 'Tangail', 1000),
(197, 502, 'Dinajpur', 'Feni', 1000),
(198, 502, 'Dinajpur', 'Dhaka', 1000),
(199, 502, 'Barishal', 'Chattogram', 500),
(200, 502, 'Barishal', 'Sylhet', 500),
(201, 502, 'Barishal', 'CoxsBazar', 500),
(202, 502, 'Barishal', 'Khulna', 500),
(203, 502, 'Barishal', 'Rajshahi', 500),
(204, 502, 'Barishal', 'Rangpur', 500),
(205, 502, 'Barishal', 'Dinajpur', 500),
(206, 502, 'Barishal', 'Kuakata', 500),
(207, 502, 'Barishal', 'Bogura', 500),
(208, 502, 'Barishal', 'Noakhali', 500),
(209, 502, 'Barishal', 'COMILLA', 500),
(210, 502, 'Barishal', 'Mymensingh', 500),
(211, 502, 'Barishal', 'Brahmanbaria', 500),
(212, 502, 'Barishal', 'Faridpur', 500),
(213, 502, 'Barishal', 'Satkhira', 1000),
(214, 502, 'Barishal', 'Bagerhat', 1000),
(215, 502, 'Barishal', 'Tangail', 1000),
(216, 502, 'Barishal', 'Feni', 1000),
(217, 502, 'Barishal', 'Dhaka', 1000),
(218, 502, 'Chadpur', 'Chattogram', 900),
(219, 502, 'Chadpur', 'Sylhet', 1200),
(220, 502, 'Chadpur', 'CoxsBazar', 1500),
(221, 502, 'Chadpur', 'Khulna', 1200),
(222, 502, 'Chadpur', 'Rajshahi', 1300),
(223, 502, 'Chadpur', 'Barishal', 500),
(224, 502, 'Chadpur', 'Dinajpur', 500),
(225, 502, 'Chadpur', 'Kuakata', 500),
(226, 502, 'Chadpur', 'Bogura', 500),
(227, 502, 'Chadpur', 'Noakhali', 500),
(228, 502, 'Chadpur', 'COMILLA', 500),
(229, 502, 'Chadpur', 'Mymensingh', 500),
(230, 502, 'Chadpur', 'Brahmanbaria', 500),
(231, 502, 'Chadpur', 'Faridpur', 500),
(232, 502, 'Chadpur', 'Satkhira', 1000),
(233, 502, 'Chadpur', 'Bagerhat', 1000),
(234, 502, 'Chadpur', 'Tangail', 1000),
(235, 502, 'Chadpur', 'Feni', 1000),
(236, 502, 'Chadpur', 'Dhaka', 1000),
(237, 502, 'Rajshahi', 'Chattogram', 500),
(238, 502, 'Rajshahi', 'Sylhet', 500),
(239, 502, 'Rajshahi', 'CoxsBazar', 500),
(240, 502, 'Rajshahi', 'Khulna', 500),
(241, 502, 'Rajshahi', 'Chadpur', 500),
(242, 502, 'Rajshahi', 'Barishal', 500),
(243, 502, 'Rajshahi', 'Dinajpur', 500),
(244, 502, 'Rajshahi', 'Kuakata', 500),
(245, 502, 'Rajshahi', 'Bogura', 500),
(246, 502, 'Rajshahi', 'Noakhali', 500),
(247, 502, 'Rajshahi', 'COMILLA', 500),
(248, 502, 'Rajshahi', 'Mymensingh', 500),
(249, 502, 'Rajshahi', 'Brahmanbaria', 500),
(250, 502, 'Rajshahi', 'Faridpur', 500),
(251, 502, 'Rajshahi', 'Satkhira', 1000),
(252, 502, 'Rajshahi', 'Bagerhat', 1000),
(253, 502, 'Rajshahi', 'Tangail', 1000),
(254, 502, 'Rajshahi', 'Feni', 1000),
(255, 502, 'Rajshahi', 'Dhaka', 1000),
(256, 502, 'Khulna', 'Chattogram', 500),
(257, 502, 'Khulna', 'Sylhet', 500),
(258, 502, 'Khulna', 'CoxsBazar', 500),
(259, 502, 'Khulna', 'Rajshahi', 500),
(260, 502, 'Khulna', 'Chadpur', 500),
(261, 502, 'Khulna', 'Barishal', 500),
(262, 502, 'Khulna', 'Dinajpur', 500),
(263, 502, 'Khulna', 'Kuakata', 500),
(264, 502, 'Khulna', 'Bogura', 500),
(265, 502, 'Khulna', 'Noakhali', 500),
(266, 502, 'Khulna', 'COMILLA', 500),
(267, 502, 'Khulna', 'Mymensingh', 500),
(268, 502, 'Khulna', 'Brahmanbaria', 500),
(269, 502, 'Khulna', 'Faridpur', 500),
(270, 502, 'Khulna', 'Satkhira', 1000),
(271, 502, 'Khulna', 'Bagerhat', 1000),
(272, 502, 'Khulna', 'Tangail', 1000),
(273, 502, 'Khulna', 'Feni', 1000),
(274, 502, 'Khulna', 'Dhaka', 1000),
(275, 502, 'CoxsBazar', 'Chattogram', 500),
(276, 502, 'CoxsBazar', 'Sylhet', 500),
(277, 502, 'CoxsBazar', 'Khulna', 500),
(278, 502, 'CoxsBazar', 'Rajshahi', 500),
(279, 502, 'CoxsBazar', 'Chadpur', 500),
(280, 502, 'CoxsBazar', 'Barishal', 500),
(281, 502, 'CoxsBazar', 'Dinajpur', 500),
(282, 502, 'CoxsBazar', 'Kuakata', 500),
(283, 502, 'CoxsBazar', 'Bogura', 500),
(284, 502, 'CoxsBazar', 'Noakhali', 500),
(285, 502, 'CoxsBazar', 'COMILLA', 500),
(286, 502, 'CoxsBazar', 'Mymensingh', 500),
(287, 502, 'CoxsBazar', 'Brahmanbaria', 500),
(288, 502, 'CoxsBazar', 'Faridpur', 500),
(289, 502, 'CoxsBazar', 'Satkhira', 1000),
(290, 502, 'CoxsBazar', 'Bagerhat', 1000),
(291, 502, 'CoxsBazar', 'Tangail', 1000),
(292, 502, 'CoxsBazar', 'Feni', 1000),
(293, 502, 'CoxsBazar', 'Dhaka', 1000),
(294, 502, 'Sylhet', 'Chattogram', 500),
(295, 502, 'Sylhet', 'CoxsBazar', 500),
(296, 502, 'Sylhet', 'Khulna', 500),
(297, 502, 'Sylhet', 'Rajshahi', 500),
(298, 502, 'Sylhet', 'Chadpur', 500),
(299, 502, 'Sylhet', 'Barishal', 500),
(300, 502, 'Sylhet', 'Dinajpur', 500),
(301, 502, 'Sylhet', 'Kuakata', 500),
(302, 502, 'Sylhet', 'Bogura', 500),
(303, 502, 'Sylhet', 'Noakhali', 500),
(304, 502, 'Sylhet', 'COMILLA', 500),
(305, 502, 'Sylhet', 'Mymensingh', 500),
(306, 502, 'Sylhet', 'Brahmanbaria', 500),
(307, 502, 'Sylhet', 'Faridpur', 500),
(308, 502, 'Sylhet', 'Satkhira', 1000),
(309, 502, 'Sylhet', 'Bagerhat', 1000),
(310, 502, 'Sylhet', 'Tangail', 1000),
(311, 502, 'Sylhet', 'Feni', 1000),
(312, 502, 'Sylhet', 'Dhaka', 1000),
(313, 502, 'Chattogram', 'Sylhet', 500),
(314, 502, 'Chattogram', 'CoxsBazar', 500),
(315, 502, 'Chattogram', 'Khulna', 500),
(316, 502, 'Chattogram', 'Rajshahi', 500),
(317, 502, 'Chattogram', 'Chadpur', 500),
(318, 502, 'Chattogram', 'Barishal', 500),
(319, 502, 'Chattogram', 'Dinajpur', 500),
(320, 502, 'Chattogram', 'Kuakata', 500),
(321, 502, 'Chattogram', 'Bogura', 500),
(322, 502, 'Chattogram', 'Noakhali', 500),
(323, 502, 'Chattogram', 'COMILLA', 500),
(324, 502, 'Chattogram', 'Mymensingh', 500),
(325, 502, 'Chattogram', 'Brahmanbaria', 500),
(326, 502, 'Chattogram', 'Faridpur', 500),
(327, 502, 'Chattogram', 'Satkhira', 1000),
(328, 502, 'Chattogram', 'Bagerhat', 1000),
(329, 502, 'Chattogram', 'Tangail', 1000),
(330, 502, 'Chattogram', 'Feni', 1000),
(331, 502, 'Chattogram', 'Dhaka', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `traintt`
--

CREATE TABLE `traintt` (
  `Dhaka` varchar(5) DEFAULT NULL,
  `CoxsBazar` varchar(5) DEFAULT NULL,
  `Rangpur` varchar(5) DEFAULT NULL,
  `Sylhet` varchar(5) DEFAULT NULL,
  `Khulna` varchar(5) DEFAULT NULL,
  `Rajshahi` varchar(5) DEFAULT NULL,
  `Mymensingh` varchar(5) DEFAULT NULL,
  `Cumilla` varchar(5) DEFAULT NULL,
  `Noakhali` varchar(5) DEFAULT NULL,
  `Chattogram` varchar(5) DEFAULT NULL,
  `Faridpur` varchar(5) DEFAULT NULL,
  `Kishoreganj` varchar(5) DEFAULT NULL,
  `Narsingdi` varchar(5) DEFAULT NULL,
  `Jashore` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `traintt`
--

INSERT INTO `traintt` (`Dhaka`, `CoxsBazar`, `Rangpur`, `Sylhet`, `Khulna`, `Rajshahi`, `Mymensingh`, `Cumilla`, `Noakhali`, `Chattogram`, `Faridpur`, `Kishoreganj`, `Narsingdi`, `Jashore`) VALUES
('04:33', '04:38', '04:41', '04:44', '04:48', '04:52', '04:56', '05:00', '05:04', '05:08', '05:11', '05:14', '05:17', '05:25'),
('04:53', '04:58', '05:01', '05:04', '05:08', '05:12', '05:16', '05:20', '05:24', '05:28', '05:31', '05:34', '05:37', '05:45'),
('05:21', '05:26', '05:29', '05:32', '05:36', '05:40', '05:44', '05:48', '05:52', '05:56', '05:59', '06:02', '06:05', '06:13'),
('05:44', '05:49', '05:52', '05:55', '05:59', '06:03', '06:07', '06:11', '06:15', '06:19', '06:22', '06:25', '06:28', '06:36'),
('06:17', '06:22', '06:25', '06:28', '06:32', '06:36', '06:40', '06:44', '06:48', '06:52', '06:55', '06:58', '07:01', '07:09'),
('06:37', '06:42', '06:45', '06:48', '06:52', '06:56', '07:00', '07:04', '07:08', '07:12', '07:15', '07:18', '07:21', '07:29'),
('07:01', '07:06', '07:09', '07:12', '07:16', '07:20', '07:24', '07:28', '07:32', '07:36', '07:39', '07:42', '07:45', '07:53'),
('07:19', '07:24', '07:27', '07:30', '07:34', '07:38', '07:42', '07:46', '07:50', '07:55', '07:58', '08:01', '08:04', '08:12'),
('07:43', '07:48', '07:51', '07:54', '07:58', '08:02', '08:06', '08:11', '08:15', '08:19', '08:22', '08:22', '08:28', '08:36'),
('08:04', '08:09', '08:12', '08:15', '08:19', '08:23', '08:27', '08:31', '08:35', '08:39', '08:42', '08:45', '08:48', '08:56'),
('09:01', '09:06', '09:09', '09:12', '09:16', '09:20', '09:24', '09:28', '09:32', '09:36', '09:39', '09:42', '09:45', '09:53'),
('09:48', '09:53', '09:56', '09:59', '10:03', '10:07', '10:11', '10:15', '10:19', '10:23', '10:26', '10:29', '10:32', '10:40'),
('10:41', '10:46', '10:49', '10:52', '10:56', '11:00', '11:04', '11:08', '11:12', '11:16', '11:19', '11:32', '11:25', '11:33'),
('11:02', '11:07', '11:10', '11:13', '11:17', '11:21', '11:25', '11:30', '11:34', '11:38', '11:41', '11:44', '11:47', '11:55'),
('12:19', '12:24', '12:27', '12:30', '12:34', '12:38', '12:42', '12:46', '12:50', '12:55', '12:58', '13:01', '13:04', '13:12'),
('13:04', '13:09', '13:12', '13:15', '13:19', '13:23', '13:27', '13:31', '13:35', '13:39', '13:42', '13:45', '13:48', '13:56'),
('13:57', '14:02', '14:05', '14:08', '14:12', '14:16', '14:20', '14:24', '14:28', '14:33', '14:36', '14:39', '14:42', '14:50'),
('14:24', '14:29', '14:32', '14:35', '14:39', '14:43', '14:47', '14:51', '14:55', '14:59', '15:02', '15:05', '15:08', '15:16'),
('15:04', '15:09', '15:12', '15:15', '15:19', '15:23', '15:27', '15:31', '15:35', '15:39', '15:42', '15:45', '15:48', '15:56'),
('15:36', '15:41', '15:44', '15:47', '15:51', '15:55', '15:59', '16:03', '16:07', '16:11', '16:14', '16:17', '16:20', '16:28'),
('15:53', '15:58', '16:01', '16:04', '16:08', '16:12', '16:16', '16:20', '16:24', '16:28', '16:31', '16:34', '16:37', '16:45'),
('16:14', '16:19', '16:22', '16:25', '16:29', '16:33', '16:37', '16:41', '16:45', '16:51', '16:54', '16:57', '17:00', '17:08'),
('16:26', '16:31', '16:34', '16:37', '16:41', '16:45', '16:49', '16:53', '16:57', '17:03', '17:06', '17:09', '17:12', '17:20'),
('17:12', '17:17', '17:20', '17:23', '17:27', '17:31', '17:35', '17:39', '17:43', '17:49', '17:52', '17:55', '17:58', '18:06'),
('17:37', '17:42', '17:45', '17:48', '17:52', '17:56', '18:00', '18:04', '18:08', '18:12', '18:15', '18:18', '18:21', '18:29'),
('17:57', '18:02', '18:05', '18:08', '18:12', '18:16', '18:20', '18:24', '18:28', '18:32', '18:35', '18:38', '18:41', '18:49'),
('18:21', '18:26', '18:29', '18:32', '18:36', '18:40', '18:44', '18:48', '18:52', '18:56', '18:59', '19:02', '19:05', '19:13'),
('19:01', '19:06', '19:09', '19:12', '19:16', '19:20', '19:24', '19:28', '19:32', '19:36', '19:39', '19:42', '19:45', '19:53'),
('19:31', '19:36', '19:39', '19:42', '19:46', '19:50', '19:54', '19:58', '20:02', '20:06', '20:09', '20:12', '20:15', '20:23'),
('20:19', '20:24', '20:27', '20:30', '20:34', '20:38', '20:42', '20:46', '20:50', '20:54', '20:57', '21:00', '21:03', '21:11'),
('20:52', '20:57', '21:00', '21:03', '21:07', '21:11', '21:16', '21:21', '21:25', '21:29', '21:32', '21:35', '21:38', '21:46'),
('21:20', '21:25', '21:28', '21:31', '21:35', '21:39', '21:43', '21:47', '21:51', '21:55', '21:58', '22:01', '22:04', '22:12'),
('22:11', '22:16', '22:19', '22:22', '22:26', '22:30', '22:34', '22:38', '22:42', '22:46', '22:49', '22:52', '22:55', '23:03'),
('23:18', '23:23', '23:26', '23:29', '23:33', '23:37', '23:41', '23:45', '23:49', '23:53', '23:56', '23:59', '00:02', '00:10');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `T_No.` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `source` varchar(50) NOT NULL,
  `dest` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Class` varchar(25) NOT NULL,
  `Type` varchar(25) NOT NULL,
  `NoOfpass` int(11) NOT NULL,
  `card_no` int(25) NOT NULL,
  `expmonth` int(2) NOT NULL,
  `expyear` int(2) NOT NULL,
  `cvv` int(3) NOT NULL,
  `pin` int(4) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Amt` int(10) NOT NULL,
  `Route` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userdatabase`
--

CREATE TABLE `userdatabase` (
  `UserID` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `DoB` date NOT NULL,
  `NID` int(10) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Joined_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bustransactions`
--
ALTER TABLE `bustransactions`
  ADD PRIMARY KEY (`T_No.`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`T_No.`);

--
-- Indexes for table `userdatabase`
--
ALTER TABLE `userdatabase`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bustransactions`
--
ALTER TABLE `bustransactions`
  MODIFY `T_No.` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `T_No.` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `userdatabase`
--
ALTER TABLE `userdatabase`
  MODIFY `UserID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
