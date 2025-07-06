<?php
ob_start ();
include 'globalfile.php';
$xPrintTemplate=$GLOBALS ['xPrintTemplate'];
fn_DataClear ();
if (isset ( $_GET ['passsalesinvoiceno'] ) && ! empty ( $_GET ['passsalesinvoiceno'] )) {
	$xSalesInvoiceNo = $_GET ['passsalesinvoiceno'];
	DataFetch ( $xSalesInvoiceNo );
}

if (isset ( $_POST ['editsalesinvoiceno'] )) {
	$xSalesInvoiceNo = $_POST ['f_salesinvoiceno'];
	DataFetch ( $xSalesInvoiceNo );
	}
	
if (isset ( $_POST ['saveall'] )) {
	$xSalesInvoiceNo = $_POST ['f_edtsalesinvoiceno'];
	$xCustomerNo = $_POST ['f_customerno'];
	$xTotalAmount = $_POST ['f_totalAmount'];
	$xLessAmount = 0;
	$xDate = $_POST ['f_date'];
	$xDespatch = $_POST ['f_despatch'];
	$xDestination = $_POST ['f_destination'];
	$xModeofPayment = $_POST ['f_modeofpayment'];
	$xTermsofDelivery = $_POST ['f_termsofdelivery'];
	$xVehicleNo = $_POST ['f_vehicleno'];
	$xServiceCharges = $_POST ['f_servicecharges'];
	
	$xQry = "update inv_salesentry1
	set customerno=$xCustomerNo,date='$xDate',despatch='$xDespatch',
	destination='$xDestination',modeofpayment='$xModeofPayment',
	termsofdelivery='$xTermsofDelivery',
	vehicleno='$xVehicleNo',servicecharges='$xServiceCharges'
	where  salesinvoiceno=$xSalesInvoiceNo";
	mysql_query ( $xQry );
	
	$xQry = "update inv_salesentry
	set customerno=$xCustomerNo,date='$xDate'
	where  salesinvoiceno=$xSalesInvoiceNo";
	mysql_query ( $xQry );
	
	
	echo "<meta http-equiv='refresh' content='0'>";
	$xPrintLink = "<script>window.open('$xPrintTemplate?salesinvoiceno=$xSalesInvoiceNo')</script>";
	echo $xPrintLink;
	if ($xPrintLink) {
		echo "<script>window.close();</script>";
	}
}


$GLOBALS ['xCurrentDate'] = date ( 'Y-m-d H:i:s' );
function fn_DataClear() {
	$GLOBALS ['xSalesInvoiceNo'] = '';
	$GLOBALS ['EditSalesInvoiceNo'] = '';
	$GLOBALS ['xDate'] = '';
	$GLOBALS ['xCustomerNo'] = '';
	$GLOBALS ['xTotalAmount'] = '';
	$GLOBALS ['xLessAmount'] = '';
	$GLOBALS ['xDespatch'] = '';
	$GLOBALS ['xDestination'] = '';
	$GLOBALS ['xModeofPayment'] = '';
	$GLOBALS ['xTermsofDelivery'] = '';
	$GLOBALS ['xVehicleNo'] = '';
	$GLOBALS ['xServiceCharges'] = '';
}
function DataFetch($xSalesInvoiceNo) {
	$xQry = "SELECT *  FROM inv_salesentry1 where salesinvoiceno=$xSalesInvoiceNo";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xSalesInvoiceNo'] = $xSalesInvoiceNo;
			$GLOBALS ['EditSalesInvoiceNo'] = $xSalesInvoiceNo;
			
			$GLOBALS ['xDate'] = $row ['date'];
			$GLOBALS ['xCustomerNo'] = $row ['customerno'];
			$GLOBALS ['xTotalAmount'] = $row ['totalamount'];
			$GLOBALS ['xLessAmount'] = $row ['lessamount'];
			$GLOBALS ['xDespatch'] = $row ['despatch'];
			$GLOBALS ['xDestination'] = $row ['destination'];
			$GLOBALS ['xModeofPayment'] = $row ['modeofpayment'];
			$GLOBALS ['xTermsofDelivery'] = $row ['termsofdelivery'];
			$GLOBALS ['xVehicleNo'] = $row ['vehicleno'];
			$GLOBALS ['xServiceCharges'] = $row ['servicecharges'];
		}
	}
}

