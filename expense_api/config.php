<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$connection = new mysqli("localhost", "root", "", "expensemgmt") or die(mysqli_error());
?>