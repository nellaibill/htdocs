-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2015 at 07:55 PM
-- Server version: 5.5.34-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lakshmih_daybook`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `date` date NOT NULL,
  `salary` int(11) NOT NULL,
  `salary1` varchar(200) NOT NULL,
  `salary2` varchar(200) NOT NULL,
  `esi` int(11) NOT NULL,
  `esi1` varchar(200) NOT NULL,
  `esi2` varchar(200) NOT NULL,
  `pf` int(11) NOT NULL,
  `pf1` varchar(200) NOT NULL,
  `pf2` varchar(200) NOT NULL,
  `eb` int(11) NOT NULL,
  `eb1` varchar(200) NOT NULL,
  `eb2` varchar(200) NOT NULL,
  `telephone` int(11) NOT NULL,
  `telephone1` varchar(200) NOT NULL,
  `telephone2` varchar(200) NOT NULL,
  `hspinstmaint` int(11) NOT NULL,
  `hspinstmaint1` varchar(200) NOT NULL,
  `hspinstmaint2` varchar(200) NOT NULL,
  `interdeptexp` int(11) NOT NULL,
  `interdeptexp1` varchar(200) NOT NULL,
  `interdeptexp2` varchar(200) NOT NULL,
  `hsptservice` int(11) NOT NULL,
  `hsptservice1` varchar(200) NOT NULL,
  `hsptservice2` varchar(200) NOT NULL,
  `ac` int(11) NOT NULL,
  `ac1` varchar(200) NOT NULL,
  `ac2` varchar(200) NOT NULL,
  `plumber` int(11) NOT NULL,
  `plumber1` varchar(200) NOT NULL,
  `plumber2` varchar(200) NOT NULL,
  `petrol` int(11) NOT NULL,
  `petrol1` varchar(200) NOT NULL,
  `petrol2` varchar(200) NOT NULL,
  `medical` int(11) NOT NULL,
  `medical1` varchar(200) NOT NULL,
  `medical2` varchar(200) NOT NULL,
  `cleaning` int(11) NOT NULL,
  `cleaning1` varchar(200) NOT NULL,
  `cleaning2` varchar(200) NOT NULL,
  `dobby` int(11) NOT NULL,
  `dobby1` varchar(200) NOT NULL,
  `dobby2` varchar(200) NOT NULL,
  `pharmacy` int(11) NOT NULL,
  `pharmacy1` varchar(200) NOT NULL,
  `pharmacy2` varchar(200) NOT NULL,
  `gas` int(11) NOT NULL,
  `gas1` varchar(200) NOT NULL,
  `gas2` varchar(200) NOT NULL,
  `compservice` int(11) NOT NULL,
  `compservice1` varchar(200) NOT NULL,
  `compservice2` varchar(200) NOT NULL,
  `incentive` int(10) NOT NULL,
  `incentive1` varchar(200) NOT NULL,
  `incentive2` varchar(200) NOT NULL,
  `insurance` int(10) NOT NULL,
  `insurance1` varchar(200) NOT NULL,
  `insurance2` varchar(200) NOT NULL,
  `civil` int(10) NOT NULL,
  `civil1` varchar(200) NOT NULL,
  `civil2` varchar(200) NOT NULL,
  `electrical` int(10) NOT NULL,
  `electrical1` varchar(200) NOT NULL,
  `electrical2` varchar(200) NOT NULL,
  `others` int(15) NOT NULL,
  `others1` varchar(200) NOT NULL,
  `others2` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`date`, `salary`, `salary1`, `salary2`, `esi`, `esi1`, `esi2`, `pf`, `pf1`, `pf2`, `eb`, `eb1`, `eb2`, `telephone`, `telephone1`, `telephone2`, `hspinstmaint`, `hspinstmaint1`, `hspinstmaint2`, `interdeptexp`, `interdeptexp1`, `interdeptexp2`, `hsptservice`, `hsptservice1`, `hsptservice2`, `ac`, `ac1`, `ac2`, `plumber`, `plumber1`, `plumber2`, `petrol`, `petrol1`, `petrol2`, `medical`, `medical1`, `medical2`, `cleaning`, `cleaning1`, `cleaning2`, `dobby`, `dobby1`, `dobby2`, `pharmacy`, `pharmacy1`, `pharmacy2`, `gas`, `gas1`, `gas2`, `compservice`, `compservice1`, `compservice2`, `incentive`, `incentive1`, `incentive2`, `insurance`, `insurance1`, `insurance2`, `civil`, `civil1`, `civil2`, `electrical`, `electrical1`, `electrical2`, `others`, `others1`, `others2`) VALUES
('2014-11-30', 636147, '', '', 30216, '', '', 85424, '', '', 174064, '', '', 4892, '', '', 37625, '', '', 23414, '', '', 57736, '', '', 0, '', '', 4800, '', '', 26935, '', '', 24740, '', '', 17670, '', '', 0, '', '', 26114, '', '', 1325, '', '', 13518, '', '', 16695, '', '', 0, '', '', 0, '', '', 15104, '', '', 0, '', ''),
('2014-11-25', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 25000, 'IMA', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 22000, 'SUN TROP', 'SOLAR WATER HEATER', 0, '', '', 0, '', ''),
('2014-11-20', 300000, 'PARTNERS SALARY', '', 0, '', '', 0, '', '', 0, '', '0', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 66700, 'HONDA CITY CAR SERVICE AND BATTERY PURCHASE', '', 0, '', ''),
('2014-12-03', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 10221, 'GENERATOR DIESEL', '180 LITRES', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-11-15', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 34500, 'R.RENERGY', 'ON LINE UPS O.T', 0, '', ''),
('2014-12-18', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 1000, 'honda car petrol ', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-19', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 3000, 'madan p.f accu', '', 4300, 'kwality cool', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 3000, 'nathan', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 7200, 'venous glsss work', '', 0, '', '', 0, '', ''),
('2014-12-20', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 13050, '1500 monitor bpcuff 2100 akas sensor 9450 n.bmonit', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 13000, 'LABOUR WARD BLOCK TERRACE TILES', '', 0, '', '', 0, '', ''),
('2014-12-21', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 625, 'staff tiffin', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 1960, '70 lit phenoyl', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-24', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 1221, 'PURCHASE LAP CHOLE CLIP', '4 Nos 1-Nos-305Rs', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 9832, 'GENERATOR DIESEL', '180LITRES', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-10', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 28464, 'SECURITYSERVICE,GROSSARY,GARBAGEREMOVAL', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-15', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 25465, 'BIOMEDICAL WASTE ,LAUNDRY', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-07', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 1000, 'HONDA CITY PETROL', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-13', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 4000, '3000 VOLVO DIESEL', '1000 PETROL HONDA', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-26', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 1000, 'petrol honda city', '', 0, '', '', 2220, 'nambi chemicals', '', 0, '', '', 0, '', '', 0, '', '', 8225, '1900= scan tvs bar  code printer,350 = reception canon printer ', '5725=external hard disk,antiviruses 250= labour charges', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-29', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 1500, 'volvo car disel  27.74lit', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 773, 'house grocciers', ''),
('2014-12-31', 342282, 'staff monthly salary', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-30', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 2500, 'trazogram hsgdye', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 4750, '4000 screen purchase,750 courier', '');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE IF NOT EXISTS `income` (
  `date` date NOT NULL,
  `ip` int(11) NOT NULL,
  `op` int(11) NOT NULL,
  `lab` int(11) NOT NULL,
  `scan` int(11) NOT NULL,
  `xray` int(11) NOT NULL,
  `ecg` int(11) NOT NULL,
  `others` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`date`, `ip`, `op`, `lab`, `scan`, `xray`, `ecg`, `others`) VALUES
('2014-12-01', 91631, 0, 0, 10250, 0, 2260, 0),
('2014-12-03', 52011, 0, 0, 8650, 0, 1310, 0),
('2014-12-02', 24185, 0, 0, 4250, 0, 1310, 0),
('2014-12-04', 37755, 0, 0, 3950, 0, 2010, 0),
('2014-12-05', 83750, 0, 0, 2550, 0, 2110, 0),
('2014-12-06', 101350, 0, 0, 4850, 0, 750, 50),
('2014-12-07', 63825, 0, 0, 0, 0, 280, 100),
('2014-12-08', 47300, 0, 0, 10050, 0, 1410, 0),
('2014-12-10', 26308, 0, 0, 7300, 0, 2060, 0),
('2014-12-09', 69010, 0, 0, 7350, 0, 3410, 0),
('2014-12-11', 53077, 0, 0, 8600, 0, 1730, 50),
('2014-12-15', 67451, 0, 0, 7050, 0, 1400, 0),
('2014-12-16', 37760, 0, 0, 3500, 0, 2540, 0),
('2014-12-13', 19830, 0, 0, 5850, 0, 2190, 0),
('2014-12-14', 8165, 0, 0, 0, 0, 810, 0),
('2014-12-12', 67400, 0, 0, 5550, 0, 1300, 0),
('2014-12-17', 60816, 0, 0, 5600, 0, 1960, 0),
('2014-12-18', 153488, 0, 0, 6100, 0, 1710, 50),
('2014-12-19', 46800, 0, 0, 2100, 0, 2650, 0),
('2014-12-20', 62575, 0, 0, 7150, 0, 2070, 0),
('2014-12-21', 48015, 0, 0, 300, 0, 0, 50),
('2014-12-23', 167470, 0, 0, 5400, 0, 1030, 0),
('2014-12-22', 91900, 0, 0, 8350, 0, 1990, 0),
('2014-12-24', 57533, 0, 0, 6750, 0, 750, 0),
('2014-12-25', 99850, 0, 0, 5100, 0, 1330, 50),
('2014-12-26', 188505, 0, 0, 6450, 0, 1330, 0),
('2014-12-27', 2750, 0, 0, 4650, 0, 900, 0),
('2014-12-28', 88345, 0, 0, 0, 0, 560, 0),
('2014-12-29', 51380, 0, 0, 5700, 0, 410, 0),
('2014-12-31', 123880, 0, 0, 4700, 0, 1260, 0),
('2015-01-01', 3520, 0, 0, 500, 0, 480, 0),
('2014-12-30', 105550, 0, 0, 4700, 0, 1570, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin', 'abhey'),
('admin', 'abhay');

-- --------------------------------------------------------

--
-- Table structure for table `xexpenses`
--

CREATE TABLE IF NOT EXISTS `xexpenses` (
  `date` date NOT NULL,
  `salary` int(11) NOT NULL,
  `salary1` varchar(200) NOT NULL,
  `salary2` varchar(200) NOT NULL,
  `esi` int(11) NOT NULL,
  `esi1` varchar(200) NOT NULL,
  `esi2` varchar(200) NOT NULL,
  `pf` int(11) NOT NULL,
  `pf1` varchar(200) NOT NULL,
  `pf2` varchar(200) NOT NULL,
  `eb` int(11) NOT NULL,
  `eb1` varchar(200) NOT NULL,
  `eb2` varchar(200) NOT NULL,
  `telephone` int(11) NOT NULL,
  `telephone1` varchar(200) NOT NULL,
  `telephone2` varchar(200) NOT NULL,
  `hspinstmaint` int(11) NOT NULL,
  `hspinstmaint1` varchar(200) NOT NULL,
  `hspinstmaint2` varchar(200) NOT NULL,
  `interdeptexp` int(11) NOT NULL,
  `interdeptexp1` varchar(200) NOT NULL,
  `interdeptexp2` varchar(200) NOT NULL,
  `hsptservice` int(11) NOT NULL,
  `hsptservice1` varchar(200) NOT NULL,
  `hsptservice2` varchar(200) NOT NULL,
  `ac` int(11) NOT NULL,
  `ac1` varchar(200) NOT NULL,
  `ac2` varchar(200) NOT NULL,
  `plumber` int(11) NOT NULL,
  `plumber1` varchar(200) NOT NULL,
  `plumber2` varchar(200) NOT NULL,
  `petrol` int(11) NOT NULL,
  `petrol1` varchar(200) NOT NULL,
  `petrol2` varchar(200) NOT NULL,
  `medical` int(11) NOT NULL,
  `medical1` varchar(200) NOT NULL,
  `medical2` varchar(200) NOT NULL,
  `cleaning` int(11) NOT NULL,
  `cleaning1` varchar(200) NOT NULL,
  `cleaning2` varchar(200) NOT NULL,
  `dobby` int(11) NOT NULL,
  `dobby1` varchar(200) NOT NULL,
  `dobby2` varchar(200) NOT NULL,
  `pharmacy` int(11) NOT NULL,
  `pharmacy1` varchar(200) NOT NULL,
  `pharmacy2` varchar(200) NOT NULL,
  `gas` int(11) NOT NULL,
  `gas1` varchar(200) NOT NULL,
  `gas2` varchar(200) NOT NULL,
  `compservice` int(11) NOT NULL,
  `compservice1` varchar(200) NOT NULL,
  `compservice2` varchar(200) NOT NULL,
  `incentive` int(10) NOT NULL,
  `incentive1` varchar(200) NOT NULL,
  `incentive2` varchar(200) NOT NULL,
  `insurance` int(10) NOT NULL,
  `insurance1` varchar(200) NOT NULL,
  `insurance2` varchar(200) NOT NULL,
  `civil` int(10) NOT NULL,
  `civil1` varchar(200) NOT NULL,
  `civil2` varchar(200) NOT NULL,
  `electrical` int(10) NOT NULL,
  `electrical1` varchar(200) NOT NULL,
  `electrical2` varchar(200) NOT NULL,
  `others` int(15) NOT NULL,
  `others1` varchar(200) NOT NULL,
  `others2` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xexpenses`
