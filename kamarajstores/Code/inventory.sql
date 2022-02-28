-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2017 at 04:31 PM
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
  `qty` int(5) NOT NULL,
  `details` varchar(250) NOT NULL,
  `created_as_on` datetime NOT NULL,
  `updated_as_on` datetime NOT NULL,
  `logged_user` varchar(50) NOT NULL,
  `batchid` varchar(25) NOT NULL,
  `expdate` date NOT NULL,
  `mrp` double(10,2) NOT NULL,
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
  `batchid` varchar(25) NOT NULL,
  `dateexpired` date NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
(29, 'BANK OCC ACCOUNTS'),
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
  `opening_balance` double(10,2) NOT NULL,
  PRIMARY KEY (`account_ledger_id`),
  UNIQUE KEY `ledger_name` (`ledger_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `audit_stock`
--

CREATE TABLE IF NOT EXISTS `audit_stock` (
  `audit_stock_itemno` int(5) NOT NULL,
  `audit_stock_qty` int(5) NOT NULL,
  `audit_stock_datetime` datetime NOT NULL,
  `audit_stock_mode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE IF NOT EXISTS `backup` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `backup`
--

INSERT INTO `backup` (`id`, `date`) VALUES
(56, '2017-11-25'),
(57, '2017-11-27'),
(58, '2017-12-07');

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
(1, 1, 1, 1, 4, 5, 1, '2017-10-01', '2017-11-30', 0, 0, 'print_format9.php', 13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `config_item`
--

CREATE TABLE IF NOT EXISTS `config_item` (
  `config_item_id` int(1) NOT NULL,
  `itemno` varchar(5) NOT NULL,
  `itemdescription` varchar(5) NOT NULL,
  `hsncode` varchar(5) NOT NULL,
  `gst` varchar(5) NOT NULL,
  `rack` varchar(5) NOT NULL,
  `row` varchar(5) NOT NULL,
  `minstock` varchar(5) NOT NULL,
  `stockpoint` varchar(5) NOT NULL,
  `group` varchar(5) NOT NULL,
  `packno` varchar(5) NOT NULL,
  `packdescription` varchar(5) NOT NULL,
  `barcode` varchar(3) NOT NULL,
  `color` varchar(3) NOT NULL,
  `size` varchar(3) NOT NULL,
  `originalprice` varchar(3) NOT NULL,
  `mrp` varchar(3) NOT NULL,
  `disamount` varchar(3) NOT NULL,
  `supplierno` varchar(3) NOT NULL,
  `typetamil` varchar(5) NOT NULL,
  PRIMARY KEY (`config_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config_item`
--

INSERT INTO `config_item` (`config_item_id`, `itemno`, `itemdescription`, `hsncode`, `gst`, `rack`, `row`, `minstock`, `stockpoint`, `group`, `packno`, `packdescription`, `barcode`, `color`, `size`, `originalprice`, `mrp`, `disamount`, `supplierno`, `typetamil`) VALUES
(1, 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'Yes', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `config_print`
--

CREATE TABLE IF NOT EXISTS `config_print` (
  `config_print_id` int(1) NOT NULL,
  `config_print_template` varchar(100) NOT NULL,
  `config_print_src` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config_print`
--

INSERT INTO `config_print` (`config_print_id`, `config_print_template`, `config_print_src`) VALUES
(1, 'print_format9.php', 'logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `config_purchase`
--

CREATE TABLE IF NOT EXISTS `config_purchase` (
  `config_purchase_id` int(3) NOT NULL,
  `config_purchase_invoiceno` varchar(5) NOT NULL,
  `config_purchase_batch` varchar(5) NOT NULL,
  `config_purchase_expiry` varchar(5) NOT NULL,
  `config_purchase_discount` varchar(5) NOT NULL,
  `config_purchase_gst` varchar(5) NOT NULL,
  PRIMARY KEY (`config_purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config_purchase`
--

INSERT INTO `config_purchase` (`config_purchase_id`, `config_purchase_invoiceno`, `config_purchase_batch`, `config_purchase_expiry`, `config_purchase_discount`, `config_purchase_gst`) VALUES
(1, 'No', 'No', 'No', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `config_quotation`
--

CREATE TABLE IF NOT EXISTS `config_quotation` (
  `id` int(3) NOT NULL,
  `line1` varchar(250) NOT NULL,
  `line2` varchar(250) NOT NULL,
  `line3` varchar(250) NOT NULL,
  `line4` varchar(250) NOT NULL,
  `line5` varchar(250) NOT NULL,
  `line6` varchar(250) NOT NULL,
  `line7` varchar(250) NOT NULL,
  `line8` varchar(250) NOT NULL,
  `line9` varchar(250) NOT NULL,
  `line10` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config_quotation`
--

INSERT INTO `config_quotation` (`id`, `line1`, `line2`, `line3`, `line4`, `line5`, `line6`, `line7`, `line8`, `line9`, `line10`) VALUES
(1, 'TE Q- 123', 'Supply and Installation of HIK Vision AHD system.', 'Dear Sir,', 'With Reference to the above Subject,we are pleased to quote our best price for supply,installation and testing of HIK vision AHD CCTV system as per following terms.', '30 Days', '1 Year Free', '1 Year Against Manufacturing Defect', '75 % Advance(Remaining 25 % Against Completion)', 'i', 'j');

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
(1, 'No', 'Yes', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No');

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
(1, 'Dr. R. Srinivasan', '', 'FAMILY', 0, '', '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `inv_estimateentry`
--

CREATE TABLE IF NOT EXISTS `inv_estimateentry` (
  `estimate_txno` int(5) NOT NULL,
  `estimate_id` int(5) NOT NULL,
  `estimate_date` date NOT NULL,
  `itemno` int(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `amount` double(10,2) NOT NULL,
  PRIMARY KEY (`estimate_txno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inv_estimateentry1`
--

CREATE TABLE IF NOT EXISTS `inv_estimateentry1` (
  `estimate_id` int(5) NOT NULL,
  `estimate_date` date NOT NULL,
  `estimate_customerno` int(3) NOT NULL,
  `estimate_totalamount` double(10,2) NOT NULL,
  PRIMARY KEY (`estimate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `qty` int(6) NOT NULL,
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
  PRIMARY KEY (`purchaseinvoiceno`),
  KEY `supplierno` (`supplierno`),
  KEY `supplierno_2` (`supplierno`)
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
  `qty` int(6) NOT NULL,
  `unitrate` double(10,2) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `vat` double(5,2) NOT NULL,
  `discountpercentage` double(10,2) NOT NULL,
  `usagestockpointno` int(3) NOT NULL,
  `usagestockdetails` varchar(100) NOT NULL,
  `createdason` datetime NOT NULL,
  `updatedason` datetime NOT NULL,
  `unitmrp` double(10,2) NOT NULL,
  PRIMARY KEY (`txno`,`salesinvoiceno`),
  KEY `usagestockpointno` (`usagestockpointno`),
  KEY `customerno` (`customerno`)
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
  PRIMARY KEY (`salesinvoiceno`),
  KEY `customerno` (`customerno`)
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
  `stock` int(6) NOT NULL,
  `minstock` int(5) NOT NULL,
  `maxstock` int(5) NOT NULL,
  `mrp` double(10,2) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `expdate` date NOT NULL,
  PRIMARY KEY (`stockno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `inv_stockentry`
--
DROP TRIGGER IF EXISTS `trig_audit_stock_delete`;
DELIMITER //
CREATE TRIGGER `trig_audit_stock_delete` AFTER DELETE ON `inv_stockentry`
 FOR EACH ROW insert into 
audit_stock(audit_stock_itemno,
            audit_stock_qty,
            audit_stock_datetime,
            audit_stock_mode)
VALUES(OLD.itemno,OLD.stock,NOW(),"DELETE")
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trig_audit_stock_insert`;
DELIMITER //
CREATE TRIGGER `trig_audit_stock_insert` AFTER INSERT ON `inv_stockentry`
 FOR EACH ROW insert into 
audit_stock(audit_stock_itemno,
            audit_stock_qty,
            audit_stock_datetime,
            audit_stock_mode)
VALUES(NEW.itemno,NEW.stock,NOW(),"INSERT")
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trig_audit_stock_update`;
DELIMITER //
CREATE TRIGGER `trig_audit_stock_update` AFTER UPDATE ON `inv_stockentry`
 FOR EACH ROW insert into 
audit_stock(audit_stock_itemno,
            audit_stock_qty,
            audit_stock_datetime,
            audit_stock_mode)
VALUES(NEW.itemno,NEW.stock,NOW(),"UPDATE")
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `m_color`
--

CREATE TABLE IF NOT EXISTS `m_color` (
  `colorno` int(3) NOT NULL,
  `colorname` varchar(50) NOT NULL,
  PRIMARY KEY (`colorno`),
  UNIQUE KEY `colorname` (`colorname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_color`
--

INSERT INTO `m_color` (`colorno`, `colorname`) VALUES
(1, 'None');

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
  `itemname` varchar(250) CHARACTER SET utf8 NOT NULL,
  `itemdescription` longtext NOT NULL,
  `hsncode` varchar(50) NOT NULL,
  `packno` int(6) NOT NULL,
  `packdescription` varchar(100) NOT NULL,
  `gst` varchar(25) NOT NULL,
  `rackname` varchar(50) NOT NULL,
  `rowname` varchar(50) NOT NULL,
  `minstock` int(5) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `color` varchar(25) NOT NULL,
  `size` varchar(25) NOT NULL,
  `originalprice` double(10,2) NOT NULL,
  `mrp` double(10,2) NOT NULL,
  `disamount` double(10,2) NOT NULL,
  `supplierno` int(3) NOT NULL,
  PRIMARY KEY (`itemno`),
  UNIQUE KEY `itemname` (`itemname`),
  KEY `stockpointno` (`stockpointno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_item`
--

INSERT INTO `m_item` (`itemno`, `stockpointno`, `itemcategoryno`, `itemgroupno`, `itemsubgroupno`, `itemname`, `itemdescription`, `hsncode`, `packno`, `packdescription`, `gst`, `rackname`, `rowname`, `minstock`, `barcode`, `color`, `size`, `originalprice`, `mrp`, `disamount`, `supplierno`) VALUES
(39, 1, 1, 1, 0, 'G TVS: P3100100-BROCKET COMP HEAD LIGHT MTG OIL FORK', 'BROCKET COMP HEAD LIGHT MTG OIL FORK', '', 1, 'Pcs', '28', 'B9', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(40, 1, 1, 1, 0, 'G TVS: N8120930-STAND COMP CENTER', 'STAND COMP CENTER', '', 1, 'Pcs', '28', 'B9', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(41, 1, 1, 1, 0, 'G TVS: 3100218007L-STAY MUDGUARD MOSS GREEN XL SUPER, TVS 50 H/D', 'STAY MUDGUARD MOSS GREEN', '', 1, 'Pcs', '28', 'B9', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(42, 1, 1, 1, 0, 'G TVS: T41004400D-GROWN PLATE COMP TOP HG BLACK (FORK) XL SUPER H/D', 'GROWN PLATE COMP TOP HG BLACK (FORK)', '', 1, 'Pcs', '28', 'B9', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(43, 1, 1, 1, 0, 'G TVS: P300010-MUD FLAP REAR XL SUPER', 'MUD FLAP REAR XL SUPER', '', 1, 'Pcs', '28', 'B9', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(44, 1, 1, 1, 0, 'G TVS: P3120340-BAR COMP FOOTREST HD"', 'BAR COMP FOOTREST HD"', '', 1, 'Pcs', '28', 'B9', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(45, 1, 1, 1, 0, 'G TVS: P120320-LID TOOL BOX', 'LID TOOL BOX', '', 1, 'Pcs', '28', 'B9', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(46, 1, 1, 1, 0, 'G TVS: K3080820-V-BELT DRIVE (PEP)', 'V-BELT DRIVE (PEP)', '', 1, 'Pcs', '18', 'B9', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(47, 1, 1, 1, 0, 'G TVS: P3320060-FRONT SUSPENSION KIT (OIL FORK)', 'FRONT SUSPENSION KIT (OIL FORK)', '', 1, 'Pcs', '28', 'B9', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(48, 1, 1, 1, 0, 'G TVS: N8030410-MAGNET COVER GASKET SELF', 'MAGNET COVER GASKET SELF', '', 1, 'Pcs', '28', 'B9', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(49, 1, 1, 1, 0, 'G TVS: N8041520-AIR (PAPER) FILTER & HOLDER (MAX 4R)', 'AIR (PAPER) FILTER & HOLDER (MAX 4R)', '', 1, 'Pcs', '18', 'B9', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(50, 1, 1, 1, 0, 'G TVS: P040730-ELEMENT AIR CLEANER', 'ELEMENT AIR CLEANER', '', 1, 'Pcs', '18', 'B9', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(51, 1, 1, 1, 0, 'G TVS: P170060-CABLE ASSY STARTER XL SUPER /HD', 'CABLE ASSY STARTER XL SUPER /HD', '', 1, 'Pcs', '28', 'B9', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(52, 1, 1, 1, 0, 'G TVS: P1320810-REAR BRAKE CABLE KIT XLS ALL', 'REAR BRAKE CABLE KIT XLS ALL', '', 1, 'Pcs', '28', 'B9', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(53, 1, 1, 1, 0, 'G TVS: N8170040-CLUTCH CABLE ASSY ( STAR)', 'CLUTCH CABLE ASSY ( STAR)', '', 1, 'Pcs', '28', 'B9', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(54, 1, 1, 1, 0, 'G TVS: P070120-COVER CLUTCH MACHINE', 'COVER CLUTCH MACHINE', '', 1, 'Pcs', '28', 'B8', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(55, 1, 1, 1, 0, 'G TVS: P1320280-CYLINDER BLOCK & PISTON KIT (VER) XL NM', 'CYLINDER BLOCK & PISTON KIT (VER) XL NM', '', 1, 'Pcs', '28', 'B8', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(56, 1, 1, 1, 0, 'G TVS: P6030090-CLUTCH COVER XL SUPER 100CC', 'CLUTCH COVER XL SUPER 100CC', '', 1, 'Pcs', '28', 'B8', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(57, 1, 1, 1, 0, 'G TVS: P070540-DRUM CLUTCH HOUSING XLN', 'DRUM CLUTCH HOUSING XLN', '', 1, 'Pcs', '28', 'B8', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(58, 1, 1, 1, 0, 'G TVS: 3171090-BRAKE SHOE SET 110 DIA', 'BRAKE SHOE SET 110 DIA', '', 1, 'Pcs', '28', 'B8', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(59, 1, 1, 1, 0, 'G TVS: N8170320-CABLE ASSY SPEEDO CITY/NVE/MAX4R/MOB/SPORT', 'CABLE ASSY SPEEDO CITY/NVE/MAX4R/MOB/SPORT', '', 1, 'Pcs', '28', 'B8', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(60, 1, 1, 1, 0, 'G TVS: K3170110-CABLE ASSY THROTTLE STREAK W/O TPS', 'CABLE ASSY THROTTLE STREAK W/O TPS', '', 1, 'Pcs', '28', 'B8', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(61, 1, 1, 1, 0, 'G TVS: N9170250-CLUTCH CABLE APACHE 160/180/EFI', 'CLUTCH CABLE APACHE 160/180/EFI', '', 1, 'Pcs', '28', 'B8', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(62, 1, 1, 1, 0, 'G TVS: P170120-CABLE ASSY BRAKE FRONT XL SUPER/HD UPG NEW MODEL', 'CABLE ASSY BRAKE FRONT XL SUPER/HD UPG NEW MODEL', '', 1, 'Pcs', '28', 'B8', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(63, 1, 1, 1, 0, 'G TVS: K3140740-VACUUM HOSE (PEP)', 'VACUUM HOSE (PEP)', '', 1, 'Pcs', '18', 'B8', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(64, 1, 1, 1, 0, 'G TVS: K3170030-CABLE ASSY BRAKE FRONT PEP/STREAK', 'CABLE ASSY BRAKE FRONT PEP/STREAK', '', 1, 'Pcs', '28', 'B8', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(65, 1, 1, 1, 0, 'G TVS: N8170190-CABLE ASSY CLUTCH SPORT DLX/CVTI', 'CABLE ASSY CLUTCH SPORT DLX/CVTI', '', 1, 'Pcs', '28', 'B8', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(66, 1, 1, 1, 0, 'G TVS: N8170130-CABLE ASSY CHOKE STAR 110/BAS/IIVE/MAX4R', 'CABLE ASSY CHOKE STAR 110/BAS/IIVE/MAX4R', '', 1, 'Pcs', '28', 'B8', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(67, 1, 1, 1, 0, 'G TVS:K3170040-CABLE ASSY SPEEDO PEP/STREAK/VEGO/DISC', 'CABLE ASSY SPEEDO PEP/STREAK/VEGO/DISC', '', 1, 'Pcs', '28', 'B8', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(68, 1, 1, 1, 0, 'G TVS: P170080-CABLE ASSY SPEEDO METER XL/HD/BAS/UBG', 'CABLE ASSY SPEEDO METER XL/HD/BAS/UBG', '', 1, 'Pcs', '28', 'B8', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(69, 1, 1, 1, 0, 'G TVS: N8170200-ACC CABLE ASSY THROTTLE SPORT', 'ACC CABLE ASSY THROTTLE SPORT', '', 1, 'Pcs', '28', 'B8', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(70, 1, 1, 1, 0, 'G TVS: N9170230-THROTTLE CABLE ASSY APACHE', 'THROTTLE CABLE ASSY APACHE', '', 1, 'Pcs', '28', 'B8', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(71, 1, 1, 1, 0, 'G TVS: N8323690-CHAIN SPROCKET KIT (SPORT 110CC) 13/39', 'CHAIN SPROCKET KIT (SPORT 110CC) 13/39', '', 1, 'Pcs', '28', 'B7', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(72, 1, 1, 1, 0, 'G TVS: N8320100-CHAIN SPROCKET KIT STAR (110 DIA) 13/41', 'CHAIN SPROCKET KIT STAR (110 DIA) 13/41', '', 1, 'Pcs', '28', 'B7', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(73, 1, 1, 1, 0, 'G TVS: P3210210-LOCK SET XL SUPER HD NM (RED SOCKET)', 'LOCK SET XL SUPER HD NM (RED SOCKET)', '', 1, 'Pcs', '18', 'B7', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(74, 1, 1, 1, 0, 'G TVS: P3210220-LOCK SET XL NEW', 'LOCK SET XL NEW', '', 1, 'Pcs', '28', 'B7', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(75, 1, 1, 1, 0, 'G TVS: P140320-FUEL TAPE ASSY M14 (NEW MODEL)', 'FUEL TAPE ASSY M14 (NEW MODEL)', '', 1, 'Pcs', '28', 'B7', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(76, 1, 1, 1, 0, 'G TVS: K3150360-GRIP LH PEP', 'GRIP LH', '', 1, 'Pcs', '28', 'B7', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(77, 1, 1, 1, 0, 'G TVS: P080460-GEAR COMP KICK STARTER DRIVE', 'GEAR COMP KICK STARTER DRIVE', '', 1, 'Pcs', '28', 'B8', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(78, 1, 1, 1, 0, 'G TVS: N9322020-LEVER BRAKE RH (DISC RTR)', 'LEVER BRAKE RH (DISC RTR)', '', 1, 'Pcs', '28', 'B7', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(79, 1, 1, 1, 0, 'G TVS: R1011010-CAP OIL DRAIN (M1010380)( CAP INSPECTION HOLE) STAR CITY, VICTOR', 'CAP OIL DRAIN (M1010380)( CAP INSPECTION HOLE)', '', 1, 'Pcs', '28', 'B7', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(80, 1, 1, 1, 0, 'G TVS: K3160820-SWITCH PROP STAND (PEP)', 'SWITCH PROP STAND (PEP)', '', 1, 'Pcs', '28', 'B7', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(81, 1, 1, 1, 0, 'G TVS: N8150150-HOLDER BRAKE (DLX)', 'HOLDER BRAKE (DLX)', '', 1, 'Pcs', '28', 'B7', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(82, 1, 1, 1, 0, 'G TVS: N2110360-ABSORBER SHOCK REAR HUB (CUSH)', 'ABSORBER SHOCK REAR HUB (CUSH)', '', 1, 'Pcs', '28', 'B7', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(83, 1, 1, 1, 0, 'G TVS: K3200730-OIL DRAIN PLUG O-RING PEP', 'OIL DRAIN PLUG O-RING PEP', '', 1, 'Pcs', '28', 'B7', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(84, 1, 1, 1, 0, 'G TVS: K3150260-BRAKE LEVER RH (PEP)', 'BRAKE LEVER RH (PEP)', '', 1, 'Pcs', '28', 'B7', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(85, 1, 1, 1, 0, 'G TVS: K3150250-BRAKE LEVER LH (PEP)', 'BRAKE LEVER LH (PEP)', '', 1, 'Pcs', '28', 'B7', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(86, 1, 1, 1, 0, 'G TVS: P080410-STOPER KICK STARTER', 'STOPER KICK STARTER', '', 1, 'Pcs', '28', 'B7', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(87, 1, 1, 1, 0, 'G TVS: 0254096-PIECE THROTTLE CABLE END', 'PIECE THROTTLE CABLE END', '', 1, 'Pcs', '28', 'B7', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(88, 1, 1, 1, 0, 'G TVS: N8010260-O-RING CAP INSPECTION HOLE ', 'O-RING CAP INSPECTION HOLE ', '', 1, 'Pcs', '28', 'B7', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(89, 1, 1, 1, 0, 'G TVS: S1160360-SWITCH TRAFFICATION (INDICATOR)', 'SWITCH TRAFFICATION (INDICATOR)', '', 1, 'Pcs', '28', 'B7', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(90, 1, 1, 1, 0, 'G TVS : S1160350-SWITCH LIGHTLY', 'SWITCH LIGHTLY', '', 1, 'Pcs', '28', 'B7', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(91, 1, 1, 1, 0, 'G TV S : K3100400-PACKING FRONT FORK PEP', 'PACKING FRONT FORK PEP', '', 1, 'Pcs', '28', 'B7', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(92, 1, 1, 1, 0, 'G TVS: P200110-OIL SEAL 29*47*6 TYPE', 'OIL SEAL 29*47*6 TYPE', '', 1, 'Pcs', '28', 'B7', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(93, 1, 1, 1, 0, 'G TVS: N8161130-CONTROL SWITCH LH 110CC', 'CONTROL SWITCH LH 110CC', '', 1, 'Pcs', '28', 'B6', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(94, 1, 1, 1, 0, 'G TVS: T4110030-BACK PLATE ASSY COMP FRONT XL SUPER  H/D', 'BACK PLATE ASSY COMP FRONT', '', 1, 'Pcs', '28', 'B6', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(95, 1, 1, 1, 0, 'G TVS: K3320650-FACE COMP DRIVER ASSY (PEP)', 'FACE COMP DRIVER ASSY (PEP)', '', 1, 'Pcs', '28', 'B6', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(96, 1, 1, 1, 0, 'G TVS: K3080670-FACE COMP MOVEBLE DRIV (PEP)', 'FACE COMP MOVEBLE DRIV (PEP)', '', 1, 'Pcs', '28', 'B6', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(97, 1, 1, 1, 0, 'G TVS: N8160390-CONTROL SWITCH ASSY LH CITY', 'CONTROL SWITCH ASSY LH CITY', '', 1, 'Pcs', '28', 'B6', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(98, 1, 1, 1, 0, 'G TVS: N8160520-STARTER RELAY CITY ES', 'STARTER RELAY CITY ES', '', 1, 'Pcs', '28', 'B6', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(99, 1, 1, 1, 0, 'G TVS: N8160480-CONTROL LEVER ASSY RH CITY ES', 'CONTROL LEVER ASSY RH CITY ES', '', 1, 'Pcs', '28', 'B6', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(100, 1, 1, 1, 0, 'G TVS: K3160690-STARTER RELAY PEP', 'STARTER RELAY PEP', '', 1, 'Pcs', '28', 'B6', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(101, 1, 1, 1, 0, 'G TVS: K3321950-FRONT FORK KIT (PEP/PEP+)', 'FRONT FORK KIT (PEP/PEP+)', '', 1, 'Pcs', '28', 'B6', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(102, 1, 1, 1, 0, 'G TVS: K3211290-LOCK SET (PEP+)', 'LOCK SET (PEP+)', '', 1, 'Pcs', '18', 'B6', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(103, 1, 1, 1, 0, 'G TVS: N8320080-KIT PROP STAND (STAR)', 'KIT PROP STAND (STAR)', '', 1, 'Pcs', '28', 'B6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(104, 1, 1, 1, 0, 'G TVS: K3080690-SPRING MOVABLE DRIVE (PEP)', 'SPRING MOVABLE DRIVE (PEP)', '', 1, 'Pcs', '28', 'B6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(105, 1, 1, 1, 0, 'G TVS: P1150170-LASE VINDER RH NM', 'LASE VINDER RH NM', '', 1, 'Pcs', '28', 'B6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(106, 1, 1, 1, 0, 'G TVS: N8325660-KIT TENSIONER & GUIDE CAM CHAIN STAR CITY', 'KIT TENSIONER & GUIDE CAM CHAIN STAR CITY ', '', 1, 'Pcs', '28', 'B6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(107, 1, 1, 1, 0, 'G TVS: N8320070-STREEING COMP KIT STAR SPORT /CITY/APACHE', 'STREEING COMP KIT STAR SPORT /CITY/APACHE', '', 1, 'Pcs', '28', 'B6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(108, 1, 1, 1, 0, 'G TVS: K3150370-GRIP COM THROTTLE PEP', 'GRIP COM THROTTLE', '', 1, 'Pcs', '28', 'B6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(109, 1, 1, 1, 0, 'G TVS: 409115000-STAND SPRING END XL  SUPER H/D', 'STAND SPRING END', '', 1, 'Pcs', '18', 'B6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(110, 1, 1, 1, 0, 'G TVS: K3100410-SPRING FR FORK (PEP)', 'SPRING FR FORK (PEP)', '', 1, 'Pcs', '18', 'B6', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(111, 1, 1, 1, 0, 'G TVS: K3160170-SIDE STAND SWITCH (PEP)', 'SIDE STAND SWITCH (PEP)', '', 1, 'Pcs', '28', 'B6', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(112, 1, 1, 1, 0, 'G TVS: K3160270-HORN ASSY ( PEP)', 'HORN ASSY ( PEP)', '', 1, 'Pcs', '28', 'B6', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(113, 1, 1, 1, 0, 'G TVS : P1150120-CASE UPPER RH NEW ', 'CASE UPPER RH NEW ', '', 1, 'Pcs', '28', 'B6', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(114, 1, 1, 1, 0, 'G TVS: P1320020-DAMPER KIT CLUTCH', 'DAMPER KIT CLUTCH', '', 1, 'Pcs', '28', 'B6', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(115, 1, 1, 1, 0, 'G TVS: P1160130-SWITCH ASY IGNITION', 'SWITCH ASY IGNITION', '', 1, 'Pcs', '18', 'B6', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(116, 1, 1, 1, 0, 'G TVS : N9322240-KIT PAD ASSY REAR (RTR)', 'KIT PAD ASSY REAR (RTR)', '', 1, 'Pcs', '28', 'B6', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(117, 1, 1, 1, 0, 'G TVS : N8041200-ADAPTOR CARBURETOR( CITY 110 CC)', 'ADAPTOR CARBURETOR( CITY 110 CC)', '', 1, 'Pcs', '28', 'B6', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(118, 1, 1, 1, 0, 'G TVS : N3320050-SPEEDO GEAR KIT', 'SPEEDO GEAR KIT', '', 1, 'Pcs', '28', 'B6', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(119, 1, 1, 1, 0, 'G TVS : K4080150-PLUG OIL DRAIN (ZEST)', 'PLUG OIL DRAIN (ZEST)', '', 1, 'Pcs', '28', 'B6', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(120, 1, 1, 1, 0, 'G TVS : N9111300-DISH PAD KIT ASSY APACHE ', 'DISH PAD KIT ASSY APACHE ', '', 1, 'Pcs', '28', 'B6', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(121, 1, 1, 1, 0, 'G HERO: 14566086030S-PUSH ROD RUPPER', 'PUSH ROD RUPPER', '', 1, 'Pcs', '28', 'B5', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(122, 1, 1, 1, 0, 'G HERO : 000009114-SPLIT PIN BIG', 'SPLIT PIN BIG', '', 1, 'Pcs', '18', 'B5', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(123, 1, 1, 1, 0, 'G HERO : 93600050121HS-SCREW FLAT 5X10 ROTOP', 'SCREW FLAT 5X10 ROTOP', '', 1, 'Pcs', '18', 'B5', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(124, 1, 1, 1, 0, 'G HERO : 18291GBG850S-GASKET EXHAU', 'GASKET EXHAU', '', 1, 'Pcs', '18', 'B5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(125, 1, 1, 1, 0, 'G HERO : 53209GAH000S-CLIP HEAD LIGHT', 'CLIP HEAD LIGHT', '', 1, 'Pcs', '18', 'B5', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(126, 1, 1, 1, 0, 'G HERO : FR.HUB C/SUEW-ACTIVA FR.HUB COV SCREW', 'ACTIVA FR.HUB COV SCREW', '', 1, 'Pcs', '28', 'B5', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(127, 1, 1, 1, 0, 'G HERO : P4U -HA27662-T-T-NOSE CLIP A', 'T-NOSE CLIP A', '', 1, 'Pcs', '28', 'B5', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(128, 1, 1, 1, 0, 'G HERO : 16950KRP 981S-FUEL COOK ASSY PLEASURE', 'FUEL COOK ASSY PLEASURE', '', 1, 'Pcs', '28', 'B5', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(129, 1, 1, 1, 0, 'G HERO : 22401GF6000S -CLUTCH SPRING (EACH)', 'CLUTCH SPRING (EACH)', '', 1, 'Pcs', '18', 'B5', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(130, 1, 1, 1, 0, 'G HERO : 30700KWA831S-CAP ASSY NOISE SUP (HUNK) (30700K)', 'CAP ASSY NOISE SUP (HUNK) (30700K)', '', 1, 'Pcs', '28', 'B5', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(131, 1, 1, 1, 0, 'G HERO : 30700098150S-CAP ASSY NOISE SUPERS', 'CAP ASSY NOISE SUPERS', '', 1, 'Pcs', '28', 'B5', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(132, 1, 1, 1, 0, 'G HERO : 22815166000S-CLUTCH SPRING', 'CLUTCH SPRING', '', 1, 'Pcs', '18', 'B5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(133, 1, 1, 1, 0, 'G HERO : 90231087010S-NUT LOCK 14M3', 'NUT LOCK 14M3', '', 1, 'Pcs', '18', 'B5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(134, 1, 1, 1, 0, 'G HERO : 91307035000S-O RING OIL GANGE', 'O RING OIL GANGE', '', 1, 'Pcs', '28', 'B5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(135, 1, 1, 1, 0, 'G HERO: 90231198000S-NUT LOCK 1', 'NUT LOCK 1', '', 1, 'Pcs', '28', 'B5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(136, 1, 1, 1, 0, 'G HERO: 90112SB4000S-BOLT.F 6*14 (HL NOST)', 'BOLT.F 6*14 (HL NOST)', '', 1, 'Pcs', '28', 'B5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(137, 1, 1, 1, 0, 'G HERO: 90308357000S-NUT HEX 10MM', 'NUT HEX 10MM', '', 1, 'Pcs', '28', 'B5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(138, 1, 1, 1, 0, 'G HERO: 90801035000S-PLUG RUBBER', 'PLUG RUBBER', '', 1, 'Pcs', '28', 'B5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(139, 1, 1, 1, 0, 'G HERO: 18645MT4730S-GASKET AIR FEED PIPE', 'GASKET AIR FEED PIPE', '', 1, 'Pcs', '18', 'B5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(140, 1, 1, 1, 0, 'G HERO: 80101443000S-ROBBER S.METER', 'ROBBER S.METER', '', 1, 'Pcs', '28', 'B5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(141, 1, 1, 1, 0, 'G HERO: 61312149300S-BOOT HEAD LIGHT', 'BOOT HEAD LIGHT', '', 1, 'Pcs', '28', 'B5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(142, 1, 1, 1, 0, 'G HERO: 9280012000S-BOLT DRAIN PLUG 12MM', 'BOLT DRAIN PLUG 12MM', '', 1, 'Pcs', '28', 'B5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(143, 1, 1, 1, 0, 'G HERO: 90307001000S-NUT RR AXLE HALF', 'NUT RR AXLE HALF', '', 1, 'Pcs', '18', 'B5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(144, 1, 1, 1, 0, 'G HERO: 16201KTC900S-GASKET INLET PIPE', 'GASKET INLET PIPE', '', 1, 'Pcs', '18', 'B5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(145, 1, 1, 1, 0, 'G HERO: 31121198905S-EXCITOR COIL (IND.NP) (2 PIN)', 'EXCITOR COIL (IND.NP) (2 PIN)', '', 1, 'Pcs', '28', 'B4', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(146, 1, 1, 1, 0, 'G HERO: 52181001300S-SILENT BLOCK BUSH (SLK.P-17)', 'SILENT BLOCK BUSH (SLK.P-17)', '', 1, 'Pcs', '28', 'B4', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(147, 1, 1, 1, 0, 'G HERO: 52147KTC900S-REAR WHEEL STAY BUSH', 'REAR WHEEL STAY BUSH', '', 1, 'Pcs', '28', 'B4', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(148, 1, 1, 1, 0, 'G HERO: 31121198303S-EXCITOR COIL ND (T-PIN)', 'EXCITOR COIL ND (T-PIN)', '', 1, 'Pcs', '28', 'B4', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(149, 1, 1, 1, 0, 'G HERO: 22201GF6000S-CLUTCH FICTION DISC (SET-4)', 'CLUTCH FICTION DISC (SET-4)', '', 1, 'Pcs', '28', 'B4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(150, 1, 1, 1, 0, 'G HERO: 22321KE8000S-CLUTCH PLATE STEEL SPL', 'CLUTCH PLATE STEEL SPL', '', 1, 'Pcs', '28', 'B4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(151, 1, 1, 1, 0, 'G HERO: K22222HF100DS-CLUTCH ASSY SPL', 'CLUTCH ASSY SPL', '', 1, 'Pcs', '28', 'B4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(152, 1, 1, 1, 0, 'G HERO: 22361KPGT00S-CLUTCH PLATE LIFTER SSPL', 'CLUTCH PLATE LIFTER SSPL', '', 1, 'Pcs', '28', 'B4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(153, 1, 1, 1, 0, 'G HERO: 23801178000S-SPROCKET DRIVE 14T CDDLX NEW', 'SPROCKET DRIVE 14T CDDLX NEW', '', 1, 'Pcs', '28', 'B4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(154, 1, 1, 1, 0, 'G HERO: 12391KWP900S-GASKET HEAD COVER', 'GASKET HEAD COVER', '', 1, 'Pcs', '28', 'B4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(155, 1, 1, 1, 0, 'G HERO: 91255169000RS-OIL SEAL 30*24*11* FORK', 'OIL SEAL 30*24*11* FORK', '', 1, 'Pcs', '28', 'B4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(156, 1, 1, 1, 0, 'G HERO: K55912HF100DS-OIL SEAL 26K17DLS', 'OIL SEAL 26K17DLS', '', 1, 'Pcs', '28', 'B4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(157, 1, 1, 1, 0, 'G HERO: 14541GB4681S-SPRING CAM CHAIN TEN', 'SPRING CAM CHAIN TEN', '', 1, 'Pcs', '18', 'B4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(158, 1, 1, 1, 0, 'G HERO: 53171198900S-BRACKET R. HANDLE LEVER', 'BRACKET R. HANDLE LEVER', '', 1, 'Pcs', '28', 'B4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(159, 1, 1, 1, 0, 'G HERO: 53172198900S-BRACKET L. HANDLE LEVER', 'BRACKET L. HANDLE LEVER', '', 1, 'Pcs', '28', 'B4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(160, 1, 1, 1, 0, 'G HERO: 90100KV3700S-BOLT SOCKET 8MM (JUN)', 'BOLT SOCKET 8MM (JUN)', '', 1, 'Pcs', '18', 'B4', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(161, 1, 1, 1, 0, 'G HERO: 90407259000S-PACKING DRAIN COCK', 'PACKING DRAIN COCK', '', 1, 'Pcs', '28', 'B4', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(162, 1, 1, 1, 0, 'G HERO: 35753035010S-ROTOR NEUTRA SWITCH', 'ROTOR NEUTRA SWITCH', '', 1, 'Pcs', '28', 'B4', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(163, 1, 1, 1, 0, 'G HERO: 90201KCC900S-NUT CAP 7MM', 'NUT CAP 7MM', '', 1, 'Pcs', '18', 'B4', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(164, 1, 1, 1, 0, 'G HERO: 30500KCC710S-IGN COIL ASSY SPL ALLOY', 'IGN COIL ASSY SPL ALLOY', '', 1, 'Pcs', '28', 'B4', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(165, 1, 1, 1, 0, 'G HERO: 42610198900S-FLANGE FINAL DRIVER', 'FLANGE FINAL DRIVER', '', 1, 'Pcs', '28', 'B4', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(166, 1, 1, 1, 0, 'G HERO: 33100KCC710AS-HEAD LIGHT ASSY SPL PLUS (W/O BULB)', 'HEAD LIGHT ASSY SPL PLUS (W/O BULB)', '', 1, 'Pcs', '28', 'B4', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(167, 1, 1, 1, 0, 'G HERO: 20K411S-CHAIN SPROCKET KIT P+', 'CHAIN SPROCKET KIT P+', '', 1, 'Pcs', '28', 'B3', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(168, 1, 1, 1, 0, 'G HERO: 20K1120S-CHAIN SPROCKET KIT CD DLX/SPL PRO', 'CHAIN SPROCKET KIT CD DLX/SPL PRO', '', 1, 'Pcs', '28', 'B3', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(169, 1, 1, 1, 0, 'G HERO: 20K810S-10SL-CHAIN SPROCKET KIT (14/43T', 'CHAIN SPROCKET KIT (14/43T', '', 1, 'Pcs', '28', 'B3', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(170, 1, 1, 1, 0, 'G HERO: 20K1110S-CHAIN SPROCKET KIT CD DLX ALLOY', 'CHAIN SPROCKET KIT CD DLX ALLOY', '', 1, 'Pcs', '28', 'B3', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(171, 1, 1, 1, 0, 'G HERO: 53140AAC000S-GRIP RH HANDLE PASS PRO', 'GRIP RH HANDLE PASS PRO', '', 1, 'Pcs', '28', 'B3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(172, 1, 1, 1, 0, 'G HERO: 53166AAC000S-GRIP LH HANDLE PASS PRO', 'GRIP LH HANDLE PASS PRO', '', 1, 'Pcs', '28', 'B3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(173, 1, 1, 1, 0, 'G HERO: 9501151000S-RUBBER KICK STARTER', 'RUBBER KICK STARTER', '', 1, 'Pcs', '28', 'B3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(174, 1, 1, 1, 0, 'G HERO: 9501471702S-SPRING G MAIN STAND', 'SPRING G MAIN STAND', '', 1, 'Pcs', '18', 'B3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(175, 1, 1, 1, 0, 'G HERO: 28251GF6000S-SPINDLE KICK STARTER', 'SPINDLE KICK STARTER', '', 1, 'Pcs', '28', 'B3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(176, 1, 1, 1, 0, 'G HERO: 50512KTC900S-STAND PIN (SUP SPL)', 'STAND PIN (SUP SPL)', '', 1, 'Pcs', '28', 'B3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(177, 1, 1, 1, 0, 'G HERO: 15651198900S-GAUGE OIL LEVEL', 'GAUGE OIL LEVEL', '', 1, 'Pcs', '28', 'B3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(178, 1, 1, 1, 0, 'G HERO: 35340KCC900S-SWITCH ASSY FR STOP', 'SWITCH ASSY FR STOP', '', 1, 'Pcs', '28', 'B3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(179, 1, 1, 1, 0, 'G HERO: 35200KCCV710S-SWITCH ASSY WINKER SPL PLUS', 'SWITCH ASSY WINKER SPL PLUS', '', 1, 'Pcs', '28', 'B3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(180, 1, 1, 1, 0, 'G HERO: 35350KTC900S-SWITCH ASSY REARBSTOP', 'SWITCH ASSY REARBSTOP', '', 1, 'Pcs', '28', 'B3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(181, 1, 1, 1, 0, 'G HERO: 35350KCC900S-SWITCH ASSY RR STOP', 'SWITCH ASSY RR STOP', '', 1, 'Pcs', '28', 'B3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(182, 1, 1, 1, 0, 'G HERO: 35350KWA940S-WIRING ASSY RR STOP', 'WIRING ASSY RR STOP', '', 1, 'Pcs', '28', 'B3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(183, 1, 1, 1, 0, 'G HERO: 35150KTC920S-SWITCH ASSY RH (SELF)', 'SWITCH ASSY RH (SELF)', '', 1, 'Pcs', '28', 'B3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(184, 1, 1, 1, 0, 'G HERO: 35150KWA841S-START SWITCH ASSY', 'START SWITCH ASSY', '', 1, 'Pcs', '28', 'B3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(185, 1, 1, 1, 0, 'G HERO: 2830AKAG900S-ARM ASSY KICK STARTER', 'ARM ASSY KICK STARTER', '', 1, 'Pcs', '28', 'B3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(186, 1, 1, 1, 0, 'G HERO: 28300KVT900S-ARM ASSY KICK STARTER', 'ARM ASSY KICK STARTER', '', 1, 'Pcs', '28', 'B3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(187, 1, 1, 1, 0, 'G HERO: 61313KCC900S-STAY RH HEAD LIGHT', 'STAY RH HEAD LIGHT', '', 1, 'Pcs', '28', 'B3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(188, 1, 1, 1, 0, 'G HERO: 61314KCC900S-STAY LH HEAD LIGHT', 'STAY LH HEAD LIGHT', '', 1, 'Pcs', '28', 'B3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(189, 1, 1, 1, 0, 'G HERO: 38110KCC900S-HORN COMP SPL', 'HORN COMP SPL', '', 1, 'Pcs', '28', 'B3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(190, 1, 1, 1, 0, 'G HERO: 38110KST900S-HORN COMP (MIN)', 'HORN COMP (MIN)', '', 1, 'Pcs', '28', 'B3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(191, 1, 1, 1, 0, 'G HERO: 29K210S-S METER DRIVE KIT SPL+', 'S METER DRIVE KIT SPL+', '', 1, 'Pcs', '28', 'B3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(192, 1, 1, 1, 0, 'G HERO: 980565773800S-SPARK PLUG', 'SPARK PLUG', '', 1, 'Pcs', '28', 'B3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(193, 1, 1, 1, 0, 'G HERO: 35850KR3870S-SELF STARTER RELAY (SUP SPL/GLA)', 'SELF STARTER RELAY (SUP SPL/GLA)', '', 1, 'Pcs', '28', 'B3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(194, 1, 1, 1, 0, 'G HERO: 88110AAEH31S -MIRROR RH (ORD) PAS.PLUS BLACK', 'MIRROR RH (ORD) PAS.PLUS BLACK', '', 1, 'Pcs', '28', 'B3', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(195, 1, 1, 1, 0, 'G HERO : 88120AAEH31S-MIRROR .LH BLACK PASS ,SPL,PLUS', 'MIRROR .LH BLACK PASS ,SPL,PLUS', '', 1, 'Pcs', '28', 'B3', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(196, 1, 1, 1, 0, 'G HERO : 88110AACH412AS-MIRROR ASSY RH BLACK PASS.PRO', 'MIRROR ASSY RH BLACK PASS.PRO', '', 1, 'Pcs', '28', 'B3', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(197, 1, 1, 1, 0, 'G HERO : 88120AACH412AS-MIRROR ASSY LH BLACK PASS.PRO', 'MIRROR ASSY LH BLACK PASS.PRO', '', 1, 'Pcs', '28', 'B3', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(198, 1, 1, 1, 0, 'G HERO : 20K710S-CHAIN SPK KIT (SU SPL)', 'CHAIN SPK KIT (SU SPL)', '', 1, 'Pcs', '28', 'B2', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(199, 1, 1, 1, 0, 'G HERO : 20K211S-CHAIN & SPKT KIT Y2N ( 14/43T-TOGL)', 'CHAIN & SPKT KIT Y2N ( 14/43T-TOGL)', '', 1, 'Pcs', '28', 'B2', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(200, 1, 1, 1, 0, 'G HERO : 22311107000S-CLUTCH PLATE STEEL (EACH) CD100', 'CLUTCH PLATE STEEL (EACH) CD100', '', 1, 'Pcs', '28', 'B2', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(201, 1, 1, 1, 0, 'G HERO : K22222KTCE900S-DISH CLUTCH KIT (36KD20S)', 'DISH CLUTCH KIT (36KD20S)', '', 1, 'Pcs', '28', 'B2', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(202, 1, 1, 1, 0, 'G HERO : 22K130LS-CAM CHAIN KIT', 'CAM CHAIN KIT', '', 1, 'Pcs', '28', 'B2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(203, 1, 1, 1, 0, 'G HERO : 14401AAD00099S-CAM CHAIN BAI 1440117800', 'CAM CHAIN BAI 1440117800', '', 1, 'Pcs', '18', 'B2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(204, 1, 1, 1, 0, 'G HERO : 28261198000S-SPRING KICK STARTER', 'SPRING KICK STARTER', '', 1, 'Pcs', '18', 'B2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(205, 1, 1, 1, 0, 'G HERO : 25K170S-BALL RACES KIT ( ARCH/ GIMY )', 'BALL RACES KIT ( ARCH/ GIMY )', '', 1, 'Pcs', '18', 'B2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(206, 1, 1, 1, 0, 'G HERO : 25K180S-BALL RACE KIT ( PLEASURE)', 'BALL RACE KIT ( PLEASURE)', '', 1, 'Pcs', '18', 'B2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(207, 1, 1, 1, 0, 'G HERO : 25K160S-BALL RACER KIT', 'BALL RACER KIT', '', 1, 'Pcs', '18', 'B2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(208, 1, 1, 1, 0, 'G HERO : K96961HF100DS-ENGINE BEARING ( SET OF 5)KIT', 'ENGINE BEARING ( SET OF 5)KIT', '', 1, 'Pcs', '28', 'B2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(209, 1, 1, 1, 0, 'G HERO : 91001GF6000S-BEARING RADIAL 6304', 'BEARING RADIAL 6304', '', 1, 'Pcs', '18', 'B2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(210, 1, 1, 1, 0, 'G HERO : 961006203000S-BEARING BALL 6203', 'BEARING BALL 6203', '', 1, 'Pcs', '18', 'B2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(211, 1, 1, 1, 0, 'G HERO : 961406301010S-BEARING BALL 6201', 'BEARING BALL 6201', '', 1, 'Pcs', '18', 'B2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(212, 1, 1, 1, 0, 'G HERO : 24K150LS-VALVE KIT', 'VALVE KIT', '', 1, 'Pcs', '28', 'B2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(213, 1, 1, 1, 0, 'G HERO : 35100KCCH00AS-SWITCH ASSY & LOCK SPL ( 35100 KC)', 'SWITCH ASSY & LOCK SPL ( 35100 KC)', '', 1, 'Pcs', '18', 'B2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(214, 1, 1, 1, 0, 'G HERO : 28302KA900S-JOINT KICK ARM', 'JOINT KICK ARM', '', 1, 'Pcs', '28', 'B2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(215, 1, 1, 1, 0, 'G HERO : 14502086000RS-ROLLER CHAIN TENS SMALL', 'ROLLER CHAIN TENS SMALL', '', 1, 'Pcs', '28', 'B2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(216, 1, 1, 1, 0, 'G HERO : 14610086000RS-ROLLER CAM CHAIN BIG', 'ROLLER CAM CHAIN BIG', '', 1, 'Pcs', '28', 'B2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(217, 1, 1, 1, 0, 'G HERO : 43120365H705-SHOE COMP BRAKE (SET)', 'SHOE COMP BRAKE (SET)', '', 1, 'Pcs', '28', 'B2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(218, 1, 1, 1, 0, 'G HERO : 45125KCCHOOS-BRAKE SHOE FRONT (SET', 'BRAKE SHOE FRONT (SET)', '', 1, 'Pcs', '28', 'B2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(219, 1, 1, 1, 0, 'G HERO : 41241GB4770S-DAMBER RR WHEEL', 'DAMBER RR WHEEL', '', 1, 'Pcs', '28', 'B2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(220, 1, 1, 1, 0, 'G HERO : 41241KTC900S-DAMBER RR WHEEL', 'DAMBER RR WHEEL', '', 1, 'Pcs', '28', 'B2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(221, 1, 1, 1, 0, 'G HERO : 35210KCC900HS-SWITCH ASSY WINKER', 'SWITCH ASSY WINKER', '', 1, 'Pcs', '28', 'B2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(222, 1, 1, 1, 0, 'G HERO : 45451KCC900S-GUIDE FR FENDER CABIE', 'GUIDE FR FENDER CABIE', '', 1, 'Pcs', '28', 'B2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(223, 1, 1, 1, 0, 'G HERO : 12361035000S-CAP TAPPET ADJUSTING HOLE', 'CAP TAPPET ADJUSTING HOLE', '', 1, 'Pcs', '28', 'B2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(224, 1, 1, 1, 0, 'G HERO : 23801GF6000S-SPROCKET DRIVE', 'SPROCKET DRIVE', '', 1, 'Pcs', '28', 'B2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(225, 1, 1, 1, 0, 'G HERO : 17213KCC900LS-ELEMENT B AIR CLEANER', 'ELEMENT B AIR CLEANER', '', 1, 'Pcs', '18', 'B2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(226, 1, 1, 1, 0, 'G HERO :17211KCC900LS-ELEMENT A AIR CLEANER', 'ELEMENT A AIR CLEANER', '', 1, 'Pcs', '18', 'B2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(227, 1, 1, 1, 0, 'G HERO : 35010KCCH305-KEY SET', 'KEY SET', '', 1, 'Pcs', '18', 'B2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(228, 1, 1, 1, 0, 'G HERO : 84701P26D00AS-NUMBER PLADE REAR', 'NUMBER PLADE REAR', '', 1, 'Pcs', '28', 'B2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(229, 1, 1, 1, 0, 'G HERO : 64310198D20AS-NUMBER PLATE FRONT', 'NUMBER PLATE FRONT', '', 1, 'Pcs', '28', 'B2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(230, 1, 1, 1, 0, 'G HERO : 44830KWA830S-SPEEDA METER CABLE ( DIGITAL)', 'SPEEDA METER CABLE ( DIGITAL)', '', 1, 'Pcs', '28', 'B2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(231, 1, 1, 1, 0, 'G HERO : 44830KWA910S-S/M CABLE ( SPEEDA METER )', 'S/M CABLE ( SPEEDA METER )', '', 1, 'Pcs', '28', 'B2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(232, 1, 1, 1, 0, 'G HERO : 22121198900S-CENTRE CLUTCH', 'CENTRE CLUTCH', '', 1, 'Pcs', '28', 'B1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(233, 1, 1, 1, 0, 'G HERO : 22350115020S-CLUTCH PLATE PRESSURE CD100', 'CLUTCH PLATE PRESSURE CD100', '', 1, 'Pcs', '28', 'B1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(234, 1, 1, 1, 0, 'G HERO : 22350KPGT00S -CLUTCH PLATE PRESSURE SPL', 'CLUTCH PLATE PRESSURE SPL', '', 1, 'Pcs', '28', 'B1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(235, 1, 1, 1, 0, 'G HERO : 22120KTC900S-CENTRE COMP CLUTCH (SUB SPL)', 'CENTRE COMP CLUTCH (SUB SPL)', '', 1, 'Pcs', '28', 'B1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(236, 1, 1, 1, 0, 'G HERO : 24701KTC900S-GEAR PEDAL', 'GEAR PEDAL', '', 1, 'Pcs', '28', 'B1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(237, 1, 1, 1, 0, 'G HERO : 2830AKWH760S-KICKER LEVER (STARTER)', 'KICKER LEVER (STARTER)', '', 1, 'Pcs', '28', 'B1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(238, 1, 1, 1, 0, 'G HERO : 24701KCC900S-GEAR PEDAL (CHANGE)', 'GEAR PEDAL (CHANGE)', '', 1, 'Pcs', '28', 'B1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(239, 1, 1, 1, 0, 'G HERO : 46500KCC710S-PEDAL BRAKE', 'PEDAL BRAKE', '', 1, 'Pcs', '28', 'B1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(240, 1, 1, 1, 0, 'G HERO : 2830AKWA940S-KICK STARTER', 'KICK STARTER', '', 1, 'Pcs', '28', 'B1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(241, 1, 1, 1, 0, 'G HERO : 80102KCC900S-BASE TAIL LIGHT', 'BASE TAIL LIGHT', '', 1, 'Pcs', '28', 'B1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(242, 1, 1, 1, 0, 'G HERO : 53175AAFH00S-LEVER (HANDLE) RIGHT SIDE HANDLE', 'LEVER (HANDLE) RIGHT SIDE HANDLE', '', 1, 'Pcs', '28', 'B1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(243, 1, 1, 1, 0, 'G HERO : 53178AAFH00S-LEVER LH-SIDE HANDLE', 'LEVER LH-SIDE HANDLE', '', 1, 'Pcs', '28', 'B1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(244, 1, 1, 1, 0, 'G HERO : 21395GFC901S-GASKET MISSION CASE', 'GASKET MISSION CASE', '', 1, 'Pcs', '18', 'B1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(245, 1, 1, 1, 0, 'G HERO : 64315KWA940S-STAY FRONT NUMBER PLATE', 'STAY FRONT NUMBER PLATE', '', 1, 'Pcs', '28', 'B1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(246, 1, 1, 1, 0, 'G HERO : 50530KCC900S-SIDE STAND', 'SIDE STAND', '', 1, 'Pcs', '28', 'B1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(247, 1, 1, 1, 0, 'G HERO : 24610GF6000S-SPINDLE GEAR SHIFT ASSY', 'SPINDLE GEAR SHIFT ASSY', '', 1, 'Pcs', '28', 'B1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(248, 1, 1, 1, 0, 'G HERO : 17920KTP305S-CABLE SET THROTTLE', 'CABLE SET THROTTLE', '', 1, 'Pcs', '28', 'B1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(249, 1, 1, 1, 0, 'G HERO : 17910KWH9705-CABLE COMP SPL PRO THROTTLE', 'CABLE COMP SPL PRO THROTTLE', '', 1, 'Pcs', '28', 'B1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(250, 1, 1, 1, 0, 'G HERO : 17910KWA940S-CABLE PAS PRO THROTTLE3', 'CABLE PAS PRO THROTTLE3', '', 1, 'Pcs', '28', 'B1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(251, 1, 1, 1, 0, 'G HERO : 17910KCC900S-CABLE COMP THROTTLE', 'CABLE COMP THROTTLE', '', 1, 'Pcs', '28', 'B1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(252, 1, 1, 1, 0, 'G HERO : 83402KCC900S-PANEL INNER.', 'PANEL INNER.', '', 1, 'Pcs', '28', 'B1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(253, 1, 1, 1, 0, 'G HERO : 45450KCC710S-CABLE COMP FR BRAKE', 'CABLE COMP FR BRAKE', '', 1, 'Pcs', '28', 'B1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(254, 1, 1, 1, 0, 'G HERO : 17950KWP900S-CABLE COMP CHOKE', 'CABLE COMP CHOKE', '', 1, 'Pcs', '28', 'B1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(255, 1, 1, 1, 0, 'G HERO : 43450KTP900S-REAR BRAKE CABLE SET', 'REAR BRAKE CABLE SET', '', 1, 'Pcs', '28', 'B1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(256, 1, 1, 1, 0, 'G HERO : 22870KWA940S-CLUTCH CABLE PASS PRO', 'CLUTCH CABLE PASS PRO', '', 1, 'Pcs', '28', 'B1', 'G', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(257, 1, 1, 1, 0, 'G HERO : 22870KCC900S-CABLE COMP CLUTCH SPL', 'CABLE COMP CLUTCH SPL', '', 1, 'Pcs', '28', 'B1', 'G', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(258, 1, 1, 1, 0, 'G BAJJ : DP181063-WIND SHIELD PLATINA WIND', 'WIND SHIELD PLATINA WIND', '', 1, 'Pcs', '28', 'D3', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(259, 1, 1, 1, 0, 'G BAJJ : DU181031-WIND SHIELD (CT-100 DLX) ', 'WIND SHIELD (CT-100 DLX) ', '', 1, 'Pcs', '28', 'D3', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(260, 1, 1, 1, 0, 'G BAJJ : JN181001-WIND SHIELD DISCOVER', 'WIND SHIELD DISCOVER', '', 1, 'Pcs', '28', 'D3', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(261, 1, 1, 1, 0, 'G BAJJ : DJ 181033-WIND SHIELD GLASS (DTS)   ', 'WIND SHIELD GLASS (DTS)', '', 1, 'Pcs', '28', 'D3', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(262, 1, 1, 1, 0, 'G BAJJ : 31151021-SHOCK DAMPER DRUM (EACH) CD100, 4S , PLATINA', 'SHOCK DAMPER DRUM (EACH)', '', 1, 'Pcs', '28', 'D3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(263, 1, 1, 1, 0, 'G BAJJ : 36DS1002-VALVE KIT DISCOVER / DTSI  ', 'VALVE KIT DISCOVER / DTSI  ', '', 1, 'Pcs', '28', 'D3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(264, 1, 1, 1, 0, 'G BAJJ : 36DH4048-MAJOR TMC KIT PULSAR', 'MAJOR TMC KIT PULSAR', '', 1, 'Pcs', '28', 'D3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(265, 1, 1, 1, 0, 'G BAJJ : DJ151037-ADJUSTER CHAIN RH', 'ADJUSTER CHAIN RH', '', 1, 'Pcs', '28', 'D3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(266, 1, 1, 1, 0, 'G BAJJ : DJ151036-ADJUSTER CHAIN LH', 'ADJUSTER CHAIN LH', '', 1, 'Pcs', '28', 'D3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(267, 1, 1, 1, 0, 'G BAJJ : DJ 151088-CUSH RUBBER DTS ALLOY (COUPLING)', 'CUSH RUBBER DTS ALLOY (COUPLING)', '', 1, 'Pcs', '28', 'D3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(268, 1, 1, 1, 0, 'G BAJJ : 36DD4008-CLUTCH PLATE KIT CD100 PLATINA', 'CLUTCH PLATE KIT', '', 1, 'Pcs', '28', 'D3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(269, 1, 1, 1, 0, 'G BAJJ : JV551000-GEAR BOX SPRACKET (15 TH) DRIVE', 'GEAR BOX SPRACKET (15 TH) DRIVE', '', 1, 'Pcs', '28', 'D3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(270, 1, 1, 1, 0, 'G BAJJ : 36PA0004-KIT VALVE DISCOVER', 'KIT VALVE DISCOVER', '', 1, 'Pcs', '28', 'D3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(271, 1, 1, 1, 0, 'G BAJJ: 36PA0004-KIT VALVE DISCOVER', 'KIT VALVE DISCOVER', '', 1, 'Pcs', '28', 'D3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(272, 1, 1, 1, 0, 'G BAJJ : JC101035-CAM CHAIN (98) LINKS PULSAR 150', 'CAM CHAIN (98) LINKS', '', 1, 'Pcs', '18', 'D3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(273, 1, 1, 1, 0, 'G BAJJ : 36311028-VALVE KIT CAL / BOXR', 'VALVE KIT CAL / BOXR', '', 1, 'Pcs', '28', 'D3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(274, 1, 1, 1, 0, 'G BAJJ : 36314005-STEERING CONE KIT (KB 4S), PLATINA , PULSAR, CD100', 'STEERING CONE KIT (KB 4B)', '', 1, 'Pcs', '28', 'D3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(275, 1, 1, 1, 0, 'G BAJJ : 36JZ0103-CLUTCH STEEL PLATE KIT (CT 100 /PUI)', 'CLUTCH STEEL PLATE KIT (CT 100 /PUI)', '', 1, 'Pcs', '28', 'D3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(276, 1, 1, 1, 0, 'G BAJJ : DD201155-SWITCH CONTROL LH CAL 115C', 'SWITCH CONTROL LH CAL 115C', '', 1, 'Pcs', '28', 'D3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(277, 1, 1, 1, 0, 'G BAJJ : 36DU1004-GEAR LEVER SPRING KIT CT 100', 'GEAR LEVER SPRING KIT CT 100', '', 1, 'Pcs', '18', 'D3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(278, 1, 1, 1, 0, 'G BAJJ : 39167121-O.RING OIL FILTER', 'O.RING OIL FILTER', '', 1, 'Pcs', '28', 'D3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(279, 1, 1, 1, 0, 'G BAJJ : DJ 181037-DECAL WIND SHIELD PULSAR', 'DECAL WIND SHIELD PULSAR', '', 1, 'Pcs', '18', 'D3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(280, 1, 1, 1, 0, 'G BAJJ : DG 111008-SPARK PLUG PILSAR DTS 1', 'SPARK PLUG PILSAR DTS 1', '', 1, 'Pcs', '28', 'D3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(281, 1, 1, 1, 0, 'G BAJJ : DJ 141056-FUEL COCK ASSY PULSAR Y', 'FUEL COCK ASSY PULSAR Y', '', 1, 'Pcs', '28', 'D3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(282, 1, 1, 1, 0, 'G BAJJ : DD 111018-SPARK PLUG BOXER /CAL', 'SPARK PLUG BOXER /CAL', '', 1, 'Pcs', '28', 'D3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(283, 1, 1, 1, 0, 'G BAJJ : 36DU1503-GEAR LEVER SPRING KIT CT 100', 'GEAR MOTER SCROW KIT', '', 1, 'Pcs', '28', 'D3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(284, 1, 1, 1, 0, 'G BAJJ : 36DU1504-BUSH KIT (FRONT HUB) CT 100', 'BUSH KIT (FRONT HUB) CT 100', '', 1, 'Pcs', '28', 'D3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(285, 1, 1, 1, 0, 'G BAJJ : 36DJ4031-MAJOR KIT TMC PULSAR', 'MAJOR KIT TMC PULSAR', '', 1, 'Pcs', '28', 'D3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(286, 1, 1, 1, 0, 'G BAJJ : DH171014-SWING ARM BUSH PLASTIC', 'SWING ARM BUSH PLASTIC', '', 1, 'Pcs', '28', 'D3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(287, 1, 1, 1, 0, 'G BAJJ : DH101125-KICKER SPRING', 'KICKER SPRING', '', 1, 'Pcs', '18', 'D3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(288, 1, 1, 1, 0, 'G BAJJ : 36DU4017-CHAIN SPROCKET KIT 14TE 42T', 'CHAIN SPROCKET KIT 14TE 42T', '', 1, 'Pcs', '28', 'D3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(289, 1, 1, 1, 0, 'G BAJJ : 36DJ4005-CHAIN SPROCKET KIT DTS /15/44/ 4HD (PUL 180 UG3)', 'CHAIN SPROCKET KIT DTS /15/44/ 4HD (PUL 180 UG3)', '', 1, 'Pcs', '28', 'D3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(290, 1, 1, 1, 0, 'G BAJJ : 36DU4003-CHAIN SPROCKET KIT CT 100 NEW (46.47)', 'CHAIN SPROCKET KIT CT 100 NEW (46.47)', '', 1, 'Pcs', '28', 'D3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(291, 1, 1, 1, 0, 'G BAJJ : 36DZ0002-CHAIN SPROCKET KIT PLATINA ( 42T 14 )', 'CHAIN SPROCKET KIT PLATINA ( 42T 14 )', '', 1, 'Pcs', '28', 'D3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(292, 1, 1, 1, 0, 'G BAJJ : 52DU0104-GEAR SHAFT ASSY (LEVER COMP SUB ASSLY)', 'GEAR SHAFT ASSY (LEVER COMP SUB ASSLY)', '', 1, 'Pcs', '28', 'D3', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(293, 1, 1, 1, 0, 'G BAJJ : DU101185-LEVER CHANG WITH DAMBER CD 100', 'LEVER CHANG WITH DAMBER CD 100', '', 1, 'Pcs', '28', 'D3', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(294, 1, 1, 1, 0, 'G BAJJ : DH101468-SHIELD MUFFLER PUL / DT ', 'SHIELD MUFFLER PUL / DT ', '', 1, 'Pcs', '28', 'D3', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(295, 1, 1, 1, 0, 'G BAJJ : DH101397-GEAR LEVER ( 150/ 180/ 150 -DTS )', 'GEAR LEVER ( 150/ 180/ 150 -DTS )', '', 1, 'Pcs', '28', 'D3', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(296, 1, 1, 1, 0, 'G BAJJ : DH 101705-VALVE OIL SEAL D', 'VALVE OIL SEAL D', '', 1, 'Pcs', '28', 'D3', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(297, 1, 1, 1, 0, 'G BAJJ : DJ 191081-HOLDER LH DIGI N/M', 'HOLDER LH DIGI N/M', '', 1, 'Pcs', '28', 'D2', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(298, 1, 1, 1, 0, 'G BAJJ : DJ 201195-CLUTCH SWITCH CAMP ', 'CLUTCH SWITCH CAMP ', '', 1, 'Pcs', '28', 'D2', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(299, 1, 1, 1, 0, 'G BAJJ : DJ 201035-CLUTCH SWITCH UG3', 'CLUTCH SWITCH UG3', '', 1, 'Pcs', '28', 'D2', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(300, 1, 1, 1, 0, 'G BAJJ : DS 141014-PETROL TUPE DISCOVER', 'PETROL TUPE DISCOVER', '', 1, 'Pcs', '28', 'D2', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(301, 1, 1, 1, 0, 'G BAJJ : DJ 201246-CLUTCH SWITCH', 'CLUTCH SWITCH', '', 1, 'Pcs', '28', 'D2', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(302, 1, 1, 1, 0, 'G BAJJ : DH 191007-HAND GRIP LH PUL / DTS', 'HAND GRIP LH PUL / DTS', '', 1, 'Pcs', '28', 'D2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(303, 1, 1, 1, 0, 'G BAJJ : DH 191017-PIPE THROTTLE', 'PIPE THROTTLE', '', 1, 'Pcs', '28', 'D2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(304, 1, 1, 1, 0, 'G BAJJ : 36DK 0017-BRAKE ROD SPRING KIT', 'BRAKE ROD SPRING KIT', '', 1, 'Pcs', '18', 'D2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(305, 1, 1, 1, 0, 'G BAJJ : 36DJ 4016-OIL SEAL KIT PULSAR', 'OIL SEAL KIT PULSAR', '', 1, 'Pcs', '28', 'D2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(306, 1, 1, 1, 0, 'G BAJJ : DH 161240-SPRING SIDE STAND', 'SPRING SIDE STAND', '', 1, 'Pcs', '28', 'D2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(307, 1, 1, 1, 0, 'G BAJJ : 36 DH1601-RUBBER KIT SIDE PANEL', 'RUBBER KIT SIDE PANEL', '', 1, 'Pcs', '28', 'D2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(308, 1, 1, 1, 0, 'G BAJJ : DJ 191083-CLUTCH LEVER UG 5(LEVER GRIP LEFT )', 'CLUTCH LEVER UG 5(LEVER GRIP LEFT )', '', 1, 'Pcs', '28', 'D2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(309, 1, 1, 1, 0, 'G BAJJ : DJ 191055-CLUTCH LEVER  UG3', 'CLUTCH LEVER  UG3', '', 1, 'Pcs', '28', 'D2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(310, 1, 1, 1, 0, 'G BAJJ : DJ 191059-FRONT BRAKE LEVER ENDU W/ PATTI', 'FRONT BRAKE LEVER ENDU W/ PATTI', '', 1, 'Pcs', '28', 'D2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(311, 1, 1, 1, 0, 'G BAJJ : 36PA0002-KIT CAM CHAIN GUIDE DISCOVER 100CC', 'KIT CAM CHAIN GUIDE', '', 1, 'Pcs', '28', 'D2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(312, 1, 1, 1, 0, 'G BAJJ : 36 DH1003-GUIDE CHAIN KIT PULSAR', 'GUIDE CHAIN KIT PULSAR', '', 1, 'Pcs', '28', 'D2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(313, 1, 1, 1, 0, 'G BAJJ : 36 DH4030-CHAIN GUIDE KIT', 'CHAIN GUIDE KIT', '', 1, 'Pcs', '28', 'D2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(314, 1, 1, 1, 0, 'G BAJJ : JC 101038-CHAIN GUIDE KIT 200CC', 'CHAIN GUIDE KIT 200CC', '', 1, 'Pcs', '28', 'D2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(315, 1, 1, 1, 0, 'G BAJJ : 30191031 BRAKE PEDAL SPRING (RETURN) KB 4S', 'BRAKE PEDAL SPRING (RETURN)', '', 1, 'Pcs', '18', 'D2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(316, 1, 1, 1, 0, 'G BAJJ : DD111048-CAP SPARK PLUG CALBER 4S CD100', 'CAP SPARK PLUG', '', 1, 'Pcs', '28', 'D2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(317, 1, 1, 1, 0, 'G BAJJ : DH 191006-SPRING BRAKE PEDAL', 'SPRING BRAKE PEDAL', '', 1, 'Pcs', '18', 'D2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(318, 1, 1, 1, 0, 'G BAJJ : DJ 181087-OIL SEAL FORK DTS', 'OIL SEAL FORK DTS', '', 1, 'Pcs', '28', 'D2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(319, 1, 1, 1, 0, 'G BAJJ : 36311020-KICK SHAFT SPRING KIT 4S BOXER, CD100, PLATINA', 'KICK SHAFT SPRING KIT 4S BOXER', '', 1, 'Pcs', '28', 'D2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(320, 1, 1, 1, 0, 'G BAJJ : DH 171013-METAL BUSH WHEEL STAY (COLLAR SWING ARM)', 'METAL BUSH WHEEL STAY (COLLAR SWING ARM)', '', 1, 'Pcs', '28', 'D2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(321, 1, 1, 1, 0, 'G BAJJ : 31111056-EXCITER COIL ASSY 4S', 'EXCITER COIL ASSY', '', 1, 'Pcs', '28', 'D2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(322, 1, 1, 1, 0, 'G BAJJ : 31101067 GANGE OIL LEVEL 4S CALBER', 'GANGE OIL LEVEL', '', 1, 'Pcs', '28', 'D2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(323, 1, 1, 1, 0, 'G BAJJ : 36314002-FORK BALLS KIT STEEL STEER', 'FORK BALLS KIT STEEL STEER', '', 1, 'Pcs', '18', 'D2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(324, 1, 1, 1, 0, 'G BAJJ : 39102821-O.RING COIL PLATE', 'O.RING COIL PLATE', '', 1, 'Pcs', '28', 'D2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(325, 1, 1, 1, 0, 'G BAJJ : DH 171015-DUST SEAL SWING ARM', 'DUST SEAL SWING ARM', '', 1, 'Pcs', '28', 'D2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(326, 1, 1, 1, 0, 'G BAJJ : DJ 101064-GASKET EXHAUST', 'GASKET EXHAUST', '', 1, 'Pcs', '28', 'D2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(327, 1, 1, 1, 0, 'G BAJJ :39218919-OIL SEAL SMALL SPRACKET PULSAR', 'OIL SEAL SMALL SPRACKET', '', 1, 'Pcs', '28', 'D2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(328, 1, 1, 1, 0, 'G BAJJ : DL181080-OIL SEAL (D / S ) FORK CALIBER 4S CD100', 'OIL SEAL (D / S ) FORK', '', 1, 'Pcs', '28', 'D2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(329, 1, 1, 1, 0, 'G BAJJ : 36311008-VALVE REPIR KIT 4S', 'VALVE REPIR KIT 4S', '', 1, 'Pcs', '28', 'D2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(330, 1, 1, 1, 0, 'G BAJJ : 39201719-VALVE OIL SEAL DTS (EACH ) 4S CD100 PLATINA', 'VALVE OIL SEAL DTS (EACH ) ', '', 1, 'Pcs', '28', 'D2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(331, 1, 1, 1, 0, 'G BAJJ : JC 101034-CHAIN TENSIONER B.K PULSAR 150', 'CHAIN TENSIONER B.K', '', 1, 'Pcs', '28', 'D2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(332, 1, 1, 1, 0, 'G BAJJ : 31111058-PICK UP COIL PULSAR', 'PICK UP COIL PULSAR', '', 1, 'Pcs', '28', 'D2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(333, 1, 1, 1, 0, 'G BAJJ : DD101325-CAP OIL FILTER CALIBER, CD100, PLATINA, 4S', 'CAP OIL FILTER', '', 1, 'Pcs', '28', 'D2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(334, 1, 1, 1, 0, 'G BAJJ : 30101142 OIL SEAL KICK ( COMMON ) ALL VEHICAL IN BAJJAJ', 'OIL SEAL KICK', '', 1, 'Pcs', '28', 'D2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(335, 1, 1, 1, 0, 'G BAJJ : 39219019-OIL SEAL G SHAFT PULSAR', 'OIL SEAL G SHAFT', '', 1, 'Pcs', '28', 'D2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(336, 1, 1, 1, 0, 'G BAJJ : 36PA 0042-CHAIN SPROCKET KIT DISCOVER', 'CHAIN SPROCKET KIT DISCOVER', '', 1, 'Pcs', '28', 'D2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(337, 1, 1, 1, 0, 'G BAJJ :DD121181-ELEMENT OIL FILTER CALBER, 4S CD100', 'ELEMENT OIL FILTER', '', 1, 'Pcs', '28', 'D2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(338, 1, 1, 1, 0, 'G BAJJ : 30151105 BRAKE SHOE SET KB PULSAR', 'BRAKE SHOE SET KB PULSAR', '', 1, 'Pcs', '28', 'D1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(339, 1, 1, 1, 0, 'G BAJJ : 31151060-BRAKE SHOE KIT 4S BOXER', 'BRAKE SHOE KIT 4S BOXER', '', 1, 'Pcs', '28', 'D1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(340, 1, 1, 1, 0, 'G BAJJ : JZ 232600-LOCK SET (3 IN 1)', 'LOCK SET (3 IN 1)', '', 1, 'Pcs', '28', 'D1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(341, 1, 1, 1, 0, 'G BAJJ :DH 181069-LOCK KIT PUISAR UG4', 'LOCK KIT PUISAR UG4', '', 1, 'Pcs', '28', 'D1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(342, 1, 1, 1, 0, 'G BAJJ : DS 181036-LOCK SET DISCOVER (3 IN 1)', 'LOCK SET DISCOVER (3 IN 1)', '', 1, 'Pcs', '28', 'D1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(343, 1, 1, 1, 0, 'G BAJJ : DH 191041-CABLE CLUTCH DTS 1', 'CABLE CLUTCH DTS 1', '', 1, 'Pcs', '28', 'D1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(344, 1, 1, 1, 0, 'G BAJJ : DU 191013-S.METER CABLE SET CT-100 PLATINA', 'S.METER CABLE SET CT-100 PLATINA', '', 1, 'Pcs', '28', 'D1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(345, 1, 1, 1, 0, 'G BAJJ : DU 191005-THROTTLE CABLE', 'THROTTLE CABLE', '', 1, 'Pcs', '28', 'D1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(346, 1, 1, 1, 0, 'G BAJJ : DD191125-CHOKE CABLE ASSY CALBER', 'CHOKE CABLE ASSY', '', 1, 'Pcs', '28', 'D1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(347, 1, 1, 1, 0, 'G BAJJ : JZ 581011-AIR FILTER DIS 125 ,150,100', 'AIR FILTER DIS 125 ,150,100', '', 1, 'Pcs', '28', 'D1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(348, 1, 1, 1, 0, 'G BAJJ : JZ 161200-CLUTCH CABLE', 'CLUTCH CABLE', '', 1, 'Pcs', '28', 'D1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(349, 1, 1, 1, 0, 'G BAJJ : DU 191006-CABLE CLUTCH', 'CABLE CLUTCH', '', 1, 'Pcs', '28', 'D1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(350, 1, 1, 1, 0, 'G BAJJ : DM191002-CABLE STARTER (K- TECH ) BOXER', 'CABLE STARTER (K- TECH )', '', 1, 'Pcs', '28', 'D1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2);
INSERT INTO `m_item` (`itemno`, `stockpointno`, `itemcategoryno`, `itemgroupno`, `itemsubgroupno`, `itemname`, `itemdescription`, `hsncode`, `packno`, `packdescription`, `gst`, `rackname`, `rowname`, `minstock`, `barcode`, `color`, `size`, `originalprice`, `mrp`, `disamount`, `supplierno`) VALUES
(351, 1, 1, 1, 0, 'G BAJJ :DS 191054-FRONT BRAKE CABLE DIS-125 CC', 'FRONT BRAKE CABLE DIS-125 CC', '', 1, 'Pcs', '28', 'D1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(352, 1, 1, 1, 0, 'G BAJJ : DJ 191015-FR BRAKE CABLE DIS -125 CC', 'FR BRAKE CABLE DIS -125 CC', '', 1, 'Pcs', '28', 'D1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(353, 1, 1, 1, 0, 'G BAJJ : JZ161201-ACC CABLE SET DISCOVER 100, DISCOVER 125', 'ACC CABLE SET', '', 1, 'Pcs', '28', 'D1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(354, 1, 1, 1, 0, 'G BAJJ :DP 161144-NUMBER PLATE FRONT ALL VEHICALE IN BAJAJ', 'NUMBER PLATE FRONT', '', 1, 'Pcs', '28', 'D1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(355, 1, 1, 1, 0, 'G BAJJ : DP 161145-NUMBER PLATE REAR', 'NUMBER PLATE REAR', '', 1, 'Pcs', '28', 'D1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(356, 1, 1, 1, 0, 'G BAJJ :DS 191053-S.METER CABLE DIC-125 CC', 'S.METER CABLE DIC-125 CC', '', 1, 'Pcs', '28', 'D1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(357, 1, 1, 1, 0, 'G BAJJ :DJ 191061-ACC CABLE SET DTS1 DIGITEL', 'ACC CABLE SET DTS1 DIGITEL', '', 1, 'Pcs', '28', 'D1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(358, 1, 1, 1, 0, 'G BAJJ :31121029-FOAM ELEMENT AIR CLEANER 4S', 'FOAM ELEMENT AIR CLEANER', '', 1, 'Pcs', '18', 'D1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(359, 1, 1, 1, 0, 'G BAJJ :DK 121009-FILTER ASSY', 'FILTER ASSY', '', 1, 'Pcs', '18', 'D1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(360, 1, 1, 1, 0, 'G BAJJ :JD 511010-HEAD COVER RUBBER GASKET DISCOVER 100, PULSAR 135', 'HEAD COVER RUBBER GASKET', '', 1, 'Pcs', '28', 'D1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(361, 1, 1, 1, 0, 'G BAJJ :PA 581029-FILTER ELEMENT DISCOVER.100M', 'FILTER ELEMENT DISCOVER.100M', '', 1, 'Pcs', '28', 'D1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(362, 1, 1, 1, 0, 'G BAJJ :DJ 161218-SIDE STANT DTS-A', 'SIDE STANT DTS-A', '', 1, 'Pcs', '28', 'D1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(363, 1, 1, 1, 0, 'G BAJJ :DL161048-STAND SIDE 4S CALIBER, CD100', 'STAND SIDE', '', 1, 'Pcs', '28', 'D1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(364, 1, 1, 1, 0, 'G BAJJ :DU 191008-FR.BRAKE CABLE CT-100 PLATINA', 'FR.BRAKE CABLE CT-100 PLATINA', '', 1, 'Pcs', '28', 'D1', 'G', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(365, 1, 1, 1, 0, 'G BAJJ :52JZ0264-LEVER COMP GEAR SHIFT', 'LEVER COMP GEAR SHIFT', '', 1, 'Pcs', '28', 'D1', 'G', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(366, 1, 1, 1, 0, 'G HOND : 17211 KSP 900-ELEMENT AIR CLEANER UNICORN', 'ELEMENT AIR CLEANER UNICORN', '', 1, 'Pcs', '28', 'E2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(367, 1, 1, 1, 0, 'G HOND : 17210 KVT D00-ELEMENT AIR CLEANER ( AV,ATOR)', 'ELEMENT AIR CLEANER ( AV,ATOR)', '', 1, 'Pcs', '28', 'E2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(368, 1, 1, 1, 0, 'G HOND : 17211 KWS 900-ELEMENT AIR CLEANER  (TWISTER)', 'ELEMENT AIR CLEANER  (TWISTER)', '', 1, 'Pcs', '28', 'E2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(369, 1, 1, 1, 0, 'G HOND : 17211 KTE 651-ELEMENT AIR /C', 'ELEMENT AIR /C', '', 1, 'Pcs', '28', 'E2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(370, 1, 1, 1, 0, 'G HOND : 17211 KWP D00-AIR ELEMENT ACT 110 CC', 'AIR ELEMENT ACT 110 CC', '', 1, 'Pcs', '28', 'E2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(371, 1, 1, 1, 0, 'G HOND : 42753 KZK 901-TUBELESS MOUTH ( TRITON ) VALVE RIM', 'TUBELESS MOUTH ( TRITON ) VALVE RIM', '', 1, 'Pcs', '28', 'E2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(372, 1, 1, 1, 0, 'G HOND : 05321 KEM P00-KIT RACE STREE RING ACTIVA', 'KIT RACE STREE RING ACTIVA', '', 1, 'Pcs', '28', 'E2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(373, 1, 1, 1, 0, 'G HOND : 01621 KPL 840-KIT PACKING CARB', 'KIT PACKING CARB', '', 1, 'Pcs', '28', 'E2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(374, 1, 1, 1, 0, 'G HOND : 35170 KPL 842-SW UNIT DIMMER', 'SW UNIT DIMMER', '', 1, 'Pcs', '28', 'E2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(375, 1, 1, 1, 0, 'G HOND : 53168 KPL 900-BRAKE YOKE RH ACTIVA', 'BRAKE YOKE RH ACTIVA', '', 1, 'Pcs', '28', 'E2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(376, 1, 1, 1, 0, 'G HOND : 35160 KVT 901-SELF START SWITCH', 'SELF START SWITCH', '', 1, 'Pcs', '28', 'E2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(377, 1, 1, 1, 0, 'G HOND : 12391 GCC 000-GASKET HEAD COVER BEADING', 'GASKET HEAD COVER BEADING', '', 1, 'Pcs', '28', 'E2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(378, 1, 1, 1, 0, 'G HOND : 0222B KTE 910-KIT DISC CLUTCH FRICTION SHINE', 'KIT DISC CLUTCH FRICTION SHINE', '', 1, 'Pcs', '28', 'E2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(379, 1, 1, 1, 0, 'G HOND :22321 KPS 900-CLUTCH PLATE STEEL ( EACH )', 'CLUTCH PLATE STEEL ( EACH )', '', 1, 'Pcs', '28', 'E2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(380, 1, 1, 1, 0, 'G HOND : 35014 KWP 910-KEY SET ACTIVA', 'KEY SET ACTIVA', '', 1, 'Pcs', '18', 'E2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(381, 1, 1, 1, 0, 'G HOND : 53168 KWP 900-FRONT BRAKE YOKE ACT 110', 'FRONT BRAKE YOKE ACT 110', '', 1, 'Pcs', '28', 'E2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(382, 1, 1, 1, 0, 'G HOND : 53172 KRP 980-BRACKET HANDLE LH', 'BRACKET HANDLE LH', '', 1, 'Pcs', '28', 'E2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(383, 1, 1, 1, 0, 'G HOND : 05141 KPL 840-FRONT SHOCK BUSH KIT ACTIVA ', 'FRONT SHOCK BUSH KIT ACTIVA ', '', 1, 'Pcs', '28', 'E2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(384, 1, 1, 1, 0, 'G HOND : 22870 KSP 901-CLUTCH CABLE UNICORN', 'CLUTCH CABLE UNICORN', '', 1, 'Pcs', '28', 'E2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(385, 1, 1, 1, 0, 'G HOND : 44830 KPL 900-S METER CABLE SET ACTIVA', 'S METER CABLE SET ACTIVA', '', 1, 'Pcs', '28', 'E2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(386, 1, 1, 1, 0, 'G HOND : 22870 KTE 910-CLUTCH CABLE', 'CLUTCH CABLE', '', 1, 'Pcs', '28', 'E2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(387, 1, 1, 1, 0, 'G HOND : 17910 KTE 650-THROTTLE  CABLE SHINE', 'THROTTLE  CABLE SHINE', '', 1, 'Pcs', '28', 'E2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(388, 1, 1, 1, 0, 'G HOND : 17950 KTE 910-CABLE CHOKE 2013', 'CABLE CHOKE 2013', '', 1, 'Pcs', '28', 'E2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(389, 1, 1, 1, 0, 'G HOND : 17950 KTE 650-CHOKE CABLE SHINE', 'CHOKE CABLE SHINE', '', 1, 'Pcs', '28', 'E2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(390, 1, 1, 1, 0, 'G HOND : 02380 KSP 860-CHAIN SP[ROCKET KIT ( UNICORN ) ALLOY', 'CHAIN SP[ROCKET KIT ( UNICORN ) ALLOY', '', 1, 'Pcs', '28', 'E1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(391, 1, 1, 1, 0, 'G HOND : 02380 KTE  P11-CHAIN SPROCKET KIT SHIN', 'CHAIN SPROCKET KIT SHIN', '', 1, 'Pcs', '28', 'E1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(392, 1, 1, 1, 0, 'G HOND : 02380 K23 900-CHAIN SPROCKET KIT NEO CC', 'CHAIN SPROCKET KIT NEO CC', '', 1, 'Pcs', '28', 'E1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(393, 1, 1, 1, 0, 'G HOND : 06430 GBJ K20-BRAKE SHOE SET UNICORN', 'BRAKE SHOE SET UNICORN', '', 1, 'Pcs', '28', 'E1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(394, 1, 1, 1, 0, 'G HOND : 51401 KTE 913-FRONT FOR SPRING SHINE', 'FRONT FOR SPRING SHINE', '', 1, 'Pcs', '28', 'E1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(395, 1, 1, 1, 0, 'G HOND : 18318 KWP F00-PROTECTOR MUFFLER ACT 110', 'PROTECTOR MUFFLER ACT 110', '', 1, 'Pcs', '28', 'E1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(396, 1, 1, 1, 0, 'G HOND : 18318 KWP 940-COVER ) PROTECTER MUFFIER (BK) ACTIVA 110CC', '( SILLER COVER ) PROTECTER MUFFIER (BK) ACTIVA 110CC', '', 1, 'Pcs', '28', 'E1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(397, 1, 1, 1, 0, 'G HOND : 17683 KPL 900-TUPE COMP FUEL', 'TUPE COMP FUEL', '', 1, 'Pcs', '28', 'E1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(398, 1, 1, 1, 0, 'G HOND : 12391 KRM 840-GASKET HEAD COVER BEADING', 'GASKET HEAD COVER BEADING', '', 1, 'Pcs', '28', 'E1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(399, 1, 1, 1, 0, 'G HOND : 06410 KSP 900-DAMBER WHEEL UNICORN SET OF 4', 'DAMBER WHEEL UNICORN SET OF 4', '', 1, 'Pcs', '28', 'E1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(400, 1, 1, 1, 0, 'G HOND : 53178 KTE A00-LEVER L HANDLE SHINE', 'LEVER L HANDLE SHINE', '', 1, 'Pcs', '28', 'C1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(401, 1, 1, 1, 0, 'G HOND : 53175 KTE A00-LEVER R HANDLE SHINE', 'LEVER R HANDLE SHINE', '', 1, 'Pcs', '28', 'E1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(402, 1, 1, 1, 0, 'G HOND : 53175 KSP 900 -LEVER RH UNICORN STEERING HANDLE', 'LEVER RH UNICORN STEERING HANDLE', '', 1, 'Pcs', '28', 'E1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(403, 1, 1, 1, 0, 'G HOND : 06410 K67 900-CUSH RUBBER (DAMPER SET WHEEL)', 'CUSH RUBBER (DAMPER SET WHEEL)', '', 1, 'Pcs', '28', 'E1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(404, 1, 1, 1, 0, 'G HOND : 06455-KSP 305-FR DISC PAD SET', 'FR DISC PAD SET', '', 1, 'Pcs', '28', 'E1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(405, 1, 1, 1, 0, 'G HOND : 06455 KPP NO1FR BRAKE PAD SET SHINE TWISTER', 'FR BRAKE PAD SET SHINE TWISTER', '', 1, 'Pcs', '28', 'E1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(406, 1, 1, 1, 0, 'G HOND : 28150 KPL 900-HOLDER START', 'HOLDER START', '', 1, 'Pcs', '28', 'E1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(407, 1, 1, 1, 0, 'G HOND : 14520 KSP 910-TENSIONER LIFTER ASSY SHAIN', 'TENSIONER LIFTER ASSY SHAIN', '', 1, 'Pcs', '28', 'E1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(408, 1, 1, 1, 0, 'G HOND : 22123 KPL 305-CLUTCH ROLLER SET WEIGHT', 'CLUTCH ROLLER SET WEIGHT', '', 1, 'Pcs', '28', 'E1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(409, 1, 1, 1, 0, 'G HOND : 05030 KSP 860-KIT RACE STEERING UNICORN ,SHINE', 'KIT RACE STEERING UNICORN ,SHINE', '', 1, 'Pcs', '28', 'E1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(410, 1, 1, 1, 0, 'G HOND : 53172 KWP 910-BRACKET CBRAKE LEVER ACTIVA 100CC', 'BRACKET CBRAKE LEVER ACTIVA 100CC', '', 1, 'Pcs', '28', 'E1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(411, 1, 1, 1, 0, 'G HOND : 17910 KSP 900-ACC CABLE UNICORN', 'ACC CABLE UNICORN', '', 1, 'Pcs', '28', 'E1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(412, 1, 1, 1, 0, 'G HOND : 45450 KRP 980-FROND BRAKE CABLE', 'FROND BRAKE CABLE', '', 1, 'Pcs', '28', 'E1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(413, 1, 1, 1, 0, 'G HOND : 17950 KSP 900-CHOKE CABLE', 'CHOKE CABLE', '', 1, 'Pcs', '28', 'E1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(414, 1, 1, 1, 0, 'G HOND : 44830 KTE 911-S.METER CABLE SHINE', 'S.METER CABLE SHINE', '', 1, 'Pcs', '28', 'E1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(415, 1, 1, 1, 0, 'G HOND : 45450 KTE 910-FRONT BRAKE CABLE SHINE', 'FRONT BRAKE CABLE SHINE', '', 1, 'Pcs', '28', 'E1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(416, 1, 1, 1, 0, 'G HOND : 44830 KSP 901-CABLE S.M. UNICORN', 'CABLE S.M. UNICORN', '', 1, 'Pcs', '28', 'E1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(417, 1, 1, 1, 0, 'G HERO : 50500 KCC 870S-STAND COMP M', 'STAND COMP M', '', 1, 'Pcs', '28', 'B5', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(418, 1, 1, 1, 0, 'G TVS : TTY -25016-JUM-TVS TIRE', 'TVS TIRE', '', 1, 'Pcs', '28', 'A1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(419, 1, 1, 1, 0, 'G TVS : TTY 27518SC36-TVS TIRE', 'TVS TIRE', '', 1, 'Pcs', '28', 'A2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(420, 1, 1, 1, 0, 'G TVS : TTY -25016-RIB-TVS TIRE', 'TVS TIRE', '', 1, 'Pcs', '28', 'A3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(421, 1, 1, 1, 0, 'S TVS: NIMMY 248-SEAT HANDLE XLN ( HOOK TYPE )', 'SEAT HANDLE XLN ( HOOK TYPE )', '', 1, 'Pcs', '28', 'C B 2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(422, 1, 1, 1, 0, 'S TVS : NIMMY 251-SEAT HANDLE XLN 2005 ( NEW MODEL )', 'SEAT HANDLE XLN 2005 ( NEW MODEL )', '', 1, 'Pcs', '28', 'C B 2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(423, 1, 1, 1, 0, 'S TVS : SK LHW D1613-PVC LH W / HOOK SPL ( LADIES HANDLE ', 'PVC LH W / HOOK SPL ( LADIES HANDLE )', '', 1, 'Pcs', '28', 'C B 2 ', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(424, 1, 1, 1, 0, 'S TVS : NIMMY 032--DOUBLE BUMBER XL-SUPER CP', 'DOUBLE BUMBER XL-SUPER CP', '', 1, 'Pcs', '28', 'C C 1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(425, 1, 1, 1, 0, 'S TVS : NIMMY 010--SAREEGUARD RH CP XLN', 'SAREEGUARD RH CP XLN', '', 1, 'Pcs', '28', 'C C 1 ', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(426, 1, 1, 1, 0, 'S TVS : NIMMY 029-SAREEGUARD LH CP XLN', 'SAREEGUARD LH CP XLN', '', 1, 'Pcs', '28', 'C C 1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(427, 1, 1, 1, 0, 'S TVS : 0427616002 GRILL SET SUPER', 'HEAD LAMP GRILL SET XL SUPER', '', 1, 'Pcs', '28', 'C C 2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(428, 1, 1, 1, 0, 'S TVS : NIMMY 006--DOUPLE BUMBER CP', 'DOUPLE BUMBER CP', '', 1, 'Pcs', '28', 'C C 2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(429, 1, 1, 1, 0, 'S HERO :D161C -2 IN 1-2 IN 1 (PVC ) PASSION PRO L1H W /  HOOK', '2 IN 1 (PVC ) PASSION PRO L1H W /  HOOK', '', 1, 'Pcs', '28', 'C B 2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(430, 1, 1, 1, 0, 'S HERO : D 161 B-LADIES HANDLE  W / HOOK CP 100 CC', 'LADIES HANDLE  W / HOOK CP 100 CC', '', 1, 'Pcs', '28', 'C C 2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(431, 1, 1, 1, 0, 'OIL :ELF -MOTO 4 1L ( L 175304 )-ELF OIL 1LITER ( MOTO 4 GOLD )', 'ELF OIL 1LITER ( MOTO 4 GOLD )', '', 1, 'Pcs', '18', 'C D', '3 G', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(432, 1, 1, 1, 0, 'OIL :ELF 4T 900 ML ( L175147 )-ELF OIL 900ML ( MOTO 4 GOLD )', 'ELF OIL 900ML ( MOTO 4 GOLD )', '', 1, 'Pcs', '18', 'C D', '3 G', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(433, 1, 1, 1, 0, 'OIL :LAX -4T 900ML ( LX 003 )-LAXOL 4T OIL ( 4 STROKE ENGINE OIL )', 'LAXOL 4T OIL ( 4 STROKE ENGINE OIL )', '', 1, 'Pcs', '18', 'C D', '3 G', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(434, 1, 1, 1, 0, 'OIL :LAX - 4T ( LX 002 ) -LAXOL 4T OIL LAXOL 4 - STROKE ENGINE OIL', 'LAXOL 4T OIL LAXOL 4 - STROKE ENGINE OIL', '', 1, 'Pcs', '18', 'C D', '3 G', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(435, 1, 1, 1, 0, 'S OTR : SAP-BRAKE  PEDAL RUBBER', 'BRAKE  PEDAL RUBBER', '', 1, 'Pcs', '28', 'C D', '3 F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(436, 1, 1, 1, 0, 'S OTR :VIJAYLUX 35 /35 ( TRL - 203 A )', 'HEAD LAMP BULB 12V 35 /35 B', '', 1, 'Pcs', '18', 'C D', '3 G', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(437, 1, 1, 1, 0, 'S OTR :SAP -2101 T-TAIL & STOP LIGHT BULB 12V / 10 / 5 W', 'TAIL & STOP LIGHT BULB 12V / 10 / 5 W', '', 1, 'Pcs', '18', 'C D', '3 E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(438, 1, 1, 1, 0, 'S OTR :SAP -2073-INDICATOR BUIB 12V -10W', 'INDICATOR BUIB 12V -10W', '', 1, 'Pcs', '18', 'C D', '3 E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(439, 1, 1, 1, 0, 'S OTR :PHILIPS - M80 -HL-BUIB HALO', 'BUIB HALO', '', 1, 'Pcs', '18', 'C D', '3 E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(440, 1, 1, 1, 0, 'S OTR :PHILIPS - SPL+ -H.L ( HS1 ) ( 77237160 )-BULB SPL', 'BULB SPL', '', 1, 'Pcs', '18', 'C D', '3 E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(441, 1, 1, 1, 0, 'OIL :CAS -ACT - 4 -T 1L ( B 22740451 )-CASTROL ACTIV 4T 1LITER ( 20 W 40 )', 'CASTROL ACTIV 4T 1LITER ( 20 W 40 )', '', 1, 'Pcs', '18', 'C D', '3 C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(442, 1, 1, 1, 0, 'OIL :CAS ACTIV 4T 900 ( B 22745256 )-CASTROL ACTIV 4T 900 ML (20 W 40)', 'CASTROL ACTIV 4T 900 ML (20 W 40)', '', 1, 'Pcs', '18', 'C D', '3 C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(443, 1, 1, 1, 0, 'S OTR :CP - 661-CAMLIN WIRE 5 MM (ROLL )', 'CAMLIN WIRE 5 MM (ROLL )', '', 1, 'Pcs', '28', 'C D', '2 F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(444, 1, 1, 1, 0, 'S OTR :CP -660-CAMLIN WIRE 4 MM (ROLL )', 'CAMLIN WIRE 4 MM (ROLL )', '', 1, 'Pcs', '28', 'C D', '2 F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(445, 1, 1, 1, 0, 'S OTR :CP -506 A-WIRING CLIP 10 MM BOLT WHITE', 'WIRING CLIP 10 MM BOLT WHITE', '', 1, 'Pcs', '28', 'C D', '2 E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(446, 1, 1, 1, 0, 'S OTR :CP 498-WIRING CLIP NO :18 WHITE', 'WIRING CLIP NO :18 WHITE', '', 1, 'Pcs', '28', 'C D', '2 E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(447, 1, 1, 1, 0, 'S OTR :CP 497-WIRING CLIP  NO :18 BRASS', 'WIRING CLIP  NO :18 BRASS', '', 1, 'Pcs', '28', 'C D', '2 E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(448, 1, 1, 1, 0, 'S OTR :SUPER -1107-INDICATOR FIASHER 12V / 2 PIN 100CC', 'INDICATOR FIASHER 12V / 2 PIN 100CC', '', 1, 'Pcs', '28', 'C D', '2 D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(449, 1, 1, 1, 0, 'S OTR :SUPER -1003-BUZZER AC / DC CONTINNOUS -3 WIRE', 'BUZZER AC / DC CONTINNOUS -3 WIRE', '', 1, 'Pcs', '28', 'C D', '2 D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(450, 1, 1, 1, 0, 'S OTR :SUPER -1001-BUZZER AC / DC CONTINNOUS', 'BUZZER AC / DC CONTINNOUS ', '', 1, 'Pcs', '28', 'C D', '2 D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(451, 1, 1, 1, 0, 'S OTR :AS -BOX LOCK -AS BOX LOCK N / M -BOX LOCK', 'AS BOX LOCK N / M -BOX LOCK', '', 1, 'Pcs', '18', 'C D', '2 D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(452, 1, 1, 1, 0, 'S OTR :CP -103 ( CP - 102 )-TWO WAY SWITCH ( BUSH & PULL )', 'TWO WAY SWITCH ( BUSH & PULL )', '', 1, 'Pcs', '28', 'C D', '2 D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(453, 1, 1, 1, 0, 'S OTR :ROOT 677 ,678 ( 209992002 )-VIBRO MINI 12V LT & HT', 'VIBRO MINI 12V LT & HT', '', 1, 'Pcs', '28', 'C D', '1 F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(454, 1, 1, 1, 0, 'S OTR :ROOT 609 ,610-WIND TONE HORN SET 12V', 'WIND TONE HORN SET 12V', '', 1, 'Pcs', '28', 'C D', '1 F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(455, 1, 1, 1, 0, 'S OTR :ROOTS MM 003 -7 IN 1-7 IN1 (5 WIRE ) MELODY MAKER', '7 IN1 (5 WIRE ) MELODY MAKER', '', 1, 'Pcs', '28', 'C D', '1 D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(456, 1, 1, 1, 0, 'S HERO :F002 G40 087-PLUG (U4AC) HH / VIC / SAF /NOVA /K4 /U4', 'PLUG (U4AC) HH / VIC / SAF /NOVA /K4 /U4', '', 1, 'Pcs', '28', 'C D', '1 E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(457, 1, 1, 1, 0, 'S OTR :9240 033 532-MICO SPARK PLUG W17521 (WO 78C4 )', 'MICO SPARK PLUG W17521 (WO 78C4 )', '', 1, 'Pcs', '28', 'C D', '1 E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(458, 1, 1, 1, 0, 'S SUZ :0241 245 057', 'SUPER PLUG RX / SUZ W5BC', '', 1, 'Pcs', '28', 'C D', '1 E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(459, 1, 1, 1, 0, 'S BAJJ :F002 G40 533-SPARK PLUG ( UR3DC ) PUL /E1I /DISC', 'SPARK PLUG ( UR3DC ) PUL /E1I /DISC', '', 1, 'Pcs', '28', 'C D', '1 E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(460, 1, 1, 1, 0, 'S TVS :SAN - ( BLC - 3 )-BESSAL LEVER COVER SET ( SAN ) 100CC ', 'BESSAL LEVER COVER SET ( SAN ) 100CC ', '', 1, 'Pcs', '28', 'C D', '3 F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(461, 1, 1, 1, 0, 'S TVS :SAN - (B - 5) 0649918009-BESSAL HAND GRIP COVER 100CC', 'BESSAL HAND GRIP COVER 100CC', '', 1, 'Pcs', '28', 'C D', '3 F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(462, 1, 1, 1, 0, 'S BAJJ : KI 1272 CLUTCH CABLE PULSAR DTSI150CC', 'CLUTCH CABLE PULSAR DTSI 150CC', '', 1, 'Pcs', '28', 'D4', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(463, 1, 1, 1, 0, 'S BAJJ : KI 1281 ACC CABLE ASSY PULSAR DTSI 180CC', 'ACC CABLE ASSY PULSAR DTSI 180CC', '', 1, 'Pcs', '28', 'D4', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(464, 1, 1, 1, 0, 'S BAJJ : KI 1481A ACC CABLE DISCOVER 100CC', 'ACC CABLE DISCOVER 100CC', '', 1, 'Pcs', '28', 'D4', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(465, 1, 1, 1, 0, 'S BAJJ : KI 1249 SPEEDO METER CABLE', 'SPEEDO METER CABLE', '', 1, 'Pcs', '28', 'D4', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(466, 1, 1, 1, 0, 'S BAJJ : KI 1482A CLUTCH CABLE DISCOVER 100CC', 'CLUTCH CABLE DISCOVER 100CC', '', 1, 'Pcs', '28', 'D4', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(467, 1, 1, 1, 0, 'S BAJJ : KI 1261A ACC CABLE PULSAR 100CC', 'ACC CABLE PULSAR 100CC', '', 1, 'Pcs', '28', 'D4', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(468, 1, 1, 1, 0, 'S BAJJ : KI 1242 CLUTCH CABLE CT100/PLATINA', 'CLUTCH CABLE CT100/PLATINA', '', 1, 'Pcs', '28', 'D4', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(469, 1, 1, 1, 0, 'S BAJJ : HTA7461/6752 FORK OIL SEAL (DTS)', 'FORK OIL SEAL ( DTS )', '', 1, 'Pcs', '28', 'D4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(470, 1, 1, 1, 0, 'S BAJJ : HTA KIT42 OIL SEAL KIT DISCOVER 100CC', 'OIL SEAL KIT DISCOVER 100CC', '', 1, 'Pcs', '28', 'D4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(471, 1, 1, 1, 0, 'S BAJJ : HTA KIT12 OIL SEAL KIT KB4S', 'OIL SEAL KIT KB4S', '', 1, 'Pcs', '28', 'D4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(472, 1, 1, 1, 0, 'S BAJJ : KQ 327 BRAKE YOKE CT100Y PLATINA DIS10', 'BRAKE YOKE CT100Y PLATINA DIS10', '', 1, 'Pcs', '28', 'D4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(473, 1, 1, 1, 0, 'S BAJJ : KQ 328 CLUTCH YOKE CT100Y PLATINA', 'CLUTCH YOKE CT100Y PLATINA', '', 1, 'Pcs', '28', 'D4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(474, 1, 1, 1, 0, 'S BAJJ : UIL DIS 100 VALVE KIT DISCOVER100', 'VALVE KIT (UIL) DISCOVER 100', '', 1, 'Pcs', '28', 'D4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(475, 1, 1, 1, 0, 'S BAJJ : SAS 1293JE WINSHIED SCREW KIT DISCOVER 10', 'WINSHIED SCREW KIT DISCOVER10', '', 1, 'Pcs', '28', 'D4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(476, 1, 1, 1, 0, 'S BAJJ : ASK/BS/0128 BRAKE SHOE PULSAR /KB100', 'BRAKE SHOE PULSAR / KB100', '', 1, 'Pcs', '28', 'D4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(477, 1, 1, 1, 0, 'S BAJJ : ASK/BS/0102 BRAKE SHOE KAWASAKI 4S', 'BRAKE SHOE KAWASAKI 4S', '', 1, 'Pcs', '28', 'D4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(478, 1, 1, 1, 0, 'S BAJJ : MK6001 DISC PAD PULSAR/DISCOVER', 'DISC PAD PULSAR / DISCOVER', '', 1, 'Pcs', '28', 'D4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(479, 1, 1, 1, 0, 'S BAJJ : AR 1057 P TAP PETROL TAP(ORD)PULSAR BOXER', 'PETROL TAP (ORD) PULSAR BOXER', '', 1, 'Pcs', '28', 'D4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(480, 1, 1, 1, 0, 'S BAJJ : DT CAM DIS100-CAM CHAIN DIS100/XCD125 JN5310', 'CAM CHAIN DIS100 XCD125 JN5310', '', 1, 'Pcs', '28', 'D4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(481, 1, 1, 1, 0, 'S BAJJ : DT CAM PULSAR-CAM CHAIN PULSAR', 'CAM CHAIN PULSAR', '', 1, 'Pcs', '28', 'D4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(482, 1, 1, 1, 0, 'S BAJJ : MK1034-CLUTCH PLATE CT100 PLATINA', 'CLUTCH PLATE CT100 PLATINA', '', 1, 'Pcs', '28', 'D4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(483, 1, 1, 1, 0, 'S BAJJ : KQ 343-CLUTCH & BRAKE LEVER SET CT100,DIS,DTSI,PLATINA', 'CLUTCH & BRAKE LEVER SET CT100,DIS,DTSI,PLATINA', '', 1, 'Pcs', '28', 'D4', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(484, 1, 1, 1, 0, 'S BAJJ : KQ 346-CLUTCH & BRAKE LEVER SET CT100,DIS,DTSI,PLATINA', 'CLUTCH & BRAKE LEVER SET CT100,DIS,DTSI,PLATINA', '', 1, 'Pcs', '28', 'D4', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(485, 1, 1, 1, 0, 'S BAJJ : KB 4005A-CLUTCH COVER GASKET KB4S/CAL/CD100', 'CLUTCH COVER GASKET KB4S/CALI/CD100', '', 1, 'Pcs', '28', 'D4', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(486, 1, 1, 1, 0, 'S BAJJ : XCD004-CLUTCH COVER GASKET XCD/DIS100', 'CLUTCH COVER GASKET XCD/DIS100', '', 1, 'Pcs', '28', 'D4', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(487, 1, 1, 1, 0, 'S BAJJ : PL 5007-MAGNET GASKET COVER BLUE PULS150CC', 'MAGNET GASKET COVER BLUE PULS150CC', '', 1, 'Pcs', '28', 'D4', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(488, 1, 1, 1, 0, 'S BAJJ : DT KIT65-CHAIN SPROCKET KIT PULSAR 4HOLES 150CC UG4', 'CHAIN SPROCKET KIT PULSAR 4HOLES 150CC UG4', '', 1, 'Pcs', '28', 'D4', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(489, 1, 1, 1, 0, 'S BAJJ : DT KIT39- CHAIN SPROCKET KIT PLATINA', 'CHIN SPROCKET KIT PLATINA', '', 1, 'Pcs', '28', 'D4', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(490, 1, 1, 1, 0, 'S BAJJ : DT KIT122-CHAIN SPROCKET KIT DISCOVER 100CC', 'CHAIN SPROCKET KIT DISCOVER 100CC', '', 1, 'Pcs', '28', 'D4', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(491, 1, 1, 1, 0, 'S BAJJ : SAP 2080-INDICATOR BULB 12V-10W', 'INDICATOR BULB 12V-10W', '', 1, 'Pcs', '18', 'D5', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(492, 1, 1, 1, 0, 'S BAJJ : SAP 1026MU- IND ASSY  ( PLANTINA -WH )', 'IND ASSY ( PLATINA -WH )', '', 1, 'Pcs', '28', 'D 5', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(493, 1, 1, 1, 0, 'S BAJJ : SAP 595A - REAR STOP SWITCH KB 4S BOXER ', 'REAR STOP SWITCH KB 4S BOXER', '', 1, 'Pcs', '28', 'D 5', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(494, 1, 1, 1, 0, 'S BAJJ : SAP 0199 - FUSE ASSY W / FUSE KB -100 / 4S / CALIBER', 'FUSE ASSY W / FUSE KB -100 /4S / CALIBER', '', 1, 'Pcs', '28', 'D 5', ' C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(495, 1, 1, 1, 0, 'S BAJJ : PA /BJ /121 L - PETROL COCK ( LOCK TYPE ) PULSAR', 'PETROL COCK ( LOCK TYPE ) PULSAR', '', 1, 'Pcs', '28', 'D 5', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(496, 1, 1, 1, 0, 'S BAJJ : SAP 1026S -IND GLASS (BLINKER ) PLATINA', 'IND GLASS (BLINKER ) PLATINA', '', 1, 'Pcs', '28', 'D 5', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(497, 1, 1, 1, 0, 'S BAJJ : SAP 1026T - IND STAY (BLINKER ) PLATINA / KCD125', 'IND STAY ( BLINKER ) PLATINA / KCD125', '', 1, 'Pcs', '28', 'D 5', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(498, 1, 1, 1, 0, 'S SUZ : EJ SU 09-CABLE GUIDE RUBBER SUZUKI', 'CABLE GUIDE RUBBER SUZUKI', '', 1, 'Pcs', '28', 'D5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(499, 1, 1, 1, 0, 'S BAJJ : KB27 008-CUSH RUBBER DTSI,PULS,DISC', 'CUSH RUBBER DTSI,PULS,DISC', '', 1, 'Pcs', '28', 'D5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(500, 1, 1, 1, 0, 'S BAJJ : DT RUB 4S-CUSH RUBBER SET KB4S,CD100,CALI', 'CUSH RUBBER SET KB4S,CD100,CALI (DIA-WHR07)', '', 1, 'Pcs', '18', 'D5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(501, 1, 1, 1, 0, 'S BAJJ : SJ KB 15-FRONT FOOTREST RUBBER CALI (EACH)', 'FRONT RUBBER FOOTREST RUBBER CALI (EACH)', '', 1, 'Pcs', '28', 'D5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(502, 1, 1, 1, 0, 'S BAJJ : SJ KB 14-FRONT FOOTREST RUBBER CT100(EACH)', 'FRONT FOOTREST RUBBER CT100(EACH)', '', 1, 'Pcs', '28', 'D5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(503, 1, 1, 1, 0, 'S BAJJ : CLB001B-FULL GASKET KIT CALI/CT100/PLATI', 'FULL GASKET KIT CALI/CT100/PLATINA', '', 1, 'Pcs', '28', 'C5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(504, 1, 1, 1, 0, 'S BAJJ : AAG DTS 002A-HALF GASKET KIT DIS100CC', 'HALF GASKET KIT DIS 100CC', '', 1, 'Pcs', '28', 'D5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(505, 1, 1, 1, 0, 'S BAJJ : AAA PUL 002-FULL GASKET SET PULS180', 'FULL GASKET SET PULS 180', '', 1, 'Pcs', '28', 'D5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(506, 1, 1, 1, 0, 'S BAJJ : AAA DTS 001B-FULL GASKET KIT DIS 100CC,S121,S13', 'FULL GASKET KIT DIS 100CC,S120,S13', '', 1, 'Pcs', '28', 'D5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(507, 1, 1, 1, 0, 'S SUZ : 011 SVM R-SIDE MIRROR RH/LH SUZUKI', 'SIDE MIRROR RH/LH SUZUKI', '', 1, 'Pcs', '28', 'D5', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(508, 1, 1, 1, 0, 'S BAJJ : REVE PULS DJ03-SIDE MIRROR LH PULSAR,DTS', 'SIDE MIRROR LH PULSAR.DTS', '', 1, 'Pcs', '28', 'D5', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(509, 1, 1, 1, 0, 'S BAJJ : REVE PULS DJ04-SIDE MIRROR RH PW DTS', 'SIDE MIRROR RH PW DTS', '', 1, 'Pcs', '28', 'D5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(510, 1, 1, 1, 0, 'S ENFLD : UIL 6203-RS BALL BEARING', 'RS BALL BEARING', '', 1, 'Pcs', '18', 'D6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(511, 1, 1, 1, 0, 'S ENFLD : UIL 6201-RS BALL BEARING', 'RS BALL BEARING', '', 1, 'Pcs', '18', 'D6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(512, 1, 1, 1, 0, 'S ENFLD :UIL 6200-RS BALL BEARING', 'RS BALL BEARING', '', 1, 'Pcs', '18', 'D6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(513, 1, 1, 1, 0, 'S ENFLD : UIL 6004-RS BALL BEARING', 'RS BALL BEARING', '', 1, 'Pcs', '18', 'D6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(514, 1, 1, 1, 0, 'S ENFLD : UIL 6202-RS BALL BEARING', 'RS BALL BEARING', '', 1, 'Pcs', '18', 'D6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(515, 1, 1, 1, 0, 'S ENFLD : UIL 6301-RS BALL BEARING', 'RS BALL BEARING', '', 1, 'Pcs', '18', 'D6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(516, 1, 1, 1, 0, 'G ENFLD : 888337-BRAKE SHOE KIT W/SPRING ', 'BRAKE SHOE KIT W/SPRING', '', 1, 'Pcs', '28', 'D6', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(517, 1, 1, 1, 0, 'G ENFLD : 594715/A-BRAKE PAD SET FRONT', 'BRAKE PAD SET FRONT', '', 1, 'Pcs', '28', 'D6', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(518, 1, 1, 1, 0, 'G ENFLD : 888237-SPARK PLUG KIT BUL500', 'SPARK PLUG KIT BUL500', '', 1, 'Pcs', '28', 'D6', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(519, 1, 1, 1, 0, 'G ENFLD : 888414-OIL FILTER WITH O-RING KIT', 'OIL FILTER WITH O-RING KIT', '', 1, 'Pcs', '28', 'D6', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(520, 1, 1, 1, 0, 'G ENFLD : 571156/D-CLUTCH CABLE 350VCE', 'CLUTCH CABLE 350VCE', '', 1, 'Pcs', '28', 'D6', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(521, 1, 1, 1, 0, 'G ENFLD : 592113/D-THROTTLE CABLE UCE/LLA350', 'THROTTLE CABLE UCE/LLA350', '', 1, 'Pcs', '28', 'D6', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(522, 1, 1, 1, 0, 'G ENFLD : 582613/A-THROTTLE CABLE ASSY', 'THROTTLE CABLE ASSY', '', 1, 'Pcs', '28', 'D6', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(523, 1, 1, 1, 0, 'G ENFLD : 390068-15W50 API SL ENGINE OIL 2.5 LTR', '15W50 API SL ENGINE OIL 2.5 LTR (LIQUID ENGINE OIL GUN)', '', 1, 'Pcs', '18', 'D6', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(524, 1, 1, 1, 0, 'G ENFLD : 570416/N-GASKET COVER RH TBTS/UCE', 'GASKET COVER RH TBTS/UCE', '', 1, 'Pcs', '28', 'D6', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(525, 1, 1, 1, 0, 'G ENFLD : 570410/F-GASKET COVER LH TBTS/UCE', 'GASKET COVER LH TBTS/UCE', '', 1, 'Pcs', '28', 'D6', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(526, 1, 1, 1, 0, 'S HOND : MK120301-CLUTCH HOUSING SHINE/UNICORN DA', 'CLUTCH HOUSING SHINE/UNICORN DA', '', 1, 'Pcs', '28', 'F2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(527, 1, 1, 1, 0, 'S HOND : ASK/BS/0212-BRAKE SHOE SET ACTIVA 110CC,NEW DREAM CB UNICORN', 'BRAKE SHOE SET ACTIVA 110CC NEW DREAM CB UNICORN', '', 1, 'Pcs', '28', 'F2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(528, 1, 1, 1, 0, 'S HOND : VIR 82753247-AIR FILTER SHINE (PLASTIC TYPE)', 'AIR FILTER SHINE (PLASTIC TYPE)', '', 1, 'Pcs', '28', 'F2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(529, 1, 1, 1, 0, 'S HOND : DT RUB SHINE-CUSH RUBBER SET SHINE', 'CUSH RUBBER SET SHINE', '', 1, 'Pcs', '28', 'F2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(530, 1, 1, 1, 0, 'S HOND : SIDE STAND ACTI-SIDE STAND (ACTIVA 2013)HD', 'SIDE STAND (ACTIVA 2013) HD', '', 1, 'Pcs', '28', 'F2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(531, 1, 1, 1, 0, 'S HOND : DT RUB UNI-CUSH RUBBER SET (UNI/CBZ XTREME HUNK', 'CUSH RUBBER SET (UNI/CBZ XTREME HUNK', '', 1, 'Pcs', '28', 'F2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(532, 1, 1, 1, 0, 'S HOND : JNS JHSH107-H.BAR SWITCH LH SHINE NM', 'H.BAR SWITCH LH SHINE NM', '', 1, 'Pcs', '28', 'F2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(533, 1, 1, 1, 0, 'S HOND : JNS JHU101-LOCK SET UNICORN', 'LOCK SET UNICORN', '', 1, 'Pcs', '18', 'F2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(534, 1, 1, 1, 0, 'S HOND : JNS JHSH002-LOCK SET SHINE', 'LOCK SET SHINE', '', 1, 'Pcs', '18', 'F2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(535, 1, 1, 1, 0, 'S HOND : ACT 100/A-ENG GASKET SET ACTIVA/PLEASURE', 'ENG GASKET SET ACTIVA/PLEASURE', '', 1, 'Pcs', '28', 'F2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(536, 1, 1, 1, 0, 'S HOND : KI 1907A-SEAT LOCK CABLE ACT 110/D10', 'SEAT LOCK CABLE ACT 110/D10', '', 1, 'Pcs', '28', 'F2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(537, 1, 1, 1, 0, 'S HOND : HET002A-HALF GASKET KIT ACTIVA125', 'HALF GASKET KIT ACTIVA 125', '', 1, 'Pcs', '28', 'F2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(538, 1, 1, 1, 0, 'S HOND : HSN002A-HALF GASKET KIT SHINE/ST UNNER', 'HALF GASKET KIT SHINE /ST UNNER', '', 1, 'Pcs', '28', 'F2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(539, 1, 1, 1, 0, 'S HOND : ACT 002B-HALF GASKET KIT ACTIVA 110CC', 'HALF GASKET KIT ACTIVA 110CC', '', 1, 'Pcs', '28', 'F2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(540, 1, 1, 1, 0, 'S HOND : DT KIT 89-CHAIN SPROCKET KIT UNI NEW', 'CHAIN SPROCKET KIT UNI NEW', '', 1, 'Pcs', '28', 'F1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(541, 1, 1, 1, 0, 'S HOND : DT KIT 81-CHAIN SPROCKET KIT SHINE', 'CHAIN SPROCKET KIT SHINE', '', 1, 'Pcs', '28', 'F1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(542, 1, 1, 1, 0, 'S HOND : DT KIT 81N-CHAIN SPROCKET KIT SHINE NEW', 'CHAIN SPROCKET KIT SHINE NEW', '', 1, 'Pcs', '28', 'F1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(543, 1, 1, 1, 0, 'S HOND : EVL 4402244027-VALVE KIT ACTIVA', 'VALVE KIT ACTICA', '', 1, 'Pcs', '28', 'F1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(544, 1, 1, 1, 0, 'S HOND : EVL 4069340699-(47380 47385)VALVE KIT UNI,XTREME,HUNK', 'VALVE KIT UNI XTREME HUNK', '', 1, 'Pcs', '28', 'F1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(545, 1, 1, 1, 0, 'S HOND : EVL 4701047015 VALVE KIT ACTIVA 110CC', 'VALVE KIT ACTIVA 110CC', '', 1, 'Pcs', '28', 'F1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(546, 1, 1, 1, 0, 'S HOND : ZX 2051K-FORK RACER SET SHINE', 'FORK RACER SET SHINE', '', 1, 'Pcs', '28', 'F1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(547, 1, 1, 1, 0, 'S HOND : SW 0916L-HORN SWITCH ACTIVA 110CC NM', 'HORN SWITCH ACTIVA 110CC NM', '', 1, 'Pcs', '28', 'F1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(548, 1, 1, 1, 0, 'S HOND : SW 0918N-STARTER SWITCH ACTIVA NM', 'STARTER SWITCH ACTIVA NM', '', 1, 'Pcs', '28', 'F1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(549, 1, 1, 1, 0, 'S HOND : DAP DACT023-2-LINK BUSH KIT ACTIVA OLD', 'LINK BUSH KIT ACTIVA OLD', '', 1, 'Pcs', '28', 'F1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(550, 1, 1, 1, 0, 'S HOND : HTA KIT39-OIL SEAL KIT UNI/SHINE', 'OIL SEAL KIT UNI/SHINE', '', 1, 'Pcs', '28', 'F1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(551, 1, 1, 1, 0, 'S HOND : HTA KIT48-OIL SEAL KIT ACTIVA 110CC', 'OIL SEAL KIT ACTIVA 110CC', '', 1, 'Pcs', '28', 'F1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(552, 1, 1, 1, 0, 'S HOND : PAS ACT 029-NOSE KIT ACTIVA', 'NOSE KIT ACTIVA', '', 1, 'Pcs', '28', 'F1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(553, 1, 1, 1, 0, 'S HOND : ZAM 2901- FORK ARM COVER OLD MODEL', 'FORK ARM COVER OLD MODEL', '', 1, 'Pcs', '28', 'F1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(554, 1, 1, 1, 0, 'S HOND : WOX 301/302-FORK ARM COVER ACTIVA DLX', 'FORK ARM COVER ACTIVA DLX', '', 1, 'Pcs', '28', 'F1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(555, 1, 1, 1, 0, 'S HOND : P4U HA27956-SEAT LOCK BRACKET', 'SEAT LOCK BRACKET', '', 1, 'Pcs', '28', 'F1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(556, 1, 1, 1, 0, 'S HOND : DAP DACT023-LINK BUSH KIT ACTIVA 110CC', 'LINK BUSH KIT ACTIVA 110CC', '', 1, 'Pcs', '28', 'F1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(557, 1, 1, 1, 0, 'S HOND : UNI 004A-CLUTCH COVER GASKET UNICORN SHINE', 'CLUTCH COVER GASKET UNICORN SHINE', '', 1, 'Pcs', '28', 'F1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(558, 1, 1, 1, 0, 'S HOND : HSN001A-GASKET KIT SHINE/STUNNER', 'GASKET KIT SHINE/STUNNER', '', 1, 'Pcs', '28', 'F1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(559, 1, 1, 1, 0, 'S HOND : UNI001A-GASKET KIT UNICORN/HUXTRA/ACTIVA', 'GASKET KIT UNICORN/HUXTRA/ACTIVA', '', 1, 'Pcs', '28', 'F1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(560, 1, 1, 1, 0, 'S HOND : SAP 1021S RH-INDI ASSY REAR RH H.SHINE', 'INDICATOR ASSY REAR RH H.SHINE', '', 1, 'Pcs', '28', 'F1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(561, 1, 1, 1, 0, 'S HOND : SAP 1021S LH-INDI ASSY REAR LH H.SHINE', 'INDICATOR ASSY REAR LH H.SHINE', '', 1, 'Pcs', '28', 'F1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(562, 1, 1, 1, 0, 'S TVS : DAP DSX084-FOOTREST PLATE RR LH XL SUPER', 'FOOTREST PLATE RR LH XL SUPER', '', 1, 'Pcs', '28', 'C5', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(563, 1, 1, 1, 0, 'S TVS : D 351B-SIDE STAND XL SUPER', 'SIDE STAND XL SUPER', '', 1, 'Pcs', '28', 'C5', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(564, 1, 1, 1, 0, 'S TVS : DAP DSX101 5-SIL BEND PIPE XL SUPER 5TH', 'SIL BEND PIPE XL SUPER 5TH', '', 1, 'Pcs', '28', 'C5', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(565, 1, 1, 1, 0, 'S TVS : 0427622010-SIDE STAND V CLAMP XLN', 'SIDE STAND V CLAMP XLN', '', 1, 'Pcs', '28', 'C5', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(566, 1, 1, 1, 0, 'S TVS : SAP 196B-BATTERY TERMINAL W/WIRE SCOOTY PEP', 'BATTERY TERMINAL W/WIRE SCOOTY PEP', '', 1, 'Pcs', '28', 'C5', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(567, 1, 1, 1, 0, 'S TVS : KQ 675-CLUTCH & BRAKE LEVER SET XL SUPER 100CC', 'CLUTCH & BRAKE LEVER SET XL SUPER 100CC', '', 1, 'Pcs', '28', 'C5', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(568, 1, 1, 1, 0, 'S TVS : AR 2023-PETROL TAP BIG NUT (LOCK) XL NM', 'PETROL TAP BIG NUT (LOCK) XL NM (ZH-6005)', '', 1, 'Pcs', '28', 'C5', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(569, 1, 1, 1, 0, 'S TVS : SA AD 202-CLUTCH SHOE ASSEMBLY XL NM', 'CLUTCH SHOE ASSEMBLY XL NM', '', 1, 'Pcs', '28', 'C5', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(570, 1, 1, 1, 0, 'S TVS : DAP DSX053-KICK PEDAL COVER KIT XL NM', 'KICK PEDAL COVER KIT XL NM', '', 1, 'Pcs', '28', 'C5', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(571, 1, 1, 1, 0, 'S TVS : EST XL 25-MUD FLAP MOPED', 'MUD FLAP MOBED', '', 1, 'Pcs', '28', 'C5', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(572, 1, 1, 1, 0, 'S TVS : SU 40-FRONT FOOTREST RUBBER STAR', 'FRONT FOOTREST RUBBER STAR', '', 1, 'Pcs', '28', 'C5', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(573, 1, 1, 1, 0, 'S SUZ : ESJ SU 22-FRONT FOOTREST RUBBER SUZUKI', 'FRONT FOOTREST RUBBER SUZUKI', '', 1, 'Pcs', '28', 'C5', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(574, 1, 1, 1, 0, 'S TVS : SJ SU 01-FORK BOOT MAX/SAM', 'FORK BOOT MAX/SAM', '', 1, 'Pcs', '28', 'C5', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(575, 1, 1, 1, 0, 'S TVS : DAP DSX 103-SILENCER CORE MUFFLER XL SUPER ', 'SILENCER CORE MUFFLER XL SUPER', '', 1, 'Pcs', '28', 'C5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(576, 1, 1, 1, 0, 'S TVS : SJ SXL 15-GEAR SHAFT O-RING XL SUPER', 'GEAR SHAFT O-RING XL SUPER', '', 1, 'Pcs', '28', 'C5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(577, 1, 1, 1, 0, 'S TVS : DT SPRAY 100ML-CHAIN LUBRICANT SPRAY XL 120/100ML', 'CHAIN LUBRICANT SPRAY XL 120/100ML', '', 1, 'Pcs', '28', 'C5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(578, 1, 1, 1, 0, 'S TVS : SAP 273R-HEAD LAMP HOLDER PEP SCOOTY', 'HEAD LAMP HOLDER PEP SCOOTY', '', 1, 'Pcs', '28', 'C5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(579, 1, 1, 1, 0, 'S TVS : SAP 196A-BATTERY TERMINAL PEP (HONDA)ES/DX/ZX', 'BATTERY TERMINAL PEP (HONDA)ES/DX/ZX', '', 1, 'Pcs', '28', 'C5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(580, 1, 1, 1, 0, 'S TVS : DAP DSX005-BOLT NUT RR DRUM PLATE XL SUPER ', 'BOLT NUT RR DRUM PLATE XL SUPER ', '', 1, 'Pcs', '28', 'C5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(581, 1, 1, 1, 0, 'S TVS : INEL 53003-IGNITER ASSY XL NM', 'IGNITER ASSY XL NM', '', 1, 'Pcs', '28', 'C5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(582, 1, 1, 1, 0, 'S TVS : SAP 243K-WIRING KIT (HARNESS)XL SUPER NM', 'WIRING KIT (HARNESS)XL SUPER NM', '', 1, 'Pcs', '28', 'C5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(583, 1, 1, 1, 0, 'S TVS : 019 HLU SN-HEAD LAMP UNIT NM XL SUPER', 'HEAD LAMP UNIT NM XL SUPER', '', 1, 'Pcs', '28', 'C5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(584, 1, 1, 1, 0, 'S TVS : 019 BLA SN F-INDICATOR ASSY FRONT LH/RH MFR XL', 'INDICATOR ASSY FRONT LH/RH MFR XL', '', 1, 'Pcs', '28', 'C5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(585, 1, 1, 1, 0, 'S TVS : 019 TLA SN-TAIL LAMP ASSY NM XL', 'TAIL LAMP ASSY NM XL', '', 1, 'Pcs', '28', 'C5', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(586, 1, 1, 1, 0, 'S TVS : 025 HLA P-HEAD LAMP ASSY STAR CITY WITH PARKING', 'HEAD LAMP ASSY STAR CITY WITH PARKING', '', 1, 'Pcs', '28', 'C5', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(587, 1, 1, 1, 0, 'S TVS : 019 HLA SN-HEAD LAMP ASSY SUPER CHAMP NM MFR', 'HEAD LAMP ASSY SUPER CHAMP NM MFR', '', 1, 'Pcs', '28', 'C5', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(588, 1, 1, 1, 0, 'S TVS : 019 HLD SN-DOME HEAD LAMP SUPER CHAMP', 'DOME HEAD LAMP SUPER CHAMP', '', 1, 'Pcs', '28', 'C5', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(589, 1, 1, 1, 0, 'S TVS : DT KIT85-CHAIN SPROCKET KIT APACHE RTR 160CC', 'SPROCKET KIT APACHE RTR 160CC', '', 1, 'Pcs', '28', 'C6', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(590, 1, 1, 1, 0, 'S TVS : DT KIT 115-CHAIN SPROCKET KIT APACHE RTR 180', 'CHAIN SPROCKET KIT APACHE RTR 180', '', 1, 'Pcs', '28', 'C6', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(591, 1, 1, 1, 0, 'S TVS : DT KIT 97-CHAIN SPROCKET KIT STAR CITY ALLOY WHEEN', 'CHAIN SPROCKET KIT STAR CITY ALLOY WHEEN', '', 1, 'Pcs', '28', 'C6', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(592, 1, 1, 1, 0, 'S TVS : DT KIT 111-CHAIN SPROCKET KIT STAR SPORTS STAR SPORT OLD', 'CHAIN SPROCKET KIT STAR SPORTS STAR SPORT OLD', '', 1, 'Pcs', '28', 'C6', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(593, 1, 1, 1, 0, 'S TVS : D 504Y-FRONT NUMBER PLATE XL SUPER', 'FRONT NUMBER PLATE XL SUPER', '', 1, 'Pcs', '28', 'C6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(594, 1, 1, 1, 0, 'S TVS : DAP DSX200-SWING ARM ROD XL SUPER NEW (DRUM ROD TIE ROD) ', 'SWING ARM ROD XL SUPER NEW (DRUM ROD TIE ROD)', '', 1, 'Pcs', '28', 'C6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(595, 1, 1, 1, 0, 'S TVS : SL 032-KICKER SHAFT XLN SUPER', 'KICKER SHAFT XLN SUPER', '', 1, 'Pcs', '28', 'C6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(596, 1, 1, 1, 0, 'S TVS : ASK/DBP 0509-DISC BRAKE ROD CBZ/APACHE FRONT', 'DISC BRAKE ROD CBZ/APACHE FRONT', '', 1, 'Pcs', '28', 'C6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(597, 1, 1, 1, 0, 'S SUZ : ASK/BS/0104-BRAKE SHOE 110DIA (SUZUKI AX100)', 'BRAKE SHOE 110DIA (SUZUKI AX100)', '', 1, 'Pcs', '28', 'C6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(598, 1, 1, 1, 0, 'S TVS : MK4403-BRAKE SHOE SAMURAI TVS', 'BRAKE SHOE SAMURAI TVS', '', 1, 'Pcs', '28', 'C6', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(599, 1, 1, 1, 0, 'S TVS : DAP DSX003-CHAIN ADJUSTER SET XL SUPER NM', 'CHAIN ADJUSTER SET XL SUPER NM', '', 1, 'Pcs', '28', 'C5', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(600, 1, 1, 1, 0, 'S TVS : SJ SXL 11-AIR HOSE RUBBER XL SUPER (SXL 17)', 'AIR HOSE RUBBER XL SUPER (SXL 17)', '', 1, 'Pcs', '28', 'C6', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(601, 1, 1, 1, 0, 'S TVS : SJ SXL 25-INDICATOR STAY SMALL NM XLN', 'INDICATOR STAY SMALL NM XLN', '', 1, 'Pcs', '28', 'C6', '2', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(602, 1, 1, 1, 0, 'S TVS : SJ SXL 26-PETROL TAP KNOB W/SCREW XL SUPER', 'PETROL TAP KNOB W/SCREW XL SUPER', '', 1, 'Pcs', '28', 'C6', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(603, 1, 1, 1, 0, 'S TVS : SJ SXL 18-INDICATOR STAY LONG (BIG)OLD MODEL XLN', 'INDICATOR STAY LONG (BIG)OLD MODEL XLN', '', 1, 'Pcs', '28', 'C6', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(604, 1, 1, 1, 0, 'S TVS : DAP DSX028 2-FORK BUSH KIT XL SUPER NM', 'FORK BUSH KIT XL SUPER NM', '', 1, 'Pcs', '28', 'C6', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(605, 1, 1, 1, 0, 'S TVS : DT KIT 6ND-CHAIN SPROCKET KIT XL HEAVY DUTY NEW', 'CHAIN SPROCKET KIT XL HEAVY DUTY NEW', '', 1, 'Pcs', '28', 'C7', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(606, 1, 1, 1, 0, 'S TVS : DT KIT 47-CHAIN SPROCKET KIT STAR CITY DLX/STAR CITY CVT', 'CHAIN SPROCKET KIT STAR CITY DLX/STAR CITY CVT', '', 1, 'Pcs', '28', 'C7', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(607, 1, 1, 1, 0, 'S TVS : 550661/A-OIL SEAL GEAR CHANGE', 'OIL SEAL GEAR CHANGE', '', 1, 'Pcs', '28', 'C7', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(608, 1, 1, 1, 0, 'S TVS : 420702000-WOOD RUFF KEY', 'WOOD RUFF KEY', '', 1, 'Pcs', '28', 'C7', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(609, 1, 1, 1, 0, 'S TVS : DAP DSC085-SHIELD CUP WASHER', 'SHIELD CUP WASHER', '', 1, 'Pcs', '28', 'C7', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(610, 1, 1, 1, 0, 'S TVS : DAP DSX143-CLUTCH WASHER KIT XL SUPER', 'CLUTCH WASHER KIT XL SUPER', '', 1, 'Pcs', '28', 'C7', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(611, 1, 1, 1, 0, 'S TVS : SW 0918A-START SWITCH PEP/SPECTRA', 'START SWITCH PEP/SPECTRA', '', 1, 'Pcs', '28', 'C7', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(612, 1, 1, 1, 0, 'S TVS : DAP DSX052 (0117616008)-KICK LOCK KIT XL SUPER', 'KICK LOCK KIT XL SUPER', '', 1, 'Pcs', '28', 'C7', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(613, 1, 1, 1, 0, 'S TVS : DAP DSX135-SIDE DOOR CLIP XL SUPER (SHIELD CLIP SIZE10)', 'SIDE DOOR CLIP XL SUPER (SHIELD CLIP SIZE10)', '', 1, 'Pcs', '28', 'C7', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(614, 1, 1, 1, 0, 'S TVS : KQ 624-CLUTCH & BRAKE LEVER SETTOR XL NM/HEAVY DUTY', 'CLUTCH & BRAKE LEVER SETTOR XL NM/HEAVY DUTY', '', 1, 'Pcs', '28', 'C7', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(615, 1, 1, 1, 0, 'S TVS : KQ 623-CLUTCH & BRAKE LEVER SETTOR XL NM, HEAVY DUTY', 'CLUTCH & BRAKE LEVER SETTOR XL NM, HEAVY DUTY', '', 1, 'Pcs', '28', 'C7', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(616, 1, 1, 1, 0, 'S TVS : UP 2077/2078-UP SPOKES XL SUPER HD (OUTER)', 'UP 2077/2078-UP SPOKES XL SUPER HD (OUTER)', '', 1, 'Pcs', '28', 'C7', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(617, 1, 1, 1, 0, 'S TVS : UP 2006-UP SPOKES TVS XL OUTER', 'UP 2006-UP SPOKES TVS XL OUTER', '', 1, 'Pcs', '28', 'C7', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(618, 1, 1, 1, 0, 'S TVS : SJ SXL 32-AIR FILTER FOAM XLN', ' SJ SXL 32-AIR FILTER FOAM XLN', '', 1, 'Pcs', '18', 'C7', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(619, 1, 1, 1, 0, 'S TVS : STR001A-GASKET KIT STAR CITY', 'GASKET KIT STAR CITY', '', 1, 'Pcs', '28', 'C7', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(620, 1, 1, 1, 0, 'S TVS : PEP002A-HALF GASKET SET PEP', 'HALF GASKET SET PEP', '', 1, 'Pcs', '28', 'C7', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(621, 1, 1, 1, 0, 'S TVS : AAA RTR 002-HALF GASKET KIT APACHE RTR 160CC', 'HALF GASKET KIT APACHE RTR 160CC', '', 1, 'Pcs', '28', 'C7', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(622, 1, 1, 1, 0, 'S TVS : KI 2286A-STARTER CABLE NM XL SUPER', 'STARTER CABLE NM XL SUPER', '', 1, 'Pcs', '28', 'C7', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(623, 1, 1, 1, 0, 'S TVS : SE XLN 2013(319764014)-TOOL BAG RED XLN 2013', 'TOOL BAG RED XLN 2013', '', 1, 'Pcs', '28', 'C8', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(624, 1, 1, 1, 0, 'S TVS : SE TOOL 13 (3197616010)-TOOL BAG RED COVER 13 H/D', 'TOOL BAG RED COVER 13', '', 1, 'Pcs', '28', 'C8', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(625, 1, 1, 1, 0, 'S TVS : ESJ SXL 23- MUD FLAP REAR XLN', 'MUD FLAP REAR XLN', '', 1, 'Pcs', '28', 'C8', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(626, 1, 1, 1, 0, 'S TVS : DAP DSX022 2-FAN ASSY XL SUPER NEW', 'FAN ASSY XL SUPER NEW', '', 1, 'Pcs', '28', 'C8', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(627, 1, 1, 1, 0, 'S TVS : SA 123120-LOCK SET APACHE', 'LOCK SET APACHE', '', 1, 'Pcs', '18', 'C8', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(628, 1, 1, 1, 0, 'S TVS : SA 115166-LOCK SET OF RED SOCKET XL HEAVY DUTY', 'LOCK SET OF RED SOCKET XL HEAVY DUTY', '', 1, 'Pcs', '18', 'C8', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(629, 1, 1, 1, 0, 'S TVS : BA 3356-KICK LEVER TVS STAR /STAR CITY', 'KICK LEVER TVS STAR /STAR CITY', '', 1, 'Pcs', '28', 'C8', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(630, 1, 1, 1, 0, 'S TVS : DAP DSX105 1-STAND SPRING SIDE/MAIN XLN (RR FITTING)', 'STAND SPRING SIDE/MAIN XLN (RR FITTING)', '', 1, 'Pcs', '18', 'C8', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(631, 1, 1, 1, 0, 'S TVS : DAP DXL171-PEDAL COTTER PIN TVS XL', 'PEDAL COTTER PIN TVS XL', '', 1, 'Pcs', '28', 'C8', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(632, 1, 1, 1, 0, 'S SUZ : ESJ SXL 10 (ESJ SU 2)-KICKER RUBBER SUZUKI 058', 'KICKER RUBBER SUZUKI 058', '', 1, 'Pcs', '28', 'C8', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(633, 1, 1, 1, 0, 'S TVS : DT HUB VIC-CUSH RUBBER SET VICTOR,GL/GX/CENTRA/STAR CITY', 'CUSH RUBBER SET VICTOR,GL/GX/CENTRA/STAR CITY', '', 1, 'Pcs', '28', 'C8', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(634, 1, 1, 1, 0, 'S TVS : HTA 2637/7550-OIL SEAL CR SHAFT RH XLN/SCOOTY', 'OIL SEAL CR SHAFT RH XLN/SCOOTY', '', 1, 'Pcs', '28', 'C8', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(635, 1, 1, 1, 0, 'S TVS : HTA 3093A-OIL SEAL SPK XLN', 'OIL SEAL SPK XLN', '', 1, 'Pcs', '28', 'C8', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(636, 1, 1, 1, 0, 'S TVS : HTA KIT49-OIL SEAL KIT SCOOTY PEP', 'OIL SEAL KIT SCOOTY PEP', '', 1, 'Pcs', '28', 'C8', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(637, 1, 1, 1, 0, 'S TVS : SJ SXL 21-KICKER STOPPER PVC', 'KICKER STOPPER PVC', '', 1, 'Pcs', '28', 'C8', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(638, 1, 1, 1, 0, 'S TVS : SJ VR 10-AIR HOSE RUBBER', 'AIR HOSE RUBBER', '', 1, 'Pcs', '28', 'C8', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(639, 1, 1, 1, 0, 'S TVS : KI 2281-ACC CABLE XL SUPER', 'ACC CABLE XL SUPER', '', 1, 'Pcs', '28', 'C8', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(640, 1, 1, 1, 0, 'S TVS : KI 2289A-SPEEDO METER CABLE NEW XL SUPER', 'SPEEDO METER CABLE NEW XL SUPER', '', 1, 'Pcs', '28', 'C8', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(641, 1, 1, 1, 0, 'S TVS : KI 2285-REAR BRAKE CABLE XL SUPER', 'REAR BRAKE CABLE XL SUPER', '', 1, 'Pcs', '28', 'C8', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(642, 1, 1, 1, 0, 'S TVS : SE TOOL 08-TOOL BOX BLUE COVER XLN 2008', 'TOOL BOX BLUE COVER XLN 2008', '', 1, 'Pcs', '28', 'C8', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(643, 1, 1, 1, 0, 'S TVS : SE XLN DOU (3197614012)-TOOL BAG BLUE XLN', 'TOOL BAG BLUE XLN', '', 1, 'Pcs', '28', 'C8', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(644, 1, 1, 1, 0, 'S TVS : SE XLN 100CC(3197714001) TOOL BAG GREEN XLN 100CC', 'TOOL BAG GREEN XLN 100CC', '', 1, 'Pcs', '28', 'C8', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(645, 1, 1, 1, 0, 'S TVS : SE XLN 100(3197716001)-TOOL BAG GREEN COVER XLN 100CC', 'TOOL BAG GREEN COVER XLN 100CC', '', 1, 'Pcs', '28', 'C8', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(646, 1, 1, 1, 0, 'S TVS : SE XLN 2008(3197614011)-TOOL BAG GREEN XLN', 'TOOL BAG GREEN XLN', '', 1, 'Pcs', '28', 'C8', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(647, 1, 1, 1, 0, 'S HERO : DT KIT 20-CHAIN SPROCKET KIT SPL Y2K', 'CHAIN SPROCKET KIT SPL Y2K', '', 1, 'Pcs', '28', 'C1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2);
INSERT INTO `m_item` (`itemno`, `stockpointno`, `itemcategoryno`, `itemgroupno`, `itemsubgroupno`, `itemname`, `itemdescription`, `hsncode`, `packno`, `packdescription`, `gst`, `rackname`, `rowname`, `minstock`, `barcode`, `color`, `size`, `originalprice`, `mrp`, `disamount`, `supplierno`) VALUES
(648, 1, 1, 1, 0, 'S HERO : K 83-CHAIN SPROCKET KIT SPL NX6 CD DLX PASS PRO', 'CHAIN SPROCKET KIT SPL NX6 CD DLX PASS PRO', '', 1, 'Pcs', '28', 'C1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(649, 1, 1, 1, 0, 'S HERO : DT KIT 116-CHAIN SPROCKET KIT SPL PRO', 'CHAIN SPROCKET KIT SPL PRO', '', 1, 'Pcs', '28', 'C1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(650, 1, 1, 1, 0, ' S HERO : DT KIT 27-CHAIN SPROCKET KIT SUPER SPL', 'CHAIN SPROCKET KIT SUPER SPL', '', 1, 'Pcs', '28', 'C1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(651, 1, 1, 1, 0, 'S HERO : SW 0685D-HANDLE BAR SWITCH LH SPL+', 'HANDLE BAR SWITCH LH SPL+', '', 1, 'Pcs', '28', 'C1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(652, 1, 1, 1, 0, 'S HERO : SW 0722-HANDLE BAR SWITCH LH HH', 'HANDLE BAR SWITCH LH HH', '', 1, 'Pcs', '28', 'C1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(653, 1, 1, 1, 0, 'S HERO : SW 0722D-HANDLE BAR SWITCH LH SPL', 'HANDLE BAR SWITCH LH SPL', '', 1, 'Pcs', '28', 'C1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(654, 1, 1, 1, 0, 'S HERO : SAP 0159-PLUG CAP CD100,SPL', 'PLUG CAP CD100,SPL', '', 1, 'Pcs', '28', 'C1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(655, 1, 1, 1, 0, 'S HERO : SAP 0916-FLASHER', 'FLASHER', '', 1, 'Pcs', '28', 'C1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(656, 1, 1, 1, 0, 'S HERO : SAP 750-RR UNIT KH/HH CD100/CD DAWN KH', 'RR UNIT KH/HH CD100/CD DAWN KH', '', 1, 'Pcs', '28', 'C1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(657, 1, 1, 1, 0, 'S HERO : SAP 751-REGULATOR RECTIFIER SPL', 'REGULATOR RECTIFIER SPL', '', 1, 'Pcs', '18', 'C1', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(658, 1, 1, 1, 0, 'S HERO : SJ HH 01-FORK BOOT SET HONDA SS', 'FORK BOOT SET HONDA SS', '', 1, 'Pcs', '28', 'C1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(659, 1, 1, 1, 0, 'S HERO : DAP DHH035 R-FOOTREST RR RH SPL', 'FOOTREST RR RH SPL', '', 1, 'Pcs', '28', 'C1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(660, 1, 1, 1, 0, 'S HERO : DAP DHH035 L-FOOTREST RR LH SPL', 'FOOTREST RR LH SPL', '', 1, 'Pcs', '28', 'C1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(661, 1, 1, 1, 0, 'S HERO : DAP DHH040 R-FOOTREST RR RH SPL', 'FOOTREST RR RH SPL', '', 1, 'Pcs', '28', 'C1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(662, 1, 1, 1, 0, 'S HERO : DAP DHH040 L-FOOTREST RR LH SPL', 'FOOTREST RR LH SPL', '', 1, 'Pcs', '28', 'C1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(663, 1, 1, 1, 0, 'S HERO : EJ HH 02-CUSH RUBBER SET HH', 'CUSH RUBBER SET HH', '', 1, 'Pcs', '28', 'C1', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(664, 1, 1, 1, 0, 'S HERO : SJ HH 53 YOKE COVER SET SPL', 'YOKE COVER SET SPL', '', 1, 'Pcs', '28', 'C1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(665, 1, 1, 1, 0, 'S HERO : SAP 1021H-INDICATOR STAY UNICORN SHINE', 'INDICATOR STAY UNICORN SHINE', '', 1, 'Pcs', '28', 'C1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(666, 1, 1, 1, 0, 'S HERO : SAP 1018J-INDICATOR STAY CBZ/PASSION', 'INDICATOR STAY CBZ/PASSION', '', 1, 'Pcs', '28', 'C1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(667, 1, 1, 1, 0, 'S HERO : SAP 1024C-INDICATOR STAY SPL', 'INDICATOR STAY SPL', '', 1, 'Pcs', '28', 'C1', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(668, 1, 1, 1, 0, 'S HERO : HHS002A(SXZX-HHS002A)-HALF GASKET KIT SSPL (SXZX)', 'HALF GASKET KIT SSPL (SXZX)', '', 1, 'Pcs', '28', 'C1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(669, 1, 1, 1, 0, 'S HERO : AAA CDD 001-FULL GASKET SET KIT (CD DLX/PASSION)', 'FULL GASKET SET KIT (CD DLX/PASSION)', '', 1, 'Pcs', '28', 'C1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(670, 1, 1, 1, 0, 'S HERO : 184019800 ST-HALF GASKET KIT HH CD100 SPL PASS', 'HALF GASKET KIT HH CD100 SPL PASS', '', 1, 'Pcs', '28', 'C1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(671, 1, 1, 1, 0, 'S HERO : 184019900 ST-FULL GASKET SET HH CD100,SS,SPL,PASS,4-5', 'FULL GASKET SET HH CD100,SS,SPL,PASS,4-5', '', 1, 'Pcs', '28', 'C1', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(672, 1, 1, 1, 0, 'S HERO : SAP 1019JN-GLASS F1 RR WH (+)', 'GLASS F1 RR WH (+)', '', 1, 'Pcs', '28', 'C1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(673, 1, 1, 1, 0, 'S HERO : SAP 1019K-LENS SPL + FR RL', 'LENS SPL + FR RL', '', 1, 'Pcs', '28', 'C1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(674, 1, 1, 1, 0, 'S HERO : SAP 1019KN-GLASS FR RL WH (+)HH SPL+', 'GLASS FR RL WH (+)HH SPL+', '', 1, 'Pcs', '28', 'C1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(675, 1, 1, 1, 0, 'S HERO : SAP 1019J-LENS SPL+ FL RR', 'LENS SPL+ FL RR', '', 1, 'Pcs', '28', 'C1', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(676, 1, 1, 1, 0, 'S HERO : DT KIT 30-CHAIN SPROCKET KIT 44TH', 'CHAIN SPROCKET KIT 44TH', '', 1, 'Pcs', '28', 'C2', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(677, 1, 1, 1, 0, 'S HERO : DT KIT 31-CHAIN SPROCKET KIT PASS+ NEW', 'CHAIN SPROCKET KIT PASS+ NEW', '', 1, 'Pcs', '28', 'C2', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(678, 1, 1, 1, 0, 'S HERO : SDST SPLD HH04K-S.METER WARM SET SPL PASS,DAWN', 'S.METER WARM SET SPL PASS,DAWN', '', 1, 'Pcs', '28', 'C2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(679, 1, 1, 1, 0, 'S HERO : KQ 258-CLUTCH YOKE CD/SPL', 'CLUTCH YOKE CD/SPL', '', 1, 'Pcs', '28', 'C2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(680, 1, 1, 1, 0, 'S HERO : KQ 257-BRAKE YOKE HH,CD100,GLAMOUR,SPL', 'BRAKE YOKE HH,CD100,GLAMOUR,SPL', '', 1, 'Pcs', '28', 'C2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(681, 1, 1, 1, 0, 'S HERO : 506-POWER COIL SPL YZK', 'POWER COIL SPL YZK', '', 1, 'Pcs', '28', 'C2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(682, 1, 1, 1, 0, 'S HERO : SAP 256-HEAD LAMP HOLDER CD100', 'HEAD LAMP HOLDER CD100', '', 1, 'Pcs', '28', 'C2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(683, 1, 1, 1, 0, 'S HERO : SAP 256G-HEAD LAMP HOLDER HH SPL +', 'HEAD LAMP HOLDER HH SPL +', '', 1, 'Pcs', '28', 'C2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(684, 1, 1, 1, 0, 'S HERO : SAP 590A RR-REAR STOP SWITCH (BRAKE SWITCH) HH SPL', 'REAR STOP SWITCH (BRAKE SWITCH) HH SPL', '', 1, 'Pcs', '28', 'C2', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(685, 1, 1, 1, 0, 'S HERO : SJ HH 04-H BAR RUBBER KIT HH VICTOR', 'H BAR RUBBER KIT HH VICTOR', '', 1, 'Pcs', '28', 'C2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(686, 1, 1, 1, 0, 'S HERO : EJ HH09-CLUTCH RUBBER KIT', 'CLUTCH RUBBER KIT', '', 1, 'Pcs', '28', 'C2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(687, 1, 1, 1, 0, 'S HERO : SAP 550K-H BAR SW REPAIR KIT HH', 'H BAR SW REPAIR KIT HH', '', 1, 'Pcs', '28', 'C2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(688, 1, 1, 1, 0, 'S HERO : SJ HH 14=BRAKE DRUM BOLT RUBBER HH', 'BRAKE DRUM BOLT RUBBER HH', '', 1, 'Pcs', '28', 'C2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(689, 1, 1, 1, 0, 'S HERO : H/H019S-FULL O-RING SET 16 HH', 'FULL O-RING SET 16 HH', '', 1, 'Pcs', '28', 'C2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(690, 1, 1, 1, 0, 'S HERO : RMW 9308-HEAD DOWEL BUSH KIT HH', 'HEAD DOWEL BUSH KIT HH', '', 1, 'Pcs', '28', 'C2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(691, 1, 1, 1, 0, 'S HERO : NAJ 439 (RMW2360)-KICK LOCK KIT SPL /SLEEK', 'KICK LOCK KIT SPL /SLEEK', '', 1, 'Pcs', '28', 'C2', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(692, 1, 1, 1, 0, 'S HERO : EVL 46880,46885-VALVE KIT SUPER SPL', 'VALVE KIT SUPER SPL', '', 1, 'Pcs', '28', 'C2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(693, 1, 1, 1, 0, 'S HERO : EVL 4358443585-VALVE KIT HH', 'VALVE KIT HH', '', 1, 'Pcs', '28', 'C2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(694, 1, 1, 1, 0, 'S HERO : UNOO 425 14(8*25)RMW 130A-14(8*25)BOLT NUT WASHER', 'BOLT NUT WASHER', '', 1, 'Pcs', '18', 'C2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(695, 1, 1, 1, 0, 'S HERO : UNOO 035 10(6*35)RMW 118A-10(6*35)BOLT NUT WASHER', '10(6*35)BOLT NUT WASHER', '', 1, 'Pcs', '18', 'C2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(696, 1, 1, 1, 0, 'S HERO : UNOO 040 10(6*40)RMW 119A-10(6*40)BOLT NUT WASHER', '10(6*40)BOLT NUT WASHER', '', 1, 'Pcs', '18', 'C2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(697, 1, 1, 1, 0, 'S HERO : UNOO 025 10*25*6 RMW 116A-10(6*25)BOLT NUT WASHER', '10(6*25)BOLT NUT WASHER', '', 1, 'Pcs', '18', 'C2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(698, 1, 1, 1, 0, 'S HERO : H/H007A (AAA HH 008)-CLUTCH GASKET', 'CLUTCH GASKET', '', 1, 'Pcs', '28', 'C2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(699, 1, 1, 1, 0, 'S HERO : HHS001A-GASKET KIT SSPL/GLAMOUR', 'GASKET KIT SSPL/GLAMOUR', '', 1, 'Pcs', '28', 'C2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(700, 1, 1, 1, 0, 'S HERO : 922 300 241-SINGLE HORN HH/HELLA', 'SINGLE HORN HH/HELLA', '', 1, 'Pcs', '28', 'C2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(701, 1, 1, 1, 0, 'S HERO : SAS 1431J-FR NUMBER PLATE BRACKET SPL+PASS PRO', 'FR NUMBER PLATE BRACKET SPL+PASS PRO', '', 1, 'Pcs', '28', 'C2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(702, 1, 1, 1, 0, 'S HERO : REVM SPPL (RH 90)88110KCC830-MIRROR RH SPL+', 'MIRROR RH SPL+', '', 1, 'Pcs', '28', 'C2', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(703, 1, 1, 1, 0, 'S HERO : REVM SPPL (LH 80)88120KCC830-MIRROR LH SPL+', 'MIRROR LH SPL+', '', 1, 'Pcs', '28', 'C2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(704, 1, 1, 1, 0, 'S HERO : SAP 1019 QNU-INDICATOR ASSY PASS PRO(WH)', 'INDICATOR ASSY PASS PRO(WH)', '', 1, 'Pcs', '28', 'C2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(705, 1, 1, 1, 0, 'S HERO : SAP 1019 ENU-INDICATOR ASSY SPL+ WH', 'INDICATOR ASSY SPL+ WH', '', 1, 'Pcs', '28', 'C2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(706, 1, 1, 1, 0, 'S HERO : SAP 1019 EU-INDICATOR ASSY SPL+(YLW) BLINKER', 'INDICATOR ASSY SPL+(YLW) BLINKER', '', 1, 'Pcs', '28', 'C2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(707, 1, 1, 1, 0, 'S HERO : SAP 1018 ZU-INDICATOR ASSY SPL+(BLINKER)', 'INDICATOR ASSY SPL+(BLINKER)', '', 1, 'Pcs', '28', 'C2', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(708, 1, 1, 1, 0, 'S HERO : 034 SVM BR-SIDE VIEW MIRROR BLACK ROD CD100 HH', 'SIDE VIEW MIRROR BLACK ROD CD100 HH', '', 1, 'Pcs', '28', 'C4', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(709, 1, 1, 1, 0, 'S HERO : MK110301-CLUTCH HOUSING W/RUBBER', 'CLUTCH HOUSING W/RUBBER', '', 1, 'Pcs', '28', 'C3', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(710, 1, 1, 1, 0, 'S HERO : MK110201-INNER CLUTCH ASSY HH', 'INNER CLUTCH ASSY HH', '', 1, 'Pcs', '28', 'C3', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(711, 1, 1, 1, 0, 'S HERO : ANL HH/CD110-CLUTCH PLATE SET HH (ANL)', 'CLUTCH PLATE SET HH (ANL)', '', 1, 'Pcs', '28', 'C3', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(712, 1, 1, 1, 0, 'S TUS : MK1104-CLUTCH PLATE SSPL', 'CLUTCH PLATE SSPL', '', 1, 'Pcs', '28', 'C3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(713, 1, 1, 1, 0, 'S HERO : ZX 2891-KICK BOSS SPL PRO PASS STREEK', ' KICK BOSS SPL PRO PASS STREEK', '', 1, 'Pcs', '28', 'C3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(714, 1, 1, 1, 0, 'S HERO : DT KIT 93-CAM CHAIN FULL KIT (SET-7)', 'CAM CHAIN FULL KIT (SET-7)', '', 1, 'Pcs', '28', 'C3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(715, 1, 1, 1, 0, 'S HERO : HTA KIT 47-OIL SEAL PASSION PRO', 'OIL SEAL PASSION PRO', '', 1, 'Pcs', '28', 'C3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(716, 1, 1, 1, 0, 'S HERO : HTA 6374/6438-OIL SEAL FORK DIS PUL KB', 'OIL SEAL FORK DIS PUL KB', '', 1, 'Pcs', '28', 'C3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(717, 1, 1, 1, 0, 'S HERO : SJ HH 17-CHAIN COVER RUBBER SPL', 'CHAIN COVER RUBBER SPL', '', 1, 'Pcs', '28', 'C3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(718, 1, 1, 1, 0, 'S HERO : ASK/BS/0126-BRAKE SHOE FRT SPL', 'BRAKE SHOE FRT SPL', '', 1, 'Pcs', '28', 'C3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(719, 1, 1, 1, 0, 'S HERO : ASK/BS/D101-BRAKE SHOE HH', 'BRAKE SHOE HH', '', 1, 'Pcs', '28', 'C3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(720, 1, 1, 1, 0, 'S HERO : 32100KCC900S-WIRING HORENESS SPL', 'WIRING HORENESS SPL', '', 1, 'Pcs', '28', 'C3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(721, 1, 1, 1, 0, 'S HERO : AR 5001(ZH 5001)-PETROL TAP ORD SPL', 'PETROL TAP ORD SPL', '', 1, 'Pcs', '28', 'C3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(722, 1, 1, 1, 0, 'S HERO : AR2019-PETROL TAP LOCKABLE', 'PETROL TAP LOCKABLE', '', 1, 'Pcs', '28', 'C3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(723, 1, 1, 1, 0, 'S HERO : AR 1125/5002 AR(ZH 5002)-AR PETROL TAP ORD', 'AR PETROL TAP ORD', '', 1, 'Pcs', '28', 'C3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(724, 1, 1, 1, 0, 'S HERO : AR 6001(ZH-6001)-PETROL TAP SPL CBZ PASS (FUEL COOK LOCK)', 'PETROL TAP SPL CBZ PASS (FUEL COOK LOCK)', '', 1, 'Pcs', '28', 'C3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(725, 1, 1, 1, 0, 'S HERO : KT 2069EZ-LOCK KIT SPL+', 'LOCK KIT SPL+', '', 1, 'Pcs', '18', 'C3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(726, 1, 1, 1, 0, 'S HERO : ZAM 5920-REAR MUD FLAP W/STONE SPL', 'REAR MUD FLAP W/STONE SPL', '', 1, 'Pcs', '28', 'C3', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(727, 1, 1, 1, 0, 'S HERO : RMW 2168-CHAIN COVER BOLT', 'CHAIN COVER BOLT', '', 1, 'Pcs', '18', 'C3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(728, 1, 1, 1, 0, 'S HERO : RMW 2167-(NAI 00)CHAIN COVER BOLT', 'CHAIN COVER BOLT', '', 1, 'Pcs', '18', 'C3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(729, 1, 1, 1, 0, 'S HERO : SAS 9122 (RMW 2479)-SIDE STAND NUT BOLT', 'SIDE STAND NUT BOLT', '', 1, 'Pcs', '28', 'C3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(730, 1, 1, 1, 0, 'S HERO : NAJ140-BRAKE DRUM BOLT NUT WASHER', 'BRAKE DRUM BOLT NUT WASHER', '', 1, 'Pcs', '18', 'C3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(731, 1, 1, 1, 0, 'S HERO : NAJ515(RMW2177)-BOLT FOR CLUTCH LEVER HH', 'BOLT FOR CLUTCH LEVER HH', '', 1, 'Pcs', '18', 'C3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(732, 1, 1, 1, 0, 'S HERO : ESS HH 40-HEAD O-RING KIT', 'HEAD O-RING KIT', '', 1, 'Pcs', '28', 'C3', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(733, 1, 1, 1, 0, 'S HERO : BA 3454-KICKER ASSY SLEEK/SPL', 'KICKER ASSY SLEEK/SPL', '', 1, 'Pcs', '28', 'C3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(734, 1, 1, 1, 0, 'S HERO : BA 3430-GEAR LEVER SPL', 'GEAR LEVER SPL', '', 1, 'Pcs', '28', 'C3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(735, 1, 1, 1, 0, 'S HERO : F002H234518F-AIR FILTER HH PASSION JOY SPL DAWN CD DAV CD DLX', 'AIR FILTER HH PASSION JOY SPL DAWN CD DAV CD DLX', '', 1, 'Pcs', '18', 'C3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(736, 1, 1, 1, 0, 'S HERO : F002H23518-AIR FILTER (SUP SPL/GLAM/SPL PRO', 'AIR FILTER (SUP SPL/GLAM/SPL PRO', '', 1, 'Pcs', '18', 'C3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(737, 1, 1, 1, 0, 'S HERO : V23 82753250-AIR FILTER (PLASTIC TYPE) UNICO', 'AIR FILTER (PLASTIC TYPE) UNICO', '', 1, 'Pcs', '28', 'C3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(738, 1, 1, 1, 0, 'S HERO : SHH 0144-CLUTCH CABLE SPL PRO', 'CLUTCH CABLE SPL PRO', '', 1, 'Pcs', '28', 'C3', 'E', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(739, 1, 1, 1, 0, 'S HERO : 39100006-HEAD PIN', 'HEAD PIN', '', 1, 'Pcs', '18', 'C4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(740, 1, 1, 1, 0, 'S HERO : DU101057-INSULATOR CARB', 'INSULATOR CARB', '', 1, 'Pcs', '28', 'C4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(741, 1, 1, 1, 0, 'S HERO : 39218106-HEAD DOWEL PIN', 'HEAD DOWEL PIN', '', 1, 'Pcs', '28', 'C4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(742, 1, 1, 1, 0, 'S HERO : DFI61102-SIDE STAND BOLT', 'SIDE STAND BOLT', '', 1, 'Pcs', '18', 'C4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(743, 1, 1, 1, 0, 'S HERO : 39097804-SPROCKET BOLT', 'SPROCKET BOLT', '', 1, 'Pcs', '18', 'C4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(744, 1, 1, 1, 0, 'S HERO : 31101014(0011510008)-SIL GASKET', 'SIL GASKET', '', 1, 'Pcs', '28', 'C4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(745, 1, 1, 1, 0, 'S HERO : 39079415-SPROCKET BOLT', 'SPROCKET BOLT', '', 1, 'Pcs', '18', 'C4', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(746, 1, 1, 1, 0, 'S HERO : ZX HON106-FORK BALLS KIT UNI/HV/SHAIN/SSPL', 'FORK BALLS KIT UNI/HV/SHAIN/SSPL', '', 1, 'Pcs', '28', 'C4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(747, 1, 1, 1, 0, 'S HERO : SAS 8672(309BA15010)-FR SPROCKET COCK', 'FR SPROCKET COCK', '', 1, 'Pcs', '28', 'C4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(748, 1, 1, 1, 0, 'S HERO : 30151069(0011415037)-SPRING BRAKE SHOE', 'SPRING BRAKE SHOE', '', 1, 'Pcs', '28', 'C4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(749, 1, 1, 1, 0, 'S HERO : 39243704(39242704)-WHEEL DISC 10MM (BOLT ALLANKEY)', 'WHEEL DISC 10MM (BOLT ALLANKEY)', '', 1, 'Pcs', '18', 'C4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(750, 1, 1, 1, 0, 'S HERO : H/HOISE-TAPPED O-RING HH', 'TAPPED O-RING HH', '', 1, 'Pcs', '28', 'C4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(751, 1, 1, 1, 0, 'S HERO : 001BC10007(DH101520)-NUT CRANK LH DTS', 'NUT CRANK LH DTS', '', 1, 'Pcs', '18', 'C4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(752, 1, 1, 1, 0, 'S HERO : P080140-SPRING KICK STARTER', 'SPRING KICK STARTER', '', 1, 'Pcs', '18', 'C4', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(753, 1, 1, 1, 0, 'S HERO : 034 SVM BR-SIDE VIEW MIRROR BLACK ROD CD 100 HH', 'SIDE VIEW MIRROR BLACK ROD CD 100 HH', '', 1, 'Pcs', '28', 'C4', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(754, 1, 1, 1, 0, 'S HERO : MK1104-CLUTCH PLATE SUP SPL', 'CLUTCH PLATE SUP SPL', '', 1, 'Pcs', '28', 'C3', 'B', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(755, 1, 1, 1, 0, 'S HOND : DT KIT 40-CHAIN SPROCKET KIT CD 100 NEW', 'CHAIN SPROCKET KIT CD 100 NEW', '', 1, 'Pcs', '28', 'F1', 'A', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(756, 1, 1, 1, 0, 'G HERO : 29K300S- S METER GEAR KIT (SPL)', 'S METER GEAR KIT (SPL)', '', 1, 'Pcs', '28', 'B5', 'C', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(757, 1, 1, 1, 0, 'G HERO : 44830KTP900S-SPEEDO CABLE', 'SPEEDO CABLE', '', 1, 'Pcs', '28', 'B1', 'G', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(758, 1, 1, 1, 0, 'S HOND : ACT001A-FULL GASKET KIT ACTIVA,PLUASURE', 'FULL GASKET KIT ACTIVA,PLUASURE', '', 1, 'Pcs', '28', 'F2', 'D', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(759, 1, 1, 1, 0, 'S TVS : SAN MRP 24-BRAKE PEDAL RUBBER', 'BRAKE PEDAL RUBBER', '', 1, 'Pcs', '28', 'CD3', 'F', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(760, 1, 1, 1, 0, '123', 'BREAK', '', 1, 'Pcs', '12', '', '', 0, '', '1', '1', 0.00, 0.00, 0.00, 2),
(761, 1, 1, 1, 0, '001 TEST ITEM', '', 'abc123', 1, 'Box', '12', '', '', 0, '10002', '1', '1', 0.00, 0.00, 0.00, 2),
(762, 1, 1, 1, 0, 'ASDASDASD', '', '', 1, 'Box', '12', '', '', 0, '', '1', '1', 0.00, 0.00, 0.00, 2);

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
(1, 'TEST CATEGORY', '', '#000000');

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
(1, 1, 'AUTOMOBILE');

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
(1, 'USER', 'USER', 1, 'U'),
(5, 'ADMIN', 'ADMIN', 1, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `m_openingstock`
--

CREATE TABLE IF NOT EXISTS `m_openingstock` (
  `openingstockno` int(5) NOT NULL,
  `itemno` int(5) NOT NULL,
  `qty` int(6) NOT NULL,
  `mrp` double(10,2) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `expdate` date NOT NULL,
  PRIMARY KEY (`openingstockno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Saleem', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_size`
--

CREATE TABLE IF NOT EXISTS `m_size` (
  `sizeno` int(3) NOT NULL,
  `sizename` varchar(50) NOT NULL,
  PRIMARY KEY (`sizeno`),
  UNIQUE KEY `sizename` (`sizename`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_size`
--

INSERT INTO `m_size` (`sizeno`, `sizename`) VALUES
(1, 'None');

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
  `unitname` varchar(50) NOT NULL,
  PRIMARY KEY (`unitno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_unit`
--

INSERT INTO `m_unit` (`unitno`, `unitname`) VALUES
(1, 'Pcs'),
(2, 'Box');

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
(1, 'Nellai Bill', 'LINE 1', 'line 2', 'line 3', '9090909090', 'tech');

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
