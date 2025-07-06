
<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
$GLOBALS ['xDatePEnt1'] = '';
?>
<title>Prescription </title>
<link href="bootstrap.css" rel="stylesheet">
<style type="text/css">
table {
    border-collapse: collapse;
    font-size: 14px;
}

  hr{
    padding: 0px;
    margin: 0px;    
  }
</style>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div class="panel panel-success">
		<div class="panel-heading text-center">
			FILTER[GROUP]
			<div class="btn-group pull-right">
				<input type="submit" name="save" class="btn btn-primary"
					value="VIEW">
			</div>

		</div>
		<div class="panel-body">
			<div class="form-group">


				<div class="col-xs-4">
					<label>From Date:</label> <input type="date" class="form-control"
						name="f_fromdate" value="<?php echo $GLOBALS ['xInvFromDate']; ?>">
				</div>

				<div class="col-xs-4">
					<label>To Date:</label> <input type="date" class="form-control"
						name="f_todate" value="<?php echo $GLOBALS ['xInvToDate']; ?>">
				</div>


			</div>
			<!-- Form-Group !-->
		</div>
		<!-- Panel Body !-->
	</div>
	<!-- Panel !-->
</form>

<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
	<div class="panel panel-primary">
		<div class="panel-heading  text-center">
			<b><?php echo "Prescription Register  From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>

		</div>
		<div class="panel-body">

			<div class="container">
				<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
				<table class="table table-striped  table-bordered "
					data-responsive="table" border="0" width="100%">
					<thead>
						<tr>
							<th width="5%">Sl.No</th>
							<th width="5%">Date</th>
							<th width="5%">BillNo</th>
							
							<th width="5%">Doctor</th>
							<th width="10%">PatientName</th>
							<th width="10%">Status</th>
							<th width="20%">Medicine</th>
							<th width="10%">Qty</th>
							<th width="10%">Batch</th>
							<th width="10%">ExpDate</th>
							<th width="10%">BillBy</th>
							<th width="10%">Sign</th>
						</tr>
					</thead>

					<tbody>

<?php
function GetSalesEntry1Details($xSalesInvoiceNo) {
	$result = mysql_query ( "SELECT *  FROM inv_salesentry1
			 where salesinvoiceno=" . $xSalesInvoiceNo ) or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
		findcustomername ( $row ['customerno'] );
		$GLOBALS ['xDateSEnt1'] = $row ['date'];
		$GLOBALS ['xStatusSEnt1'] = $row ['termsofdelivery'];
		$GLOBALS ['xBillBySEnt1'] = $row ['servicecharges'];
	}
}
function checkSalesEntriesAvailable($xSalesInvoiceNo, $xFrom, $xTo) {
	$result = mysql_query ( "SELECT *  FROM inv_salesentry1
			where salesinvoiceno=" . $xSalesInvoiceNo . " and
			date>='$xFrom' and date<='$xTo' " ) or die ( mysql_error () );
	$num_rows = mysql_num_rows ( $result );
	if ($num_rows >= 1) {
		return true;
	} else {
		return false;
	}
}
$xQry = '';
$xSlNo = 1;
$xGrandVat = 0;
$xGrandTotal = 0;
$xGrandNetTotal = 0;
$xVatValue = 0;
$xNetTotal = 0;
$xQryFilter = '';
if (isSet ( $_POST ['save'] )) {
	$xFromDate = $_POST ['f_fromdate'];
	$xToDate = $_POST ['f_todate'];
	$xQry = "update config_inventory set fromdate='$xFromDate',todate='$xToDate'";
	mysql_query ( $xQry );
	header ( 'Location: inv_hr004_c_prescription_register.php' );
} else {
	$xFromDate = $GLOBALS ['xInvFromDate'];
	$xToDate = $GLOBALS ['xInvToDate'];
}
$xQry = "SELECT *  from inv_salesentry 
 order by salesinvoiceno";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
echo '</br>';

if (mysql_num_rows ( $result2 )) {
	$xTempPatientId='';
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		
		finditemname ( $row ['itemno'] );
		$xSalesInvForTable = $row ['salesinvoiceno'];
		GetSalesEntry1Details ( $xSalesInvForTable );
		if (checkSalesEntriesAvailable ( $row ['salesinvoiceno'], $xFromDate, $xToDate )) {
			
			?>
 <tr>
 <?php
			
			fn_FindAccountLedgerDetails ( $row ['customerno'] );
			finditemname ( $row ['itemno'] );
			fn_FindDoctor(1);
			if ($row ['customerno'] != $xTempPatientId) {
				echo '<td>' . $xSlNo . '</td>';
				echo '<td>' . date ( 'd/M/y', strtotime ( $GLOBALS ['xDateSEnt1'] ) ) . '</td>';
				echo '<td>' . $row ['salesinvoiceno']  . '</td>';
				
				echo '<td>' . $GLOBALS ['xDoctorName'] . '</td>';
				echo '<td>' . $GLOBALS ['xAccountLedgerName']  . '</td>';
				echo '<td>' . $GLOBALS ['xStatusSEnt1'] . '</td>';
				$xSlNo += 1;
			} else {
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
			}
			
				
			echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
			echo '<td>' . $row ['qty'] . '</td>';
			echo '<td>' . $row ['batchid'] . '</td>';
			echo '<td>' . date ( 'd/m/y', strtotime ( $row ['dateexpired'] ) ) . '</td>';
			echo '<td>' . ucwords($GLOBALS ['xBillBySEnt1']) . '</td>';
			
			echo '<td></td>';
			$xTempPatientId = $row ['customerno'];
		}
	}
} 

else {
	fn_NoDataFound ();
}

?>	

					
					
					
					</tbody>
				</table>

			</div>
			<!-- /container -->
		</div>
	</div>
</div>