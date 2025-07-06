<?php
ob_start ();
include 'globalfile.php';
fn_DataClear ();
$xCurrentQty = 0;
getconfig_inventoryvalues ();
$xPurchaseInvoiceNo = $GLOBALS ['xPurchaseInvoiceNo'];
fn_DataFetchPurchaseDetails($xPurchaseInvoiceNo);
$GLOBALS ['xCurrentDate'] = date ( 'Y-m-d' );
$GLOBALS ['xDateRecieved'] = $GLOBALS ['xCurrentDate'];
$GLOBALS ['xDateExpired'] = date ( 'Y-m-d', strtotime ( '+1 years' ) );
$GLOBALS ['xDateExpired'] = date ( 'Y-m-d', strtotime ( '+1 years' ) );
if (isset ( $_GET ['passpurchaseinvoiceno'] ) && ! empty ( $_GET ['passpurchaseinvoiceno'] )) {
	$xPassPurchaseInvoiceNo = $_GET ['passpurchaseinvoiceno'];
	mysql_query ( "update config_inventory set
	purchase_invoice_no=$xPassPurchaseInvoiceNo" ) or die ( mysql_error () );
	getconfig_inventoryvalues ();
	fn_DataFetchPurchaseDetails ( $xPassPurchaseInvoiceNo );
}
if (isset ( $_GET ['txno'] ) && ! empty ( $_GET ['txno'] )) {
	$no = $_GET ['txno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['txno'] );
	} else {
		$xQry = "DELETE FROM inv_purchaseentry WHERE txno= $no";
		mysql_query ( $xQry );
		fn_TempPurchaseQty ( 0 );
		UpdateStockValues ( - $_GET ['passqty'], 
				$_GET ['passitemno'], 
				'' ,
				$_GET ['passmrp'], 
				$_GET ['passbatch'], 
				$_GET ['passexpiry']);
		header ( 'Location: inv_ht003purchaseentry_full_edit.php' );
	}
} elseif (isset ( $_POST ['additemtopurchase'] )) {
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
} elseif (isset ( $_POST ['saveall'] )) {
	$xSupplierNo = $_POST ['f_supplierno'];
	if (empty ( $_POST ['f_companyinvoiceno'] )) {
		$xCompanyInvoiceNo = "";
	} else {
		$xCompanyInvoiceNo = $_POST ['f_companyinvoiceno'];
	}
	$xPurchaseInvoiceNo = $_POST ['f_purchaseinvoiceno'];
	$xDate = $_POST ['f_dateOfPurchase'];
	$xTotalAmount = $_POST ['f_totalamount'];
	$xFrieght = $_POST ['f_frieght'];
	$xOthers = $_POST ['f_others'];
	$xQ1 = mysql_query ( "update inv_purchaseentry1 set 
	supplierno=$xSupplierNo,
	companyinvoiceno='$xCompanyInvoiceNo',
	totalamount=$xTotalAmount,
	date='$xDate',
	freight=$xFrieght,
	others=$xOthers where purchaseinvoiceno=$xPurchaseInvoiceNo" );
	
	$xQ2 = mysql_query ( "update config_inventory set
			purchase_invoice_no=0" ) or die ( mysql_error () );
	
	if ($xQ1 and $xQ2) {
		mysql_query ( "COMMIT" );
	} else {
		mysql_query ( "ROLLBACK" );
	}
	
	if ($result == TRUE) {
		echo '<script type="text/javascript">alert("Purchase Details Stored");</script>';
		echo "<meta http-equiv='refresh' content='0'>";
		echo "<meta http-equiv='refresh' content='0'>";
	}
} else {
	GetMaxIdNo ();
}
function fn_DataClear() {
	$GLOBALS ['xTxno'] = '';
	$GLOBALS ['xPurchaseInvoiceNo'] = '';
	$GLOBALS ['xDate'] = '';
	$GLOBALS ['xItemNo'] = '';
	$GLOBALS ['xPurchaseDescription'] = '';
	$GLOBALS ['xDateOfPurchase'] = '';
	$GLOBALS ['xDateExpired'] = '';
	$GLOBALS ['xBatchId'] = '123';
	$GLOBALS ['xQty'] = '';
	$GLOBALS ['xFreeQty'] = '';
	$GLOBALS ['xOriginalPrice'] = '';
	$GLOBALS ['xSellingPrice'] = '';
	$GLOBALS ['xDiscount'] = 0;
	$GLOBALS ['xVat'] = '';
	$GLOBALS ['xProfit'] = '';
	$GLOBALS ['xTotal'] = '';
}
function GetMaxIdNo() {
/* 	$xQry = "SELECT  CASE WHEN max(purchaseinvoiceno)IS NULL OR max(purchaseinvoiceno)= '' THEN '1' 
					ELSE max(purchaseinvoiceno)+1 END AS purchaseinvoiceno FROM inv_purchaseentry1";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xPurchaseInvoiceNo'] = $row ['purchaseinvoiceno'];
		$xPurchaseInvoiceNo = $GLOBALS ['xPurchaseInvoiceNo'] + 1;
	}
	GetMaxTxNo (); */
	getconfig_inventoryvalues ();	
	$xPurchaseInvoiceNo = $GLOBALS ['xPurchaseInvoiceNo'];
	fn_DataFetchPurchaseDetails($xPurchaseInvoiceNo);
	GetMaxTxNo ();
}
function GetMaxTxNo() {
	$xQry = "SELECT  CASE WHEN max(txno)IS NULL OR max(txno)= '' 
   THEN '1' ELSE max(txno)+1 END AS txno FROM inv_purchaseentry";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xTxno'] = $row ['txno'];
	}
}
function fn_PurchaseCount() {
	$xPurchaseInvoiceNo = $GLOBALS ['xPurchaseInvoiceNo'];
	$result = mysql_query ( "SELECT *  FROM inv_purchaseentry where purchaseinvoiceno=" . $xPurchaseInvoiceNo ) or die ( mysql_error () );
	$GLOBALS ['xPurchaseCount'] = mysql_num_rows ( $result );
}

function fn_DataFetchPurchaseDetails($xPurchaseInvoiceNo) {
	$result = mysql_query ( "SELECT *  FROM inv_purchaseentry1 where purchaseinvoiceno=$xPurchaseInvoiceNo" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
				
			$GLOBALS ['companyinvoiceno'] = $row ['companyinvoiceno'];
			$GLOBALS ['totalamount'] = $row ['totalamount'];
			$GLOBALS ['date'] = $row ['date'];
			$GLOBALS ['freight'] = $row ['freight'];
			$GLOBALS ['others'] = $row ['others'];
			$GLOBALS ['xSupplierNoEdit'] = $row ['supplierno'];
		}
	}
}
function fn_GetBatch($xItemNo, $xBatch) {
	$xQry = "SELECT *  FROM inv_stockentry where itemno=" . $xItemNo . " 
			and batch='" . $xBatch . "'";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	$GLOBALS ['xItemBatchCount'] = mysql_num_rows ( $result );
}
function DataFetch($xTxno) {
	$result = mysql_query ( "SELECT *  FROM inv_purchaseentry where txno=$xTxno" ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xTxno'] = $row ['txno'];
			$GLOBALS ['xPurchaseInvoiceNo'] = $row ['purchaseinvoiceno'];
			// $GLOBALS ['xDate'] = $row ['date'];
			$GLOBALS ['xItemNo'] = $row ['itemno'];
			$GLOBALS ['xPurchaseDescription'] = $row ['purchasedescription'];
			finditemname ( $row ['itemno'] );
			$xPackNo = $GLOBALS ['xPackNo'];
			// $GLOBALS ['xDateRecieved'] = $row ['daterecieved'];
			$GLOBALS ['xDateExpired'] = $row ['dateexpired'];
			
			$GLOBALS ['xBatchId'] = $row ['batchid'];
			$GLOBALS ['xQty'] = $row ['qty'] / $xPackNo;
			$GLOBALS ['xFreeQty'] = $row ['freeqty'];
			$GLOBALS ['xOriginalPrice'] = $row ['originalprice'] * $xPackNo;
			$GLOBALS ['xSellingPrice'] = $row ['sellingprice'] * $xPackNo;
			$GLOBALS ['xDiscount'] = $row ['discount'];
			$GLOBALS ['xVat'] = $row ['vat'];
			$GLOBALS ['xProfit'] = $row ['profit'];
			$GLOBALS ['xTotal'] = $row ['total'];
			fn_TempPurchaseQty ( $row ['qty'] );
		}
	}
}
function DataProcess($mode) {
	$xVat = 0;
	$xTxno = $_POST ['f_txno'];
	$xPurchaseInvoiceNo = $_POST ['f_purchaseinvoiceno'];
	$xItemNo = $_POST ['f_itemno'];
	$xPurchaseDescription = $_POST ['f_purchasedescription'];
	
	finditemname ( $xItemNo );
	$xPackNo = $GLOBALS ['xPackNo'];
	$xPackDescription = $GLOBALS ['xPackDescription'];
	$xExpiredDate = $_POST ['f_dateexpired'];
	if (empty ( $_POST ['f_batchid'] )) {
		$xBatchId = "";
	} else {
		$xBatchId = $_POST ['f_batchid'];
	}
	$xQty = $_POST ['f_qty'] * $xPackNo;
	if (empty ( $_POST ['f_freeqty'] )) {
		$xFreeQty = 0;
	} else {
		$xFreeQty = $_POST ['f_freeqty'];
	}
	$xOriginalPrice = $_POST ['f_originalprice'] / $xPackNo;
	$xSellingPrice = $_POST ['f_sellingprice'] / $xPackNo;
	if (empty ( $_POST ['f_discount'] )) {
		$xDiscount = 0;
	} else {
		$xDiscount = $_POST ['f_discount'];
	}
	if (empty ( $_POST ['f_gst'] )) {
		$xVat = "";
	} else {
		$xVat = ($_POST ['f_gst']);
	}
	
	$xUnitTotalforOp = $xQty * $xOriginalPrice;
	$xTotalAfterDiscountforOp = $xUnitTotalforOp - ($xDiscount / 100 * $xUnitTotalforOp);
	$xTotal = $xTotalAfterDiscountforOp + ($xVat / 100 * $xTotalAfterDiscountforOp);
	
	$xUnitTotalforSp = $xQty * $xSellingPrice;
	$xTotalAfterDiscountforSp = $xUnitTotalforSp - ($xDiscount / 100 * $xUnitTotalforSp);
	$xNetTotal = $xTotalAfterDiscountforSp + ($xVat / 100 * $xTotalAfterDiscountforSp);
	
	// $xTotal = ((($xQty + $xFreeQty) * $xOriginalPrice) - $xDiscount / 100 * (($xQty + $xFreeQty) * $xOriginalPrice)) + $xVat / 100 * (($xQty + $xFreeQty) * $xOriginalPrice);
	// $xNetTotal = ((($xQty + $xFreeQty) * $xSellingPrice) - $xDiscount / 100 * (($xQty + $xFreeQty) * $xSellingPrice)) + $xVat / 100 * (($xQty + $xFreeQty) * $xSellingPrice);
	
	$xProfit = $xNetTotal - $xTotal;
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
		$xQry = "INSERT INTO inv_purchaseentry 
		(txno,purchaseinvoiceno,itemno,purchasedescription,dateexpired,batchid,qty,
		freeqty,currentqty,originalprice,sellingprice,discount,vat,total,nettotal,profit) 
		VALUES ($xTxno,$xPurchaseInvoiceNo,$xItemNo,'$xPurchaseDescription',
		'$xExpiredDate','$xBatchId',$xQty,$xFreeQty,$xQty,$xOriginalPrice,$xSellingPrice,$xDiscount,
		'$xVat',$xTotal,$xNetTotal,$xProfit)";
		$retval = mysql_query ( $xQry ) or die ( mysql_error () );
		//echo $xQry;
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		} else {
			$xMsg = "Inserted";
			fn_TempPurchaseQty ( 0 );
			UpdateStockValues ( $xQty, $xItemNo, '', $xSellingPrice, $xBatchId, $xExpiredDate );
		}
	} elseif ($mode == 'U') {
		$xQry = "UPDATE inv_purchaseentry   
		set itemno=$xItemNo,
		dateexpired='$xExpiredDate',batchid='$xBatchId',qty=$xQty,
		freeqty=$xFreeQty,currentqty=$xQty,originalprice=$xOriginalPrice,
		sellingprice=$xSellingPrice,discount=$xDiscount,vat='$xVat',
		total=$xTotal,nettotal=$xNetTotal,profit=$xProfit WHERE txno=$xTxno";
		$xMsg = "Updated";
		// echo $xQry;
		$retval = mysql_query ( $xQry ) or die ( mysql_error () );
		if (! $retval) {
			die ( 'Could not enter data: ' . mysql_error () );
		} else {
			UpdateStockValues ( $xQty, $xItemNo, 'F', $xSellingPrice, $xBatchId, $xExpiredDate );
		}
	}
	
	//header ( 'Location: inv_ht003purchaseentry_full_edit.php' );
	//GetMaxIdNo ();
}
function fn_TempPurchaseQty($xTempPurQty) {
	$xQry = "update config_inventory set temppurchaseqty=$xTempPurQty";
	mysql_query ( $xQry ) or die ( mysql_error () );
}
function GetMaxStockEntry() {
	$sql = "SELECT  CASE WHEN max(stockno)IS NULL OR max(stockno)= ''
   THEN '1'
   ELSE max(stockno)+1 END AS stockno
FROM inv_stockentry";
	$result = mysql_query ( $sql ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		$GLOBALS ['xStockNo'] = $row ['stockno'];
	}
}
function UpdateStockValues($xCurrentQty, $xCurrentItemNo, $mode, $xCurrentMrp, $xCurrentBatch, $xCurrentExpiryDate) {
	fn_GetBatch ( $xCurrentItemNo, $xCurrentBatch );
	$xItemBatchCount = $GLOBALS ['xItemBatchCount'];
	GetMaxStockEntry ();
	$xStockNo = $GLOBALS ['xStockNo'];
	if ($xItemBatchCount <= 0) {
		$xQry = "insert into inv_stockentry (stockno,itemno,stock,mrp,batch,expdate)
				values($xStockNo,$xCurrentItemNo,
		$xCurrentQty,$xCurrentMrp,'$xCurrentBatch','$xCurrentExpiryDate')";
		mysql_query ( $xQry ) or die ( mysql_error () );
	}
	else {
		if ($mode == "") {
			$xTempPurchaseQty = 0;
			$xQry = "update inv_stockentry set 
			stock=stock+($xCurrentQty)-$xTempPurchaseQty,
			mrp=$xCurrentMrp
			where itemno=$xCurrentItemNo and batch='$xCurrentBatch'";
			mysql_query ( $xQry ) or die ( mysql_error () );
		} else {
			$xTempPurchaseQty = $GLOBALS ['xTempPurchaseQty'];
			$xQry = "update inv_stockentry 
			set stock=stock+($xCurrentQty)-$xTempPurchaseQty,
			mrp=$xCurrentMrp
			where itemno=$xCurrentItemNo and batch='$xCurrentBatch'";
			mysql_query ( $xQry ) or die ( mysql_error () );
		}
	}
	
	//echo $xQry;
	fn_TempPurchaseQty ( 0 );
}
ob_end_flush ();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PURCHASE-ENTRY</title>
</head>
<script type="text/javascript">
function GetGst() {
	document.getElementById('f_gst').value="";
	var xItemNo=document.getElementById("f_itemno").value;

	if (window.XMLHttpRequest) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
	} else { // code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function() {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	document.getElementById('f_gst').value=xmlhttp.responseText;
	GetMrp();
	}
	}
	xmlhttp.open("GET","getgst.php?itemno="+xItemNo, true);
	xmlhttp.send();
	}
	
