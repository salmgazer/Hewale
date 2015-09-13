-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 24, 2015 at 10:54 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hostpital_task_management`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_admin`(IN `id` INT, IN `fn` VARCHAR(25), IN `ln` VARCHAR(25), IN `user_n` VARCHAR(30), IN `pwd` VARCHAR(30))
    NO SQL
BEGIN
Insert into admin values (id, fn, ln, user_n, pwd);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_comment`(IN `id` INT, IN `msg` INT(75), IN `sent_time` TIMESTAMP, IN `nurse_id` INT, IN `admin_id` INT)
    NO SQL
BEGIN
Insert into comments values (id, msg, sent_time, nurse_id, admin_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_hospital`(IN `id` INT, IN `name` VARCHAR(50))
    NO SQL
BEGIN
Insert into hospital values (id, name);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_nurse`(IN `id` INT, IN `fn` VARCHAR(25), IN `ln` VARCHAR(25), IN `username` VARCHAR(35), IN `password` VARCHAR(30), IN `status` ENUM('Head Nurse','Full Time Nurse','Intern Nurse'), IN `hospital` INT)
    NO SQL
BEGIN
Insert into nurse values (id, fn, ln, username, password, status, hospital);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_nurse_task`(IN `id` INT, IN `nurse_id` INT, IN `admin_id` INT)
    NO SQL
BEGIN
Insert into nurse_has_task values (nurse_id, id, admin_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_task`(IN `id` INT, IN `des` VARCHAR(75), IN `start_time` TIMESTAMP, IN `finish` TIMESTAMP)
    NO SQL
BEGIN
Insert into task values (id, des, start_time, finish_time);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `change_task_description`(IN `id` INT, IN `des` VARCHAR(75))
    NO SQL
BEGIN
Update task set task_description=des;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_admin`(IN `id` INT)
    NO SQL
BEGIN
Delete from admin where admin_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_hospital`(IN `id` INT)
    NO SQL
BEGIN
Delete from hospital where hospital_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_nurse`(IN `id` INT)
    NO SQL
BEGIN
Delete from nurse where nurse_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_nurse_task`(IN `id` INT)
    NO SQL
BEGIN
Delete from nurse_has_task where task_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_task`(IN `id` INT)
    NO SQL
BEGIN
Delete from task where task_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_task_id`(IN `des` VARCHAR(75), IN `st` TIMESTAMP, IN `et` TIMESTAMP)
    NO SQL
BEGIN
select task_id from task where description=des AND start_time=st AND end_time=et limit 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_admin`(IN `fn` VARCHAR(25), IN `ln` VARCHAR(25), IN `u_n` VARCHAR(30), IN `pwd` VARCHAR(25), IN `id` INT)
    NO SQL
BEGIN
Update admin set firstname=fn, lastname=ln, username=u_n, password=pwd where admin_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_hospital`(IN `id` INT, IN `name` VARCHAR(50))
    NO SQL
BEGIN
Update hospital set hospital_name=name where hospital_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_nurse`(IN `id` INT, IN `fn` VARCHAR(25), IN `ln` VARCHAR(25), IN `un` VARCHAR(35), IN `pwd` VARCHAR(30), IN `sta` ENUM('Head Nurse','Full Time Nurse','Intern Nurse'), IN `hos` INT)
    NO SQL
BEGIN
Update nurse set firstname=fn, lastname=ln, username=un, password=pwd, status=sta, hospital_id=hos where nurse_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_nurse_task`(IN `id` INT, IN `n_id` INT, IN `a_id` INT)
    NO SQL
BEGIN
Update nurse_has_task set nurse_id=n_id, admin_id=a_id where task_id=id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(10) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE IF NOT EXISTS `nurse` (
  `nurse_id` int(10) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `status` enum('head nurse','student intern','full time nurse') NOT NULL,
  `hospital_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `description` varchar(75) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
