<?php
include('config.php');
$xDate=$_GET['date'];

mysql_query("delete from income where date='$xDate'");
header('location:viewincome.php');

?>