function calculatediscountPercentage() {
	var xQty= document.forms["purchaseentryform"]["f_qty"].value;
	var xOriginalPrice= document.forms["purchaseentryform"]["f_originalprice"].value;
    var xDiscountValue = parseInt(document.getElementById("f_discountvalue").value);
    var xDiscountPercentage = (xDiscountValue/(xQty*xOriginalPrice)*100);

    document.getElementById("f_discount").value = xDiscountPercentage.toFixed(2);
}
function calcultediscountvalue() {
	var xQty= document.forms["purchaseentryform"]["f_qty"].value;
	var xOriginalPrice= document.forms["purchaseentryform"]["f_originalprice"].value;
    var xDiscountPercentage = parseInt(document.getElementById("f_discount").value);
    var xDiscountValue  = xQty*xOriginalPrice* (xDiscountPercentage/100);

    document.getElementById("f_discountvalue").value = xDiscountValue.toFixed(2);
}
function calculateothercharges() {
	var xOthers= document.forms["purchaseentryform"]["f_others"].value;
	var xTotalAmount= document.forms["purchaseentryform"]["f_totalamount"].value;

	var xPayoutAmount=xTotalAmount-xOthers;
    document.getElementById("f_totalamount").value = xPayoutAmount;
}
function validateFormsaveall() 
{
var xCompanyInvoiceNo= document.forms["purchaseentryform"]["f_companyinvoiceno"].value;
if (xCompanyInvoiceNo== null || xCompanyInvoiceNo== "0") 
{
	alert("Company Invoice No to be Filled");
	document.purchaseentryform.f_companyinvoiceno.focus();
	return false;
}
}
function validateForm() 
{
var xItemNo= document.forms["purchaseentryform"]["f_itemno"].value;
var xQty= document.forms["purchaseentryform"]["f_qty"].value;
var xOriginalPrice= document.forms["purchaseentryform"]["f_originalprice"].value;
var xSellingPrice= document.forms["purchaseentryform"]["f_sellingprice"].value;

if (xItemNo== null || xItemNo== "0") 
{
	alert("Item Name to be Filled");
	document.purchaseentryform.f_itemno.focus();
	return false;
}

if (xQty== null || xQty== "") 
{
	alert("Qty Not Filled");
	document.purchaseentryform.f_qty.focus();
	return false;
}
if (xOriginalPrice== null || xOriginalPrice== "") 
{
	alert("Original Price Not Filled");
	document.purchaseentryform.f_originalprice.focus();
	return false;
}

	if (xSellingPrice== null || xSellingPrice== "") 
{
	alert("Selling Price Not Filled");
	document.purchaseentryform.f_sellingprice.focus();
	return false;
}

}

