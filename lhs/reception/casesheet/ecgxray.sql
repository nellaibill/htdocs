-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2015 at 03:49 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecgxray`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `doctorno` int(3) NOT NULL,
  `ecgxraytype` int(3) NOT NULL,
  `ecgflimtype` varchar(25) NOT NULL,
  `ecgsection` varchar(25) NOT NULL,
  `testtypeno` int(4) NOT NULL,
  `v_txno` tinyint(1) NOT NULL,
  `v_date` tinyint(1) NOT NULL,
  `v_section` tinyint(1) NOT NULL,
  `v_age` tinyint(1) NOT NULL,
  `v_doctorno` tinyint(1) NOT NULL,
  `v_filmtype` tinyint(1) NOT NULL,
  `v_createdason` tinyint(1) NOT NULL,
  `v_updatedason` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`fromdate`, `todate`, `doctorno`, `ecgxraytype`, `ecgflimtype`, `ecgsection`, `testtypeno`, `v_txno`, `v_date`, `v_section`, `v_age`, `v_doctorno`, `v_filmtype`, `v_createdason`, `v_updatedason`) VALUES
('2015-12-02', '2015-12-03', 0, 0, '0', '0', 0, 1, 0, 1, 1, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_doctor`
--

CREATE TABLE IF NOT EXISTS `m_doctor` (
  `doctorno` int(3) NOT NULL,
  `doctorname` varchar(50) NOT NULL,
  `specialist` varchar(50) NOT NULL,
  `status` varchar(25) NOT NULL,
  `mobileno` bigint(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `color` varchar(25) NOT NULL,
  PRIMARY KEY (`doctorno`),
  KEY `doctorno` (`doctorno`),
  KEY `doctorno_2` (`doctorno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_doctor`
--

INSERT INTO `m_doctor` (`doctorno`, `doctorname`, `specialist`, `status`, `mobileno`, `address`, `color`) VALUES
(1, 'SAL', 'DNA', 'VISITING', 0, '', '#808080'),
(2, 'DODO', '', 'VISITING', 0, '', '#ffff00');

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
-- Table structure for table `m_test`
--

CREATE TABLE IF NOT EXISTS `m_test` (
  `testno` int(3) NOT NULL,
  `testname` varchar(25) NOT NULL,
  PRIMARY KEY (`testno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_test`
--

INSERT INTO `m_test` (`testno`, `testname`) VALUES
(1, 'ECG'),
(2, 'X-RAY'),
(3, 'SCAN'),
(4, 'LAB');

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
-- Table structure for table `t_ecgxraybilling`
--

CREATE TABLE IF NOT EXISTS `t_ecgxraybilling` (
  `txno` bigint(10) NOT NULL,
  `patientid` bigint(10) NOT NULL,
  `date` date NOT NULL,
  `section` varchar(100) NOT NULL,
  `saluation` varchar(5) NOT NULL,
  `patientname` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `dmy` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `doctorno` int(3) NOT NULL,
  `flimtype` varchar(100) NOT NULL,
  `testno` int(3) NOT NULL,
  `testtypeno` int(3) NOT NULL,
  `testamount` int(5) NOT NULL,
  `createdason` datetime NOT NULL,
  `updatedason` datetime NOT NULL,
  PRIMARY KEY (`txno`),
  KEY `testtypeno` (`testtypeno`),
  KEY `doctorno` (`doctorno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_ecgxraybilling`
--

INSERT INTO `t_ecgxraybilling` (`txno`, `patientid`, `date`, `section`, `saluation`, `patientname`, `age`, `dmy`, `gender`, `doctorno`, `flimtype`, `testno`, `testtypeno`, `testamount`, `createdason`, `updatedason`) VALUES
(1, 0, '2015-12-03', 'OP', 'BABY.', 'IRGFAN', 23, 'YEARS', 'MALE', 1, 'NONE', 0, 1, 150, '2015-12-03 15:25:19', '2015-12-03 15:52:18'),
(2, 0, '2015-12-03', 'NEWBORN', 'BABY.', 'FRRROUI', 6, 'DAYS', 'MALE', 2, '12*10', 0, 51, 130, '2015-12-03 15:40:22', '2015-12-03 15:40:22'),
(3, 0, '2015-12-03', 'OP', 'MR.', 'A.THAMEEM IRFAN ', 19, 'YEARS', 'MALE', 1, 'NONE', 0, 1, 150, '2015-12-03 15:41:19', '2015-12-03 15:41:19'),
(4, 0, '2015-12-03', 'WARD', 'BABY.', 'THALJ', 15, 'YEARS', 'MALE', 1, '15*12', 0, 2, 200, '2015-12-03 15:42:05', '2015-12-03 15:49:17'),
(5, 0, '2015-12-03', 'OP', 'BABY.', 'NKLJKLJ', 22, 'DAYS', 'MALE', 1, '12*10', 0, 29, 130, '2015-12-03 15:50:42', '2015-12-03 15:50:42'),
(6, 0, '2015-12-03', 'OP', 'MRS.', 'DARLI', 25, 'MONTHS', 'MALE', 2, '15*12', 0, 2, 200, '2015-12-03 15:54:58', '2015-12-03 15:54:58'),
(7, 0, '2015-12-03', 'OP', 'BABY.', 'QWEDQ', 20, 'MONTHS', 'MALE', 1, '12*10', 0, 3, 100, '2015-12-03 15:55:16', '2015-12-03 15:55:16');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_ecgxraybilling`
--
ALTER TABLE `t_ecgxraybilling`
  ADD CONSTRAINT `fkey_doctorno` FOREIGN KEY (`doctorno`) REFERENCES `m_doctor` (`doctorno`),
  ADD CONSTRAINT `fkey_testtype` FOREIGN KEY (`testtypeno`) REFERENCES `m_testtype` (`testtypeno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
