<?php
setlocale(LC_MONETARY, 'en_IN');
date_default_timezone_set("Asia/Kolkata");
$xHostName="127.0.0.1";
$xUserName="root";
$xPassword="";
$xDbName="inv_diamondmarbles";
 $con =@mysql_connect($xHostName, $xUserName, $xPassword) or die(mysql_error());
mysql_select_db($xDbName) or die(mysql_error());

?>
