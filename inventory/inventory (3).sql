-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2017 at 04:02 PM
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

--
-- Dumping data for table `account_ledger`
--

INSERT INTO `account_ledger` (`account_ledger_id`, `ledger_name`, `ledger_alias_name`, `ledger_undergroup_no`, `ledger_address`, `ledger_mobile_no`, `ledger_unique_no`, `credit_limit`, `opening_balance`) VALUES
(1, 'test supplier', '', 4, '', '', '', 0.00, 0.00),
(2, 'Test Customer', '', 5, '', '', '', 0.00, 0.00);

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

--
-- Dumping data for table `audit_stock`
--

INSERT INTO `audit_stock` (`audit_stock_itemno`, `audit_stock_qty`, `audit_stock_datetime`, `audit_stock_mode`) VALUES
(1, 100, '2017-12-17 17:40:13', 'INSERT'),
(1, 98, '2017-12-17 17:40:53', 'UPDATE');

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE IF NOT EXISTS `backup` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `backup`
--

INSERT INTO `backup` (`id`, `date`) VALUES
(56, '2017-11-25'),
(57, '2017-11-27'),
(58, '2017-12-07'),
(59, '2017-12-08'),
(60, '2017-12-09'),
(61, '2017-12-12'),
(62, '2017-12-15'),
(63, '2017-12-16'),
(64, '2017-12-17');

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
(1, 1, 1, 1, 4, 5, 1, '2017-10-01', '2017-12-30', 0, 0, 'print_format6.php', 2, 2);

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
(1, 'Yes', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'No', 'Yes', 'No', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No');

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
(1, 'No', 'Yes', 'Yes', 'Yes', 'No');

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
  `date` date NOT NULL,
  `createdason` datetime NOT NULL,
  `updatedason` datetime NOT NULL,
  PRIMARY KEY (`txno`),
  KEY `itemno` (`itemno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_purchaseentry`
--

INSERT INTO `inv_purchaseentry` (`txno`, `purchaseinvoiceno`, `itemno`, `purchasedescription`, `dateexpired`, `batchid`, `qty`, `freeqty`, `currentqty`, `originalprice`, `sellingprice`, `discount`, `vat`, `total`, `nettotal`, `profit`, `date`, `createdason`, `updatedason`) VALUES
(1, 1, 1, '', '2018-12-17', '123', 100, 0, 100.00, '10.00', '15.00', '0.00', '18.00', '1180.00', '1770.00', '590.00', '2017-12-17', '2017-12-17 17:40:12', '2017-12-17 17:40:12');

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

--
-- Dumping data for table `inv_purchaseentry1`
--

INSERT INTO `inv_purchaseentry1` (`purchaseinvoiceno`, `supplierno`, `companyinvoiceno`, `totalamount`, `date`, `freight`, `others`) VALUES
(1, 1, '', 1180.00, '2017-12-17', 0.00, 0.00);

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

--
-- Dumping data for table `inv_salesentry`
--

INSERT INTO `inv_salesentry` (`txno`, `salesinvoiceno`, `purchaseinvoiceno`, `purchaseinvoicetxno`, `date`, `customerno`, `itemno`, `batchid`, `dateexpired`, `qty`, `unitrate`, `amount`, `vat`, `discountpercentage`, `usagestockpointno`, `usagestockdetails`, `createdason`, `updatedason`, `unitmrp`) VALUES
(1, 1, 0, 0, '2017-12-17', 2, 1, '123 ', '2018-12-17', 2, 12.71, 25.42, 18.00, 0.00, 0, '', '2017-12-17 17:40:53', '2017-12-17 17:40:53', 15.00);

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
  `salesperson_id` varchar(100) NOT NULL,
  PRIMARY KEY (`salesinvoiceno`),
  KEY `customerno` (`customerno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_salesentry1`
--

INSERT INTO `inv_salesentry1` (`salesinvoiceno`, `date`, `customerno`, `totalamount`, `lessamount`, `despatch`, `destination`, `modeofpayment`, `termsofdelivery`, `vehicleno`, `servicecharges`, `salesperson_id`) VALUES
(1, '2017-12-17', 2, 30.00, 0.00, '', '', 'Cash', 'OP', '', '', 'user');

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
-- Dumping data for table `inv_stockentry`
--

INSERT INTO `inv_stockentry` (`stockno`, `itemno`, `stock`, `minstock`, `maxstock`, `mrp`, `batch`, `expdate`) VALUES
(1, 1, 98, 0, 0, 15.00, '123', '2018-12-17');

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
(1, 'Blk'),
(2, 'Brn'),
(6, 'Grn'),
(7, 'Multi'),
(10, 'Pink'),
(9, 'Red'),
(5, 'Wht'),
(8, 'Ylw');

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
(1, 1, 1, 1, 0, 'TEST ITEM', '', '12345', 1, 'Kgs', '18', '', '', 0, '1', '1', '1', 0.00, 0.00, 0.00, 1);

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
(1, 1, 'TEST GROUP');

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
(1, '1'),
(10, '10'),
(11, '11'),
(12, '12'),
(13, '13'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9');

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
(1, 'Kgs'),
(2, 'Pcs');

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
(1, 'COMPANY NAME', 'ADDRESS LINE 1', 'ADDRESS LINE 2', 'ADDRESS LINE 3', '9090909090', 'GST NO');

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
