<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xInvFromDate'];
$xToDate = $GLOBALS ['xInvToDate'];
 if (isSet($_GET['xmode'])) 
    {
		$xDiscountPercentage=0.00;
		$xDiscountPoint=0;
		$xTotalAmount=$_GET['totalamount'];
		$xSalesInvoiceNo=$_GET['salesinvoiceno'];
		if($_GET['xmode']=="50percentage")
		{
			$xTotalAmount=$xTotalAmount/2;
			$xDiscountPercentage=50.00;
			$xDiscountPoint=2;
		}
		else if($_GET['xmode']=="100percentage")
		{
				$xDiscountPercentage=100.00;
		}
	$xSalesEntry1Qry = "update inv_salesentry1 set lessamount=$xTotalAmount where salesinvoiceno=$xSalesInvoiceNo";
	$xSalesEntryQry = "update inv_salesentry set discountpercentage=$xDiscountPercentage,unitmrp=unitmrp-(unitmrp/$xDiscountPoint) where salesinvoiceno=$xSalesInvoiceNo";
	//echo $xSalesEntry1Qry;
	//echo $xSalesEntryQry;
     $result2 = mysql_query ( $xSalesEntry1Qry );	
	 $result2 = mysql_query ( $xSalesEntryQry );
	 		header ( 'Location: inv_hr004_e_salesconsolidated.php' );
	}
	
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
								<th>LessAmount</th>
		
							
						</tr>
					</thead>


					<tbody>

<?php
$xQry = '';
$xSlNo = 0;
$xGrandTotal = 0;
$xGrandLess=0;
$xQry = "SELECT s.customerno as customerno,  sum(totalamount)as totalamount,salesinvoiceno,sum(lessamount)as lessamount,
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
				echo '<td align=right>' . fn_RupeeFormat ( $row ['lessamount'] ) . '</td>';
		$xSalesInvoiceNo=$row ['salesinvoiceno'];
		?>
	
                                    <?php if ($xUserRole == 'A') { ?>
			<td><a
								href="inv_hr004_e_salesconsolidated.php<?php echo '?salesinvoiceno='.$xSalesInvoiceNo. '&totalamount='.$row ['totalamount']. '&xmode=100percentage';  ?>"
								> <img src="images/100percentage.png"
									style="width: 60px; height: 40px; border: 0">
							</a></td>
							<td><a
								href="inv_hr004_e_salesconsolidated.php<?php echo '?salesinvoiceno='.$xSalesInvoiceNo. '&totalamount='.$row ['totalamount']. '&xmode=50percentage';  ?>"
								> <img src="images/50percentage.png"
									style="width: 60px; height: 40px; border: 0">
							</a></td>
							    <?php } ?>
							<?php
		$xGrandTotal += $row ['totalamount'];
		$xGrandLess += $row ['lessamount'];
		echo '</tr>';
	}
	
	$xNetTotal=$xGrandTotal-$xGrandLess;
	echo '<tr>';
	echo '<td colspan=3> Total</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandTotal ) . '</td>';
	echo '<td align=right>' . fn_RupeeFormat ( $xGrandLess ) . '</td>';
	
	echo '</tr>';
		echo '<tr>';
	echo '<td colspan=4>Grand Total</td>';
	echo '<td align=right>' . fn_RupeeFormat ($xNetTotal) . '</td>';
	
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