</script>

<body onload='document.purchaseentryform.f_itemno.focus()'>
	<form class="form" name="purchaseentryform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-primary">
			<div class="panel-heading  text-center">
				<h3 class="panel-title">PURCHASE-ENTRY</h3>
			</div>
			<div class="panel-body">

				<div class="col-xs-2" style="display: none;">
					<label>Tx.No :</label> <input type="text" class="form-control"
						name="f_txno" value="<?php echo $GLOBALS ['xTxno']; ?>" readonly>
				</div>

				<div class="col-xs-2">
					<label>Inv-No :</label> <input type="text" class="form-control"
						name="f_purchaseinvoiceno"
						value="<?php echo $GLOBALS ['xPurchaseInvoiceNo']; ?>" readonly>
				</div>


				<div class="col-xs-4">
					<label>Item Name:</label> <select class="form-control"
						name="f_itemno" id="f_itemno" onblur="GetGst()"
						onchange="GetGst()">
						<option value="0">Choose Item</option>
<?php
$result = mysql_query ( "SELECT *  FROM m_item as i order by i.itemname" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['itemno']; ?>"
							<?php
	if ($row ['itemno'] == $GLOBALS ['xItemNo']) {
		echo 'selected="selected"';
	}
	?>>
 <?php echo $row['itemname']?> 
</option>
<?php
}
?>
</select>

				</div>


				<div class="col-xs-3" style="display: none;">
					<label>Imei:</label> <input type="text" class="form-control"
						name="f_purchasedescription"
						value="<?php echo $GLOBALS ['xPurchaseDescription']; ?>">
				</div>


				<div class="col-xs-3">
					<label>BatchId:</label> <input type="text" class="form-control"
						name="f_batchid" value="<?php echo $GLOBALS ['xBatchId']; ?>">
				</div>

				<div class="col-xs-2" style="display: none;">
					<label>Expiry-Date:</label> <input type="date" class="form-control"
						name="f_dateexpired"
						value="<?php echo $GLOBALS ['xDateExpired']; ?>">
				</div>

				<div class="col-xs-2 has-warning">
					<label>Qty:</label> <input type="number" class="form-control"
						name="f_qty" value="<?php echo $GLOBALS ['xQty']; ?>"
						style="text-align: right;">
				</div>


				<div class="col-xs-2 has-warning" style="display: none">
					<label>FreeQty:</label> <input type="number" class="form-control"
						name="f_freeqty" value="<?php echo $GLOBALS ['xFreeQty']; ?>"
						style="text-align: right;">
				</div>



				<div class="col-xs-2 has-warning">
					<label>Purchase Rate:</label> <input type="text"
						class="form-control" name="f_originalprice"
						value="<?php echo $GLOBALS ['xOriginalPrice']; ?>"
						style="text-align: right;"
						onkeypress="return restrictCharacters(this, event, integerOnly);">
				</div>



				<div class="col-xs-2 has-warning">
					<label>MRP:</label> <input type="text" class="form-control"
						name="f_sellingprice"
						value="<?php echo $GLOBALS ['xSellingPrice']; ?>"
						style="text-align: right;"
						onkeypress="return restrictCharacters(this, event, integerOnly);">
				</div>

				<div class="col-xs-2 has-warning">
					<label>Dis:(%)</label> <input type="text" class="form-control"
						name="f_discount" id="f_discount" onblur="calcultediscountvalue()"
						value="<?php echo $GLOBALS ['xDiscount']; ?>"
						style="text-align: right;"
						onkeypress="return restrictCharacters(this, event, integerOnly);">
				</div>
				<div class="col-xs-2 has-warning">
					<label>DisValue:</label> <input type="text" class="form-control"
						name="f_discountvalue" id="f_discountvalue"
						onblur="calculatediscountPercentage()">
				</div>

				<div class="col-xs-2">
					<label>Gst(%):</label> <input type="text" class="form-control"
						name="f_gst" id="f_gst" value="<?php echo $GLOBALS ['xVat']; ?>"
						style="text-align: right;">
				</div>


			</div>

			<div class="pull-right ">
	  <?php if ($GLOBALS ['xMode'] == "") {  ?> 
		   <input type="submit" name="additemtopurchase"
					class="btn btn-danger" value="ADD MORE" id="additemtopurchase"
					onclick="return validateForm()" accesskey="a"> 
	   <?php } else{ ?>
		   <input type="submit" name="update" class="btn btn-primary"
					id="additemtopurchase" value="UPDATE"
					onclick="return validateForm()" accesskey="a"> 
	   <?php }  ?>
	</div>
		</div>