--

INSERT INTO `xexpenses` (`date`, `salary`, `salary1`, `salary2`, `esi`, `esi1`, `esi2`, `pf`, `pf1`, `pf2`, `eb`, `eb1`, `eb2`, `telephone`, `telephone1`, `telephone2`, `hspinstmaint`, `hspinstmaint1`, `hspinstmaint2`, `interdeptexp`, `interdeptexp1`, `interdeptexp2`, `hsptservice`, `hsptservice1`, `hsptservice2`, `ac`, `ac1`, `ac2`, `plumber`, `plumber1`, `plumber2`, `petrol`, `petrol1`, `petrol2`, `medical`, `medical1`, `medical2`, `cleaning`, `cleaning1`, `cleaning2`, `dobby`, `dobby1`, `dobby2`, `pharmacy`, `pharmacy1`, `pharmacy2`, `gas`, `gas1`, `gas2`, `compservice`, `compservice1`, `compservice2`, `incentive`, `incentive1`, `incentive2`, `insurance`, `insurance1`, `insurance2`, `civil`, `civil1`, `civil2`, `electrical`, `electrical1`, `electrical2`, `others`, `others1`, `others2`) VALUES
('2014-11-30', 636147, '', '', 30216, '', '', 85424, '', '', 174064, '', '', 4892, '', '', 37625, '', '', 23414, '', '', 57736, '', '', 0, '', '', 4800, '', '', 26935, '', '', 24740, '', '', 17670, '', '', 0, '', '', 26114, '', '', 1325, '', '', 13518, '', '', 16695, '', '', 0, '', '', 0, '', '', 15104, '', '', 0, '', ''),
('2014-11-25', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 25000, 'IMA', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 22000, 'SUN TROP', 'SOLAR WATER HEATER', 0, '', '', 0, '', ''),
('2014-11-20', 300000, 'PARTNERS SALARY', '', 0, '', '', 0, '', '', 0, '', '0', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 66700, 'HONDA CITY CAR SERVICE AND BATTERY PURCHASE', '', 0, '', ''),
('2014-12-03', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 10221, 'GENERATOR DIESEL', '180 LITRES', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-11-15', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 34500, 'R.RENERGY', 'ON LINE UPS O.T', 0, '', ''),
('2014-12-18', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 1000, 'honda car petrol ', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-19', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 3000, 'madan p.f accu', '', 4300, 'kwality cool', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 3000, 'nathan', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 7200, 'venous glsss work', '', 0, '', '', 0, '', ''),
('2014-12-20', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 13050, '1500 monitor bpcuff 2100 akas sensor 9450 n.bmonit', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 13000, 'LABOUR WARD BLOCK TERRACE TILES', '', 0, '', '', 0, '', ''),
('2014-12-21', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 625, 'staff tiffin', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 1960, '70 lit phenoyl', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-24', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 1221, 'PURCHASE LAP CHOLE CLIP', '4 Nos 1-Nos-305Rs', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 9832, 'GENERATOR DIESEL', '180LITRES', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-10', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 28464, 'SECURITYSERVICE,GROSSARY,GARBAGEREMOVAL', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-15', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 25465, 'BIOMEDICAL WASTE ,LAUNDRY', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-07', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 1000, 'HONDA CITY PETROL', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-13', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 4000, '3000 VOLVO DIESEL', '1000 PETROL HONDA', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-26', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 1000, 'petrol honda city', '', 0, '', '', 2220, 'nambi chemicals', '', 0, '', '', 0, '', '', 0, '', '', 8225, '1900= scan tvs bar  code printer,350 = reception canon printer ', '5725=external hard disk,antiviruses 250= labour charges', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-29', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 1500, 'volvo car disel  27.74lit', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 773, 'house grocciers', ''),
('2014-12-31', 342282, 'staff monthly salary', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', ''),
('2014-12-30', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 2500, 'trazogram hsgdye', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 0, '', '', 4750, '4000 screen purchase,750 courier', '');

-- --------------------------------------------------------

--
-- Table structure for table `xincome`
--

CREATE TABLE IF NOT EXISTS `xincome` (
  `date` date NOT NULL,
  `ip` int(11) NOT NULL,
  `op` int(11) NOT NULL,
  `lab` int(11) NOT NULL,
  `scan` int(11) NOT NULL,
  `xray` int(11) NOT NULL,
  `ecg` int(11) NOT NULL,
  `others` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xincome`
--

INSERT INTO `xincome` (`date`, `ip`, `op`, `lab`, `scan`, `xray`, `ecg`, `others`) VALUES
('2014-12-01', 91631, 0, 0, 10250, 0, 2260, 0),
('2014-12-03', 52011, 0, 0, 8650, 0, 1310, 0),
('2014-12-02', 24185, 0, 0, 4250, 0, 1310, 0),
('2014-12-04', 37755, 0, 0, 3950, 0, 2010, 0),
('2014-12-05', 83750, 0, 0, 2550, 0, 2110, 0),
('2014-12-06', 101350, 0, 0, 4850, 0, 750, 50),
('2014-12-07', 63825, 0, 0, 0, 0, 280, 100),
('2014-12-08', 47300, 0, 0, 10050, 0, 1410, 0),
('2014-12-10', 26308, 0, 0, 7300, 0, 2060, 0),
('2014-12-09', 69010, 0, 0, 7350, 0, 3410, 0),
('2014-12-11', 53077, 0, 0, 8600, 0, 1730, 50),
('2014-12-15', 67451, 0, 0, 7050, 0, 1400, 0),
('2014-12-16', 37760, 0, 0, 3500, 0, 2540, 0),
('2014-12-13', 19830, 0, 0, 5850, 0, 2190, 0),
('2014-12-14', 8165, 0, 0, 0, 0, 810, 0),
('2014-12-12', 67400, 0, 0, 5550, 0, 1300, 0),
('2014-12-17', 60816, 0, 0, 5600, 0, 1960, 0),
('2014-12-18', 153488, 0, 0, 6100, 0, 1710, 50),
('2014-12-19', 46800, 0, 0, 2100, 0, 2650, 0),
('2014-12-20', 62575, 0, 0, 7150, 0, 2070, 0),
('2014-12-21', 48015, 0, 0, 300, 0, 0, 50),
('2014-12-23', 167470, 0, 0, 5400, 0, 1030, 0),
('2014-12-22', 91900, 0, 0, 8350, 0, 1990, 0),
('2014-12-24', 57533, 0, 0, 6750, 0, 750, 0),
('2014-12-25', 99850, 0, 0, 5100, 0, 1330, 50),
('2014-12-26', 188505, 0, 0, 6450, 0, 1330, 0),
('2014-12-27', 2750, 0, 0, 4650, 0, 900, 0),
('2014-12-28', 88345, 0, 0, 0, 0, 560, 0),
('2014-12-29', 51380, 0, 0, 5700, 0, 410, 0),
('2015-01-30', 105550, 0, 0, 4700, 0, 1570, 0),
('2015-01-31', 123880, 0, 0, 4700, 0, 1260, 0),
('0000-00-00', 3520, 0, 0, 500, 0, 480, 0),
('0000-00-00', 105550, 0, 0, 4700, 0, 1570, 0),
('0000-00-00', 0, 0, 0, 0, 0, 0, 0),
('2014-12-30', 105550, 0, 0, 4700, 0, 1570, 0),
('2014-12-31', 123880, 0, 0, 4700, 0, 1260, 0),
('2015-01-01', 3520, 0, 0, 500, 0, 480, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
