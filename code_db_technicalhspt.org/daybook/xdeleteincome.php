<?php
include('config.php');
$xDate=$_GET['date'];

mysql_query("delete from xincome where date='$xDate'");
header('location:xviewincome.php');

?>