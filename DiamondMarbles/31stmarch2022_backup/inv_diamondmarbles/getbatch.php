<?php
include 'config.php';
$xItemNo = $_GET['itemno'];
$xReturnValue=0;
$result=mysql_query("select batch,mrp,stock,expdate 
 from inv_stockentry where itemno= ".$xItemNo." and stock>0 order by stockno asc");
while($row = mysql_fetch_array($result)) {
	echo $row['batch'];
	echo " || ";
	echo $row['mrp'];
	echo " || ";
	echo $row['stock'];
	echo " || ";
	echo $row['expdate'];
//$xReturnValue= $row['batch'] ;
}
//echo $xReturnValue;
mysql_close($con);

?>
