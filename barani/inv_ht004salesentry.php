<?php
include 'globalfile.php';
$xCurrentQty = 0;
$xTotalAmount = 0;
fn_DataClear ();
if (isset ( $_GET ['salesinvoiceno'] ) && ! empty ( $_GET ['salesinvoiceno'] )) {
	$no = $_GET ['salesinvoiceno'];
	if ($_GET ['xmode'] == 'edit') {
		$GLOBALS ['xMode'] = 'F';
		DataFetch ( $_GET ['salesinvoiceno'] );
	} else {
		global $con;
		$xQry = "DELETE FROM inv_sales WHERE salesinvoiceno= $no";
		mysqli_query ( $con, $xQry ) or die ( mysqli_error ( $con ) );
		header ( 'Location: inv_hr004salesentry.php' );
	}
} elseif (isset ( $_POST ['save'] )) {
	
	DataProcess ( "S" );
} elseif (isset ( $_POST ['update'] )) {
	DataProcess ( "U" );
} 
function fn_DataClear() {
	$GLOBALS ['xSalesInvoiceNo'] = '';
	$GLOBALS ['xQty'] = '';
	$GLOBALS ['xItemName'] = '';
	$GLOBALS ['xCustomerNo'] = '';
	
	$GLOBALS ['xDate'] = date ( 'Y-m-d' );
	$GLOBALS ['xUnitRate'] = '';
	$GLOBALS ['xAmount'] = '';
	$GLOBALS ['xGst'] = '';
	$GLOBALS ['xParticulars'] = '';
	$GLOBALS ['xPoNo']='';
	$GLOBALS ['xPrintBillNo'] = '';
	GetMaxIdNo ();
}
function GetMaxIdNo() {
	global $con;
	$xQry = "SELECT  CASE WHEN max(salesinvoiceno)IS NULL OR max(salesinvoiceno)= '' 
   THEN '1' 
   ELSE max(salesinvoiceno)+1 END AS salesinvoiceno
FROM inv_sales";
	
	$result = mysqli_query ( $con, $xQry ) or die ( mysqli_error ( $con ) );
	while ( $row = mysqli_fetch_array ( $result ) ) {
		$GLOBALS ['xSalesInvoiceNo'] = $row ['salesinvoiceno'];
	}
}
function DataFetch($xSalesInvoiceNo) {
	global $con;
	$xQry = "SELECT *  FROM inv_sales where salesinvoiceno=$xSalesInvoiceNo";
	$result = mysqli_query ( $con, $xQry ) or die ( mysqli_error ( $con ) );
	$count = mysqli_num_rows ( $result );
	if ($count > 0) {
		while ( $row = mysqli_fetch_array ( $result ) ) {
			$GLOBALS ['xSalesInvoiceNo'] = $row ['salesinvoiceno'];
			$GLOBALS ['xUnitRate'] = $row ['unitrate'];
			$GLOBALS ['xQty'] = $row ['qty'];
			$GLOBALS ['xEditQty'] = $row ['qty'];
			$GLOBALS ['xItemName'] = $row ['itemname'];
			$GLOBALS ['xDate'] = $row ['date'];
			$GLOBALS ['xParticulars'] = $row ['particulars'];
			$GLOBALS ['xPoNo'] = $row ['po_no'];
			$GLOBALS ['xAmount'] = $row ['totalamount'];
			$GLOBALS ['xGst'] = $row ['gst'];
			$GLOBALS ['xCustomerNo']=$row ['customerno'];
			$GLOBALS ['xPrintBillNo']=$row ['print_bill_no'];
		}
	}
}
function DataProcess($mode) {
	global $con;

	$xSalesInvoiceNo = $_POST ['f_salesinvoiceno'];
	$xDate = $_POST ['f_date'];
	$xCustomerNo = $_POST ['f_customerno'];
	$xItemName = $_POST ['f_itemname'];
	$xParticulars= $_POST ['f_particulars']; 
	$xPoNo= $_POST ['f_po_no']; 
	$xQty = $_POST ['f_qty'];
	$xUnitRate = $_POST ['f_unitrate'];
	$xGst = $_POST ['f_gst'];
	$xTotalAmount = $_POST ['f_totalamount'];
	$xPrintBillNo = $_POST ['f_print_billno'];
	
	$xQry = "";
	$xMsg = "";
	if ($mode == 'S') {
			$xQry = "INSERT INTO inv_sales
		(salesinvoiceno,date,customerno,itemname,particulars,qty,unitrate,gst,totalamount,po_no,print_bill_no)
		VALUES ($xSalesInvoiceNo,'$xDate','$xCustomerNo','$xItemName','$xParticulars',$xQty,$xUnitRate,
		$xGst,$xTotalAmount,'$xPoNo','$xPrintBillNo')";
		 
	} elseif ($mode == 'U') {
		$xQry = "UPDATE inv_sales   set date='$xDate',
		customerno=$xCustomerNo,itemname='$xItemName',
		particulars='$xParticulars',
		po_no='$xPoNo',
		qty=$xQty,unitrate=$xUnitRate,gst=$xGst,totalamount=$xTotalAmount,
		print_bill_no='$xPrintBillNo'
		 WHERE salesinvoiceno=$xSalesInvoiceNo";
	}
	global $con;
	$retval = mysqli_query ( $con, $xQry ) or die ( mysqli_error ( $con ) );
	GetMaxIdNo ();
}
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>INVOICE-ENTRY</title>
<head>

