<?php
date_default_timezone_set ( 'Asia/Calcutta' );
include 'config.php';
include 'functions.php';
session_start();
$GLOBALS ['xUserName'] = $_SESSION['member_id'];
$GLOBALS ['xUserRole']='U';
$result=mysql_query("select * from m_login where username='$xUserName'")or die (mysql_error());	
$count=mysql_num_rows($result);
$row=mysql_fetch_array($result);
		if ($count > 0){
                	$GLOBALS ['xUserRole']=$row['role'];
                }
$GLOBALS ['xMode'] = '';
$GLOBALS ['xCurrentDate'] = date ( 'Y-m-d' );
$GLOBALS ['xCurrentDateTime'] = date ( 'Y-m-d H:i:s' );
$GLOBALS ['xStockPointName'] = '';
$GLOBALS ['xItemCategoryNo'] = '';
$GLOBALS ['xItemGroupNo'] = '';
$GLOBALS ['xItemSubGroupNo'] = '';

$GLOBALS ['xSupplierName'] = '';
$GLOBALS ['xSupplierAddress'] = '';
$GLOBALS ['xSupplierGSTINNo'] = '';
$GLOBALS ['xSupplierCstNo'] = '';
$GLOBALS ['xSupplierTaxNo'] = '';
$GLOBALS ['xSupplierPanNo'] = '';

$GLOBALS ['xCustomerName'] = '';
$GLOBALS ['xCustomerNo'] = '';
$GLOBALS ['xCustomerAddress'] = '';
$GLOBALS ['xCustomerMobileNo'] = '';
$GLOBALS ['xCustomerGSTINNo'] = '';
$GLOBALS ['xCustomerAADHARNo'] = '';



$GLOBALS ['xConfigItem_ItemNo'] = '';
$GLOBALS ['xConfigItem_ItemDescription'] = '';
$GLOBALS ['xConfigItem_HsnCode'] = '';
$GLOBALS ['xConfigItem_PackNo'] = '';
$GLOBALS ['xConfigItem_PackDescription'] = '';
$GLOBALS ['xConfigItem_Gst'] = '';
$GLOBALS ['xConfigItem_Rack'] = '';
$GLOBALS ['xConfigItem_Row']= '';
$GLOBALS ['xConfigItem_MinStock'] = '';
$GLOBALS ['xConfigItem_StockPoint'] = '';
$GLOBALS ['xConfigItem_Group'] = '';
$GLOBALS ['xConfigItem_Tamil'] = '';
$GLOBALS ['xItemName']='';
$GLOBALS ['xConfigPurchase_InvoiceNo'] = '';
$GLOBALS ['xConfigPurchase_Batch']= '';
$GLOBALS ['xConfigPurchase_Expiry']= '';
$GLOBALS ['xConfigPurchase_Discount'] = '';
$GLOBALS ['xConfigPurchase_Gst'] = '';
/*
 * $GLOBALS ['xConfigPurchase_Batch'] = 'No';
 * $GLOBALS ['xConfigPurchase_Expiry'] = 'No';
 * $GLOBALS ['xConfigPurchase_Description'] = 'No';
 */
$GLOBALS ['xDepartmentColor'] = "#ffffff"; // Default Color- White
?>