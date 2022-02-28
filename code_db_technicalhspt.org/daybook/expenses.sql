-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql100.byethost32.com
-- Generation Time: Dec 19, 2014 at 11:07 AM
-- Server version: 5.6.21-70.1
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b32_14110656_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `date` date NOT NULL,
  `salary` int(11) NOT NULL,
  `salary1` varchar(50) NOT NULL,
  `salary2` varchar(50) NOT NULL,
  `esi` int(11) NOT NULL,
  `esi1` varchar(50) NOT NULL,
  `esi2` varchar(50) NOT NULL,
  `pf` int(11) NOT NULL,
  `pf1` varchar(50) NOT NULL,
  `pf2` varchar(50) NOT NULL,
  `eb` int(11) NOT NULL,
  `eb1` varchar(50) NOT NULL,
  `eb2` varchar(50) NOT NULL,
  `telephone` int(11) NOT NULL,
  `telephone1` varchar(50) NOT NULL,
  `telephone2` varchar(50) NOT NULL,
  `hspinstmaint` int(11) NOT NULL,
  `hspinstmaint1` varchar(50) NOT NULL,
  `hspinstmaint2` varchar(50) NOT NULL,
  `interdeptexp` int(11) NOT NULL,
  `interdeptexp1` varchar(50) NOT NULL,
  `interdeptexp2` varchar(50) NOT NULL,
  `hsptservice` int(11) NOT NULL,
  `hsptservice1` varchar(50) NOT NULL,
  `hsptservice2` varchar(50) NOT NULL,
  `ac` int(11) NOT NULL,
  `ac1` varchar(50) NOT NULL,
  `ac2` varchar(50) NOT NULL,
  `plumber` int(11) NOT NULL,
  `plumber1` varchar(50) NOT NULL,
  `plumber2` varchar(50) NOT NULL,
  `petrol` int(11) NOT NULL,
  `petrol1` varchar(50) NOT NULL,
  `petrol2` varchar(50) NOT NULL,
  `medical` int(11) NOT NULL,
  `medical1` varchar(50) NOT NULL,
  `medical2` varchar(50) NOT NULL,
  `cleaning` int(11) NOT NULL,
  `cleaning1` varchar(50) NOT NULL,
  `cleaning2` varchar(50) NOT NULL,
  `dobby` int(11) NOT NULL,
  `dobby1` varchar(50) NOT NULL,
  `dobby2` varchar(50) NOT NULL,
  `pharmacy` int(11) NOT NULL,
  `pharmacy1` varchar(50) NOT NULL,
  `pharmacy2` varchar(50) NOT NULL,
  `gas` int(11) NOT NULL,
  `gas1` varchar(50) NOT NULL,
  `gas2` varchar(50) NOT NULL,
  `compservice` int(11) NOT NULL,
  `compservice1` varchar(50) NOT NULL,
  `compservice2` varchar(50) NOT NULL,
  `incentive` int(10) NOT NULL,
  `incentive1` varchar(100) NOT NULL,
  `incentive2` varchar(100) NOT NULL,
  `insurance` int(10) NOT NULL,
  `insurance1` varchar(100) NOT NULL,
  `insurance2` varchar(100) NOT NULL,
  `civil` int(10) NOT NULL,
  `civil1` varchar(100) NOT NULL,
  `civil2` varchar(100) NOT NULL,
  `electrical` int(10) NOT NULL,
  `electrical1` varchar(100) NOT NULL,
  `electrical2` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`date`, `salary`, `salary1`, `salary2`, `esi`, `esi1`, `esi2`, `pf`, `pf1`, `pf2`, `eb`, `eb1`, `eb2`, `telephone`, `telephone1`, `telephone2`, `hspinstmaint`, `hspinstmaint1`, `hspinstmaint2`, `interdeptexp`, `interdeptexp1`, `interdeptexp2`, `hsptservice`, `hsptservice1`, `hsptservice2`, `ac`, `ac1`, `ac2`, `plumber`, `plumber1`, `plumber2`, `petrol`, `petrol1`, `petrol2`, `medical`, `medical1`, `medical2`, `cleaning`, `cleaning1`, `cleaning2`, `dobby`, `dobby1`, `dobby2`, `pharmacy`, `pharmacy1`, `pharmacy2`, `gas`, `gas1`, `gas2`, `compservice`, `compservice1`, `compservice2`, `incentive`, `incentive1`, `incentive2`, `insurance`, `insurance1`, `insurance2`, `civil`, `civil1`, `civil2`, `electrical`, `electrical1`, `electrical2`) VALUES
('2014-11-30', 636147, '', '', 30216, '', '', 85424, '', '', 174064, '', '174064', 4892, '', '', 37625, '', '', 23414, '', '', 57736, '', '', 0, '', '', 4800, '', '', 26935, '', '', 24740, '', '', 17670, '', '', 0, '', '', 26114, '', '', 1325, '', '', 13518, '', '', 0, '', '', 0, '', '', 0, '', '', 15104, '', ''),
('0000-00-00', 0, '', '', 0, '', '', 0, '', '', 0, '', '0', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