ob_end_flush ();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SALES-ENTRY</title>
</head>
<body onLoad="document.salesentryform_edit.f_itemno.focus()">

	<form class="form" name="salesentryform_edit"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

			<div class="panel-body">
		
		<div class="form-group">	<div class="col-xs-2" >
			<label>Sales Invoice No:</label> </div><div class="col-xs-2" ><input type="text" class="form-control"
			 name="f_salesinvoiceno" value="<?php echo $GLOBALS ['xSalesInvoiceNo'];?>">
		</div> 
		
		<input type="submit" name="editsalesinvoiceno" class="btn btn-primary "
					 value="EDIT" ></div>
					 
	</div>

				<div class="panel-body">
					<div class="col-xs-2" >
			<label> No:</label> <input type="text" class="form-control"
			 name="f_edtsalesinvoiceno" value="<?php echo $GLOBALS ['EditSalesInvoiceNo'];?>" readonly="readonly">
		</div>
		<div class="col-xs-2">
			<label>Date:</label> <input type="date" class="form-control"
				id="txtDate" name="f_date" value="<?php echo $GLOBALS ['xDate'];?>"
				placeholder="">

		</div>
		<div class="col-xs-2">


			<label>Customer Name:</label> 		 <select
				class="form-control" name="f_customerno">
<?php
$result = mysql_query ( "SELECT *  FROM account_ledger 
		where ledger_undergroup_no=5 
		order by ledger_name" );
while ( $row = mysql_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['account_ledger_id']; ?>"
							<?php
	if ($row ['account_ledger_id'] == $GLOBALS ['xCustomerNo']) {
		echo 'selected="selected"';
	}
	?>>
	
 <?php echo $row['ledger_name']; ?> 
</option>
<?php
}

?>
</select>
		</div>


		<div class="col-xs-2" style="display: none;">
			<label>Less Amount:</label> <input type="number" class="form-control"
				value="0" name="f_lessamount">
		</div>


		<div class="col-xs-2">
			<label>Despatch Through</label> <input type="text"
				class="form-control" name="f_despatch"
				value="<?php echo $GLOBALS ['xDespatch']; ?>">
		</div>

		<div class="col-xs-2">
			<label>Destination</label> <input type="text" class="form-control"
				name="f_destination"
				value="<?php echo $GLOBALS ['xDestination']; ?>">
		</div>


		
			<div class="col-xs-2">
			<label>Mode of Payment</label> <select
				class="form-control" name="f_modeofpayment">
				<option value="Cash" <?php if($GLOBALS ['xModeofPayment']=="Cash") echo 'selected="selected"'; ?>>Cash</option>
    <option value="Credit" <?php if( $GLOBALS ['xModeofPayment']=="Credit") echo 'selected="selected"'; ?>>Credit</option>
    <option value="Cheque" <?php if( $GLOBALS ['xModeofPayment']=="Cheque") echo 'selected="selected"'; ?>>Cheque</option>
   
				</select>
		</div>
		
		<div class="col-xs-2">
			<label>Terms of Delivery</label> <input type="text"
				class="form-control" name="f_termsofdelivery"
				value="<?php echo $GLOBALS ['xTermsofDelivery']; ?>">
		</div>

		<div class="col-xs-2">
			<label>Vehicle No</label> <input type="text" class="form-control"
				value="<?php echo $GLOBALS ['xVehicleNo']; ?>" name="f_vehicleno">
		</div>

		<div class="col-xs-2">
			<label>Service Charges</label> <input type="text"
				class="form-control" name="f_servicecharges"
				value="<?php echo $GLOBALS ['xServiceCharges']; ?>">
		</div>

		<div class="col-xs-2" style="display: none;">
			<label>Total Amount</label> <input type="text" readonly
				class="form-control" name="f_totalAmount"
				value="<?php echo $xTotalAmount?>"
				value="<?php echo $GLOBALS ['xTotalAmount']; ?>">
		</div>
</div>
		<div class="panel-footer clearfix">
			<div class="pull-right">

				<input type="submit" name="saveall" class="btn btn-primary "
					accesskey="s" value="UPDATE" onclick="return validateForm()">

			</div>
		</div>

	</form>