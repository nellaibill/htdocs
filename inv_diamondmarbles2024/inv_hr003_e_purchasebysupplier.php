<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
$xQryFilter = '';
if (isset ( $_GET ['passsupplierno'] ) && ! empty ( $_GET ['passsupplierno'] )) {
	$xSupplierNo = $_GET ['passsupplierno'];
	$xQryFilter = $xQryFilter . ' ' . "and supplierno=$xSupplierNo";
} else {
	// if($xSupplierNo!=0) { $xQryFilter= $xQryFilter. ' ' . "and supplierno=$xSupplierNo"; }
	$xQryFilter='';
}
?>
<title>Consolidated-Purchase</title>

<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
	<div class="panel panel-primary">
		<div class="panel-heading  text-center">
			<b><?php echo "Purchase Details  From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>

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
							<th>Supplier Name</th>
							<th>Date</th>
							<th>Amount</th>
							<th>Frieght</th>
							<th>Others</th>
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
$xGrandFrieght = 0;
$xGrandOthers = 0;

$xQry = "SELECT p.supplierno as supplierno,purchaseinvoiceno,date,
totalamount,freight,others  from inv_purchaseentry1 as p ,
account_ledger as al
      where p.date >= '$xFromDate' and p.date <= '$xToDate' 
      and p.supplierno=al.account_ledger_id
       $xQryFilter
        order by al.ledger_name";

$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );

if (mysql_num_rows ( $result2 )) {
	$xGrandTotal = 0;
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		findsuppliername ( $row ['supplierno'] );
		?>
<tr class='clickable-row' data-href='inv_hr003_e_purchasebysupplier_item.php<?php echo '?passpurchaseinvoiceno='.$row['purchaseinvoiceno'] . '&xmode=report'; ?>"> <?php echo  $row ['purchaseinvoiceno']?>'>
<?php
		echo '<td>' . $xSlNo . '</td>';
echo '<td align=left>' .  $row ['purchaseinvoiceno'] . '</td>';
		echo '<td align=left>' . $GLOBALS ['xSupplierName'] . '</td>';
		echo '<td align=left>' . date ( 'd/M/y', strtotime ( $row ['date'] ) ) . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $row ['totalamount'] ) . '</td>';
		echo '<td align=right>' . $row ['freight'] . '</td>';
		echo '<td align=right>' . $row ['others'] . '</td>';
		?>
	  	<td><a
						href="inv_ht003purchaseentry_full_edit.php
						<?php echo '?passpurchaseinvoiceno='.$row['purchaseinvoiceno']  ?>"
						onclick="return confirm_edit()"> <img src="images/edit.png"
							 style="width: 30px; height: 30px; border: 0">
					</a></td>
		<?php 
		$xGrandTotal += $row ['totalamount'];
		$xGrandFrieght += $row ['freight'];
		$xGrandOthers += $row ['others'];
		echo '</tr>';
	}
	
	echo '<tr>';
	echo '<td colspan=4>Grand Total</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandTotal ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandFrieght ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandOthers ) . '</td>';
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
