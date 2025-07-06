<?php
setlocale(LC_MONETARY, 'en_IN');
date_default_timezone_set("Asia/Kolkata");
$xHostName="localhost";
$xUserName="root";
$xPassword="";
$xDbName="shc_pharmacy";
 $con =@mysql_connect($xHostName, $xUserName, $xPassword) or die(mysql_error());
mysql_select_db($xDbName) or die(mysql_error());
?>
