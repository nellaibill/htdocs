<?php
setlocale ( LC_MONETARY, 'en_IN' );
date_default_timezone_set ( "Asia/Kolkata" );
// Updated to use mysqli
$con = mysqli_connect ( "localhost", "root", "", "barani" );
if (!$con) {
    die ( "Connection failed: " . mysqli_connect_error() );
}
?>
