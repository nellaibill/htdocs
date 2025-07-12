<?php
include 'globalfile.php';
$xDate = $GLOBALS ['xCurrentDate'] ;
?>
<title>Consolidated-Purchase</title>
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


				<div class="col-xs-2">
					<label>From Date:</label> <input type="date" class="form-control"
						name="f_fromdate" value="<?php echo $xDate; ?>">
				</div>

				<div class="col-xs-2">
					<label>To Date:</label> <input type="date" class="form-control"
						name="f_todate" value="<?php echo $xDate; ?>">
				</div>

				<div class="col-xs-3">
					<label>Patient Status:</label><select class="form-control"
							name="f_rep_patient_status">
											<option value="All">All</option>
							<option value="Alive">Alive</option>
							<option value="Dead">Dead</option>
						</select>
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
			<b><?php echo "Consolidated Purchase Entries From[".date('d/M/y', strtotime($xDate))."]TO [".date('d/M/y', strtotime($xDate))."] As On ". date("d/M/y h:i:sa"); ?></b>

		</div>
		<div class="panel-body">

			<div class="container">
				<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
				<table class="table table-striped  table-bordered "
					data-responsive="table">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Supplier Name</th>
							<th>Total Amount</th>

						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>S.No</th>
							<th>Supplier Name</th>
							<th>Total Amount</th>
						</tr>
					</tfoot>

					<tbody>

<?php
$xQry = '';
$xSlNo = 0;
$xGrandVat = 0;
$xGrandDiscount = 0;
$xGrandTotal = 0;
$xGrandNetTotal = 0;
$xGrandProfit = 0;
$xQryFilter = '';
if (isSet ( $_POST ['save'] )) {
	$xRep_Patient_Status = $_POST ['f_rep_patient_status'];
	$xFromDate = $_POST ['f_fromdate'];
	$xToDate = $_POST ['f_todate'];
	//$xQry = "update config_inventory set stockpointno=$xStockPointNo,supplierno=$xSupplierNo,fromdate='$xFromDate',todate='$xToDate',itemno=$xItemNo";
	//mysql_query ( $xQry );
	header ( 'Location: inv_hr005_settings.php.php' );
} 

if ($xRep_Patient_Status != 0) {
	$xQryFilter = $xQryFilter . ' ' . "and p.supplierno=$xSupplierNo";
}

if ($xItemNo != 0) {
	$xQryFilter = $xQryFilter . ' ' . "and p.itemno=$xItemNo";
}

$xQry = "SELECT p.supplierno as supplierno, sum(p.total)as total  from inv_purchaseentry as p ,inv_supplier as s where p.daterecieved >= '$xFromDate' and p.daterecieved <= '$xToDate' and p.supplierno=s.supplierid $xQryFilter  group by p.supplierno order by s.suppliername";
$result2 = mysqli_query($con, $xQry);
$rowCount = mysqli_num_rows($result2);

if (mysqli_num_rows($result2)) {
	$xGrandTotal = 0;
	while ( $row = mysqli_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		findsuppliername ( $row ['supplierno'] );
		?>
<tr>
<?php
		echo '<td>' . $xSlNo . '</td>';
		?>
<td><a
								href="inv_hr003purchaseentry.php<?php echo '?passsupplierno='.$row['supplierno'] . '&xmode=report'; ?>"> <?php echo  $GLOBALS['xSupplierName']?>
</a></td>
<?php
		echo '<td align=right>' . fn_RupeeFormat ( $row ['total'] ) . '</td>';
		$xGrandTotal += $row ['total'];
		echo '</tr>';
	}
	
	echo '<tr>';
	echo '<td colspan=2>Grand Total</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandTotal ) . '</td>';
	echo '</tr>';
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
<!--             ----------------------- REPORT ENDS HERE  ------------------------  !-->
