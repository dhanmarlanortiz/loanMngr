-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2017 at 12:13 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loanmngr`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `address` varchar(30) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `firstname`, `lastname`, `address`, `telephone`, `date`) VALUES
(1, 'Lyra', 'Vega', NULL, NULL, '2017-10-05 21:37:06'),
(2, 'Em', 'Ariate', NULL, NULL, '2017-10-05 21:37:06'),
(3, 'Paul', 'Jamila', NULL, NULL, '2017-10-05 21:37:06'),
(4, 'Erica', 'Jeremias', NULL, NULL, '2017-10-05 21:37:06'),
(5, 'Amy', 'Lacaste', NULL, NULL, '2017-10-05 21:37:06'),
(6, 'Jocelyn', 'Corpus', NULL, NULL, '2017-10-05 21:37:06'),
(7, 'Gloria', 'Doctor', NULL, NULL, '2017-10-05 21:37:06'),
(8, 'Sali', 'Oro', NULL, NULL, '2017-10-05 21:37:06'),
(9, 'Rosita', 'Legaspi', NULL, NULL, '2017-10-05 21:37:06'),
(10, 'Hera', 'Mabini', NULL, NULL, '2017-10-05 21:37:06'),
(11, 'Liboy', 'Mabini', NULL, NULL, '2017-10-05 21:37:06'),
(12, 'Marissa', 'Garados', NULL, NULL, '2017-10-05 21:37:06'),
(13, 'Lyra', 'Ganace', NULL, NULL, '2017-10-05 21:37:06'),
(14, 'Alvin', 'Jordan', NULL, NULL, '2017-10-05 21:37:06'),
(15, 'Edmund', 'Banares', NULL, NULL, '2017-10-05 21:37:06'),
(16, 'Allan', 'Discarga', NULL, NULL, '2017-10-05 21:37:06'),
(17, 'Arlene', 'Gallego', NULL, NULL, '2017-10-05 21:37:06'),
(18, 'Razel', 'Prudencio', NULL, NULL, '2017-10-05 21:37:06'),
(19, 'Pepito', 'valderama', NULL, NULL, '2017-10-05 21:37:06'),
(20, 'Analyn', 'Jesalva', NULL, NULL, '2017-10-05 21:37:06'),
(21, 'Pansay', 'null', NULL, NULL, '2017-10-05 21:37:06'),
(22, 'Leonard', 'Doctor', NULL, NULL, '2017-10-05 21:37:06'),
(23, 'Rolly', 'null', NULL, NULL, '2017-10-05 21:37:06'),
(24, 'Avigail', 'null', NULL, NULL, '2017-10-05 21:37:06'),
(25, 'Alvin', 'Kulapad', NULL, NULL, '2017-10-05 21:37:06'),
(26, 'Valerie', 'Del Rosario', NULL, NULL, '2017-10-05 21:37:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
