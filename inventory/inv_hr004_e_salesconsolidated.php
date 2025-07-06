<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
?>
<title>Consolidated-Sales</title>

<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
	<div class="panel panel-primary">
		<div class="panel-heading  text-center">
			<b><?php echo "Consolidated Sales Entries From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>

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
							<th>Customer Name</th>
							<th>Mode of Payment</th>
							<th>Amount</th>
						</tr>
					</thead>


					<tbody>

<?php
$xQry = '';
$xSlNo = 0;

$xQry = "SELECT s.customerno as customerno,  sum(totalamount)as totalamount,
modeofpayment from inv_salesentry1 as s ,
account_ledger as al where s.date >= '$xFromDate' 
and s.date <= '$xToDate' and al.account_ledger_id=s.customerno
 group by s.customerno order by s.salesinvoiceno";

$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );

if (mysql_num_rows ( $result2 )) {
	$xGrandTotal = 0;
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		findcustomername ( $row ['customerno'] );
		?>
<tr class='clickable-row'
							data-href='inv_hr004_e_salesbycustomer.php<?php echo '?passcustomerno='.$row['customerno'] . '&xmode=report'; ?>"> <?php echo  $GLOBALS['xCustomerName']?>'>
<?php
		echo '<td>' . $xSlNo . '</td>';
		echo '<td>' . $GLOBALS ['xCustomerName'] . '</td>';
		echo '<td>' . $row ['modeofpayment'] . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $row ['totalamount'] ) . '</td>';
		$xGrandTotal += $row ['totalamount'];
		echo '</tr>';
	}
	
	echo '<tr>';
	echo '<td colspan=3>Grand Total</td>';
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
