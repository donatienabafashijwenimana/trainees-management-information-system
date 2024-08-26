-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 09:51 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trainee assessmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `markdid` int(3) UNSIGNED ZEROFILL NOT NULL,
  `traineeid` int(3) UNSIGNED ZEROFILL NOT NULL,
  `tradeid` int(3) UNSIGNED ZEROFILL NOT NULL,
  `moduleid` int(3) UNSIGNED ZEROFILL NOT NULL,
  `userid` int(3) UNSIGNED ZEROFILL NOT NULL,
  `fass` int(11) NOT NULL,
  `sass` int(10) NOT NULL,
  `cass` int(10) NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`markdid`, `traineeid`, `tradeid`, `moduleid`, `userid`, `fass`, `sass`, `cass`, `total`) VALUES
(014, 002, 002, 001, 001, 30, 89, 32, 50);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `mid` int(3) UNSIGNED ZEROFILL NOT NULL,
  `mname` varchar(30) NOT NULL,
  `mcredit` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`mid`, `mname`, `mcredit`) VALUES
(001, 'programmings', '11'),
(003, 'systemanlysis', '17'),
(004, 'algorithm', '37');

-- --------------------------------------------------------

--
-- Table structure for table `trade`
--

CREATE TABLE `trade` (
  `tid` int(3) UNSIGNED ZEROFILL NOT NULL,
  `tname` varchar(30) NOT NULL,
  `level` varchar(30) NOT NULL,
  `sector` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trade`
--

INSERT INTO `trade` (`tid`, `tname`, `level`, `sector`) VALUES
(002, 'mlm', 'level3', 'hospitality and tourism'),
(008, 'mas', 'level3', 'ict and multimedia');

-- --------------------------------------------------------

--
-- Table structure for table `trainee`
--

CREATE TABLE `trainee` (
  `sid` int(3) UNSIGNED ZEROFILL NOT NULL,
  `firstname` varchar(110) NOT NULL,
  `lastname` varchar(110) NOT NULL,
  `gender` varchar(110) NOT NULL,
  `tradeid` int(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainee`
--

INSERT INTO `trainee` (`sid`, `firstname`, `lastname`, `gender`, `tradeid`) VALUES
(002, 'alex', 'mugabe', 'male', 002),
(020, 'can', 'shema', 'male', 002),
(021, 'alex', 'mugabes', 'male', 002),
(022, 'dalton', 'mugisha', 'male', 008);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(3) UNSIGNED ZEROFILL NOT NULL,
  `uname` varchar(30) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `password`) VALUES
(001, 'donatien', '1234'),
(002, 'dalton', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`markdid`),
  ADD KEY `tradeid` (`tradeid`),
  ADD KEY `marks_ibfk_3` (`userid`),
  ADD KEY `marks_ibfk_4` (`traineeid`),
  ADD KEY `marks_ibfk_5` (`moduleid`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `trade`
--
ALTER TABLE `trade`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `trainee`
--
ALTER TABLE `trainee`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `tradeid` (`tradeid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `markdid` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `mid` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trade`
--
ALTER TABLE `trade`
  MODIFY `tid` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `trainee`
--
ALTER TABLE `trainee`
  MODIFY `sid` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`tradeid`) REFERENCES `trade` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marks_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marks_ibfk_4` FOREIGN KEY (`traineeid`) REFERENCES `trainee` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marks_ibfk_5` FOREIGN KEY (`moduleid`) REFERENCES `modules` (`mid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trainee`
--
ALTER TABLE `trainee`
  ADD CONSTRAINT `trainee_ibfk_1` FOREIGN KEY (`tradeid`) REFERENCES `trade` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
