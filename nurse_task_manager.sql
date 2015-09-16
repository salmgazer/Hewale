-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2015 at 09:30 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nurse_task_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`admin_id` int(10) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `hospital_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `username`, `password`, `hospital_id`) VALUES
(1, 'John', 'Abantor', 'johnny', 'johnny123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL,
  `message` varchar(75) NOT NULL,
  `sent_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nurse_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE IF NOT EXISTS `hospital` (
`hospital_id` int(10) NOT NULL,
  `hospital_name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hospital_id`, `hospital_name`) VALUES
(1, 'Korle-Bu'),
(2, 'Achimota'),
(3, 'Kanesi complex');

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE IF NOT EXISTS `nurse` (
`nurse_id` int(10) NOT NULL,
  `fullname` varchar(70) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `status` enum('head nurse','student intern','full time nurse') NOT NULL,
  `hospital_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`nurse_id`, `fullname`, `username`, `password`, `status`, `hospital_id`) VALUES
(1, 'Ama', 'abolo', 'ama123', 'full time nurse', 1),
(13, 'mngb kejngt', 'nhjky', 'wkrjh', 'full time nurse', 1),
(14, 'mgnte kjnktnhkte', 'nhjkyshmgbr', 'kjgktnhtejhntehn', 'student intern', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nurse_has_task`
--

CREATE TABLE IF NOT EXISTS `nurse_has_task` (
  `nurse_id` int(10) NOT NULL,
  `task_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
`task_id` int(10) NOT NULL,
  `description` tinytext,
  `summary` varchar(150) DEFAULT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `nurse_id` int(10) unsigned NOT NULL,
  `task_status` enum('ongoing','finished','overdue','requested completion') NOT NULL DEFAULT 'ongoing',
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `description`, `summary`, `admin_id`, `nurse_id`, `task_status`, `start_time`, `end_time`) VALUES
(2, 'Fry Ali and crucify Tony', 'Kill two idiots', 1, 1, 'ongoing', '2015-04-16 17:36:05', '2015-04-23 14:18:26'),
(3, 'mhbwhjfbwjh  jhwfbw jwhbgjwb', 'jhvrgjw jwhbjgwrh', 1, 1, 'ongoing', '2015-04-19 04:24:01', '2015-04-30 17:27:23'),
(4, 'nsvfh jhsbgjr jhbgjrh', 'hwbjr', 1, 1, 'requested completion', '2015-04-22 06:25:29', '2015-04-29 19:26:27'),
(5, 'kjngrkeng kngt ktejngte ketjnget ekjnge kejgne ekjgnle ekjgneklj', 'lkjgne eknget tkjhnet knetj', 1, 1, 'overdue', '2015-04-19 15:53:57', '2015-04-14 14:24:28'),
(6, 'jnfd jdb kfjg kfjngjk', 'kdfjf knhk kjtn', 1, 1, 'overdue', '2015-04-19 16:11:07', '2015-04-29 15:28:23'),
(7, 'm jhfb kjnfk kjn kjnk', 'kfjn kjnk kjn nkj kjn', 1, 1, 'finished', '2015-04-19 16:11:32', '0000-00-00 00:00:00'),
(8, 'kj kjdn kjn kjn', 'kjn knjk kjn', 1, 1, 'finished', '2015-04-19 16:12:07', '2015-04-28 18:29:13'),
(9, 'jngrkngkrj', ',ejngkr', 1, 1, 'requested completion', '2015-04-22 05:45:02', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
 ADD PRIMARY KEY (`hospital_id`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
 ADD PRIMARY KEY (`nurse_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
 ADD PRIMARY KEY (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
MODIFY `hospital_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
MODIFY `nurse_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
MODIFY `task_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
