<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
$xPrintTemplate=$GLOBALS ['xPrintTemplate'];
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
							<th>Inv.No</th>
							<th>Customer Name</th>
							<th>Date</th>
							<th>Amount</th>
							<th>Print</th>
							<th>Edit</th>
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

$xQry = "SELECT t1.customerno as customerno,salesinvoiceno,date,totalamount 
from inv_salesentry1 as t1 ,account_ledger as t2
      where t1.date >= '$xFromDate' and t1.date <= '$xToDate' 
      and t1.customerno=t2.account_ledger_id $xQryFilter
        order by t1.salesinvoiceno";
$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );

if (mysql_num_rows ( $result2 )) {
	$xGrandTotal = 0;
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		findcustomername ( $row ['customerno'] );
		?>
<tr class='clickable-row'
							data-href='inv_hr004_e_salesbycustomer_item.php<?php echo '?passsalesinvoiceno='.$row['salesinvoiceno'] . '&xmode=report'; ?>"> <?php echo  $row ['salesinvoiceno']?>'>
<?php
		echo '<td>' . $xSlNo . '</td>';
		echo '<td align=left>' . $row ['salesinvoiceno'] . '</td>';
		echo '<td align=left>' . $GLOBALS ['xCustomerName'] . '</td>';
		echo '<td align=left>' . date ( 'd/M/y', strtotime ( $row ['date'] ) ) . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $row ['totalamount'] ) . '</td>';
		?>

	<td><a
								href="<?php echo $xPrintTemplate .'?salesinvoiceno='.$row['salesinvoiceno'] . '&xmode=report'; ?>">
									PRINT </a></td>
                                                                            <?php if($xUserRole=='A'){?>
							<td><a
								href="inv_ht004salesentry.php
						<?php echo '?passsalesinvoiceno='.$row['salesinvoiceno']  ?>"
								onclick="return confirm_edit()"> <img src="images/edit.png"
									style="width: 30px; height: 30px; border: 0">
							</a></td>
                                                        <?php } ?>
<?php
		$xGrandTotal += $row ['totalamount'];
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
