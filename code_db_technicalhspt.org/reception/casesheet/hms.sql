-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2016 at 06:16 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `roomtypeno` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_casetype`
--

CREATE TABLE IF NOT EXISTS `m_casetype` (
  `casetypeno` int(3) NOT NULL AUTO_INCREMENT,
  `casetypename` varchar(50) NOT NULL,
  PRIMARY KEY (`casetypeno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `m_casetype`
--

INSERT INTO `m_casetype` (`casetypeno`, `casetypename`) VALUES
(1, 'GENERAL'),
(2, 'DELIVERY');

-- --------------------------------------------------------

--
-- Table structure for table `m_login`
--

CREATE TABLE IF NOT EXISTS `m_login` (
  `userno` int(3) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `departmentno` int(3) NOT NULL,
  `role` char(1) NOT NULL,
  PRIMARY KEY (`userno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_login`
--

INSERT INTO `m_login` (`userno`, `username`, `password`, `departmentno`, `role`) VALUES
(1, 'USER', 'USER', 1, 'U'),
(2, 'admin', 'admin', 2, 'S');

-- --------------------------------------------------------

--
-- Table structure for table `m_patientregistration`
--

CREATE TABLE IF NOT EXISTS `m_patientregistration` (
  `patientid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(10) NOT NULL,
  `initials` varchar(10) NOT NULL,
  PRIMARY KEY (`patientid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `m_patientregistration`
--

INSERT INTO `m_patientregistration` (`patientid`, `title`, `firstname`, `lastname`, `initials`) VALUES
(1, 'MISS', 'SALEEMFGH', '', ''),
(2, 'MR', 'ABU', '', ''),
(3, 'MR', 'MOHAMED', 'SALEEM', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `m_room`
--

CREATE TABLE IF NOT EXISTS `m_room` (
  `roomno` int(3) NOT NULL AUTO_INCREMENT,
  `roomtypeno` int(3) NOT NULL,
  `roomname` varchar(50) NOT NULL,
  PRIMARY KEY (`roomno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `m_room`
--

INSERT INTO `m_room` (`roomno`, `roomtypeno`, `roomname`) VALUES
(1, 3, '101'),
(2, 4, '201'),
(3, 5, '501');

-- --------------------------------------------------------

--
-- Table structure for table `m_roomtype`
--

CREATE TABLE IF NOT EXISTS `m_roomtype` (
  `roomtypeno` int(3) NOT NULL AUTO_INCREMENT,
  `roomtypename` varchar(50) NOT NULL,
  `roomtypeamount` double(7,2) NOT NULL,
  PRIMARY KEY (`roomtypeno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `m_roomtype`
--

INSERT INTO `m_roomtype` (`roomtypeno`, `roomtypename`, `roomtypeamount`) VALUES
(3, 'BASIC', 500.00),
(4, 'DELUXE', 1325.00),
(5, 'SEMIDELUXE', 2500.00);

-- --------------------------------------------------------

--
-- Table structure for table `m_testtype`
--

CREATE TABLE IF NOT EXISTS `m_testtype` (
  `testtypeno` int(3) NOT NULL,
  `testtypename` varchar(50) NOT NULL,
  `testno` int(3) NOT NULL,
  `testamount` int(5) NOT NULL,
  `flimtype` varchar(20) NOT NULL,
  PRIMARY KEY (`testtypeno`),
  KEY `testtypeno` (`testtypeno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_testtype`
--

INSERT INTO `m_testtype` (`testtypeno`, `testtypename`, `testno`, `testamount`, `flimtype`) VALUES
(1, 'ECG', 1, 150, 'NONE'),
(2, 'ABDOMEN AP', 2, 200, '15*12'),
(3, 'ABDOMEN AP WARMER', 2, 100, '12*10'),
(4, 'ABDOMEN ERRECT', 2, 200, '15*12'),
(5, 'ANKLE JOINT AP', 2, 130, '12*10'),
(6, 'ANKLE JOINT AP LAT', 2, 200, '12*10'),
(7, 'BARIUM ENEMA ', 2, 130, '15*12'),
(8, 'BARIUM MEAL', 2, 130, '15*12'),
(9, 'C1C2 JOINT AP', 2, 130, '15*12'),
(10, 'CALCANEUS-DIRECT', 2, 130, '12*10'),
(11, 'CERVICAL SPINE AP', 2, 130, '12*10'),
(12, 'CERVICAL SPINE AP .LAT', 2, 300, '12*10'),
(13, 'CHEST & KNEE AP (WARMER)', 2, 100, '12*10'),
(14, 'CHEST  (P)', 2, 80, '12*10'),
(15, 'CHEST (WARMER)', 2, 100, '12*10'),
(16, 'CHEST AP', 2, 200, '15*12'),
(17, 'CHEST PA', 2, 200, '15*12'),
(18, 'CHEST PA .LAT', 2, 300, '15*12'),
(19, 'CLAVICLE.AP', 2, 130, '15*12'),
(20, 'ELBOW JOINT AP', 2, 130, '12*10'),
(21, 'ELBOW JOINT AP .LAT', 2, 130, '12*10'),
(22, 'FEMUR AP', 2, 130, '12*10'),
(23, 'FEMUR AP, LAT', 2, 130, '12*10'),
(24, 'FOOT AP ', 2, 130, '12*10'),
(25, 'FOOT AP LAT', 2, 130, '12*10'),
(26, 'FOOT AP OBLIQUE', 2, 200, '12*10'),
(27, 'FOREARM AP', 2, 130, '12*10'),
(28, 'FOREARM AP ,LAT', 2, 130, '12*10'),
(29, 'HAND AP', 2, 130, '12*10'),
(30, 'HAND AP ,LAT', 2, 130, '12*10'),
(31, 'HAND ,AP ,OBLIQUE ', 2, 130, '12*10'),
(32, 'HIP AP', 2, 130, '15*12'),
(33, 'HIP AP , LAT', 2, 300, '15*12'),
(34, 'HSG ', 2, 1000, '12*10'),
(35, 'HUMEROUS AP ', 2, 130, '12*10'),
(36, 'HUMEROUS AP  ,LAT', 2, 130, '12*10'),
(37, 'INVERTOGRAM ', 2, 130, '12*10'),
(38, 'IVP', 2, 130, '15*12'),
(39, 'KNEE JOINT AP , LAT', 2, 200, '15*12'),
(40, 'KNEE JOINT AP ', 2, 130, '12*10'),
(41, 'KUB', 2, 200, '15*12'),
(42, 'LS.SPINE ,AP,LAT', 2, 300, '15*12'),
(43, 'LOWER LEG AP ,LAT', 2, 200, '15*12'),
(44, 'LOWER LEG AP ', 2, 130, '12*10'),
(45, 'PATELLA SKYLINE VIEW ', 2, 130, '12*10'),
(46, 'PELVIS AP ,', 2, 200, '15*12'),
(47, 'PELVIS AP, LAT', 2, 300, '15*12'),
(48, 'PNS', 2, 200, '12*10'),
(49, 'SACROM C COCCYX AP', 2, 130, '15*12'),
(50, 'SACROM C COCCYX AP  ,LAT', 2, 230, '15*12'),
(51, 'SCAPOLLA , PA', 2, 130, '12*10'),
(52, 'SHOULDER AP ', 2, 130, '12*10'),
(53, 'SKULL  AP', 2, 130, '12*10'),
(54, 'SKULL  AP  ,LAT', 2, 300, '12*10'),
(55, 'STANDING KNEE AP ', 2, 130, '12*10'),
(56, 'STANDING KNEE AP ,LAT', 2, 130, '15*12'),
(57, 'STERNUM AP ', 2, 130, '15*12'),
(58, 'STERNUM AP LAT', 2, 230, '15*12'),
(59, 'THORACIC SPINE AP', 2, 130, '15*12'),
(60, 'THORACIC SPINE AP ,LAT', 2, 300, '15*12'),
(61, 'WRIST AP', 2, 130, '12*10'),
(62, 'WRIST AP ,LAT', 2, 130, '12*10'),
(63, 'ANC', 3, 500, 'NONE'),
(64, 'ANC TWINS ', 3, 700, 'NONE'),
(65, '4D ANC SCAN', 3, 1200, 'NONE'),
(66, 'ANC DOPPLER', 3, 1000, 'NONE'),
(67, 'ABDOMEN & PELVIS SCAN', 3, 600, 'NONE'),
(68, 'PELVIS SCAN', 3, 500, 'NONE'),
(69, 'BREAST SCAN', 3, 500, 'NONE'),
(70, 'THYROID SCAN', 3, 500, 'NONE'),
(71, 'NEW BORN SCAN ', 3, 500, 'NONE'),
(72, 'SCROTAL SCAN', 3, 1000, 'NONE'),
(73, 'DOPPLER ONE LEG ', 3, 750, 'NONE'),
(74, 'DOPPLER BOTH LEG', 3, 1500, 'NONE'),
(75, 'SSG', 3, 1200, 'NONE'),
(76, 'LIQUOR  & FH SCAN', 3, 200, 'NONE'),
(77, 'GA & FH ', 3, 200, 'NONE'),
(78, 'PRODUCTS SCAN', 3, 200, 'NONE'),
(79, 'FS ', 3, 200, 'NONE'),
(80, 'CYST SIZE', 3, 200, 'NONE'),
(81, 'PELVIS  ( FS)', 3, 500, 'NONE'),
(82, 'VIABILITY ', 3, 200, 'NONE'),
(83, 'TEST', 2, 1500, '15*12'),
(84, 'INJECTION', 1, 253, 'NONE');

-- --------------------------------------------------------

--
-- Table structure for table `t_admission`
--

CREATE TABLE IF NOT EXISTS `t_admission` (
  `admissionno` int(10) NOT NULL AUTO_INCREMENT,
  `patientid` int(10) NOT NULL,
  `admissionarea` varchar(25) NOT NULL,
  `casetypeno` int(3) NOT NULL,
  `roomtypeno` int(3) NOT NULL,
  `roomno` int(3) NOT NULL,
  `advanceamount` double(8,2) NOT NULL,
  PRIMARY KEY (`admissionno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `t_admission`
--

INSERT INTO `t_admission` (`admissionno`, `patientid`, `admissionarea`, `casetypeno`, `roomtypeno`, `roomno`, `advanceamount`) VALUES
(1, 1, 'Room', 1, 3, 1, 25.00);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
