<?php
date_default_timezone_set ( 'Asia/Calcutta' );
include 'config.php';
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

getconfig_inventoryvalues ();
fn_GetCompanyInfo ( 1 );
function fn_GetPurchaseCode($xNumber)
{
    if($xNumber!=".")
    {
        $xPurchaseCode = array("A", "B", "C","D","E","F","G","H","I","J",".");
echo $xPurchaseCode[$xNumber];
    }
 else {
       echo "";
 }

}
function finditemno($xNo) {
	$result = mysql_query ( "SELECT *  FROM m_item where itemname='".$xNo."'" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xItemNo'] = $row ['itemno'];
	
	}
}
/* --------------------- Money Format ------------------------------ */
function fn_RupeeFormat($value) {
	return ' ' . number_format ( $value, 2 );
}
function fn_NoDataFound() {
	echo '<tr bgcolor=red>';
	echo '<td colspan=3> NO RESULTS WERE FOUND</td>';
	echo '</tr>';
}

/* -------------------- Get Account Group Information ------------------------------ */
function fn_FindAccountGroupName($xId) {
	$result = mysql_query ( "SELECT *  FROM account_group where account_group_id=$xId" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xAccountGroupName'] = $row ['account_group_name'];
	}
}
function fn_FindAccountLedgerDetails($xId) {
	$result = mysql_query ( "SELECT *  FROM account_ledger where account_ledger_id=$xId" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xAccountLedgerName'] = $row ['ledger_name'];
	}
}

function fn_FindSalesPersonDetails($xId) {
	$result = mysql_query ( "SELECT *  FROM m_salesperson
	 where salesperson_id=$xId" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xSalesPersonName'] = $row ['salesperson_name'];
	}
}

function fn_FindLoginDetails($xId) {
	$result = mysql_query ( "SELECT *  FROM m_login
	 where password='$xId'" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xLoginUserName'] = $row ['username'];
	}
}
function fn_FindDoctor($xNo)
{
	$xQry="SELECT *  FROM fmcg_doctor where doctorno=$xNo";
	$result = mysql_query ($xQry) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) )
	{
		$GLOBALS ['xDoctorName'] = $row ['doctorname'];
	}
}
/* -------------------- Get Company Information ------------------------------ */
function fn_GetCompanyInfo($xNo) {
	$result = mysql_query ( "SELECT *  FROM setup_companyinfo where companyno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xCompanyTitle'] = $row ['companytitle'];
		$GLOBALS ['xCompanyAddress1'] = $row ['companyaddress1'];
		$GLOBALS ['xCompanyAddress2'] = $row ['companyaddress2'];
		$GLOBALS ['xCompanyAddress3'] = $row ['companyaddress3'];
		$GLOBALS ['xCompanyContactNo'] = $row ['companycontactno'];
		$GLOBALS ['xCompanyGSTINNo'] = $row ['gstinno'];
	}
}
function getconfig_inventoryvalues() {
	$result = mysql_query ( "SELECT *  FROM config_inventory" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xItemCategoryNo'] = $row ['categoryno'];
		$GLOBALS ['xItemGroupNo'] = $row ['groupno'];
		$GLOBALS ['xItemSubGroupNo'] = $row ['subgroupno'];
		$GLOBALS ['xStockPointNo'] = $row ['stockpointno'];
		$GLOBALS ['xSupplierNo'] = $row ['supplierno'];
		$GLOBALS ['xCustomerNo'] = $row ['customerno'];
		$GLOBALS ['xItemNo'] = $row ['itemno'];
		$GLOBALS ['xFromDate'] = $row ['fromdate'];
		$GLOBALS ['xToDate'] = $row ['todate'];
		
		$GLOBALS ['xInvFromDate'] = $row ['fromdate'];
		$GLOBALS ['xInvToDate'] = $row ['todate'];
		
		$GLOBALS ['xTempPurchaseQty'] = $row ['temppurchaseqty'];
		$GLOBALS ['xTempSalesQty'] = $row ['tempsalesqty'];
		$GLOBALS ['xPrintTemplate'] = $row ['print_template'];
		
		$GLOBALS ['xPurchaseInvoiceNo'] = $row ['purchase_invoice_no'];
		$GLOBALS ['xConfigSalesInvoiceNo'] = $row ['sales_invoice_no'];
	}
}
function getconfig_sales() {
	$result = mysql_query ( "SELECT *  FROM config_sales" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xConfigSales_InvoiceNo'] = $row ['invoiceno'];
		$GLOBALS ['xConfigSales_Stock'] = $row ['stock'];
		$GLOBALS ['xConfigSales_Gst'] = $row ['gst'];
		$GLOBALS ['xConfigSales_Discount'] = $row ['discount'];
		$GLOBALS ['xConfigSalesPerson'] = $row ['salesperson'];
		$GLOBALS ['xConfigDeliveryTerms'] = $row ['delivery'];
		$GLOBALS ['xConfigDespatch'] = $row ['despatch'];
		$GLOBALS ['xConfigDestination'] = $row ['destination'];
		$GLOBALS ['xConfigVehicleNo'] = $row ['vehicleno'];
		$GLOBALS ['xConfigServiceCharges'] = $row ['service'];
	}
}


