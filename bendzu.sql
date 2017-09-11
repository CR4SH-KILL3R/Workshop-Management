-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 31, 2017 at 03:54 PM
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
-- Database: `bendzu`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `workshops` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `email`, `password`, `workshops`) VALUES
(1, 'fahim karim', 'fkarim6@gmail.com', 'fahim092', 'pyt,cpp,iot'),
(2, 'indranil', 'ggwp@gmail.com', 'admin123', 'nil'),
(4, 'sayantan', 'sayantandas@gmail.com', 'admin123', 'nil');

-- --------------------------------------------------------

--
-- Table structure for table `workshop`
--

CREATE TABLE `workshop` (
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `lastDate` varchar(50) NOT NULL,
  `tag` varchar(20) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workshop`
--

INSERT INTO `workshop` (`name`, `description`, `lastDate`, `tag`, `date`, `time`) VALUES
('C++ Workshop', 'Learn the basics of C++ and understand the concepts of OOP through C++ in this workshop. Each participant will be given a project which they have to complete', '31st August,2017', 'cpp', '12th September,2017', '12:00pm'),
('Python Workshop', 'Learn the basics of Python and understand the concepts of OOP through Python in this workshop. Each participant will be given a project which they have to complete', '31st August,2017', 'pyt', '10th September,2017', '12:00pm'),
('Internet of Things Workshop', 'Learn the basics of IOT and how to program a Arduino. Every student wil be given a project which they have to complete.', '31st August,2017', 'iot', '12th September', '12:00pm'),
('Java Workshop', 'Learn the basics of Java and understand the concepts of OOP through Java in this workshop. Each participant will be given a project which they have to complete.', '30th Augusut,2017', 'jav', '15th September,2017', '12:00pm'),
('Web Development', 'Learn the basics of HTML,CSS,JavaScript and PHP. Learn how to build beautiful,responsive websites. MySQL basics will be taught as well.', '3rd September,2017', 'web', '19th September,2017', '12:00pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
