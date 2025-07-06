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
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
   <div class="panel-body">
<div class="form-group">


<div class="col-xs-4">
					<label>Customer
						Name</label> <select class="form-control" name="reportcustomerno" id="f_customerno">
<?php
	$result = mysql_query ( "SELECT *  FROM account_ledger 
		where ledger_undergroup_no=5 
		order by ledger_name" );
		?>
		<option value="0">All</option>
		<?php
	while ( $row = mysql_fetch_array ( $result ) ) {
		?>
<option value="<?php echo $row['account_ledger_id']; ?>"
							<?php
		//if ($row ['account_ledger_id'] == $GLOBALS ['xSupplierNo']) {
			//echo 'selected="selected"';
		//}
		?>>
	
 <?php echo $row['ledger_name']; ?> 
</option>
<?php
	}
	
	?>
</select>

				</div>
				<div class="col-xs-3">
<label>From Date:</label>
<input type="date" class="form-control"  name="f_fromdate" value="<?php echo $xFromDate; ?>">
</div>

<div class="col-xs-3">
<label>To Date:</label>
<input type="date" class="form-control"  name="f_todate" value="<?php echo $xToDate; ?>">
</div>
				
				

<input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >
				
</div></div>

</form>
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
<div id="divToPrint">
	<div class="panel panel-primary">
		<div class="panel-heading  text-center">
		<!--	<b><?php echo "Sales Details  From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>!-->

		</div>
		<div class="panel-body">

			<div class="container">
                                          <input id="filter" type="text" class="col-xs-8"
				placeholder="Search here...">
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
							<th>Less</th>
							<th>DeliveryType</th>
							<th>Print</th>
					
						</tr>
					</thead>

<tbody class="searchable">

<?php
$xQry = '';
$xSlNo = 0;
$xGrandVat = 0;
$xGrandDiscount = 0;
$xGrandTotal = 0;
$xGrandNetTotal = 0;
$xGrandProfit = 0;
$xGrandLess=0;
 if (isSet($_POST['save'])) 
    {
   $xCustomerNo= $_POST['reportcustomerno'];
      $xFromDate=$_POST['f_fromdate'];
   $xToDate= $_POST['f_todate'];
 if( $xCustomerNo!=0)
   {
	   $xQryFilter="and customerno=$xCustomerNo";
   }
$xQry = "SELECT t1.customerno as customerno,salesinvoiceno,date,totalamount,lessamount,termsofdelivery
from inv_salesentry1 as t1 ,account_ledger as t2
      where  date>='$xFromDate' and date<='$xToDate' and t1.customerno=t2.account_ledger_id $xQryFilter
         order by t1.salesinvoiceno ";
		//echo $xQry;
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
		echo '<td align=right>' . fn_RupeeFormat ( $row ['lessamount'] ) . '</td>';		
		echo '<td align=right>' . $row ['termsofdelivery'] . '</td>';
		?>

	<td><a
								href="<?php echo $xPrintTemplate .'?salesinvoiceno='.$row['salesinvoiceno'] . '&xmode=report'; ?>">
									PRINT </a></td>
                                                                            <?php if($xUserRole=='A'){?>
		
                                                        <?php } ?>
<?php
		$xGrandTotal += $row ['totalamount'];
		$xGrandLess += $row ['lessamount'];
		echo '</tr>';
	}
	$xNetTotal=$xGrandTotal-$xGrandLess;
	echo '<tr>';
	echo '<td colspan=4> Total</td>';
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