function getconfig_purchase() {
	$result = mysql_query ( "SELECT *  FROM config_purchase" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xConfigPurchase_InvoiceNo'] = $row ['config_purchase_invoiceno'];
		$GLOBALS ['xConfigPurchase_Batch'] = $row ['config_purchase_batch'];
		$GLOBALS ['xConfigPurchase_Expiry'] = $row ['config_purchase_expiry'];
		$GLOBALS ['xConfigPurchase_Discount'] = $row ['config_purchase_discount'];
		$GLOBALS ['xConfigPurchase_Gst'] = $row ['config_purchase_gst'];
}
}
function getconfig_print() {
	$result = mysql_query ( "SELECT *  FROM config_print" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xPrintTemplate'] = $row ['config_print_template'];
		$GLOBALS ['xPrintSrc'] = $row ['config_print_src'];

}
}
function getconfig_quotation() {
	$result = mysql_query ( "SELECT *  FROM config_quotation" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xLine1'] = $row ['line1'];
		$GLOBALS ['xLine2'] = $row ['line2'];
                $GLOBALS ['xLine3'] = $row ['line3'];
		$GLOBALS ['xLine4'] = $row ['line4'];
		$GLOBALS ['xLine5'] = $row ['line5'];
		$GLOBALS ['xLine6'] = $row ['line6'];
		$GLOBALS ['xLine7'] = $row ['line7'];
		$GLOBALS ['xLine8'] = $row ['line8'];
		$GLOBALS ['xLine9'] = $row ['line9'];
		$GLOBALS ['xLine10'] = $row ['line10'];
        }  
}
function getconfig_item() {
	$result = mysql_query ( "SELECT *  FROM config_item" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xConfigItem_ItemNo'] = $row ['itemno'];
		$GLOBALS ['xConfigItem_ItemDescription']= $row ['itemdescription'];
		$GLOBALS ['xConfigItem_HsnCode'] = $row ['hsncode'];
		$GLOBALS ['xConfigItem_Gst'] = $row ['gst'];
		$GLOBALS ['xConfigItem_PackNo'] = $row ['packno'];
		$GLOBALS ['xConfigItem_PackDescription'] = $row ['packdescription'];
		$GLOBALS ['xConfigItem_Rack'] = $row ['rack'];
		$GLOBALS ['xConfigItem_Row'] = $row ['row'];
		$GLOBALS ['xConfigItem_MinStock'] = $row ['minstock'];
		$GLOBALS ['xConfigItem_StockPoint'] = $row ['stockpoint'];
		$GLOBALS ['xConfigItem_Group'] = $row ['group'];
	
                                $GLOBALS ['xConfigItem_BarCode'] = $row ['barcode'];
                $GLOBALS ['xConfigItem_Color'] = $row ['color'];
                $GLOBALS ['xConfigItem_Size'] = $row ['size'];
                $GLOBALS ['xConfigItem_OriginalPrice'] = $row ['originalprice'];
                $GLOBALS ['xConfigItem_Mrp'] = $row ['mrp'];
                $GLOBALS ['xConfigItem_DisAmount'] = $row ['disamount'];
                $GLOBALS ['xConfigItem_SupplierNo'] = $row ['supplierno'];   
                $GLOBALS ['xConfigItem_TypeTamil'] = $row ['typetamil'];   
	}
}


