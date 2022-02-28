<?php

require_once('config.php');

$xIncome = "SELECT * INTO OUTFILE 'd:/income.sql' FROM income";
mysql_query( $xIncome, $con );

$xExpenses = "SELECT * INTO OUTFILE 'd:/expenses.sql' FROM expenses";
mysql_query( $xExpenses, $con );

?>