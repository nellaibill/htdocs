<?php
setlocale(LC_MONETARY, 'en_IN');
$con =mysql_connect("localhost", "lakshmih_admin", "admin") or die(mysql_error());
mysql_select_db("lakshmih_daybook") or die(mysql_error());

?>
