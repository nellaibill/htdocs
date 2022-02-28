<?php

// Make a MySQL Connection
mysql_connect("localhost", "lakshmih_saleem", "saleem") or die(mysql_error());
mysql_select_db("lakshmih_saleem") or die(mysql_error());

// Create a MySQL table in the selected database
$xAttendenceQry= "CREATE TABLE `attendence` (
  `txno` int(5) NOT NULL,
  `date` date NOT NULL,
  `departmentno` int(5) NOT NULL,
  `empno` int(5) NOT NULL,
  `shift` varchar(10) NOT NULL,
  `status` float NOT NULL,
  `intime` varchar(50) NOT NULL,
  `outtime` varchar(50) NOT NULL,
  `totaltime` time NOT NULL,
  PRIMARY KEY (`date`,`empno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";


$xBankDetailsQry= "CREATE TABLE `bankdetails` (
  `txno` int(2) NOT NULL,
  `acno` bigint(15) NOT NULL,
  `acname` varchar(100) NOT NULL,
  PRIMARY KEY (`txno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";


$xBankTransactionQry="CREATE TABLE `banktransaction` (
  `txno` int(5) NOT NULL,
  `date` date NOT NULL,
  `bankacno` bigint(15) NOT NULL,
  `chequeno` bigint(15) NOT NULL,
  `actype` varchar(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`txno`),
  KEY `fkey` (`bankacno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

mysql_query($xAttendenceQuery) or die(mysql_error());  
mysql_query($xBankDetailsQry) or die(mysql_error());  
mysql_query($xBankTransactionQry) or die(mysql_error());  

?>