-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2016 at 06:44 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stlukes`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient_data`
--

CREATE TABLE IF NOT EXISTS `patient_data` (
  `id` bigint(10) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `relation_with` varchar(25) NOT NULL,
  `relation_name` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `age` int(3) NOT NULL,
  `religion` varchar(25) NOT NULL,
  `caste` varchar(25) NOT NULL,
  `marital_status` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `address_line_1` varchar(100) NOT NULL,
  `address_line_2` varchar(100) NOT NULL,
  `address_line_3` varchar(100) NOT NULL,
  `address_line_4` varchar(100) NOT NULL,
  `address_line_5` varchar(100) NOT NULL,
  `pincode` varchar(25) NOT NULL,
  `phone_no` varchar(25) NOT NULL,
  `hospital_no` varchar(25) NOT NULL,
  `patient_status` varchar(25) NOT NULL,
  `lr_no` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_data`
--

INSERT INTO `patient_data` (`id`, `patient_name`, `relation_with`, `relation_name`, `occupation`, `sex`, `age`, `religion`, `caste`, `marital_status`, `date`, `address_line_1`, `address_line_2`, `address_line_3`, `address_line_4`, `address_line_5`, `pincode`, `phone_no`, `hospital_no`, `patient_status`, `lr_no`) VALUES
(1, 'MohamedSaleem', 'F/O', 'Abdul Hameed', 'Turner', 'Male', 26, 'Muslim', 'Lebbai', 'UnMarried', '2016-06-24', '1/89 b main road', 'arampannai', 'arampannai', 'Tuicorin', 'Tuicorin', '628625', '9578795653', '12345', 'Alive', '456789'),
(2, 'Saleem', 'S/O', 'Kaja', '', 'Male', 25, 'Hindu', '', 'Married', '0000-00-00', '', '', '', '', '', '', '', '', 'Alive', '12345'),
(3, 'sdfsdfs', 'S/O', 'dfgdf', '', 'FeMale', 25, 'Hindu', '', 'Married', '0000-00-00', '', '', '', '', '', '', '', '', 'Alive', ''),
(4, 'dfgjg', 'F/O', 'djkgdfjg', 'dfgj', 'Male', 25, 'Hindu', 'dfgdf', 'Married', '0000-00-00', '', '', '', '', '', '', '', '', 'Dead', ''),
(5, 'fgfgh', 'F/O', 'dfg', '', 'Male', 43, 'Hindu', '', 'Married', '0000-00-00', '', '', '', '', '', '', '', '', 'Alive', ''),
(6, 'dfgdf', 'F/O', 'dfgdf', '', 'Male', 25, 'Hindu', '', 'Married', '2016-06-14', '', '', '', '', '', '', '', '', 'Dead', ''),
(7, 'dfgdfg', 'F/O', 'dsfsdf', 'dfgsdf', 'Male', 25, 'Hindu', '', 'Married', '0000-00-00', '', '', '', '', '', '', '', '', 'Alive', ''),
(8, 'hdfgfdg', 'F/O', 'dfgdf', '', 'Male', 25, 'Hindu', '', 'Married', '0000-00-00', '', '', '', '', '', '', '', '', 'Alive', ''),
(9, 'cvxcvxcv', 'F/O', 'xcvc', 'xvx', 'Male', 25, 'Hindu', '', 'Married', '0000-00-00', '', '', '', '', '', '', '', '', 'Alive', ''),
(10, 'rttTESXT', 'D/O', 'dfgdfg', '', 'Male', 67, 'Hindu', '', 'Married', '0000-00-00', '', '', '', '', '', '', '', '', 'Alive', ''),
(11, 'ccvb', 'F/O', 'cvbcvb', '', 'Male', 56, 'Hindu', '', 'Married', '0000-00-00', '', '', '', '', '', '', '', '', 'Alive', ''),
(12, 'fghjgj', 'W/O', 'gfhfgh', '', 'Male', 9, 'Hindu', '', 'Married', '0000-00-00', '', '', '', '', '', '', '', '', 'Alive', ''),
(13, 'fggdg', 'F/O', 'dfgdfg', '', 'Male', 55, 'Hindu', '', 'Married', '0000-00-00', '', '', '', '', '', '', '', '', 'Alive', ''),
(14, 'dfgdfgd', 'D/O', 'dfgdfgdf', '', 'Male', 67, 'Hindu', '', 'Married', '0000-00-00', '', '', '', '', '', '', '', '', 'Alive', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
