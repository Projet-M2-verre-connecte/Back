-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 18, 2022 at 10:27 AM
-- Server version: 10.5.15-MariaDB-0+deb11u1
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Tms_verre`
--

-- --------------------------------------------------------

--
-- Table structure for table `Data`
--

CREATE TABLE `Data` (
  `id_data` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `volume` float NOT NULL,
  `id_patient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Data`
--

INSERT INTO `Data` (`id_data`, `datetime`, `volume`, `id_patient`) VALUES
(1, '2022-11-15 14:18:45', 0.2, 1),
(2, '2022-11-15 14:20:20', 0.1, 1),
(3, '2022-11-15 14:22:10', 0.1, 1),
(4, '2022-11-15 14:23:15', 0.1, 1),
(5, '2022-11-15 14:25:10', 0.1, 1),
(6, '2022-11-15 14:22:10', 0.2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Link_to`
--

CREATE TABLE `Link_to` (
  `id_monitor` int(11) NOT NULL,
  `id_patient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Link_to`
--

INSERT INTO `Link_to` (`id_monitor`, `id_patient`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Monitor`
--

CREATE TABLE `Monitor` (
  `id_monitor` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `profession` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Monitor`
--

INSERT INTO `Monitor` (`id_monitor`, `name`, `surname`, `profession`) VALUES
(1, 'Le Brigand', 'Jules', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `Patient`
--

CREATE TABLE `Patient` (
  `id_patient` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `weight` float NOT NULL,
  `objective` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Patient`
--

INSERT INTO `Patient` (`id_patient`, `name`, `surname`, `age`, `weight`, `objective`) VALUES
(1, 'Mercier', 'Cyprien', 22, 76, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Data`
--
ALTER TABLE `Data`
  ADD PRIMARY KEY (`id_data`),
  ADD KEY `Data_Patient_FK` (`id_patient`);

--
-- Indexes for table `Link_to`
--
ALTER TABLE `Link_to`
  ADD PRIMARY KEY (`id_monitor`,`id_patient`),
  ADD KEY `Link_to_Patient0_FK` (`id_patient`);

--
-- Indexes for table `Monitor`
--
ALTER TABLE `Monitor`
  ADD PRIMARY KEY (`id_monitor`);

--
-- Indexes for table `Patient`
--
ALTER TABLE `Patient`
  ADD PRIMARY KEY (`id_patient`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Data`
--
ALTER TABLE `Data`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Monitor`
--
ALTER TABLE `Monitor`
  MODIFY `id_monitor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Patient`
--
ALTER TABLE `Patient`
  MODIFY `id_patient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Data`
--
ALTER TABLE `Data`
  ADD CONSTRAINT `Data_Patient_FK` FOREIGN KEY (`id_patient`) REFERENCES `Patient` (`id_patient`);

--
-- Constraints for table `Link_to`
--
ALTER TABLE `Link_to`
  ADD CONSTRAINT `Link_to_Monitor_FK` FOREIGN KEY (`id_monitor`) REFERENCES `Monitor` (`id_monitor`),
  ADD CONSTRAINT `Link_to_Patient0_FK` FOREIGN KEY (`id_patient`) REFERENCES `Patient` (`id_patient`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
