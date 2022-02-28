<?php
include 'globalfunctions.php';
$xBarCode = $_GET['barcode'];
$result = mysql_query("select * 
 FROM m_item WHERE barcode= " . $xBarCode);
while ($row = mysql_fetch_array($result)) {
    //finditemname($row['itemno']);
    //echo $GLOBALS ['xItemName'];
	echo $row['itemno'];
    echo " || ";
    echo $row['gst'];
    echo " || ";
    echo $row['mrp'];
    echo " || ";
    $xPurchaseCode = '';
    $xSplittedString = (string) $row['originalprice'];
    $xPurchaseCode .= fn_GetPurchaseCode($xSplittedString[0]);
    $xPurchaseCode .= fn_GetPurchaseCode($xSplittedString[1]);
    $xPurchaseCode .= fn_GetPurchaseCode($xSplittedString[2]);
    echo " || ";
    echo $xPurchaseCode;
}

mysql_close($con);
?>