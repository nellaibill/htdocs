<?php
include 'config.php';
$xItemNo = $_GET['itemno'];
$xReturnValue=0;
$result=mysql_query("select gst 
 FROM m_item WHERE itemno= ".$xItemNo."");
while($row = mysql_fetch_array($result)) {
$xReturnValue= $row['gst'] ;
}
echo $xReturnValue;
mysql_close($con);

?>