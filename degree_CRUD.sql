-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2017 at 07:10 AM
-- Server version: 5.5.54-cll
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `degree_CRUD`
--

-- --------------------------------------------------------

--
-- Table structure for table `Events`
--

CREATE TABLE `Events` (
  `id` int(11) NOT NULL,
  `programId` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Events`
--

INSERT INTO `Events` (`id`, `programId`, `startDate`, `endDate`, `file`) VALUES
(1, 1, '2017-06-05', '2017-06-07', 'test.pdf'),
(2, 1, '2017-07-15', '2017-07-17', 'test.pdf'),
(3, 5, '2017-09-11', '2017-09-13', 'test.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `Programs`
--

CREATE TABLE `Programs` (
  `id` int(11) NOT NULL,
  `program` varchar(255) NOT NULL,
  `programCategory` varchar(255) NOT NULL,
  `trainer` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `hotel` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Programs`
--

INSERT INTO `Programs` (`id`, `program`, `programCategory`, `trainer`, `rate`, `venue`, `hotel`) VALUES
(1, 'The 7 Habits of Highly Effective People: Signature Edition 4.0', 'DEVELOPING INDIVIDUAL AND TEAM EFFECTIVENESS', 'FC Malaysia', 3710, 'Kuala Lumpur', 'Ritz Carlton Hotel'),
(4, 'The 7 Habits of Highly Effective People: Signature Edition 4.0', 'DEVELOPING INDIVIDUAL AND TEAM EFFECTIVENESS', 'FC Malaysia', 3710, 'Selangor', 'The Saujana Hotel'),
(5, 'The 7 Habits of Highly Effective People: Signature Edition 4.0', 'DEVELOPING INDIVIDUAL AND TEAM EFFECTIVENESS', 'FC Malaysia', 3710, 'Penang', 'Evergreen Laurel Penang'),
(6, 'The 7 Habits of Highly Effective Secretary', 'DEVELOPING GREAT LEADERS AND ORGANIZATIONAL EFFECTIVENESS', 'FC Malaysia', 3000, 'Kuala Lumpur', 'Ritz Carlton Hotel'),
(7, 'On Being Proactive', 'DEVELOPING INDIVIDUAL AND TEAM EFFECTIVENESS', 'FC Malaysia', 901, 'Selangor', 'The Saujana Hotel'),
(8, 'The 7 Habits of Highly Effective People: Signature Edition 4.0', 'DEVELOPING INDIVIDUAL AND TEAM EFFECTIVENESS', 'FC Malaysia', 3710, 'Johor Bahru', 'Puteri Pacific Hotel'),
(9, '7 Tabiat Orang Yang Amat Berkesan', 'DEVELOPING INDIVIDUAL AND TEAM EFFECTIVENESS', 'FC Malaysia', 2438, 'Selangor', 'The Saujana Hotel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Programs`
--
ALTER TABLE `Programs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `Programs`
--
ALTER TABLE `Programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