function findsuppliername($xNo) {
	$result = mysql_query ( "SELECT *  FROM account_ledger where account_ledger_id=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xSupplierName'] = $row ['ledger_name'];
		$GLOBALS ['xSupplierNo'] = $row ['account_ledger_id'];
		$GLOBALS ['xSupplierAddress'] = $row ['ledger_address'];
		$GLOBALS ['xSupplierGSTINNo'] = $row ['ledger_unique_no'];
		/*
		 * $GLOBALS ['xSupplierCstNo'] = $row ['suppliercstno'];
		 * $GLOBALS ['xSupplierTaxNo'] = $row ['suppliertaxno'];
		 * $GLOBALS ['xSupplierPanNo'] = $row ['supplierpanno'];
		 */
	}
}
function findcustomername($xNo) {
	$result = mysql_query ( "SELECT *  FROM account_ledger where account_ledger_id=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xCustomerName'] = $row ['ledger_name'];
		$GLOBALS ['xCustomerNo'] = $row ['account_ledger_id'];
		$GLOBALS ['xCustomerAddress'] = $row ['ledger_address'];
		$GLOBALS ['xCustomerMobileNo'] = $row ['ledger_mobile_no'];
		$GLOBALS ['xCustomerGSTINNo'] = $row ['ledger_unique_no'];
		// $GLOBALS ['xCustomerAADHARNo'] = $row ['customerregisterno'];
	}
}
function finditemprice($xNo) {
	$result = mysql_query ( "SELECT *  FROM inv_purchaseentry where itemno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xItemSellingPrice'] = $row ['sellingprice'];
	}
}
function finditempricevat($xItemNo, $xBatchid) {
	$result = mysql_query ( "SELECT sellingprice,vat,dateexpired  FROM inv_purchaseentry where itemno=$xItemNo and batchid='$xBatchid'" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xSelectedItemSellingPrice'] = $row ['sellingprice'];
		$GLOBALS ['xSelectedItemVat'] = $row ['vat'];
		$GLOBALS ['xSelectedItemBatchExpDate'] = $row ['dateexpired'];
	}
}
function fn_FindSizeName($xId) {
	$result = mysql_query ( "SELECT *  FROM m_size where sizeno=$xId" ) 
	or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xSizeName'] = $row ['sizename'];
	}
}
function fn_FindColorName($xId) {
	$result = mysql_query ( "SELECT *  FROM m_color where colorno=$xId" ) 
	or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xColorName'] = $row ['colorname'];
	}
}
function finditemname($xNo) {
	$result = mysql_query ( "SELECT *  FROM m_item where itemno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xItemName'] = $row ['itemname'];
		$GLOBALS ['xItemDescription']=$row ['itemdescription'];
		$GLOBALS ['xHSNCode'] = $row ['hsncode'];
		$GLOBALS ['xItemNo'] = $row ['itemno'];
		$GLOBALS ['xStockPointNo'] = $row ['stockpointno'];
		$GLOBALS ['xItemCategoryNo'] = $row ['itemcategoryno'];
		$GLOBALS ['xItemGroupNo'] = $row ['itemgroupno'];
		$GLOBALS ['xItemSubGroupNo'] = $row ['itemsubgroupno'];
		$GLOBALS ['xPackNo'] = $row ['packno'];
		$GLOBALS ['xPackDescription'] = $row ['packdescription'];
		$GLOBALS ['xMinStock'] = $row ['minstock'];
		$GLOBALS ['xGst'] = $row ['gst'];
	}
}
function finditemstock($xItemNo, $xBatch) {
	$result = mysql_query ( "SELECT *  FROM inv_stockentry 
			where itemno= " . $xItemNo . " and batch='" . $xBatch . "'" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xCurrentStock'] = $row ['stock'];
	}
}
function finditemgroupname($xNo) {
	$result = mysql_query ( "SELECT *  FROM m_itemgroup where itemgroupno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xItemGroupName'] = $row ['itemgroupname'];
		$GLOBALS ['xItemCategoryNo'] = $row ['itemcategoryno'];
	}
}
function finditemsubgroupname($xNo) {
	$result = mysql_query ( "SELECT *  FROM m_itemsubgroup where itemsubgroupno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xItemSubGroupName'] = $row ['itemsubgroupname'];
	}
}
function finditemcategoryname($xNo) {
	$result = mysql_query ( "SELECT *  FROM m_itemcategory where itemcategoryno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		
		$GLOBALS ['xItemCategoryName'] = $row ['itemcategoryname'];
		$GLOBALS ['xItemCategoryShortName'] = $row ['itemcategoryshortname'];
		$GLOBALS ['xItemCategoryColor'] = $row ['itemcategorycolor'];
	}
}
function findstockpointname($xNo) {
	$result = mysql_query ( "SELECT *  FROM m_stockpoint where stockpointno=$xNo" ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xStockPointName'] = $row ['stockpointname'];
		$GLOBALS ['xStockPointShortName'] = $row ['stockpointshortname'];
	}
}

