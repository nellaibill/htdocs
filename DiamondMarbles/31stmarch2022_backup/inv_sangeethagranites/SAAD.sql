-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2017 at 07:23 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory`
--
CREATE DATABASE IF NOT EXISTS `inventory` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `inventory`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_credit_note`
--

CREATE TABLE IF NOT EXISTS `accounts_credit_note` (
  `accounts_credit_note_id` int(11) NOT NULL,
  `ledger_no` int(11) NOT NULL,
  `credit_note_date` date NOT NULL,
  `itemno` int(11) NOT NULL,
  `qty` double(10,2) NOT NULL,
  `details` varchar(250) NOT NULL,
  `created_as_on` datetime NOT NULL,
  `updated_as_on` datetime NOT NULL,
  `logged_user` varchar(50) NOT NULL,
  PRIMARY KEY (`accounts_credit_note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_debit_note`
--

CREATE TABLE IF NOT EXISTS `accounts_debit_note` (
  `accounts_debit_note_id` int(11) NOT NULL,
  `ledger_no` int(11) NOT NULL,
  `debit_note_date` date NOT NULL,
  `itemno` int(11) NOT NULL,
  `qty` double(10,2) NOT NULL,
  `details` varchar(250) NOT NULL,
  `created_as_on` datetime NOT NULL,
  `updated_as_on` datetime NOT NULL,
  `logged_user` varchar(50) NOT NULL,
  PRIMARY KEY (`accounts_debit_note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_payment`
--

CREATE TABLE IF NOT EXISTS `accounts_payment` (
  `accounts_payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `accounts_payment_date` date NOT NULL,
  `accounts_payment_ledger_id` int(5) NOT NULL,
  `accounts_payment_amount` double(10,2) NOT NULL,
  `accounts_payment_remarks` varchar(200) NOT NULL,
  PRIMARY KEY (`accounts_payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_receipt`
--

CREATE TABLE IF NOT EXISTS `accounts_receipt` (
  `accounts_receipt_id` int(11) NOT NULL AUTO_INCREMENT,
  `accounts_receipt_date` date NOT NULL,
  `accounts_receipt_ledger_id` int(5) NOT NULL,
  `accounts_receipt_amount` double(10,2) NOT NULL,
  `accounts_receipt_remarks` varchar(200) NOT NULL,
  PRIMARY KEY (`accounts_receipt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `account_group`
--

CREATE TABLE IF NOT EXISTS `account_group` (
  `account_group_id` int(11) NOT NULL,
  `account_group_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_group`
--

INSERT INTO `account_group` (`account_group_id`, `account_group_name`) VALUES
(1, 'CAPITAL ACCOUNT'),
(2, 'CURRENT ASSETS'),
(3, 'CURRENT LIABILITIES'),
(4, 'PURCHASE ACCOUNTS'),
(5, 'SALES ACCOUNTS'),
(6, 'BRANCH/DIVISIONS'),
(7, 'FIXED ASSETS'),
(8, 'DIRECT EXPENSES'),
(9, 'DIRECT INCOMES'),
(10, 'INDIRECT EXPENSES'),
(11, 'INDIRECT INCOMES'),
(12, 'INVESTMENTS'),
(13, 'LOANS(LIABILITY)'),
(14, 'MISC.EXPENSES(ASSET)'),
(15, 'SUSPENSE ACCOUNT'),
(16, 'CASH-IN-HAND'),
(17, 'DEPOSITS(ASSETS)'),
(18, 'DUTIES & TAXES'),
(19, 'LOANS & ADVANCES (ASSET)'),
(20, 'PROVISIONS'),
(21, 'RETAINED EARNINGS'),
(22, 'SECURED LOANS'),
(23, 'STOCK-IN-HAND'),
(24, 'SUNDRY CREDITORS'),
(25, 'SUNDRY DEBTORS'),
(26, 'UNSECURED LOANS'),
(27, 'BANK ACCOUNTS'),
(28, 'BANK OD ACCOUNTS'),
(29, 'BANK OCC ACCOUNTS');

-- --------------------------------------------------------

--
-- Table structure for table `account_ledger`
--

CREATE TABLE IF NOT EXISTS `account_ledger` (
  `account_ledger_id` int(11) NOT NULL,
  `ledger_name` varchar(100) NOT NULL,
  `ledger_alias_name` varchar(100) NOT NULL,
  `ledger_undergroup_no` int(11) NOT NULL,
  `ledger_address` varchar(250) NOT NULL,
  `ledger_mobile_no` varchar(50) NOT NULL,
  `ledger_unique_no` varchar(50) NOT NULL,
  `credit_limit` double(10,2) NOT NULL,
  PRIMARY KEY (`account_ledger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE IF NOT EXISTS `backup` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `backup`
--

INSERT INTO `backup` (`id`, `date`) VALUES
(1, '2017-09-12');

-- --------------------------------------------------------

--
-- Table structure for table `config_inventory`
--

CREATE TABLE IF NOT EXISTS `config_inventory` (
  `categoryno` int(3) NOT NULL,
  `groupno` int(3) NOT NULL,
  `subgroupno` int(3) NOT NULL,
  `stockpointno` int(3) NOT NULL,
  `supplierno` int(3) NOT NULL,
  `customerno` int(5) NOT NULL,
  `itemno` int(5) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `temppurchaseqty` int(5) NOT NULL,
  `tempsalesqty` int(5) NOT NULL,
  `print_template` varchar(100) NOT NULL,
  `purchase_invoice_no` int(11) NOT NULL,
  `sales_invoice_no` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config_inventory`
--

INSERT INTO `config_inventory` (`categoryno`, `groupno`, `subgroupno`, `stockpointno`, `supplierno`, `customerno`, `itemno`, `fromdate`, `todate`, `temppurchaseqty`, `tempsalesqty`, `print_template`, `purchase_invoice_no`, `sales_invoice_no`) VALUES
(1, 1, 1, 1, 2, 5, 1, '2017-08-01', '2017-12-31', 0, 0, 'print_format6.php', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `config_sales`
--

CREATE TABLE IF NOT EXISTS `config_sales` (
  `config_sales_id` int(3) NOT NULL,
  `invoiceno` varchar(10) NOT NULL,
  `stock` varchar(10) NOT NULL,
  `gst` varchar(10) NOT NULL,
  `discount` varchar(10) NOT NULL,
  `salesperson` varchar(10) NOT NULL,
  `despatch` varchar(10) NOT NULL,
  `destination` varchar(10) NOT NULL,
  `delivery` varchar(10) NOT NULL,
  `vehicleno` varchar(10) NOT NULL,
  `service` varchar(10) NOT NULL,
  PRIMARY KEY (`config_sales_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config_sales`
--

INSERT INTO `config_sales` (`config_sales_id`, `invoiceno`, `stock`, `gst`, `discount`, `salesperson`, `despatch`, `destination`, `delivery`, `vehicleno`, `service`) VALUES
(1, 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `fmcg_doctor`
--

CREATE TABLE IF NOT EXISTS `fmcg_doctor` (
  `doctorno` int(3) NOT NULL,
  `doctorname` varchar(50) NOT NULL,
  `specialist` varchar(50) NOT NULL,
  `status` varchar(25) NOT NULL,
  `mobileno` bigint(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `color` varchar(25) NOT NULL,
  PRIMARY KEY (`doctorno`),
  KEY `doctorno` (`doctorno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fmcg_doctor`
--

INSERT INTO `fmcg_doctor` (`doctorno`, `doctorname`, `specialist`, `status`, `mobileno`, `address`, `color`) VALUES
(1, 'Dr. Srinivasan', 'MD,', 'FAMILY', 0, '', '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `inv_purchaseentry`
--

CREATE TABLE IF NOT EXISTS `inv_purchaseentry` (
  `txno` int(11) NOT NULL,
  `purchaseinvoiceno` int(10) NOT NULL,
  `itemno` int(5) NOT NULL,
  `purchasedescription` varchar(250) NOT NULL,
  `dateexpired` date NOT NULL,
  `batchid` varchar(25) NOT NULL,
  `qty` double(10,2) NOT NULL,
  `freeqty` int(5) NOT NULL,
  `currentqty` double(10,2) NOT NULL,
  `originalprice` decimal(10,2) NOT NULL,
  `sellingprice` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `nettotal` decimal(10,2) NOT NULL,
  `profit` decimal(10,2) NOT NULL,
  PRIMARY KEY (`txno`),
  KEY `itemno` (`itemno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inv_purchaseentry1`
--

CREATE TABLE IF NOT EXISTS `inv_purchaseentry1` (
  `purchaseinvoiceno` int(5) NOT NULL,
  `supplierno` int(5) NOT NULL,
  `companyinvoiceno` varchar(15) NOT NULL,
  `totalamount` double(10,2) NOT NULL,
  `date` date NOT NULL,
  `freight` double(10,2) NOT NULL,
  `others` double(10,2) NOT NULL,
  PRIMARY KEY (`purchaseinvoiceno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inv_purchase_return`
--

CREATE TABLE IF NOT EXISTS `inv_purchase_return` (
  `returndate` date NOT NULL,
  `itemno` int(5) NOT NULL,
  `inv_no` int(5) NOT NULL,
  `return_qty` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inv_salesentry`
--

CREATE TABLE IF NOT EXISTS `inv_salesentry` (
  `txno` int(11) NOT NULL,
  `salesinvoiceno` int(6) NOT NULL,
  `purchaseinvoiceno` int(5) NOT NULL,
  `purchaseinvoicetxno` int(5) NOT NULL,
  `date` date NOT NULL,
  `customerno` int(5) NOT NULL,
  `itemno` int(5) NOT NULL,
  `batchid` varchar(100) NOT NULL,
  `dateexpired` date NOT NULL,
  `qty` double(10,2) NOT NULL,
  `unitrate` double(10,2) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `vat` double(5,2) NOT NULL,
  `discountpercentage` double(10,2) NOT NULL,
  `usagestockpointno` int(3) NOT NULL,
  `usagestockdetails` varchar(100) NOT NULL,
  `createdason` datetime NOT NULL,
  `updatedason` datetime NOT NULL,
  PRIMARY KEY (`txno`,`salesinvoiceno`),
  KEY `usagestockpointno` (`usagestockpointno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inv_salesentry1`
--

CREATE TABLE IF NOT EXISTS `inv_salesentry1` (
  `salesinvoiceno` int(5) NOT NULL,
  `date` date NOT NULL,
  `customerno` int(5) NOT NULL,
  `totalamount` double(10,2) NOT NULL,
  `lessamount` double(10,2) NOT NULL,
  `despatch` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `modeofpayment` varchar(50) NOT NULL,
  `termsofdelivery` varchar(200) NOT NULL,
  `vehicleno` varchar(100) NOT NULL,
  `servicecharges` varchar(100) NOT NULL,
  `salesperson_id` int(5) NOT NULL,
  PRIMARY KEY (`salesinvoiceno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inv_sales_return`
--

CREATE TABLE IF NOT EXISTS `inv_sales_return` (
  `returndate` date NOT NULL,
  `itemno` int(5) NOT NULL,
  `inv_no` int(5) NOT NULL,
  `return_qty` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inv_stockentry`
--

CREATE TABLE IF NOT EXISTS `inv_stockentry` (
  `stockno` int(5) NOT NULL,
  `itemno` int(5) NOT NULL,
  `stock` double(10,2) NOT NULL,
  `minstock` int(5) NOT NULL,
  `maxstock` int(5) NOT NULL,
  `mrp` double(10,2) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `expdate` date NOT NULL,
  PRIMARY KEY (`stockno`),
  KEY `itemno` (`itemno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_stockentry`
--

INSERT INTO `inv_stockentry` (`stockno`, `itemno`, `stock`, `minstock`, `maxstock`, `mrp`, `batch`, `expdate`) VALUES
(1, 238, 1480.00, 0, 0, 15.00, 'OS', '0000-00-00'),
(2, 187, 1800.00, 0, 0, 10.50, 'OS', '0000-00-00'),
(3, 189, 900.00, 0, 0, 14.35, 'OS', '0000-00-00'),
(4, 191, 600.00, 0, 0, 12.00, 'OS', '0000-00-00'),
(5, 195, 400.00, 0, 0, 12.50, 'OS', '0000-00-00'),
(6, 198, 200.00, 0, 0, 18.40, 'OS', '0000-00-00'),
(7, 396, 200.00, 0, 0, 30.20, 'OS', '0000-00-00'),
(8, 199, 200.00, 0, 0, 57.40, 'OS', '0000-00-00'),
(9, 201, 200.00, 0, 0, 73.60, 'OS', '0000-00-00'),
(10, 200, 200.00, 0, 0, 92.00, 'OS', '0000-00-00'),
(11, 202, 200.00, 0, 0, 110.40, 'OS', '0000-00-00'),
(12, 242, 2000.00, 0, 0, 22.00, 'OS', '0000-00-00'),
(13, 243, 1100.00, 0, 0, 22.00, 'OS', '0000-00-00'),
(15, 239, 400.00, 0, 0, 13.80, 'OS', '0000-00-00'),
(16, 246, 600.00, 0, 0, 13.25, 'OS', '0000-00-00'),
(17, 250, 945.00, 0, 0, 11.80, 'OS', '0000-00-00'),
(18, 229, 500.00, 0, 0, 38.30, 'OS', '0000-00-00'),
(19, 244, 600.00, 0, 0, 28.00, 'OS', '0000-00-00'),
(22, 366, 300.00, 0, 0, 14.50, 'OS', '0000-00-00'),
(23, 367, 500.00, 0, 0, 22.00, 'OS', '0000-00-00'),
(25, 375, 500.00, 0, 0, 17.00, 'OS', '0000-00-00'),
(26, 376, 1050.00, 0, 0, 25.00, 'OS', '0000-00-00'),
(27, 381, 300.00, 0, 0, 59.00, 'OS', '0000-00-00'),
(28, 383, 100.00, 0, 0, 41.00, 'OS', '0000-00-00'),
(29, 384, 400.00, 0, 0, 25.00, 'OS', '0000-00-00'),
(30, 385, 200.00, 0, 0, 30.00, 'OS', '0000-00-00'),
(31, 387, 100.00, 0, 0, 66.00, 'OS', '0000-00-00'),
(32, 388, 90.00, 0, 0, 84.00, 'OS', '0000-00-00'),
(34, 393, 250.00, 0, 0, 125.00, 'OS', '0000-00-00'),
(35, 192, 950.00, 0, 0, 19.00, 'OS', '0000-00-00'),
(36, 194, 600.00, 0, 0, 10.50, 'OS', '0000-00-00'),
(37, 196, 100.00, 0, 0, 20.80, 'OS', '0000-00-00'),
(38, 248, 3000.00, 0, 0, 13.00, 'OS', '0000-00-00'),
(39, 368, 520.00, 0, 0, 20.00, 'OS', '0000-00-00'),
(40, 370, 500.00, 0, 0, 27.00, 'OS', '0000-00-00'),
(41, 371, 500.00, 0, 0, 42.00, 'OS', '0000-00-00'),
(42, 382, 500.00, 0, 0, 21.00, 'OS', '0000-00-00'),
(43, 386, 3000.00, 0, 0, 5.00, 'OS', '0000-00-00'),
(44, 373, 250.00, 0, 0, 83.00, 'OS', '0000-00-00'),
(46, 334, 230.00, 0, 0, 29.00, 'OS', '0000-00-00'),
(47, 335, 230.00, 0, 0, 29.00, 'OS', '0000-00-00'),
(48, 336, 230.00, 0, 0, 29.00, 'OS', '0000-00-00'),
(49, 337, 130.00, 0, 0, 42.00, 'OS', '0000-00-00'),
(50, 339, 130.00, 0, 0, 43.00, 'OS', '0000-00-00'),
(51, 340, 230.00, 0, 0, 58.00, 'OS', '0000-00-00'),
(52, 341, 30.00, 0, 0, 58.00, 'OS', '0000-00-00'),
(53, 342, 230.00, 0, 0, 75.00, 'OS', '0000-00-00'),
(54, 397, 50.00, 0, 0, 75.00, 'OS', '0000-00-00'),
(55, 343, 230.00, 0, 0, 75.00, 'OS', '0000-00-00'),
(56, 344, 230.00, 0, 0, 75.00, 'OS', '0000-00-00'),
(57, 345, 230.00, 0, 0, 110.00, 'OS', '0000-00-00'),
(58, 346, 230.00, 0, 0, 110.00, 'OS', '0000-00-00'),
(59, 391, 400.00, 0, 0, 67.00, 'OS', '0000-00-00'),
(60, 237, 100.00, 0, 0, 11.00, 'OS', '0000-00-00'),
(61, 230, 200.00, 0, 0, 21.00, 'OS', '0000-00-00'),
(62, 365, 300.00, 0, 0, 14.50, 'OS', '0000-00-00'),
(63, 203, 50.00, 0, 0, 36.80, 'OS', '0000-00-00'),
(64, 212, 100.00, 0, 0, 75.00, 'OS', '0000-00-00'),
(65, 213, 100.00, 0, 0, 115.20, 'OS', '0000-00-00'),
(66, 214, 40.00, 0, 0, 133.82, 'OS', '0000-00-00'),
(67, 209, 270.00, 0, 0, 81.17, 'OS', '0000-00-00'),
(68, 210, 750.00, 0, 0, 85.00, 'OS', '0000-00-00'),
(69, 259, 200.00, 0, 0, 51.20, 'OS', '0000-00-00'),
(70, 235, 600.00, 0, 0, 8.32, 'OS', '0000-00-00'),
(71, 289, 66.00, 0, 0, 140.80, 'OS', '0000-00-00'),
(72, 389, 200.00, 0, 0, 100.00, 'OS', '0000-00-00'),
(73, 398, 0.00, 0, 0, 0.00, '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `m_item`
--

CREATE TABLE IF NOT EXISTS `m_item` (
  `itemno` int(5) NOT NULL,
  `stockpointno` int(5) NOT NULL,
  `itemcategoryno` int(5) NOT NULL,
  `itemgroupno` int(5) NOT NULL,
  `itemsubgroupno` int(5) NOT NULL,
  `itemname` varchar(250) NOT NULL,
  `itemdescription` varchar(100) NOT NULL,
  `hsncode` varchar(50) NOT NULL,
  `packno` int(6) NOT NULL,
  `packdescription` varchar(100) NOT NULL,
  `gst` varchar(25) NOT NULL,
  PRIMARY KEY (`itemno`),
  UNIQUE KEY `itemname` (`itemname`),
  KEY `stockpointno` (`stockpointno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_item`
--

INSERT INTO `m_item` (`itemno`, `stockpointno`, `itemcategoryno`, `itemgroupno`, `itemsubgroupno`, `itemname`, `itemdescription`, `hsncode`, `packno`, `packdescription`, `gst`) VALUES
(31, 1, 1, 1, 0, 'BS 16030 MODULAR SOCKET 6A  2 IN ONE', '', '8536', 1, 'Pcs', '28'),
(32, 1, 1, 1, 0, 'BS 16031 MODULAR MULTI SOCKET 10A  WITH SHUTTER', '', '8536', 1, 'Pcs', '28'),
(33, 1, 1, 1, 0, 'BS 16032 MODULAR INTERNATIONAL SOCKET 6/10/13A WITH SHUTTER', '', '8536', 1, 'Pcs', '28'),
(34, 1, 1, 1, 0, 'BSBS 16033 MODULAR UNIVERSAL SOCKET 6&16A  WITH SHUTTER', '', '8536', 1, 'Pcs', '28'),
(35, 1, 1, 1, 0, 'BS 16034 MODULAR SLIM DIMMER 400 WATTS', '', '8543', 1, 'Pcs', '18'),
(36, 1, 1, 1, 0, 'BS 16035 MODULAR SLIM REGULATOR (4 STEP)', '', '8543', 1, 'Pcs', '18'),
(37, 1, 1, 1, 0, 'BS 16036 MODULAR BOLT DIMMER 600 WATTS', '', '8543', 1, 'Pcs', '18'),
(38, 1, 1, 1, 0, 'BS 16037 BOLT MODULAR REGULATOR TYPE (5 STEP)', '', '8543', 1, 'Pcs', '18'),
(39, 1, 1, 1, 0, 'BS 16038 MODULAR NEON INDICATOR (SWITCH TYPE)', '', '8531', 1, 'Pcs', '28'),
(40, 1, 1, 1, 0, 'BS 16039 MODULAR T.V.SOCKET OUTLET (SWITCH TYPE)', '', '8536', 1, 'Pcs', '28'),
(41, 1, 1, 1, 0, 'BS 16040 MODULAR BLANK PLATE', '', '8538', 1, 'Pcs', '18'),
(42, 1, 1, 1, 0, 'BS 16041 MODULAR TELEPHONE JACK (SINGLE)', '', '8536', 1, 'Pcs', '28'),
(43, 1, 1, 1, 0, 'BS 16042 TELEPHONE JACK (DOUBLE)', '', '8536', 1, 'Pcs', '28'),
(44, 1, 1, 1, 0, 'BS 16043 MODULAR RJ-45 RECEPTOR (FRAME ONLY WITH SHUTTER)', '', '8536', 1, 'Pcs', '28'),
(45, 1, 1, 1, 0, 'BS 16044 MODULAR RJ-45 COMPUTER SOCKET (CAT-5E) WITH SHUTTER', '', '8536', 1, 'Pcs', '28'),
(46, 1, 1, 1, 0, 'BS 16045 MODULAR RJ-45 COMPUTER SOCKET (CAT-6) WITH SHUTTER', '', '8536', 1, 'Pcs', '28'),
(47, 1, 1, 1, 0, 'BS 16046 MODULAR MOTOR STARTER WITH SWITCH (16/20/25/32 AMP)', '', '8536', 1, 'Pcs', '28'),
(48, 1, 1, 1, 0, 'BS 16047 MODULAR SINGLE POLE TINY TRIP MCB (6/10/16/20/25/32 AMP)', '', '8536', 1, 'Pcs', '28'),
(49, 1, 1, 1, 0, 'BS 16048 MODULAR DOUBLE POLE TINY TRIP MCB (6/10/16/20/25/32 AMP)', '', '8536', 1, 'Pcs', '28'),
(50, 1, 1, 1, 0, 'BS 16049 MODULAR BELL INDICATOR (WITH RESET SWITCH)', '', '8536', 1, 'Pcs', '28'),
(51, 1, 1, 1, 0, 'BS 16050 MODULAR SLIM ELECTRICAL BUZZER', '', '8531', 1, 'Pcs', '28'),
(52, 1, 1, 1, 0, 'BS 16051 BOLT MODULAR ELECTRICAL BUZZER', '', '8531', 1, 'Pcs', '28'),
(53, 1, 1, 1, 0, 'BS 16052 MODULAR FOOT LIGHT WITH LED', '', '8539', 1, 'Pcs', '12'),
(54, 1, 1, 1, 0, 'BS 16053 MODULAR LED NIGHT LAMP', '', '8539', 1, 'Pcs', '12'),
(55, 1, 1, 1, 0, 'BS 16101 1 MODULAR WHITE PLATE WITH BASE FRAME', '', '8538', 1, 'Pcs', '18'),
(56, 1, 1, 1, 0, 'BS 16102 2 MODULAR WHITE PLATE WITH BASE FRAME', '', '8538', 1, 'Pcs', '18'),
(57, 1, 1, 1, 0, 'BS 16103 3 MODULAR WHITE PLATE WITH BASE FRAME', '', '8538', 1, 'Pcs', '18'),
(58, 1, 1, 1, 0, 'BS 16104 4MODULAR WHITE PLATES WITH BASE FRAME', '', '8538', 1, 'Pcs', '18'),
(59, 1, 1, 1, 0, 'BS 16105 6MODULAR WHITE PLATES WITH BASE FRAME', '', '8538', 1, 'Pcs', '18'),
(60, 1, 1, 1, 0, 'BS 16106 8HZ MODULAR WHITE PLATE WITH BASE FRAME', '', '8538', 1, 'Pcs', '18'),
(61, 1, 1, 1, 0, 'BS 16107 8SQ MODULAR WHITE PLATE WITH BASE FRAME', '', '8538', 1, 'Pcs', '18'),
(62, 1, 1, 1, 0, 'BS 16108 12MODULAR WHITE PLATE WITH BASE FRAME', '', '8538', 1, 'Pcs', '18'),
(63, 1, 1, 1, 0, 'BS 16109 16MODULAR WHITE PLATE WITH BASE FRAME', '', '8538', 1, 'Pcs', '18'),
(64, 1, 1, 1, 0, 'BS 16110 18MODULAR WHITE PLATE WITH BASE FRAME', '', '8538', 1, 'Pcs', '18'),
(65, 1, 1, 1, 0, 'BSPC0X5-005 C SERIES SP MCB 240/415 VOLTS (0-5AMPS)', '', '8536', 1, 'Pcs', '28'),
(66, 1, 1, 1, 0, 'BSPC06-32 C SERIES SP MCB 240/415 VOLTS (6-32AMPS)', '', '8536', 1, 'Pcs', '28'),
(67, 1, 1, 1, 0, 'BSPC040 C SERIES SP MCB 240/415 VOLTS (40AMPS)', '', '8536', 1, 'Pcs', '28'),
(68, 1, 1, 1, 0, 'BSPC063 C SERIES SP MCB 240/415 VOLTS (63AMPS)', '', '8536', 1, 'Pcs', '28'),
(69, 1, 1, 1, 0, 'BSPNCX5-005 CSERIES SPN MCB 240/415 VOLTS (0.5-5AMPS)', '', '8536', 1, 'Pcs', '28'),
(70, 1, 1, 1, 0, 'BSPNC06-32 C SERIES SPN MCB 240/415 VOLTS (6-32AMPS)', '', '8536', 1, 'Pcs', '28'),
(71, 1, 1, 1, 0, 'BSPNC040 C SERIES SPN MCB 240/415 VOLTS (40AMPS)', '', '8536', 1, 'Pcs', '28'),
(72, 1, 1, 1, 0, 'BSPNC063 C SERIES SPN MCB 240/415 VOLTS (63AMPS)', '', '8536', 1, 'Pcs', '28'),
(73, 1, 1, 1, 0, 'BDPC0X5-005 C SERIES DP MCB 240/415 VOLTS (0.5-5AMPS)', '', '8536', 1, 'Pcs', '28'),
(74, 1, 1, 1, 0, 'BDPC06-32 C SERIES DP MCB 240/415 VOLTS (6-32AMPS)', '', '8536', 1, 'Pcs', '28'),
(75, 1, 1, 1, 0, 'BDPC040 C SERIES DP MCB 240/415 VOLTS (40AMPS)', '', '8536', 1, 'Pcs', '28'),
(76, 1, 1, 1, 0, 'BTPC0X5-005 C SERIES TP MCB 240/415 VOLTS (0.5-5AMPS)', '', '8536', 1, 'Pcs', '28'),
(77, 1, 1, 1, 0, 'BTPC06-32 C SERIES TP MCB 240/415 VOLTS (6-32AMPS)', '', '8536', 1, 'Pcs', '28'),
(78, 1, 1, 1, 0, 'BTPC040 C SERIES TP MCB 240/415 VOLTS (40AMPS)', '', '8536', 1, 'Pcs', '28'),
(79, 1, 1, 1, 0, 'BTPC063 C SERIES TP MCB 240/415 VOLTS (63AMPS)', '', '8536', 1, 'Pcs', '28'),
(80, 1, 1, 1, 0, 'BTPNC0X5-005 C SERIES TPN MCB 240/415 VOLTS (0.5-5AMPS)', '', '8536', 1, 'Pcs', '28'),
(81, 1, 1, 1, 0, 'BTPNC06-32 C SERIES TPN MCB 240/415 VOLTS (6-32AMPS)', '', '8536', 1, 'Pcs', '28'),
(82, 1, 1, 1, 0, 'BTPNC040 C SERIES TPN MCB 240/415 VOLTS (40AMPS)', '', '8536', 1, 'Pcs', '28'),
(83, 1, 1, 1, 0, 'BTPNC063 C SERIES TPN MCB 240/415 VOLTS (63AMPS)', '', '8536', 1, 'Pcs', '28'),
(84, 1, 1, 1, 0, 'BFPC0X5-005 C SERIES FP MCB 240/415 VOLTS (0.5-5AMPS)', '', '8536', 1, 'Pcs', '28'),
(85, 1, 1, 1, 0, 'BFPC06-32 CSERIES FP MCB 240/415 VOLTS (6-32AMPS)', '', '8536', 1, 'Pcs', '28'),
(86, 1, 1, 1, 0, 'BFPC040 CSERIES FP MCB 240/415 VOLTS (40AMPS)', '', '8536', 1, 'Pcs', '28'),
(87, 1, 1, 1, 0, 'BFPC063 C SERIES 240/415 VOLTS (63AMPS)', '', '8536', 1, 'Pcs', '28'),
(88, 1, 1, 1, 0, 'BDPI040 DP MCB ISOLATOR 240/415 VOLTS (40AMPS)', '', '8536', 1, 'Pcs', '28'),
(89, 1, 1, 1, 0, 'BDPI063 DP MCB ISOLATOR 240/415 VOLTS (63AMPS)', '', '8536', 1, 'Pcs', '28'),
(90, 1, 1, 1, 0, 'BDPI0100 DP MCB ISOLATOR 240/415 VOLTS (100AMPS)', '', '8536', 1, 'Pcs', '28'),
(91, 1, 1, 1, 0, 'BTPI040 TP MCB ISOLATOR 240/415 (40AMPS)', '', '8536', 1, 'Pcs', '28'),
(92, 1, 1, 1, 0, 'BTPI063 TP MCB ISOLATOR 240/415 (63AMPS)', '', '8536', 1, 'Pcs', '28'),
(93, 1, 1, 1, 0, 'BTPI0100 TP MCB ISOLATOR 240/415 (100AMPS)', '', '8536', 1, 'Pcs', '28'),
(94, 1, 1, 1, 0, 'BFPI040 FP MCB ISOLATOR 240/415 VOLTS (40AMPS)', '', '8536', 1, 'Pcs', '28'),
(95, 1, 1, 1, 0, 'BFPI063 FP MCB ISOLATOR 240/415 VOLTS (63AMPS)', '', '8536', 1, 'Pcs', '28'),
(96, 1, 1, 1, 0, 'BFPI0100 FP MCB ISOLATOR 240/415 VOLTS (100AMPS)', '', '8536', 1, 'Pcs', '28'),
(97, 1, 1, 1, 0, 'BSPTT06-32 C SERIES MINI SP MCB 240 VOLTS (6-32AMPS)', '', '8536', 1, 'Pcs', '28'),
(98, 1, 1, 1, 0, 'BDPTT06-32 C SERIES MINI DP MCB 240VOLTS (6-32AMPS)', '', '8536', 1, 'Pcs', '28'),
(99, 1, 1, 1, 0, 'BDPTTI06-32 C SERIES MINI DP ISOLATOR 240 VOLTS', '', '8536', 1, 'Pcs', '28'),
(100, 1, 1, 1, 0, 'BDPMC025 TWO WAY CENTER OFF CHANGEOVER SWITCH 25AMPS', '', '8536', 1, 'Pcs', '28'),
(101, 1, 1, 1, 0, 'BDPMC040 TWO WAY CENTER OFF CHANGEOVER SWITCH 40AMPS', '', '8536', 1, 'Pcs', '28'),
(102, 1, 1, 1, 0, 'BDPMC063 TWO WAY CENTER OFF CHANGEOVER SWITCH 63AMPS', '', '8536', 1, 'Pcs', '28'),
(103, 1, 1, 1, 0, 'BFPMC025 FOUR WAY CENTER OFF CHANGEOVER SWITCH 25AMPS', '', '8536', 1, 'Pcs', '28'),
(104, 1, 1, 1, 0, 'BFPMC040 FOUR WAY CENTER OFF CHANGEOVER SWITCH 40AMPS', '', '8536', 1, 'Pcs', '28'),
(105, 1, 1, 1, 0, 'BFPMC063 FOUR WAY CENTER OFF CHANGEOVER SWITCH 63AMPS', '', '8536', 1, 'Pcs', '28'),
(106, 1, 1, 1, 0, 'BR30DP25 RCCP DP (25AMPS) 240/415 VOLTS  (SENSITIVE 30 MILLI AMPS)', '', '8536', 1, 'Pcs', '28'),
(107, 1, 1, 1, 0, 'BR30DP32 RCCP DP (32AMPS) 240/415 VOLTS  (SENSITIVE 30 MILLI AMPS)', '', '8536', 1, 'Pcs', '28'),
(108, 1, 1, 1, 0, 'BR30DP40 RCCP DP (40AMPS) 240/415 VOLTS (SENSITIVE 30 MILLI AMPS)', '', '8536', 1, 'Pcs', '28'),
(109, 1, 1, 1, 0, 'BR30DP63 RCCP DP (63AMPS) 240/415 VOLTS (SENSITIVE 30 MILLI AMPS)', '', '8536', 1, 'Pcs', '28'),
(110, 1, 1, 1, 0, 'BR30FP25 RCCP FP (25AMPS) 240/415 VOLTS (SENSITIVE 30MILLI AMPS)', '', '8536', 1, 'Pcs', '28'),
(111, 1, 1, 1, 0, 'BR30FP32 RCCP FP (32AMPS) 240/415 VOLTS (SENSITIVE 30MILLI AMPS)', '', '8536', 1, 'Pcs', '28'),
(112, 1, 1, 1, 0, 'BR30FP40 RCCP FP (40AMPS) 240/415 VOLTS V (SENSITIVE 30MILLI AMPS)', '', '8536', 1, 'Pcs', '28'),
(113, 1, 1, 1, 0, 'BR30FP63 RCCP FP (63AMPS) 240/415 VOLTS (SENSITIVE 30MILLI AMPS)', '', '8536', 1, 'Pcs', '28'),
(114, 1, 1, 1, 0, 'BES04 MCB DB SPN(SINGLE PHASE) 4 WAYS', '', '8537', 1, 'Pcs', '28'),
(115, 1, 1, 1, 0, 'BES06 MCB DB SPN(SINGLE PHASE) 6 WAYS', '', '8537', 1, 'Pcs', '28'),
(116, 1, 1, 1, 0, 'BES08 MCB DB SPN(SINGLE PHASE) 8 WAYS', '', '8537', 1, 'Pcs', '28'),
(117, 1, 1, 1, 0, 'BES10 MCB DB SPN(SINGLE PHASE) 10 WAYS', '', '8537', 1, 'Pcs', '28'),
(118, 1, 1, 1, 0, 'BES12 MCB DB SPN(SINGLE PHASE) 12 WAYS', '', '8537', 1, 'Pcs', '28'),
(119, 1, 1, 1, 0, 'BES16 MCB DB SPN(SINGLE PHASE) 16 WAYS', '', '8537', 1, 'Pcs', '28'),
(120, 1, 1, 1, 0, 'BEA04 MCB DB SPN(SINGLE PHASE) 4 WAYS (TRANSPARENT COVER)', '', '8537', 1, 'Pcs', '28'),
(121, 1, 1, 1, 0, 'BEA06 MCB DB SPN(SINGLE PHASE) 6 WAYS (TRANSPARENT COVER)', '', '8537', 1, 'Pcs', '28'),
(122, 1, 1, 1, 0, 'BEA08 MCB DB SPN(SINGLE PHASE) 8 WAYS (TRANSPARENT COVER)', '', '8537', 1, 'Pcs', '28'),
(123, 1, 1, 1, 0, 'BEA10 MCB DB SPN(SINGLE PHASE) 8 WAYS (TRANSPARENT COVER)', '', '8537', 1, 'Pcs', '28'),
(124, 1, 1, 1, 0, 'BEA12 MCB DB SPN(SINGLE PHASE) 12 WAYS (TRANSPARENT COVER)', '', '8537', 1, 'Pcs', '28'),
(125, 1, 1, 1, 0, 'BEA16 MCB DB SPN(SINGLE PHASE) 16 WAYS (TRANSPARENT COVER)', '', '8537', 1, 'Pcs', '28'),
(126, 1, 1, 1, 0, 'BESDC04 MCB DB SPN(SINGLE PHASE) 4 WAYS DOUBLE DOOR CLASSIC LINE ', '', '8537', 1, 'Pcs', '28'),
(127, 1, 1, 1, 0, 'BESDC06 MCB DB SPN(SINGLE PHASE) 6 WAYS DOUBLE DOOR CLASSIC LINE ', '', '8537', 1, 'Pcs', '28'),
(128, 1, 1, 1, 0, 'BESDC08 MCB DB SPN(SINGLE PHASE) 8 WAYS DOUBLE DOOR CLASSIC LINE ', '', '8537', 1, 'Pcs', '28'),
(129, 1, 1, 1, 0, 'BESDC10 MCB DB SPN(SINGLE PHASE) 10 WAYS DOUBLE DOOR CLASSIC LINE ', '', '8537', 1, 'Pcs', '28'),
(130, 1, 1, 1, 0, 'BESDC12 MCB DB SPN(SINGLE PHASE) 12 WAYS DOUBLE DOOR CLASSIC LINE ', '', '8537', 1, 'Pcs', '28'),
(131, 1, 1, 1, 0, 'BESDC16 MCB DB SPN(SINGLE PHASE) 16 WAYS DOUBLE DOOR CLASSIC LINE ', '', '8537', 1, 'Pcs', '28'),
(132, 1, 1, 1, 0, 'BECU04 MCB DB BOX CONSUMER UNIT (2+04 WAYS)', '', '8537', 1, 'Pcs', '28'),
(133, 1, 1, 1, 0, 'BECU06 MCB DB BOX CONSUMER UNIT (2+06 WAYS)', '', '8537', 1, 'Pcs', '28'),
(134, 1, 1, 1, 0, 'BECU08 MCB DB BOX CONSUMER UNIT (2+08 WAYS)', '', '8537', 1, 'Pcs', '28'),
(135, 1, 1, 1, 0, 'BECU10 MCB DB BOX CONSUMER UNIT (2+10 WAYS)', '', '8537', 1, 'Pcs', '28'),
(136, 1, 1, 1, 0, 'BECU12 MCB DB BOX CONSUMER UNIT (2+12 WAYS)', '', '8537', 1, 'Pcs', '28'),
(137, 1, 1, 1, 0, 'BESD04 SMART DB 4 WAYS', '', '8537', 1, 'Pcs', '28'),
(138, 1, 1, 1, 0, 'BESD06 SMART DB 6 WAYS', '', '8537', 1, 'Pcs', '28'),
(139, 1, 1, 1, 0, 'BESD08 SMART DB 8 WAYS', '', '8537', 1, 'Pcs', '28'),
(140, 1, 1, 1, 0, 'BESD12 SMART DB 12 WAYS', '', '8537', 1, 'Pcs', '28'),
(141, 1, 1, 1, 0, 'BESD16 SMART DB 16 WAYS', '', '8537', 1, 'Pcs', '28'),
(142, 1, 1, 1, 0, 'BET04 MCB DB BOX 3 PHASE TPN SINGLE DOOR 4 WAYS', '', '8537', 1, 'Pcs', '28'),
(143, 1, 1, 1, 0, 'BET06 MCB DB BOX 3 PHASE TPN SINGLE DOOR 6 WAYS', '', '8537', 1, 'Pcs', '28'),
(144, 1, 1, 1, 0, 'BET08 MCB DB BOX 3 PHASE TPN SINGLE DOOR 8 WAYS', '', '8537', 1, 'Pcs', '28'),
(145, 1, 1, 1, 0, 'BET12 MCB DB BOX 3 PHASE TPN SINGLE DOOR 12 WAYS', '', '8537', 1, 'Pcs', '28'),
(146, 1, 1, 1, 0, 'BETD04 MCB DB BOX 3 PHASE TPN DOUBLE DOOR 4 WAYS', '', '8537', 1, 'Pcs', '28'),
(147, 1, 1, 1, 0, 'BETD06 MCB DB BOX 3 PHASE TPN DOUBLE DOOR 6 WAYS', '', '8537', 1, 'Pcs', '28'),
(148, 1, 1, 1, 0, 'BETD08 MCB DB BOX 3 PHASE TPN DOUBLE DOOR 8 WAYS', '', '8537', 1, 'Pcs', '28'),
(149, 1, 1, 1, 0, 'BETD12 MCB DB BOX 3 PHASE TPN DOUBLE DOOR 12 WAYS', '', '8537', 1, 'Pcs', '28'),
(150, 1, 1, 1, 0, 'BEP1/2  PLASTIC MCB ENCLOSURE (BENLO)', '', '8537', 1, 'Pcs', '28'),
(151, 1, 1, 1, 0, 'BEP3/4  PLASTIC MCB ENCLOSURE (BENLO)', '', '8537', 1, 'Pcs', '28'),
(152, 1, 1, 1, 0, 'BEPSS20 A/C BOX SINGLE POLE 20AMPS 250VOLTS (BENLO)', '', '8537', 1, 'Pcs', '28'),
(153, 1, 1, 1, 0, 'BEPST20 A/C BOX TRIPLE POLE 20AMPS 440VOLTS (BENLO)', '', '8537', 1, 'Pcs', '28'),
(154, 1, 1, 1, 0, 'BEPST30 A/C BOX TRIPLE POLE 30AMPS 440VOLTS (BENLO)', '', '8537', 1, 'Pcs', '28'),
(155, 1, 1, 1, 0, 'BESB SOCKET BOX', '', '8537', 1, 'Pcs', '28'),
(156, 1, 1, 1, 0, 'BEPCS25 PHASE SELECTOR SWITCH (THREE WAY WITH OFF) 25AMPS', '', '8536', 1, 'Pcs', '28'),
(157, 1, 1, 1, 0, 'BEPCS32 PHASE SELECTOR SWITCH (THREE WAY WITH OFF) 32AMPS', '', '8536', 1, 'Pcs', '28'),
(158, 1, 1, 1, 0, 'BEPCS40 PHASE SELECTOR SWITCH (THREE WAY WITH OFF) 40AMPS', '', '8536', 1, 'Pcs', '28'),
(159, 1, 1, 1, 0, 'BEPCS63 PHASE SELECTOR SWITCH (THREE WAY WITH OFF) 63AMPS', '', '8536', 1, 'Pcs', '28'),
(160, 1, 1, 1, 0, 'BESSPMC (2.5-10AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE', '', '9028', 1, 'Pcs', '18'),
(161, 1, 1, 1, 0, 'BESSPMC2.5-10  (2.5-10AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE', '', '9028', 1, 'Pcs', '18'),
(162, 1, 1, 1, 0, 'BESSPMC05-20  (5-20AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE', '', '9028', 1, 'Pcs', '18'),
(163, 1, 1, 1, 0, 'BESSPMC05-30  (5-30AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE', '', '9028', 1, 'Pcs', '18'),
(164, 1, 1, 1, 0, 'BESSPMC05-40  (5-40AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE', '', '9028', 1, 'Pcs', '18'),
(165, 1, 1, 1, 0, 'BESSPMC05-60  (5-60AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE', '', '9028', 1, 'Pcs', '18'),
(166, 1, 1, 1, 0, 'BESPLCD05-20  (5-20AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE (LCD DISPLAY)', '', '9028', 1, 'Pcs', '18'),
(167, 1, 1, 1, 0, 'BESPLCD05-30  (5-30AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE (LCD DISPLAY)', '', '9028', 1, 'Pcs', '18'),
(168, 1, 1, 1, 0, 'BESPLCD10-40  (10-40AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE (LCD DISPLAY)', '', '9028', 1, 'Pcs', '18'),
(169, 1, 1, 1, 0, 'BESPLCD10-60  (10-60AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE (LCD DISPLAY)', '', '9028', 1, 'Pcs', '18'),
(170, 1, 1, 1, 0, 'BESPMMF05-20  (5-20AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE (LCD DISPLAY) MULTI FUNCTION TYPE', '', '9028', 1, 'Pcs', '18'),
(171, 1, 1, 1, 0, 'BESPMMF05-30  (5-30AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE (LCD DISPLAY) MULTI FUNCTION TYPE', '', '9028', 1, 'Pcs', '18'),
(172, 1, 1, 1, 0, 'BESPMMF10-40 (10-40AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE (LCD DISPLAY) MULTI FUNCTION TYPE', '', '9028', 1, 'Pcs', '18'),
(173, 1, 1, 1, 0, 'BESPMMF10-40  (10-40AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE (LCD DISPLAY) MULTI FUNCTION TYPE', '', '9028', 1, 'Pcs', '18'),
(174, 1, 1, 1, 0, 'BESPMMF10-60 (10-60AMPS) SINGLE PHASE ELECTRONIC METER COUNTER TYPE (LCD DISPLAY) MULTI FUNCTION TYPE', '', '9028', 1, 'Pcs', '18'),
(175, 1, 1, 1, 0, 'BETPM05-20 THREE PHASE 4 WIRE ELECTRONIC METER COUNTER TYPE', '', '9028', 1, 'Pcs', '18'),
(176, 1, 1, 1, 0, 'BETPM10-40 THREE PHASE (10-40AMPS) 4 WIRE ELECTRONIC METER COUNTER TYPE', '', '', 1, 'Pcs', ''),
(177, 1, 1, 1, 0, 'BETPMC10-60 THREE PHASE (10-60AMPS) 4 WIRES ELECTRONIC METER COUNTER TYPE', '', '9028', 1, 'Pcs', '18'),
(178, 1, 1, 1, 0, 'BETPMCCT /05(CT OPERATED) 3 PHASE ELECTRONIC METER.', '', '9028', 1, 'Pcs', '18'),
(179, 1, 1, 1, 0, 'BETPLCD05-20 THREE PHASE (05-20AMPS) 4WIRES ELECTRONIC METER LCD DISPLAY', '', '9028', 1, 'Pcs', '18'),
(180, 1, 1, 1, 0, 'BETPLCD10-40 THREE PHASE (10-40AMPS) 4WIRES ELECTRONIC METER LCD DISPLAY', '', '9028', 1, 'Pcs', '18'),
(181, 1, 1, 1, 0, 'BETPLCD10-60 THREE PHASE (10-60AMPS) 4WIRES ELECTRONIC METER LCD DISPLAY', '', '9028', 1, 'Pcs', '18'),
(182, 1, 1, 1, 0, 'BETPLCDCT  /05(CT OPERATED)', '', '9028', 1, 'Pcs', '18'),
(183, 1, 1, 1, 0, 'BETPMMF05-20 THREE PHASE (05-20) 4WIRES ELECTRONIC METER LCD DISPLAY MULTI FUNCTION TYPE', '', '9028', 1, 'Pcs', '18'),
(184, 1, 1, 1, 0, 'BETPMMF10-40 THREE PHASE (10-40AMPS) 4WIRES ELECTRONIC METER LCD DISPLAY MULTI FUNCTION TYPE.', '', '9028', 1, 'Pcs', '18'),
(185, 1, 1, 1, 0, 'BETPMMF10-60 THREE PHASE (10-60AMPS) 4WIRES ELECTRONIC METER LCD DISPLAY MULTI FUNCTION', '', '9028', 1, 'Pcs', '18'),
(186, 1, 1, 1, 0, 'BS 16002 6AX 2 WAY SWITCH', '', '8536', 1, 'Pcs', '28'),
(187, 1, 1, 1, 0, 'H011 6 A SWITCH S1 PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(188, 1, 1, 2, 0, 'H012 6A SWITCH S2 PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(189, 1, 1, 2, 0, 'H013 6 A SWITCH S3 PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(190, 1, 1, 2, 0, 'H062 6A 2WAY SWITCH S3 PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(191, 1, 1, 2, 0, 'H072 6A BELL PUSH S3 PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(192, 1, 1, 2, 0, 'H021 6A 5 PIN SOCKET PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(193, 1, 1, 2, 0, 'H022 INTERNATIONAL SOCKET 13 A PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(194, 1, 1, 2, 0, 'H031 6A 2 PIN SOCKET PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(195, 1, 1, 2, 0, 'H051 INDICATOR PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(196, 1, 1, 2, 0, 'H041 10A KIT KAT FUSE PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(197, 1, 1, 2, 0, 'H0281 TV SOCKET PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(198, 1, 1, 2, 0, 'H281 T V SOCKET PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(199, 1, 1, 2, 0, 'H191 REGULATOR VOLUME SWITCH TYPE PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(200, 1, 1, 2, 0, 'H201 REGULATOR 4 STEP SWITCH TYPE PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(201, 1, 1, 2, 0, 'H251 REGULATOR VOLUME SOCKET TYPE PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(202, 1, 1, 2, 0, 'H261 REGULATOR 4 STEP SOCKET TYPE PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(203, 1, 1, 2, 0, 'H211 16A 1WAY SWITCH PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(204, 1, 1, 2, 0, 'H212 16A 2WAY SWITCH PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(205, 1, 1, 2, 0, 'H221 16A SOCKET PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(206, 1, 1, 2, 0, 'H213 16A SWITCH + BOX PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(207, 1, 1, 2, 0, 'H222 16A SOCKET+BOX PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(208, 1, 1, 2, 0, 'H223 6A COMBINED+BOX PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(209, 1, 1, 2, 0, 'H231 16A COMBINED WITH OUT BOX PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(210, 1, 1, 2, 0, 'H231A  16A COMBINED +BOX PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(211, 1, 1, 2, 0, 'H234 16A  1+4 COMBINED+BOX PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(212, 1, 1, 2, 0, 'H233 6A 2+4 COMBINED +BOX PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(213, 1, 1, 2, 0, 'H232 5 IN 1 PC (6A) WITH OUT BOX HOSPER', '', '8536', 1, 'Pcs', '28'),
(214, 1, 1, 2, 0, 'H232A 5 IN 1 + BOX PC (6A) HOSPER', '', '8536', 1, 'Pcs', '28'),
(215, 1, 1, 3, 0, 'V011 6A SWITCH S1 V HOSPER', '', '8536', 1, 'Pcs', '28'),
(216, 1, 1, 2, 0, 'V061 6A 2WAY SWITCH S1 V HOSPER', '', '8536', 1, 'Pcs', '28'),
(217, 1, 1, 2, 0, 'V071 BELL PUSH SWITCH S1 V HOSPER', '', '8536', 1, 'Pcs', '28'),
(218, 1, 1, 2, 0, 'V021 5 PIN SOCKET V HOPSPER', '', '8536', 1, 'Pcs', '28'),
(219, 1, 1, 2, 0, 'V031 2PIN SOCKET V HOSPER', '', '8536', 1, 'Pcs', '28'),
(220, 1, 1, 2, 0, 'V051 INDICATOR V HOSPER ', '', '8536', 1, 'Pcs', '28'),
(221, 1, 1, 2, 0, 'V191 REGULATOR VOLUME SWITCH TYPE V HOSPER', '', '8536', 1, 'Pcs', '28'),
(222, 1, 1, 2, 0, 'V201 REGULATOR 4 STEP SWITCH TYPE V HOSPER', '', '8536', 1, 'Pcs', '28'),
(223, 1, 1, 3, 0, 'V211 16A SWITCH V HOSPER', '', '8536', 1, 'Pcs', '28'),
(224, 1, 1, 3, 0, 'V212 16A 2WAY SWITCH V HOSPER ', '', '', 1, 'Pcs', ''),
(225, 1, 1, 3, 0, 'V221 16A SOCKET V HOSPER', '', '8536', 1, 'Pcs', '28'),
(226, 1, 1, 3, 0, 'V231 16A COMBINED V HOSPER ', '', '8536', 1, 'Pcs', '28'),
(227, 1, 1, 3, 0, 'V231A 16A COMBINED+BOX V HOSPER', '', '8536', 1, 'Pcs', '28'),
(228, 1, 1, 2, 0, 'H531 3PIN TOP 6A PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(229, 1, 1, 2, 0, 'H541 3PIN TOP 16A PC HOSPER', '', '8536', 1, 'Pcs', '28'),
(230, 1, 1, 2, 0, 'H531U  3PIN TOP 6A UREA HOSPER', '', '8536', 1, 'Pcs', '28'),
(231, 1, 1, 2, 0, 'H541U 3PIN TOP 16A UREA HOSPER', '', '8536', 1, 'Pcs', '28'),
(232, 1, 1, 2, 0, 'H432 3PIN TOP 6A APPLE', '', '8536', 1, 'Pcs', '28'),
(233, 1, 1, 2, 0, 'H513 2PIN TOP MAGIC', '', '8536', 1, 'Pcs', '28'),
(234, 1, 1, 2, 0, 'H513M MALE FEMALE MAGIC', '', '8536', 1, 'Pcs', '28'),
(235, 1, 1, 2, 0, 'H515 2PIN TOP CUTE', '', '8536', 1, 'Pcs', '28'),
(236, 1, 1, 2, 0, 'H514M MALE FEMALE CUTE', '', '8536', 1, 'Pcs', '28'),
(237, 1, 1, 2, 0, 'H511 2PIN TOP DELUXE', '', '8536', 1, 'Pcs', '28'),
(238, 1, 1, 2, 0, 'H411 ANGLE HOLDER METAL RING (DELUX)', '', '8536', 1, 'Pcs', '28'),
(239, 1, 1, 2, 0, 'H412 BATTAN HOLDER METAL RING(DELUXE)', '', '8536', 1, 'Pcs', '28'),
(240, 1, 1, 2, 0, 'H421 ANGLE HOLDER HEAVY (MAGIC)', '', '8536', 1, 'Pcs', '28'),
(241, 1, 1, 2, 0, 'H422 BATTAN HOLDER HEAVY(MAGIC)', '', '8536', 1, 'Pcs', '28'),
(242, 1, 1, 2, 0, 'H461 ANGLE HOLDER FANCY COLOUR', '', '8536', 1, 'Pcs', '28'),
(243, 1, 1, 2, 0, 'H462 BATTAN HOLDER FANCY COLOUR', '', '8536', 1, 'Pcs', '28'),
(244, 1, 1, 2, 0, 'H463 JUMBO HOLDER FANCY COLOUR  HOSPER', '', '8536', 1, 'Pcs', '28'),
(245, 1, 1, 2, 0, 'H464 BATTAN HOLDER FANCY COLOUR PRIDE', '', '8536', 1, 'Pcs', '28'),
(246, 1, 1, 2, 0, 'H431 BURFI HOLDER  ', '', '8536', 1, 'Pcs', '28'),
(247, 1, 1, 2, 0, 'H441 SQUARE HOLDER (NEXTA)', '', '8536', 1, 'Pcs', '28'),
(248, 1, 1, 2, 0, 'H451 CEILING ROSE (2 PLATES)', '', '8538', 1, 'Pcs', '18'),
(249, 1, 1, 2, 0, 'H452 CEILING ROSE (COLOUR)', '', '8538', 1, 'Pcs', '18'),
(250, 1, 1, 2, 0, 'H475 SKIRT HOLDER', '', '8536', 1, 'Pcs', '28'),
(251, 1, 1, 2, 0, 'H476 PENDENT HOLDER (BLACK)(HERO)', '', '8536', 1, 'Pcs', '28'),
(252, 1, 1, 2, 0, 'H477 MULTI HOLDER (BLACK)(HERO)', '', '8536', 1, 'Pcs', '28'),
(253, 1, 1, 2, 0, 'H477A MULTI HOLDER (BLACK)(ALAM)', '', '8536', 1, 'Pcs', '28'),
(254, 1, 1, 2, 0, 'H521 5 PIN MULTIPLUG DELUXE(3X5)', '', '8536', 1, 'Pcs', '28'),
(255, 1, 1, 2, 0, 'H522 AVON MULTIPLUG DELUXE(2X5)', '', '8536', 1, 'Pcs', '28'),
(256, 1, 1, 2, 0, 'H523 5PIN MULTI PLUG RAINBOW', '', '8536', 1, 'Pcs', '28'),
(257, 1, 1, 2, 0, 'H524 5PIN MULTI PLUG MAGNA', '', '8536', 1, 'Pcs', '28'),
(258, 1, 1, 2, 0, 'H521U 5 PIN MULTI PLUG UREA', '', '8536', 1, 'Pcs', '28'),
(259, 1, 1, 2, 0, 'H525 6A TO 16A MULTI PLUG HOSPER', '', '8536', 1, 'Pcs', '28'),
(260, 1, 1, 2, 0, 'H526 5A TO 15A CONVERSION (TIGHT GRIP)', '', '8536', 1, 'Pcs', '28'),
(261, 1, 1, 2, 0, 'H311 32A DP SWITCH DELUXE', '', '8536', 1, 'Pcs', '28'),
(262, 1, 1, 2, 0, 'H312 32A DP SWITCH MAGIC', '', '8536', 1, 'Pcs', '28'),
(263, 1, 1, 2, 0, 'H313 SURFACE MOUNT DP MCB', '', '8536', 1, 'Pcs', '28'),
(264, 1, 1, 2, 0, 'H551 BED SWITCH', '', '8536', 1, 'Pcs', '28'),
(265, 1, 1, 2, 0, 'H552 HANGING BED SWITCH', '', '8536', 1, 'Pcs', '28'),
(266, 1, 1, 2, 0, 'H561 PVC TAPE HOSPER', '', '3919', 1, 'Pcs', ''),
(267, 1, 1, 2, 0, 'H581F BELL VOCAL FUSION', '', '8531', 1, 'Pcs', '28'),
(268, 1, 1, 2, 0, 'H585 WATER OVER FLOW ALARM', '', '9026', 1, 'Pcs', '18'),
(269, 1, 1, 2, 0, 'H586 REMOTE BELL HOSPER', '', '8531', 1, 'Pcs', '28'),
(270, 1, 1, 2, 0, 'H587 PARROT BELL HOSPER', '', '8531', 1, 'Pcs', '28'),
(271, 1, 1, 2, 0, 'MSP06 6A-32A MCB SP HOSPER', '', '8536', 1, 'Pcs', '28'),
(272, 1, 1, 2, 0, 'MSP40 40A MCB SP', '', '8536', 1, 'Pcs', '28'),
(273, 1, 1, 2, 0, 'MSP63 63A MCB SP HOSPER', '', '8536', 1, 'Pcs', '28'),
(274, 1, 1, 2, 0, 'MSN06 6A 32A MCB SPN HOSPER', '', '8536', 1, 'Pcs', '28'),
(275, 1, 1, 2, 0, 'MSN40 40A MCB SPN HOSPER ', '', '8536', 1, 'Pcs', '28'),
(276, 1, 1, 2, 0, 'MSN63  63A MCB SPN HOSPER', '', '8536', 1, 'Pcs', '28'),
(277, 1, 1, 2, 0, 'MDP06 6A-32A MCB DP HOSPER', '', '8536', 1, 'Pcs', '28'),
(278, 1, 1, 2, 0, 'MDP40  40A MCB DP HOSPER', '', '8536', 1, 'Pcs', '28'),
(279, 1, 1, 2, 0, 'MDP63 63A MCB DP HOSPER', '', '8536', 1, 'Pcs', '28'),
(280, 1, 1, 2, 0, 'MTP06 6A-32A MCB TP HOSPER', '', '8536', 1, 'Pcs', '28'),
(281, 1, 1, 2, 0, 'MTP40  40A MCB TP HOSPER', '', '8536', 1, 'Pcs', '28'),
(282, 1, 1, 2, 0, 'MTP63 63A MCB TP HOSPER', '', '8536', 1, 'Pcs', '28'),
(283, 1, 1, 2, 0, 'MTN06 6A-32A MCB TPN HOSPER', '', '8536', 1, 'Pcs', '28'),
(284, 1, 1, 2, 0, 'MTN40 40A MCB TPN HOSPER', '', '8536', 1, 'Pcs', '28'),
(285, 1, 1, 2, 0, 'MTN63A MCB TPN HOSPER', '', '8536', 1, 'Pcs', '28'),
(286, 1, 1, 2, 0, 'MFP06 6A-32A MCB FP HOSPER', '', '8536', 1, 'Pcs', '28'),
(287, 1, 1, 2, 0, 'MFP40 40A MCB FP HOSPER', '', '8536', 1, 'Pcs', '28'),
(288, 1, 1, 2, 0, 'MFP63 63A MCB FP HOSPER', '', '8536', 1, 'Pcs', '28'),
(289, 1, 1, 2, 0, 'IDP40 (40A) ISOALATOR DP NEXTA HOSPER ', '', '8536', 1, 'Pcs', '28'),
(290, 1, 1, 2, 0, 'IDP63 63A ISOLATOR DP HOSPER', '', '8536', 1, 'Pcs', '28'),
(291, 1, 1, 2, 0, 'IDP100 100A ISOLATOR DP HOSPER', '', '8536', 1, 'Pcs', '28'),
(292, 1, 1, 2, 0, 'ITP40 40A ISOLATOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(293, 1, 1, 2, 0, 'ITP63 63A ISOLATOR TP', '', '8536', 1, 'Pcs', '28'),
(294, 1, 1, 2, 0, 'ITP100 100A ISOLATOR TP HOSPER', '', '8536', 1, 'Pcs', '28'),
(295, 1, 1, 2, 0, 'IFP40 40A ISOLATOR FP HOSPER ', '', '8536', 1, 'Pcs', '28'),
(296, 1, 1, 2, 0, 'IFP63 63A ISOLATOR FP HOSPER', '', '8536', 1, 'Pcs', '28'),
(297, 1, 1, 2, 0, 'IFP100 100A ISOLATOR FP HOSPER', '', '8536', 1, 'Pcs', '28'),
(298, 1, 1, 2, 0, 'CO32 32A DP CHANGE OVER SWITCH MCB TYPE HOSPER', '', '8536', 1, 'Pcs', '28'),
(299, 1, 1, 2, 0, 'CO40 40A DP CHANGE OVER SWITCH MCB TYPE HOSPER', '', '8536', 1, 'Pcs', '28'),
(300, 1, 1, 2, 0, 'CO63 63A  DP CHANGE OVER SWITCH MCB TYPE HOSPER', '', '8536', 1, 'Pcs', '28'),
(301, 1, 1, 2, 0, 'SDB4 4WAY DB BOX SINGLE DOOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(302, 1, 1, 2, 0, 'SDB6 6WAY DB BOX SINGLE DOOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(303, 1, 1, 2, 0, 'SDB8 8WAYS DB BOX SINGLE DOOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(304, 1, 1, 2, 0, 'SDB10 10WAYS DB BOX SINGLE DOOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(305, 1, 1, 2, 0, 'SDB12 12WAYS DB BOX SINGLE DOOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(306, 1, 1, 2, 0, 'DDB4 4WAYS DB BOX DOUBLE DOOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(307, 1, 1, 2, 0, 'DDB6 6WAYS DB BOX DOUBLE DOOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(308, 1, 1, 2, 0, 'DDB8 8WAYS DB BOX DOUBLE DOOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(309, 1, 1, 2, 0, 'DDB10 10WAYS DB BOX DOUBLE DOOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(310, 1, 1, 2, 0, 'DDB12 12WAYS DB BOX DOUBLE DOOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(311, 1, 1, 2, 0, 'DDB16 16WAYS DB BOX DOUBLE DOOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(312, 1, 1, 2, 0, 'TTPNDD4 4WAYS TRIPLE POLE NEUTRAL DB BOX DOUBLE DOOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(313, 1, 1, 2, 0, 'TTPNDD6 6WAYS TRIPLE POLE NEUTRAL DB BOX DOUBLE DOOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(314, 1, 1, 2, 0, 'TTPNDD8 8WAYS TRIPLE POLE NEUTRAL DB BOX DOUBLE DOOR HOSPER', '', '8536', 1, 'Pcs', '28'),
(315, 1, 1, 2, 0, 'N1415 NEXTA SURGE PROTECTOR 1+4 1.5 METER POWER STRIP HOSPER', '', '8537', 1, 'Pcs', '28'),
(316, 1, 1, 2, 0, 'N4415 NEXTA SURGE PROTECTOR 4+4 1.5 METER POWER STRIP HOSPER', '', '8537', 1, 'Pcs', '28'),
(317, 1, 1, 2, 0, 'N1440 NEXTA SURGE PROTECTOR (1+4) 4 METER POWER STRIP HOSPER', '', '8537', 1, 'Pcs', '28'),
(318, 1, 1, 2, 0, 'N4440 NEXTA SURGE PROTECTOR (4+4) 4 METER POWER STRIP HOSPER', '', '8537', 1, 'Pcs', '28'),
(319, 1, 1, 2, 0, 'M1515 MAGIC POWER STRIP 1+5  2 YARD HOSPER', '', '8537', 1, 'Pcs', '28'),
(320, 1, 1, 2, 0, 'M1540 MAGIC POWER STRIP 1+5  4 YARD HOSPER', '', '8537', 1, 'Pcs', '28'),
(321, 1, 1, 2, 0, 'M36015   360 POWER STRIP 1+5  2 YARD HOSPER', '', '8537', 1, 'Pcs', '28'),
(322, 1, 1, 2, 0, 'M36040 360 POWER STRIP 1+5 4 YARD HOSPER', '', '8537', 1, 'Pcs', '28'),
(323, 1, 1, 2, 0, 'EG04 EXTENSION GRIP 4 YARD HOSPER', '', '8537', 1, 'Pcs', '28'),
(324, 1, 1, 2, 0, 'EH08 EXTENSION HSL 8 YARD', '', '8537', 1, 'Pcs', '28'),
(325, 1, 1, 2, 0, 'DRC03 3 WATT CONCEALED (RD/SQ) LED DOWN LIGHT HOSPER', '', '9405', 1, 'Pcs', '12'),
(326, 1, 1, 2, 0, 'DRC06 6 WATT CONCEALED (RD/SQ) LED DOWN LIGHT HOSPER', '', '9405', 1, 'Pcs', '12'),
(327, 1, 1, 2, 0, 'DRC10 10 WATT CONCEALED (RD/SQ) LED DOWNLIGHT HOSPER', '', '9405', 1, 'Pcs', '12'),
(328, 1, 1, 2, 0, 'DRC18 15 WATT CONCEALED (RD/SQ) LED DOWNLIGHT HOSPER', '', '9405', 1, 'Pcs', '12'),
(329, 1, 1, 2, 0, 'DRS06 6 WATTS SURFACE LED LIGHT HOSPER', '', '9405', 1, 'Pcs', '12'),
(330, 1, 1, 2, 0, 'DRS12 12 WATTS SURFACE LED LIGHT HOSPER', '', '9405', 1, 'Pcs', '12'),
(331, 1, 1, 2, 0, 'DRSNEX6 6 WATTS CONCEALED SILVER NEXTA HOSPER', '', '9405', 1, 'Pcs', '12'),
(332, 1, 1, 2, 0, 'DRSNEX06 (RED/GREEN/BLUE)  6 WATTS CONCEALED SILVER NEXTA HOSPER', '', '9405', 1, 'Pcs', '12'),
(333, 1, 1, 2, 0, 'DRSN03 3 WATT DEEP SILVER NEXTA HOSPER', '', '9405', 1, 'Pcs', '12'),
(334, 1, 1, 2, 0, 'RC01 ONE MODULE (1M) CONVENTIONAL PLATE (WOOD) HOSPER', '', '8538', 1, 'Pcs', '18'),
(335, 1, 1, 2, 0, 'RC02 TWO MODULE (2M) CONVENTIONAL PLATE (WOOD) HOSPER', '', '8538', 1, 'Pcs', '18'),
(336, 1, 1, 2, 0, 'RC03 THREE MODULE (3M) CONVENTIONAL PLATE (WOOD) HOSPER', '', '8538', 1, 'Pcs', '18'),
(337, 1, 1, 2, 0, 'RC04 FOUR MODULE (4M) CONVENTIONAL PLATE (WOOD) HOSPER', '', '8538', 1, 'Pcs', '18'),
(338, 1, 1, 2, 0, 'RC07 EIGHT MODULE SQUARE (8M) CONVENTIONAL PLATE (WOOD) HOSPER', '', '8538', 1, 'Pcs', '18'),
(339, 1, 1, 2, 0, 'RC05 SIX MODULE (6M) CONVENTIONAL PLATE (WOOD) HOSPER', '', '8538', 1, 'Pcs', '18'),
(340, 1, 1, 2, 0, 'RC06 EIGHT MODULE LONG (8M) CONVENTIONAL PLATE (WOOD) HOSPER', '', '8538', 1, 'Pcs', '18'),
(341, 1, 1, 2, 0, 'RC007 EIGHT MODULE SQUARE (8M) CONVENTIONAL PLATE (WOOD)', '', '', 1, 'Pcs', ''),
(342, 1, 1, 2, 0, 'RC08 TEN MODULE (10M) CONVENTIONAL PLATE (WOOD) HOSPER', '', '8538', 1, 'Pcs', '18'),
(343, 1, 1, 2, 0, 'RC09 TWELVE MODULE H TYPE (12M) CONVENTIONAL PLATE (WOOD) HOSPER', '', '8538', 1, 'Pcs', '18'),
(344, 1, 1, 2, 0, 'RC10 TWELVE MODULE (V) TYPE (12M) CONVENTIONAL PLATE HOSPER', '', '8538', 1, 'Pcs', '18'),
(345, 1, 1, 2, 0, 'RC11 EIGHTEEN MODULE (H) TYPE (18M) CONVENTINAL PLATE HOSPER', '', '8538', 1, 'Pcs', '18'),
(346, 1, 1, 2, 0, 'RC12 EIGHTEEN MODULE (V) TYPE (18M) WOOD CONVENTIONAL PLATE HOSPER', '', '8538', 1, 'Pcs', '18'),
(347, 1, 1, 2, 0, 'RM01 ONE MODULE PLATE (1M) ROMAN (METAL BOX TYPE) HOSPER', '', '8538', 1, 'Pcs', '18'),
(348, 1, 1, 2, 0, 'RM02 TWO MODULE PLATE ROMAN (2M) (METAL BOX TYPE) HOSPER', '', '8538', 1, 'Pcs', '18'),
(349, 1, 1, 2, 0, 'RM03 THREE MODULE PLATE ROMAN (3M) (METAL BOX TYPE) HOSPER', '', '8538', 1, 'Pcs', '18'),
(350, 1, 1, 2, 0, 'RM04 FOUR MODULE PLATE ROMAN (4M) (METAL BOX TYPE) HOSPER', '', '8538', 1, 'Pcs', '18'),
(351, 1, 1, 2, 0, 'RM05 SIX MODULE PLATE  ROMAN (6M) (METAL BOX TYPE) HOSPER', '', '8538', 1, 'Pcs', '18'),
(352, 1, 1, 2, 0, 'RM06 EIGHT MODULE PLATE LONG (8M) ROMAN (METAL BOX TYPE) HOSPER', '', '8538', 1, 'Pcs', '18'),
(353, 1, 1, 2, 0, 'RM07 EIGHT MODULE PLATE SQUARE (8M) ROMAN (METAL BOX TYPE) HOSPER', '', '8538', 1, 'Pcs', '18'),
(354, 1, 1, 2, 0, 'RM08 TOWEL MODULE PLATE  (12M) ROMAN (METAL BOX TYPE) HOSPER', '', '8538', 1, 'Pcs', '18'),
(355, 1, 1, 2, 0, 'RM09 EIGHTEEN MODULE PLATE  (18M) ROMAN (METAL BOX TYPE) HOSPER', '', '8538', 1, 'Pcs', '18'),
(356, 1, 1, 2, 0, 'RLS01 ONE MODULE PLATE (1M) LIFE STYLE (METAL BOX) TYPE  HOSPER ', '', '8538', 1, 'Pcs', '18'),
(357, 1, 1, 2, 0, 'RLS02 TWO MODULE PLATE (2M) LIFE STYLE (METAL BOX) TYPE  HOSPER ', '', '8538', 1, 'Pcs', '18'),
(358, 1, 1, 2, 0, 'RLS03 THREE MODULE PLATE (3M) LIFE STYLE (METAL BOX) TYPE  HOSPER ', '', '8538', 1, 'Pcs', '18'),
(359, 1, 1, 2, 0, 'RLS04 FOUR MODULE PLATE (4M) LIFE STYLE (METAL BOX) TYPE  HOSPER ', '', '8538', 1, 'Pcs', '18'),
(360, 1, 1, 2, 0, 'RLS05 SIX MODULE PLATE (6M) LIFE STYLE (METAL BOX) TYPE  HOSPER ', '', '8538', 1, 'Pcs', '18'),
(361, 1, 1, 2, 0, 'RLS06 EIGHT MODULE (LONG) PLATE (8M) LIFE STYLE (METAL BOX) TYPE  HOSPER ', '', '8538', 1, 'Pcs', '18'),
(362, 1, 1, 2, 0, 'RLS07 EIGHT MODULE (SQUARE) PLATE (8M) LIFE STYLE (METAL BOX) TYPE  HOSPER ', '', '8538', 1, 'Pcs', '18'),
(363, 1, 1, 2, 0, 'RLS08 TOWEL MODULE  PLATE (12 M) LIFE STYLE (METAL BOX) TYPE  HOSPER ', '', '8538', 1, 'Pcs', '18'),
(364, 1, 1, 2, 0, 'RLS09 EIGHTEEN MODULE  PLATE (18 M) LIFE STYLE (METAL BOX) TYPE  HOSPER ', '', '8538', 1, 'Pcs', '18'),
(365, 1, 1, 2, 0, 'R01 6A SINGLE WAY SWITCH DOLLY MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(366, 1, 1, 2, 0, 'R02 6A SINGLE WAY SWITCH ROCKER MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(367, 1, 1, 2, 0, 'R03 6A TWO WAY SWITCH ROCKER MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(368, 1, 1, 2, 0, 'R04 6A BELL PUSH SWITCH (1 MODULE) MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(369, 1, 1, 2, 0, 'R05 6A BELL PUSH SWITCH (2 MODULE) MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(370, 1, 1, 2, 0, 'R06 16A SINGLE WAY SWITCH (1M) MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(371, 1, 1, 2, 0, 'R07 16A TWO WAY SWITCH (1M) MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(372, 1, 1, 2, 0, 'R08 16A SINGLE WAY SWITCH TWO MODULAR(2M) HOSPER', '', '8536', 1, 'Pcs', '28'),
(373, 1, 1, 2, 0, 'R09 32A DP SWITCH TWO MODULAR(2M) HOSPER', '', '8536', 1, 'Pcs', '28'),
(374, 1, 1, 2, 0, 'R35 25A MOTOR STARTER (2MODULE) HOSPER MODULAR', '', '8536', 1, 'Pcs', '28'),
(375, 1, 1, 2, 0, 'R10 2 PIN SOCKET (1M) MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(376, 1, 1, 2, 0, 'R11 5PIN SOCKET 6A (2M) MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(377, 1, 1, 2, 0, 'R11A   5PIN SOCKET 6A (2M) MODULAR HOSPER (BIG BACK)', '', '8536', 1, 'Pcs', '28'),
(378, 1, 1, 2, 0, 'R12 16A SOCKET MODULAR (2M) HOSPER', '', '8536', 1, 'Pcs', '28'),
(379, 1, 1, 2, 0, 'R13 13A INTERNATIONAL SOCKET MODULAR (1M) HOSPER', '', '8536', 1, 'Pcs', '28'),
(380, 1, 1, 2, 0, 'R14 16A SOCKET + SHUTTER MODULAR (2M) HOSPER', '', '8536', 1, 'Pcs', '28'),
(381, 1, 1, 2, 0, 'R14A 16A SOCKET + SHUTTER MODULAR (2M) HOSPER MAGIC', '', '8536', 1, 'Pcs', '28'),
(382, 1, 1, 2, 0, 'R21  INDICATOR MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(383, 1, 1, 2, 0, 'R22 FUSE MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(384, 1, 1, 2, 0, 'R23 T V SOCKET MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(385, 1, 1, 2, 0, 'R24 TELEPHONE JACK MODULAR', '', '8536', 1, 'Pcs', '28'),
(386, 1, 1, 2, 0, 'R27 BLANK PLATE MODULAR HOSPER (1M)', '', '8536', 1, 'Pcs', '28'),
(387, 1, 1, 2, 0, 'R31 REGULATOR VOLUME 1MODULE SWITCH TYPE HOSPER', '', '8536', 1, 'Pcs', '28'),
(388, 1, 1, 2, 0, 'R32 REGULATOR VOLUME (2M) MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(389, 1, 1, 2, 0, 'R33 REGULATOR 4 STEP (1M) MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(390, 1, 1, 2, 0, 'R34A REGULATO 5 STEP (2M) MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(391, 1, 1, 2, 0, 'R36 MCB SP 6A TO 32A MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(392, 1, 1, 2, 0, 'R37 MCB DP 6A TO 32A (2MODULE) MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(393, 1, 1, 2, 0, 'R38 ISOLATOR DP 40A  (2 MODULE) MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(394, 1, 1, 2, 0, 'R39 KEY TAG MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(395, 1, 1, 2, 0, 'R40 KET TAG D.P. MODULAR HOSPER', '', '8536', 1, 'Pcs', '28'),
(396, 1, 1, 2, 0, 'H291 TELEPHONE JACK HOSPER P C', '', '8536', 1, 'Pcs', '28'),
(397, 1, 1, 2, 0, 'RC10A TOWEL MODULE  (LONG) TYPE (12M) CONVENTIONAL  PLATE HOSPER', '', '', 1, 'Pcs', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_itemcategory`
--

CREATE TABLE IF NOT EXISTS `m_itemcategory` (
  `itemcategoryno` int(3) NOT NULL,
  `itemcategoryname` varchar(100) NOT NULL,
  `itemcategoryshortname` varchar(20) NOT NULL,
  `itemcategorycolor` varchar(20) NOT NULL,
  PRIMARY KEY (`itemcategoryno`),
  UNIQUE KEY `itemcategoryname` (`itemcategoryname`),
  KEY `itemcategoryno` (`itemcategoryno`),
  KEY `itemcategoryno_2` (`itemcategoryno`),
  KEY `itemcategoryno_3` (`itemcategoryno`),
  KEY `itemcategoryno_4` (`itemcategoryno`),
  KEY `itemcategoryno_5` (`itemcategoryno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_itemcategory`
--

INSERT INTO `m_itemcategory` (`itemcategoryno`, `itemcategoryname`, `itemcategoryshortname`, `itemcategorycolor`) VALUES
(1, 'HARDWARE', '', '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `m_itemgroup`
--

CREATE TABLE IF NOT EXISTS `m_itemgroup` (
  `itemgroupno` int(3) NOT NULL,
  `itemcategoryno` int(3) NOT NULL,
  `itemgroupname` varchar(100) NOT NULL,
  PRIMARY KEY (`itemgroupno`),
  UNIQUE KEY `itemgroupname` (`itemgroupname`),
  KEY `itemgroupno` (`itemgroupno`),
  KEY `itemgroupno_2` (`itemgroupno`),
  KEY `itemcategoryno` (`itemcategoryno`),
  KEY `itemcategoryno_2` (`itemcategoryno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_itemgroup`
--

INSERT INTO `m_itemgroup` (`itemgroupno`, `itemcategoryno`, `itemgroupname`) VALUES
(1, 1, 'BENLO'),
(2, 1, 'HOSPER POLYCARBONATE SERIES'),
(3, 1, 'HOSPER UREA (VICTORY SERIES)');

-- --------------------------------------------------------

--
-- Table structure for table `m_itemsubgroup`
--

CREATE TABLE IF NOT EXISTS `m_itemsubgroup` (
  `itemsubgroupno` int(5) NOT NULL,
  `itemgroupno` int(5) NOT NULL,
  `itemsubgroupname` varchar(100) NOT NULL,
  PRIMARY KEY (`itemsubgroupno`),
  KEY `itemgroupno` (`itemgroupno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_login`
--

CREATE TABLE IF NOT EXISTS `m_login` (
  `userno` int(3) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `departmentno` int(3) NOT NULL,
  `role` varchar(25) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_login`
--

INSERT INTO `m_login` (`userno`, `username`, `password`, `departmentno`, `role`) VALUES
(1, 'user', 'user', 1, 'u');

-- --------------------------------------------------------

--
-- Table structure for table `m_openingstock`
--

CREATE TABLE IF NOT EXISTS `m_openingstock` (
  `openingstockno` int(5) NOT NULL,
  `itemno` int(5) NOT NULL,
  `qty` double(10,2) NOT NULL,
  `mrp` double(10,2) NOT NULL,
  PRIMARY KEY (`openingstockno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_openingstock`
--

INSERT INTO `m_openingstock` (`openingstockno`, `itemno`, `qty`, `mrp`) VALUES
(1, 238, 480.00, 15.00),
(2, 187, 1800.00, 10.50),
(3, 189, 900.00, 14.35),
(4, 191, 600.00, 12.00),
(5, 195, 400.00, 12.50),
(6, 198, 200.00, 18.40),
(7, 396, 200.00, 30.20),
(8, 199, 200.00, 57.40),
(9, 201, 200.00, 73.60),
(10, 200, 200.00, 92.00),
(11, 202, 200.00, 110.40),
(12, 242, 2000.00, 22.00),
(13, 243, 1100.00, 22.00),
(14, 238, 1000.00, 13.80),
(15, 239, 400.00, 13.80),
(16, 246, 600.00, 13.25),
(17, 250, 945.00, 11.80),
(18, 229, 500.00, 38.30),
(19, 244, 600.00, 28.00),
(22, 366, 300.00, 14.50),
(23, 367, 500.00, 22.00),
(25, 375, 500.00, 17.00),
(26, 376, 750.00, 25.00),
(27, 381, 300.00, 59.00),
(28, 383, 100.00, 41.00),
(29, 384, 400.00, 25.00),
(30, 385, 200.00, 30.00),
(31, 387, 100.00, 66.00),
(32, 388, 90.00, 84.00),
(34, 393, 250.00, 125.00),
(35, 192, 950.00, 19.00),
(36, 194, 600.00, 10.50),
(37, 196, 100.00, 20.80),
(38, 248, 3000.00, 13.00),
(39, 368, 520.00, 20.00),
(40, 370, 500.00, 27.00),
(41, 371, 500.00, 42.00),
(42, 382, 500.00, 21.00),
(43, 386, 3000.00, 5.00),
(44, 373, 250.00, 83.00),
(46, 334, 230.00, 29.00),
(47, 335, 230.00, 29.00),
(48, 336, 230.00, 29.00),
(49, 337, 130.00, 42.00),
(50, 339, 130.00, 43.00),
(51, 340, 230.00, 58.00),
(52, 341, 30.00, 58.00),
(53, 342, 230.00, 75.00),
(54, 397, 50.00, 75.00),
(55, 343, 230.00, 75.00),
(56, 344, 230.00, 75.00),
(57, 345, 230.00, 110.00),
(58, 346, 230.00, 110.00),
(59, 391, 400.00, 67.00),
(60, 237, 100.00, 11.00),
(61, 230, 200.00, 21.00),
(62, 365, 300.00, 14.50),
(63, 203, 50.00, 36.80),
(64, 212, 100.00, 75.00),
(65, 213, 100.00, 115.20),
(66, 214, 40.00, 133.82),
(67, 209, 275.00, 81.17),
(68, 210, 750.00, 85.00),
(69, 259, 200.00, 51.20),
(70, 235, 600.00, 8.32),
(71, 289, 66.00, 140.80),
(72, 389, 200.00, 100.00),
(73, 376, 500.00, 30.00);

-- --------------------------------------------------------

--
-- Table structure for table `m_salesperson`
--

CREATE TABLE IF NOT EXISTS `m_salesperson` (
  `salesperson_id` int(5) NOT NULL AUTO_INCREMENT,
  `salesperson_name` varchar(100) NOT NULL,
  `salesperson_mobileno` varchar(50) NOT NULL,
  `salesperson_address` varchar(100) NOT NULL,
  PRIMARY KEY (`salesperson_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `m_salesperson`
--

INSERT INTO `m_salesperson` (`salesperson_id`, `salesperson_name`, `salesperson_mobileno`, `salesperson_address`) VALUES
(1, 'Saleem', '9578795653', 'Tirunelveli');

-- --------------------------------------------------------

--
-- Table structure for table `m_stockpoint`
--

CREATE TABLE IF NOT EXISTS `m_stockpoint` (
  `stockpointno` int(3) NOT NULL,
  `stockpointname` varchar(100) NOT NULL,
  `stockpointshortname` varchar(10) NOT NULL,
  PRIMARY KEY (`stockpointno`),
  UNIQUE KEY `stockpointname` (`stockpointname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_stockpoint`
--

INSERT INTO `m_stockpoint` (`stockpointno`, `stockpointname`, `stockpointshortname`) VALUES
(1, 'Main', 'Main');

-- --------------------------------------------------------

--
-- Table structure for table `m_unit`
--

CREATE TABLE IF NOT EXISTS `m_unit` (
  `unitno` int(5) NOT NULL,
  `unitname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_unit`
--

INSERT INTO `m_unit` (`unitno`, `unitname`) VALUES
(1, 'Pcs');

-- --------------------------------------------------------

--
-- Table structure for table `setup_companyinfo`
--

CREATE TABLE IF NOT EXISTS `setup_companyinfo` (
  `companyno` int(2) NOT NULL AUTO_INCREMENT,
  `companytitle` varchar(100) NOT NULL,
  `companyaddress1` varchar(100) NOT NULL,
  `companyaddress2` varchar(100) NOT NULL,
  `companyaddress3` varchar(100) NOT NULL,
  `companycontactno` varchar(100) NOT NULL,
  `gstinno` varchar(50) NOT NULL,
  PRIMARY KEY (`companyno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `setup_companyinfo`
--

INSERT INTO `setup_companyinfo` (`companyno`, `companytitle`, `companyaddress1`, `companyaddress2`, `companyaddress3`, `companycontactno`, `gstinno`) VALUES
(1, 'SAAD TRADERS', '104 B ,NETHAJI ROAD. (NEAR ALANKAR THEATER)', 'Melapalayam', 'Tirunelveli, Pin.627005.', '9787773546,04626993333.', '33ALTPT4217C1Z2');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inv_purchaseentry`
--
ALTER TABLE `inv_purchaseentry`
  ADD CONSTRAINT `inv_purchaseentry_ibfk_1` FOREIGN KEY (`itemno`) REFERENCES `m_item` (`itemno`);

--
-- Constraints for table `m_item`
--
ALTER TABLE `m_item`
  ADD CONSTRAINT `m_item_ibfk_1` FOREIGN KEY (`stockpointno`) REFERENCES `m_stockpoint` (`stockpointno`);

--
-- Constraints for table `m_itemgroup`
--
ALTER TABLE `m_itemgroup`
  ADD CONSTRAINT `m_itemgroup_ibfk_1` FOREIGN KEY (`itemcategoryno`) REFERENCES `m_itemcategory` (`itemcategoryno`);

--
-- Constraints for table `m_itemsubgroup`
--
ALTER TABLE `m_itemsubgroup`
  ADD CONSTRAINT `m_itemsubgroup_ibfk_1` FOREIGN KEY (`itemgroupno`) REFERENCES `m_itemgroup` (`itemgroupno`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
