<?php
include('config.php');
$xDate=$_GET['date'];

mysql_query("delete from xexpenses where date='$xDate'");
header('location:xviewallexpenses.php');

?>