<?php
fn_PurchaseCount ();
$xCount = $GLOBALS ['xPurchaseCount'];
if ($xCount > 0) {
	?>
			<table border="1">
			<thead>
				<tr>
					<th width="5%">S.NO</th>
					<th width="25%">ItemName</th>
					<th width="5%">Qty</th>
					<th width="5%">Price</th>
					<th width="5%">UnitTotal</th>
					<th width="5%">Dis %</th>
					<th width="5%">Dis Value</th>
					<th width="5%">Total After Discount</th>
					<th width="5%">GST%</th>
					<th width="10%">GST Value</th>

					<th width="10%">Total</th>
					<th colspan="2" width="5%">ACTIONS</th>
				</tr>
			</thead>
			<tbody>	
<?php
	$xSlNo = 0;
	$xGrandVat = 0;
	$xGrandDiscount = 0;
	$xGrandTotal = 0;
	$xGrandNetAmount = 0;
	$xGrandProfit = 0;
	$xGrandGstValue = 0;
	$xGrandDiscountValue = 0;
	$xGrandOriginalPrice = 0;
	$xQry = "SELECT *  from inv_purchaseentry where purchaseinvoiceno=$xPurchaseInvoiceNo;";
	$result2 = mysql_query ( $xQry );
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		?>
	<tr>
	<?php
		finditemname ( $row ['itemno'] );
		echo '<td>' . $xSlNo . '</td>';
		echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
		$xQty = $row ['qty'];
		$xOriginalPrice = $row ['originalprice'];
		$xUnitTotal = $xQty * $xOriginalPrice;
		$xDiscount = $row ['discount'];
		$xDiscountValue = $xQty * $xOriginalPrice * ($xDiscount / 100);
		$xTotalAfterDiscount = $xUnitTotal - $xDiscountValue;
		$xGst = $row ['vat'];
		$xGstValue = $xTotalAfterDiscount * ($xGst / 100);
		
		$xGrandGstValue += $xGstValue;
		$xGrandDiscountValue += $xDiscountValue;
		$xGrandOriginalPrice += $xOriginalPrice;
		$xTotal = $xTotalAfterDiscount + $xGstValue;
		
		echo '<td>' . $row ['qty'] . '</td>';
		echo '<td align=right>' . $row ['originalprice'] . '</td>';
		echo '<td align=right>' . $xUnitTotal . '</td>';
		echo '<td align=right>' . $row ['discount'] . " %" . '</td>';
		echo '<td align=right>' . $xDiscountValue . '</td>';
		echo '<td align=right>' . $xTotalAfterDiscount . '</td>';
		echo '<td align=right>' . $row ['vat'] . " %" . '</td>';
		echo '<td align=right>' . $xGstValue . '</td>';
		echo '<td align=right>' . $xTotal . '</td>';
		$xGrandTotal += $xTotal;
		
		?>
<td><a
						href="inv_ht003purchaseentry_full_edit.php<?php echo '?txno='.$row['txno'] . '&xmode=edit'; ?>"
						onclick="return confirm_edit()"> <img src="images/edit.png"
							style="width: 30px; height: 30px; border: 0">
					</a></td>
							<td><a
						href="inv_ht003purchaseentry_full_edit.php<?php echo '?txno='.$row['txno']. '
		&xmode=delete &passqty='.$row['qty']. ' 
		&passitemno='.$row['itemno']. ' 
		&passmrp='.$row['sellingprice']. ' 
		&passbatch='.$row['batchid']. ' 
		&passexpiry	='.$row['dateexpired']  ?>"
						onclick="return confirm_delete()"> 
						<img src="images/delete.png"
							 style="width: 30px; height: 30px; border: 0">
					</a></td>
<?php
		echo '</tr>';
	}
	echo '<tr>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	
	echo '<td  align=right>' . fn_RupeeFormat ( $xGrandDiscountValue ) . '</td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td  align=right>' . fn_RupeeFormat ( $xGrandGstValue ) . '</td>';
	echo '<td  align=right>' . fn_RupeeFormat ( $xGrandTotal ) . '</td>';
	
	echo '</tr>';
	
	?>
				
	</tbody>
		</table>


		<hr>

		<div class="panel panel-primary">

			<div class="panel-body">
				<div class="col-xs-3">
					<label>Date of Purchase</label> <input type="date"
						class="form-control" name="f_dateOfPurchase"
						value="<?php echo $GLOBALS ['date']; ?>"> <label>Supplier
						Name</label> <select class="form-control" name="f_supplierno">
