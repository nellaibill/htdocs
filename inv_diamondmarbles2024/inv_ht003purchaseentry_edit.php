<?php
ob_start ();
include 'globalfile.php';
fn_DataClear ();
if (isset ( $_GET ['passpurchaseinvoiceno'] ) && ! empty ( $_GET ['passpurchaseinvoiceno'] )) {
	$xpurchaseinvoiceno = $_GET ['passpurchaseinvoiceno'];
	DataFetch ( $xpurchaseinvoiceno );
}

if (isset ( $_POST ['editpurchaseinvoiceno'] )) {
	$xpurchaseinvoiceno = $_POST ['f_purchaseinvoiceno'];
	DataFetch ( $xpurchaseinvoiceno );
	}
	
if (isset ( $_POST ['saveall'] )) {
	$xpurchaseinvoiceno = $_POST ['f_edtpurchaseinvoiceno'];
	$xsupplierNo = $_POST ['f_supplierno'];
	$xTotalAmount = $_POST ['f_totalAmount'];
	$xDate = $_POST ['f_date'];
	$xcompanyinvoiceno = $_POST ['f_companyinvoiceno'];
	$xfreight = $_POST ['f_freight'];
	$xothers = $_POST ['f_others'];
	
	$xQry = "update inv_purchaseentry1
	set supplierno=$xsupplierNo,date='$xDate',companyinvoiceno='$xcompanyinvoiceno',
	freight='$xfreight',others='$xothers'
	where  purchaseinvoiceno=$xpurchaseinvoiceno";
	mysql_query ( $xQry );
	//echo $xQry;
	header ( 'Location: inv_hr003_e_purchasebysupplier.php' );
}


$GLOBALS ['xCurrentDate'] = date ( 'Y-m-d H:i:s' );
function fn_DataClear() {
	$GLOBALS ['xpurchaseinvoiceno'] = '';
	$GLOBALS ['Editpurchaseinvoiceno'] = '';
	$GLOBALS ['xDate'] = '';
	$GLOBALS ['xsupplierNo'] = '';
	$GLOBALS ['xTotalAmount'] = '';
	$GLOBALS ['xcompanyinvoiceno'] = '';
	$GLOBALS ['xfreight'] = '';
	$GLOBALS ['xothers'] = '';
}
function DataFetch($xpurchaseinvoiceno) {
	$xQry = "SELECT *  FROM inv_purchaseentry1
	 where purchaseinvoiceno=$xpurchaseinvoiceno";
	$result = mysql_query ( $xQry ) or die ( mysql_error () );
	$count = mysql_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysql_fetch_array ( $result ) ) {
			$GLOBALS ['xpurchaseinvoiceno'] = $xpurchaseinvoiceno;
			$GLOBALS ['Editpurchaseinvoiceno'] = $xpurchaseinvoiceno;	
			$GLOBALS ['xDate'] = $row ['date'];
			$GLOBALS ['xsupplierNo'] = $row ['supplierno'];
			$GLOBALS ['xcompanyinvoiceno'] = $row ['companyinvoiceno'];
			$GLOBALS ['xfreight'] = $row ['freight'];
			$GLOBALS ['xothers'] = $row ['others'];
		}
	}
}

ob_end_flush ();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Purchase Edit</title>
</head>
<body onLoad="document.salesentryform_edit.f_itemno.focus()">

	<form class="form" name="salesentryform_edit"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

			<div class="panel-body">
		
		<div class="form-group">	<div class="col-xs-2" >
			<label>Pyrchase Invoice No:</label> </div><div class="col-xs-2" ><input type="text" class="form-control"
			 name="f_purchaseinvoiceno" value="<?php echo $GLOBALS ['xpurchaseinvoiceno'];?>">
		</div> 
		
		<input type="submit" name="editpurchaseinvoiceno" class="btn btn-primary "
					 value="EDIT" ></div>
					 
	</div>

				<div class="panel-body">
					<div class="col-xs-2"  >
			<label> No:</label> <input type="text" class="form-control"
			 name="f_edtpurchaseinvoiceno" value="<?php echo $GLOBALS ['Editpurchaseinvoiceno'];?>" readonly="readonly">
		</div>

		<div class="col-xs-2">


			<label>Supplier Name:</label> <select class="form-control"
				name="f_supplierno">
 <?php
	$result = mysql_query ( "SELECT *  FROM inv_supplier" );
	while ( $row = mysql_fetch_array ( $result ) ) {
		?>
<option value="<?php echo $row['supplierid']; ?>">
<?php echo $row['suppliername']; ?> </option>
 <?php } ?> 
 </select>
		</div>




		<div class="col-xs-2">
			<label>CompanyInvoiceNo</label> <input type="text"
				class="form-control" name="f_companyinvoiceno"
				value="<?php echo $GLOBALS ['xcompanyinvoiceno']; ?>">
		</div>



		<div class="col-xs-2" style="display: none;">
			<label>Total Amount</label> <input type="text" readonly
				class="form-control" name="f_totalAmount"
				value="<?php echo $xTotalAmount?>"
				value="<?php echo $GLOBALS ['xTotalAmount']; ?>">
		</div>
				<div class="col-xs-2">
			<label>Date:</label> <input type="date" class="form-control"
				id="txtDate" name="f_date" value="<?php echo $GLOBALS ['xDate'];?>"
				placeholder="">

		</div>
		
				<div class="col-xs-2">
			<label>Frieght</label> <input type="text" class="form-control"
				value="<?php echo $GLOBALS ['xfreight']; ?>" name="f_freight">
		</div>

		<div class="col-xs-2">
			<label>Others</label> <input type="text"
				class="form-control" name="f_others"
				value="<?php echo $GLOBALS ['xothers']; ?>">
		</div>
		
</div>
		<div class="panel-footer clearfix">
			<div class="pull-right">

				<input type="submit" name="saveall" class="btn btn-primary "
					accesskey="s" value="UPDATE" onclick="return validateForm()">

			</div>
		</div>

	</form>