<script type="text/javascript">

function loaditemamount(str) {
document.getElementById('f_unitrate').value="0";
var xItemName=document.getElementById("f_itemname").value;

if (str=="") {
document.getElementById("f_unitrate").innerHTML="0";
return;
} 
if (window.XMLHttpRequest) {
// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
} else { // code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200) {
document.getElementById('f_unitrate').value=xmlhttp.responseText;
}
}

xmlhttp.open("GET","loaditemamount.php?itemname="+xItemName, true);
xmlhttp.send();
}



function validateForm() 
{
var xSalesInvoiceNo= document.forms["salesentryform"]["f_salesinvoiceno"].value;
var xCustomerNo= document.forms["salesentryform"]["f_customerno"].value;
var xItemName= document.forms["salesentryform"]["f_itemname"].value;
var xQty= document.forms["salesentryform"]["f_qty"].value;
var xUnitRate= document.forms["salesentryform"]["f_unitrate"].value;
var xTotalAmount= document.forms["salesentryform"]["f_totalamount"].value;

if (xSalesInvoiceNo== "") 
{
alert("Enter Sales Invoice No");
document.salesentryform.f_salesinvoiceno.focus();
return false;
}


if (xCustomerNo== "0") 
{
alert("Please Choose an Customer");
	document.salesentryform.f_customerno.focus();
return false;
}

if (xItemName== "0") 
{
alert("Please Choose an Item");
	document.salesentryform.f_itemname.focus();
return false;
}

if (xQty== "") 
{
alert("Enter Qty");
	document.salesentryform.f_qty.focus();
return false;
}


if (xUnitRate== "") 
{
alert("Enter Unit Rate");
	document.salesentryform.f_unitrate.focus();
return false;
}

if (xTotalAmount== "") 
{
alert("Total Amount Missing");
	document.salesentryform.f_qty.focus();
return false;
}
}
function calculatetotalamount() {
    document.getElementById("f_totalamount").value = "";
    var xQty = parseFloat(document.getElementById("f_qty").value);
    var xUnitRate = parseFloat(document.getElementById("f_unitrate").value);
    var xAmount = xQty * xUnitRate;
    document.getElementById("f_totalamount").value = Number((xAmount).toFixed(0));
}

</script>

</head>
<body onload='document.salesentryform.f_customerno.focus()'>

	<form class="form" name="salesentryform"
		action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="panel panel-primary border">
			<div class="panel-heading  text-center">
				<h3 class="panel-title">SALES-ENTRY</h3>
			</div>
			<div class="panel-body">


				<div class="row">
				<div class="col-xs-3">
					<label>InvNo:</label> <input type="text" class="form-control"
						value="<?php  echo $GLOBALS ['xSalesInvoiceNo'] ?>" readonly
						name="f_salesinvoiceno">
				</div>

				<div class="col-xs-3">
					<label>Date:</label> <input type="date" class="form-control"
						id="txtDate" name="f_date"
						value="<?php echo $GLOBALS ['xDate'];?>">

				</div>

				<div class="col-xs-6">
					<label>Customer  Name:</label> <select class="form-control"
						name="f_customerno">
						<option value="0">Choose Customer</option>
