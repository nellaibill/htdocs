<?php
include 'config.php';
$xItemNo = $_GET['itemno'];
$xBatch = $_GET['batch'];
$xReturnValue=0;
$sql="select stock 
 from inv_stockentry WHERE itemno= ".$xItemNo." and batch='".$xBatch."'";
//echo $sql;
$result=mysql_query($sql);
while($row = mysql_fetch_array($result)) {
$xReturnValue= $row['stock'] ;
}
echo $xReturnValue;
mysql_close($con);

?>
