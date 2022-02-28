<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
$xPrintTemplate="print_format_estimate.php";
$xUserRole=$GLOBALS ['xUserRole'];
$xQryFilter = '';
if (isset ( $_GET ['passcustomerno'] ) && ! empty ( $_GET ['passcustomerno'] )) {
	$xCustomerNo = $_GET ['passcustomerno'];
	$xQryFilter = $xQryFilter . ' ' . "and customerno=$xCustomerNo";
} else {
	// if($xSupplierNo!=0) { $xQryFilter= $xQryFilter. ' ' . "and supplierno=$xSupplierNo"; }
	$xQryFilter = '';
}
?>
<title>Consolidated-Purchase</title>

<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
	<div class="panel panel-primary">
		<div class="panel-heading  text-center">
			<b><?php echo "Sales Details  From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>

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
							<th>Estimate.No</th>
							<th>Customer Name</th>
							<th>Date</th>
							<th>Amount</th>
							<th>Print</th>
							
						</tr>
					</thead>


					<tbody>

<?php
$xQry = '';
$xSlNo = 0;
$xGrandVat = 0;
$xGrandDiscount = 0;
$xGrandTotal = 0;
$xGrandNetTotal = 0;
$xGrandProfit = 0;

$xQry = "SELECT t1.estimate_customerno as estimate_customerno,estimate_id,estimate_date,estimate_totalamount 
from inv_estimateentry1 as t1 ,account_ledger as t2
      where t1.estimate_date >= '$xFromDate' and t1.estimate_date <= '$xToDate' 
      and t1.estimate_customerno=t2.account_ledger_id $xQryFilter
        order by t1.estimate_id";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );

if (mysql_num_rows ( $result2 )) {
	$xGrandTotal = 0;
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		findcustomername ( $row ['estimate_customerno'] );
		?>
<tr class='clickable-row'
							data-href='inv_hr004_e_salesbycustomer_item.php<?php echo '?passsalesinvoiceno='.$row['salesinvoiceno'] . '&xmode=report'; ?>"> <?php echo  $row ['salesinvoiceno']?>'>
<?php
		echo '<td>' . $xSlNo . '</td>';
		echo '<td align=left>' . $row ['estimate_id'] . '</td>';
		echo '<td align=left>' . $GLOBALS ['xCustomerName'] . '</td>';
		echo '<td align=left>' . date ( 'd/M/y', strtotime ( $row ['estimate_date'] ) ) . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $row ['estimate_totalamount'] ) . '</td>';
		?>

	<td><a
								href="<?php echo $xPrintTemplate .'?estimate_id='.$row['estimate_id'] . '&xmode=report'; ?>">
									PRINT </a></td>
                                         
					
<?php
		$xGrandTotal += $row ['estimate_totalamount'];
		echo '</tr>';
	}
	
	echo '<tr>';
	echo '<td colspan=4>Grand Total</td>';
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