<?php
	$result = mysql_query ( "SELECT *  FROM account_ledger 
		where ledger_undergroup_no=4 
		order by ledger_name" );
	while ( $row = mysql_fetch_array ( $result ) ) {
		?>
<option value="<?php echo $row['account_ledger_id']; ?>"
							<?php
		if ($row ['account_ledger_id'] == $GLOBALS ['xSupplierNoEdit']) {
			echo 'selected="selected"';
		}
		?>>
	
 <?php echo $row['ledger_name']; ?> 
</option>
<?php
	}
	
	?>
</select> <font color="red"><a href="inv_hm001supplier_mini.php"
						class="form-control" accesskey="2"
						onclick="basicPopup(this.href);return false">New Supplier</a></font>
					<label>Company Invoice No:</label> <input type="text"
						class="form-control" name="f_companyinvoiceno" value="<?php echo $GLOBALS ['companyinvoiceno']; ?>">

				</div>

				<div class="col-xs-3">
					<label>Frieght Charges</label> <input type="text"
						class="form-control" 
						name="f_frieght" id="f_frieght"
						 value="<?php echo $GLOBALS ['freight']; ?>"> 
						 
						 <label>OtherCharges:</label> 
						<input type="text" class="form-control"
						name="f_others" id="f_others" 
						value="<?php echo $GLOBALS ['others']; ?>"> <label>Total Amount:</label>
					<input type="text" class="form-control" readonly
						name="f_totalamount" id="f_totalamount"
						value="<?php echo $xGrandTotal;?>" >
				</div>
				<div class="col-xs-3">
					<h1> Rs <?php  echo fn_RupeeFormat ( $xGrandTotal );?> </h1>
					<input type="submit" name="saveall" class="btn btn-primary"
						value="SAVE" id="saveall" onclick="return validateFormsaveall()"
						accesskey="s">
				</div>



			</div>
		</div>
<?php }?>
	</form>
</body>
</html>