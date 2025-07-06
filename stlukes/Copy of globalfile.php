<?php
/* Error -warning cannot modify header information - headers already sent by (output started at in php */
ob_start ();
ob_flush ();
/* Error Ended */
date_default_timezone_set ( 'Asia/Calcutta' );
include ('config.php');
include ('globallinks.html');
include ('globalfunctions.php');
include ('header.php');
include 'menu.php';
include 'footer.php';
include 'hs001backup.php';
?>