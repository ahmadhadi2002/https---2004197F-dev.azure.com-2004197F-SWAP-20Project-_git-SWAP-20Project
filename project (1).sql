-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 09:51 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `ID` int(10) NOT NULL,
  `NAME` varchar(50) DEFAULT NULL,
  `ROLE` varchar(50) DEFAULT NULL,
  `DEPARTMENT` varchar(50) DEFAULT NULL,
  `TASK` varchar(255) DEFAULT NULL,
  `START` varchar(50) DEFAULT NULL,
  `END` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`ID`, `NAME`, `ROLE`, `DEPARTMENT`, `TASK`, `START`, `END`) VALUES
(10, 'Xavier', 'Supervisor', 'HR', '2222', '2018-07-22', '2018-07-22'),
(18, 'Ryan Koo', 'Ryan Koo', 'it', '121332132', '2022-01-05', '2022-01-08'),
(19, 'Ryan Koo', 'admin', 'it', '`2333444', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `START` varchar(25) DEFAULT NULL,
  `END` varchar(25) DEFAULT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `DEPARTMENT` varchar(50) DEFAULT NULL,
  `COMMENT` varchar(500) DEFAULT NULL,
  `TIMESTAMP` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `START`, `END`, `USERNAME`, `DEPARTMENT`, `COMMENT`, `TIMESTAMP`) VALUES
(8, '2021-12-08', '2021-12-10', 'hiji', 'hi', 'hi', '2021-12-01 15:45:08.544684'),
(10, '2021-11-17', '2021-11-24', 'bbbbbb', 'aaaaaaa', 'wwwwwww', '2021-12-02 03:32:08.562712'),
(11, '2021-11-17', '2021-11-24', 'xa', 'IT', 'ssss', '2021-12-02 03:32:29.828012'),
(12, '2021-11-17', '2021-11-24', 'dddddd', 'bbbbbbbbbb', 'bbbbbbb', '2021-12-02 08:14:49.036614'),
(13, '2021-11-17', '2021-11-24', 'xa', 'IT', '1234567890', '2021-12-02 08:33:27.693524'),
(14, '2021-11-17', '2021-11-24', 'xa', 'IT', '12345', '2021-12-02 08:33:57.627700'),
(15, '2021-11-17', '2021-11-24', 'xa', 'bbbbbbbbbb', '12345', '2021-12-02 08:35:13.476995'),
(16, '2021-11-17', '2021-11-24', '123', 'ee', '3wsertyuiop[]', '2021-12-02 16:45:11.489655'),
(20, '2021-11-17', '2021-11-24', 'tgbvrthbted', 'ee', 'bhyt', '2021-12-02 16:49:59.375838'),
(24, '2021-11-17', '2021-11-24', 'ttyup]1234', '11', '1111111111', '2021-12-02 17:26:10.974668'),
(25, '2021-11-17', '2021-11-24', 'ttyup]44444', '2', '1', '2021-12-02 17:26:55.678271'),
(26, '2021-11-17', '2021-11-24', 'ttyup]44444', '2', '1', '2021-12-02 17:29:12.576126'),
(27, '2021-11-17', '2021-11-24', 'dddddd', '', '', '2021-12-02 17:29:21.360949'),
(28, '2021-11-17', '2021-11-24', 'dddddd', '', '', '2021-12-02 17:29:35.101792'),
(29, '2021-11-17', '2021-11-24', 'xa', '', '', '2021-12-02 17:33:46.951647'),
(32, '2021-11-17', '2021-11-24', 'hadi', '', '', '2021-12-02 17:39:53.430714'),
(33, '2021-12-22', '2021-12-31', 'dddddd', 'IT', '1', '2021-12-03 08:19:41.831573');

-- --------------------------------------------------------

--
-- Table structure for table `planner`
--

CREATE TABLE `planner` (
  `Start Date` varchar(30) NOT NULL,
  `End Date` varchar(30) NOT NULL,
  `Item` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `planner`
--

INSERT INTO `planner` (`Start Date`, `End Date`, `Item`, `id`) VALUES
('2021-11-17', '2021-11-24', 'maintainance for server', 15),
('2021-12-15', '2021-12-16', 'qqqqq', 16),
('2021-12-22', '2021-12-31', '123', 17),
('2021-12-08', '2021-12-09', 'test', 19);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `department` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `name`, `password`, `address`, `email`, `contact`, `photo`, `token`, `status`, `role`, `department`) VALUES
(105, 'Ryan', '5b681c86a8a4a182b61d2f3080129c90', 'tampines', '2000771b@student.tp.edu.sg', '91111111', '', '67b814ee65149dcd9baac56974a97bc4', 0, ' ', 'IT'),
(106, 'Ryan Koo', '1a1dc91c907325c69271ddf0c944bc72', 'tampines st 81', 'xavierkjc@gmail.com', '91111112', '268540670download.jfif', '33a9df4da1c7cb8b9e50eda4af92054c', 1, NULL, NULL),
(108, 'Ryan', 'c4ca4238a0b923820dcc509a6f75849b', '1', 'xavierkohjc@gmail.com', '1', '563231574download.jfif', '2923d5b4b706126648839c1dea248da5', 1, 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planner`
--
ALTER TABLE `planner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `planner`
--
ALTER TABLE `planner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
