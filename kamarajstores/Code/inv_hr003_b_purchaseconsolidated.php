<?php
include 'globalfile.php';
$xFromDate = $GLOBALS ['xCurrentDate'];
$xToDate = $GLOBALS ['xCurrentDate'];
?>
<title>Consolidated-Purchase</title>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<!--             ----------------------- REPORT GOES HERE  ------------------------  !-->
   <div class="panel-body">
<div class="form-group">

<div class="col-xs-3">
<label>Report From Date</label>
<input type="date" class="form-control"  name="reportfromdate" value="<?php echo $GLOBALS ['xFromDate']; ?>">
</div>


<div class="col-xs-3">
<label>Report To Date</label>
<input type="date" class="form-control"  name="reporttodate" value="<?php echo $GLOBALS ['xToDate']; ?>">
</div>

<div class="col-xs-3">
					<label>Supplier
						Name</label> <select class="form-control" name="reportsupplierno">
<?php
	$result = mysql_query ( "SELECT *  FROM account_ledger 
		where ledger_undergroup_no=4 
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
<input type="submit"  name="save"   class="btn btn-primary" value="VIEW" >
				
</div></div>

</form>
<div id="divToPrint">
	<div class="panel panel-primary">
		<div class="panel-heading  text-center">
			<b><?php echo "Consolidated Purchase Entries From[".date('d/M/y', strtotime($xFromDate))."]TO [".date('d/M/y', strtotime($xToDate))."] As On ". date("d/M/y h:i:sa"); ?></b>

		</div>
		<div class="panel-body">

			<div class="container">
				<!--
<p><label for="search"><strong>Enter keyword to search </strong></label><input type="text" id="search"/></p>!-->
				<input id="filter" type="text" class="col-xs-8"
				placeholder="Search here...">
				<table border="1" class="table">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Supplier Name</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>S.No</th>
							<th>Supplier Name</th>
							<th>Amount</th>
						</tr>
					</tfoot>

					<tbody class="searchable">

<?php
$xQry = '';
$xSlNo = 0;
$xGrandVat = 0;
$xGrandDiscount = 0;
$xGrandTotal = 0;
$xGrandNetTotal = 0;
$xGrandProfit = 0;
$xQryFilter='';

 if (isSet($_POST['save'])) 
    {
   $xFromDate=$_POST['reportfromdate'];
   $xToDate= $_POST['reporttodate'];
   $xSupplierNo= $_POST['reportsupplierno'];
   if( $xSupplierNo!=0)
   {
	   $xQryFilter="and p.supplierno=$xSupplierNo";
   }
    }
    else
    {
    }
    
$xQry = "SELECT p.supplierno as supplierno,  sum(totalamount)as totalamount  
from inv_purchaseentry1 as p ,
account_ledger as al
      where p.date >= '$xFromDate' and p.date <= '$xToDate'   $xQryFilter
      and p.supplierno=al.account_ledger_id 
       group by p.supplierno order by al.ledger_name";

$result2 = mysql_query ( $xQry );
$rowCount = mysql_num_rows ( $result2 );
	//echo $xQry;
if (mysql_num_rows ( $result2 )) {
	$xGrandTotal = 0;
	while ( $row = mysql_fetch_array ( $result2 ) ) {
		$xSlNo += 1;
		findsuppliername ( $row ['supplierno'] );
		?>
<tr class='clickable-row'
							data-href='inv_hr003_e_purchasebysupplier.php<?php echo '?passsupplierno='.$row['supplierno'] . '&xmode=report'; ?>"> <?php echo  $GLOBALS['xSupplierName']?>'>
<?php
		echo '<td>' . $xSlNo . '</td>';
		echo '<td>' . $GLOBALS ['xSupplierName'] . '</td>';
		echo '<td align=right>' . fn_RupeeFormat ( $row ['totalamount'] ) . '</td>';
		$xGrandTotal += $row ['totalamount'];
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
