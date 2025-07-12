<?php
setlocale(LC_MONETARY, 'en_IN');
date_default_timezone_set("Asia/Kolkata");
$con =@mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
mysqli_select_db($con, "stlukes") or die(mysqli_error($con));
?>
