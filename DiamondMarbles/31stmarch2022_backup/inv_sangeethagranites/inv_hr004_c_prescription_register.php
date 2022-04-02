<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
fn_DataClear ();
function fn_DataClear() {
	$_GET ['form'] = '';
}
?>


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


				<div class="col-xs-3">
					<label>From Date:</label> <input type="date" class="form-control"
						name="f_fromdate" value="<?php echo $xFromDate; ?>">
				</div>

				<div class="col-xs-3">
					<label>To Date:</label> <input type="date" class="form-control"
						name="f_todate" value="<?php echo $xToDate; ?>">
				</div>



			</div>
			<!-- Form-Group !-->
		</div>
		<!-- Panel Body !-->
	</div>
	<!-- Panel !-->
</form>
<html>
<title>V-SALES</title>
<head>
<link href="bootstrap.css" rel="stylesheet">
<link href="css/reportstyle.css" rel="stylesheet">

</head>
<body>

	<div id="divToPrint">
		<div class="container">

<?php
$xSlNo = 0;
if (isSet ( $_POST ['save'] )) {
	$xFromDate = $_POST ['f_fromdate'];
	$xToDate = $_POST ['f_todate'];
	if (empty ( $_POST ['f_salesinvoiceno'] )) {
		$xSalesInvoiceNo = 0;
	} else {
		$xSalesInvoiceNo = $_POST ['f_salesinvoiceno'];
	}
	
	mysql_query ( "update config_inventory set fromdate='$xFromDate',todate='$xToDate',itemno=$xItemNo" ) or die ( mysql_error () );
	header ( 'Location: inv_hr004_c_prescription_register.php' );
} else {
	$xFromDate = $GLOBALS ['xInvFromDate'];
	$xToDate = $GLOBALS ['xInvToDate'];
	$xItemNo = $GLOBALS ['xItemNo'];
	$xStockPointNo = $GLOBALS ['xStockPointNo'];
	$xSalesInvoiceNo = $GLOBALS ['xSalesInvoiceNo'];
}



/* ------------- Area Executes from Home Page ----------- */

if ($_GET ['form']) {
	$xFromDate = $GLOBALS ['xCurrentDate'];
	$xToDate = $GLOBALS ['xCurrentDate'];
	$xQry = "update config_inventory set itemno=0,fromdate='$xFromDate',todate='$xToDate'";
	mysql_query ( $xQry ) or die ( mysql_error () );
	mysql_query ( "update config set employeeno=0" ) or die ( mysql_error () );
	header ( 'Location: inv_hr004_c_prescription_register.php' );
}

/* ------------- Area Executes from Home Page ----------- */

$xQry = "SELECT *  from inv_salesentry where date>= '$xFromDate' AND date<= '$xToDate'  order by salesinvoiceno;";
// echo $xQry;
$result2 = mysql_query ( $xQry );
?>
<div class="panel panel-info">
				<!-- Default panel contents -->
				<div class="panel-heading  text-center">
					<b><?php echo "PRADEEP PHARMACY  PRESCRIPTION REGISTER From ". date('d/m/y', strtotime($xFromDate)) ."
		to ". date('d/m/y', strtotime($xToDate)) ?></b>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th width="5%">S.NO</th>
													<th width="5%">DATE</th>
							<th width="15%">DOCTOR</th>
							<th width="20%">PATIENTNAME</th>
							<th width="20%">ITEM NAME</th>
							<th width="10%">QTY</th>
							<th width="10%">EXPDATE</th>
							<th width="10%">BATCH</th>
							<th width="10%">SIGN</th>
						</tr>
					</thead>

					<tbody>

<?php
if (mysql_num_rows ( $result2 )) {
	$xTempPatientId='';
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		
		echo '<tr>';

		fn_PatientDetails ( $row ['patientid'] );
		finditemname ( $row ['itemno'] );
		findstockpointname ( $row ['usagestockpointno'] );
		
		if($row ['patientid']!=$xTempPatientId)
		{
			echo '<td>' . $xSlNo += 1 . '</td>';
			echo '<td>' . date('d/m/y', strtotime($row ['date'])) . '</td>';
		echo '<td>' . $GLOBALS ['xDoctorName'] . '</td>';
		echo '<td>' . $GLOBALS ['xPatientName']." - ". $GLOBALS ['xPatientAge']." - ". $GLOBALS ['xPatientSex'].'</td>';
		}
		else
			{
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
			}
		echo '<td>' . $GLOBALS ['xItemName'] . '</td>';
		echo '<td>' . $row ['qty'] . '</td>';
		echo '<td>' . date('d/m/y', strtotime($row ['dateexpired'])) . '</td>';
		echo '<td>' . $row ['batchid'] . '</td>';
		$xTempPatientId=$row ['patientid'];
		?>

<?php
		echo '</tr>';
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
</body>
</html>
