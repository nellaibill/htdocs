
<?php
setlocale ( LC_MONETARY, 'en_IN' );
date_default_timezone_set ( "Asia/Kolkata" );
$con = @mysql_connect ( "localhost", "root", "" ) or die ( mysql_error () );
mysql_select_db ( "barani" ) or die ( mysql_error () );
?>
