<?php
/* Error -warning cannot modify header information - headers already sent by (output started at in php */
ob_start(); 
ob_flush(); 
/* Error Ended */
include('config.php');
include('globallinks.html');
include('globalfunctions.php');
include 'menu.php';
include 'hs001backup.php';
?>