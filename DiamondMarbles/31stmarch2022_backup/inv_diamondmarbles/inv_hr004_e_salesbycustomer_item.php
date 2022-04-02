<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
$xQryFilter = '';
if (isset ( $_GET ['passsalesinvoiceno'] ) && ! empty ( $_GET ['passsalesinvoiceno'] )) {
	$xSalesInvoiceNo = $_GET ['passsalesinvoiceno'];
	$xQryFilter = $xQryFilter . ' ' . "and salesinvoiceno=$xSalesInvoiceNo";
} else {
	// if($xSupplierNo!=0) { $xQryFilter= $xQryFilter. ' ' . "and supplierno=$xSupplierNo"; }
	$xQryFilter = '';
}
?>
<title>Consolidated-Sales</title>

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
							<th>Inv.No</th>
														<th>Track</th>
							<th>Item Name</th>
							<th>Item Description</th>
							<th>Qty</th>
							<th>Price</th>
							<th>Gst%</th>
							<th>Total</th>
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

$xQry = "SELECT * from inv_salesentry where salesinvoiceno>0 $xQryFilter order by salesinvoiceno";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );

if (mysql_num_rows ( $result2 )) {
	$xGrandTotal = 0;
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		finditemname( $row ['itemno'] );
		?>
<tr>
<?php
		echo '<td>' . $xSlNo . '</td>';
		echo '<td align=right>' . $row ['salesinvoiceno'] . '</td>';
		echo '<td align=right>' . $row ['txno'] . '</td>';

		echo '<td align=left>' . $GLOBALS ['xItemName'] . '</td>';
		echo '<td align=right>' . $row ['usagestockdetails'] . '</td>';
		echo '<td align=right>' . $row ['qty'] . '</td>';
		echo '<td align=right>' . $row ['unitrate'] . '</td>';
		echo '<td align=right>' . $row ['vat'] . '</td>';
		echo '<td align=right>' . $row ['amount'] . '</td>';
		$xGrandTotal += $row ['amount'];
		echo '</tr>';
	}
	
	echo '<tr>';
	echo '<td colspan=7>Grand Total</td>';
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
