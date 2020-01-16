-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2020 at 03:33 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cm`
--

-- --------------------------------------------------------

--
-- Table structure for table `case_info`
--

CREATE TABLE `case_info` (
  `file_number` varchar(200) NOT NULL,
  `case_number` varchar(200) NOT NULL,
  `year` varchar(200) NOT NULL,
  `case_type` varchar(200) NOT NULL,
  `court_name` varchar(200) NOT NULL,
  `lawyer` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `case_info`
--

INSERT INTO `case_info` (`file_number`, `case_number`, `year`, `case_type`, `court_name`, `lawyer`, `location`) VALUES
('1', '1', '2020', 'robbery', 'mumbai', 'prem', 'mumbai');

-- --------------------------------------------------------

--
-- Table structure for table `case_update_log`
--

CREATE TABLE `case_update_log` (
  `time` datetime(6) NOT NULL,
  `file_number` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `user_group` varchar(200) NOT NULL,
  `action` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `case_update_log`
--

INSERT INTO `case_update_log` (`time`, `file_number`, `username`, `user_group`, `action`) VALUES
('2020-01-18 00:00:00.000000', '1', 'vijay', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `court_type`
--

CREATE TABLE `court_type` (
  `court_name` varchar(10) NOT NULL,
  `location` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `court_type`
--

INSERT INTO `court_type` (`court_name`, `location`) VALUES
('mumbai', 'mumbai');

-- --------------------------------------------------------

--
-- Table structure for table `date_info`
--

CREATE TABLE `date_info` (
  `file_number` varchar(200) NOT NULL,
  `case_filed_on` varchar(200) NOT NULL,
  `notice_received_on` varchar(200) NOT NULL,
  `first_hearing_on` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `date_info`
--

INSERT INTO `date_info` (`file_number`, `case_filed_on`, `notice_received_on`, `first_hearing_on`) VALUES
('1', '1', '22/7/2019', '28/8/2019');

-- --------------------------------------------------------

--
-- Table structure for table `latest_proceeding`
--

CREATE TABLE `latest_proceeding` (
  `file_number` varchar(200) NOT NULL,
  `proceeding_number` varchar(200) NOT NULL,
  `proceeding_date` varchar(200) NOT NULL,
  `decision` varchar(200) NOT NULL,
  `next_hearing_on` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `latest_proceeding`
--

INSERT INTO `latest_proceeding` (`file_number`, `proceeding_number`, `proceeding_date`, `decision`, `next_hearing_on`, `description`) VALUES
('1', '1', '22/1/2020', '', '', 'whatever');

-- --------------------------------------------------------

--
-- Table structure for table `lawyer`
--

CREATE TABLE `lawyer` (
  `lawyer_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lawyer`
--

INSERT INTO `lawyer` (`lawyer_name`, `email`) VALUES
('prem', 'prem@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `petitioner_respondent_info`
--

CREATE TABLE `petitioner_respondent_info` (
  `petitioner_name` varchar(200) NOT NULL,
  `petitioner_email` varchar(200) NOT NULL,
  `petitioner_address` varchar(200) NOT NULL,
  `respondent_name` varchar(200) NOT NULL,
  `respondent_email` varchar(200) NOT NULL,
  `respondent_address` varchar(200) NOT NULL,
  `file_number` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petitioner_respondent_info`
--

INSERT INTO `petitioner_respondent_info` (`petitioner_name`, `petitioner_email`, `petitioner_address`, `respondent_name`, `respondent_email`, `respondent_address`, `file_number`) VALUES
('vijay', 'vijay@gmail.com', 'abc', 'pqr', 'pqr@gmail.com', 'pqrst', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `username` varchar(200) NOT NULL,
  `password` varchar(10) NOT NULL,
  `status_web` varchar(10) DEFAULT NULL,
  `status_app` varchar(200) NOT NULL,
  `user_type` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`username`, `password`, `status_web`, `status_app`, `user_type`, `contact`) VALUES
('prdp', '123', 'ONLINE', '', 'admin', '23243243545');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
