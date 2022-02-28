<?php
include 'config.php';
$xItemNo = $_GET['itemno'];
$xBatch = $_GET['batch'];
$xReturnValue=0;


$sql="select mrp 
 from inv_stockentry WHERE itemno= ".$xItemNo." and batch='".$xBatch."'";

//echo $sql;
$result=mysql_query($sql);
while($row = mysql_fetch_array($result)) {
$xReturnValue= $row['mrp'] ;
}
echo $xReturnValue;
mysql_close($con);

?>