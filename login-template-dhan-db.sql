-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2017 at 01:58 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login-template-dhan-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`) VALUES
(5, 'admin123', '$2y$10$S/QbPtbITtk2IKdWP7LSdezFZHrquHtzjWEDVyS..Sw3O7/vIQ./S', 'admin123@admin.com'),
(6, 'test54322', '$2y$10$4F2TX1rWYK867ZMmrA2U9u81niVaYuSUXvjSHkOi5/da3egcKY.Cm', 'test54322@admin.com'),
(7, 'testabcde', '$2y$10$ynDIQOqeZj0mjnDbW9Si3uehSme/tU7uBDwzACRCt2am4nUiBzJ.C', 'testabcde@testabcde.com'),
(8, '123456789', '$2y$10$SaD6W6tpKEX5BIhhqSXzvu.yqVhoCTDhCh.RlVJTsgNoxgZAlSpB2', '123456789@123456789.com');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `telephone` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`firstname`, `lastname`, `telephone`, `address`, `id`) VALUES
('AJA', NULL, '', '', 1),
('Allan', 'Discarga', '', '', 2),
('Alvin', 'Jordan', '', '', 3),
('Amy', 'Lacaste', '', '', 4),
('Analyn', 'Jesalva', '', '', 5),
('Arlene', 'Gallego', '', '', 6),
('Edmund', 'Banares', '', '', 7),
('Em', 'Ariate', '', '', 8),
('Erica', 'Jeremias', '', '', 9),
('Gloria', 'Doctor', '', '', 10),
('Hera', 'Mabini', '', '', 11),
('Jocelyn', 'Corpus', '', '', 12),
('Leonard', 'Doctor', '', '', 13),
('Liboy', 'Mabini', '', '', 14),
('Lyra', 'Ganace', '', '', 15),
('Lyra', 'Vega', '', '', 16),
('Marissa', 'Garados', '', '', 17),
('Pansay', NULL, '', '', 18),
('Paul', 'Jamila', '', '', 19),
('Paul', 'Jamila_1', '', '', 20),
('Pepito', NULL, '', '', 21),
('Razel', 'Prudencio', '', '', 22),
('Rosita', 'Legaspi', '', '', 23),
('Sali', 'Oro', '', '', 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
