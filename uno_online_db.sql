-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 19, 2020 at 04:51 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id14273155_uno_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `stack_id` varchar(5) NOT NULL,
  `number` int(3) NOT NULL,
  `order_in_stack` int(3) NOT NULL,
  `content` varchar(6) NOT NULL,
  `id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `id` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `numCards` int(3) NOT NULL,
  `roomCode` varchar(5) NOT NULL,
  `nextPlayer` varchar(5) DEFAULT NULL,
  `previousPlayer` varchar(5) DEFAULT NULL,
  `stackUsed` int(1) DEFAULT 0,
  `unoPressed` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomCode` varchar(5) NOT NULL,
  `numberOfPlayersRemaining` int(1) NOT NULL,
  `isStarted` int(1) NOT NULL,
  `cardOnTable` varchar(6) NOT NULL,
  `playerTurn` varchar(5) DEFAULT NULL,
  `color` varchar(1) DEFAULT NULL,
  `direction` int(1) DEFAULT 1,
  `isEnded` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stack`
--

CREATE TABLE `stack` (
  `stack_id` varchar(5) NOT NULL,
  `numberOfCardsRemaining` varchar(5) NOT NULL,
  `roomCode` varchar(5) NOT NULL,
  `nextCardNumber` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD KEY `stuck_id` (`stack_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roomCode` (`roomCode`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomCode`);

--
-- Indexes for table `stack`
--
ALTER TABLE `stack`
  ADD PRIMARY KEY (`stack_id`),
  ADD KEY `roomCode` (`roomCode`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_ibfk_1` FOREIGN KEY (`stack_id`) REFERENCES `stack` (`stack_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `card_ibfk_2` FOREIGN KEY (`id`) REFERENCES `player` (`id`);

--
-- Constraints for table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`roomCode`) REFERENCES `room` (`roomCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stack`
--
ALTER TABLE `stack`
  ADD CONSTRAINT `stack_ibfk_1` FOREIGN KEY (`roomCode`) REFERENCES `room` (`roomCode`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
