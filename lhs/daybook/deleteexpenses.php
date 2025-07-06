<?php
include('config.php');
$xDate=$_GET['date'];

mysql_query("delete from expenses where date='$xDate'");
mysql_query("delete from xexpenses where date='$xDate'");
header('location:viewallexpenses.php');

?>