/* ------------- Drop Down Function ----------------- */
function DropDownSupplier() {
	$result = mysql_query ( "SELECT *  FROM inv_supplier where supplierid!=0 order by suppliername" );
	while ( $row = mysql_fetch_array ( $result ) ) {
		?>
<option value="<?php echo $row['supplierid']; ?>"
	<?php
		if ($row ['supplierid'] == $GLOBALS ['xSupplierNo']) {
			echo 'selected="selected"';
		}
		?>>
     <?php echo $row['suppliername']; ?> 
    </option>
<?php
	}
}
function DropDownStockPoint() {
	$result = mysql_query ( "SELECT *  FROM m_stockpoint where stockpointno!=0 order by stockpointname" );
	while ( $row = mysql_fetch_array ( $result ) ) {
		?>
<option value="<?php echo $row['stockpointno']; ?>"
	<?php
		if ($row ['stockpointno'] == $GLOBALS ['xStockPointNo']) {
			echo 'selected="selected"';
		}
		?>>
     <?php echo $row['stockpointname']; ?> 
    </option>
<?php
	}
}
function DropDownCategory() {
	$result = mysql_query ( "SELECT *  FROM m_itemcategory order by itemcategoryname" );
	while ( $row = mysql_fetch_array ( $result ) ) {
		?>
<option value="<?php echo $row['itemcategoryno']; ?>"
	<?php
		if ($row ['itemcategoryno'] == $GLOBALS ['xItemCategoryNo']) {
			echo 'selected="selected"';
		}
		?>>
     <?php echo $row['itemcategoryname']; ?> 
    </option>
<?php
	}
}
function DropDownGroup() {
	$result = mysql_query ( "SELECT *  FROM m_itemgroup order by itemgroupname" );
	while ( $row = mysql_fetch_array ( $result ) ) {
		?>
<option value="<?php echo $row['itemgroupno']; ?>"
	<?php
		if ($row ['itemgroupno'] == $GLOBALS ['xItemGroupNo']) {
			echo 'selected="selected"';
		}
		?>>
     <?php echo $row['itemgroupname']; ?> 
    </option>
<?php
	}
}
function DropDownSubGroup() {
	$result = mysql_query ( "SELECT *  FROM m_itemsubgroup order by itemsubgroupname" );
	while ( $row = mysql_fetch_array ( $result ) ) {
		?>
<option value="<?php echo $row['itemsubgroupno']; ?>"
	<?php
		if ($row ['itemsubgroupno'] == $GLOBALS ['xItemSubGroupNo']) {
			echo 'selected="selected"';
		}
		?>>
     <?php echo $row['itemsubgroupname']; ?> 
    </option>
<?php
	}
}
function DropDownItem() {
	$result = mysql_query ( "SELECT *  FROM m_item where stockpointno=31 order by itemname" );
	while ( $row = mysql_fetch_array ( $result ) ) {
		?>
<option value="<?php echo $row['itemno']; ?>"
	<?php
		if ($row ['itemno'] == $GLOBALS ['xItemNo']) {
			echo 'selected="selected"';
		}
		?>>
     <?php echo $row['itemname']; ?> 
    </option>
<?php
	}
}
function DropDownCustomer() {
	$result = mysql_query ( "SELECT *  FROM inv_customer order by customername" );
	while ( $row = mysql_fetch_array ( $result ) ) {
		?>
<option value="<?php echo $row['customerid']; ?>"
	<?php
		// if ($row['customerid']== $GLOBALS ['xCustomerId']){echo 'selected="selected"';}
		?>>
     <?php echo $row['customername']; ?> 
    </option>
<?php
	}
}
// Converting Currency Numbers to words currency format
function convert_number_to_words($number) {
	$hyphen = '-';
	$conjunction = ' and ';
	$separator = ', ';
	$negative = 'negative ';
	$decimal = ' and paise';
	$dictionary = array (
			0 => 'zero',
			1 => 'one',
			2 => 'two',
			3 => 'three',
			4 => 'four',
			5 => 'five',
			6 => 'six',
			7 => 'seven',
			8 => 'eight',
			9 => 'nine',
			10 => 'ten',
			11 => 'eleven',
			12 => 'twelve',
			13 => 'thirteen',
			14 => 'fourteen',
			15 => 'fifteen',
			16 => 'sixteen',
			17 => 'seventeen',
			18 => 'eighteen',
			19 => 'nineteen',
			20 => 'twenty',
			30 => 'thirty',
			40 => 'fourty',
			50 => 'fifty',
			60 => 'sixty',
			70 => 'seventy',
			80 => 'eighty',
			90 => 'ninety',
			100 => 'hundred',
			1000 => 'thousand',
			1000000 => 'million',
			1000000000 => 'billion',
			1000000000000 => 'trillion',
			1000000000000000 => 'quadrillion',
			1000000000000000000 => 'quintillion' 
	);
	
	if (! is_numeric ( $number )) {
		return false;
	}
	
	if (($number >= 0 && ( int ) $number < 0) || ( int ) $number < 0 - PHP_INT_MAX) {
		// overflow
		trigger_error ( 'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING );
		return false;
	}
	
	if ($number < 0) {
		return $negative . convert_number_to_words ( abs ( $number ) );
	}
	
	$string = $fraction = null;
	
	if (strpos ( $number, '.' ) !== false) {
		list ( $number, $fraction ) = explode ( '.', $number );
	}
	
	switch (true) {
		case $number < 21 :
			$string = $dictionary [$number];
			break;
		case $number < 100 :
			$tens = (( int ) ($number / 10)) * 10;
			$units = $number % 10;
			$string = $dictionary [$tens];
			if ($units) {
				$string .= $hyphen . $dictionary [$units];
			}
			break;
		case $number < 1000 :
			$hundreds = $number / 100;
			$remainder = $number % 100;
			$string = $dictionary [$hundreds] . ' ' . $dictionary [100];
			if ($remainder) {
				$string .= $conjunction . convert_number_to_words ( $remainder );
			}
			break;
		default :
			$baseUnit = pow ( 1000, floor ( log ( $number, 1000 ) ) );
			$numBaseUnits = ( int ) ($number / $baseUnit);
			$remainder = $number % $baseUnit;
			$string = convert_number_to_words ( $numBaseUnits ) . ' ' . $dictionary [$baseUnit];
			if ($remainder) {
				$string .= $remainder < 100 ? $conjunction : $separator;
				$string .= convert_number_to_words ( $remainder );
			}
			break;
	}
	
	if (null !== $fraction && is_numeric ( $fraction )) {
		$string .= $decimal;
		$words = array ();
		foreach ( str_split ( ( string ) $fraction ) as $number ) {
			$words [] = $dictionary [$number];
		}
		$string .= implode ( ' ', $words );
	}
	
	return $string;
}

?>