<?php
global $con;
$result = mysqli_query ( $con, "SELECT *  FROM inv_customer as i order by i.customerno" );
while ( $row = mysqli_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['customerno']; ?>"
							<?php
	if ($row ['customerno'] == $GLOBALS ['xCustomerNo']) {
		echo 'selected="selected"';
	}
	?>>
	
 <?php echo $row['customername']?> 
</option>
<?php
}
?>
</select>

				</div>
			
			</div>
			
			<div class="row">
			<div class="col-xs-4">
					<label>Item Name:</label> <select class="form-control"
						name="f_itemname" id="f_itemname" onclick="loaditemamount()" onblur="loaditemamount()">
						<option value="0">Choose Item</option>
<?php
global $con;
$result = mysqli_query ( $con, "SELECT *  FROM m_item as i order by i.itemname" );
while ( $row = mysqli_fetch_array ( $result ) ) {
	?>
<option value="<?php echo $row['itemname']; ?>"
							<?php
	if ($row ['itemname'] == $GLOBALS ['xItemName']) {
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
				
				<div class="col-xs-4">
					<label>Particulars:</label> <input type="text" class="form-control"
						value="<?php  echo $GLOBALS ['xParticulars'] ?>"
						name="f_particulars">
				</div>
				<div class="col-xs-2">
					<label>PoNo:</label> <input type="text" class="form-control"
						value="<?php  echo $GLOBALS ['xPoNo'] ?>"
						name="f_po_no">
				</div>
				<div class="col-xs-2">
					<label>PrintBillNo:</label> <input type="text" class="form-control"
						value="<?php  echo $GLOBALS ['xPrintBillNo'] ?>"
						name="f_print_billno">
				</div>
	
				
			</div>
			<div class="row">
			
			<div class="col-xs-3">
					<label>Qty:</label> <input type="text" class="form-control"
						name="f_qty" id="f_qty" value="<?php echo $GLOBALS ['xQty']; ?>"
						style="text-align: right;" onkeypress="return isNumberKey(event)" onblur="calculatetotalamount()"
						>
				</div>
			<div class="col-xs-3">
					<label>Unit Rate:</label> <input type="text" class="form-control"
						name="f_unitrate" id="f_unitrate" readonly
						value="<?php echo $GLOBALS ['xUnitRate']; ?>"
						onkeypress="return isNumberKey(event)">
				</div>
			
			<div class="col-xs-3">
				<label>Gst(%):</label>
				<!--<input type="text" class="form-control" name="f_vat" value="<?php echo $GLOBALS ['xGst']; ?>" style="text-align:right;">!-->
				<select class="form-control" name="f_gst">
					<option value="18"
						<?php if( $GLOBALS ['xGst']=="18") echo 'selected="selected"'; ?>>18%</option>

				</select>
			</div>

			<div class="col-xs-2">
				<label>Amount:</label> <input type="text" class="form-control"
					readonly name="f_totalamount" id="f_totalamount"
					value="<?php echo $GLOBALS ['xAmount']; ?>"
					onkeydown="javascript:if (event.which || event.keyCode){if ((event.which == 13) || (event.keyCode == 13)) {document.getElementById('save').click();}};">
			</div>
			
			
			

		</div>
		</div>
		</div>

		<div class="panel-footer clearfix">
			<div class="pull-right">
	  <?php if ($GLOBALS ['xMode'] == "") {  ?> 
		   <input type="submit" name="save" class="btn btn-primary" value="GENERATE BILL"
					id="save" onclick="return validateForm()" accesskey="s"> 
	   <?php } else{ ?>
		   <input type="submit" name="update" class="btn btn-primary"
					value="UPDATE" onclick="return validateForm()" accesskey="u"> 
	   <?php }  ?>
	</div>
		</div>
		
		</form>